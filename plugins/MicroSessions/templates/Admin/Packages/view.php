<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $package
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Package') ?>  
        </h1>
        <small><?php echo __('Here you can view package Detail'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row packages view content">
<div class="col-12 col-sm-12 col-md-12">
    <div class="panel-default">
        <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= h($package->id) ?></h2>
                <div class="d-flex flex-wrap">
                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i> " . __('Edit Package'), ['action' => 'add', $package->id], ['class' => 'btn btn-block btn-success btn-sm btn-flat mrg-r20', 'escape' => false]) ?>
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>
            <div class="panel-body">
<table class="table table-hover table-bordered">
                <tr>
                    <th width="20%"><?= __('Slug') ?></th>
                    <td><?= h($package->slug) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('User Id') ?></th>
                    <td><?= h($package->user_id) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Package Name') ?></th>
                    <td><?= h($package->package_name) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Package Title') ?></th>
                    <td><?= h($package->package_title) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Short Description') ?></th>
                    <td><?= h($package->short_description) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Description') ?></th>
                    <td><?= h($package->description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($package->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Package Id') ?></th>
                    <td><?= $this->Number->format($package->package_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Listing Id') ?></th>
                    <td><?= $this->Number->format($package->listing_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Grading Type Id') ?></th>
                    <td><?= $this->Number->format($package->grading_type_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Board Id') ?></th>
                    <td><?= $this->Number->format($package->board_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Subject Id') ?></th>
                    <td><?= $this->Number->format($package->subject_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Start Date') ?></th>
                    <td>
                        <?php if ($package->start_date) {
                                echo $package->start_date->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('End Date') ?></th>
                    <td>
                        <?php if ($package->end_date) {
                                echo $package->end_date->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td>
                        <?php if ($package->created) {
                                echo $package->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td>
                        <?php if ($package->modified) {
                                echo $package->modified->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $package->status ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>

        </div>
    </div>
</div>



