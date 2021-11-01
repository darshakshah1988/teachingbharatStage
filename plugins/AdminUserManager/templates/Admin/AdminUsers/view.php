<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $adminUser
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Admin User') ?>  
        </h1>
        <small><?php echo __('Here you can view admin user Detail'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row adminUsers view content">
<div class="col-12 col-sm-12 col-md-12">
    <div class="panel-default">
        <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2>Profile</h2>
                <div class="d-flex flex-wrap">
                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i> " . __('Edit Admin User'), ['action' => 'edit', $adminUser->id], ['class' => 'btn btn-block btn-success btn-sm btn-flat mrg-r20', 'escape' => false]) ?>
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>
            <div class="panel-body">
            <table class="table table-hover table-bordered">
                <tr>
                    <th width="20%"><?= __('Title') ?></th>
                    <td><?= h($adminUser->title) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('First Name') ?></th>
                    <td><?= h($adminUser->first_name) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Middle Name') ?></th>
                    <td><?= h($adminUser->middle_name) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Last Name') ?></th>
                    <td><?= h($adminUser->last_name) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Mobile') ?></th>
                    <td><?= h($adminUser->mobile) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Email') ?></th>
                    <td><?= h($adminUser->email) ?></td>
                </tr>
                
                <tr>
                    <th><?= __('Dob') ?></th>
                    <td>
                        <?php if ($adminUser->dob) {
                                echo $adminUser->dob->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td>
                        <?php if ($adminUser->created) {
                                echo $adminUser->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td>
                        <?php if ($adminUser->modified) {
                                echo $adminUser->modified->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
             
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $adminUser->status ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Verified') ?></th>
                    <td><?= $adminUser->is_verified ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>

        </div>
    </div>
</div>




<div class="col-12 col-sm-12 col-md-12">
<div class="panel-default">
    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
        <h2><?= __('Related Roles') ?></h2>
</div>
<div class="panel-body">
<?php if (!empty($adminUser->roles)) : ?>
<div class="table-responsive">
    <table class="table table-hover table-bordered">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Title') ?></th>
            <th><?= __('Sort Order') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($adminUser->roles as $roles) : ?>
        <tr>
            <td><?= h($roles->id) ?></td>
            <td><?= h($roles->title) ?></td>
            <td><?= h($roles->sort_order) ?></td>
            <td><?= h($roles->created) ?></td>
            <td><?= h($roles->modified) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Roles', 'action' => 'view', $roles->id], ['class' => 'btn btn-block btn-warning btn-xs btn-flat']) ?> 

                <?= $this->Html->link(__('Edit'), ['controller' => 'Roles', 'action' => 'edit', $roles->id], ['class' => 'btn btn-block btn-success btn-xs btn-flat']) ?> 

                <?= $this->Html->link(__('Delete'), 'javascript:void(0)', ['data-message' => __('Are you sure you want to delete # {0}?', $roles->id), 'data-url'=> $this->Url->build(['controller' => 'Roles', 'action' => 'delete', $roles->id]), 'class' => 'deleteWithReload btn btn-block btn-danger btn-xs btn-flat']) ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php endif; ?>
</div>
</div>
</div>
