<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $coupon
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Coupon') ?>  
        </h1>
        <small><?php echo __('Here you can view coupon Detail'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row coupons view content">
<div class="col-12 col-sm-12 col-md-12">
    <div class="panel-default">
        <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= h($coupon->name) ?></h2>
                <div class="d-flex flex-wrap">
                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i> " . __('Edit Coupon'), ['action' => 'add', $coupon->id], ['class' => 'btn btn-block btn-success btn-sm btn-flat mrg-r20', 'escape' => false]) ?>
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>
            <div class="panel-body">
<table class="table table-hover table-bordered">
                <tr>
                    <th width="20%"><?= __('Name') ?></th>
                    <td><?= h($coupon->name) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Code') ?></th>
                    <td><?= h($coupon->code) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Coupon Type') ?></th>
                    <td><?= h($coupon->coupon_type == "P" ? "Percentage" : "Fixed Amount") ?></td>
                </tr>
               
                <tr>
                    <th><?= __('Discount') ?></th>
                    <td><?php
                                    if($coupon->coupon_type == "P"){
                                        echo $this->Number->format($coupon->discount). "%";
                                    }else{
                                        echo $this->Number->currency($coupon->discount, 'INR');
                                    }  ?></td>
                </tr>
                <tr>
                    <th><?= __('Total') ?></th>
                    <td><?= $this->Number->currency($coupon->total, 'INR') ?></td>
                </tr>
                <tr>
                    <th><?= __('Uses Total') ?></th>
                    <td><?= $this->Number->format($coupon->uses_total) ?></td>
                </tr>
                <tr>
                    <th><?= __('Uses Customer') ?></th>
                    <td><?= $this->Number->format($coupon->uses_customer) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date Start') ?></th>
                    <td>
                        <?php if ($coupon->date_start) {
                                echo $coupon->date_start->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Date End') ?></th>
                    <td>
                        <?php if ($coupon->date_end) {
                                echo $coupon->date_end->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td>
                        <?php if ($coupon->created) {
                                echo $coupon->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td>
                        <?php if ($coupon->modified) {
                                echo $coupon->modified->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $coupon->status ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>

        </div>
    </div>
</div>



