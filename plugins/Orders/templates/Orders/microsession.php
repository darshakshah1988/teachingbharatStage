<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $orders
 */
$this->layout = "authdefault";
?>
<div class="new-header-style-1">
    <div class="container">
        <div class="col-sm-12 text-center">
            <h2>Purchase history</h2>
            <p>Teaching Bharat's Micro Session order history</p>
        </div>
    </div>
</div>
 <section class="White79">
    <div class="container">
        <div class="col-sm-12">
        <?= $this->Flash->render() ?>
        <div class="form-group">
          <ul class="nav nav-tabs">
              <li >
                <?= $this->Html->link('Purchase history', ['plugin' => 'Orders', 'controller' => 'Orders', 'action' => 'index'], ['escape' => false]); ?>
            </li>
            <?php if($this->request->getAttribute('identity')->role == "teacher"){ ?>
              <li>
                <?= $this->Html->link('Master session', ['plugin' => 'Orders', 'controller' => 'Orders', 'action' => 'session'], ['escape' => false]); ?>
            </li>

        <?php }else{ ?>
             <li >
                <?= $this->Html->link('Packages', ['plugin' => 'Orders', 'controller' => 'Orders', 'action' => 'packagehistory'], ['escape' => false]); ?>
            </li>
             <?php }?>
              <li class="active">
                <?= $this->Html->link('Micro Sessions', ['plugin' => 'Orders', 'controller' => 'Orders', 'action' => 'microsession'], ['escape' => false]); ?>
            </li>

            </ul>
        </div>
            <div class="table-responsive">
                <table class="table table-bordered ssTable">
                  <thead>
                    <tr>
                        <th>#</th>
                      <th>Invoice No.</th>
                        <?php if($this->request->getAttribute('identity')->role == "teacher"){
                           $method='microsessionDetails'; ?>
                            <th>Student</th>
                        <?php } ?>
                        <th>MicroSession</th>
                        <?php if($this->request->getAttribute('identity')->role == "student"){
                            $method='schedulecourse';?>
                        <!-- <th>Package</th>
                        <th>Plan</th> -->
                         <?php } ?>
                        <th>Amount</th>
                        <th>Discount</th>
                        <th>Total Amount</th>
                        <th>Payment Status</th>
                        <th>Order Date</th>
                        <?php if($this->request->getAttribute('identity')->role == "teacher"){ ?>
                             <!-- <th>Certificate sent on</th> -->
                        <?php } ?>

                        <th class="action-col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (!empty($orders->toArray())):
                         $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                         $isMicrosession=false;
                         $package='';
                         $order_courses = '';
                         $plan='';
                        foreach ($orders as $order):

                          if(isset($order->micro_sessions['title']) && $order->micro_sessions['title'] !=""){
                            $isMicrosession=true;
                        $order_courses = $this->Html->link($order->micro_sessions['title'], ['controller' => 'MicroSessions', 'action' => $method, 'plugin' => 'MicroSessions', $order->micro_sessions['id']]/*, ['target' => '_blank']*/);
                         //   $package=$order->packages['package_name']? $order->packages['package_name']: "";
                         //   $plan=$order->plans['plan_name']? $order->plans['plan_name'] : "";
                            }

                            $orderStatus = $order->transaction_status == 1 ? "Success" : ($order->transaction_status == 2 ? "Faild" : "Pending");

                            ?>
                     <tr>
                            <td><?= $this->Number->format($i)?>.</td>
                         <td>
                             <?php
                             if($orderStatus != 'Pending'){
                                 echo $this->Html->link(h($order->invoice_no), ['action' => 'invoice', $order->id],['escape' => false, 'target' => '_blank', 'data-toggle'=>'tooltip','alt'=>__('View Invoice'),'title'=>__('View Invoice')]);
                             }
                             ?>
                         </td>
                            <?php if($this->request->getAttribute('identity')->role == "teacher"){ ?>
                                <td>
                                    <?= $order->user['first_name'].' '.$order->user['last_name'] ?>
                                </td>
                            <?php } ?>
                            <td><?= $order_courses? $order_courses: "" ?></td>
                             <?php if($this->request->getAttribute('identity')->role == "student"){ ?>
                            <!-- <td><? //= $package ?></td>
                            <td><? //= $plan ?></td> -->
                        <?php } ?>

                            <td><?= $this->Number->currency($order->amount, 'INR') ?></td>
                            <td>
                                <?php
                                $discount = floatval($order->discount)+floatval($order->coupon_discount)+floatval($order->referral_discount);
                                ?>
                                <?= $this->Number->currency($discount, 'INR') ?>
                            </td>
                            <td>
                                <?= $this->Number->currency($order->total_amount, 'INR') ?>
                            </td>
                            <td>
                                <?= $orderStatus; ?>
                            </td>
                            <td>
                             <?php if ($order->order_date) {
                                 echo date('d F, Y h:i A',strtotime($order->order_date));
                                //echo $order->order_date->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                            </td>
                            <?php if($this->request->getAttribute('identity')->role == "teacher"){ ?>
                               <!--  <td>
                                    <? //= !empty($order->certificate_issue_date) ? $order->certificate_issue_date->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT')) : "Not Sent" ?>
                                </td> -->

                            <?php } ?>
                            <td class="action-col">
                            <?php
                            if($this->request->getAttribute('identity')->role == "student" && $orderStatus == 'Success'){
                            ?>
                                <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $order->id],['class' => 'btn btn-warning btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View order'),'title'=>__('View order')]) ?>
                            <?php } ?>

                            <?php if($this->request->getAttribute('identity')->role == "teacher"){ ?>
                                
                                <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $order->id],['class' => 'btn btn-warning btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View order'),'title'=>__('View order')]) ?>
                            <?php } ?>

                            <?php if($this->request->getAttribute('identity')->role == "teacher" && $order->transaction_status == 1){ ?>
                            <?= $this->Html->link("<i class=\"fas fa-file-invoice\"></i>", ['action' => 'invoice', $order->id],['class' => 'btn btn-danger btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View Invoice'),'title'=>__('View Invoice')]) ?>

                            <?= $this->Html->link("<i class=\"fa fa-certificate\"></i>", ['controller' => 'Orders', 'action' => 'viewCertificate', $order->id],['class' => 'btn btn-danger btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View Certificate'),'title'=>__('View Certificate')]) ?>

                            <?php }
                                if($order->transaction_status != 1 && $this->request->getAttribute('identity')->id == $order->user_id){
                                   echo $this->Html->link("<i class=\"fa fa-money\"></i>", ['controller' => 'Orders', 'action' => 'payment', 'plugin' => 'Orders', $order->id],['class' => 'btn btn-success btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Pay Amount'),'title'=>__('Pay Amount')]);
                                }
                            ?>

                        </td>
                            </tr>
                            <?php $i++; endforeach; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan='11' align='center' class="tbodyNotFound" style="text-align:center;">
                                    <strong>Record Not Available</strong>
                                </td>
                            </tr>
                        <?php endif; ?>
                  </tbody>
                </table>
            </div>
            <div class="pagination-sec d-flex justify-content-between flex-wrap align-items-center">
                <?php
                $totalCount = $this->Paginator->params()['count'] ?? 0;
                if($totalCount > \Cake\Core\Configure::read('Setting.PAGE_LIMIT')){
                    echo $this->element('pagination');
                }
                 ?>
            </div>
        </div>
    </div>
</section>

<?php
$this->assign('title', 'Purchase history');
$this->Html->meta(
    'keywords', 'Purchase history', ['block' => true]
);
$this->Html->meta(
    'description', 'Purchase history', ['block' => true]
);
?>
