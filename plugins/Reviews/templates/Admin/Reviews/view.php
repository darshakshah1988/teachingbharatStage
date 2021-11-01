<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $review
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage {0} Review', ucfirst($this->request->getQuery('review_type'))) ?>
        </h1>
        <small><?php echo __('Here you can view review Detail'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row reviews view content">
<div class="col-12 col-sm-12 col-md-12">
    <div class="panel-default">
        <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= h($review->name) ?></h2>
                <div class="d-flex flex-wrap">
                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i> " . __('Edit Review'), ['action' => 'add', $review->id], ['class' => 'btn btn-block btn-success btn-sm btn-flat mrg-r20', 'escape' => false]) ?>
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index','?' => $this->request->getQuery()], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>
            <div class="panel-body">
<table class="table table-hover table-bordered">
                <tr>
                    <th width="20%"><?= __('User') ?></th>
                    <td><?= $review->has('user') ? $this->Html->link($review->user->id, ['controller' => 'Users', 'action' => 'view', $review->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Course') ?></th>
                    <td><?= $review->has('course') ? $this->Html->link($review->course->title, ['controller' => 'Courses', 'action' => 'view', $review->course->id]) : '' ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Name') ?></th>
                    <td><?= h($review->name) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Photo') ?></th>
                    <td><?= h($review->photo) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Photo Dir') ?></th>
                    <td><?= h($review->photo_dir) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Photo Type') ?></th>
                    <td><?= h($review->photo_type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($review->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rating') ?></th>
                    <td><?= $this->Number->format($review->rating) ?></td>
                </tr>
                <tr>
                    <th><?= __('Photo Size') ?></th>
                    <td><?= $this->Number->format($review->photo_size) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td>
                        <?php if ($review->created) {
                                echo $review->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td>
                        <?php if ($review->modified) {
                                echo $review->modified->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $review->status ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($review->description)); ?>
                </blockquote>
            </div>

        </div>
    </div>
</div>



<?php if (!empty($review->phinxlog)) : ?>
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
                        <?php foreach ($review->phinxlog as $phinxlog) : ?>
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
