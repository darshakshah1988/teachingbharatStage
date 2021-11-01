<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $emailHook
 */

?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Email Hook') ?>
        </h1>
        <small><?php echo __('Here you can view hook detail'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row listings view content">
    <div class="col-12 col-sm-12 col-md-12">
        <div class="panel-default">
            <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center"><h2 class="box-title"><?= h($emailHook->title) ?></h2>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
            </div>
            <div class="panel-body">
                <table class="table table-hover table-striped">
                    <tr>
                        <th width="20%" scope="row"><?= __('ID') ?></th>
                        <td>#<?= $this->Number->format($emailHook->id) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Title') ?></th>
                        <td><?= h($emailHook->title) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Hook') ?></th>
                        <td><?= h($emailHook->slug) ?></td>
                    </tr>

                    <tr>
                        <th scope="row"><?= __('Created') ?></th>
                        <td>
                        <?= $emailHook->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT')) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Modified') ?></th>
                        <td><?= $emailHook->modified->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT')) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Status') ?></th>
                        <td><?= $emailHook->status ? __('Active') : __('Inactive'); ?></td>
                    </tr>
                </table>
                <div class="row">
                    <div class="col-md-12">
                        <h4><?= __('Description') ?></h4>
                        <?= $this->Text->autoParagraph(h($emailHook->description)); ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
