<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $location
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Location') ?>  
        </h1>
        <small><?php echo __('Here you can view location Detail'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row locations view content">
<div class="col-12 col-sm-12 col-md-12">
    <div class="panel-default">
        <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= h($location->title) ?></h2>
                <div class="d-flex flex-wrap">
                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i> " . __('Edit Location'), ['action' => 'add', $location->id], ['class' => 'btn btn-block btn-success btn-sm btn-flat mrg-r20', 'escape' => false]) ?>
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>
            <div class="panel-body">
<table class="table table-hover table-bordered">
                <tr>
                    <th width="20%"><?= __('Parent Location') ?></th>
                    <td><?php echo $this->cell('Locations.Location::getParents', [$location->id]); ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Title') ?></th>
                    <td><?= h($location->title) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Slug') ?></th>
                    <td><?= h($location->slug) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Latitude') ?></th>
                    <td><?= h($location->latitude) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Longitude') ?></th>
                    <td><?= h($location->longitude) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Iso Alpha2 Code') ?></th>
                    <td><?= h($location->iso_alpha2_code) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Iso Alpha3 Code') ?></th>
                    <td><?= h($location->iso_alpha3_code) ?></td>
                </tr>
               
                <tr>
                    <th><?= __('Created') ?></th>
                    <td>
                        <?php if ($location->created) {
                                echo $location->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td>
                        <?php if ($location->modified) {
                                echo $location->modified->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $location->status ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Formatted Address') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($location->formatted_address)); ?>
                </blockquote>
            </div>

        </div>
    </div>
</div>

