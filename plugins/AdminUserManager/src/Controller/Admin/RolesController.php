<?php
declare(strict_types=1);

namespace AdminUserManager\Controller\Admin;

use AdminUserManager\Controller\AppController;

/**
 * Roles Controller
 *
 * @property \AdminUserManager\Model\Table\RolesTable $Roles
 * @method \AdminUserManager\Model\Entity\Role[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RolesController extends AppController
{

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        //$this->Authorization->skipAuthorization();
    }
     
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Roles->find()->contain(['ListingTypes']); 
        $options['order'] = ['Roles.listing_type_id' => 'ASC', 'Roles.sort_order' => 'ASC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->Authorization->authorize($query);
        $this->paginate = $options;
        $roles = $this->paginate($query);
        $this->set(compact('roles'));
    }

    /**
     * View method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $role = $this->Roles->get($id, [
            'contain' => ['AdminUsers'],
        ]);
        $this->Authorization->authorize($role);
        $this->set(compact('role'));
    }

 
    /**
     * Add/Edit method
     * Edit: param string|null $id Role id.
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function add($id = null)
    {
        if($id){
            $role = $this->Roles->get($id, [
                'contain' => ['AdminUsers'],
            ]);
        }else{
            $role = $this->Roles->newEmptyEntity();
        }
        $this->Authorization->authorize($role, 'create');
        if ($this->request->is(['patch', 'post', 'put'])) {
            //dd($this->request->getData());
            $role = $this->Roles->patchEntity($role, $this->request->getData());
            $role->listing_type_id = 3;
            if ($this->Roles->save($role)) {
                $this->Flash->success(__('The role has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The role could not be saved. Please, try again.'));
        }
        $adminUsers = $this->Roles->AdminUsers->find('list', ['limit' => 200]);
        $listingTypes = $this->Roles->ListingTypes->find('list', ['limit' => 200]);
        $this->set(compact('role', 'adminUsers', 'listingTypes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $role = $this->Roles->get($id, [
            'contain' => ['AdminUsers'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $role = $this->Roles->patchEntity($role, $this->request->getData());
            if ($this->Roles->save($role)) {
                $this->Flash->success(__('The role has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The role could not be saved. Please, try again.'));
        }
        $adminUsers = $this->Roles->AdminUsers->find('list', ['limit' => 200]);
        $this->set(compact('role', 'adminUsers'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $role = $this->Roles->get($id);
        if ($this->Roles->delete($role)) {
            $result = ['status' => true, 'message' => __('The role has been deleted.')];
        } else {
            $result = ['status' => false, 'message' => __('The role could not be deleted. Please, try again.')];
        }

        $this->set([
            'code' => (isset($result['status']) && $result['status'] == true) ? 200 : 422,
            'status' => $result['status'] ?? null,
            'message' => $result['message'] ?? null,
            'data' => $role,
            'errors' => $result['errors'] ?? null,
            ]);
        $this->viewBuilder()->setOption('serialize', ['status', 'code','message','data', 'errors']);
    }
}
