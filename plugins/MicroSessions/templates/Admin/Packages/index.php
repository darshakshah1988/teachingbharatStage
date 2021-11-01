<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $packages
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Package') ?>
        </h1>
        <small><?php echo __('Here you can manage the packages'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row packages index content">

<div class="col-12 col-sm-12 col-md-12">
                <div class="panel-default">
                    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                        <h2><?= __('Package') ?> List</h2>
                        <div class="d-flex flex-wrap"><?= $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('New Package'), ["action" => "add"], ["class" => "btn btn-block btn-primary btn-sm btn-flat", "escape" => false]) ?></div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= $this->Paginator->sort('package_id') ?></th>
                                    <th><?= $this->Paginator->sort('listing_id') ?></th>
                                    <th><?= $this->Paginator->sort('slug') ?></th>
                                    <th><?= $this->Paginator->sort('user_id') ?></th>
                                    <th><?= $this->Paginator->sort('package_name') ?></th>
                                    <th><?= $this->Paginator->sort('package_title') ?></th>
                                    <th><?= $this->Paginator->sort('grading_type_id') ?></th>
                                    <th><?= $this->Paginator->sort('board_id') ?></th>
                                    <th><?= $this->Paginator->sort('subject_id') ?></th>
                                    <th><?= $this->Paginator->sort('short_description') ?></th>
                                    <th><?= $this->Paginator->sort('description') ?></th>
                                    <th><?= $this->Paginator->sort('start_date') ?></th>
                                    <th><?= $this->Paginator->sort('end_date') ?></th>
                                    <th><?= $this->Paginator->sort('status') ?></th>
                                    <th><?= $this->Paginator->sort('created') ?></th>
                        <th class="action-col">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php if (!empty($packages->toArray())):
                                    $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                    foreach ($packages as $package): ?>
                                 <tr>
                                    <td><?= $this->Number->format($i) ?>.</td>
                            <td><?= $this->Number->format($package->package_id) ?></td>
                                <td><?= $this->Number->format($package->listing_id) ?></td>
                                <td><?= h($package->slug) ?></td>


                                <td><?= h($package->user_id) ?></td>


                                <td><?= h($package->package_name) ?></td>


                                <td><?= h($package->package_title) ?></td>


                                <td><?= $this->Number->format($package->grading_type_id) ?></td>
                                <td><?= $this->Number->format($package->board_id) ?></td>
                                <td><?= $this->Number->format($package->subject_id) ?></td>
                                <td><?= h($package->short_description) ?></td>


                                <td><?= h($package->description) ?></td>


                                <td><?= h($package->start_date) ?></td>


                                <td><?= h($package->end_date) ?></td>


                                    <td>
                                    <?php if ($package->status == 1) {
                                            echo "Yes";
                                        }else{
                                            echo "No";
                                        }
                                    ?>
                                </td>

                                <td>
                             <?php if ($package->created) {
                                echo $package->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                            </td>


                        <td class="action-col">
                <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $package->id],['class' => 'btn btn-block btn-warning btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View package'),'title'=>__('View package')]) ?>

                <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'add', $package->id], ['class' => 'btn btn-block btn-success btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit package'),'title'=>__('Edit package')]) ?>

                <?= $this->Html->link("<i class=\"fa fa-trash\"></i>", 'javascript:void(0)', ['class' => 'deleteWithReload btn btn-block btn-danger btn-xs btn-flat', 'data-url'=> $this->Url->build(['action' => 'delete', $package->id]), 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit package'),'title'=>__('Delete package')]) ?>
                    </td>
                </tr>
                                <?php $i++; endforeach; ?>
                            <?php else: ?>
                            <tr> <td colspan='17' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> </tr>
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
