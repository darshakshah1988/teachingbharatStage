<?php
declare(strict_types=1);

namespace Enquiry\Controller\Admin;

use Enquiry\Controller\AppController;

/**
 * PriorityTypes Controller
 *
 * @property \Enquiry\Model\Table\PriorityTypesTable $PriorityTypes
 * @method \Enquiry\Model\Entity\PriorityType[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PriorityTypesController extends AppController
{

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authorization->skipAuthorization();
    }

    /**
     * Add/Edit method
     * Edit: param string|null $id Priority Type id.
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function add($id = null)
    {
        if($id){ 
            $priorityType = $this->PriorityTypes->get($id, [
                'contain' => [],
            ]);
        }else{
            $priorityType = $this->PriorityTypes->newEmptyEntity();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $priorityType = $this->PriorityTypes->patchEntity($priorityType, $this->request->getData());
            if ($this->PriorityTypes->save($priorityType)) {
                    $result = ['status' => true, 'message' => __('The priority type has been saved.')];
            }else{
                $result = ['status' => false,'message' => 'The priority type could not be saved. Please, try again.', 'errors' => $priorityType->getErrors()];
            }
        }

        $priorities = $this->PriorityTypes->find();
        if($id){
            $priorities->where(['id !=' => $id]);
        }
        $priorityTypeList = $priorities->all();
        $this->set([
            'priorityType'=> $priorityType,
            'priorityTypeList' => $priorityTypeList,
            'code' => (isset($result['status']) && $result['status'] == true) ? 200 : 422,
            'status' => $result['status'] ?? null,
            'message' => $result['message'] ?? null,
            'errors' => $result['errors'] ?? null,
            ]);
        $this->viewBuilder()->setOption('serialize', ['status', 'code','message', 'errors']);

    }

    /**
     * Edit method
     *
     * @param string|null $id Priority Type id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $priorityType = $this->PriorityTypes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request = $this->request->withData($this->request->getData('name'), $this->request->getData('value'));
            $priorityType = $this->PriorityTypes->patchEntity($priorityType, $this->request->getData());
            if ($this->PriorityTypes->save($priorityType)) {
                $result = ['status' => true, 'message' => __('The priority type has been updated.')];
        }else{
            $result = ['status' => false,'message' => 'The priority type could not be saved. Please, try again.', 'errors' => $priorityType->getErrors()];
        }
        }
        $this->set([
            'priorityType'=> $priorityType,
            'code' => (isset($result['status']) && $result['status'] == true) ? 200 : 422,
            'status' => $result['status'] ?? null,
            'message' => $result['message'] ?? null,
            'errors' => $result['errors'] ?? null,
            ]);
        $this->viewBuilder()->setOption('serialize', ['status', 'code','message', 'errors']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Priority Type id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $priorityType = $this->PriorityTypes->get($id);
        if ($this->PriorityTypes->delete($priorityType)) {
            $result = ['status' => true, 'message' => __('The priority type has been deleted.')];
        } else {
            $result = ['status' => true, 'message' => __('The priority type could not be deleted. Please, try again.')];
        }
        $this->set([
            'code' => (isset($result['status']) && $result['status'] == true) ? 200 : 422,
            'status' => $result['status'] ?? null,
            'message' => $result['message'] ?? null,
            'data' => $priorityType,
            'errors' => $result['errors'] ?? null,
            ]);
        $this->viewBuilder()->setOption('serialize', ['status', 'code','message','data', 'errors']);

    }
}
