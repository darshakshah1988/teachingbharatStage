<?php
declare(strict_types=1);

namespace Orders\Controller;

use Orders\Controller\AppController;

/**
 * TeacherStudentMappings Controller
 *
 * @property \Orders\Model\Table\TeacherStudentMappingsTable $TeacherStudentMappings
 * @method \Orders\Model\Entity\TeacherStudentMapping[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TeacherStudentMappingsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Students', 'Packages', 'Subjects', 'MicroSessions', 'Teachers'],
        ];
        $teacherStudentMappings = $this->paginate($this->TeacherStudentMappings);

        $this->set(compact('teacherStudentMappings'));
    }

    /**
     * View method
     *
     * @param string|null $id Teacher Student Mapping id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $teacherStudentMapping = $this->TeacherStudentMappings->get($id, [
            'contain' => ['Students', 'Packages', 'Subjects', 'MicroSessions', 'Teachers'],
        ]);

        $this->set(compact('teacherStudentMapping'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $teacherStudentMapping = $this->TeacherStudentMappings->newEmptyEntity();
        if ($this->request->is('post')) {
            $teacherStudentMapping = $this->TeacherStudentMappings->patchEntity($teacherStudentMapping, $this->request->getData());
            if ($this->TeacherStudentMappings->save($teacherStudentMapping)) {
                $this->Flash->success(__('The teacher student mapping has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The teacher student mapping could not be saved. Please, try again.'));
        }
        $students = $this->TeacherStudentMappings->Students->find('list', ['limit' => 200]);
        $packages = $this->TeacherStudentMappings->Packages->find('list', ['limit' => 200]);
        $subjects = $this->TeacherStudentMappings->Subjects->find('list', ['limit' => 200]);
        $microSessions = $this->TeacherStudentMappings->MicroSessions->find('list', ['limit' => 200]);
        $teachers = $this->TeacherStudentMappings->Teachers->find('list', ['limit' => 200]);
        $this->set(compact('teacherStudentMapping', 'students', 'packages', 'subjects', 'microSessions', 'teachers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Teacher Student Mapping id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $teacherStudentMapping = $this->TeacherStudentMappings->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $teacherStudentMapping = $this->TeacherStudentMappings->patchEntity($teacherStudentMapping, $this->request->getData());
            if ($this->TeacherStudentMappings->save($teacherStudentMapping)) {
                $this->Flash->success(__('The teacher student mapping has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The teacher student mapping could not be saved. Please, try again.'));
        }
        $students = $this->TeacherStudentMappings->Students->find('list', ['limit' => 200]);
        $packages = $this->TeacherStudentMappings->Packages->find('list', ['limit' => 200]);
        $subjects = $this->TeacherStudentMappings->Subjects->find('list', ['limit' => 200]);
        $microSessions = $this->TeacherStudentMappings->MicroSessions->find('list', ['limit' => 200]);
        $teachers = $this->TeacherStudentMappings->Teachers->find('list', ['limit' => 200]);
        $this->set(compact('teacherStudentMapping', 'students', 'packages', 'subjects', 'microSessions', 'teachers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Teacher Student Mapping id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $teacherStudentMapping = $this->TeacherStudentMappings->get($id);
        if ($this->TeacherStudentMappings->delete($teacherStudentMapping)) {
            $this->Flash->success(__('The teacher student mapping has been deleted.'));
        } else {
            $this->Flash->error(__('The teacher student mapping could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
