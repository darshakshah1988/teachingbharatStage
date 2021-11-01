<?php
declare(strict_types=1);

namespace Listings\Controller\Admin;

use Listings\Controller\AppController;

/**
 * Listings Controller
 *
 * @property \Listings\Model\Table\ListingsTable $Listings
 * @method \Listings\Model\Entity\Listing[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ListingsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Listings->find();
        $query->contain(['ListingTypes', 'ParentListings', 'Locations']);
       
        $options['order'] = ['Listings.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $this->Authorization->authorize($query); 
        $listings = $this->paginate($this->Authorization->applyScope($query));
       $this->set(compact('listings'));
    }

    /**
     * View method
     *
     * @param string|null $id Listing id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $listing = $this->Listings->get($id, [
            'contain' => ['ListingTypes', 'ParentListings', 'Locations', 'AdminUsers', 'AcademicYears', 'InstitutionTypes', 'ListingDetails', 'ChildListings', 'Roles'],
        ]);

        $this->set(compact('listing'));
    }

    
    /**
     * quickAdd method
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function quickAdd()
    {
        if ($this->Authorization->can($this->Listings->newEmptyEntity(), 'create')) {
            return ['status' => false, 'message' => 'You don\'t have permission to access quick add form.'];
        }
        $listing = $this->Listings->newEmptyEntity();
        if ($this->request->is('ajax') && $this->request->is(['patch', 'post', 'put'])) {
            

            $listing = $this->Listings->patchEntity($listing, $this->request->getData(), ['validate' => 'quickAdd']);
            $listing->admin_user_id = $this->Authentication->getIdentity()->id;
            if ($this->Listings->save($listing)) {
                $response['message'] = __('The listing has been saved.');
                $response['status'] = true;
            }else{
                $response['message'] = __('The listing could not be saved. Please, try again.');
                $response['status'] = false;
            }

            // Specify which view vars JsonView should serialize.
        
         $this->set([
            'status' => $response['status'],
            'code' => $response['status'] ? 200 : 422,
            'message' => $response['message'],
            'errors' => $listing->getErrors()
         ]);
        $this->viewBuilder()->setOption('serialize', ['status', 'code', 'message', 'errors']);

        }else{
            $listingTypes = $this->Listings->ListingTypes->find('list', ['limit' => 200]);
            $parentListings = $this->Listings->ParentListings->find('list', ['limit' => 200]);
            $this->set(compact('listing', 'listingTypes', 'parentListings'));
        }
        
    }

    /**
     * Add/Edit method
     * Edit: param string|null $id Listing id.
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function add($id = null)
    {
        if($id){
            $listing = $this->Listings->get($id, [
                'contain' => [],
            ]);
        }else{
            $listing = $this->Listings->newEmptyEntity();
        }

        $this->Authorization->authorize($listing);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $listing = $this->Listings->patchEntity($listing, $this->request->getData());
            if ($this->Listings->save($listing)) {
                $this->Flash->success(__('The listing has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The listing could not be saved. Please, try again.'));
        }
        $listingTypes = $this->Listings->ListingTypes->find('list', ['limit' => 200]);
        $parentListings = $this->Listings->ParentListings->find('list', ['limit' => 200]);
        $locations = $this->Listings->Locations->find('list', ['limit' => 200]);
        $this->set(compact('listing', 'listingTypes', 'parentListings', 'locations'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Listing id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $listing = $this->Listings->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $listing = $this->Listings->patchEntity($listing, $this->request->getData());
            if ($this->Listings->save($listing)) {
                $this->Flash->success(__('The listing has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The listing could not be saved. Please, try again.'));
        }
        $listingTypes = $this->Listings->ListingTypes->find('list', ['limit' => 200]);
        $parentListings = $this->Listings->ParentListings->find('list', ['limit' => 200]);
        $locations = $this->Listings->Locations->find('list', ['limit' => 200]);
        $this->set(compact('listing', 'listingTypes', 'parentListings', 'locations'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Listing id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $listing = $this->Listings->get($id);
        if ($this->Listings->delete($listing)) {
            $this->Flash->success(__('The listing has been deleted.'));
        } else {
            $this->Flash->error(__('The listing could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
