<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $locations
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Location') ?>
        </h1>
        <small><?php echo __('Here you can manage the locations'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row locations index content">

<div class="col-12 col-sm-12 col-md-12">
                <div class="panel-default">
                    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                        <h2><?= __('Location') ?> List</h2>
                        <div class="d-flex flex-wrap"><?= $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('New Location'), ["action" => "add"], ["class" => "btn btn-block btn-primary btn-sm btn-flat", "escape" => false]) ?></div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Parent Menu</th>
                                    <th><?= $this->Paginator->sort('title') ?></th>
                                    <th><?= $this->Paginator->sort('status') ?></th>
                                    <th><?= $this->Paginator->sort('created') ?></th>
                        <th class="action-col">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php if (!empty($locations->toArray())):
                                    $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                    foreach ($locations as $location): ?>
                                 <tr>
                                    <td><?= $this->Number->format($i) ?>.</td>
                                    <td><?php echo $this->cell('Locations.Location::getParents', [$location->id]); ?></td>  
                                    <td><?= h($location->title) ?></td>

                                    <td>
                                    <?php if ($location->status == 1) {
                                            echo "Active";
                                        }else{
                                            echo "In-Active";
                                        }
                                    ?>
                                </td>

                                <td>
                             <?php if ($location->created) {
                                echo $location->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                            </td>


                        <td class="action-col">
                <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $location->id],['class' => 'btn btn-block btn-warning btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View location'),'title'=>__('View location')]) ?>

                <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'add', $location->id], ['class' => 'btn btn-block btn-success btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit location'),'title'=>__('Edit location')]) ?>

                <?= $this->Html->link("<i class=\"fa fa-trash\"></i>", ['action' => 'delete', $location->id], ['class' => 'confirmDeleteBtn btn btn-block btn-danger btn-xs btn-flat', 'data-url'=> $this->Url->build(['action' => 'delete', $location->id]), 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Delete location'),'title'=>__('Delete location')]) ?>
                    </td>
                </tr>
                                <?php $i++; endforeach; ?>
                            <?php else: ?>
                            <tr> <td colspan='12' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> </tr>
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
