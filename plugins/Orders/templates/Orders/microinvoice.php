<?php
use Cake\I18n\Date;
use Cake\I18n\I18n;
use Cake\Chronos\Chronos;
use Cake\Core\Configure;
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $order
 */
?>
<div class="new-header-style-1">
    <div class="container">
        <div class="col-sm-12 text-center">
            <h2>INVOICE</h2>
            <!-- <p>Confrim your payment</p> -->
        </div>
    </div>
</div>

<section class="new-grey">
        <div class="container">
            <div class="col-sm-12 inovice-main">
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <h2>Teaching Bharat</h2>
                        <p>A Div of Brainmeasures</p>
                    </div>
                    <div class="col-sm-6 text-right">
                        <h4>Invoice #<?= $order->invoice_no ?></h4>
                        <p>Issued <?= $order->order_date->format('jS D, Y') ?></p> 
                        <p><?= $order->transaction_status == 1 ? "Success" : ($order->transaction_status == 2 ? "Faild" : "Pending") ?></p>
                    </div>
                </div>
                <div class="col-sm-12">
                    <hr>
                    <div class="col-sm-4">
                        <h5>From:</h5>
                        <p>Teacing Bharat Inc.<br>ABC Street, Amazing Avenue<br>Texas - USA</p>
                    </div>
                    <div class="col-sm-4">
                        <h5>To:</h5>
                        <p><?= $order->user->name ?><br><?= $order->user->user_profile->address_line_1 ?? "" ?> <?php echo $order->user->user_profile ? $this->cell('Locations.Location::getParents', [$order->user->user_profile->location_id])->render('get_parent_no_links') : "" ?>
                                    <?= $order->user->user_profile->location->title ?? "" ?></p>
                    </div>
                    <div class="col-sm-4">
                        <h5>Description</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
                    </div>
                </div>
                <div class="col-sm-12">
                    <hr>
                   
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
                               // echo "<pre>";
                               // print_r($order->order_courses);
                              //  die();

                            foreach ($order->order_courses as $cart): ?>
                            <tr>
                                <td>
                                    <?= $cart->has('course') ? $this->Html->link($cart->micro_session->title, ['controller' => 'Courses', 'action' => 'view', 'plugin' => 'Courses', $cart->micro_session->id], ['target' => '_blank']) : '' ?>
                                    <p><?= $cart->micro_session->subject->title ?> | <?= $cart->micro_session->grading_type->title ?></p>
                                </td>
                                <td><?= $this->Number->currency($cart->micro_session->price, 'INR') ?></td>
                                <td>
                                    <?php $discP = !empty($cart->micro_session->discount_price) ? round(($cart->micro_session->discount_price / $cart->micro_session->price) * 100, 2) : 0; ?>
                                    <?php echo $discP ?>%
                                </td>
                                <td class="text-right"><?= $this->Number->currency(($cart->micro_session->price - $cart->micro_session->discount_price), 'INR') ?></td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                                <tr style="text-align:center;">
                                    <td colspan="5">
                                        <strong>Cart is empty</strong>
                                    </td>  
                                </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-12">
                    <p><b>Payment Method :</b> Card | <b>Status :</b> <?= $order->transaction_status == 1 ? "Success" : ($order->transaction_status == 2 ? "Faild" : "Pending") ?></p><br>
                    <p><b>Terms and Conditions</b></p>
                    <p>- Lorem ipsum dolor sit dipiscing elit, sed do eiusmod tempor incididunt ut labore<br>
                    - Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore<br>
                    - Lorem ipsum helo dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                </p>
                </div>
            </div>
        </div>
    </section>

