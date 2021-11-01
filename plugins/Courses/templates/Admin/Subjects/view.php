<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $subject
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Subject') ?>  
        </h1>
        <small><?php echo __('Here you can view subject Detail'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row subjects view content">
<div class="col-12 col-sm-12 col-md-12">
    <div class="panel-default">
        <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= h($subject->title) ?></h2>
                <div class="d-flex flex-wrap">
                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i> " . __('Edit Subject'), ['action' => 'add', $subject->id], ['class' => 'btn btn-block btn-success btn-sm btn-flat mrg-r20', 'escape' => false]) ?>
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>
            <div class="panel-body">
<table class="table table-hover table-bordered">
                <tr>
                    <th width="20%"><?= __('Course') ?></th>
                    <td><?= $subject->has('course') ? $this->Html->link($subject->course->title, ['controller' => 'Courses', 'action' => 'view', $subject->course->id]) : '' ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Title') ?></th>
                    <td><?= h($subject->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($subject->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Max Weekly Classes') ?></th>
                    <td><?= $this->Number->format($subject->max_weekly_classes) ?></td>
                </tr>
                <tr>
                    <th><?= __('Credit Hours') ?></th>
                    <td><?= $this->Number->format($subject->credit_hours) ?></td>
                </tr>
                <tr>
                    <th><?= __('Position') ?></th>
                    <td><?= $this->Number->format($subject->position) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td>
                        <?php if ($subject->created) {
                                echo $subject->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td>
                        <?php if ($subject->modified) {
                                echo $subject->modified->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Is Activity') ?></th>
                    <td><?= $subject->is_activity ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Exam') ?></th>
                    <td><?= $subject->is_exam ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>

        </div>
    </div>
</div>



<?php if (!empty($subject->subjects_teachers)) : ?>
                <div class="col-12 col-sm-12 col-md-12">
                <div class="panel-default">
                    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                        <h2><?= __('Related Subjects Teachers') ?></h2>
                </div>
                <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Subject Id') ?></th>
                            <th><?= __('Teacher Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($subject->subjects_teachers as $subjectsTeachers) : ?>
                        <tr>
                            <td><?= h($subjectsTeachers->id) ?></td>
                            <td><?= h($subjectsTeachers->subject_id) ?></td>
                            <td><?= h($subjectsTeachers->teacher_id) ?></td>
                            <td><?= h($subjectsTeachers->created) ?></td>
                            <td><?= h($subjectsTeachers->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'SubjectsTeachers', 'action' => 'view', $subjectsTeachers->id], ['class' => 'btn btn-block btn-warning btn-xs btn-flat']) ?> 

                                <?= $this->Html->link(__('Edit'), ['controller' => 'SubjectsTeachers', 'action' => 'edit', $subjectsTeachers->id], ['class' => 'btn btn-block btn-success btn-xs btn-flat']) ?> 

                                <?= $this->Html->link(__('Delete'), 'javascript:void(0)', ['data-message' => __('Are you sure you want to delete # {0}?', $subjectsTeachers->id), 'data-url'=> $this->Url->build(['controller' => 'SubjectsTeachers', 'action' => 'delete', $subjectsTeachers->id]), 'class' => 'deleteWithReload btn btn-block btn-danger btn-xs btn-flat']) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
