<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $media
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Media') ?>  
        </h1>
        <small><?php echo __('Here you can view media Detail'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row medias view content">
<div class="col-12 col-sm-12 col-md-12">
    <div class="panel-default">
        <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= h($media->title) ?></h2>
                <div class="d-flex flex-wrap">
                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i> " . __('Edit Media'), ['action' => 'add', $media->id, '?' => $this->request->getQuery()], ['class' => 'btn btn-block btn-success btn-sm btn-flat mrg-r20', 'escape' => false]) ?>
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index', '?' => $this->request->getQuery()], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>
            <div class="panel-body">
<table class="table table-hover table-bordered">
                <tr>
                    <th width="20%"><?= __('Media Type') ?></th>
                    <td><?= h($media->media_type) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Title') ?></th>
                    <td><?= h($media->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($media->id) ?></td>
                </tr>
               
                <tr>
                    <th><?= __('Created') ?></th>
                    <td>
                        <?php if ($media->created) {
                                echo $media->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td>
                        <?php if ($media->modified) {
                                echo $media->modified->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $media->status ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>

        </div>
    </div>
</div>



