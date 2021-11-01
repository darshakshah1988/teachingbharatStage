<?php
declare(strict_types=1);

namespace Courses\Controller\Admin;

use Courses\Controller\AppController;

/**
 * Boards Controller
 *
 * @property \Courses\Model\Table\BoardsTable $Boards
 * @method \Courses\Model\Entity\Board[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BoardsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Boards->find();
        $query->contain(['Listings']);
        
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $boards = $this->paginate($query);
        $this->set(compact('boards'));
    }

    /**
     * View method
     *
     * @param string|null $id Board id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $board = $this->Boards->get($id, [
            'contain' => ['Listings'],
        ]);

        $this->set(compact('board'));
    }

 
    /**
     * Add/Edit method
     * Edit: param string|null $id Board id.
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function add($id = null)
    {
        if($id){
            $board = $this->Boards->get($id, [
                'contain' => [],
            ]);
        }else{
            $board = $this->Boards->newEmptyEntity();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $board = $this->Boards->patchEntity($board, $this->request->getData());
            if ($this->Boards->save($board)) {
                $this->Flash->success(__('The board has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The board could not be saved. Please, try again.'));
        }
        $this->set(compact('board'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Board id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $board = $this->Boards->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $board = $this->Boards->patchEntity($board, $this->request->getData());
            if ($this->Boards->save($board)) {
                $this->Flash->success(__('The board has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The board could not be saved. Please, try again.'));
        }
        $listings = $this->Boards->Listings->find('list', ['limit' => 200]);
        $this->set(compact('board', 'listings'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Board id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $board = $this->Boards->get($id);
        if ($this->Boards->delete($board)) {
            $result = ['status' => true, 'message' => __('The board has been deleted.')];
        } else {
            $result = ['status' => false, 'message' => __('The board could not be deleted. Please, try again.')];
        }

        $this->set([
            'code' => (isset($result['status']) && $result['status'] == true) ? 200 : 422,
            'status' => $result['status'] ?? null,
            'message' => $result['message'] ?? null,
            'data' => $board,
            'errors' => $result['errors'] ?? null,
            ]);
        $this->viewBuilder()->setOption('serialize', ['status', 'code','message','data', 'errors']);
    }
}
