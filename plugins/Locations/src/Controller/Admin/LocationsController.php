<?php
declare(strict_types=1);

namespace Locations\Controller\Admin;

use Locations\Controller\AppController;

/**
 * Locations Controller
 *
 * @property \Locations\Model\Table\LocationsTable $Locations
 * @method \Locations\Model\Entity\Location[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LocationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Locations->find();
        $query->contain(['ParentLocations']);
       
        $options['order'] = ['Locations.lft' => 'ASC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $locations = $this->paginate($query);
        $this->set(compact('locations'));
    }

    /**
     * View method
     *
     * @param string|null $id Location id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $location = $this->Locations->get($id, [
            'contain' => ['ParentLocations', 'ChildLocations'],
        ]);

        $this->set(compact('location'));
    }

 
    /**
     * Add/Edit method
     * Edit: param string|null $id Location id.
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function add($id = null)
    {
        if($id){
            $location = $this->Locations->get($id, [
                'contain' => [],
            ]);
            $conditions['id !='] = $id;
            $children = $this->Locations
                ->find('children', ['for' => $id])
                ->find('threaded')
                ->find('list')
                ->toArray();
            if(!empty($children)){
                $conditions['ParentLocations.id NOT IN'] = array_keys($children);
            } 
        }else{
            $location = $this->Locations->newEmptyEntity();
            $conditions = [];
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $location = $this->Locations->patchEntity($location, $this->request->getData());
            if ($this->Locations->save($location)) {
                $this->Flash->success(__('The location has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The location could not be saved. Please, try again.'));
        }
        $parentLocations = $this->Locations->ParentLocations->find()->find('treeList', ['keyField' => 'id', 'valueField' => 'title'])->where($conditions)->toArray();
        $this->set(compact('location', 'parentLocations'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Location id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $location = $this->Locations->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $location = $this->Locations->patchEntity($location, $this->request->getData());
            if ($this->Locations->save($location)) {
                $this->Flash->success(__('The location has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The location could not be saved. Please, try again.'));
        }
        $parentLocations = $this->Locations->ParentLocations->find('list', ['limit' => 200]);
        $this->set(compact('location', 'parentLocations'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Location id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $location = $this->Locations->get($id);
        if ($this->Locations->delete($location)) {
            $result = ['status' => true, 'message' => __('The location has been deleted.')];
        } else {
            $result = ['status' => false, 'message' => __('The location could not be deleted. Please, try again.')];
        }

        $this->set([
            'code' => (isset($result['status']) && $result['status'] == true) ? 200 : 422,
            'status' => $result['status'] ?? null,
            'message' => $result['message'] ?? null,
            'data' => $location,
            'errors' => $result['errors'] ?? null,
            ]);
        $this->viewBuilder()->setOption('serialize', ['status', 'code','message','data', 'errors']);
    }
}
