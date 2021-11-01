<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $coupons
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
        <small><?php echo __('Here you can manage the coupons'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row coupons index content">

<div class="col-12 col-sm-12 col-md-12">
                <div class="panel-default">
                    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                        <h2><?= __('Coupon') ?> List</h2>
                        <div class="d-flex flex-wrap"><?= $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('New Coupon'), ["action" => "add"], ["class" => "btn btn-block btn-primary btn-sm btn-flat", "escape" => false]) ?></div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= $this->Paginator->sort('name') ?></th>
                                    <th><?= $this->Paginator->sort('code') ?></th>
                                    <th><?= $this->Paginator->sort('coupon_type') ?></th>
                                    <th><?= $this->Paginator->sort('discount') ?></th>
                                    <!-- <th><?= $this->Paginator->sort('total') ?></th> -->
                                    <th><?= $this->Paginator->sort('date_start') ?></th>
                                    <th><?= $this->Paginator->sort('date_end') ?></th>
                                    <!-- <th><?= $this->Paginator->sort('uses_total') ?></th>
                                    <th><?= $this->Paginator->sort('uses_customer') ?></th> -->
                                    <th><?= $this->Paginator->sort('status') ?></th>
                                    <th><?= $this->Paginator->sort('created') ?></th>
                        <th class="action-col">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php if (!empty($coupons->toArray())):
                                    $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                    foreach ($coupons as $coupon): ?>
                                 <tr>
                                    <td><?= $this->Number->format($i) ?>.</td>
                                    <td><?= h($coupon->name) ?></td>


                                <td><?= h($coupon->code) ?></td>


                                <td><?= h($coupon->coupon_type == "p" ? "Percentage" : "Fixed Amount") ?></td>


                                <td><?php
                                    if($coupon->coupon_type == "p"){
                                        echo $this->Number->format($coupon->discount). "%";
                                    }else{
                                        echo $this->Number->currency($coupon->discount, 'INR');
                                    }  ?></td>
                               <!--  <td><?= $this->Number->format($coupon->total) ?></td> -->
                                <td><?= $coupon->date_start->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_FORMAT')) ?></td>


                                <td><?= $coupon->date_end->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_FORMAT')) ?></td>


                               <!--  <td><?= $this->Number->format($coupon->uses_total) ?></td>
                                <td><?= $this->Number->format($coupon->uses_customer) ?></td> -->
                                    <td>
                                    <?php if ($coupon->status == 1) {
                                            echo "Yes";
                                        }else{
                                            echo "No";
                                        }
                                    ?>
                                </td>

                                <td>
                             <?php if ($coupon->created) {
                                echo $coupon->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                            </td>


                        <td class="action-col">
                <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $coupon->id],['class' => 'btn btn-block btn-warning btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View coupon'),'title'=>__('View coupon')]) ?>

                <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'add', $coupon->id], ['class' => 'btn btn-block btn-success btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit coupon'),'title'=>__('Edit coupon')]) ?>

                <?= $this->Html->link("<i class=\"fa fa-trash\"></i>", 'javascript:void(0)', ['class' => 'deleteWithReload btn btn-block btn-danger btn-xs btn-flat', 'data-url'=> $this->Url->build(['action' => 'delete', $coupon->id]), 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit coupon'),'title'=>__('Delete coupon')]) ?>
                    </td>
                </tr>
                                <?php $i++; endforeach; ?>
                            <?php else: ?>
                            <tr> <td colspan='13' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> </tr>
                            <?php endif; ?>
                              </tbody>
                            </table>
                        </div>
                        <div class="pagination-sec d-flex justify-content-between flex-wrap align-items-center">
                            <?php echo $this->element('pagination'); ?>
                        </div>
                    </div>
                </div>
            </div>
