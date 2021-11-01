<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $userDocument
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage User Document') ?>  
        </h1>
        <small><?php echo __('Here you can view user document Detail'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row userDocuments view content">
<div class="col-12 col-sm-12 col-md-12">
    <div class="panel-default">
        <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= h($userDocument->id) ?></h2>
                <div class="d-flex flex-wrap">
                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i> " . __('Edit User Document'), ['action' => 'add', $userDocument->id], ['class' => 'btn btn-block btn-success btn-sm btn-flat mrg-r20', 'escape' => false]) ?>
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>
            <div class="panel-body">
<table class="table table-hover table-bordered">
                <tr>
                    <th width="20%"><?= __('User') ?></th>
                    <td><?= $userDocument->has('user') ? $this->Html->link($userDocument->user->id, ['controller' => 'Users', 'action' => 'view', $userDocument->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Document File') ?></th>
                    <td><?= h($userDocument->document_file) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Document Dir') ?></th>
                    <td><?= h($userDocument->document_dir) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Document Type') ?></th>
                    <td><?= h($userDocument->document_type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($userDocument->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Document Type Id') ?></th>
                    <td><?= $this->Number->format($userDocument->document_type_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Document Size') ?></th>
                    <td><?= $this->Number->format($userDocument->document_size) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td>
                        <?php if ($userDocument->created) {
                                echo $userDocument->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td>
                        <?php if ($userDocument->modified) {
                                echo $userDocument->modified->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
            </table>

        </div>
    </div>
</div>



