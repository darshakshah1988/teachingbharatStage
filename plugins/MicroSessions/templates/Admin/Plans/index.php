<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $plans
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Plan') ?>
        </h1>
        <small><?php echo __('Here you can manage the plans'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row plans index content">

<div class="col-12 col-sm-12 col-md-12">
                <div class="panel-default">
                    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                        <h2><?= __('Plan') ?> List</h2>
                        <div class="d-flex flex-wrap"><?= $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('New Plan'), ["action" => "add"], ["class" => "btn btn-block btn-primary btn-sm btn-flat", "escape" => false]) ?></div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= $this->Paginator->sort('plan_id') ?></th>
                                    <th><?= $this->Paginator->sort('listing_id') ?></th>
                                    <th><?= $this->Paginator->sort('slug') ?></th>
                                    <th><?= $this->Paginator->sort('user_id') ?></th>
                                    <th><?= $this->Paginator->sort('plan_name') ?></th>
                                    <th><?= $this->Paginator->sort('duration') ?></th>
                                    <th><?= $this->Paginator->sort('price') ?></th>
                                    <th><?= $this->Paginator->sort('discount_price') ?></th>
                                    <th><?= $this->Paginator->sort('features') ?></th>
                                    <th><?= $this->Paginator->sort('other_details') ?></th>
                                    <th><?= $this->Paginator->sort('start_date') ?></th>
                                    <th><?= $this->Paginator->sort('end_date') ?></th>
                                    <th><?= $this->Paginator->sort('status') ?></th>
                                    <th><?= $this->Paginator->sort('created') ?></th>
                        <th class="action-col">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php if (!empty($plans->toArray())):
                                    $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                    foreach ($plans as $plan): ?>
                                 <tr>
                                    <td><?= $this->Number->format($i) ?>.</td>
                            <td><?= $this->Number->format($plan->plan_id) ?></td>
                                <td><?= $this->Number->format($plan->listing_id) ?></td>
                                <td><?= h($plan->slug) ?></td>


                                <td><?= h($plan->user_id) ?></td>


                                <td><?= h($plan->plan_name) ?></td>


                                <td><?= h($plan->duration) ?></td>


                                <td><?= $this->Number->format($plan->price) ?></td>
                                <td><?= $this->Number->format($plan->discount_price) ?></td>
                                <td><?= h($plan->features) ?></td>


                                <td><?= h($plan->other_details) ?></td>


                                <td><?= h($plan->start_date) ?></td>


                                <td><?= h($plan->end_date) ?></td>


                                    <td>
                                    <?php if ($plan->status == 1) {
                                            echo "Yes";
                                        }else{
                                            echo "No";
                                        }
                                    ?>
                                </td>

                                <td>
                             <?php if ($plan->created) {
                                echo $plan->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                            </td>


                        <td class="action-col">
                <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $plan->id],['class' => 'btn btn-block btn-warning btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View plan'),'title'=>__('View plan')]) ?>

                <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'add', $plan->id], ['class' => 'btn btn-block btn-success btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit plan'),'title'=>__('Edit plan')]) ?>

                <?= $this->Html->link("<i class=\"fa fa-trash\"></i>", 'javascript:void(0)', ['class' => 'deleteWithReload btn btn-block btn-danger btn-xs btn-flat', 'data-url'=> $this->Url->build(['action' => 'delete', $plan->id]), 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit plan'),'title'=>__('Delete plan')]) ?>
                    </td>
                </tr>
                                <?php $i++; endforeach; ?>
                            <?php else: ?>
                            <tr> <td colspan='16' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> </tr>
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
