<?php
declare(strict_types=1);

namespace Events\Controller;

use Events\Controller\AppController;

/**
 * Events Controller
 *
 * @property \Events\Model\Table\EventsTable $Events
 * @method \Events\Model\Entity\Event[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EventsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Events->find();
        $query->contain(['AdminUsers', 'Listings']);
       
        $options['order'] = ['Events.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $events = $this->paginate($query);
        $this->set(compact('events'));
    }

    /**
     * detail method
     *
     * @param string|null $id Event id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function detail($slug)
    {
        $event = $this->Events->find()->where(['Events.slug' => $slug])->contain(['AdminUsers', 'EventDocuments', 'EventSocialLinks'])->firstOrFail();
        //dd($event);
        $this->set(compact('event'));
    }

 
    /**
     * Add/Edit method
     * Edit: param string|null $id Event id.
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function add($id = null)
    {
        if($id){
            $event = $this->Events->get($id, [
                'contain' => [],
            ]);
        }else{
            $event = $this->Events->newEmptyEntity();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $event = $this->Events->patchEntity($event, $this->request->getData());
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The event could not be saved. Please, try again.'));
        }
        $adminUsers = $this->Events->AdminUsers->find('list', ['limit' => 200]);
        $listings = $this->Events->Listings->find('list', ['limit' => 200]);
        $this->set(compact('event', 'adminUsers', 'listings'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Event id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $event = $this->Events->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $event = $this->Events->patchEntity($event, $this->request->getData());
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The event could not be saved. Please, try again.'));
        }
        $adminUsers = $this->Events->AdminUsers->find('list', ['limit' => 200]);
        $listings = $this->Events->Listings->find('list', ['limit' => 200]);
        $this->set(compact('event', 'adminUsers', 'listings'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Event id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $event = $this->Events->get($id);
        if ($this->Events->delete($event)) {
            $this->Flash->success(__('The event has been deleted.'));
        } else {
            $this->Flash->error(__('The event could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
