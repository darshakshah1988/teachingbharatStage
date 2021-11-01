<?php
declare(strict_types=1);

namespace MicroSessions\Controller\Admin;

use MicroSessions\Controller\AppController;

/**
 * MicroSessions Controller
 *
 * @method \MicroSessions\Model\Entity\MicroSession[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MicroSessionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->MicroSessions->find();
        $options['order'] = ['MicroSessions.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $microSessions = $this->paginate($query);
        $this->set(compact('microSessions'));
    }

    /**
     * View method
     *
     * @param string|null $id Micro Session id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $microSession = $this->MicroSessions->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('microSession'));
    }

 
    /**
     * Add/Edit method
     * Edit: param string|null $id Micro Session id.
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function add($id = null)
    {
        if($id){
            $microSession = $this->MicroSessions->get($id, [
                'contain' => [],
            ]);
        }else{
            $microSession = $this->MicroSessions->newEmptyEntity();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $microSession = $this->MicroSessions->patchEntity($microSession, $this->request->getData());
            if ($this->MicroSessions->save($microSession)) {
                $this->Flash->success(__('The micro session has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The micro session could not be saved. Please, try again.'));
        }
        $this->set(compact('microSession'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Micro Session id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $microSession = $this->MicroSessions->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $microSession = $this->MicroSessions->patchEntity($microSession, $this->request->getData());
            if ($this->MicroSessions->save($microSession)) {
                $this->Flash->success(__('The micro session has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The micro session could not be saved. Please, try again.'));
        }
        $this->set(compact('microSession'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Micro Session id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $microSession = $this->MicroSessions->get($id);
        if ($this->MicroSessions->delete($microSession)) {
            $this->Flash->success(__('The micro session has been deleted.'));
        } else {
            $this->Flash->error(__('The micro session could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
