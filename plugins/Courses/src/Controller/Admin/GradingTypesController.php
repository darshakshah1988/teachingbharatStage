<?php
declare(strict_types=1);

namespace Courses\Controller\Admin;

use Courses\Controller\AppController;

/**
 * GradingTypes Controller
 *
 * @method \Courses\Model\Entity\GradingType[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GradingTypesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->GradingTypes->find();
        $options['order'] = ['Services.position' => 'ASC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $gradingTypes = $this->paginate($query); 
        $this->set(compact('gradingTypes'));
    }

    /**
     * View method
     *
     * @param string|null $id Grading Type id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $gradingType = $this->GradingTypes->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('gradingType'));
    }

 
    /**
     * Add/Edit method
     * Edit: param string|null $id Grading Type id.
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function add($id = null)
    {
        if($id){
            $gradingType = $this->GradingTypes->get($id, [
                'contain' => [],
            ]);
        }else{
            $gradingType = $this->GradingTypes->newEmptyEntity();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $gradingType = $this->GradingTypes->patchEntity($gradingType, $this->request->getData());
            if ($this->GradingTypes->save($gradingType)) {
                $this->Flash->success(__('The grading type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The grading type could not be saved. Please, try again.'));
        }
        $this->set(compact('gradingType'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Grading Type id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $gradingType = $this->GradingTypes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $gradingType = $this->GradingTypes->patchEntity($gradingType, $this->request->getData());
            if ($this->GradingTypes->save($gradingType)) {
                $this->Flash->success(__('The grading type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The grading type could not be saved. Please, try again.'));
        }
        $this->set(compact('gradingType'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Grading Type id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $gradingType = $this->GradingTypes->get($id);
        if ($this->GradingTypes->delete($gradingType)) {
            $result = ['status' => true, 'message' => __('The grading type has been deleted.')];
        } else {
            $result = ['status' => false, 'message' => __('The grading type could not be deleted. Please, try again.')];
        }

        $this->set([
            'code' => (isset($result['status']) && $result['status'] == true) ? 200 : 422,
            'status' => $result['status'] ?? null,
            'message' => $result['message'] ?? null,
            'data' => $gradingType,
            'errors' => $result['errors'] ?? null,
            ]);
        $this->viewBuilder()->setOption('serialize', ['status', 'code','message','data', 'errors']);
    }
}
