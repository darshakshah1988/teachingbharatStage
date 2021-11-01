<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $announcement
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Announcement') ?>  
        </h1>
        <small><?php echo __('Here you can view announcement Detail'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row announcements view content">
<div class="col-12 col-sm-12 col-md-12">
    <div class="d-block">
    <div class="panel-default">
        <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= h($announcement->title) ?></h2>
                <div class="d-flex flex-wrap">
                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i> " . __('Edit Announcement'), ['action' => 'add', $announcement->id], ['class' => 'btn btn-block btn-success btn-sm btn-flat mrg-r20', 'escape' => false]) ?>
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>
            <div class="panel-body">
            <table class="table table-hover table-bordered">
                <tr>
                    <th width="20%"><?= __('Title') ?></th>
                    <td><?= h($announcement->title) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Slug') ?></th>
                    <td><?= h($announcement->slug) ?></td>
                </tr>
               
               
                <tr>
                    <th><?= __('Created') ?></th>
                    <td>
                        <?php if ($announcement->created) {
                                echo $announcement->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td>
                        <?php if ($announcement->modified) {
                                echo $announcement->modified->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $announcement->status ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>

<div class="d-block">
    <div class="panel-default">
        <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2>Description</h2>
            </div>
            <div class="panel-body">
            
                    <?= $this->Text->autoParagraph($announcement->description); ?>
            </div>

        </div>
    </div>
</div>
</div>



