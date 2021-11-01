<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $carts
 */
?>
<div class="new-header-style-1">
        <div class="container">
            <div class="col-sm-12 text-center">
                <h2>COURSE CART</h2>
                <p>Confirm your purchase</p>
            </div>
        </div>
    </div>

 <section class="new-grey">
        <div class="container">
            <div class="col-sm-12 mb40">
                <div class="flashBox"><?= $this->Flash->render() ?></div>
                <table class="table table-bordered checkout-table">
                    <thead>
                        <th></th>
                        <th>Course / Product</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th class="text-right">Final Price</th>
                    </thead>
                    <tbody>
                        <?php
                        $session = $this->request->getSession(); 
                        if (!empty($carts->toArray())):
                            $cartAmount = 0;
                        foreach ($carts as $cart): 
                            $totalAmount = $cart->course->price - $cart->course->discount_price;
                            $cartAmount += $totalAmount;
                        ?>
                        <tr>
                            <td class="text-center">
                                <?= $this->Html->link('<i class="glyphicon glyphicon-trash"></i>', ['controller' => 'Carts', 'action' => 'delete', $cart->id], ['escape' => false]) ?>
                            </td>
                            <td>
                                <?= $cart->has('course') ? $this->Html->link($cart->course->title, ['controller' => 'Courses', 'action' => 'view', 'plugin' => 'Courses', $cart->course->id]) : '' ?>
                                <p><?= $cart->course->subject->title ?> | <?= $cart->course->grading_type->title ?></p>
                            </td>
                            <td><h4><?= $this->Number->currency($cart->course->price, 'INR') ?></h4></td>
                            <td>
                                <?php $discP = !empty($cart->course->discount_price) ? round(($cart->course->discount_price / $cart->course->price) * 100, 2) : 0; ?>
                                <h4><?php echo $discP ?>%</h4>

                            </td>
                            <td class="text-right"><h4><?= $this->Number->currency(($totalAmount > 0 ? $totalAmount : 0), 'INR') ?></h4></td>
                        </tr>
                        <?php endforeach; ?>
                        <tfoot>
                        <?php 
                        $finalAmount = $cartAmount;
                        if($availableFund && $availableFund > 0){ 
                            $finalAmount = $cartAmount - $availableFund;
                            ?>
                                <tr>
                                    <td colspan="4" align="right">
                                        Referral Credits: -<?= $this->Number->currency($availableFund, 'INR') ?>
                                    </td>
                                    <td align="right">
                                        <h3><?= $this->Number->currency(($finalAmount > 0 ? $finalAmount : 0), 'INR') ?></h3>
                                    </td>
                                </tr>
                            
                    <?php } 
                        //dump($session->read('promotion_coupon')); 
                        $disAmount = 0;
                        if($session->read('promotion_coupon')){
                            $disType = $session->read('promotion_coupon.coupon_type');
                            $disAmount = $session->read('promotion_coupon.discount');
                            if($disType == "p"){
                                $disAmount = ($disAmount / 100) * $finalAmount;
                            }
                        ?> 
                        <tr>
                            <td colspan="4" align="right">
                              <?= $this->Html->link('<i class="glyphicon glyphicon-trash"></i>', ['action' => 'removeCoupon'], ['escape' => false, 'class' => 'btn-danger label-xs white-color']) ?>
                              
                              Coupon (<?= $session->read('promotion_coupon.code') ?>):
                            </td>
                            <td align="right">
                                <h3><?= $this->Number->currency($disAmount, 'INR') ?></h3>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                        <tr>
                            <td colspan="4" align="right">
                                <strong>Total:</strong>
                            </td>
                            <td align="right">
                                <h3><?= $this->Number->currency($finalAmount - $disAmount, 'INR') ?></h3>
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
                <h3>What would you like to do next?</h3>
                <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
                <div class="panel-group" id="accordion">         
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title"><a href="#collapse-coupon" class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" aria-expanded="true">Use Coupon Code <i class="fa fa-caret-down"></i></a></h4>
                      </div>
                      <div id="collapse-coupon" class="panel-collapse collapse in" aria-expanded="true" style="">
                        <div class="panel-body">
                          <label class="col-sm-2 control-label" for="input-coupon">Enter your coupon here</label>
                              <div class="input-group">
                                <input type="text" name="coupon" value="<?= $session->read('promotion_coupon.code') ?>" placeholder="Enter your coupon here" id="input-coupon" class="form-control">
                                <span class="input-group-btn">
                                <input type="button" value="Apply Coupon" id="button-coupon" data-loading-text="Loading..." class="btn btn-primary">
                                </span>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-sm-12 text-center mt30 mb40">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <?php if (!empty($carts->toArray())): ?>
                        <div class="col-sm-4 col-sm-offset-4 mt20 mb40">
                            <?= $this->Html->link('<span>CHECK</span>OUT', ['controller' => 'Orders', 'action' => 'checkout'], ['class' => 'cdm-right-buy-btn', 'escape' =>  false]) ?>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </section>
<?php 
echo $this->Html->script(['/assets/plugins/jquery-loading-overlay-master/dist/loadingoverlay.min'],['block' => true]);
echo $this->Html->script(['common', 'Carts'], ['block' => true]); ?>
<script>
<?php $this->Html->scriptStart(['block' => true]); ?>
$carts = new Carts();
$(document).on("click", "#button-coupon", function(event) {
        event.preventDefault();
        $carts.coupon({'url': '<?= $this->Url->build(['controller' => 'Carts', 'action' => 'coupon']) ?>', filters: {coupon: $('input[name=\'coupon\']').val()}});
});
<?php $this->Html->scriptEnd(); ?>
</script>