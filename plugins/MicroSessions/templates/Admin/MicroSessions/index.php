<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $microSessions
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Micro Session') ?>
        </h1>
        <small><?php echo __('Here you can manage the micro sessions'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row microSessions index content">

<div class="col-12 col-sm-12 col-md-12">
                <div class="panel-default">
                    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                        <h2><?= __('Micro Session') ?> List</h2>
                        <div class="d-flex flex-wrap"><?= $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('New Micro Session'), ["action" => "add"], ["class" => "btn btn-block btn-primary btn-sm btn-flat", "escape" => false]) ?></div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= $this->Paginator->sort('listing_id') ?></th>
                                    <th><?= $this->Paginator->sort('slug') ?></th>
                                    <th><?= $this->Paginator->sort('user_id') ?></th>
                                    <th><?= $this->Paginator->sort('parent_id') ?></th>
                                    <th><?= $this->Paginator->sort('grading_type_id') ?></th>
                                    <th><?= $this->Paginator->sort('academic_year_id') ?></th>
                                    <th><?= $this->Paginator->sort('title') ?></th>
                                    <th><?= $this->Paginator->sort('board_id') ?></th>
                                    <th><?= $this->Paginator->sort('subject_id') ?></th>
                                    <th><?= $this->Paginator->sort('duration') ?></th>
                                    <th><?= $this->Paginator->sort('price') ?></th>
                                    <th><?= $this->Paginator->sort('discount_price') ?></th>
                                    <th><?= $this->Paginator->sort('is_free') ?></th>
                                    <th><?= $this->Paginator->sort('short_description') ?></th>
                                    <th><?= $this->Paginator->sort('description') ?></th>
                                    <th><?= $this->Paginator->sort('section_name') ?></th>
                                    <th><?= $this->Paginator->sort('code') ?></th>
                                    <th><?= $this->Paginator->sort('start_date') ?></th>
                                    <th><?= $this->Paginator->sort('end_date') ?></th>
                                    <th><?= $this->Paginator->sort('status') ?></th>
                                    <th><?= $this->Paginator->sort('position') ?></th>
                                    <th><?= $this->Paginator->sort('created') ?></th>
                        <th class="action-col">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php if (!empty($microSessions->toArray())):
                                    $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                    foreach ($microSessions as $microSession): ?>
                                 <tr>
                                    <td><?= $this->Number->format($i) ?>.</td>
                                    <td>
                                        <?= $microSession->has('listing') ? $this->Html->link($microSession->listing->title, ['controller' => 'Listings', 'action' => 'view', $microSession->listing->id]) : '' ?>
                                    </td>
                                <td><?= h($microSession->slug) ?></td>


                                        <td>
                                        <?= $microSession->has('user') ? $this->Html->link($microSession->user->id, ['controller' => 'Users', 'action' => 'view', $microSession->user->id]) : '' ?>
                                    </td>
                                        <td>
                                        <?= $microSession->has('parent_micro_session') ? $this->Html->link($microSession->parent_micro_session->title, ['controller' => 'MicroSessions', 'action' => 'view', $microSession->parent_micro_session->id]) : '' ?>
                                    </td>
                                        <td>
                                        <?= $microSession->has('grading_type') ? $this->Html->link($microSession->grading_type->title, ['controller' => 'GradingTypes', 'action' => 'view', $microSession->grading_type->id]) : '' ?>
                                    </td>
                                        <td>
                                        <?= $microSession->has('academic_year') ? $this->Html->link($microSession->academic_year->title, ['controller' => 'AcademicYears', 'action' => 'view', $microSession->academic_year->id]) : '' ?>
                                    </td>
                                <td><?= h($microSession->title) ?></td>


                                        <td>
                                        <?= $microSession->has('board') ? $this->Html->link($microSession->board->title, ['controller' => 'Boards', 'action' => 'view', $microSession->board->id]) : '' ?>
                                    </td>
                                        <td>
                                        <?= $microSession->has('subject') ? $this->Html->link($microSession->subject->title, ['controller' => 'Subjects', 'action' => 'view', $microSession->subject->id]) : '' ?>
                                    </td>
                                <td><?= h($microSession->duration) ?></td>


                                <td><?= $this->Number->format($microSession->price) ?></td>
                                <td><?= $this->Number->format($microSession->discount_price) ?></td>
                                    <td>
                                    <?php if ($microSession->is_free == 1) {
                                            echo "Yes";
                                        }else{
                                            echo "No";
                                        }
                                    ?>
                                </td>

                                <td><?= h($microSession->short_description) ?></td>


                                <td><?= h($microSession->description) ?></td>


                                <td><?= h($microSession->section_name) ?></td>


                                <td><?= h($microSession->code) ?></td>


                                <td><?= h($microSession->start_date) ?></td>


                                <td><?= h($microSession->end_date) ?></td>


                                    <td>
                                    <?php if ($microSession->status == 1) {
                                            echo "Yes";
                                        }else{
                                            echo "No";
                                        }
                                    ?>
                                </td>

                                <td><?= $this->Number->format($microSession->position) ?></td>
                                <td>
                             <?php if ($microSession->created) {
                                echo $microSession->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                            </td>


                        <td class="action-col">
                <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $microSession->id],['class' => 'btn btn-block btn-warning btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View micro session'),'title'=>__('View micro session')]) ?>

                <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'add', $microSession->id], ['class' => 'btn btn-block btn-success btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit micro session'),'title'=>__('Edit micro session')]) ?>

                <?= $this->Html->link("<i class=\"fa fa-trash\"></i>", 'javascript:void(0)', ['class' => 'deleteWithReload btn btn-block btn-danger btn-xs btn-flat', 'data-url'=> $this->Url->build(['action' => 'delete', $microSession->id]), 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit micro session'),'title'=>__('Delete micro session')]) ?>
                    </td>
                </tr>
                                <?php $i++; endforeach; ?>
                            <?php else: ?>
                            <tr> <td colspan='24' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> </tr>
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
