<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $course
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Course') ?>  
        </h1>
        <small><?php echo __('Here you can view course Detail'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row courses view content">
    <div class="col-12 col-sm-12 col-md-12">
        <div class="panel-default">
            <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= h($course->title) ?></h2>
                <div class="d-flex flex-wrap">
                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i> " . __('Edit Course'), ['action' => 'add', $course->id], ['class' => 'btn btn-block btn-success btn-sm btn-flat mrg-r20', 'escape' => false]) ?>
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-hover table-bordered">
                        <tr>
                            <th width="20%"><?= __('Teacher') ?></th>
                            <td><?= $this->Html->link($course->user->name, ['controller' => 'Users', 'action' => 'view','plugin' => 'UserManager', $course->user_id], ['target' => '_blank']) ?></td>
                        </tr>
                        <tr>
                            <th width="20%"><?= __('Grading Type') ?></th>
                            <td><?= $course->has('grading_type') ? $this->Html->link($course->grading_type->title, ['controller' => 'GradingTypes', 'action' => 'view', $course->grading_type->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th width="20%"><?= __('Title') ?></th>
                            <td><?= h($course->title) ?></td>
                        </tr>

                        <tr>
                            <th width="20%"><?= __('Board') ?></th>
                            <td><?= h($course->board->title) ?></td>
                        </tr>

                        <tr>
                            <th width="20%"><?= __('Class') ?></th>
                            <td><?= h($course->grading_type->title) ?></td>
                        </tr>

                        <tr>
                            <th width="20%"><?= __('Subject') ?></th>
                            <td><?= h($course->subject->title) ?></td>
                        </tr>
                       
                       <tr>
                            <th width="20%"><?= __('Duration') ?></th>
                            <td><?= h($course->duration) ?> Hour(S)</td>
                        </tr>

                        <tr>
                            <th width="20%"><?= __('Price') ?></th>
                            <td><?= $this->Number->currency($course->price, 'INR') ?></td>
                        </tr>

                        <tr>
                            <th width="20%"><?= __('Discount') ?></th>
                            <td><?= $this->Number->currency($course->discount_price, 'INR') ?></td>
                        </tr>

                        <tr>
                            <th><?= __('Is Free') ?></th>
                            <td><?= $course->is_free ? __('Yes') : __('No'); ?></td>
                        </tr>
                        
                        <tr>
                            <th><?= __('Created') ?></th>
                            <td>
                                <?php if ($course->created) {
                                        echo $course->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                        }
                                    ?>
                                </td>
                        </tr>
                        <tr>
                            <th><?= __('Modified') ?></th>
                            <td>
                                <?php if ($course->modified) {
                                        echo $course->modified->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                        }
                                    ?>
                                </td>
                        </tr>
                        <tr>
                            <th><?= __('Status') ?></th>
                            <td><?= $course->status ? __('Yes') : __('No'); ?></td>
                        </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-12 col-md-12">
        <div class="panel-default">
            <div class="panel-body">
                <?= $course->description ?>
            </div>
        </div>
    </div>
</div>


