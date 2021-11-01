<?php
declare(strict_types=1);

namespace AdminUserManager\Controller\Admin;

use AdminUserManager\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Filesystem\File;
use Cake\ORM\TableRegistry;
use Cake\Mailer\MailerAwareTrait;

/**
 * AdminUsers Controller
 *
 * @property \AdminUserManager\Model\Table\AdminUsersTable $AdminUsers
 * @method \AdminUserManager\Model\Entity\AdminUser[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AdminUsersController extends AppController
{

    use MailerAwareTrait;

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['login', 'cropper', 'createPassword', 'forgotPassword', 'passwordreset']);
    }

    /**
     * login method
     * @param request.
     * @return \Cake\Http\Response|null|void Redirects on successful login dashboard, renders login view otherwise.
     */
    public function login()
    {
        $this->Authorization->skipAuthorization();

        if ($this->request->getQuery('status')) {
            $result = $this->Authentication->getResult();
            if ($result->isValid()) {
                $this->Authentication->logout();
            }
        }

        //echo (new DefaultPasswordHasher)->hash('123456');die;
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        //dd($result);
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            // redirect to /articles after login success

            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'Dashboards',
                'action' => 'index',
            ]);
            //dd($redirect);

            return $this->redirect($redirect);
        }
        // display error if user submitted and authentication failed
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid username or password'), ['plugin' => 'CustomTheme']);
        }
}

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->AdminUsers->find('domain');
        //$query->contain(['Listings']);
        $options['order'] = ['AdminUsers.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $this->Authorization->authorize($query); 
        $adminUsers = $this->paginate($this->Authorization->applyScope($query));
        $this->set(compact('adminUsers'));

    }

    /**
     * View method
     *
     * @param string|null $id Admin User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $adminUser = $this->AdminUsers->get($id, [
            'contain' => ['Listings', 'Roles'],
            'finder' => 'domain'
        ]);

        $this->set(compact('adminUser'));
    }

    /**
     * cropper method
     *
     * @param string|null $id Admin User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function cropper()
    {
        $this->Authorization->skipAuthorization();
    }


    /**
     * Add/Edit method
     * Edit: param string|null $id Admin User id.
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function add($id = null)
    {
        if($id){
            $adminUser = $this->AdminUsers->get($id, [
                'contain' => ['Roles'],
                'finder' => 'Auth'
            ]);
        }else{
            $adminUser = $this->AdminUsers->newEmptyEntity();
        }
        $this->Authorization->authorize($adminUser, 'create');
        if ($this->request->is(['patch', 'post', 'put'])) {

            if($this->request->getData('base64img')){
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
            $adminUser = $this->AdminUsers->patchEntity($adminUser, $this->request->getData());
            //dd($adminUser->getErrors());

            if ($this->AdminUsers->save($adminUser)) {

                if($this->Authentication->getIdentity()->id == $adminUser->id){
                    $this->Authentication->setIdentity($adminUser);
                }
                 
                $this->Flash->success(__('The admin user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The admin user could not be saved. Please, try again.'));
        }
       // dd($adminUser->getErrors());
        $roles = $this->AdminUsers->Roles->find('list', ['limit' => 200])->find('domain');
        $this->set(compact('adminUser', 'roles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Admin User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $adminUser = $this->AdminUsers->get($id, [
            'contain' => ['Roles'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $adminUser = $this->AdminUsers->patchEntity($adminUser, $this->request->getData());
            if ($this->AdminUsers->save($adminUser)) {
                $this->Flash->success(__('The admin user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The admin user could not be saved. Please, try again.'));
        }
        $listings = $this->AdminUsers->Listings->find('list', ['limit' => 200]);
        $roles = $this->AdminUsers->Roles->find('list', ['limit' => 200]);
        $this->set(compact('adminUser', 'listings', 'roles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Admin User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    // public function delete($id = null)
    // {
    //     $this->request->allowMethod(['post', 'delete']);
    //     $adminUser = $this->AdminUsers->get($id);
    //     if ($this->AdminUsers->delete($adminUser)) {
    //         $this->Flash->success(__('The admin user has been deleted.'));
    //     } else {
    //         $this->Flash->error(__('The admin user could not be deleted. Please, try again.'));
    //     }

    //     return $this->redirect(['action' => 'index']);
    // }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $adminUser = $this->AdminUsers->get($id);
        if ($this->AdminUsers->delete($adminUser)) {
            $result = ['status' => true, 'message' => __('The admin user has been deleted.')];
        } else {
            $result = ['status' => false, 'message' => __('The admin user could not be deleted. Please, try again.')];
        }

        $this->set([
            'code' => (isset($result['status']) && $result['status'] == true) ? 200 : 422,
            'status' => $result['status'] ?? null,
            'message' => $result['message'] ?? null,
            'data' => $adminUser,
            'errors' => $result['errors'] ?? null,
            ]);
        $this->viewBuilder()->setOption('serialize', ['status', 'code','message','data', 'errors']);
    }

    /**
     * changePassword method
     *
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
     public function changePassword()
    {
        $adminUser = $this->AdminUsers->get($this->Authentication->getIdentity()->id);
        if ($this->request->is(['post', 'patch', 'put'])) {
            $adminUser = $this->AdminUsers->patchEntity($adminUser, $this->request->getData(), ['validate' => 'password']);
            if ($this->AdminUsers->save($adminUser)) {
                $this->Flash->success('The password is successfully changed');
                $this->redirect($this->referer());
            } else {
                $this->Flash->error('The password could not be saved. Please, try again!');
            }
        } $this->set('adminUser', $adminUser);
    }

    /**
     * forgotPassword method
     *
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
     public function forgotPassword()
    {
        if ($this->request->is('post')) {

            $result = $this->AdminUsers->find('domain')->where(['email' => $this->request->getData('email'), 'AdminUsers.status' => 1, 'AdminUsers.is_verified' => 1])->first();
            if (!empty($result)) {
                $uid = \Cake\Utility\Text::uuid();
                $data = $result->toArray();
                $uinfo = $data;
                $uinfo['USER_NAME'] = $data['name'];
                $uinfo['USER_RESET_LINK'] = \Cake\Routing\Router::url(['controller' => 'AdminUsers', 'action' => 'passwordreset','plugin'=>'AdminUserManager',$uid], true);
                $_usertoken = TableRegistry::getTableLocator()->get('UserTokens')->newEmptyEntity();
                $_usertoken->user_id = $data['id'];
                $_usertoken->user_type = 'admin_users';
                $_usertoken->token_type = 'forgot-password'; 
                $_usertoken->token = $uid;
                TableRegistry::getTableLocator()->get('UserTokens')->save($_usertoken);
                $data = [
                    'settings' => [
                        'setTo' => $data['email'],
                    ],
                    'hooks' => 'forgot-password-email',
                    'hooksVars' => $uinfo,
                ];
                $this->getMailer('Manu')->send('queueMail',[$data]);
                //TableRegistry::getTableLocator()->get('Queue.QueuedJobs')->createJob('Email', $data);
                $this->Flash->success(__('Your password reset link has been sent to your email!'));
                return $this->redirect(['action' => 'forgot']);
            } else {
                $this->Flash->error(__('This email address does not exist in database.!'));
            }
        }
    }

    /**
     * Verifyaccount & Create password method
     *
     * @param string|null token Adminuser token.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function createPassword($token = null)
    {
        $this->Authorization->skipAuthorization();
         if (!$token) {
            return $this->redirect(['action' => 'login']);
        }

        $UserTokens = TableRegistry::getTableLocator()->get('UserTokens');
        $query = $UserTokens->find('token', ['token' => $token, 'user_type' => 'admin_users', 'token_type' => 'create-password']);
        $res = $query->first();
        if (empty($res)) {
            $this->Flash->error(__('Your token has expired.!'));
            return $this->redirect(['action' => 'login']);
        }
        $adminUser = $this->AdminUsers->get($res->user_id);
        if ($this->request->is(['post', 'put'])) {
            $adminUser->password = $this->request->getData('password');
            $adminUser->is_verified = 1;
            $adminUser = $this->AdminUsers->patchEntity($adminUser, $this->request->getData(), ['validate' => 'resetpassword']);
            if ($this->AdminUsers->save($adminUser)) {
                $result = $this->Authentication->getResult();
                if ($result->isValid()) {
                    $this->Authentication->logout();
                }
                $tokenq = $UserTokens->query()->delete()->where(['id' => $res->id])->execute();
                $this->Flash->success(__('Your password created successfully.'));
                return $this->redirect(['action' => 'login', '?' => ['status' => 1]]);
            }else{
                $this->Flash->error(__('The password could not be created. Please, try again.'));
            }
        }
        $this->set(compact('adminUser'));
        $this->set('_serialize', ['adminUser']);
    }

    public function passwordreset($token = null)
    {
        if (!$token) {
            return $this->redirect(['action' => 'login']);
        }
        $UserTokens = TableRegistry::get('UserTokens');
        $query = $UserTokens->find('token', ['token' => $token, 'user_type' => 'admin_users', 'token_type' => 'forgot-password']);
        $res = $query->first();
        if (empty($res)) {
            $this->Flash->error(__('Your token has expired.!'));
            return $this->redirect(['action' => 'createPassword']);
        }
        $adminUser = $this->AdminUsers->get($res->user_id);
        if ($this->request->is(['post', 'put'])) {
            $adminUser->id = $res->user_id;
            $adminUser->password = $this->request->getData('password');
            $adminUser->confirm_password = $this->request->getData('confirm_password');
            $adminUser = $this->AdminUsers->patchEntity($adminUser, $this->request->getData(), ['validate' => 'resetpassword']);
            if ($this->AdminUsers->save($adminUser)) {
                $tokenq = $UserTokens->query()->delete()->where(['id' => $res->id])->execute();
                $this->Flash->success(__('Your password has changed.'));
                return $this->redirect(['action' => 'login', '?' => ['status' => 1]]);
            }
        }
        $this->set(compact('adminUser'));
        $this->set('_serialize', ['adminUser']);
    }


    /**
     * Listings method
     *
     * @param [] session.
     * @return \Cake\Http\Response|null|void Redirects to login page.
     */
    public function listings(){

        $yearReport = array_combine(array_values(\Cake\Core\Configure::read('constants.MONTHS')), [20,120,430,300,64,800,150,50,10,0,0,0]);
        $this->set([
            'message' => "Done",
            'data' => $yearReport,
        ]);
        $this->viewBuilder()->setOption('serialize', ['data', 'message']);
    }


    /**
     * Unpaid method
     *
     * @param [] session.
     * @return \Cake\Http\Response|null|void Redirects to login page.
     */
    public function unpaid(){

        $yearReport = array_combine(array_values(\Cake\Core\Configure::read('constants.MONTHS')), [0,2000,700,10000,8000,800,5000,7000,600,15000,0,350]);
        $this->set([
            'message' => "Done",
            'data' => $yearReport,
        ]);
        $this->viewBuilder()->setOption('serialize', ['data', 'message']);
    }

    /**
     * Logout method
     *
     * @param [] session.
     * @return \Cake\Http\Response|null|void Redirects to login page.
     */
    public function logout()
    {
        $this->Authorization->skipAuthorization();
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'AdminUsers', 'action' => 'login']);
        }
    }


}
