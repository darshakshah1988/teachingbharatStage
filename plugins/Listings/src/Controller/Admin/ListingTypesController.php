<?php
declare(strict_types=1);

namespace Listings\Controller\Admin;

use Listings\Controller\AppController;

/**
 * ListingTypes Controller
 *
 * @property \Listings\Model\Table\ListingTypesTable $ListingTypes
 * @method \Listings\Model\Entity\ListingType[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ListingTypesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->ListingTypes->find();
        $options['order'] = ['ListingTypes.sort_order' => 'ASC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;

        // $user = $this->request->getAttribute('identity');
        // if(!$user->can('index', $query)){
        //    echo \Cake\Routing\Router::url([
        //                     'plugin' => 'AdminUserManager',
        //                     'prefix' => 'Admin',
        //                     'controller' => 'AdminUsers',
        //                     'action' => 'login'
        //                 ]);die;
        // }

        $this->Authorization->authorize($query);
        $listingTypes = $this->paginate($query);
        $this->set(compact('listingTypes'));
    }

    /**
     * View method
     *
     * @param string|null $id Listing Type id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $listingType = $this->ListingTypes->get($id, [
            'contain' => ['ListingTypeCategories', 'Listings'],
        ]);
        $this->Authorization->authorize($listingType);
        $this->set(compact('listingType'));
    }

 
    /**
     * Add/Edit method
     * Edit: param string|null $id Listing Type id.
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function add($id = null)
    {
        if($id){
            $listingType = $this->ListingTypes->get($id, [
                'contain' => [],
            ]);
        }else{
            $listingType = $this->ListingTypes->newEmptyEntity();
        }
        $this->Authorization->authorize($listingType);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $listingType = $this->ListingTypes->patchEntity($listingType, $this->request->getData());
            if ($this->ListingTypes->save($listingType)) {
                $this->Flash->success(__('The listing type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The listing type could not be saved. Please, try again.'));
        }
        $this->set(compact('listingType'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Listing Type id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $listingType = $this->ListingTypes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $listingType = $this->ListingTypes->patchEntity($listingType, $this->request->getData());
            if ($this->ListingTypes->save($listingType)) {
                $this->Flash->success(__('The listing type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The listing type could not be saved. Please, try again.'));
        }
        $this->set(compact('listingType'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Listing Type id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $listingType = $this->ListingTypes->get($id);
        if ($this->ListingTypes->delete($listingType)) {
            $this->Flash->success(__('The listing type has been deleted.'));
        } else {
            $this->Flash->error(__('The listing type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
