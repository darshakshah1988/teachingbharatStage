<?php
declare(strict_types=1);

namespace Listings\Controller\Admin;

use Listings\Controller\AppController;

/**
 * ListingTypeCategories Controller
 *
 * @property \Listings\Model\Table\ListingTypeCategoriesTable $ListingTypeCategories
 * @method \Listings\Model\Entity\ListingTypeCategory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ListingTypeCategoriesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->ListingTypeCategories->find();
        $query->contain(['ListingTypes']);
       
        $options['order'] = ['ListingTypeCategories.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $this->Authorization->authorize($query);
        $listingTypeCategories = $this->paginate($query);
        $this->set(compact('listingTypeCategories'));
    }

    /**
     * View method
     *
     * @param string|null $id Listing Type Category id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $listingTypeCategory = $this->ListingTypeCategories->get($id, [
            'contain' => ['ListingTypes', 'ListingDetails'],
        ]);

        $this->set(compact('listingTypeCategory'));
    }

 
    /**
     * Add/Edit method
     * Edit: param string|null $id Listing Type Category id.
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function add($id = null)
    {
        if($id){
            $listingTypeCategory = $this->ListingTypeCategories->get($id, [
                'contain' => [],
            ]);
        }else{
            $listingTypeCategory = $this->ListingTypeCategories->newEmptyEntity();
        }
        $this->Authorization->authorize($listingTypeCategory);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $listingTypeCategory = $this->ListingTypeCategories->patchEntity($listingTypeCategory, $this->request->getData());
            if ($this->ListingTypeCategories->save($listingTypeCategory)) {
                $this->Flash->success(__('The listing type category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The listing type category could not be saved. Please, try again.'));
        }
        $listingTypes = $this->ListingTypeCategories->ListingTypes->find('list', ['limit' => 200]);
        $this->set(compact('listingTypeCategory', 'listingTypes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Listing Type Category id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $listingTypeCategory = $this->ListingTypeCategories->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $listingTypeCategory = $this->ListingTypeCategories->patchEntity($listingTypeCategory, $this->request->getData());
            if ($this->ListingTypeCategories->save($listingTypeCategory)) {
                $this->Flash->success(__('The listing type category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The listing type category could not be saved. Please, try again.'));
        }
        $listingTypes = $this->ListingTypeCategories->ListingTypes->find('list', ['limit' => 200]);
        $this->set(compact('listingTypeCategory', 'listingTypes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Listing Type Category id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $listingTypeCategory = $this->ListingTypeCategories->get($id);
        if ($this->ListingTypeCategories->delete($listingTypeCategory)) {
            $this->Flash->success(__('The listing type category has been deleted.'));
        } else {
            $this->Flash->error(__('The listing type category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
