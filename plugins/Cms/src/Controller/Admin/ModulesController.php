<?php
declare(strict_types=1);

namespace Cms\Controller\Admin;

use Cms\Controller\AppController;

/**
 * Modules Controller
 *
 * @property \Cms\Model\Table\ModulesTable $Modules
 * @method \Cms\Model\Entity\Module[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ModulesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Modules->find();
        $query->contain(['Listings']);

        $options['order'] = ['Modules.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $modules = $this->paginate($query);
        $this->set(compact('modules'));
    }

    /**
     * View method
     *
     * @param string|null $id Module id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $module = $this->Modules->get($id, [
            'contain' => ['Listings'],
        ]);

        $this->set(compact('module'));
    }


    /**
     * Add/Edit method
     * Edit: param string|null $id Module id.
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function add($id = null)
    {
        if($id){
            $module = $this->Modules->get($id, [
                'contain' => [],
            ]);
        }else{
            $module = $this->Modules->newEmptyEntity();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $module = $this->Modules->patchEntity($module, $this->request->getData());
            if ($this->Modules->save($module)) {
                $this->Flash->success(__('The module has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The module could not be saved. Please, try again.'));
        }
        $listings = $this->Modules->Listings->find('list', ['limit' => 200]);
        $this->set(compact('module', 'listings'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Module id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $module = $this->Modules->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $module = $this->Modules->patchEntity($module, $this->request->getData());
            if ($this->Modules->save($module)) {
                $this->Flash->success(__('The module has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The module could not be saved. Please, try again.'));
        }
        $listings = $this->Modules->Listings->find('list', ['limit' => 200]);
        $this->set(compact('module', 'listings'));
    }

    /**
     * deleteimg method
     *
     * @param string|null $id CMS Page id.
     * @return \Cake\Http\Response|null Redirects to referer url.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function deleteimg($id = null) {
        $module = $this->Modules->get($id);
        if ($this->Modules->deleteImage($module->banner, $module)) {
            $this->Flash->success(__('The Module image has been deleted.'));
        } else {
            $this->Flash->error(__('The Module image could not be deleted. Please, try again.'));
        }
        return $this->redirect($this->referer());
    }

    /**
     * Delete method
     *
     * @param string|null $id Module id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function deleteNotUsed($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $module = $this->Modules->get($id);
        if ($this->Modules->delete($module)) {
            $this->Flash->success(__('The module has been deleted.'));
        } else {
            $this->Flash->error(__('The module could not be deleted. Please, try again.'));
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
        $module = $this->Modules->get($id);
        if ($this->Modules->delete($module)) {
            $result = ['status' => true, 'message' => __('The module has been deleted.')];
        } else {
            $result = ['status' => false, 'message' => __('The module could not be deleted. Please, try again.')];
        }

        $this->set([
            'code' => (isset($result['status']) && $result['status'] == true) ? 200 : 422,
            'status' => $result['status'] ?? null,
            'message' => $result['message'] ?? null,
            'data' => $module,
            'errors' => $result['errors'] ?? null,
            ]);
        $this->viewBuilder()->setOption('serialize', ['status', 'code','message','data', 'errors']);
    }
}
