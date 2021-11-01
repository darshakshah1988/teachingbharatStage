<?php
declare(strict_types=1);

namespace MicroSessions\Controller;
use MicroSessions\Controller\AppController;
use Cake\ORM\TableRegistry;


/**
 * MicroSessions Controller
 *
 *
 * @method \MicroSessions\Model\Entity\MicroSession[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MicroSessionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
       /* $query = $this->MicroSessions;
        $query->contain(['GradingTypes', 'Subjects']);
        $query->where(['MicroSessions.user_id' => $this->getRequest()->getAttribute('identity')->id]);
        $options['order'] = ['MicroSessions.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $microSessions = $this->paginate($query);*/


        $user_email = @$this->getRequest()->getAttribute('identity')->email;
       //  echo $user_email;
      //   die();
        $isSuperuser = @$this->getRequest()->getAttribute('identity')->is_superuser;
		if($isSuperuser == 1){
              return $this->redirect(['action' => 'teacher']);
         }else{
        $user_id=$this->getRequest()->getAttribute('identity')->id;
        $microSessions = $this->MicroSessions->find('all', [
        'conditions'=>["MicroSessions.user_id = '".$user_id."' "]]);
         $microSessions->contain(['Subjects']);
        $microSessions = $this->paginate($microSessions);
        $this->set(compact('microSessions'));
         }


    }

    public function teachersmicrosessions( )
    {
        $session = $this->request->getSession();
        $user_id=$session->read('teacher_session_id');
        $microSessions = $this->MicroSessions->find('all', [
        'conditions'=>["MicroSessions.user_id = '".$user_id."' "]]);
        $microSessions = $this->paginate($microSessions);
        $this->set(compact('microSessions'));
    }

    /**
     * View method
     *
     * @param string|null $id Micro Session id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    /*public function view($id = null)
    {
        $microSession = $this->MicroSessions->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('microSession'));
    }*/

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
          if($id){
           $microSession = $this->MicroSessions->get($id, [
            'contain' => [],
        ]);
        }else{
            $microSession = $this->MicroSessions->newEmptyEntity();
        }

         $session = $this->request->getSession();
         $user_id=$session->read('teacher_session_id');
       if ($this->request->is(['patch', 'post', 'put'])) {

            $microSession = $this->MicroSessions->patchEntity($microSession, $this->request->getData());
			if($user_id!='')
            {
              $microSession->user_id= $user_id;
            }
            else{
                $microSession->user_id = $this->getRequest()->getAttribute('identity')->id;
            }
             $microSession->listing_id = $this->getRequest()->getAttribute('identity')->listing_id;

             //echo "<pre>";
            // print_r($this->request->getData());
           //  print_r($microSession);
            // die();

            if ($this->MicroSessions->save($microSession)) {
                $this->Flash->success(__('The micro session has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The micro session could not be saved. Please, try again.'));
        }
		$listings = $this->MicroSessions->Listings->find('list', ['limit' => 200]);
        $gradingTypes = $this->MicroSessions->GradingTypes->find('list', ['limit' => 200]);
		$boards = $this->MicroSessions->Boards->find('list', ['limit' => 200]);
        $subjects = $this->MicroSessions->Subjects->find('list', ['limit' => 200]);
        $packages = $this->MicroSessions->Packages->find('list', [
    'keyField' => 'id',
    'valueField' => 'package_name'
]);
        $plans = $this->MicroSessions->Plans->find('list', [
    'keyField' => 'id',
    'valueField' => 'plan_name'
]);
		$this->set(compact('microSession', 'listings', 'gradingTypes', 'boards', 'subjects','packages','plans'));

    }

public function getPlans($package_id=null){

  $allPlans = $this->MicroSessions->Plans->find('list', [
                'keyField' => 'id',
                'valueField' => 'plan_name',
                'conditions'=>["Plans.package_id =".$package_id]
                ]);


   return $this->response
    ->withType('application/json')
    ->withStringBody(json_encode([
      'allPlans' => $allPlans
    ]));
}
    /**
     * Edit method
     *
     * @param string|null $id Micro Session id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $microSession = $this->MicroSessions->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $microSession = $this->MicroSessions->patchEntity($microSession, $this->request->getData());
            //dd($microSession); die;
            if ($this->MicroSessions->save($microSession)) {
                $this->Flash->success(__('The micro session has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The micro session could not be saved. Please, try again.'));
        }
        $gradingTypes = $this->MicroSessions->GradingTypes->find('list', ['limit' => 200]);

        $boards = $this->MicroSessions->Boards->find('list', ['limit' => 200]);
        $subjects = $this->MicroSessions->Subjects->find('list', ['limit' => 200]);
        $this->set(compact('microSession',  'gradingTypes', 'boards', 'subjects'));
    }


/**
     * View method
     *
     * @param string|null $id Course id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {

        $query = $this->MicroSessions->find()->where(['MicroSessions.id' => $id]);
        $query->contain(['GradingTypes', 'Subjects', 'Boards']);
        $microSession = $query->firstOrFail();
        $this->set(compact('microSession'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Micro Session id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

       $microSession = $this->MicroSessions->get($id);
       $this->MicroSessions->delete($microSession);
       $result = ['status' => true, 'message' => __('The micro session has been deleted.')];

        // if ($this->MicroSessions->delete($microSession)) {
        //    echo "fsdfsfsd";
        //     die();
        //     $result = ['status' => true, 'message' => __('The micro session has been deleted.')];
        //     } else {
        //         $result = ['status' => false, 'message' => __('The micro session could not be deleted. Please, try again.')];
        //     }
            $this->set([
                        'code' => (isset($result['status']) && $result['status'] == true) ? 200 : 422,
                        'status' => $result['status'] ?? null,
                        'message' => $result['message'] ?? null,
                        'data' => $microSession,
                        'errors' => $result['errors'] ?? null,
                        ]);
                    $this->viewBuilder()->setOption('serialize', ['status', 'code','message','data', 'errors']);
    }
    public function landing($sessionID = NULL){
        $teacher_session_id = $sessionID;
        if(!empty($sessionID)){
            $microSessions = $this->MicroSessions->find('all', [
            'conditions'=>["MicroSessions.user_id = '".$sessionID."'"]]);
            $microSessions = $this->paginate($microSessions);

        }else{
            $microSessions = $this->paginate($this->MicroSessions);
        }

        $gradingTypes = $this->MicroSessions->GradingTypes->find('list', ['limit' => 200]);
        $subjects = $this->MicroSessions->Subjects->find('list', ['limit' => 200]);
        $boards = $this->MicroSessions->Boards->find('list', ['limit' => 200]);
        $this->set(compact('microSessions','gradingTypes','subjects','boards','teacher_session_id'));
    }

    public function microsessionDetails($id = null){


        $query = $this->MicroSessions->find()->where(['MicroSessions.id' => $id]);
        $query->contain(['GradingTypes', 'Subjects', 'Boards', 'MicroSessionChapters']);
        $query->select(['total_chapters' => $query->func()->count('MicroSessionChapters.id'), 'avg_rating' => $query->func()->avg('rating')]);
        $query->leftJoinWith('MicroSessionChapters', function($q){
            return $q;
        });
        $query->leftJoinWith('Reviews', function($q){
            return $q;
        });

        $query->group(['MicroSessions.id'])->enableAutoFields(true);

        $query->contain(['Users' => function($q){

            return $q;

        }

    ]);
        $query->contain(['UserProfiles' => function($q){

            return $q;

        }

    ]);



        $microDetails = $query->firstOrFail();
      //  dd($course);
        $totalmicroDetails = $this->MicroSessions->find()->where(['MicroSessions.user_id' => $microDetails->user_id])->count();
         $this->loadModel('Courses');
        $query = $this->Courses->find();

        //$query->contain(['Subjects']);
        $query->limit(2);
        $courses = $this->paginate($query);


        $this->loadModel('Reviews');
        $teacher_rating = $this->Reviews->find()->where(['Reviews.user_id' => $microDetails->user_id, 'Reviews.status' => 1])->all();


         $this->loadModel('UserProfiles');
        $query = $this->UserProfiles->find()->where(['UserProfiles.user_id' => $microDetails->user_id]);
        $query->limit(1);
        $teacher_profile = $this->paginate($query)->first();

        $this->loadModel('Orders');
        $alreadyPurchased = 0;
        if(isset($this->getRequest()->getAttribute('identity')->id)){
            $userID = $this->getRequest()->getAttribute('identity')->id;
            $alreadyPurchased = $this->Orders->find()->where(['Orders.user_id' => $userID, 'Orders.micro_session_id' => $microDetails->id])->count();
        }

        // echo "<pre>";
        // print_r($microDetails);
        // die();

        $this->set(compact('microDetails', 'totalmicroDetails','courses','teacher_rating','teacher_profile', 'alreadyPurchased'));


    }

// @ teacher List
    public function teacher(){
        $this->loadModel('Users');
        $query = $this->Users->find('all', [
        'conditions'=>["Users.role = 'teacher' and is_superuser != 1"]]);
        $teacher = $this->paginate($query);
        //$alert_statuses  = array();
        //foreach($lists as $list) {
             //$teacher[$list->id] = $list->username;
        //}
        //echo "<pre>";
       //print_r($teacher);
       //die();
        $this->set(compact('teacher'));
    }


  public function teachersession($sessionid=null)
  {

         //"teacher_microsessiosn"
    $session = $this->request->getSession();
    $session->write('teacher_session_id', $sessionid);
    // $user_id=$session->read('teacher_session_id');
    // $microSessions = $this->MicroSessions->find('all', [
    //     'conditions'=>["MicroSessions.user_id = ".$user_id]]);

    // $microSessions = $this->paginate($this->MicroSessions);
    // print_r($microSessions);
    // die();
    // $this->set(compact('microSessions'));

    return $this->redirect(['action' => 'teachersmicrosessions']);


  }
 /**
     * getCourses method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function getCourses($sessionID = NULL)
    {
        //dd($this->request->getQuery());
       // $query = $this->MicroSessions->find('microsession')->find('filter', ['keyword' => $this->request->getQuery('keyword')]);
        $query = $this->MicroSessions->find('all');
        $query->find('board', ['boards' => $this->request->getQuery('boards')]);
        $query->find('grad', ['grads' => $this->request->getQuery('grading_types')]);
        $query->find('subject', ['subjects' => $this->request->getQuery('subjects')]);
        $query->contain(['GradingTypes', 'Boards', 'Subjects', 'MicroSessionChapters']);
      //  $query->select(['total_chapters' => $query->func()->count('MicroSessionChapter.id')]);
        // $query->leftJoinWith('MicroSessionChapter', function($q){
        //     return $q;
        // })->group(['MicroSessions.id'])->enableAutoFields(true);
        if(!empty($sessionID)){
            $query->where(['MicroSessions.user_id' => $sessionID, 'MicroSessions.status' => 1,'MicroSessions.package_id' => 0]);
        }else{
            $query->where(['MicroSessions.status' => 1,'MicroSessions.package_id' => 0]);
        }

        $options['order'] = ['MicroSessions.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $courses = $this->paginate($query);
        // echo "<pre>";
        // print_r($courses);
        // die();
       // dd($courses);
        $gradingTypes = $this->MicroSessions->GradingTypes->find('list', ['limit' => 200]);

        $boards = $this->MicroSessions->Boards->find('list', ['limit' => 200]);
        $subjects = $this->MicroSessions->Subjects->find('list', ['limit' => 200]);
        $this->set(compact('courses', 'gradingTypes', 'boards', 'subjects'));
    }


/**
     * buyNow method
     *
     * @param string|null $id Course id.
     * @return \Cake\Http\Response|null|void Renders buyNow
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function buyNow($id = null)
    {
        //echo $id; die;
        $query = $this->MicroSessions->find()->where(['MicroSessions.id' => $id]);
        $query->contain([ 'GradingTypes',  'Subjects', 'Boards']);
       // $query->select(['total_chapters' => $query->func()->count('CourseChapters.id')]);
        //$query->leftJoinWith('MicroSessionChapters', function($q){
          //  return $q;
        //})->group(['MicroSessions.id'])->enableAutoFields(true);
        $microSessions = $query->firstOrFail();

        if($this->getRequest()->getAttribute('identity')->id == $microSessions->user_id){

            $this->Flash->alertWarning('You can\'t able to buy your self microsessios.');
            return $this->redirect(['action' => 'microsessionDetails', $id]);
        }
        $exist = $this->MicroSessions->Carts->find()->where(['Carts.user_id' => $this->getRequest()->getAttribute('identity')->id, 'Carts.micro_session_id' => $id])->count();
       // dd($exist); die;
        if($exist == 0){
            $itemdata['sessionId'] = $this->request->getSession()->id();
            $itemdata['user_id'] = $this->getRequest()->getAttribute('identity')->id;
            $itemdata['micro_session_id'] = $id;
            $itemdata['quantity'] = 1;
            $cart = $this->MicroSessions->Carts->newEmptyEntity();
            $cart = $this->MicroSessions->Carts->patchEntity($cart, $itemdata);

             //dd($cart); die;
            if ($this->MicroSessions->Carts->save($cart)) {
                $this->Flash->success(__('This MicroSessions course has added in cart.'));
          return $this->redirect(['plugin' => 'Orders','controller' => 'Carts','action' => 'microsession', $id]);
            }else{
                return $this->redirect(['action' => 'microsessionDetails', $id]);
            }
        }else{
            return $this->redirect(['controller' => 'Carts','action' => 'microsession', $id, 'plugin' => 'Orders']);
        }


        $this->set(compact('microSessions'));
    }


/**
     * buyNow method
     *
     * @param string|null $id Course id.
     * @return \Cake\Http\Response|null|void Renders buyNow
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function buypackage($package_id = null,$plan_id = null)
    {

         $pkgquery = $this->MicroSessions->Packages->find()->where(['Packages.id' => $package_id]);
         $pkgquery->contain([ 'GradingTypes',  'Subjects', 'Boards']);
         $getpackage = $pkgquery->firstOrFail();

         $plnquery = $this->MicroSessions->Plans->find()->where(['Plans.id' => $plan_id]);
         $getPlans = $plnquery->firstOrFail();

        $exist = $this->MicroSessions->Carts->find()->where(['Carts.user_id' => $this->getRequest()->getAttribute('identity')->id, 'Carts.package_id' => $package_id, 'Carts.plan_id' => $plan_id])->count();
       // dd($exist); die;
        if($exist == 0){
            $itemdata['sessionId'] = $this->request->getSession()->id();
            $itemdata['user_id'] = $this->getRequest()->getAttribute('identity')->id;
            $itemdata['package_id'] = $package_id;
            $itemdata['plan_id'] = $plan_id;
            $itemdata['quantity'] = 1;
            $cart = $this->MicroSessions->Carts->newEmptyEntity();
            $cart = $this->MicroSessions->Carts->patchEntity($cart, $itemdata);

            // dd($cart); die;
            if ($this->MicroSessions->Carts->save($cart)) {
                $this->Flash->success(__('This Packages has added in cart.'));
          return $this->redirect(['plugin' => 'Orders','controller' => 'Carts','action' => 'packages',$package_id,$plan_id]);
            }else{
                return $this->redirect(['action' => 'packagedetails', $package_id]);
            }
        }else{
             //dd("sfdsd"); die;
            return $this->redirect(['controller' => 'Carts','action' => 'packages', $package_id,$plan_id, 'plugin' => 'Orders']);
        }


        $this->set(compact('microSessions'));
    }

    // front end plan page ##############
    public function packagedetails($package_id=null){

  //  Packages ###############################################//
    $query = $this->MicroSessions->Packages->find()->where(['Packages.id' => $package_id]);
   // $allpackages = $query->firstOrFail();

    $allpackages = $this->paginate($query);

    //  Plans ###############################################//

    $queryplans = $this->MicroSessions->Plans->find()->where(['Plans.package_id' => $package_id]);

    $allplans = $this->paginate($queryplans);

 // Teachers ####################################

        $this->loadModel('Users');
        $query = $this->Users->find('all', [
        'conditions'=>["Users.active = 1 and Users.role = 'teacher' and is_superuser != 1 "]]);
        $user=$query->contain(['UserProfiles']);

        $teacher = $this->paginate($query);

    /* echo "<pre>";
    print_r($teacher);
    //echo '>>>'.$allpackages->package_name;
    die;*/

        $this->set(compact('teacher','user','allpackages','allplans','package_id'));

    }

 // front end plan page ##############
    public function packages(){

  //  Packages ###############################################//
    $query = $this->MicroSessions->Packages->find()->where(['Packages.user_id' => $this->getRequest()->getAttribute('identity')->id]);
   // $allpackages = $query->firstOrFail();

    $allpackages = $this->paginate($query);

    //  Plans ###############################################//

    $queryplans = $this->MicroSessions->Plans->find()->where(['Plans.user_id' => $this->getRequest()->getAttribute('identity')->id]);

    $allplans = $this->paginate($queryplans);

 // Teachers ####################################

        $this->loadModel('Users');
        $query = $this->Users->find('all', [
        'conditions'=>["Users.role = 'teacher' and is_superuser != 1"]]);
        $user=$query->contain(['UserProfiles']);

        $teacher = $this->paginate($query);

    /* echo "<pre>";
    print_r($teacher);
    //echo '>>>'.$allpackages->package_name;
    die;*/

        $this->set(compact('teacher','user','allpackages','allplans'));
    }

 // added for package subject

    public function getPackagesub($subject_id = null)
    {
            $allPackages = $this->MicroSessions->Packages->find('list', [
            'keyField' => 'id',
            'valueField' => 'package_name',
            'conditions'=>["Packages.subject_id =".$subject_id]
            ]);


            return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode([
            'allPackages' => $allPackages
            ]));

    }



  public function getPackage($package_id = null)
    {
            $allPlans = $this->MicroSessions->Packages->find('list', [
            'keyField' => 'id',
            'valueField' => 'plan_name',
            'conditions'=>["Plans.package_id =".$package_id]
            ]);


            return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode([
            'allPlans' => $allPlans
            ]));

    }
    public function getPlan($plan_id = null)
        {
            $getPlans = $this->MicroSessions->Plans->find('first', [
            'keyField' => 'id',
            'valueField' => 'plan_name',
            'conditions'=>["Plans.package_id =".$plan_id]
            ]);


            return $this->response
            ->withType('application/json')
            ->withStringBody(json_encode([
            'allPlans' => $getPlans
            ]));
        }


// front end Student Subscription ##############

    public function subscriptiondetails()
    {




    }

// front end schedule course ##############

public function schedulecourse($micorsession_id=null)
    {
        $query = $this->MicroSessions->find();
        $query->where(['MicroSessions.id' => $micorsession_id]);
        $query->contain(['MicroSessionChapters','Users']);
        $microDetails = $query->firstOrFail();

    // echo "<pre>";
    // print_r($microDetails);
    // die;
        $this->set(compact('microDetails'));
    }



// front end My Calendar ##############

    public function mycalendar()
    {
      $this->loadModel('Orders');
     if($this->getRequest()->getAttribute('identity')->role == "teacher"){
             $query = $this->Orders->find('all')->select(['micro_sessions.id','micro_session_chapters.id','micro_session_chapters.title','micro_session_chapters.start_time','micro_session_chapters.start_date','micro_session_chapters.end_date','micro_session_chapters.end_time'])
        ->select($this->Orders)
            ->where("micro_sessions.user_id = '".$this->getRequest()->getAttribute('identity')->id."'")
        ->where("order_courses.micro_session_id != '' ")
        ->join([
            'order_courses' => [
                'table' => 'order_courses',
                'type' => 'LEFT',
                'conditions' => 'order_courses.order_id = Orders.id'
            ],
            'micro_sessions' => [
                'table' => 'micro_sessions',
                'type' => 'LEFT',
                'conditions' => 'micro_sessions.id = order_courses.micro_session_id'
            ],
            'micro_session_chapters' => [
                'table' => 'micro_session_chapters',
                'type' => 'LEFT',
                'conditions' => 'micro_session_chapters.micro_session_id = micro_sessions.id'
            ],
            'user' => [
                'table' => 'users',
                'type' => 'LEFT',
                'conditions' => 'user.id = Orders.user_id'
            ]
        ]);

         $this->loadModel('TeacherStudentMappings');
         $packageschapter_query = $this->TeacherStudentMappings->find('all')
        ->select(['micro_sessions.id','micro_session_chapters.id','micro_session_chapters.title','micro_session_chapters.start_time','micro_session_chapters.start_date','micro_session_chapters.end_date','micro_session_chapters.end_time' ])
        ->select($this->TeacherStudentMappings)
        ->where("TeacherStudentMappings.teacher_id = '".$this->getRequest()->getAttribute('identity')->id."'")
        ->join([
            'micro_sessions' => [
                'table' => 'micro_sessions',
                'type' => 'LEFT',
                'conditions' => 'micro_sessions.id = TeacherStudentMappings.micro_session_id'
            ],
            'micro_session_chapters' => [
                'table' => 'micro_session_chapters',
                'type' => 'LEFT',
                'conditions' => 'micro_session_chapters.micro_session_id = micro_sessions.id'
            ]
        ]);

        $options['order'] = ['TeacherStudentMappings.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.PAGE_LIMIT');
        $this->paginate = $options;
        $packageschapter = $this->paginate($packageschapter_query);

        }else{
            $query = $this->Orders->find('all')

        ->select(['micro_sessions.id','micro_session_chapters.id','micro_session_chapters.title','micro_session_chapters.start_time','micro_session_chapters.start_date','micro_session_chapters.end_date','micro_session_chapters.end_time' ])
        ->select($this->Orders)
        ->where("user.id = '".$this->getRequest()->getAttribute('identity')->id."'")
        ->where("order_courses.micro_session_id != '' ")
        ->join([
            'order_courses' => [
                'table' => 'order_courses',
                'type' => 'LEFT',
                'conditions' => 'order_courses.order_id = Orders.id'
            ],
            'micro_sessions' => [
                'table' => 'micro_sessions',
                'type' => 'LEFT',
                'conditions' => 'micro_sessions.id = order_courses.micro_session_id'
            ],
            'micro_session_chapters' => [
                'table' => 'micro_session_chapters',
                'type' => 'LEFT',
                'conditions' => 'micro_session_chapters.micro_session_id = micro_sessions.id'
            ],
            'user' => [
                'table' => 'users',
                'type' => 'LEFT',
                'conditions' => 'user.id = Orders.user_id'
            ]
        ]);

          $this->loadModel('TeacherStudentMappings');
         $packageschapter_query = $this->TeacherStudentMappings->find('all')
        ->select(['micro_sessions.id','micro_session_chapters.id','micro_session_chapters.title','micro_session_chapters.start_time','micro_session_chapters.start_date','micro_session_chapters.end_date','micro_session_chapters.end_time' ])
        ->select($this->TeacherStudentMappings)
        ->where("TeacherStudentMappings.student_id = '".$this->getRequest()->getAttribute('identity')->id."'")
        ->join([
            'micro_sessions' => [
                'table' => 'micro_sessions',
                'type' => 'LEFT',
                'conditions' => 'micro_sessions.id = TeacherStudentMappings.micro_session_id'
            ],
            'micro_session_chapters' => [
                'table' => 'micro_session_chapters',
                'type' => 'LEFT',
                'conditions' => 'micro_session_chapters.micro_session_id = micro_sessions.id'
            ]
        ]);

        $options['order'] = ['TeacherStudentMappings.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.PAGE_LIMIT');
        $this->paginate = $options;
        $packageschapter = $this->paginate($packageschapter_query);

        }

        $options['order'] = ['Orders.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.PAGE_LIMIT');
        $this->paginate = $options;
        $orders = $this->paginate($query);


     // $teacherStudentMapping = $this->TeacherStudentMappings->get($id, [
     //            'contain' => ['MicroSessions', 'MicroSessionChapters'],
     //        ]);

    // echo $query1."<pre>";
    // print_r($teacherStudentMapping);
    // die();
         //   $this->set(compact('teacherStudentMapping'));

             // return $this->response
             //    ->withType('application/json')
             //    ->withStringBody(json_encode([
             //    'micro_session_chapters' => $orders
             //    ]));

    //         echo $query."<pre>";
    // print_r($orders);
    // print_r($packageschapter);
    // die();

        $upcomingSessions = array();
        if($this->getRequest()->getAttribute('identity')->role == "teacher"){
            $table = TableRegistry::get('MicroSessions');
    		$results = $table->find()->select(['id'])->where(['user_id' =>$this->getRequest()->getAttribute('identity')->id])->all();
            $teacherSessionIDs = array();
            if(count($results) > 0){
                foreach($results as $result){
                    $teacherSessionIDs[] = $result->id;
                }

                $table = TableRegistry::get('MicroSessionChapters');
        		$results = $table->find()->where(['micro_session_id IN' => $teacherSessionIDs])->all();
                if(count($results) > 0){
                    foreach($results as $result){
                        if(!empty($result->start_date) && strtotime($result->start_date.' '.$result->start_time) > time()){
                            $dateSTime = strtotime($result->start_date.' '.$result->start_time);
                            $dateETime = strtotime($result->start_date.' '.$result->end_time);
                            $sessionDate = date('d F, Y', $dateSTime);
                            $timing = date('h:i A', $dateSTime).' - '.date('h:i A', $dateETime);
                            $upcomingSessions[$sessionDate][] = ['id' => $result->id, 'micro_session_id' => $result->micro_session_id, 'title' => $result->title, 'timing' => $timing, 'start_date' => $result->start_date, 'end_date' =>$result->end_date];
                        }
                    }
                }
                //echo('<pre />');
                //print_r($upcomingSessions);die;

            }
        }else{
            $table = TableRegistry::get('MicroSessionChapters');
            $results = $table->find()->all();
            if(count($results) > 0){
                foreach($results as $result){
                    if(!empty($result->start_date) && strtotime($result->start_date.' '.$result->start_time) > time()){
                        $dateSTime = strtotime($result->start_date.' '.$result->start_time);
                        $dateETime = strtotime($result->end_date.' '.$result->end_time);
                        $sessionDate = date('d F, Y', $dateSTime);
                        $timing = date('h:i A', $dateSTime).' - '.date('h:i A', $dateETime);
                        $upcomingSessions[$sessionDate][] = ['id' => $result->id, 'micro_session_id' => $result->micro_session_id, 'title' => $result->title, 'timing' => $timing, 'start_date' => $result->start_date, 'end_date' =>$result->end_date];
                    }
                }
            }
        }

        $this->set(compact('orders','packageschapter','upcomingSessions'));

    }

    // front end My Calendar ##############

    public function mysubscription()
    {

        $query = $this->MicroSessions->find();
        $query->contain(['GradingTypes', 'Boards', 'Subjects']);
        $query->select(['total_chapters' => $query->func()->count('MicroSessionChapters.id')]);
        $query->leftJoinWith('MicroSessionChapters', function($q){
           return $q;
        })->group(['MicroSessions.id'])->enableAutoFields(true);
        $query->matching('OrderCourses.Orders', function($q){
            return $q->where(['Orders.user_id' => $this->getRequest()->getAttribute('identity')->id]);
        });
        $options['order'] = ['Courses.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $courses = $this->paginate($query);
        //dd($courses->toArray()); die;
        $this->set(compact('courses'));

    }

    public function microsessionslist()
       {
           parent::initialize();
           $this->loadModel('Orders');
               $query = $this->Orders->find('all')
           ->select(['micro_sessions.title','micro_sessions.duration','micro_sessions.grading_type_id','micro_sessions.board_id','micro_sessions.subject_id','micro_sessions.id','packages.id','packages.package_name','plans.id','plans.plan_name','subjects.title','boards.title','grading_types.title' ])
           ->select($this->Orders)
           ->where("user.id = '".$this->getRequest()->getAttribute('identity')->id."'")
           ->where("order_courses.micro_session_id != '' ")
           ->join([
               'order_courses' => [
                   'table' => 'order_courses',
                   'type' => 'LEFT',
                   'conditions' => 'order_courses.order_id = Orders.id'
               ],
               'micro_sessions' => [
                   'table' => 'micro_sessions',
                   'type' => 'LEFT',
                   'conditions' => 'micro_sessions.id = order_courses.micro_session_id'
               ],
               'subjects' => [
                   'table' => 'subjects',
                   'type' => 'LEFT',
                   'conditions' => 'micro_sessions.subject_id = Subjects.id'
               ]
               ,'boards' => [
                   'table' => 'boards',
                   'type' => 'LEFT',
                   'conditions' => 'micro_sessions.board_id = Boards.id'
               ],
               'grading_types' => [
                   'table' => 'grading_types',
                   'type' => 'LEFT',
                   'conditions' => 'micro_sessions.grading_type_id = grading_types.id'
               ],
               'packages' => [
                   'table' => 'packages',
                   'type' => 'LEFT',
                   'conditions' => 'packages.id = micro_sessions.package_id'
               ],
               'plans' => [
                   'table' => 'plans',
                   'type' => 'LEFT',
                   'conditions' => 'plans.id = micro_sessions.plan_id'
               ],
               'user' => [
                   'table' => 'users',
                   'type' => 'LEFT',
                   'conditions' => 'user.id = Orders.user_id'
               ]
           ]);
          $options['order'] = ['Orders.id' => 'DESC'];
           $options['limit'] = \Cake\Core\Configure::read('Setting.PAGE_LIMIT');
           $this->paginate = $options;
           $orders = $this->paginate($query);
           //echo '<pre />';
           //print_r($orders);die;
           $this->set(compact('orders'));
       }

}
