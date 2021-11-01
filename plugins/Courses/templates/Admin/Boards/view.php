<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $board
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Board') ?>  
        </h1>
        <small><?php echo __('Here you can view board Detail'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row boards view content">
<div class="col-12 col-sm-12 col-md-12">
    <div class="panel-default">
        <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= h($board->title) ?></h2>
                <div class="d-flex flex-wrap">
                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i> " . __('Edit Board'), ['action' => 'add', $board->id], ['class' => 'btn btn-block btn-success btn-sm btn-flat mrg-r20', 'escape' => false]) ?>
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>
            <div class="panel-body">
<table class="table table-hover table-bordered">
               
                <tr>
                    <th width="20%"><?= __('Title') ?></th>
                    <td><?= h($board->title) ?></td>
                </tr>
               
                <tr>
                    <th><?= __('Created') ?></th>
                    <td>
                        <?php if ($board->created) {
                                echo $board->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td>
                        <?php if ($board->modified) {
                                echo $board->modified->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
            </table>

        </div>
    </div>
</div>



