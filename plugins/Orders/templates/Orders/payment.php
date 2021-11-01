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
            <h2>Make Payment</h2>
            <p>Confrim your payment</p>
        </div>
    </div>
</div>


 <section class="new-grey" id="paymentLoader">
        <div class="container">
            <div class="col-sm-12 mb40" style="margin-top: 20px;">
                <?= $this->Flash->render() ?>
                <table class="table table-bordered">
                    <thead>
                        <th>Item Name</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th class="text-right">Final Price</th>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($order) && !empty($order->order_courses)) :
                        foreach ($order->order_courses as $cart): ?>

                        <tr>

                                <?php
                                if(isset($cart->micro_session)){
                                    ?>
                                    <td>
                                    <?= $cart->has('course') ? $this->Html->link($cart->micro_session->title, ['controller' => 'Courses', 'action' => 'view', 'plugin' => 'Courses', $cart->micro_session->id]) : '' ?>
                                    <p><?= $cart->micro_session->title ?></p>
                                    </td>
                                    <td><h4><?= $this->Number->currency($cart->micro_session->price, 'INR') ?></h4></td>
                                    <td>
                                        <?php $discP = !empty($cart->micro_session->discount_price) ? round(($cart->micro_session->discount_price / $cart->micro_session->price) * 100, 2) : 0; ?>
                                        <h4><?php echo $discP ?>%</h4>
                                    </td>
                                    <td class="text-right"><h4><?= $this->Number->currency(($cart->micro_session->price - $cart->micro_session->discount_price), 'INR') ?></h4></td>
                                <?php
                            }else if(isset($cart->package)){
                                    ?>
                                    <td>
                                    <?= $cart->has('course') ? $this->Html->link($cart->plan->title, ['controller' => 'Courses', 'action' => 'view', 'plugin' => 'Courses', $cart->plan->id]) : '' ?>
                                        <p><?= $cart->package->package_name ?> | <?= $cart->plan->plan_name ?></p>
                                    </td>
                                    <td><h4><?= $this->Number->currency($cart->plan->price, 'INR') ?></h4></td>
                                    <td>
                                        <?php $discP = !empty($cart->plan->discount_price) ? round(($cart->plan->discount_price / $cart->plan->price) * 100, 2) : 0; ?>
                                        <h4><?php echo $discP ?>%</h4>
                                    </td>
                                    <td class="text-right"><h4><?= $this->Number->currency(($cart->plan->price - $cart->plan->discount_price), 'INR') ?></h4></td>
                                <?php
                                }else{
                                ?>
                                <td>
                                <?= $cart->has('course') ? $this->Html->link($cart->course->title, ['controller' => 'Courses', 'action' => 'view', 'plugin' => 'Courses', $cart->course->id]) : '' ?>
                                <p><?= $cart->course->subject->title ?> | <?= $cart->course->grading_type->title ?></p>
                                </td>
                                <td><h4><?= $this->Number->currency($cart->course->price, 'INR') ?></h4></td>
                                <td>
                                    <?php $discP = !empty($cart->course->discount_price) ? round(($cart->course->discount_price / $cart->course->price) * 100, 2) : 0; ?>
                                    <h4><?php echo $discP ?>%</h4>
                                </td>
                                <td class="text-right"><h4><?= $this->Number->currency(($cart->course->price - $cart->course->discount_price), 'INR') ?></h4></td>
                            <?php } ?>


                        </tr>
                        <?php endforeach; ?>
                        <tfoot>
                        <?php
                        //dump($order->additional_options);
                        if(!empty($order->additional_options)){
                            $finalAmount = json_decode($order->additional_options, true);
                            ?>
                                <tr>
                                    <td colspan="3" align="right">
                                        Referral Credits: -<?= $this->Number->currency($finalAmount['referral_withdraw'], 'INR') ?>
                                    </td>
                                    <td align="right">
                                        <h3><?= $this->Number->currency($order->total_amount, 'INR') ?></h3>
                                    </td>
                                </tr>
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
                    </tfoot>
                        <?php else: ?>
                            <tr style="text-align:center;">
                                <td colspan="5">
                                    <strong>Cart is empty</strong>
                                </td>
                            </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
                <div class="col-sm-12 text-center mt30 mb40">
                        <div class="col-sm-4 col-sm-offset-4 mt20 mb40">
                            <?= $this->Html->link('<span>Make</span>Payment', 'javascript:void(0)', ['class' => 'cdm-right-buy-btn','id' => 'MakePaymentId' , 'escape' =>  false]) ?>
                        </div>
                </div>
            </div>
        </div>
    </section>

<?php
echo $this->Html->script(['/assets/plugins/jquery-loading-overlay-master/dist/loadingoverlay.min'],['block' => true]);
echo $this->Html->script(['common', 'Courses'], ['block' => true]);
$this->Html->script(['https://checkout.razorpay.com/v1/checkout.js'], ['block' => true]);
//$this->Html->css(['/assets/plugins/iCheck/square/blue.css','/assets/plugins/jquery-confirm-master/css/jquery-confirm.css'], ['block' => true]);

 if(Configure::read('Setting.RAZORPAY_MODE') == 1){
      $api_key = Configure::read('Setting.RAZORPAY_LIVE_KEY');
      $api_secret = Configure::read('Setting.RAZORPAY_LIVE_SECRET');
    }else{
      $api_key = Configure::read('Setting.RAZORPAY_SANDBOX_KEY');
      $api_secret = Configure::read('Setting.RAZORPAY_SANDBOX_SECRET');
    }

$data = [
    "key"               => $api_key,
    "amount"            => $order->total_amount * 100,
    "name"              => Configure::read('Setting.SYSTEM_APPLICATION_NAME'),
    "description"       => "Purchase Description",
    "image"             => \Cake\Routing\Router::url('img/uploads/settings/'.Configure::read('Setting.MAIN_LOGO'), true),
    "prefill"           => [
        "name"              => $order->user->name,
        "email"             => $order->user->email,
        "contact"           => $order->user->user_profile->mobile ?? '',
    ],
    "notes"             => [
        "merchant_order_id" => $order->id,
    ],
    "theme"             => [
    "color"             => "#e04f67"
    ],
    "order_id"          => $order->razorpay_order,
];

?>
<script>
<?php $this->Html->scriptStart(['block' => true]); ?>
     $(document).ready(function(){

        // $('html,body').animate({
        //           scrollTop: $("#pageScrollDiv").offset().top - 50
        //         }, 5000);
        $( "#MakePaymentId" ).trigger( "click" );
    });
  var options = {
    "key": "<?php echo $api_key; ?>",
    "amount": "<?php echo $order->total_amount * 100; ?>", // 2000 paise = INR 20
    "name": "<?php echo Configure::read('Setting.SYSTEM_APPLICATION_NAME'); ?>",
    "description": "Purchase Description",
    "image": '<?php echo $this->Url->image("uploads/" . Configure::read('LISTING_ID') ."/settings/".Configure::read('Setting.ADMIN_LOGO')); ?>',

    "handler": function (response){
    // you can use ajax on this section
    //console.log(response);
            $.ajax({
                url: '<?php echo $this->Url->build(['controller'=>'Orders','action'=>'razorpay',$order->id]); ?>',
                type: 'post',
                data: {transactionId: response.razorpay_payment_id,signature: response.razorpay_signature, note: ''},
                dataType:'json',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-CSRF-Token', '<?php echo $this->request->getAttribute('csrfToken'); ?>');
                                        },
                success: function (json) {
                console.log(json);
                if(json.status = true){
                    //$("body").LoadingOverlay("show");
                        window.location.replace("<?php echo $this->Url->build(['controller'=>'Orders','action'=>'thankyou',$order->id]); ?>");
                   }else{
                        //alert(json.message);
                        $.alert({
                                title: 'Error alert!',
                                content: json.message,
                                icon: 'icon fa fa-ban',
                                animation: 'scale',
                                closeAnimation: 'scale',
                                //theme: 'alert-error',
                                buttons: {
                                        okay: {
                                                text: 'Okay',
                                                btnClass: 'btn-blue'
                                        }
                                }
                        });
                   }
                },
            });
    },
    "prefill": {
        "name": "<?php echo $order->user->name; ?>",
        "email": "<?php echo $order->user->email; ?>",
        "contact": "<?php echo $order->user->user_profile->mobile ?? ''; ?>",
    },
    "notes": {
        "merchant_order_id": "<?php echo $order->id; ?>",
        "address": "",
    },
    "theme": {
        "color": "#e04f67"
    },
    "order_id": "<?php echo $order->razorpay_order; ?>",
};
var rzp1 = new Razorpay(options);

document.getElementById('MakePaymentId').onclick = function(e){

    rzp1.open();
    e.preventDefault();
}

<?php $this->Html->scriptEnd(); ?>
</script>
