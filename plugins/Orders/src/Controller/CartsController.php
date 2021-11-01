<?php
declare(strict_types=1);

namespace Orders\Controller;

use Orders\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Carts Controller
 *
 * @property \Orders\Model\Table\CartsTable $Carts
 * @method \Orders\Model\Entity\Cart[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CartsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
         parent::initialize();
        $query = $this->Carts->find('myCart', ['user_id' => $this->getRequest()->getAttribute('identity')->id]);
        $query->contain(['Users', 'Courses.GradingTypes', 'Courses.Subjects']);
        $options['order'] = ['Carts.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $carts = $this->paginate($query);
        //dd($carts); die;
        $availableFund = $this->Carts->Users->Transactions->availableFund($this->getRequest()->getAttribute('identity')->id);

        $this->set(compact('carts', 'availableFund'));
    }

     public function microsession($micro_session_id= null)
    {
         parent::initialize();
        $this->loadModel('MicroSessions');
        $query = $this->Carts->find('myCart', ['user_id' => $this->getRequest()->getAttribute('identity')->id]);
        $query->contain(['Users', 'MicroSessions.GradingTypes', 'MicroSessions.Subjects']);

        $options['order'] = ['Carts.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $carts = $this->paginate($query);

 //dd($carts); die;
        $availableFund = $this->Carts->Users->Transactions->availableFund($this->getRequest()->getAttribute('identity')->id);

        $this->set(compact('carts', 'availableFund'));
    }

     public function packages($package_id = null,$plan_id = null)
    {
        //dd("sfdsd".$package_id.$plan_id); die;
         parent::initialize();
        $this->loadModel('MicroSessions');
        $this->loadModel('Packages');
        $this->loadModel('Plans');
        $query = $this->Carts->find('myCart', ['user_id' => $this->getRequest()->getAttribute('identity')->id]);
        $query->contain(['Users', 'Packages', 'Plans']);

        $options['order'] = ['Carts.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.ADMIN_PAGE_LIMIT');
        $this->paginate = $options;
        $carts = $this->paginate($query);
   // echo $query."<pre>";
   // print_r($carts); die;
        $availableFund = $this->Carts->Users->Transactions->availableFund($this->getRequest()->getAttribute('identity')->id);

        $this->set(compact('carts', 'availableFund'));
    }




    /**
     * View method
     *
     * @param string|null $id Cart id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cart = $this->Carts->get($id, [
            'contain' => ['Users', 'Courses','MicroSessions'],
        ]);

        $this->set(compact('cart'));
    }

    /**
     * coupon method
     *
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function coupon()
    {
        $couponRes = [];
        if($this->request->getData('coupon')){
            $couponObj = TableRegistry::getTableLocator()->get('Promotions.Coupons');
            $session = $this->request->getSession();
            if($this->getRequest()->getAttribute('identity') && $this->getRequest()->getAttribute('identity')->id){
                    $user_id = $this->getRequest()->getAttribute('identity')->id;
                }else{
                    $user_id = 0;
                }
            $couponData['code'] =  $this->request->getData('coupon');
            $couponData['user_id'] = $user_id;

            $couponRes = $couponObj->getCoupon($couponData);

            //dd($couponRes);

            if(!empty($couponRes) && $couponRes['code'] == $this->request->getData('coupon')){
                $session->delete('promotion_coupon');
                $session->write('promotion_coupon',$couponRes);
                $response = ['status' => true,'message' => "Your coupon discount has been applied!"];
             }else{
                $session->delete('promotion_coupon');

                $response = ['status' => false,'message' => "Coupon is either invalid, expired or reached its usage limit!"];
            }

        }else{
            $response = ['status' => false, 'message' => __('Please enter a coupon code!')];
        }


        $this->set([
            'code' => (isset($response['status']) && $response['status'] == true) ? 200 : 422,
            'status' => $response['status'] ?? null,
            'message' => $response['message'] ?? null,
            'data' => $couponRes,
            'errors' => $response['errors'] ?? null,
            ]);
        $this->viewBuilder()->setOption('serialize', ['status', 'code','message','data', 'errors']);
    }


    /**
     * Delete method
     *
     * @param string|null $id Cart id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function removeCoupon()
    {
        $session = $this->request->getSession();
        $session->delete('promotion_coupon');
        return $this->redirect($this->referer());
    }



    /**
     * Delete method
     *
     * @param string|null $id Cart id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete', 'get']);
        $cart = $this->Carts->get($id);
        if ($this->Carts->delete($cart)) {
            $this->Flash->success(__('The Course has been deleted from the list.'));
        } else {
            $this->Flash->error(__('The cart could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
