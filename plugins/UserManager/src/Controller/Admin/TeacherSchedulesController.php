<?php
declare(strict_types=1);

namespace UserManager\Controller\Admin;

use UserManager\Controller\AppController;

/**
 * TeacherSchedules Controller
 *
 * @property \UserManager\Model\Table\TeacherSchedulesTable $TeacherSchedules
 * @method \UserManager\Model\Entity\TeacherSchedule[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TeacherSchedulesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->TeacherSchedules->find();
        $options['order'] = ['TeacherSchedules.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $teacherSchedules = $this->paginate($query);
        $this->set(compact('teacherSchedules'));
    }

    /**
     * View method
     *
     * @param string|null $id Teacher Schedule id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $teacherSchedule = $this->TeacherSchedules->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set(compact('teacherSchedule'));
    }

 
    /**
     * Add/Edit method
     * Edit: param string|null $id Teacher Schedule id.
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function add($id = null)
    {
        if($id){
            $teacherSchedule = $this->TeacherSchedules->get($id, [
                'contain' => ['Users'],
            ]);
        }else{
            $teacherSchedule = $this->TeacherSchedules->newEmptyEntity();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            //dd($this->request->getData());
            $teacherSchedule = $this->TeacherSchedules->patchEntity($teacherSchedule, $this->request->getData());
            if ($this->TeacherSchedules->save($teacherSchedule)) {
                $this->Flash->success(__('The teacher schedule has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The teacher schedule could not be saved. Please, try again.'));
        }
        $users = $this->TeacherSchedules->Users->find('list', ['limit' => 200]);
        $this->set(compact('teacherSchedule', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Teacher Schedule id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $teacherSchedule = $this->TeacherSchedules->get($id, [
            'contain' => ['Users'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $teacherSchedule = $this->TeacherSchedules->patchEntity($teacherSchedule, $this->request->getData());
            if ($this->TeacherSchedules->save($teacherSchedule)) {
                $this->Flash->success(__('The teacher schedule has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The teacher schedule could not be saved. Please, try again.'));
        }
        $users = $this->TeacherSchedules->Users->find('list', ['limit' => 200]);
        $this->set(compact('teacherSchedule', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Teacher Schedule id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $teacherSchedule = $this->TeacherSchedules->get($id);
        if ($this->TeacherSchedules->delete($teacherSchedule)) {
            $result = ['status' => true, 'message' => __('The teacher schedule has been deleted.')];
        } else {
            $result = ['status' => false, 'message' => __('The teacher schedule could not be deleted. Please, try again.')];
        }

        $this->set([
            'code' => (isset($result['status']) && $result['status'] == true) ? 200 : 422,
            'status' => $result['status'] ?? null,
            'message' => $result['message'] ?? null,
            'data' => $teacherSchedule,
            'errors' => $result['errors'] ?? null,
            ]);
        $this->viewBuilder()->setOption('serialize', ['status', 'code','message','data', 'errors']);
    }

}
