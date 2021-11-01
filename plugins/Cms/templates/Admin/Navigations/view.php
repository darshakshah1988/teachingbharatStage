<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $navigation
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Navigation') ?>  
        </h1>
        <small><?php echo __('Here you can view navigation Detail'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row navigations view content">
<div class="col-12 col-sm-12 col-md-12">
    <div class="panel-default">
        <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= h($navigation->title) ?></h2>
                <div class="d-flex flex-wrap">
                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i> " . __('Edit Navigation'), ['action' => 'add', $navigation->id], ['class' => 'btn btn-block btn-success btn-sm btn-flat mrg-r20', 'escape' => false]) ?>
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>
            <div class="panel-body">
<table class="table table-hover table-bordered">
                <tr>
                    <th width="20%"><?= __('Title') ?></th>
                    <td><?= h($navigation->title) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Slug') ?></th>
                    <td><?= h($navigation->slug) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Menu Link') ?></th>
                    <td><?= h($navigation->menu_link) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Target') ?></th>
                    <td><?= h($navigation->target) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($navigation->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Listing Id') ?></th>
                    <td><?= $this->Number->format($navigation->listing_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Parent Id') ?></th>
                    <td><?= $this->Number->format($navigation->parent_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Nav Type') ?></th>
                    <td><?= $this->Number->format($navigation->is_nav_type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lft') ?></th>
                    <td><?= $this->Number->format($navigation->lft) ?></td>
                </tr>
                <tr>
                    <th><?= __('Rght') ?></th>
                    <td><?= $this->Number->format($navigation->rght) ?></td>
                </tr>
                <tr>
                    <th><?= __('Position') ?></th>
                    <td><?= $this->Number->format($navigation->position) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td>
                        <?php if ($navigation->created) {
                                echo $navigation->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td>
                        <?php if ($navigation->modified) {
                                echo $navigation->modified->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $navigation->status ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Top') ?></th>
                    <td><?= $navigation->is_top ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Bottom') ?></th>
                    <td><?= $navigation->is_bottom ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>

        </div>
    </div>
</div>



