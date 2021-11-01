<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $course
 */
?>
<div class="new-header-style-1">
        <div class="container">
            <div class="col-sm-12 text-center">
                <h2>COURSE CART</h2>
                <p>Confrim your purchase(s)</p>
            </div>
        </div>
    </div>

 <section class="new-grey">
        <div class="container">
            <div class="col-sm-12 mb40">
                <table class="table table-bordered checkout-table">
                    <thead>
                        <th>Course / Product</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th class="text-right">Final Price</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <?= $microSessions->title ?>
                                <p><?= $microSessions->subject->title ?> | <?= $microSessions->grading_type->title ?></p>
                                </td>
                            <td><h4><?= $this->Number->currency($microSessions->price, 'INR') ?></h4></td>
                            <td>
                                <?php $discP = !empty($microSessions->discount_price) ? round(($microSessions->discount_price / $microSessions->price) * 100, 2) : 0; ?>
                                <h4><?php echo $discP ?>%</h4>
                            </td>
                            <td class="text-right"><h3><?= $this->Number->currency(($microSessions->price - $microSessions->discount_price), 'INR') ?></h3></td>
                        </tr>
                    </tbody>
                </table>
                <div class="col-sm-12 text-center mt30 mb40">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

                    <div class="col-sm-4 col-sm-offset-4 mt20 mb40">
                        <a href="#" class="cdm-right-buy-btn"><span>CHECK</span>OUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php 
$this->Html->script(['https://checkout.razorpay.com/v1/checkout.js','/assets/plugins/jquery-confirm-master/js/jquery-confirm.js'], ['block' => true]); ?>
<script>
<?php $this->Html->scriptStart(['block' => true]); 
$data = [
    "key"               => Configure::read('Setting.ROZORPAY_KEY'),
    "amount"            => Configure::read('Setting.REGISTRATION_AMOUNT')*100,
    "name"              => Configure::read('Setting.SYSTEM_APPLICATION_NAME'),
    "description"       => "Purchase Description",
    "image"             => \Cake\Routing\Router::url('img/uploads/settings/'.Configure::read('Setting.MAIN_LOGO'), true),
    "prefill"           => [
        "name"              => $user->name,
        "email"             => $user->email,
        "contact"           => $user->users_profile->mobile,
    ],
    "notes"             => [
        "address"    => $address,
        "merchant_order_id" => $user->id,
    ],
    "theme"             => [
    "color"             => "#e04f67"
    ],
    "order_id"          => $user->razorpay_order_token,
];
?>


<?php $this->Html->scriptEnd(); ?>