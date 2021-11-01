<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $emailTemplate
 */

?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Email Template') ?>
        </h1>
        <small><?php echo __('Here you can view email template detail'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row listings view content">
    <div class="col-12 col-sm-12 col-md-12">
        <div class="panel-default">
            <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center"><h2 class="box-title"><?= h($emailTemplate->subject) ?></h2>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
            </div>
            <div class="panel-body">
                    <table class="table table-hover table-striped">
                        <tr>
                            <th width="20%" scope="row"><?= __('Id') ?></th>
                            <td>#<?= $this->Number->format($emailTemplate->id) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Email Hook') ?></th>
                            <td><?= $emailTemplate->has('email_hook') ? $this->Html->link($emailTemplate->email_hook->title, ['controller' => 'EmailHooks', 'action' => 'view', $emailTemplate->email_hook->id]) : '' ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Subject') ?></th>
                            <td><?= h($emailTemplate->subject) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Email Preference') ?></th>
                            <td><?= $emailTemplate->has('email_preference') ? $this->Html->link($emailTemplate->email_preference->title, ['controller' => 'EmailPreferences', 'action' => 'view', $emailTemplate->email_preference->id]) : '' ?></td>
                        </tr>

                        <tr>
                            <th scope="row"><?= __('Created') ?></th>
                            <td><?= $emailTemplate->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT')) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Modified') ?></th>
                            <td><?= $emailTemplate->modified->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT')) ?></td>
                        </tr>
                        <tr>
                            <th scope="row"><?= __('Status') ?></th>
                            <td><?= $emailTemplate->status ? __('Yes') : __('No'); ?></td>
                        </tr>
                    </table>
            </div>
        </div>
    </div>
</div>

<div class="d-block">
    <div class="panel-default">
        <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
            <h2 class="panel-title">Description</h2>
        </div>
        <div class="panel-body">
            <div class="form-group">
            <?= $this->Text->autoParagraph($emailTemplate->description); ?>
            </div>
            <div class="form-group">
            <?= $this->Text->autoParagraph($emailTemplate->footer_text); ?>
            </div>
        </div>
    </div>
</div>

