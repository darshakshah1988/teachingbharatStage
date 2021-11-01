<?php
declare(strict_types=1);

namespace Promotions\Controller\Admin;

use Promotions\Controller\AppController;

/**
 * Coupons Controller
 *
 * @property \Promotions\Model\Table\CouponsTable $Coupons
 * @method \Promotions\Model\Entity\Coupon[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CouponsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Coupons->find();
        $options['order'] = ['Coupons.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $coupons = $this->paginate($query);
        $this->set(compact('coupons'));
    }

    /**
     * View method
     *
     * @param string|null $id Coupon id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $coupon = $this->Coupons->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('coupon'));
    }

 
    /**
     * Add/Edit method
     * Edit: param string|null $id Coupon id.
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function add($id = null)
    {
        if($id){
            $coupon = $this->Coupons->get($id, [
                'contain' => [],
            ]);
        }else{
            $coupon = $this->Coupons->newEmptyEntity();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $coupon = $this->Coupons->patchEntity($coupon, $this->request->getData());
            if ($this->Coupons->save($coupon)) {
                $this->Flash->success(__('The coupon has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The coupon could not be saved. Please, try again.'));
        }
        $this->set(compact('coupon'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Coupon id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $coupon = $this->Coupons->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $coupon = $this->Coupons->patchEntity($coupon, $this->request->getData());
            if ($this->Coupons->save($coupon)) {
                $this->Flash->success(__('The coupon has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The coupon could not be saved. Please, try again.'));
        }
        $this->set(compact('coupon'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Coupon id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $coupon = $this->Coupons->get($id);
        if ($this->Coupons->delete($coupon)) {
            $this->Flash->success(__('The coupon has been deleted.'));
        } else {
            $this->Flash->error(__('The coupon could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
