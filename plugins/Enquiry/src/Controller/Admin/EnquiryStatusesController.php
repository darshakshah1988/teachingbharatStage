<?php
declare(strict_types=1);

namespace Enquiry\Controller\Admin;

use Enquiry\Controller\AppController;

/**
 * EnquiryStatuses Controller
 *
 * @property \Enquiry\Model\Table\EnquiryStatusesTable $EnquiryStatuses
 * @method \Enquiry\Model\Entity\EnquiryStatus[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EnquiryStatusesController extends AppController
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
     * Edit: param string|null $id Enquiry Status id.
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function add($id = null)
    {
        if($id){
            $enquiryStatus = $this->EnquiryStatuses->get($id, [
                'contain' => [],
            ]);
        }else{
            $enquiryStatus = $this->EnquiryStatuses->newEmptyEntity();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $enquiryStatus = $this->EnquiryStatuses->patchEntity($enquiryStatus, $this->request->getData());
            if ($this->EnquiryStatuses->save($enquiryStatus)) {
                $result = ['status' => true, 'message' => __('The enquiry status has been saved.')];
            }else{
                $result = ['status' => false,'message' => 'The enquiry status could not be saved. Please, try again.', 'errors' => $enquiryStatus->getErrors()];
            }
        }
        $enquiryStatusList = $this->EnquiryStatuses->find()->all();
        $this->set([
            'enquiryStatus'=> $enquiryStatus,
            'enquiryStatusList' => $enquiryStatusList,
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
     * @param string|null $id Enquiry Status id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $enquiryStatus = $this->EnquiryStatuses->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request = $this->request->withData($this->request->getData('name'), $this->request->getData('value'));
            $enquiryStatus = $this->EnquiryStatuses->patchEntity($enquiryStatus, $this->request->getData());
            if ($this->EnquiryStatuses->save($enquiryStatus)) {
                $result = ['status' => true, 'message' => __('The enquiry status has been updated.')];
            }else{
                $result = ['status' => true, 'message' => __('The enquiry status could not be saved. Please, try again.'), 'errors' => $enquiryStatus->getErrors()];
            }
        }
        $this->set([
            'enquiryStatus'=> $enquiryStatus,
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
     * @param string|null $id Enquiry Status id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $enquiryStatus = $this->EnquiryStatuses->get($id);
        if ($this->EnquiryStatuses->delete($enquiryStatus)) {
            $result = ['status' => true, 'message' => __('The enquiry status has been deleted.')];
        } else {
            $result = ['status' => false, 'message' => __('The enquiry status could not be deleted. Please, try again.')];
        }

        $this->set([
            'code' => (isset($result['status']) && $result['status'] == true) ? 200 : 422,
            'status' => $result['status'] ?? null,
            'message' => $result['message'] ?? null,
            'data' => $enquiryStatus,
            'errors' => $result['errors'] ?? null,
            ]);
        $this->viewBuilder()->setOption('serialize', ['status', 'code','message','data', 'errors']);
    } 
}
