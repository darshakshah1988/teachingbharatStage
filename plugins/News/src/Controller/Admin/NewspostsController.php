<?php
declare(strict_types=1);

namespace News\Controller\Admin;

use News\Controller\AppController;

/**
 * Newsposts Controller
 *
 * @method \News\Model\Entity\Newspost[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NewspostsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Newsposts->find();
        $options['order'] = ['Newsposts.position' => 'ASC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $newsposts = $this->paginate($query);
        $this->set(compact('newsposts'));
    }

    /**
     * View method
     *
     * @param string|null $id Newspost id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $newspost = $this->Newsposts->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('newspost'));
    }

 
    /**
     * Add/Edit method
     * Edit: param string|null $id Newspost id.
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function add($id = null)
    {
        if($id){
            $newspost = $this->Newsposts->get($id, [
                'contain' => [],
            ]);
        }else{
            $newspost = $this->Newsposts->newEmptyEntity();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $newspost = $this->Newsposts->patchEntity($newspost, $this->request->getData());
            $newspost->admin_user_id = $this->Authentication->getIdentity()->id;
            if ($this->Newsposts->save($newspost)) {
                $this->Flash->success(__('The newspost has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The newspost could not be saved. Please, try again.'));
        }
        $this->set(compact('newspost'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Newspost id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {

        $newspost = $this->Newsposts->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $newspost = $this->Newsposts->patchEntity($newspost, $this->request->getData());
            if ($this->Newsposts->save($newspost)) {
                $this->Flash->success(__('The newspost has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The newspost could not be saved. Please, try again.'));
        }
        $this->set(compact('newspost'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Newspost id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function deleteNoteUsed($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $newspost = $this->Newsposts->get($id);
        if ($this->Newsposts->delete($newspost)) {
            $this->Flash->success(__('The newspost has been deleted.'));
        } else {
            $this->Flash->error(__('The newspost could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
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
        $newspost = $this->Newsposts->get($id);
        if ($this->Newsposts->delete($newspost)) {
            $result = ['status' => true, 'message' => __('The newspost has been deleted.')];
        } else {
            $result = ['status' => false, 'message' => __('The newspost could not be deleted. Please, try again.')];
        }

        $this->set([
            'code' => (isset($result['status']) && $result['status'] == true) ? 200 : 422,
            'status' => $result['status'] ?? null,
            'message' => $result['message'] ?? null,
            'data' => $newspost,
            'errors' => $result['errors'] ?? null,
            ]);
        $this->viewBuilder()->setOption('serialize', ['status', 'code','message','data', 'errors']);
    }
}
