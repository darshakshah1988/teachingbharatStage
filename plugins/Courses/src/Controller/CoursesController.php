<?php
declare(strict_types=1);

namespace Courses\Controller;

use Courses\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Courses Controller
 *
 * @property \Courses\Model\Table\CoursesTable $Courses
 * @method \Courses\Model\Entity\Course[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CoursesController extends AppController
{

     /**
     * courseList method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function courseList()
    {
        $query = $this->Courses->find('course');
        $query->contain(['ParentCourses', 'GradingTypes', 'Boards', 'Subjects']);
        $query->select(['total_chapters' => $query->func()->count('CourseChapters.id')]);
        $query->leftJoinWith('CourseChapters', function($q){
            return $q;
        })->group(['Courses.id'])->enableAutoFields(true);
        $query->matching('OrderCourses.Orders', function($q){
            return $q->where(['Orders.user_id' => $this->getRequest()->getAttribute('identity')->id]);
        });
        $options['order'] = ['Courses.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $courses = $this->paginate($query);
        //dd($courses->toArray());
        $this->set(compact('courses'));
    }
  
    /**
     * myCourses method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function myCourses()
    {
        $query = $this->Courses->find('course');
        $query->contain(['ParentCourses', 'GradingTypes', 'Boards', 'Subjects']);
        $query->select(['total_chapters' => $query->func()->count('CourseChapters.id')]);
        $query->leftJoinWith('CourseChapters', function($q){
            return $q;
        })->group(['Courses.id'])->enableAutoFields(true);
        $query->where(['Courses.user_id' => $this->getRequest()->getAttribute('identity')->id]);
        $options['order'] = ['Courses.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $courses = $this->paginate($query);
        //dd($courses->toArray());
        $this->set(compact('courses'));
    }

    public function masterSessions()
    {
        $query = $this->Courses->find('session');
        $query->contain(['ParentCourses', 'GradingTypes', 'Boards', 'Subjects', 'Meetings']);
        if($this->request->getAttribute('identity')){
            $query->contain(['OrderCourses.Orders' => function($q){
                    return $q->where(['Orders.user_id' => $this->request->getAttribute('identity')->id]);
            }]);
        } 
        $query->where(['Courses.user_id' => $this->getRequest()->getAttribute('identity')->id]);
        $options['order'] = ['Courses.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $courses = $this->paginate($query);
        //dd($courses->toArray());
        $this->set(compact('courses'));
    }

    public function masterSessionList()
    {
        $query = $this->Courses->find('session');
        $query->contain(['ParentCourses', 'GradingTypes', 'Boards', 'Subjects', 'Meetings']);
        $query->contain(['OrderCourses.Orders' => function($q){
                    return $q->where(['Orders.user_id' => $this->request->getAttribute('identity')->id]);
            }]);

        $query->matching('OrderCourses.Orders', function($q){
                    return $q->where(['Orders.user_id' => $this->request->getAttribute('identity')->id]);
            });
        $query->distinct(['Courses.id']);
        $options['order'] = ['Courses.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $courses = $this->paginate($query);
		//dd($courses);
        $this->set(compact('courses'));
    }
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        // $query = $this->Courses->find()->find('filter', ['keyword' => $this->request->getQuery('keyword')]);
        // $query->contain(['ParentCourses', 'GradingTypes', 'Boards', 'Subjects']);
        // $query->select(['total_chapters' => $query->func()->count('CourseChapters.id')]);
        // $query->leftJoinWith('CourseChapters', function($q){
        //     return $q;
        // })->group(['Courses.id'])->enableAutoFields(true);
        // $options['order'] = ['Courses.id' => 'DESC'];
        // $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        // $this->paginate = $options;
        // $courses = $this->paginate($query);
        //dd($courses);
        $gradingTypes = $this->Courses->GradingTypes->find('list', ['limit' => 200]);

        $boards = $this->Courses->Boards->find('list', ['limit' => 200]);
        $subjects = $this->Courses->Subjects->find('list', ['limit' => 200]);
        $this->set(compact('gradingTypes', 'boards', 'subjects'));
    }

    /**
     * getCourses method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function getCourses()
    {
        //dd($this->request->getQuery()); 
        $query = $this->Courses->find('course')->find('filter', ['keyword' => $this->request->getQuery('keyword')]);
        $query->find('board', ['boards' => $this->request->getQuery('boards')]);
        $query->find('grad', ['grads' => $this->request->getQuery('grading_types')]);
        $query->find('subject', ['subjects' => $this->request->getQuery('subjects')]);
        $query->contain(['ParentCourses', 'GradingTypes', 'Boards', 'Subjects']);
        $query->select(['total_chapters' => $query->func()->count('CourseChapters.id')]);
        $query->leftJoinWith('CourseChapters', function($q){
            return $q;
        })->group(['Courses.id'])->enableAutoFields(true);

        $query->where(['Courses.status' => 1]);

        $options['order'] = ['Courses.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $courses = $this->paginate($query);
        //dd($courses);
        $gradingTypes = $this->Courses->GradingTypes->find('list', ['limit' => 200]);

        $boards = $this->Courses->Boards->find('list', ['limit' => 200]);
        $subjects = $this->Courses->Subjects->find('list', ['limit' => 200]);
        $this->set(compact('courses', 'gradingTypes', 'boards', 'subjects'));
    }

    /**
     * getSessions method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function getSessions()
    {
        //dd($this->request->getQuery()); 
        $tab = $this->request->getQuery('tab');
        $query = $this->Courses->find();
        $query->find('session')->find('duration', ['type' => $this->request->getQuery('tab')])->find('filter', ['keyword' => $this->request->getQuery('keyword')]);
        $query->find('board', ['boards' => $this->request->getQuery('boards')]);
        $query->find('grad', ['grads' => $this->request->getQuery('grading_types')]);
        $query->find('subject', ['subjects' => $this->request->getQuery('subjects')]);
        $query->contain(['ParentCourses', 'GradingTypes', 'Boards', 'Meetings', 'Subjects', 'Users.UserProfiles', 'Users.UserProfiles.PrimarySubjects', 'Users.UserProfiles.SecondarySubjects','CourseWatchings']); 
    
        $query->where(['Courses.status' => 1]);

        if($this->request->getAttribute('identity')){
            $query->contain(['OrderCourses.Orders' => function($q){
                    return $q->where(['Orders.user_id' => $this->request->getAttribute('identity')->id]);
            }]);
        }
        $query->select(['total_watching' => $query->func()->count('CourseWatchings.id')]);
        $query->leftJoinWith('CourseWatchings', function($q){
            return $q;
        })
        ->group(['Courses.id'])
        //->group(['CourseWatchings.user_id'])
        ->enableAutoFields(true);

        $options['order'] = ['Courses.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $courses = $this->paginate($query);
        //dd($courses->toArray());
        $gradingTypes = $this->Courses->GradingTypes->find('list', ['limit' => 200]);

        $boards = $this->Courses->Boards->find('list', ['limit' => 200]);
        $subjects = $this->Courses->Subjects->find('list', ['limit' => 200]);
        $this->set(compact('courses', 'gradingTypes', 'boards', 'subjects', 'tab'));
    } 

    /**
     * Classes method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function classes()
    {
        $this->paginate = [
            'contain' => ['Listings', 'ParentCourses', 'GradingTypes'],
        ];
        $courses = $this->paginate($this->Courses);
        
        $this->set(compact('courses'));
    }

    /**
     * Classes method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function resources()
    {
        
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
        $query = $this->Courses->find()->where(['Courses.id' => $id]);
        $query->contain(['ParentCourses', 'GradingTypes', 'ChildCourses', 'Subjects', 'Boards', 'CourseChapters', 'Reviews']); 
        $query->select(['total_chapters' => $query->func()->count('CourseChapters.id'), 'avg_rating' => $query->func()->avg('rating')]);
        $query->leftJoinWith('CourseChapters', function($q){
            return $q;
        });
        $query->leftJoinWith('Reviews', function($q){
            return $q;
        }); 
        $query->group(['Courses.id'])->enableAutoFields(true);

        $query->contain(['Users' => function($q){
            return $q->leftJoinWith('Reviews', function($q){
            return $q;
        })
        ->group(['Users.id'])
        ->select(['Users.id', 'teacher_rating' => $q->func()->avg('Reviews.rating'), 'total_rating' => $q->func()->count('Reviews.id')])->contain(['UserProfiles', 'Reviews'])->enableAutoFields(true);
        }]); 
 
        //dump($this->request->getAttribute('identity'));
        if($this->request->getAttribute('identity')){
            $query->contain(['OrderCourses.Orders' => function($q){
                    return $q->where(['Orders.transaction_status' => 1, 'Orders.user_id' => $this->request->getAttribute('identity')->id]);
            }]);
        }

        $course = $query->firstOrFail();
      //  dd($course);
        $totalCourses = $this->Courses->find()->where(['Courses.user_id' => $course->user_id])->count();
        $this->set(compact('course', 'totalCourses'));
    }


     /**
     * sessionDetail method
     *
     * @param string|null $id Course id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function sessionDetail($id = null)
    {
        $query = $this->Courses->find()->where(['Courses.id' => $id]);
        $query->contain(['Users.UserProfiles', 'ParentCourses', 'GradingTypes', 'ChildCourses', 'Subjects', 'Boards', 'CourseChapters', 'SessionReviews','Meetings']); 

        //dump($this->request->getAttribute('identity'));
        if($this->request->getAttribute('identity')){
            $query->contain(['OrderCourses.Orders' => function($q){
                    return $q->where(['Orders.user_id' => $this->request->getAttribute('identity')->id]);
            }]);
        } 

        $course = $query->firstOrFail();

        
        $tab = $this->request->getQuery('tab');
        //$query = $this->Courses->find('session')->find('duration', ['type' => 'upcoming']); 
        $query = $this->Courses->find('session'); 
        $query->find('board', ['boards' => $course->board_id]);
        $query->find('grad', ['grads' => $course->grading_type_id]);
        $query->find('subject', ['subjects' => $course->subject_id]);
        $query->contain(['ParentCourses', 'GradingTypes', 'Boards', 'Subjects', 'Users.UserProfiles', 'Users.UserProfiles.PrimarySubjects', 'Users.UserProfiles.SecondarySubjects','Meetings']);
    
        $query->where(['Courses.status' => 1]);

        if($this->request->getAttribute('identity')){
            $query->contain(['OrderCourses.Orders' => function($q){
                    return $q->where(['Orders.user_id' => $this->request->getAttribute('identity')->id]);
            }]);
        }

        $query->where(['Courses.id !=' => $course->id]);

        $interstes = $query->limit(3)->all();

        //dd($interstes);

        $totalCourses = $this->Courses->find()->where(['Courses.user_id' => $course->user_id])->count();
        $this->set(compact('course', 'totalCourses', 'interstes'));
    }

     /**
     * pastSession method
     *
     * @param string|null $id Course id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function pastSession($id = null)
    {
        $query = $this->Courses->find()->where(['Courses.id' => $id]);
        $query->contain(['Users.UserProfiles', 'ParentCourses', 'GradingTypes', 'ChildCourses', 'Subjects', 'Boards', 'CourseChapters', 'SessionReviews']); 

        //dump($this->request->getAttribute('identity'));
        if($this->request->getAttribute('identity')){
            $query->contain(['OrderCourses.Orders' => function($q){
                    return $q->where(['Orders.user_id' => $this->request->getAttribute('identity')->id]);
            }]);
        } 

        $course = $query->firstOrFail();

        //dd($course);

        $totalCourses = $this->Courses->find()->where(['Courses.user_id' => $course->user_id])->count();
        $this->set(compact('course', 'totalCourses'));
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
        $query = $this->Courses->find()->where(['Courses.id' => $id]);
        $query->contain(['Listings', 'ParentCourses', 'GradingTypes', 'ChildCourses', 'Subjects', 'Boards', 'CourseChapters']); 
        $query->select(['total_chapters' => $query->func()->count('CourseChapters.id')]);
        $query->leftJoinWith('CourseChapters', function($q){
            return $q;
        })->group(['Courses.id'])->enableAutoFields(true);
        $course = $query->firstOrFail();

        if($this->getRequest()->getAttribute('identity')->id == $course->user_id){
            $this->Flash->alertWarning('You can\'t able to buy your self course.');
            return $this->redirect(['action' => 'view', $id]);
        }

        $exist = $this->Courses->Carts->find()->where(['Carts.user_id' => $this->getRequest()->getAttribute('identity')->id, 'Carts.course_id' => $id])->count();
        if($exist == 0){
            $itemdata['sessionId'] = $this->request->getSession()->id();
            $itemdata['user_id'] = $this->getRequest()->getAttribute('identity')->id;
            $itemdata['course_id'] = $id;
            $itemdata['quantity'] = 1;
            $cart = $this->Courses->Carts->newEmptyEntity();
            $cart = $this->Courses->Carts->patchEntity($cart, $itemdata);
            if ($this->Courses->Carts->save($cart)) {
                $this->Flash->success(__('This course has added in cart.'));

                return $this->redirect(['controller' => 'Carts','action' => 'index', 'plugin' => 'Orders']);
            }else{
                return $this->redirect(['action' => 'view', $id]);
            }
        }else{
            return $this->redirect(['controller' => 'Carts','action' => 'index', 'plugin' => 'Orders']);
        }
        
        //dd($course);
        $this->set(compact('course'));
    }


    /**
     * Add/Edit method
     * Edit: param string|null $id Course id.
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function add($id = null)
    {
        if($id){
            $course = $this->Courses->get($id, [
                'contain' => [],
            ]);
        }else{
            $course = $this->Courses->newEmptyEntity();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $course = $this->Courses->patchEntity($course, $this->request->getData());
            $course->user_id = $this->getRequest()->getAttribute('identity')->id;
            //dd($course);
            if ($this->Courses->save($course)) {
                $this->Flash->success(__('The course has been saved.'));

                return $this->redirect(['action' => 'myCourses']);
            }
            $this->Flash->error(__('The course could not be saved. Please, try again.'));
        }

        $listings = $this->Courses->Listings->find('list', ['limit' => 200]);
        $parentCourses = $this->Courses->ParentCourses->find('list', ['limit' => 200]);
        $gradingTypes = $this->Courses->GradingTypes->find('list', ['limit' => 200]);

        $boards = $this->Courses->Boards->find('list', ['limit' => 200]);
        $subjects = $this->Courses->Subjects->find('list', ['limit' => 200]);
        $this->set(compact('course', 'listings', 'parentCourses', 'gradingTypes', 'boards', 'subjects'));
    }

    /**
     * addSession method
     * Edit: param string|null $id Course id.
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function addSession($id = null)
    {
        if($id){
            $course = $this->Courses->get($id, [
                'contain' => [],
            ]);
        }else{
            $course = $this->Courses->newEmptyEntity();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $course = $this->Courses->patchEntity($course, $this->request->getData(), ['validate' => 'session']);
            $course->user_id = $this->getRequest()->getAttribute('identity')->id;
            $course->course_type = 1; //session
            $course->status = 1;
            //dd($course);
            if ($this->Courses->save($course)) {
                $this->Flash->success(__('The master session has been saved.'));

                return $this->redirect(['action' => 'masterSessions']);
            }
            $this->Flash->error(__('The master session could not be saved. Please, try again.'));
        }

        $listings = $this->Courses->Listings->find('list', ['limit' => 200]);
        $parentCourses = $this->Courses->ParentCourses->find('list', ['limit' => 200]);
        $gradingTypes = $this->Courses->GradingTypes->find('list', ['limit' => 200]);

        $boards = $this->Courses->Boards->find('list', ['limit' => 200]);
        $subjects = $this->Courses->Subjects->find('list', ['limit' => 200]);
        $this->set(compact('course', 'listings', 'parentCourses', 'gradingTypes', 'boards', 'subjects'));
    }

    /** 
     * Edit method
     *
     * @param string|null $id Course id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $course = $this->Courses->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $course = $this->Courses->patchEntity($course, $this->request->getData());
            if ($this->Courses->save($course)) {
                $this->Flash->success(__('The course has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The course could not be saved. Please, try again.'));
        }
        $listings = $this->Courses->Listings->find('list', ['limit' => 200]);
        $parentCourses = $this->Courses->ParentCourses->find('list', ['limit' => 200]);
        $gradingTypes = $this->Courses->GradingTypes->find('list', ['limit' => 200]);
        $this->set(compact('course', 'listings', 'parentCourses', 'gradingTypes'));
    }

   
    /**
     * Delete method
     *
     * @param string|null $id Enquiry Status id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $course = $this->Courses->get($id);
        if ($this->Courses->delete($course)) {
            $result = ['status' => true, 'message' => __('The course has been deleted.')];
        } else {
            $result = ['status' => false, 'message' => __('The course could not be deleted. Please, try again.')];
        }

        $this->set([
            'code' => (isset($result['status']) && $result['status'] == true) ? 200 : 422,
            'status' => $result['status'] ?? null,
            'message' => $result['message'] ?? null,
            'data' => $course,
            'errors' => $result['errors'] ?? null,
            ]);
        $this->viewBuilder()->setOption('serialize', ['status', 'code','message','data', 'errors']);
    }


    public function sessions()
    {
        $gradingTypes = $this->Courses->GradingTypes->find('list', ['limit' => 200]);

        $boards = $this->Courses->Boards->find('list', ['limit' => 200]);
        $subjects = $this->Courses->Subjects->find('list', ['limit' => 200]);
        $this->set(compact('gradingTypes', 'boards', 'subjects'));
    }

    public function joinSession($course_id = null)
    {
        $course = $this->Courses->get($course_id, [
            'contain' => [],
        ]);
        if($course->end_date < date('Y-m-d H:i:s')){
            return $this->redirect(['action' => 'pastSession', $course_id]);
        }

        if($this->getRequest()->getAttribute('identity')){
            // $watches = $this->Courses->CourseWatchings->find()->where(['CourseWatchings.course_id' => $course->id, 'CourseWatchings.user_id' => $this->getRequest()->getAttribute('identity')->id]);
            $watches = $this->Courses->CourseWatchings->newEmptyEntity();
            $watches->course_id = $course->id;
            $watches->user_id = $this->getRequest()->getAttribute('identity')->id;
            $watches->views = 1;
            $this->Courses->CourseWatchings->save($watches);
        }
        

        $this->set(compact('course'));
    }

}
