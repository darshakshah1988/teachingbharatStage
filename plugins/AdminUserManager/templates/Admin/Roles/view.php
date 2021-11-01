<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $role
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Role') ?>  
        </h1>
        <small><?php echo __('Here you can view role Detail'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row roles view content">
<div class="col-12 col-sm-12 col-md-12">
    <div class="panel-default">
        <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= h($role->title) ?></h2>
                <div class="d-flex flex-wrap">
                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i> " . __('Edit Role'), ['action' => 'add', $role->id], ['class' => 'btn btn-block btn-success btn-sm btn-flat mrg-r20', 'escape' => false]) ?>
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>
            <div class="panel-body">
            <table class="table table-hover table-bordered">
                <tr>
                    <th width="20%"><?= __('Title') ?></th>
                    <td><?= h($role->title) ?></td>
                </tr>
                
                <tr>
                    <th><?= __('Sort Order') ?></th>
                    <td><?= $this->Number->format($role->sort_order) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td>
                        <?php if ($role->created) {
                                echo $role->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td>
                        <?php if ($role->modified) {
                                echo $role->modified->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
            </table>

        </div>
    </div>
</div>



<?php if (!empty($role->admin_users)) : ?>
                <div class="col-12 col-sm-12 col-md-12">
                <div class="panel-default">
                    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                        <h2><?= __('Related Admin Users') ?></h2>
                </div>
                <div class="panel-body">
                
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('First Name') ?></th>
                            <th><?= __('Middle Name') ?></th>
                            <th><?= __('Last Name') ?></th>
                            <th><?= __('Mobile') ?></th>
                            <th><?= __('Dob') ?></th>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Is Verified') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($role->admin_users as $adminUsers) : ?>
                        <tr>
                            <td><?= h($adminUsers->id) ?></td>
                            <td><?= h($adminUsers->title) ?></td>
                            <td><?= h($adminUsers->first_name) ?></td>
                            <td><?= h($adminUsers->middle_name) ?></td>
                            <td><?= h($adminUsers->last_name) ?></td>
                            <td><?= h($adminUsers->mobile) ?></td>
                            <td><?= h($adminUsers->dob) ?></td>
                            <td><?= h($adminUsers->email) ?></td>
                            <td><?= h($adminUsers->status) ?></td>
                            <td><?= h($adminUsers->is_verified) ?></td>
                            <td><?= h($adminUsers->created) ?></td>
                            <td><?= h($adminUsers->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'AdminUsers', 'action' => 'view', $adminUsers->id], ['class' => 'btn btn-block btn-warning btn-xs btn-flat']) ?> 

                                <?= $this->Html->link(__('Edit'), ['controller' => 'AdminUsers', 'action' => 'edit', $adminUsers->id], ['class' => 'btn btn-block btn-success btn-xs btn-flat']) ?> 

                                <?= $this->Html->link(__('Delete'), 'javascript:void(0)', ['data-message' => __('Are you sure you want to delete # {0}?', $adminUsers->id), 'data-url'=> $this->Url->build(['controller' => 'AdminUsers', 'action' => 'delete', $adminUsers->id]), 'class' => 'deleteWithReload btn btn-block btn-danger btn-xs btn-flat']) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                
                </div>
            </div>
        </div>
<?php endif; ?>