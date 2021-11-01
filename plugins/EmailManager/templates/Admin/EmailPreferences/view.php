<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $emailPreference
 */
use Cake\Core\Configure;
use Cake\Routing\Router;
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Email Preference') ?>
        </h1>
        <small><?php echo __('Here you can view email preference/layout detail'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row listings view content">
    <div class="col-12 col-sm-12 col-md-12">
    <div class="d-block">
        <div class="panel-default">
            <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center"><h2 class="box-title"><?= h($emailPreference->title) ?></h2>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'),'escape'=>false]); ?>
            </div>
            <div class="panel-body">
                <table class="table table-hover table-striped">
                    <tr>
                        <th width="20%" scope="row"><?= __('Id') ?></th>
                        <td>#<?= $this->Number->format($emailPreference->id) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Title') ?></th>
                        <td><?= h($emailPreference->title) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Created') ?></th>
                        <td><?= $emailPreference->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT')) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Modified') ?></th>
                        <td><?= $emailPreference->modified->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT')) ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?= __('Status') ?></th>
                        <td><?= $emailPreference->status ? __('Active') : __('Inactive'); ?></td>
                    </tr>
                </table>

            </div>
        </div>
    </div>
        <div class="d-block">
            <div class="panel-default">
                <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                    <h2>Layout Html</h2>
                </div>
                <div class="panel-body">
                    <?php 
                    $default_replacement = [
                            '##SYSTEM_APPLICATION_NAME##' => \Cake\Core\Configure::read('Setting.SYSTEM_APPLICATION_NAME') ?? env('APP_NAME'),
                            '##BASE_URL##' => Router::url('/', true),
                            '##SYSTEM_LOGO##' => $this->Url->image("uploads/" . Configure::read('LISTING_ID') ."/settings/".Configure::read('Setting.MAIN_LOGO'), ["alt" => "logo"]),
                            '##EMAIL_BANNER_IMAGE##' => $this->Url->image("uploads/" . Configure::read('LISTING_ID') ."/settings/".Configure::read('Setting.EMAIL_BANNER_IMAGE'), ["alt" => "logo"]),
                            '##COPYRIGHT_TEXT##' => "Copyright " . \Cake\Core\Configure::read('Setting.SYSTEM_APPLICATION_NAME') . " " . date("Y"),
                        ];
                        $message_body = strtr($emailPreference->layout_html, $default_replacement);
                    ?>
                    <div class="d-flex justify-content-center"><?= $message_body ?></div>
                </div>
            </div>
        </div>

        <?php if (!empty($emailPreference->email_templates)): ?>
        <div class="d-block">
            <div class="panel-default">
                <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                    <h2><?= __('Related Email Templates') ?></h2>
                </div>
                <div class="panel-body">
                <table class="table table-hover table-striped">
                        <tr>
                        <th scope="col"><?= __('Subject') ?></th>
                            <th scope="col"><?= __('Created') ?></th>
                            <th scope="col"><?= __('Modified') ?></th>
                            <th scope="col" class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($emailPreference->email_templates as $emailTemplates): ?>
                            <tr>
                                <td><?= h($emailTemplates->subject) ?></td>
                                <td><?= $emailTemplates->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT')) ?></td>
                                <td><?= $emailTemplates->modified->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT')) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['controller' => 'EmailTemplates', 'action' => 'view', $emailTemplates->id], ['class' => 'btn btn-warning btn-sm', 'escape' => false, 'data-toggle' => 'tooltip', 'alt' => __('View Detail'), 'title' => __('View Detail')]) ?>

                                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['controller' => 'EmailTemplates', 'action' => 'add', $emailTemplates->id], ['class' => 'btn btn-primary btn-sm', 'escape' => false, 'data-toggle' => 'tooltip', 'alt' => __('Edit'), 'title' => __('Edit Detail')]) ?>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
