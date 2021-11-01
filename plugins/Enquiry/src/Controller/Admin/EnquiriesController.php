<?php
declare(strict_types=1);

namespace Enquiry\Controller\Admin;

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
        $query->contain(['Listings', 'AdminUsers', 'PriorityTypes', 'EnquiryStatuses', 'AssignedUsers', 'LatestComment' => [
            'strategy' => 'select',
            'queryBuilder' => function ($q) {
                return $q->order(['LatestComment.created' =>'DESC'])->contain(['EnquiryStatuses'])->limit(1);
            }
        ]]);
        $options['order'] = ['Enquiries.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        //sql($query);
        $this->Authorization->applyScope($query);
        $this->paginate = $options;
        $enquiries = $this->paginate($query);

        $enquiryStatuses = $this->Enquiries->EnquiryStatuses->find()->select(['id','title','color'])->all();
        //dd($enquiries);
        $this->set(compact('enquiries', 'enquiryStatuses'));
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
        $this->Authorization->authorize($enquiry, 'view');
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
        $this->Authorization->authorize($enquiry, 'create');
        if ($this->request->is(['patch', 'post', 'put'])) {
            $enquiry = $this->Enquiries->patchEntity($enquiry, $this->request->getData());
            $enquiry->enquiry_type = "lead";
            $enquiry->admin_user_id = $this->Authentication->getIdentity()->id;
            //dd($enquiry->getErrors());
            if ($this->Enquiries->save($enquiry)) {
                $this->Flash->success(__('The enquiry has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The enquiry could not be saved. Please, try again.'));
        }

        $assignedUsers = $this->Enquiries->AssignedUsers->find('list', ['limit' => 200])->find('domain');
        $this->set(compact('enquiry', 'assignedUsers'));
    }


    /**
     * todo method
     * Edit: param string|null $id Enquiry id.
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function todo($id = null)
    {
        $enquiry = $this->Enquiries->get($id, [
            'contain' => [],
        ]);
        $this->Authorization->authorize($enquiry, 'create');
        if ($this->request->is(['patch', 'post', 'put'])) {
            $enquiry = $this->Enquiries->patchEntity($enquiry, $this->request->getData(),['validate' => 'todo']);
            if ($this->Enquiries->save($enquiry)) {
                $result = ['status' => true, 'message' => __('The To-Do has been saved.')];
            }else{
                $result = ['status' => false,'message' => 'The To-Do could not be saved. Please, try again.', 'errors' => $enquiry->getErrors()];
            }
        }
        $this->set([
            'enquiry'=> $enquiry,
            'enquiryStatuses'=> $this->Enquiries->EnquiryStatuses->find('list', ['limit' => 200]),
            'assignedUsers'=> $this->Enquiries->AdminUsers->find('list', ['keyField' => 'id','valueField' => 'name','limit' => 200])->find('domain'),
            'priorityTypes' => $this->Enquiries->PriorityTypes->find('list', ['limit' => 200]),
            'code' => (isset($result['status']) && $result['status'] == true) ? 200 : 422,
            'status' => $result['status'] ?? null,
            'message' => $result['message'] ?? null,
            'errors' => $result['errors'] ?? null,
            ]);
        $this->viewBuilder()->setOption('serialize', ['status', 'code','message', 'errors']);
    }


    /**
     * comment method
     * Edit: param string|null $id Enquiry id.
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function comment($enquiry_id = null)
    {
        $enquiry = $this->Enquiries->get($enquiry_id, [
            'contain' => ['AdminUsers', 'PriorityTypes', 'EnquiryStatuses', 'AssignedUsers', 'EnquiryComments' => function($q){
                return $q->order(['EnquiryComments.id' => 'DESC'])->contain(['EnquiryStatuses']);
            }],
        ]);
        $enquiryComment = $this->Enquiries->EnquiryComments->newEmptyEntity();
        $this->Authorization->authorize($enquiry, 'create');
        if ($this->request->is(['patch', 'post', 'put'])) {
            $enquiryComment = $this->Enquiries->EnquiryComments->patchEntity($enquiryComment, $this->request->getData());
            $enquiryComment->enquiry_id = $enquiry->id;
            $enquiryComment->admin_user_id = $this->Authentication->getIdentity()->id;
            if ($this->Enquiries->EnquiryComments->save($enquiryComment)) {
                $result = ['status' => true, 'message' => __('The comment has been saved.')];
            }else{
                $result = ['status' => false,'message' => 'The comment could not be saved. Please, try again.', 'errors' => $enquiryComment->getErrors()];
            }
        }
        $this->set([
            'enquiry'=> $enquiry,
            'enquiryComment' => $enquiryComment,
            'enquiryStatuses'=> $this->Enquiries->EnquiryStatuses->find('list', ['limit' => 200]),
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
     * @param string|null $id Enquiry id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $enquiry = $this->Enquiries->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $enquiry = $this->Enquiries->patchEntity($enquiry, $this->request->getData());
            if ($this->Enquiries->save($enquiry)) {
                $this->Flash->success(__('The enquiry has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The enquiry could not be saved. Please, try again.'));
        }
        $listings = $this->Enquiries->Listings->find('list', ['limit' => 200]);
        $adminUsers = $this->Enquiries->AdminUsers->find('list', ['limit' => 200]);
        $priorityTypes = $this->Enquiries->PriorityTypes->find('list', ['limit' => 200]);
        $enquiryStatuses = $this->Enquiries->EnquiryStatuses->find('list', ['limit' => 200]);
        $assignedUsers = $this->Enquiries->AssignedUsers->find('list', ['limit' => 200]);
        $this->set(compact('enquiry', 'listings', 'adminUsers', 'priorityTypes', 'enquiryStatuses', 'assignedUsers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Enquiry id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $enquiry = $this->Enquiries->get($id);
        if ($this->Enquiries->delete($enquiry)) {
            $this->Flash->success(__('The enquiry has been deleted.'));
        } else {
            $this->Flash->error(__('The enquiry could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
