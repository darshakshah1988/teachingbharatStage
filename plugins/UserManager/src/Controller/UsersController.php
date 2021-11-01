<?php
declare(strict_types=1);

namespace UserManager\Controller;

use UserManager\Controller\AppController;
use CakeDC\Users\Controller\Traits\LinkSocialTrait;
use CakeDC\Users\Controller\Traits\LoginTrait;
use CakeDC\Users\Controller\Traits\RegisterTrait;
use UserManager\Model\Table\UsersTable;
use CakeDC\Users\Controller\Traits\ProfileTrait;
use Cake\Filesystem\File;
use Cake\Core\Configure;
use Cake\Datasource\EntityInterface;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use CakeDC\Users\Plugin;
use Cake\Event\Event;

use Cake\Validation\Validator;
use CakeDC\Users\Exception\UserNotActiveException;
use CakeDC\Users\Exception\UserNotFoundException;
use CakeDC\Users\Exception\WrongPasswordException;
use Cake\ORM\Locator\LocatorAwareTrait;

use Exception;
use Cake\Http\Cookie\Cookie;
use Cake\Http\Cookie\CookieCollection;
use DateTime;

/**
 * Users Controller()
 *
 * @method \UserManager\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    use LinkSocialTrait;
    use LoginTrait;
    use ProfileTrait;
    use RegisterTrait;


    /**
     * Initialize
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('CakeDC/Users.Setup');
        if ($this->components()->has('Security')) {
            $this->Security->setConfig(
                'unlockedActions',
                ['login', 'u2fRegister', 'u2fRegisterFinish', 'u2fAuthenticate', 'u2fAuthenticateFinish']
            );
        }
    }

    /**
     * Register a new user
     *
     * @throws \Cake\Http\Exception\NotFoundException
     * @return mixed
     */
    public function register()
    {
        if (!Configure::read('Users.Registration.active')) {
            throw new NotFoundException();
        }
        $identity = $this->getRequest()->getAttribute('identity');
        $identity = $identity ?? [];
        $userId = $identity['id'] ?? null;
        if (!empty($userId) && !Configure::read('Users.Registration.allowLoggedIn')) {
            $this->Flash->error(__d('cake_d_c/users', 'You must log out to register a new user account'));

            return $this->redirect(Configure::read('Users.Profile.route'));
        }

        $usersTable = $this->getUsersTable();
        $user = $usersTable->newEmptyEntity();
        if($this->request->getCookie('referred_by')){
            $user->referred_by = $this->request->getCookie('referred_by');
        }
        $validateEmail = (bool)Configure::read('Users.Email.validate');
        $useTos = (bool)Configure::read('Users.Tos.required');
        $tokenExpiration = Configure::read('Users.Token.expiration');
        $options = [
            'token_expiration' => $tokenExpiration,
            'validate_email' => true,
            'use_tos' => $useTos,
        ];

		 if($this->request->getData('is_mobile_verified') == 1){
			 $user->sms_otp = NULL;
			 $user->is_mobile_verified = 1;
		 }
        $requestData = $this->getRequest()->getData();
        $event = $this->dispatchEvent(Plugin::EVENT_BEFORE_REGISTER, [
            'usersTable' => $usersTable,
            'options' => $options,
            'userEntity' => $user,
        ]);

        $result = $event->getResult();

        if ($result instanceof EntityInterface) {
            $data = $result->toArray();
            $data['password'] = $requestData['password'] ?? null; //since password is a hidden property
            $data['referred_by'] = $this->request->getCookie('referred_by');
            $userSaved = $usersTable->register($user, $data, $options);
            if ($userSaved) {

                if($this->request->getCookie('referred_by')){
                    $referred_by = $this->request->getCookie('referred_by');

                    $transactionTable = $this->getTableLocator()->get('Transactions.Transactions');
                    $transactions = $transactionTable->newEmptyEntity();
                    $transactions->user_id = $userSaved->id;
                    $transactions->payment_method = 'referral';
                    $transactions->transaction_type = 1;
                    $transactions->transaction_status = 1;
                    $transactions->amount = 500;
                    $transactions->note = "This is referral amount";
                    $transactionTable->save($transactions);
                    $this->response = $this->response->withExpiredCookie(new Cookie('referred_by'));
                    //dd($transactionTable);
                }

                return $this->_afterRegister($userSaved);
            } else {
                $this->set(compact('user'));
                $this->Flash->error(__d('cake_d_c/users', 'The user could not be saved'));

                return;
            }
        }
        if ($event->isStopped()) {
            return $this->redirect($event->getResult());
        }
        $locations = $this->Users->UserProfiles->Locations->ParentLocations->find('treeList', ['keyField' => 'id', 'valueField' => 'title'])->toArray();
        $this->set(compact('user', 'locations'));
        $this->set('_serialize', ['user']);
        if (!$this->getRequest()->is('post')) {
            return;
        }

        if (!$this->_validateRegisterPost()) {
            $this->Flash->error(__d('cake_d_c/users', 'Invalid reCaptcha'));

            return;
        }

		$userSaved = $usersTable->register($user, $requestData, $options);
		if (!$userSaved) {

            $this->Flash->error(__d('cake_d_c/users', 'The user could not be saved'));

            return;
        }else{
			\Cake\ORM\TableRegistry::getTableLocator()->get('UserManager.UserProfiles')->query()
            ->update()
            ->set(['password' => $requestData['password']])
            ->where(['user_id' => $user->id])
            ->execute();
             if($this->request->getCookie('referred_by')){
				$referred_by = $this->request->getCookie('referred_by');
				$transactionTable = $this->getTableLocator()->get('Transactions.Transactions');
				$transactions = $transactionTable->newEmptyEntity();
				$transactions->user_id = $this->request->getCookie('referred_by');
				$transactions->payment_method = 'referral';
				$transactions->transaction_type = 1;
				$transactions->transaction_status = 1;
				$transactions->amount = 500;
				$transactions->note = "This is referral amount";
				$transactionTable->save($transactions);
				try{
					$this->response = $this->response->withExpiredCookie(new Cookie('referred_by'));
				}catch(\Exception $e){

				}

			}
        }
		return $this->_afterRegister($userSaved);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Users->find();
        $options['order'] = ['Users.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $users = $this->paginate($query);
        $this->set(compact('users'));
    }

    /**
     * changeMobile method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function changeMobile($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['UserProfiles'],
        ]);
        $this->set(compact('user'));
    }

     /**
     * sendOtp method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function sendOtp($id = null)
    {
        if($id){
             $userProfile = $this->Users->UserProfiles->get($id, [
                'contain' => [],
            ]);
        }else{
            $userProfile = $this->Users->UserProfiles->newEmptyEntity();
        }

        $data['mobile'] = $this->request->getData('mobile');
        if($userProfile->mobile != $this->request->getData('mobile')){
            $data['is_mobile_verified'] = NULL;
        }
        $data['sms_otp'] = NULL;
        //dd($data);
        $userProfile = $this->Users->UserProfiles->patchEntity($userProfile, $data);
        $is_changed = false;
        if($userProfile->isDirty('mobile') || $userProfile->isDirty('sms_otp')){
            $is_changed = true;
        }
        if ($this->Users->UserProfiles->save($userProfile)) {
			$result = ['status' => true, 'message' => __('The mobile has been updated.')];
		} else {
			$result = ['status' => false, 'message' => __('The mobile could not be updated. Please, try again.')];
		}
        $userProfile->otpUrl = \Cake\Routing\Router::url(['controller' => 'Users', 'action' => 'showOtpScreen', $userProfile->id]);
		//dd($userProfile);
        $this->set([
                'code' => (isset($result['status']) && $result['status'] == true) ? 200 : 422,
                'status' => $result['status'] ?? null,
                'message' => $result['message'] ?? null,
                'data' => $userProfile,
                'errors' => $userProfile->getErrors(),
                'is_changed' => $is_changed
            ]);
        $this->viewBuilder()->setOption('serialize', ['status', 'code', 'message', 'data', 'errors', 'is_changed']);
    }


    /**
     * showOtpScreen method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function showOtpScreen($id = null)
    {
        $userProfile = $this->Users->UserProfiles->get($id, [
            'contain' => [],
        ]);
        $this->set(compact('userProfile'));
    }

    /**
     * getOtp method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function getOtp($id = null)
    {
        $userProfile = $this->Users->UserProfiles->get($id, [
            'contain' => [],
        ]);
        if($this->request->getData('reset_otp') && $this->request->getData('reset_otp') == true){

            $event = new Event('Users.User.afterChangeMobile', $this, ['user' => $userProfile->toArray()]);
            $this->getEventManager()->dispatch($event);
            $result = ['status' => true, 'message' => __('OTP has sent again.')];
        }else{
            $otp = $this->request->getData('otp') ? implode("", $this->request->getData('otp')) : null;
            if($this->request->getData('otp') && $userProfile->sms_otp == $otp){
                $data['is_mobile_verified'] = 1;
                $data['sms_otp'] = NULL;
                $userProfile = $this->Users->UserProfiles->patchEntity($userProfile, $data);
                if ($this->Users->UserProfiles->save($userProfile)) {
                        $result = ['status' => true, 'message' => __('The mobile number has verified.')];
                    } else {
                        $result = ['status' => false, 'message' => __('The mobile could not be updated. Please, try again.')];
                    }
            }else{
                $result = ['status' => false, 'message' => __('Invalid OTP. Please try again.')];
            }
        }



        $this->set([
                'code' => (isset($result['status']) && $result['status'] == true) ? 200 : 422,
                'status' => $result['status'] ?? null,
                'message' => $result['message'] ?? null,
                'data' => $userProfile,
                'errors' => $result['errors'] ?? null,
            ]);
        $this->viewBuilder()->setOption('serialize', ['status', 'code', 'message', 'data', 'errors']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        $this->set(compact('user'));
    }

    /**
     * teacherRegistration method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function teacherRegistrationOld()
    {
        $identity = $this->getRequest()->getAttribute('identity');
        $identity = $identity ?? [];
        $userId = $identity['id'] ?? null;
        // if (!empty($userId) && !Configure::read('Users.Registration.allowLoggedIn')) {
        //     $this->Flash->error(__d('cake_d_c/users', 'You must log out to register a new user account'));

        //     return $this->redirect(Configure::read('Users.Profile.route'));
        // }

        $usersTable = $this->getUsersTable();
        $user = $usersTable->newEmptyEntity();
        $validateEmail = (bool)Configure::read('Users.Email.validate');
        $useTos = (bool)Configure::read('Users.Tos.required');
        $tokenExpiration = Configure::read('Users.Token.expiration');
        $options = [
            'token_expiration' => $tokenExpiration,
            'validate_email' => $validateEmail,
            'use_tos' => $useTos,
            'validator' => 'teacherRegister'
        ];
        $requestData = $this->getRequest()->getData();
        $event = $this->dispatchEvent(Plugin::EVENT_BEFORE_REGISTER, [
            'usersTable' => $usersTable,
            'options' => $options,
            'userEntity' => $user,
        ]);

        $result = $event->getResult();
        if ($result instanceof EntityInterface) {
            $data = $result->toArray();
            $data['password'] = $requestData['password'] ?? null; //since password is a hidden property
            $data['username'] = $requestData['username'] ?? $requestData['email'];
            $userSaved = $usersTable->register($user, $data, $options);
            if ($userSaved) {
                return $this->_afterRegister($userSaved);
            } else {
                $this->set(compact('user'));
                $this->Flash->error(__d('cake_d_c/users', 'The user could not be saved'));

                return;
            }
        }
        if ($event->isStopped()) {
            return $this->redirect($event->getResult());
        }


        $gradingTypes = $this->Users->GradingTypes->find('list', ['limit' => 200]);
        $teacherSchedules = $this->Users->TeacherSchedules->find('list', ['limit' => 200]);



        $greads = [];
        foreach($gradingTypes as $id => $gradingType)  {
            $greads[] = ['text' => $gradingType, 'value' => $id, 'class' => 'D-checkbox'];
        }

        $schedules = [];
        foreach($teacherSchedules as $id => $teacherSchedule)  {
            $schedules[] = ['text' => $teacherSchedule, 'value' => $id, 'class' => 'D-checkbox'];
        }
        $subjects = $this->Users->UserProfiles->PrimarySubjects->find('list', ['limit' => 200]);
        $occupations = $this->Users->UserProfiles->Occupations->find('list', ['limit' => 200])->where(['Occupations.status' => 1]);

        $this->set(compact('user', 'greads', 'schedules','subjects', 'occupations'));
        $this->set('_serialize', ['user']);

        if (!$this->getRequest()->is('post')) {
            return;
        }

        if (!$this->_validateRegisterPost()) {
            $this->Flash->error(__d('cake_d_c/users', 'Invalid reCaptcha'));

            return;
        }

        $userSaved = $usersTable->register($user, $requestData, $options);
        if (!$userSaved) {
            $this->Flash->error(__d('cake_d_c/users', 'The user could not be saved'));

            return;
        }

        return $this->_afterRegister($userSaved);
    }

/**
     * teacherRegistration method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function teacherRegistration()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is(['patch', 'post', 'put'])) {
            //dump($this->request->getData());
            //dd($this->request->getData());
            $user = $this->Users->patchEntity($user, $this->request->getData(), ['associated' => ['UserProfiles', 'GradingTypes', 'TeacherSchedules', 'Boards'], 'validate' => 'teacherRegister']);
            $user->username = $this->request->getData('email');
            //dd($user);

            if ($this->Users->save($user)) {

                $event = new Event('Users.Teacher.afterRegister', $this, ['user' => $user]);
                $this->getEventManager()->dispatch($event);

                $this->Flash->success(__('Your details has been saved.'));
                return $this->redirect(['action' => 'thank-you']);
            }
            //dd($user->getErrors());
            $this->Flash->error(__('Your details could not be saved. Please, try again.'));
        }


        $gradingTypes = $this->Users->GradingTypes->find('list', ['limit' => 200]);
        $teacherSchedules = $this->Users->TeacherSchedules->find('list', ['limit' => 200]);
        $boards = $this->Users->Boards->find('list', ['limit' => 200]);

        $greads = [];
        foreach($gradingTypes as $id => $gradingType)  {
            $greads[] = ['text' => $gradingType, 'value' => $id, 'class' => 'D-checkbox'];
        }

        $teacherBoards = [];
        foreach($boards as $id => $board)  {
            $teacherBoards[] = ['text' => $board, 'value' => $id, 'class' => 'D-checkbox'];
        }

        $schedules = [];
        foreach($teacherSchedules as $id => $teacherSchedule)  {
            $schedules[] = ['text' => $teacherSchedule, 'value' => $id, 'class' => 'D-checkbox'];
        }
        $subjects = $this->Users->UserProfiles->PrimarySubjects->find('list', ['limit' => 200]);
        $occupations = $this->Users->UserProfiles->Occupations->find('list', ['limit' => 200])->where(['Occupations.status' => 1]);

         $locations = $this->Users->UserProfiles->Locations->ParentLocations->find('treeList', ['keyField' => 'id', 'valueField' => 'title'])->toArray();

        $this->set(compact('user', 'greads', 'schedules','subjects', 'occupations', 'locations', 'teacherBoards'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Reset password
     *
     * @param null $token token data.
     * @return void
     */
    public function generatePassword($token = null)
    {
        $user = $this->getRequest()->getAttribute('identity');
        $user = $user ?? [];
        if($user && !empty($user)){
            $this->getRequest()->getSession()->destroy();
            $this->Authentication->logout();
        }
        $this->validate('password', $token);
    }



    /**
     * croping method
     *
     * @return \Cake\Http\Response
     */
    public function croping($id = null)
    {
        $user = [];
        if($id){
            $query = $this->Users->find()->where(['Users.id' => $id]);
            //$query->contain(['UsersProfile']);
            $user = $query->firstOrFail();
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Profile action
     * @param mixed $id Profile id object.
     * @return mixed
     */
    public function profile($id = null)
    {
        $identity = $this->getRequest()->getAttribute('identity');
        $identity = $identity ?? [];
        $loggedUserId = $identity['id'] ?? null;
        $isCurrentUser = false;
        if (!Configure::read('Users.Profile.viewOthers') || empty($id)) {
            $id = $loggedUserId;
        }

        if(!$id){
            return $this->redirect($this->referer());
        }

        // $user = $this->Users->get($id, [
        //             'contain' => ['UserProfiles', 'GradingTypes', 'Languages', 'UserProfiles.Locations', 'UserProfiles.PrimarySubjects', 'UserProfiles.SecondarySubjects', 'UserProfiles.Occupations', 'UserDocuments'],
        //         ]);

        $query = $this->Users->find();
        $user = $query->contain(['UserProfiles', 'GradingTypes', 'Languages', 'UserProfiles.Locations', 'UserProfiles.PrimarySubjects', 'UserProfiles.SecondarySubjects', 'UserProfiles.Occupations', 'UserDocuments', 'Reviews' => function($q){
            return $q->limit(2);
        }])
        ->leftJoinWith('Reviews', function($q){
            return $q;
        })
        ->group(['Users.id'])->enableAutoFields(true)
        ->select(['avg_rating' => $query->func()->avg('Reviews.rating'), 'total_rating' => $query->func()->count('Reviews.id')])
        ->where(['Users.id' => $id])
        ->firstOrFail();

        //dd($user);


        $this->set('avatarPlaceholder', Configure::read('Users.Avatar.placeholder'));
        if ($user->id === $loggedUserId) {
            $isCurrentUser = true;
        }
        //dd($user);

        $this->set(compact('user', 'isCurrentUser'));
        $this->set('_serialize', ['user', 'isCurrentUser']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function updateProfile()
    {
        $identity = $this->getRequest()->getAttribute('identity');
        $query = $this->Users->find();
         $user = $query->contain(['UserProfiles', 'GradingTypes', 'Languages', 'UserProfiles.Locations', 'UserProfiles.PrimarySubjects', 'UserProfiles.SecondarySubjects', 'UserProfiles.Occupations', 'UserDocuments', 'Reviews' => function($q){
            return $q->limit(2);
        }])
        ->leftJoinWith('Reviews', function($q){
            return $q;
        })
        ->group(['Users.id'])->enableAutoFields(true)
        ->select(['avg_rating' => $query->func()->avg('Reviews.rating'), 'total_rating' => $query->func()->count('Reviews.id')])
        ->where(['Users.id' => $identity->id])
        ->firstOrFail();

        //dd($user);
        if ($this->request->is(['patch', 'post', 'put'])) {

            if($this->request->getData('base64img') && preg_match('/^data:image\/(\w+);base64,/', $this->request->getData('base64img'))){
                $img = explode(',', $this->request->getData('base64img'));
                $start = strlen('data:image/');
                    if(isset($img[1]) && !empty($img[1])){
                    //to get filetype [0] => data:image/jpeg;base64
                      $mystring = $img[0];
                      //to get filetype
                      $findme = ';';
                      $end = strpos($mystring, $findme);
                      $fileType = substr($img[0], $start, $end - $start);
                      //decode it
                      $data = base64_decode($img[1]);

                      $filename = 'profile_'. uniqid() . '.' . $fileType;
                      $file_dir = WWW_ROOT .  'img' .DS. 'tmp' .DS. $filename;

                      $file = new File($file_dir, true, 0777);
                      $file->write($data, 'w', true);

                      $profile_file = new \Laminas\Diactoros\UploadedFile(
                                    $file->path,
                                    $file->size(),
                                    \UPLOAD_ERR_OK,
                                    $filename,
                                    $file->mime()
                                );
                      $this->request = $this->request->withData('profile_photo', $profile_file);
                    }
            }
            //dd($this->request->getData('profile_photo')->getStream()->getMetadata('uri'));
            $user = $this->Users->patchEntity($user, $this->request->getData());
            //dd($user);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Your profile has been updated.'));

                return $this->redirect($this->getRequest()->referer());
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $gradingTypes = $this->Users->GradingTypes->find('list', ['limit' => 200]);
        $languages = $this->Users->Languages->find('list', ['limit' => 200])->where(['Languages.status' => 1]);
        $locations = $this->Users->UserProfiles->Locations->ParentLocations->find('treeList', ['keyField' => 'id', 'valueField' => 'title'])->toArray();
        $boards = $this->Users->Boards->find('list', ['limit' => 200]);
        $teacherSchedules = $this->Users->TeacherSchedules->find('list', ['limit' => 200]);
        $subjects = $this->Users->UserProfiles->PrimarySubjects->find('list', ['limit' => 200]);
        $occupations = $this->Users->UserProfiles->Occupations->find('list', ['limit' => 200])->where(['Occupations.status' => 1]);
        $this->set(compact('user', 'languages', 'locations', 'gradingTypes', 'boards', 'teacherSchedules', 'subjects', 'occupations'));
    }

    /**
     * Change password
     * Can be used while logged in for own password, as a superuser on any user, or while not logged in for reset
     * reset password with session key (email token has already been validated)
     *
     * @param int|string|null $id user_id, null for logged in user id
     *
     * @return mixed
     */
    public function changePassword($id = null)
    {
        $user = $this->getUsersTable()->newEntity([], ['validate' => false]);
        $identity = $this->getRequest()->getAttribute('identity');
        $identity = $identity ?? [];
        $userId = $identity['id'] ?? null;

        if ($userId) {
            if ($id && $identity['is_superuser'] && Configure::read('Users.Superuser.allowedToChangePasswords')) {
                // superuser editing any account's password
                $user->id = $id;
                $validatePassword = false;
                $redirect = ['action' => 'index'];
            } elseif (!$id || $id === $userId) {
                // normal user editing own password
                $user->id = $userId;
                $validatePassword = true;
                $redirect = Configure::read('Users.Profile.route');
            } else {
                $this->Flash->error(
                    __d('CakeDC/Users', 'Changing another user\'s password is not allowed')
                );
                $this->redirect(Configure::read('Users.Profile.route'));

                return;
            }
        } else {
            // password reset
            $user->id = $this->getRequest()->getSession()->read(
                Configure::read('Users.Key.Session.resetPasswordUserId')
            );
            $validatePassword = false;
            $redirect = $this->Authentication->getConfig('loginAction');
            if (!$user->id) {
                $this->Flash->error(__d('cake_d_c/users', 'User was not found'));
                $this->redirect($redirect);

                return;
            }
        }
        $this->set('validatePassword', $validatePassword);
        if ($this->getRequest()->is(['post', 'put'])) {
            try {
                $validator = $this->getUsersTable()->validationPasswordConfirm(new Validator());
                if ($validatePassword) {
                    $validator = $this->getUsersTable()->validationCurrentPassword($validator);
                }
                $user = $this->getUsersTable()->patchEntity(
                    $user,
                    $this->getRequest()->getData(),
                    [
                        'validate' => $validator,
                        'accessibleFields' => [
                            'current_password' => true,
                            'password' => true,
                            'password_confirm' => true,
                        ],
                    ]
                );

                if ($user->getErrors()) {
                    //$this->Flash->error(__d('cake_d_c/users', 'Password could not be changed'));
                } else {
                    $result = $this->getUsersTable()->changePassword($user);
					\Cake\ORM\TableRegistry::getTableLocator()->get('UserManager.UserProfiles')->query()
					->update()
					->set(['password' => $this->request->getData('password')])
					->where(['user_id' => $user->id])
					->execute();
                    if ($result) {
                        $event = $this->dispatchEvent(Plugin::EVENT_AFTER_CHANGE_PASSWORD, ['user' => $result]);
                        if (!empty($event) && is_array($event->getResult())) {
                            return $this->redirect($event->getResult());
                        }
                        $this->Flash->success(__d('cake_d_c/users', 'Password has been created successfully'));

                        return $this->redirect($redirect);
                    } else {
                        $this->Flash->error(__d('cake_d_c/users', 'Password could not be changed'));
                    }
                }
            } catch (UserNotFoundException $exception) {
                $this->Flash->error(__d('cake_d_c/users', 'User was not found'));
            } catch (WrongPasswordException $wpe) {
                $this->Flash->error($wpe->getMessage());
            } catch (Exception $exception) {
                $this->Flash->error(__d('cake_d_c/users', 'Password could not be changed'));
                $this->log($exception->getMessage());
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * referrals email
     *
     * @return \Cake\Http\Response
     */

    public function referrals()
    {
        $query = $this->Users->Transactions->find();
        $query->select([
                        'total_amount' => $query->func()->sum('amount'),
                        'Transactions.transaction_status',
                        'Transactions.id',
                    ])
            ->where(['Transactions.user_id' => $this->getRequest()->getAttribute('identity')->id, 'Transactions.transaction_type' => 1, 'Transactions.transaction_status' => 1])
            ->group(['Transactions.transaction_status']);
        $transections = $query->all();
        $referrarAmount = 0;
        $pending = 0;
        foreach($transections as $amount){
            if($amount->transaction_status == 1){
                $referrarAmount += $amount->total_amount;
            }
        }

        $this->set(compact('transections', 'pending', 'referrarAmount'));
    }

    /**
     * viewInvitation email
     *
     * @return \Cake\Http\Response
     */

    public function viewInvitation()
    {
        $query = $this->Users->find()
            ->where(['Users.referred_by' => $this->getRequest()->getAttribute('identity')->id]);
        $users = $query->all();

        $this->set(compact('users'));
    }

    /**
     * referrals email
     *
     * @param string $type 'email' or 'password' to validate the user
     * @param string $token token
     * @return \Cake\Http\Response
     */

    public function referral($slug)
    {
        $user = $this->Users->find()->where(['Users.code' => $slug])->first();
        if(!empty($user)){
            $this->response = $this->response->withCookie(new Cookie(
                'referred_by',
                $user->id,
                new DateTime('+2 days'), // expiration time
                '/', // path
                '', // domain
                false, // secure
                true // httponly
            ));

            // $cookie = new Cookie(
            //     'referred_by_new',
            //     $user->id,
            //     new DateTime('+2 days'), // expiration time
            //     '/', // path
            //     '', // domain
            //     false, // secure
            //     true // httponly
            // );

            // $cookies = new CookieCollection([$cookie]);
            // if($cookies->has('referred_by_new')){
            //     $cookie = $cookies->get('referred_by_new');
            //     echo $cookie->getValue();
            //     dump($cookie);
            // }
            // dd($cookies);
        }


        return $this->redirect(['action' => 'register', '?' => ['type' => 'referral']]);
    }

    /**
     * Validates email
     *
     * @param string $type 'email' or 'password' to validate the user
     * @param string $token token
     * @return \Cake\Http\Response
     */
    public function validate($type = null, $token = null)
    {
        try {
            switch ($type) {
                case 'email':
                    try {
                        $result = $this->getUsersTable()->validate($token, 'activateUser');
                        if ($result) {
                            $this->Flash->success(__d('cake_d_c/users', 'User account validated successfully'));
                        } else {
                            $this->Flash->error(__d('cake_d_c/users', 'User account could not be validated'));
                        }
                    } catch (UserAlreadyActiveException $exception) {
                        $this->Flash->error(__d('cake_d_c/users', 'User already active'));
                    }
                    break;
                case 'password':
                    $result = $this->getUsersTable()->validate($token);
                    if (!empty($result)) {
                        $this->Flash->success(__d('cake_d_c/users', 'Your account is verified successfully. You can create password below'));
                        $this->getRequest()->getSession()->write(
                            Configure::read('Users.Key.Session.resetPasswordUserId'),
                            $result->id
                        );

                        return $this->redirect(['action' => 'changePassword']);
                    } else {
                        $this->Flash->error(__d('cake_d_c/users', 'Reset password token could not be validated'));
                    }
                    break;
                default:
                    $this->Flash->error(__d('cake_d_c/users', 'Invalid validation type'));
            }
        } catch (UserNotFoundException $ex) {
            $this->Flash->error(__d('cake_d_c/users', 'Invalid token or user account already validated'));
        } catch (TokenExpiredException $ex) {
            $event = $this->dispatchEvent(Plugin::EVENT_ON_EXPIRED_TOKEN, ['type' => $type]);
            if (!empty($event) && is_array($event->getResult())) {
                return $this->redirect($event->getResult());
            }
            $this->Flash->error(__d('cake_d_c/users', 'Token already expired'));
        }

        return $this->redirect(['action' => 'login']);
    }

    /**
     * Reset password
     *
     * @return void|\Cake\Http\Response
     */
    public function requestResetPassword()
    {
        $this->set('user', $this->getUsersTable()->newEntity([], ['validate' => false]));
        $this->set('_serialize', ['user']);
        if (!$this->getRequest()->is('post')) {
            return;
        }

        $reference = $this->getRequest()->getData('reference');

        $checkActive = $this->Users->find('active')->where(['Users.email' => $reference])->first();
        if(!$checkActive){
            $msg = __d('cake_d_c/users', 'User {0} was not found', $reference);
            $this->Flash->error($msg);
            return $this->redirect(['action' => 'login']);
        }

        try {
            $resetUser = $this->getUsersTable()->resetToken($reference, [
                'expiration' => Configure::read('Users.Token.expiration'),
                'checkActive' => false,
                'sendEmail' => true,
                'ensureActive' => Configure::read('Users.Registration.ensureActive'),
                'type' => 'password',
            ]);
            if ($resetUser) {
                $msg = __d('cake_d_c/users', 'Please check your email to continue with password reset process');
                $this->Flash->success($msg);
            } else {
                $msg = __d('cake_d_c/users', 'The password token could not be generated. Please try again');
                $this->Flash->error($msg);
            }

            return $this->redirect(['action' => 'login']);
        } catch (UserNotFoundException $exception) {
            $this->Flash->error(__d('cake_d_c/users', 'User {0} was not found', $reference));
        } catch (UserNotActiveException $exception) {
            $this->Flash->error(__d('cake_d_c/users', 'The user is not active'));
        } catch (Exception $exception) {
            $this->Flash->error(__d('cake_d_c/users', 'Token could not be reset'));
            $this->log($exception->getMessage());
        }
    }
    /**
     * thankYou method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function thankYou()
    {

    }


    /**
     * sendInvitation method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function sendInvitation()
    {

        if($this->request->getData('emails')){
            $inputEmails = explode(",", $this->request->getData('emails'));
            if(!empty($inputEmails)){
                $invalidEmail = [];
                foreach($inputEmails as $email){
                    if(!empty($email)){
                        if (filter_var(trim($email), FILTER_VALIDATE_EMAIL)) {
                            $user = $this->getRequest()->getAttribute('identity')->getOriginalData()->toArray();
                            $user['INVITATION_LINK'] = \Cake\Routing\Router::url(['controller' => 'Users', 'action' => 'referral','plugin'=>'UserManager', $user['code']], true);
                            $data = [
                                'settings' => [
                                    'setTo' => trim($email),
                                ],
                                'hooks' => 'referral-email',
                                'hooksVars' => $user,
                            ];
                            $queuedJobsTable = \Cake\ORM\TableRegistry::getTableLocator()->get('Queue.QueuedJobs');
                            $queuedJobsTable->createJob('Email', $data, ['listing_id' => $user['listing_id'], 'priority' => 1]);

                        }else{
                            $invalidEmail[] = ['status' => false, 'message' => $email." email is invalid"];
                        }
                    }
                }
                 $result = ['status' => true, 'message' => "Invitation email has sent.", 'errors' => $invalidEmail];
            }else{
                $result = ['status' => false, 'message' => " email is invalid"];
            }
        }

        $this->set([
                'code' => (isset($result['status']) && $result['status'] == true) ? 200 : 422,
                'status' => $result['status'] ?? null,
                'message' => $result['message'] ?? null,
                'errors' => $result['errors'] ?? null,
            ]);
        $this->viewBuilder()->setOption('serialize', ['status', 'code', 'message', 'errors']);

    }

    public function assistant()
    {
        //dd($this->request->getQuery('step'));
        $gradingTypes = $this->Users->GradingTypes->find('list', ['limit' => 200]);
        $boards = $this->Users->Boards->find('list', ['limit' => 200]);
        $subjects = $this->Users->UserProfiles->PrimarySubjects->find('list', ['limit' => 200]);
        if($this->request->getQuery('step') == "grade"){
            $this->set(compact('gradingTypes', 'boards'));
            $this->render('assistant_grade');
        }else if($this->request->getQuery('step') == "subject"){
            $this->set(compact('subjects', 'gradingTypes', 'boards'));
            $this->render('assistant_subject');
        }else if($this->request->getQuery('step') == "learn"){

            $teacherSchedules = $this->Users->TeacherSchedules->find('list', ['limit' => 200]);

            $this->set(compact('subjects', 'gradingTypes', 'boards', 'teacherSchedules'));
            $this->render('assistant_learn');

        }
    }

    public function teachers()
    {
        $gradingTypes = $this->Users->GradingTypes->find('list', ['limit' => 200]);
        $boards = $this->Users->Boards->find('list', ['limit' => 200]);
        $subjects = $this->Users->UserProfiles->PrimarySubjects->find('list', ['limit' => 200]);
        $teacherSchedules = $this->Users->TeacherSchedules->find('list', ['limit' => 200]);
        $schedules = [];
        foreach($teacherSchedules as $id => $teacherSchedule)  {
            $schedules[] = ['text' => $teacherSchedule, 'value' => $id, 'class' => 'D-checkbox'];
        }
        //dd($schedules);
        $this->set(compact('subjects', 'gradingTypes', 'boards', 'schedules'));
    }

    /**
     * loadTeachers method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function loadTeachers()
    {
        //dd($this->request->getQuery());
        $query = $this->Users->find('teacher');
        $query->find('board', ['boards' => $this->request->getQuery('boards')]);
        $query->find('grad', ['grads' => $this->request->getQuery('grading_types')]);
        $query->find('subject', ['subjects' => $this->request->getQuery('subjects')]);
        $query->find('bySchedule', ['teacher_schedules' => $this->request->getQuery('teacher_schedules')]);
        $query->contain(['UserProfiles', 'GradingTypes', 'Boards', 'UserProfiles.PrimarySubjects', 'UserProfiles.SecondarySubjects']);
        $query->leftJoinWith('Reviews', function($q){
            return $q;
        });
        $query->group(['Users.id'])->enableAutoFields(true);
        $query->select(['avg_rating' => $query->func()->avg('Reviews.rating'), 'total_rating' => $query->func()->count('Reviews.id')]);
        $query->distinct("Users.id");
        if($this->request->getQuery('rating') == 1){
            $query->order(['avg_rating' => 'DESC']);
        }else if($this->request->getQuery('rating') == 1){
            $query->order(['avg_rating' => 'ASC']);
        }else{
            $query->order(['Users.id' => 'DESC']);
        }

        //$options['order'] = ['Users.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $users = $this->paginate($query);
        $this->set(compact('users'));
    }

    /**
     * getReviews method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function getReviews($user_id)
    {
        $reviews = $this->Users->Reviews->find()->where(['Reviews.user_id' => $user_id])->all();

        $avgSum = 0;
        $avg = 0;
        foreach($reviews as $ar){
            $avgSum += $ar->rating;
        }

        $avg = $avgSum / $reviews->count();

        $this->set(compact('reviews', 'avg'));

    }


    /**
     * session method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function session($user_id)
    {
        $user = $this->Users->get($user_id, [
            'contain' => ['UserProfiles', 'GradingTypes', 'Languages', 'UserProfiles.Locations', 'TeacherSchedules', 'Boards', 'UserDocuments'],
        ]);
        $subjects = $this->Users->UserProfiles->PrimarySubjects->find('list', ['limit' => 200]);
        $gradingTypes = $this->Users->GradingTypes->find('list', ['limit' => 200]);
        $teacherSchedules = $this->Users->TeacherSchedules->find('list', ['limit' => 200])
        ->matching("Users", function($q) use($user_id){
            return $q->where(['Users.id' => $user_id]);
        });
        $boards = $this->Users->Boards->find('list', ['limit' => 200]);
        $this->set(compact('user', 'subjects', 'gradingTypes', 'teacherSchedules', 'boards'));
    }

	public function phoneVerification($id)
	{
		$userProfile = $this->Users->UserProfiles->get($id, [
            'contain' => [],
        ]);
        $this->set(compact('userProfile'));
	}

	public function sendPhoneVerifyOtp()
    {
		$event = new Event('Users.User.beforeRegistration', $this, ['user' => $this->request->getData()]);
        //print_r($event);
		$this->getEventManager()->dispatch($event);

		$result = ['status' => true, 'message' => __('OTP has sent.')];
		echo json_encode($result);
		die;
        // if($id){
             // $userProfile = $this->Users->UserProfiles->get($id, [
                // 'contain' => [],
            // ]);
        // }else{
            // $userProfile = $this->Users->UserProfiles->newEmptyEntity();
        // }

        // $data['mobile'] = $this->request->getData('mobile');
        // if($userProfile->mobile != $this->request->getData('mobile')){
            // $data['is_mobile_verified'] = NULL;
        // }
        // $data['sms_otp'] = NULL;
        // $userProfile = $this->Users->UserProfiles->patchEntity($userProfile, $data);
        // $is_changed = false;
        // if($userProfile->isDirty('mobile') || $userProfile->isDirty('sms_otp')){
            // $is_changed = true;
        // }
        // if ($this->Users->UserProfiles->save($userProfile)) {
			 // $this->Flash->success(__('The mobile has been updated.'));
			 // return $this->redirect(['controller' => 'Users','action' => 'phone-verification-otp', $id]);
		// } else {
			// $this->Flash->error(__('The mobile could not be updated. Please, try again.'));
			// return $this->redirect(['controller' => 'Users','action' => 'phone-verification', $id]);
		// }
    }
	public function phoneVerificationOtp($id)
	{
		$userProfile = $this->Users->UserProfiles->get($id, [
            'contain' => [],
        ]);
        $this->set(compact('userProfile'));
	}
	public function getPhoneVerificationOtp($id = null)
    {
        $userProfile = $this->Users->UserProfiles->get($id, [
            'contain' => [],
        ]);
        if($this->request->getData('reset_otp') && $this->request->getData('reset_otp') == true){
            $event = new Event('Users.User.afterChangeMobile', $this, ['user' => $userProfile->toArray()]);
            $this->getEventManager()->dispatch($event);
			$this->Flash->success(__('OTP has sent again.'));
			return $this->redirect(['controller' => 'Users','action' => 'phone-verification', $id]);
        }else{
            $otp = $this->request->getData('otp') ? implode("", $this->request->getData('otp')) : null;
            if($this->request->getData('otp') && $userProfile->sms_otp == $otp){
                $data['is_mobile_verified'] = 1;
                $data['sms_otp'] = NULL;
                $userProfile = $this->Users->UserProfiles->patchEntity($userProfile, $data);
                if ($this->Users->UserProfiles->save($userProfile)) {
						$this->Flash->success(__('The mobile number has verified.'));
						return $this->redirect(['action' => 'login']);
                    } else {
						$this->Flash->error(__('The mobile could not be updated. Please, try again.'));
						return $this->redirect(['controller' => 'Users','action' => 'phone-verification', $id]);
                    }
            }else{
				$this->Flash->error(__('Invalid OTP. Please try again.'));
				return $this->redirect(['controller' => 'Users','action' => 'phone-verification', $id]);
            }
        }
    }

	public function verifyOtp()
	{
		$data = $this->request->getData();
		$otp = "";
		if(!empty($data['otp'])) {
			$otp = implode("",$data['otp']);
		}
		$userProfile = $this->Users->UserProfiles->find()->contain(['Users'])->where(['UserProfiles.sms_otp' => $otp,'UserProfiles.mobile' => $data['username']])->first();
		if($userProfile) {
			$data['password'] = $userProfile->password;
			$data['username'] = $userProfile->user->username;
			$data['status'] = 1;
		} else {
			$data['status'] = 0;
		}
		echo json_encode($data);
		die;
	}

    public function checkMobileNumber()
    {
        $data = $this->request->getData();
        $userProfile = $this->Users->UserProfiles->find()->contain(['Users'])->where(['UserProfiles.mobile' => $data['mobile']])->first();
        if($userProfile) {
            echo  1;
        } else {
            echo  0;
        }
        die;
    }
}
