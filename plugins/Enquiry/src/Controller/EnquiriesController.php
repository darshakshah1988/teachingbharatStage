<?php
declare(strict_types=1);

namespace Enquiry\Controller;

use Enquiry\Controller\AppController;

/**
 * Enquiries Controller
 *
 * @property \Enquiry\Model\Table\EnquiriesTable $Enquiries
 * @method \Enquiry\Model\Entity\Enquiry[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EnquiriesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Enquiries->find();
        $query->contain(['Listings', 'AdminUsers', 'PriorityTypes', 'EnquiryStatuses', 'AssignedUsers']);
       
        $options['order'] = ['Enquiries.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $enquiries = $this->paginate($query);
        $contactEnquiry = $this->Enquiries->newEmptyEntity();
        $this->set(compact('enquiries', 'contactEnquiry'));
    }

    /**
     * View method
     *
     * @param string|null $id Enquiry id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $enquiry = $this->Enquiries->get($id, [
            'contain' => ['Listings', 'AdminUsers', 'PriorityTypes', 'EnquiryStatuses', 'AssignedUsers', 'EnquiryComments'],
        ]);

        $this->set(compact('enquiry'));
    }

 
    /**
     * Add/Edit method
     * Edit: param string|null $id Enquiry id.
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function add($id = null)
    {
        if($id){
            $enquiry = $this->Enquiries->get($id, [
                'contain' => [],
            ]);
        }else{
            $enquiry = $this->Enquiries->newEmptyEntity();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $enquiry = $this->Enquiries->patchEntity($enquiry, $this->request->getData(), ['validate' => 'enquiry']);
            $enquiry->enquiry_type = "lead";
            $enquiry->subject = "Admission Inquiry";
            if ($this->Enquiries->save($enquiry)) {
                $result = ['status' => true, 'message' => __('The enquiry has been saved.')];
            }else{
                $result = ['status' => false,'message' => 'The enquiry could not be saved. Please, try again.', 'errors' => $enquiry->getErrors()];
            }
         }
        $this->set([
            'enquiry'=> $enquiry,
            'code' => (isset($result['status']) && $result['status'] == true) ? 200 : 422,
            'status' => $result['status'] ?? null,
            'message' => $result['message'] ?? null,
            'errors' => $result['errors'] ?? null,
            ]);
        $this->viewBuilder()->setOption('serialize', ['status', 'code','message', 'errors']);
    }

    /**
     * askQuestion method
     * Edit: param string|null $id Enquiry id.
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function askQuestion($id = null)
    {
        if($id){
            $enquiry = $this->Enquiries->get($id, [
                'contain' => [],
            ]);
        }else{
            $enquiry = $this->Enquiries->newEmptyEntity();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $enquiry = $this->Enquiries->patchEntity($enquiry, $this->request->getData(), ['validate' => 'enquiry']);
            $enquiry->enquiry_type = "ask-question";
            $enquiry->subject = "Question";
            if ($this->Enquiries->save($enquiry)) {
                $this->Flash->success(__('The enquiry has been saved.'));

                return $this->redirect(['action' => 'askQuestion']);
            }
            $this->Flash->error(__('The course could not be saved. Please, try again.'));
         }
        $this->set([
            'enquiry'=> $enquiry,
            'code' => (isset($result['status']) && $result['status'] == true) ? 200 : 422,
            'status' => $result['status'] ?? null,
            'message' => $result['message'] ?? null,
            'errors' => $result['errors'] ?? null,
            ]);
    }

    
}
