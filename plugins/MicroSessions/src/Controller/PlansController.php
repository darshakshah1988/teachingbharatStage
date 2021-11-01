<?php
declare(strict_types=1);

namespace MicroSessions\Controller;

use MicroSessions\Controller\AppController;

/**
 * Plans Controller
 *
 * @method \MicroSessions\Model\Entity\Plan[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PlansController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index($package_id = null)
    {

        $query = $this->Plans->find('all', ['conditions'=>["Plans.package_id = ".$package_id]]);       
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $plans = $this->paginate($query);   
        $this->set(compact('plans','package_id'));
    }

    /**
     * View method
     *
     * @param string|null $id Plan id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null,$package_id=null)
    {
        $plan = $this->Plans->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('plan','id','package_id'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($package_id= null)
    {
        $plan = $this->Plans->newEmptyEntity();
        if ($this->request->is('post')) {
            $plan = $this->Plans->patchEntity($plan, $this->request->getData());
             $plan->package_id = $package_id;  
             $plan->user_id = $this->getRequest()->getAttribute('identity')->id;              
            if ($this->Plans->save($plan)) {
                $this->Flash->success(__('The plan has been saved.'));
                return $this->redirect(['action' => 'index',$package_id]);
            }
            $this->Flash->error(__('The plan could not be saved. Please, try again.'));
        }
        $this->set(compact('plan','package_id'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Plan id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null,$package_id=null)
    {
        $plan = $this->Plans->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $plan = $this->Plans->patchEntity($plan, $this->request->getData());
            if ($this->Plans->save($plan)) {
                $this->Flash->success(__('The plan has been saved.'));

                return $this->redirect(['action' => 'index',$package_id]);
            }
            $this->Flash->error(__('The plan could not be saved. Please, try again.'));
        }
        $this->set(compact('plan','package_id'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Plan id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null,$package_id=null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $plan = $this->Plans->get($id);        
        if ($this->Plans->delete($plan)) {
           $result = ['status' => true, 'message' => __('The plan has been deleted.')];
        } else {
            $result = ['status' => false, 'message' => __('The plan could not be deleted. Please, try again.')];
        }
        $this->set([
                    'code' => (isset($result['status']) && $result['status'] == true) ? 200 : 422,
                    'status' => $result['status'] ?? null,
                    'message' => $result['message'] ?? null,
                    'data' => $plan,
                    'errors' => $result['errors'] ?? null,
                    ]);
                $this->viewBuilder()->setOption('serialize', ['status', 'code','message','data', 'errors']);
    }
}
