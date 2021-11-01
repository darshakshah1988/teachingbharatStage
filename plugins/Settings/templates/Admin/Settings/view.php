<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $setting
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Setting') ?>  
        </h1>
        <small><?php echo __('Here you can view setting Detail'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row settings view content">
<div class="col-12 col-sm-12 col-md-12">
    <div class="panel-default">
        <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= h($setting->title) ?></h2>
                <div class="d-flex flex-wrap">
                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i> " . __('Edit Setting'), ['action' => 'add', $setting->id], ['class' => 'btn btn-block btn-success btn-sm btn-flat mrg-r20', 'escape' => false]) ?>
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>
            <div class="panel-body">
<table class="table table-hover table-bordered">
                <tr>
                    <th width="20%"><?= __('Title') ?></th>
                    <td><?= h($setting->title) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Slug') ?></th>
                    <td><?= h($setting->slug) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Manager') ?></th>
                    <td><?= h($setting->manager) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Field Type') ?></th>
                    <td><?= h($setting->field_type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($setting->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Listing Id') ?></th>
                    <td><?= $this->Number->format($setting->listing_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td>
                        <?php if ($setting->created) {
                                echo $setting->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td>
                        <?php if ($setting->modified) {
                                echo $setting->modified->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Config Value') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($setting->config_value)); ?>
                </blockquote>
            </div>

        </div>
    </div>
</div>



