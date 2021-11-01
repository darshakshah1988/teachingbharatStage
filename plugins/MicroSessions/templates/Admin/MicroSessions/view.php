<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $microSession
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
        <small><?php echo __('Here you can view micro session Detail'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row microSessions view content">
<div class="col-12 col-sm-12 col-md-12">
    <div class="panel-default">
        <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= h($microSession->title) ?></h2>
                <div class="d-flex flex-wrap">
                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i> " . __('Edit Micro Session'), ['action' => 'add', $microSession->id], ['class' => 'btn btn-block btn-success btn-sm btn-flat mrg-r20', 'escape' => false]) ?>
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>
            <div class="panel-body">
<table class="table table-hover table-bordered">
                <tr>
                    <th width="20%"><?= __('Listing') ?></th>
                    <td><?= $microSession->has('listing') ? $this->Html->link($microSession->listing->title, ['controller' => 'Listings', 'action' => 'view', $microSession->listing->id]) : '' ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Slug') ?></th>
                    <td><?= h($microSession->slug) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('User') ?></th>
                    <td><?= $microSession->has('user') ? $this->Html->link($microSession->user->id, ['controller' => 'Users', 'action' => 'view', $microSession->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Parent Micro Session') ?></th>
                    <td><?= $microSession->has('parent_micro_session') ? $this->Html->link($microSession->parent_micro_session->title, ['controller' => 'MicroSessions', 'action' => 'view', $microSession->parent_micro_session->id]) : '' ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Grading Type') ?></th>
                    <td><?= $microSession->has('grading_type') ? $this->Html->link($microSession->grading_type->title, ['controller' => 'GradingTypes', 'action' => 'view', $microSession->grading_type->id]) : '' ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Academic Year') ?></th>
                    <td><?= $microSession->has('academic_year') ? $this->Html->link($microSession->academic_year->title, ['controller' => 'AcademicYears', 'action' => 'view', $microSession->academic_year->id]) : '' ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Title') ?></th>
                    <td><?= h($microSession->title) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Board') ?></th>
                    <td><?= $microSession->has('board') ? $this->Html->link($microSession->board->title, ['controller' => 'Boards', 'action' => 'view', $microSession->board->id]) : '' ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Subject') ?></th>
                    <td><?= $microSession->has('subject') ? $this->Html->link($microSession->subject->title, ['controller' => 'Subjects', 'action' => 'view', $microSession->subject->id]) : '' ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Duration') ?></th>
                    <td><?= h($microSession->duration) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Short Description') ?></th>
                    <td><?= h($microSession->short_description) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Description') ?></th>
                    <td><?= h($microSession->description) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Section Name') ?></th>
                    <td><?= h($microSession->section_name) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Code') ?></th>
                    <td><?= h($microSession->code) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($microSession->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Price') ?></th>
                    <td><?= $this->Number->format($microSession->price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Discount Price') ?></th>
                    <td><?= $this->Number->format($microSession->discount_price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lft') ?></th>
                    <td><?= $this->Number->format($microSession->lft) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rght') ?></th>
                    <td><?= $this->Number->format($microSession->rght) ?></td>
                </tr>
                <tr>
                    <th><?= __('Position') ?></th>
                    <td><?= $this->Number->format($microSession->position) ?></td>
                </tr>
                <tr>
                    <th><?= __('Start Date') ?></th>
                    <td>
                        <?php if ($microSession->start_date) {
                                echo $microSession->start_date->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('End Date') ?></th>
                    <td>
                        <?php if ($microSession->end_date) {
                                echo $microSession->end_date->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td>
                        <?php if ($microSession->created) {
                                echo $microSession->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td>
                        <?php if ($microSession->modified) {
                                echo $microSession->modified->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Is Free') ?></th>
                    <td><?= $microSession->is_free ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $microSession->status ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>

        </div>
    </div>
</div>



<?php if (!empty($microSession->phinxlog)) : ?>
                <div class="col-12 col-sm-12 col-md-12">
                <div class="panel-default">
                    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                        <h2><?= __('Related Phinxlog') ?></h2>
                </div>
                <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th><?= __('Version') ?></th>
                            <th><?= __('Migration Name') ?></th>
                            <th><?= __('Start Time') ?></th>
                            <th><?= __('End Time') ?></th>
                            <th><?= __('Breakpoint') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($microSession->phinxlog as $phinxlog) : ?>
                        <tr>
                            <td><?= h($phinxlog->version) ?></td>
                            <td><?= h($phinxlog->migration_name) ?></td>
                            <td><?= h($phinxlog->start_time) ?></td>
                            <td><?= h($phinxlog->end_time) ?></td>
                            <td><?= h($phinxlog->breakpoint) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Phinxlog', 'action' => 'view', $phinxlog->version], ['class' => 'btn btn-block btn-warning btn-xs btn-flat']) ?> 

                                <?= $this->Html->link(__('Edit'), ['controller' => 'Phinxlog', 'action' => 'edit', $phinxlog->version], ['class' => 'btn btn-block btn-success btn-xs btn-flat']) ?> 

                                <?= $this->Html->link(__('Delete'), 'javascript:void(0)', ['data-message' => __('Are you sure you want to delete # {0}?', $phinxlog->version), 'data-url'=> $this->Url->build(['controller' => 'Phinxlog', 'action' => 'delete', $phinxlog->version]), 'class' => 'deleteWithReload btn btn-block btn-danger btn-xs btn-flat']) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
<?php if (!empty($microSession->child_micro_sessions)) : ?>
                <div class="col-12 col-sm-12 col-md-12">
                <div class="panel-default">
                    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                        <h2><?= __('Related Micro Sessions') ?></h2>
                </div>
                <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Listing Id') ?></th>
                            <th><?= __('Slug') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Parent Id') ?></th>
                            <th><?= __('Grading Type Id') ?></th>
                            <th><?= __('Academic Year Id') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Board Id') ?></th>
                            <th><?= __('Subject Id') ?></th>
                            <th><?= __('Duration') ?></th>
                            <th><?= __('Price') ?></th>
                            <th><?= __('Discount Price') ?></th>
                            <th><?= __('Is Free') ?></th>
                            <th><?= __('Short Description') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Section Name') ?></th>
                            <th><?= __('Code') ?></th>
                            <th><?= __('Start Date') ?></th>
                            <th><?= __('End Date') ?></th>
                            <th><?= __('Lft') ?></th>
                            <th><?= __('Rght') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Position') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($microSession->child_micro_sessions as $childMicroSessions) : ?>
                        <tr>
                            <td><?= h($childMicroSessions->id) ?></td>
                            <td><?= h($childMicroSessions->listing_id) ?></td>
                            <td><?= h($childMicroSessions->slug) ?></td>
                            <td><?= h($childMicroSessions->user_id) ?></td>
                            <td><?= h($childMicroSessions->parent_id) ?></td>
                            <td><?= h($childMicroSessions->grading_type_id) ?></td>
                            <td><?= h($childMicroSessions->academic_year_id) ?></td>
                            <td><?= h($childMicroSessions->title) ?></td>
                            <td><?= h($childMicroSessions->board_id) ?></td>
                            <td><?= h($childMicroSessions->subject_id) ?></td>
                            <td><?= h($childMicroSessions->duration) ?></td>
                            <td><?= h($childMicroSessions->price) ?></td>
                            <td><?= h($childMicroSessions->discount_price) ?></td>
                            <td><?= h($childMicroSessions->is_free) ?></td>
                            <td><?= h($childMicroSessions->short_description) ?></td>
                            <td><?= h($childMicroSessions->description) ?></td>
                            <td><?= h($childMicroSessions->section_name) ?></td>
                            <td><?= h($childMicroSessions->code) ?></td>
                            <td><?= h($childMicroSessions->start_date) ?></td>
                            <td><?= h($childMicroSessions->end_date) ?></td>
                            <td><?= h($childMicroSessions->lft) ?></td>
                            <td><?= h($childMicroSessions->rght) ?></td>
                            <td><?= h($childMicroSessions->status) ?></td>
                            <td><?= h($childMicroSessions->position) ?></td>
                            <td><?= h($childMicroSessions->created) ?></td>
                            <td><?= h($childMicroSessions->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'MicroSessions', 'action' => 'view', $childMicroSessions->id], ['class' => 'btn btn-block btn-warning btn-xs btn-flat']) ?> 

                                <?= $this->Html->link(__('Edit'), ['controller' => 'MicroSessions', 'action' => 'edit', $childMicroSessions->id], ['class' => 'btn btn-block btn-success btn-xs btn-flat']) ?> 

                                <?= $this->Html->link(__('Delete'), 'javascript:void(0)', ['data-message' => __('Are you sure you want to delete # {0}?', $childMicroSessions->id), 'data-url'=> $this->Url->build(['controller' => 'MicroSessions', 'action' => 'delete', $childMicroSessions->id]), 'class' => 'deleteWithReload btn btn-block btn-danger btn-xs btn-flat']) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
