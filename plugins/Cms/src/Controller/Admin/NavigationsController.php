<?php
declare(strict_types=1);

namespace Cms\Controller\Admin;

use Cms\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Navigations Controller
 *
 * @method \Cms\Model\Entity\Navigation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NavigationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Navigations->find();
        $options['order'] = ['Navigations.lft' => 'ASC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $navigations = $this->paginate($query);
        $this->set(compact('navigations'));
    }

    /**
     * View method
     *
     * @param string|null $id Navigation id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $navigation = $this->Navigations->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('navigation'));
    }

 
    /**
     * Add/Edit method
     * Edit: param string|null $id Navigation id.
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function add($id = null)
    {
        if($id){
            $navigation = $this->Navigations->get($id, [
                'contain' => [],
            ]);
            $conditions['id !='] = $id;
            $children = $this->Navigations
                ->find('children', ['for' => $id])
                ->find('threaded')
                ->find('list')
                ->toArray();
            if(!empty($children)){
                $conditions['ParentNavigations.id NOT IN'] = array_keys($children);
            } 
        }else{
            $navigation = $this->Navigations->newEmptyEntity();
            $conditions = [];
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $navigation = $this->Navigations->patchEntity($navigation, $this->request->getData());
            if ($this->Navigations->save($navigation)) {
                $this->Flash->success(__('The navigation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The navigation could not be saved. Please, try again.'));
        }
        $parentNavigations = $this->Navigations->ParentNavigations->find('parentdomain')->find('treeList', ['keyField' => 'id', 'valueField' => 'title'])->where($conditions)->toArray();
        $modules = TableRegistry::getTableLocator()->get('Cms.Modules')->find('list', ['keyField' => 'json_path', 'valueField' => 'title'])->toArray();
        $cmspages = TableRegistry::getTableLocator()->get('Cms.Pages')->find('list', ['keyField' => 'slug', 'valueField' => 'title'])->toArray();
        $pages = [];
        foreach ($cmspages as $key => $value) {
            $pages[json_encode(['plugin' => 'Cms', 'controller' => 'Pages', 'action' => 'detail', 'slug' => $key])] = $value;
        }
        $this->set(compact('navigation', 'parentNavigations', 'modules', 'pages'));
    }

    /**
     * moveUp method
     *
     * @param string|null $id Navigation id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function moveUp($id = null)
    {

        $navigation = $this->Navigations->get($id, [
            'contain' => [],
        ]);
        $this->Navigations->moveUp($navigation);
       $this->Flash->success(__('The navigation has been move top.'));

        return $this->redirect(['action' => 'index']);
    }

     /**
     * moveDown method
     *
     * @param string|null $id Navigation id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function moveDown($id = null)
    {
        $navigation = $this->Navigations->get($id, [
            'contain' => [],
        ]);
        $this->Navigations->moveUp($navigation);
       $this->Flash->success(__('The navigation has been move down.'));
       return $this->redirect(['action' => 'index']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Navigation id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function deleteNotUsed($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $navigation = $this->Navigations->get($id);
        if ($this->Navigations->delete($navigation)) {
            $this->Flash->success(__('The navigation has been deleted.'));
        } else {
            $this->Flash->error(__('The navigation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

     /**
     * Delete method
     *
     * @param string|null $id Enquiry Status id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $navigation = $this->Navigations->get($id);
        if ($this->Navigations->delete($navigation)) {
            $result = ['status' => true, 'message' => __('The navigation has been deleted.')];
        } else {
            $result = ['status' => false, 'message' => __('The navigation could not be deleted. Please, try again.')];
        }

        $this->set([
            'code' => (isset($result['status']) && $result['status'] == true) ? 200 : 422,
            'status' => $result['status'] ?? null,
            'message' => $result['message'] ?? null,
            'data' => $navigation,
            'errors' => $result['errors'] ?? null,
            ]);
        $this->viewBuilder()->setOption('serialize', ['status', 'code','message','data', 'errors']);
    }
}
