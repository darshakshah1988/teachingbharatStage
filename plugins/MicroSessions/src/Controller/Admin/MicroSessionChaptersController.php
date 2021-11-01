<?php
declare(strict_types=1);

namespace MicroSessions\Controller\Admin;

use MicroSessions\Controller\AppController;

/**
 * MicroSessionChapters Controller
 *
 * @method \MicroSessions\Model\Entity\MicroSessionChapter[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MicroSessionChaptersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->MicroSessionChapters->find();
        $options['order'] = ['MicroSessionChapters.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $microSessionChapters = $this->paginate($query);
        $this->set(compact('microSessionChapters'));
    }

    /**
     * View method
     *
     * @param string|null $id Micro Session Chapter id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $microSessionChapter = $this->MicroSessionChapters->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('microSessionChapter'));
    }

 
    /**
     * Add/Edit method
     * Edit: param string|null $id Micro Session Chapter id.
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function add($id = null)
    {
        if($id){
            $microSessionChapter = $this->MicroSessionChapters->get($id, [
                'contain' => [],
            ]);
        }else{
            $microSessionChapter = $this->MicroSessionChapters->newEmptyEntity();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $microSessionChapter = $this->MicroSessionChapters->patchEntity($microSessionChapter, $this->request->getData());
            if ($this->MicroSessionChapters->save($microSessionChapter)) {
                $this->Flash->success(__('The micro session chapter has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The micro session chapter could not be saved. Please, try again.'));
        }
        $this->set(compact('microSessionChapter'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Micro Session Chapter id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $microSessionChapter = $this->MicroSessionChapters->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $microSessionChapter = $this->MicroSessionChapters->patchEntity($microSessionChapter, $this->request->getData());
            if ($this->MicroSessionChapters->save($microSessionChapter)) {
                $this->Flash->success(__('The micro session chapter has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The micro session chapter could not be saved. Please, try again.'));
        }
        $this->set(compact('microSessionChapter'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Micro Session Chapter id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $microSessionChapter = $this->MicroSessionChapters->get($id);
        if ($this->MicroSessionChapters->delete($microSessionChapter)) {
            $this->Flash->success(__('The micro session chapter has been deleted.'));
        } else {
            $this->Flash->error(__('The micro session chapter could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
