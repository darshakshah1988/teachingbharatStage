<?php
declare(strict_types=1);

namespace UserManager\Controller\Admin;

use UserManager\Controller\AppController;

/**
 * Occupations Controller
 *
 * @method \UserManager\Model\Entity\Occupation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OccupationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Occupations->find();
        $options['order'] = ['Occupations.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $occupations = $this->paginate($query);
        $this->set(compact('occupations'));
    }


    /**
     * View method
     *
     * @param string|null $id Occupation id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $occupation = $this->Occupations->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('occupation'));
    }

 
    /**
     * Add/Edit method
     * Edit: param string|null $id Occupation id.
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function add($id = null)
    {
        if($id){
            $occupation = $this->Occupations->get($id, [
                'contain' => [],
            ]);
        }else{
            $occupation = $this->Occupations->newEmptyEntity();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $occupation = $this->Occupations->patchEntity($occupation, $this->request->getData());
            if ($this->Occupations->save($occupation)) {
                $this->Flash->success(__('The occupation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The occupation could not be saved. Please, try again.'));
        }
        $this->set(compact('occupation'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Occupation id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $occupation = $this->Occupations->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $occupation = $this->Occupations->patchEntity($occupation, $this->request->getData());
            if ($this->Occupations->save($occupation)) {
                $this->Flash->success(__('The occupation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The occupation could not be saved. Please, try again.'));
        }
        $this->set(compact('occupation'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Occupation id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $occupation = $this->Occupations->get($id);
        if ($this->Occupations->delete($occupation)) {
            $result = ['status' => true, 'message' => __('The occupation has been deleted.')];
        } else {
            $result = ['status' => false, 'message' => __('The occupation could not be deleted. Please, try again.')];
        }

        $this->set([
            'code' => (isset($result['status']) && $result['status'] == true) ? 200 : 422,
            'status' => $result['status'] ?? null,
            'message' => $result['message'] ?? null,
            'data' => $occupation,
            'errors' => $result['errors'] ?? null,
            ]);
        $this->viewBuilder()->setOption('serialize', ['status', 'code','message','data', 'errors']);
    }
}
