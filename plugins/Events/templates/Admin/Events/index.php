<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $events
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Event') ?>
        </h1>
        <small><?php echo __('Here you can manage the events'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row events index content">

<div class="col-12 col-sm-12 col-md-12">
                <div class="panel-default">
                    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                        <h2><?= __('Event') ?> List</h2>
                        <div class="d-flex flex-wrap"><?= $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('New Event'), ["action" => "add"], ["class" => "btn btn-block btn-primary btn-sm btn-flat", "escape" => false]) ?></div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= $this->Paginator->sort('title') ?></th>
                                    <th><?= $this->Paginator->sort('location') ?></th>
                                    <th><?= $this->Paginator->sort('organizar_name') ?></th>
                                    <th><?= $this->Paginator->sort('organizer_email') ?></th>
                                    <th><?= $this->Paginator->sort('organizer_contact_number') ?></th>
                                    <th><?= $this->Paginator->sort('start_date') ?></th>
                                    <th><?= $this->Paginator->sort('status') ?></th>
                                    <th><?= $this->Paginator->sort('created') ?></th>
                                    <th class="action-col">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php if (!empty($events->toArray())):
                                    $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                    foreach ($events as $event): ?>
                                 <tr>
                                    <td><?= $this->Number->format($i) ?>.</td>
                                    <td>
                                        <?= h($event->title) ?>
                                        <small style="display: block;"><?= h($event->sub_title) ?></small>        
                                    </td>

                                <td><?= h($event->location) ?></td>
                                <td><?= h($event->organizar_name) ?></td>
                                <td><?= h($event->organizer_email) ?></td>
                                <td><?= h($event->organizer_contact_number) ?></td>
                                <td>
                                    <span style="display: block;"><strong>Event Start:</strong> <?= h($event->start_date) ?></span>
                                    <span><strong>Event End:</strong> <?= h($event->end_date) ?></span>
                                        
                                    </td>
                                <td>
                                    <?php if ($event->status == 1) {
                                            echo "Active";
                                        }else{
                                            echo "In-Active";
                                        }
                                    ?>
                                </td>
                                <td>
                             <?php if ($event->created) {
                                echo $event->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                            </td>


                        <td class="action-col">
                <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $event->id],['class' => 'btn btn-block btn-warning btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View event'),'title'=>__('View event')]) ?>

                <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'add', $event->id], ['class' => 'btn btn-block btn-success btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit event'),'title'=>__('Edit event')]) ?>

                <?= $this->Html->link("<i class=\"fa fa-trash\"></i>", ['action' => 'delete', $event->id], ['class' => 'confirmDeleteBtn btn btn-block btn-danger btn-xs btn-flat', 'data-url'=> $this->Url->build(['action' => 'delete', $event->id]), 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit event'),'title'=>__('Delete event')]) ?>
                    </td>
                </tr>
                                <?php $i++; endforeach; ?>
                            <?php else: ?>
                            <tr> <td colspan='23' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> </tr>
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
