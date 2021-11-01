<?php
declare(strict_types=1);

namespace Referrals\Controller;

use Referrals\Controller\AppController;

/**
 * Referrals Controller
 *
 * @method \Referrals\Model\Entity\Referral[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReferralsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
    }

    /**
     * View method
     *
     * @param string|null $id Referral id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $referral = $this->Referrals->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('referral'));
    }

 
    /**
     * Add/Edit method
     * Edit: param string|null $id Referral id.
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function add($id = null)
    {
        if($id){
            $referral = $this->Referrals->get($id, [
                'contain' => [],
            ]);
        }else{
            $referral = $this->Referrals->newEmptyEntity();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $referral = $this->Referrals->patchEntity($referral, $this->request->getData());
            if ($this->Referrals->save($referral)) {
                $this->Flash->success(__('The referral has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The referral could not be saved. Please, try again.'));
        }
        $this->set(compact('referral'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Referral id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $referral = $this->Referrals->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $referral = $this->Referrals->patchEntity($referral, $this->request->getData());
            if ($this->Referrals->save($referral)) {
                $this->Flash->success(__('The referral has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The referral could not be saved. Please, try again.'));
        }
        $this->set(compact('referral'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Referral id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $referral = $this->Referrals->get($id);
        if ($this->Referrals->delete($referral)) {
            $this->Flash->success(__('The referral has been deleted.'));
        } else {
            $this->Flash->error(__('The referral could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
