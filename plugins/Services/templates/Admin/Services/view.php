<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $service
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Service') ?>  
        </h1>
        <small><?php echo __('Here you can view service Detail'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row services view content">
<div class="col-12 col-sm-12 col-md-12">
    <div class="panel-default">
        <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= h($service->title) ?></h2>
                <div class="d-flex flex-wrap">
                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i> " . __('Edit Service'), ['action' => 'add', $service->id], ['class' => 'btn btn-block btn-success btn-sm btn-flat mrg-r20', 'escape' => false]) ?>
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>
            <div class="panel-body">
<table class="table table-hover table-bordered">
                <tr>
                    <th width="20%"><?= __('Title') ?></th>
                    <td><?= h($service->title) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Slug') ?></th>
                    <td><?= h($service->slug) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Service Icon') ?></th>
                    <td><?= h($service->service_icon) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Short Description') ?></th>
                    <td><?= h($service->short_description) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Description') ?></th>
                    <td><?= h($service->description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($service->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Listing Id') ?></th>
                    <td><?= $this->Number->format($service->listing_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Position') ?></th>
                    <td><?= $this->Number->format($service->position) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td>
                        <?php if ($service->created) {
                                echo $service->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td>
                        <?php if ($service->modified) {
                                echo $service->modified->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $service->status ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>

        </div>
    </div>
</div>



