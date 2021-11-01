<?php
declare(strict_types=1);

namespace Orders\Controller;

use Orders\Controller\AppController;
use Cake\ORM\TableRegistry;
use App\Razorpay;
use Cake\Event\Event;
/**
 * Orders Controller
 *
 * @property \Orders\Model\Table\OrdersTable $Orders
 * @method \Orders\Model\Entity\Order[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrdersController extends AppController
{

    /**
     * checkout method
     *
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

     public function getallmicrosessions()
        {
 $query = $this->Orders->find('all')
        ->select(['packages.id','packages.package_name','packages.subject_id','subjects.id','subjects.title' ])
        ->select($this->Orders)
        ->where(["order_courses.package_id != '' ", "order_courses.plan_id != '' "])

        ->join([
            'order_courses' => [
                'table' => 'order_courses',
                'type' => 'LEFT',
                'conditions' => 'order_courses.order_id = Orders.id'
            ],
            'packages' => [
                'table' => 'packages',
                'type' => 'LEFT',
                'conditions' => 'packages.id = order_courses.package_id'
            ],
            'subjects' => [
                'table' => 'subjects',
                'type' => 'LEFT',
                'conditions' => 'subjects.id = packages.subject_id'
            ],
            'user' => [
                'table' => 'users',
                'type' => 'LEFT',
                'conditions' => 'user.id = Orders.user_id'
            ]
        ]);
       $options['order'] = ['Orders.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.PAGE_LIMIT');
        $this->paginate = $options;
        $orders = $this->paginate($query);
        // echo $query."<pre>";
        // print_r( $orders);
         $MicroSessions=$this->loadModel('MicroSessions');

         foreach($orders as $order){
            // $mappings ="";
            $subjects=explode(",",$order->packages['subject_id']);
            //  print_r($order->packages['subject_id']);
             foreach($subjects as $subject_id){
//echo '<pre><br>subject_id='.$subject_id.'<br>';

$microSessions = $this->MicroSessions->find()->where(['subject_id' => $subject_id])->first();
if($microSessions){
   // print_r($microSessions);
    $this->loadModel('TeacherStudentMappings');
    $mappings  = $this->TeacherStudentMappings->newEmptyEntity();
    $isMappings = $this->TeacherStudentMappings->find()
                    ->where([
                          'TeacherStudentMappings.package_id' => $order->packages['id'],
                          'TeacherStudentMappings.student_id' => $order->user_id,
                          'TeacherStudentMappings.subject_id' => $subject_id]
                      )->first();
//print_r($isMappings);
    if(!$isMappings){
    $mappings->student_id=$order->user_id;
    $mappings->package_id=$order->packages['id'];
    $mappings->subject_id=$subject_id;
    $mappings->micro_session_id=$microSessions->id;
    $mappings->teacher_id=$microSessions->user_id;
    $mappings->created= Date('Y-m-d H:i:s');
    $mappings->modified= Date('Y-m-d H:i:s');
//print_r($mappings);
//die();
    $this->TeacherStudentMappings->save($mappings);
        if ($this->TeacherStudentMappings->save($mappings)) {
           echo('<br>The teacher student mapping has been saved.');
        }else{
    echo('<br>The teacher student mapping has not saved.');
        }
    }
}else{
   echo "<br>No result found";
}
             }

         }
         die();

        }

      public function packagecheckout()
    {
        $cartObj = TableRegistry::getTableLocator()->get('Orders.Carts');
        $carts = $cartObj->find()->where(['Carts.user_id' => $this->getRequest()->getAttribute('identity')->id])->contain(['Packages','Plans'])->all();

        if(empty($carts->toArray())){
            return $this->redirect(['controller'=>'Carts','action'=>'index']);
        }

        $availableFund = $cartObj->Users->Transactions->availableFund($this->getRequest()->getAttribute('identity')->id);

        $session = $this->request->getSession();

        $amount = 0;
        $discount = 0;
        $cartData = [];
        foreach($carts as $cart){
            $amount += $cart->plan->price;
            $discount += $cart->plan->discount_price;
            $cartData[] = ['package_id' => $cart->package_id,'plan_id' => $cart->plan_id, 'amount' => $cart->plan->price, 'discount' => $cart->plan->discount_price, 'total_amount' => ($cart->plan->price - $cart->plan->discount_price)];
        }


            $total_amount = $amount > $discount ? ($amount - $discount) : 0;
            $withDiscount =  ($total_amount > $availableFund ? ($total_amount - $availableFund) : 0);
            $referralCredits = ($availableFund > $total_amount ? $availableFund - $total_amount: 0);
            if($referralCredits > 0){
                $refralDiscount = $total_amount;
            }else{
                $refralDiscount = $availableFund;
            }

            if(!empty($refralDiscount) && $refralDiscount > 0){
                $additional_options = json_encode(['referral_withdraw' => $refralDiscount, 'referral_deposit' => $referralCredits]);
            }

            $couponData = [];
            if($session->read('promotion_coupon')){

                $disType = $session->read('promotion_coupon.coupon_type');
                $disAmount = $session->read('promotion_coupon.discount');
                if($disType == "p"){
                    $disAmount = ($disAmount / 100) * $withDiscount;
                }
                $withDiscount = $withDiscount - $disAmount;
                $couponData['user_id'] = $this->getRequest()->getAttribute('identity')->id;
                $couponData['coupon_id'] = $session->read('promotion_coupon.id');
                $couponData['amount'] = $disAmount;
            }

         $order = $this->Orders->newEmptyEntity();
         $orderData = ['user_id' => $this->getRequest()->getAttribute('identity')->id, 'amount' => $amount, 'discount' => $discount, 'total_amount' => ($withDiscount),'additional_options' => $additional_options ?? null, 'order_date' => date('Y-m-d H:i:s'), 'order_courses' => $cartData, 'order_coupons' => !empty($couponData) ? [$couponData] : null];
            $order = $this->Orders->patchEntity($order, $orderData);

           // echo "<pre>";
           // print_r($orderData);
           // die();
            if ($this->Orders->save($order)) {
                $session->delete('promotion_coupon');
                if($referralCredits > 0){
                    $cartObj->Users->Transactions->WithDrawAllAndDeposit($this->getRequest()->getAttribute('identity')->id, $referralCredits);
                }else if($availableFund > 0){
                    $cartObj->Users->Transactions->updateAll(
                        [  // fields
                            'transaction_type' => 2,
                        ],
                        [  // conditions
                            'transaction_type' => 1,
                            'user_id' => $this->getRequest()->getAttribute('identity')->id
                        ]
                    );
                }

                $invoice_no = "INV-".date('Y-m').'-'.$order->id;
                $order->invoice_no = $invoice_no;
                $razorpay = new \App\Razorpay\Razorpay();

                $razorpayOrder = $razorpay->orderCreate(['receipt' => $order->id, 'booking_amount' => $orderData['total_amount'], 'invoice_no' => $invoice_no]);
                $this->Orders->query()->update()
                    ->set(['invoice_no' => $invoice_no,'razorpay_order' => $razorpayOrder['id']])
                    ->where(['id' => $order->id])
                    ->execute();
                    $cartObj->deleteAll(['user_id'=>$this->getRequest()->getAttribute('identity')->id]);
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'payment', $order->id]);
            }else{
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['controller'=>'Carts','action'=>'index']);
            }
    }

     public function microcheckout()
    {
        $cartObj = TableRegistry::getTableLocator()->get('Orders.Carts');
        $carts = $cartObj->find()->where(['Carts.user_id' => $this->getRequest()->getAttribute('identity')->id])->contain(['MicroSessions'])->all();
        if(empty($carts->toArray())){
            return $this->redirect(['controller'=>'Carts','action'=>'index']);
        }

        $availableFund = $cartObj->Users->Transactions->availableFund($this->getRequest()->getAttribute('identity')->id);

        $session = $this->request->getSession();

        $amount = 0;
        $discount = 0;
        $cartData = [];
        foreach($carts as $cart){

            $amount += $cart->micro_session->price;
            $discount += $cart->micro_session->discount_price;
            $cartData[] = ['micro_session_id' => $cart->micro_session_id, 'amount' => $cart->micro_session->price, 'discount' => $cart->micro_session->discount_price, 'total_amount' => ($cart->micro_session->price - $cart->micro_session->discount_price)];
        }


            $total_amount = $amount > $discount ? ($amount - $discount) : 0;
            $withDiscount =  ($total_amount > $availableFund ? ($total_amount - $availableFund) : 0);
            $referralCredits = ($availableFund > $total_amount ? $availableFund - $total_amount: 0);
            if($referralCredits > 0){
                $refralDiscount = $total_amount;
            }else{
                $refralDiscount = $availableFund;
            }

            if(!empty($refralDiscount) && $refralDiscount > 0){
                $additional_options = json_encode(['referral_withdraw' => $refralDiscount, 'referral_deposit' => $referralCredits]);
            }

            $couponData = [];
            if($session->read('promotion_coupon')){

                $disType = $session->read('promotion_coupon.coupon_type');
                $disAmount = $session->read('promotion_coupon.discount');
                if($disType == "p"){
                    $disAmount = ($disAmount / 100) * $withDiscount;
                }
                $withDiscount = $withDiscount - $disAmount;
                $couponData['user_id'] = $this->getRequest()->getAttribute('identity')->id;
                $couponData['coupon_id'] = $session->read('promotion_coupon.id');
                $couponData['amount'] = $disAmount;
            }

         $order = $this->Orders->newEmptyEntity();
         $orderData = ['user_id' => $this->getRequest()->getAttribute('identity')->id, 'amount' => $amount, 'discount' => $discount, 'total_amount' => ($withDiscount),'additional_options' => $additional_options ?? null, 'order_date' => date('Y-m-d H:i:s'), 'order_courses' => $cartData, 'order_coupons' => !empty($couponData) ? [$couponData] : null];
            $order = $this->Orders->patchEntity($order, $orderData);

           // echo "<pre>";
           // print_r($orderData);
           // die();
            if ($this->Orders->save($order)) {
                $session->delete('promotion_coupon');
                if($referralCredits > 0){
                    $cartObj->Users->Transactions->WithDrawAllAndDeposit($this->getRequest()->getAttribute('identity')->id, $referralCredits);
                }else if($availableFund > 0){
                    $cartObj->Users->Transactions->updateAll(
                        [  // fields
                            'transaction_type' => 2,
                        ],
                        [  // conditions
                            'transaction_type' => 1,
                            'user_id' => $this->getRequest()->getAttribute('identity')->id
                        ]
                    );
                }

                $invoice_no = "INV-".date('Y-m').'-'.$order->id;
                $order->invoice_no = $invoice_no;
                $razorpay = new \App\Razorpay\Razorpay();
                $razorpayOrder = $razorpay->orderCreate(['receipt' => $order->id, 'booking_amount' => $orderData['total_amount'], 'invoice_no' => $invoice_no]);
                $this->Orders->query()->update()
                    ->set(['invoice_no' => $invoice_no,'razorpay_order' => $razorpayOrder['id']])
                    ->where(['id' => $order->id])
                    ->execute();
                    $cartObj->deleteAll(['user_id'=>$this->getRequest()->getAttribute('identity')->id]);
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'payment', $order->id]);
            }else{
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['controller'=>'Carts','action'=>'index']);
            }
    }

    public function checkout()
    {
        $cartObj = TableRegistry::getTableLocator()->get('Orders.Carts');
        $carts = $cartObj->find()->where(['Carts.user_id' => $this->getRequest()->getAttribute('identity')->id])->contain(['Courses'])->all();
        if(empty($carts->toArray())){
            return $this->redirect(['controller'=>'Carts','action'=>'index']);
        }

        $availableFund = $cartObj->Users->Transactions->availableFund($this->getRequest()->getAttribute('identity')->id);

        $session = $this->request->getSession();

        $amount = 0;
        $discount = 0;
        $cartData = [];
        foreach($carts as $cart){

            $amount += $cart->course->price;
            $discount += $cart->course->discount_price;
            $cartData[] = ['course_id' => $cart->course_id, 'amount' => $cart->course->price, 'discount' => $cart->course->discount_price, 'total_amount' => ($cart->course->price - $cart->course->discount_price)];
        }


            $total_amount = $amount > $discount ? ($amount - $discount) : 0;

            $withDiscount =  ($total_amount > $availableFund ? ($total_amount - $availableFund) : 0);

            $referralCredits = ($availableFund > $total_amount ? $availableFund - $total_amount: 0);

            if($referralCredits > 0){
                $refralDiscount = $total_amount;
            }else{
                $refralDiscount = $availableFund;
            }

            if(!empty($refralDiscount) && $refralDiscount > 0){
                $additional_options = json_encode(['referral_withdraw' => $refralDiscount, 'referral_deposit' => $referralCredits]);
            }

            $couponData = [];
            if($session->read('promotion_coupon')){

                $disType = $session->read('promotion_coupon.coupon_type');
                $disAmount = $session->read('promotion_coupon.discount');
                if($disType == "p"){
                    $disAmount = ($disAmount / 100) * $withDiscount;
                }
                $withDiscount = $withDiscount - $disAmount;
                $couponData['user_id'] = $this->getRequest()->getAttribute('identity')->id;
                $couponData['coupon_id'] = $session->read('promotion_coupon.id');
                $couponData['amount'] = $disAmount;
            }

         $order = $this->Orders->newEmptyEntity();
         $orderData = ['user_id' => $this->getRequest()->getAttribute('identity')->id, 'amount' => $amount, 'discount' => $discount, 'total_amount' => ($withDiscount),'additional_options' => $additional_options ?? null, 'order_date' => date('Y-m-d H:i:s'), 'order_courses' => $cartData, 'order_coupons' => !empty($couponData) ? [$couponData] : null];
            $order = $this->Orders->patchEntity($order, $orderData);
            if ($this->Orders->save($order)) {
                $session->delete('promotion_coupon');
                if($referralCredits > 0){
                    $cartObj->Users->Transactions->WithDrawAllAndDeposit($this->getRequest()->getAttribute('identity')->id, $referralCredits);
                }else if($availableFund > 0){
                    $cartObj->Users->Transactions->updateAll(
                        [  // fields
                            'transaction_type' => 2,
                        ],
                        [  // conditions
                            'transaction_type' => 1,
                            'user_id' => $this->getRequest()->getAttribute('identity')->id
                        ]
                    );
                }

                $invoice_no = "INV-".date('Y-m').'-'.$order->id;
                $order->invoice_no = $invoice_no;
                $razorpay = new \App\Razorpay\Razorpay();
                $razorpayOrder = $razorpay->orderCreate(['receipt' => $order->id, 'booking_amount' => $orderData['total_amount'], 'invoice_no' => $invoice_no]);
                $this->Orders->query()->update()
                    ->set(['invoice_no' => $invoice_no,'razorpay_order' => $razorpayOrder['id']])
                    ->where(['id' => $order->id])
                    ->execute();
                    $cartObj->deleteAll(['user_id'=>$this->getRequest()->getAttribute('identity')->id]);
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'payment', $order->id]);
            }else{
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['controller'=>'Carts','action'=>'index']);
            }


    }

    /**
     * View method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function payment($id = null)
    {

        $this->loadModel('MicroSessions');
        $order = $this->Orders->find()->where(['Orders.id' => $id,'Orders.user_id' => $this->getRequest()->getAttribute('identity')->id, 'Orders.transaction_status IS' => NULL])->contain(['Users.UserProfiles', 'OrderCourses.Courses.Subjects', 'OrderCourses.Courses.GradingTypes', 'OrderCoupons.Coupons', 'OrderCourses.MicroSessions', 'OrderCourses.Packages','OrderCourses.Plans'])->first();

        //echo('<pre />');
        //print_r($order);die;
        if(empty($order)){
            $this->Flash->success(__('Your cart is empty.'));
            return $this->redirect(['controller'=>'Carts','action'=>'index']);
        }
        //dd($order);
        $this->set(compact('order'));
    }

    /**
     * razorpay method
     *
     * @param string|null $id Booking id.
     * @param int $razorpay_payment_id get from razor payment getway
     * @param text $note boooking note
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function razorpay($id = null)
    {

        $order = $this->Orders->get($id, [
            'contain' => ['Users.UserProfiles', 'OrderCourses.Courses.Subjects', 'OrderCourses.Courses.GradingTypes', 'OrderCoupons.Coupons'],
        ]);

        if ($this->request->is(['post', 'put']) && $this->request->is('ajax')) {
            $razorpay = new \App\Razorpay\Razorpay();
            $attributes = [
                'razorpay_order_id' => $order->razorpay_order,
                'razorpay_payment_id' => $this->request->getData('transactionId'),
                'razorpay_signature' => $this->request->getData('signature')
            ];
            $razorpayOrder = $razorpay->orderVerify($attributes);
            $charge['payment_method'] = 'Razorpay';
            $charge['transaction_status'] = 1;
            $charge['transactionId'] = $this->request->getData('transactionId');
            $order = $this->Orders->patchEntity($order, $charge);
            if ($razorpayOrder===true && $this->Orders->save($order)) {
                $result = ['status' => true,'message'=>'Your payment has been successfully processed.'];

            $event = new Event('Users.User.afterOrder', $this, ['order' => $order->toArray()]);
            $this->getEventManager()->dispatch($event);

            }else{
                $result = ['status' => false,'message'=>'Your payment failed.', 'errors' => $order->getErrors()];
            }

           $this->set([
            'code' => (isset($result['status']) && $result['status'] == true) ? 200 : 422,
            'status' => $result['status'] ?? null,
            'message' => $result['message'] ?? null,
            'data' => $order,
            'errors' => $result['errors'] ?? null,
            ]);
            $this->viewBuilder()->setOption('serialize', ['status', 'code','message','data', 'errors']);
        }
    }

    public function thankyou()
    {

    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {

       $query = $this->Orders->find();

        if($this->getRequest()->getAttribute('identity')->role == "teacher"){
            $query->matching('OrderCourses.Courses', function($q){
                return $q->where(['Courses.user_id' => $this->getRequest()->getAttribute('identity')->id]);
            });
        }else{
            $query->where(['Orders.user_id' => $this->getRequest()->getAttribute('identity')->id]);
        }


        $query->contain(['Users', 'OrderCourses.Courses' => function($q){
            return $q->find('course');
        }]);


        $query->matching('OrderCourses.Courses', function($q){
            return $q->find('course');
        });

        $query->distinct(['Orders.id']);

        $options['order'] = ['Orders.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.PAGE_LIMIT');
        $this->paginate = $options;
        $orders = $this->paginate($query);


        // $eventOrder = $orders->first()->toArray();
        // $event = new Event('Users.User.afterOrder', $this, ['order' => $eventOrder]);
        // $this->getEventManager()->dispatch($event);

        $this->set(compact('orders'));
    }
       /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function session()
    {
       $query = $this->Orders->find();

        if($this->getRequest()->getAttribute('identity')->role == "teacher"){

            $query->matching('OrderCourses.Courses', function($q){
                return $q->where(['Courses.user_id' => $this->getRequest()->getAttribute('identity')->id]);
            });
        }else{

            $query->where(['Orders.user_id' => $this->getRequest()->getAttribute('identity')->id]);
        }


        $query->contain(['Users', 'OrderCourses.Courses' => function($q){
            return $q->find('session');
        }]);


        $query->matching('OrderCourses.Courses', function($q){
            return $q->find('session');
        });

        $query->distinct(['Orders.id']);

        $options['order'] = ['Orders.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.PAGE_LIMIT');
        $this->paginate = $options;
        $orders = $this->paginate($query);

        // $eventOrder = $orders->first()->toArray();
        // $event = new Event('Users.User.afterOrder', $this, ['order' => $eventOrder]);
        // $this->getEventManager()->dispatch($event);

        $this->set(compact('orders'));
    }

 public function microsession()
    {

         if($this->getRequest()->getAttribute('identity')->role == "teacher"){
             $query = $this->Orders->find('all')
        ->select(['micro_sessions.title','micro_sessions.id','packages.id','packages.package_title','plans.id','plans.plan_name' ,'user.first_name' ,'user.last_name'])
        ->select($this->Orders)
            ->where("micro_sessions.user_id = '".$this->getRequest()->getAttribute('identity')->id."'")
        ->where("order_courses.micro_session_id != '' ")
        ->join([
            'order_courses' => [
                'table' => 'order_courses',
                'type' => 'LEFT',
                'conditions' => 'order_courses.order_id = Orders.id'
            ],
            'micro_sessions' => [
                'table' => 'micro_sessions',
                'type' => 'LEFT',
                'conditions' => 'micro_sessions.id = order_courses.micro_session_id'
            ],
            'packages' => [
                'table' => 'packages',
                'type' => 'LEFT',
                'conditions' => 'packages.id = micro_sessions.package_id'
            ],
            'plans' => [
                'table' => 'plans',
                'type' => 'LEFT',
                'conditions' => 'plans.id = micro_sessions.plan_id'
            ],
            'user' => [
                'table' => 'users',
                'type' => 'LEFT',
                'conditions' => 'user.id = Orders.user_id'
            ]
        ]);

        }else{
            $query = $this->Orders->find('all')
        ->select(['micro_sessions.title','micro_sessions.id','packages.id','packages.package_name','plans.id','plans.plan_name' ])
        ->select($this->Orders)
        ->where("user.id = '".$this->getRequest()->getAttribute('identity')->id."'")
        ->where("order_courses.micro_session_id != '' ")
        ->join([
            'order_courses' => [
                'table' => 'order_courses',
                'type' => 'LEFT',
                'conditions' => 'order_courses.order_id = Orders.id'
            ],
            'micro_sessions' => [
                'table' => 'micro_sessions',
                'type' => 'LEFT',
                'conditions' => 'micro_sessions.id = order_courses.micro_session_id'
            ],
            'packages' => [
                'table' => 'packages',
                'type' => 'LEFT',
                'conditions' => 'packages.id = micro_sessions.package_id'
            ],
            'plans' => [
                'table' => 'plans',
                'type' => 'LEFT',
                'conditions' => 'plans.id = micro_sessions.plan_id'
            ],
            'user' => [
                'table' => 'users',
                'type' => 'LEFT',
                'conditions' => 'user.id = Orders.user_id'
            ]
        ]);

        }


       $options['order'] = ['Orders.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.PAGE_LIMIT');
        $this->paginate = $options;
        $orders = $this->paginate($query);
        // echo $query;

        // die();


      //   $query = $this->Orders->find();
      //   if($this->getRequest()->getAttribute('identity')->role == "teacher"){
      //       $query->matching('OrderCourses.MicroSessions', function($q){
      //           return $q->where(['MicroSessions.user_id' => $this->getRequest()->getAttribute('identity')->id]);
      //       });
      //   }else{

      //       $query->where(['Orders.user_id' => $this->getRequest()->getAttribute('identity')->id]);
      //   }

      // // $query->contain(['MicroSessions']);
      //   $query->contain(['Users', 'OrderCourses.MicroSessions' => function($q){
      //       return $q->where(['MicroSessions.id !=' => 0 ]);
      //   }]);

      //   // $query->matching('OrderCourses.Courses', function($q){
      //   //     return $q->find('l');
      //   // });

      // //  $query->distinct(['Orders.id']);

      //   $options['order'] = ['Orders.id' => 'DESC'];
      //   $options['limit'] = \Cake\Core\Configure::read('Setting.PAGE_LIMIT');
      //   $this->paginate = $options;
      //   $orders = $this->paginate($query);
            // echo $query;
            // die();
        // $eventOrder = $orders->first()->toArray();
        // $event = new Event('Users.User.afterOrder', $this, ['order' => $eventOrder]);
        // $this->getEventManager()->dispatch($event);

        $this->set(compact('orders'));
    }
     public function packagesubjects($package_id= null,$package_name= null)
    {
        $this->loadModel('TeacherStudentMappings');
         $query = $this->TeacherStudentMappings->find('all')
        ->select(['micro_sessions.id','packages.package_name','micro_sessions.title','subjects.title'])
        ->where(["TeacherStudentMappings.package_id = '".$package_id."'"])
                 ->join([
              'packages' => [
                'table' => 'packages',
                'type' => 'LEFT',
                'conditions' => 'packages.id = TeacherStudentMappings.package_id'
            ],
            'subjects' => [
                'table' => 'subjects',
                'type' => 'LEFT',
                'conditions' => 'subjects.id = TeacherStudentMappings.subject_id'
            ],
            'micro_sessions' => [
                'table' => 'micro_sessions',
                'type' => 'LEFT',
                'conditions' => 'micro_sessions.id = TeacherStudentMappings.micro_session_id'
            ]
        ]);




       $options['order'] = ['TeacherStudentMappings.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.PAGE_LIMIT');
        $this->paginate = $options;
        $teacherStudentMappings = $this->paginate($query);
         // echo $query."<pre>";
         // print_r( $teacherStudentMappings);
         // die();
        $this->set(compact('teacherStudentMappings','package_name'));
    }


     public function packagehistory()
    {

         $query = $this->Orders->find('all')
        ->select(['packages.id','packages.package_name','packages.subject_id','plans.id','plans.plan_name' ])
        ->select($this->Orders)
        ->where(["user.id = '".$this->getRequest()->getAttribute('identity')->id."'","order_courses.package_id != '' ", "order_courses.plan_id != '' "])

        ->join([
            'order_courses' => [
                'table' => 'order_courses',
                'type' => 'LEFT',
                'conditions' => 'order_courses.order_id = Orders.id'
            ],
            'packages' => [
                'table' => 'packages',
                'type' => 'LEFT',
                'conditions' => 'packages.id = order_courses.package_id'
            ],
            'plans' => [
                'table' => 'plans',
                'type' => 'LEFT',
                'conditions' => 'plans.id = order_courses.plan_id'
            ],
            'user' => [
                'table' => 'users',
                'type' => 'LEFT',
                'conditions' => 'user.id = Orders.user_id'
            ]
        ]);




       $options['order'] = ['Orders.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.PAGE_LIMIT');
        $this->paginate = $options;
        $orders = $this->paginate($query);
         // echo $query."<pre>";
         // print_r( $orders);
         // die();
        $this->set(compact('orders'));
    }
    public function teacherpackage()
    {
        $this->loadModel('TeacherStudentMappings');
         $query = $this->TeacherStudentMappings->find('all')
        ->select(['packages.id','packages.package_name','user.first_name','user.last_name','subjects.title'])
        ->where(["teacher_id = '".$this->getRequest()->getAttribute('identity')->id."'"])

        ->join([
            'packages' => [
                'table' => 'packages',
                'type' => 'LEFT',
                'conditions' => 'packages.id = TeacherStudentMappings.package_id'
            ],
            'subjects' => [
                'table' => 'subjects',
                'type' => 'LEFT',
                'conditions' => 'subjects.id = TeacherStudentMappings.subject_id'
            ],
            'user' => [
                'table' => 'users',
                'type' => 'LEFT',
                'conditions' => 'user.id = TeacherStudentMappings.student_id'
            ]
        ]);




       $options['order'] = ['TeacherStudentMappings.id' => 'DESC'];
        $options['limit'] = \Cake\Core\Configure::read('Setting.PAGE_LIMIT');
        $this->paginate = $options;
        $orders = $this->paginate($query);
         // echo $query."<pre>";
         // print_r( $orders);
         // die();
        $this->set(compact('orders'));
    }

    /**
     * View method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $order = $this->Orders->find()->where(['Orders.id' => $id])->contain(['Users.UserProfiles', 'OrderCourses.Courses.Subjects', 'OrderCourses.Courses.GradingTypes', 'OrderCoupons.Coupons'])->firstOrFail();
        //dd($order);
        $this->set(compact('order'));
    }

     /**
     * viewCertificate method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function viewCertificate($id)
    {
        $order = $this->Orders->get($id, [
            'contain' => ['Users', 'OrderCourses.Courses'],
        ]);
        $order_courses = [];
        foreach($order->order_courses as $course){
            $order_courses[] = $course->course->title;
        }
        $this->set(compact('order', 'order_courses'));
    }

    /**
     * downloadCertificate method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function downloadCertificate($id)
    {
        $this->viewBuilder()->setClassName('CakePdf.Pdf');
        \Cake\Core\Configure::write('CakePdf', [
            'engine' => 'CakePdf.Mpdf',
            'margin' => [
                'bottom' => 0,
                'left' => 0,
                'right' => 0,
                'top' => 0
            ],
            'orientation' => 'portrait', //portrait / landscape
            'encoding' => 'utf-8',
           // 'download' => true
        ]);
        $order = $this->Orders->get($id, [
            'contain' => ['Users', 'OrderCourses.Courses'],
        ]);
        $order_courses = [];
        foreach($order->order_courses as $course){
            $order_courses[] = $course->course->title;
        }
        $filename = implode(" ", $order_courses) . ' Certificate.pdf';
        //$CakePdf->template('download_certificate', 'certificate');
        //echo WWW_ROOT;die;
        //$this->viewBuilder()->setTheme(\Cake\Core\Configure::read('Setting.LISTING_THEME'));
        $this->viewBuilder()->setLayout('TeachingTheme.certificate');
        $this->viewBuilder()->setTemplate('Orders.download_certificate', 'certificate');

        $this->viewBuilder()->setOptions([
            'pdfConfig' => [
                'margin' => [
                    'bottom' => 0,
                    'left' => 0,
                    'right' => 0,
                    'top' => 0
                ],
                'title' => 'Certificate',
                'download' => false, // This can be omitted if "filename" is specified.
                'filename' => $filename // This can be omitted if you want file name based on URL.
            ]
        ]);
        $this->set(compact('order', 'order_courses'));
    }


    /**
     * downloadCertificate method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function emailCertificate($id)
    {
        //$this->viewBuilder()->setClassName('CakePdf.Pdf');
        \Cake\Core\Configure::write('CakePdf', [
            'engine' => 'CakePdf.Mpdf',
            'margin' => [
                'bottom' => 0,
                'left' => 0,
                'right' => 0,
                'top' => 0
            ],
            'orientation' => 'portrait', //portrait / landscape
            'encoding' => 'utf-8',
           // 'download' => true
        ]);
        $order = $this->Orders->get($id, [
            'contain' => ['Users', 'OrderCourses.Courses'],
        ]);
        $order_courses = [];
        foreach($order->order_courses as $course){
            $order_courses[] = $course->course->title;
        }
        $filename = \Cake\Utility\Text::slug($order->user->name) . "_" . $order->invoice_no . '_certificate.pdf';
        $this->viewBuilder()->setOptions([
            'pdfConfig' => [
                'margin' => [
                    'bottom' => 0,
                    'left' => 0,
                    'right' => 0,
                    'top' => 0
                ],
                'title' => 'Certificate',
                'download' => false, // This can be omitted if "filename" is specified.
                'filename' => $filename // This can be omitted if you want file name based on URL.
            ]
        ]);
        //$this->viewBuilder()->setLayout('TeachingTheme.certificate');
        //$this->viewBuilder()->setTemplate('Orders.download_certificate', 'certificate');
        $CakePdf = new \CakePdf\Pdf\CakePdf();
        $CakePdf->template('Orders./Orders/pdf/download_certificate', 'TeachingTheme.certificate');
        $CakePdf->viewVars(['order' => $order, 'order_courses' => $order_courses]);
        // Get the PDF string returned
        $pdf = $CakePdf->output();
        // Or write it to file directly
        $pdf = $CakePdf->write(WWW_ROOT . 'certificate' . DS . $filename);

        $orderData = $order->toArray();
        $orderData['invoice_file'] = $filename;
        $event = new Event('Users.User.afterSendCertificate', $this, ['order' => $orderData]);
        $this->getEventManager()->dispatch($event);
        $this->Flash->success(__('Certificate has been sent to student.'));
        return $this->redirect($this->referer());
       // $this->set(compact('order', 'order_courses'));
    }

    public function invoice($id)
    {
        $order = $this->Orders->find()->where(['Orders.id' => $id])->contain(['Users.UserProfiles', 'OrderCourses.Courses.Subjects', 'OrderCourses.Courses.GradingTypes'])->first();
       // dd($order);
        $this->set(compact('order'));
    }

        public function microinvoice($id)
    {
        $order = $this->Orders->find()->where(['Orders.id' => $id])->contain(['Users.UserProfiles','OrderCourses.MicroSessions.Subjects', 'OrderCourses.MicroSessions.GradingTypes'])->first();
        //dd($order);
        $this->set(compact('order'));
    }

    /**
     * Add/Edit method
     * Edit: param string|null $id Order id.
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function add($id = null)
    {
        if($id){
            $order = $this->Orders->get($id, [
                'contain' => [],
            ]);
        }else{
            $order = $this->Orders->newEmptyEntity();
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $order = $this->Orders->patchEntity($order, $this->request->getData());
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }
        $users = $this->Orders->Users->find('list', ['limit' => 200]);
        $phinxlog = $this->Orders->Phinxlog->find('list', ['limit' => 200]);
        $this->set(compact('order', 'users', 'phinxlog'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $order = $this->Orders->get($id, [
            'contain' => ['Phinxlog'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $order = $this->Orders->patchEntity($order, $this->request->getData());
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }
        $users = $this->Orders->Users->find('list', ['limit' => 200]);
        $phinxlog = $this->Orders->Phinxlog->find('list', ['limit' => 200]);
        $this->set(compact('order', 'users', 'phinxlog'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $order = $this->Orders->get($id);
        if ($this->Orders->delete($order)) {
            $this->Flash->success(__('The order has been deleted.'));
        } else {
            $this->Flash->error(__('The order could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    /**
     * sessionBooking method
     *
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function sessionBooking($course_id)
    {

        $cartData[] = ['course_id' => $course_id];

        $course = $this->Orders->OrderCourses->Courses->find()->where(['Courses.id' => $course_id])->first();

        if($course->user_id == $this->getRequest()->getAttribute('identity')->id){
             $result = ['status' => false, 'message' => __('You can\'t register for this master session.')];
        }else{

            //$additional_options = json_encode(['referral_withdraw' => $refralDiscount, 'referral_deposit' => $referralCredits]);

             $order = $this->Orders->newEmptyEntity();
             $orderData = ['user_id' => $this->getRequest()->getAttribute('identity')->id, 'amount' => 0, 'total_amount' => 0, 'order_date' => date('Y-m-d H:i:s'), 'order_courses' => $cartData];
                $order = $this->Orders->patchEntity($order, $orderData);
                 if ($this->Orders->save($order)) {
                    $invoice_no = "INV-".date('Y-m').'-'.$order->id;
                    $order->invoice_no = $invoice_no;
                    $this->Orders->query()->update()
                        ->set(['invoice_no' => $invoice_no])
                        ->where(['id' => $order->id])
                        ->execute();
                    $result = ['status' => true, 'message' => __('You have successfully registered for this master session.')];
                }else{
                    $result = ['status' => false, 'message' => __('The session could not be registered. Please, try again.')];
                }
                // $result = ['status' => true, 'message' => __('You have successfully registered for this master session.')];
        }


        $this->set([
            'code' => (isset($result['status']) && $result['status'] == true) ? 200 : 422,
            'status' => $result['status'] ?? null,
            'message' => $result['message'] ?? null,
            'data' => $order ?? null,
            'errors' => $result['errors'] ?? null,
            ]);
        $this->viewBuilder()->setOption('serialize', ['status', 'code','message','data', 'errors']);


    }
}
