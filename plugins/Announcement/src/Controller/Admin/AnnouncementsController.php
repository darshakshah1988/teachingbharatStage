<?php
declare(strict_types=1);

namespace Announcement\Controller\Admin;

use Announcement\Controller\AppController;

/**
 * Announcements Controller
 *
 * @property \Announcement\Model\Table\AnnouncementsTable $Announcements
 * @method \Announcement\Model\Entity\Announcement[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AnnouncementsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Listings', 'AdminUsers'],
        ];
        $announcements = $this->paginate($this->Announcements);

        $this->set(compact('announcements'));
    }

    /**
     * View method
     *
     * @param string|null $id Announcement id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $announcement = $this->Announcements->get($id, [
            'contain' => ['Listings', 'AdminUsers'],
        ]);

        $this->set(compact('announcement'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
        if($id){
            $announcement = $this->Announcements->get($id, [
                'contain' => ['Listings', 'AdminUsers'],
            ]);
        }else{
            $announcement = $this->Announcements->newEmptyEntity();
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $announcement = $this->Announcements->patchEntity($announcement, $this->request->getData());
            $announcement->admin_user_id = $this->Authentication->getIdentity()->id;
            if ($this->Announcements->save($announcement)) {
                $this->Flash->success(__('The announcement has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The announcement could not be saved. Please, try again.'));
        }
        $listings = $this->Announcements->Listings->find('list', ['limit' => 200]);
        $adminUsers = $this->Announcements->AdminUsers->find('list', ['limit' => 200]);
        $this->set(compact('announcement', 'listings', 'adminUsers'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Announcement id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $announcement = $this->Announcements->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $announcement = $this->Announcements->patchEntity($announcement, $this->request->getData());
            if ($this->Announcements->save($announcement)) {
                $this->Flash->success(__('The announcement has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The announcement could not be saved. Please, try again.'));
        }
        $listings = $this->Announcements->Listings->find('list', ['limit' => 200]);
        $adminUsers = $this->Announcements->AdminUsers->find('list', ['limit' => 200]);
        $this->set(compact('announcement', 'listings', 'adminUsers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Announcement id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $announcement = $this->Announcements->get($id);
        if ($this->Announcements->delete($announcement)) {
            $this->Flash->success(__('The announcement has been deleted.'));
        } else {
            $this->Flash->error(__('The announcement could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
