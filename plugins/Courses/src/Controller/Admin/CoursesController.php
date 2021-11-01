<?php
declare(strict_types=1);

namespace Courses\Controller\Admin;

use Courses\Controller\AppController;

/**
 * Courses Controller
 *
 * @property \Courses\Model\Table\CoursesTable $Courses
 * @method \Courses\Model\Entity\Course[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CoursesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Courses->find();
        $query->contain(['Users', 'ParentCourses', 'GradingTypes', 'Boards', 'Subjects']);
        $query->select(['total_chapters' => $query->func()->count('CourseChapters.id')]);
        $query->leftJoinWith('CourseChapters', function($q){
            return $q;
        })->group(['Courses.id'])->enableAutoFields(true);
       
        $options['order'] = ['Courses.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $courses = $this->paginate($query);

        $this->set(compact('courses'));
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
        $course = $this->Courses->get($id, [
            'contain' => ['Users', 'Listings', 'ParentCourses', 'GradingTypes',  'ChildCourses', 'Subjects', 'Boards'],
        ]);
        //dd($course->toArray());
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
            $conditions['id !='] = $id;
            $children = $this->Courses
                ->find('children', ['for' => $id])
                ->find('threaded')
                ->find('list')
                ->toArray();
            if(!empty($children)){
                $conditions['ParentCourses.id NOT IN'] = array_keys($children);
            } 
        }else{
            $course = $this->Courses->newEmptyEntity();
            $conditions = [];
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $course = $this->Courses->patchEntity($course, $this->request->getData());
            //dd($course->getErrors());
            if ($this->Courses->save($course)) {
                $this->Flash->success(__('The course has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The course could not be saved. Please, try again.'));
        }
        $parentCourses = $this->Courses->ParentCourses->find('parentdomain')->find('treeList', ['keyField' => 'id', 'valueField' => 'title'])->where($conditions)->toArray();
        $gradingTypes = $this->Courses->GradingTypes->find('list', ['limit' => 200]);
        $boards = $this->Courses->Boards->find('list', ['limit' => 200]);
        $subjects = $this->Courses->Subjects->find('list', ['limit' => 200]);
        $this->set(compact('course', 'parentCourses', 'gradingTypes', 'boards', 'subjects'));
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
            'contain' => ['Phinxlog'],
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
        $phinxlog = $this->Courses->Phinxlog->find('list', ['limit' => 200]);
        $this->set(compact('course', 'listings', 'parentCourses', 'gradingTypes', 'phinxlog'));
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
}
