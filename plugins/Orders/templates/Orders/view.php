<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $order
 */
$this->layout = "authdefault";
?>
<div class="new-header-style-1">
    <div class="container">
        <div class="col-sm-12 text-center">
            <h2>Order Detail</h2>
            <p>Teaching Bharat's Course order detail</p>
        </div>
    </div>
</div>

 <section class="White79">
    <div class="container">
        <div class="col-sm-12">
            <?= $this->Flash->render() ?>
            <div class="table-responsive">
                <table class="table table-bordered ssTable">
                    <tr>
                        <th>Invoice No.</th>
                        <td><?= h($order->invoice_no) ?></td>
                    </tr>
                    <?php if($this->request->getAttribute('identity')->role == "teacher"){ ?>
                    <tr>
                        <th>Student</th>
                        <td><?= h($order->user->name) ?></td>
                    </tr>
                <?php } ?>
                    <tr>
                        <th>Amount</th>
                        <td><?= $this->Number->currency($order->amount, 'INR') ?></td>
                    </tr>
                    <tr>
                        <th>Discount By Site</th>
                        <td><?= $this->Number->currency($order->discount, 'INR') ?></td>
                    </tr>
                    <tr>
                        <th>Coupon Discount</th>
                        <td><?= $this->Number->currency($order->coupon_discount, 'INR') ?></td>
                    </tr>
                    <tr>
                        <th>Referral Discount</th>
                        <td><?= $this->Number->currency($order->referral_discount, 'INR') ?></td>
                    </tr>
                    <tr>
                        <th>Total Discount</th>
                        <td><?php
                        $discount = floatval($order->discount)+floatval($order->coupon_discount)+floatval($order->referral_discount);
                        ?>
                        <?= $this->Number->currency($discount, 'INR') ?></td>
                    </tr>
                    <tr>
                        <th>Total Amount</th>
                        <td>
                                <?= $this->Number->currency($order->total_amount, 'INR') ?>
                            </td>
                    </tr>
                    <tr>
                        <th>Order Date</th>
                         <td>
                             <?php if ($order->order_date) {
                                 echo date('d F, Y h:i A',strtotime($order->order_date));
                                //echo $order->order_date->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                            </td>
                    </tr>
                </table>
            </div>

            <table class="table table-bordered invoice-table">
                        <thead>
                            <th>Course / Product</th>
                            <th>Price</th>
                            <th>Discount</th>
                            <th class="text-right">Final Price</th>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($order) && !empty($order->order_courses)) :
                            foreach ($order->order_courses as $cart): ?>
                            <tr>
                                <td>
                                    <?= $cart->has('course') ? $this->Html->link($cart->course->title, ['controller' => 'Courses', 'action' => 'view', 'plugin' => 'Courses', $cart->course->id]) : '' ?>
                                    <p><?= $cart->course->subject->title ?> | <?= $cart->course->grading_type->title ?></p>
                                </td>
                                <td><?= $this->Number->currency($cart->course->price, 'INR') ?></td>
                                <td>
                                    <?php $discP = !empty($cart->course->discount_price) ? round(($cart->course->discount_price / $cart->course->price) * 100, 2) : 0; ?>
                                    <?php echo $discP ?>%
                                </td>
                                <td class="text-right"><?= $this->Number->currency(($cart->course->price - $cart->course->discount_price), 'INR') ?></td>
                            </tr>
                            <?php endforeach; ?>
                            <?php if(!empty($order->additional_options)){
                            $finalAmount = json_decode($order->additional_options, true);
                            ?>
                            <tfoot>
                                <tr>
                                    <td colspan="3" align="right">
                                        Referral Credits: -<?= $this->Number->currency($finalAmount['referral_withdraw'], 'INR') ?>
                                    </td>
                                    <td align="right">
                                        <?= $this->Number->currency($order->total_amount, 'INR') ?>
                                    </td>
                                </tr>
                            </tfoot>
                    <?php }
                    if(!empty($order->order_coupons)){
                        foreach($order->order_coupons as $coupon){ ?>
                            <tr>
                                    <td colspan="3" align="right">
                                        Coupon (<?= $coupon->coupon->code ?>):
                                    </td>
                                    <td align="right">
                                            <?php
                                            echo $this->Number->currency($coupon->amount, 'INR');
                                             ?>

                                    </td>
                                </tr>
                                <?php
                                    }
                                }
                                ?>
                                <tr>
                                    <td colspan="3" align="right">
                                        Total:
                                    </td>
                                    <td align="right">
                                            <?php
                                            echo $this->Number->currency($order->total_amount, 'INR');
                                             ?>

                                    </td>
                                </tr>
                            <?php else: ?>
                                <tr style="text-align:center;">
                                    <td colspan="5">
                                        <strong>Cart is empty</strong>
                                    </td>
                                </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>

            <?php if($this->request->getAttribute('identity')->role == "teacher"){ ?>
              <div class="col-sm-12 certy-buttons">
                <?= $this->Html->link('<i class="fa fa-certificate"></i> View certificate', ['controller' => 'Orders', 'action' => 'viewCertificate', $order->id], ['escape' => false]) ?>

                <?= $this->Html->link('<i class="glyphicon glyphicon-save"></i> Download certificate', ['controller' => 'Orders', 'action' => 'downloadCertificate', $order->id], ['escape' => false]) ?>

                <?= $this->Html->link('<i class="glyphicon glyphicon-share-alt"></i> Email certificate', ['controller' => 'Orders', 'action' => 'emailCertificate', $order->id], ['escape' => false]) ?>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<?php
$this->assign('title', 'Order detail');
$this->Html->meta(
    'keywords', 'Order detail', ['block' => true]
);
$this->Html->meta(
    'description', 'Order detail', ['block' => true]
);
?>
