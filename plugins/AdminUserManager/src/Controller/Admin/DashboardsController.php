<?php
declare(strict_types=1);

namespace AdminUserManager\Controller\Admin;

use AdminUserManager\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Dashboards Controller
 *
 * @method \AdminUserManager\Model\Entity\AdminUser[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DashboardsController extends AppController
{

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        $this->Authorization->skipAuthorization();
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
         $user = $this->Authentication->getIdentity()->listing->listing_type_id;

         if(\Cake\Core\Configure::read('Tech.listing_type_id') == 1){
            $view = "dashboard";
         }else if(in_array(\Cake\Core\Configure::read('Tech.listing_type_id'), [2, 3, 4, 5])){
            $view = "institution";
         }

         $this->render($view);

    }

     /**
     * dashboard method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function dashboard()
    {
        $adminUsers = $this->paginate($this->AdminUsers);

        $this->set(compact('adminUsers'));
    }

    public function login()
    {
        //echo (new DefaultPasswordHasher)->hash('123456');die;
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            // redirect to /articles after login success

            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'Dashboard',
                'action' => 'dashboard',
            ]);
            //dd($redirect);

            return $this->redirect($redirect);
        }
        // display error if user submitted and authentication failed
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid username or password'), ['plugin' => 'CustomTheme']);
        }
}

    /**
     * View method
     *
     * @param string|null $id Admin User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $adminUser = $this->AdminUsers->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('adminUser'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $adminUser = $this->AdminUsers->newEmptyEntity();
        if ($this->request->is('post')) {
            $adminUser = $this->AdminUsers->patchEntity($adminUser, $this->request->getData());
            if ($this->AdminUsers->save($adminUser)) {
                $this->Flash->success(__('The admin user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The admin user could not be saved. Please, try again.'));
        }
        $this->set(compact('adminUser'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Admin User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $adminUser = $this->AdminUsers->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $adminUser = $this->AdminUsers->patchEntity($adminUser, $this->request->getData());
            if ($this->AdminUsers->save($adminUser)) {
                $this->Flash->success(__('The admin user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The admin user could not be saved. Please, try again.'));
        }
        $this->set(compact('adminUser'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Admin User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $adminUser = $this->AdminUsers->get($id);
        if ($this->AdminUsers->delete($adminUser)) {
            $this->Flash->success(__('The admin user has been deleted.'));
        } else {
            $this->Flash->error(__('The admin user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    // in src/Controller/UsersController.php
    public function logout()
    {
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'AdminUsers', 'action' => 'login']);
        }
    }


}
