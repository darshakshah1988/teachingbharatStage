<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $language
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Language') ?>  
        </h1>
        <small><?php echo __('Here you can view language Detail'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row languages view content">
<div class="col-12 col-sm-12 col-md-12">
    <div class="panel-default">
        <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= h($language->title) ?></h2>
                <div class="d-flex flex-wrap">
                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i> " . __('Edit Language'), ['action' => 'add', $language->id], ['class' => 'btn btn-block btn-success btn-sm btn-flat mrg-r20', 'escape' => false]) ?>
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>
            <div class="panel-body">
<table class="table table-hover table-bordered">
                <tr>
                    <th width="20%"><?= __('Title') ?></th>
                    <td><?= h($language->title) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Code') ?></th>
                    <td><?= h($language->code) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Locale') ?></th>
                    <td><?= h($language->locale) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Image') ?></th>
                    <td><?= h($language->image) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Image Dir') ?></th>
                    <td><?= h($language->image_dir) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Image Type') ?></th>
                    <td><?= h($language->image_type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($language->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Image Size') ?></th>
                    <td><?= $this->Number->format($language->image_size) ?></td>
                </tr>
                <tr>
                    <th><?= __('Position') ?></th>
                    <td><?= $this->Number->format($language->position) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td>
                        <?php if ($language->created) {
                                echo $language->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td>
                        <?php if ($language->modified) {
                                echo $language->modified->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $language->status ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>

        </div>
    </div>
</div>



