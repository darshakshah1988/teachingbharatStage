<?php
/**
 * @var \App\View\AppView $this
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Email Preference') ?>
        </h1>
        <small><?php echo __('Here you can '.empty($emailPreference->id) ? __('add new email preference') : __('edit email preference')); ?></small>
</div>
<?php $this->end(); ?>
<div class="row">
    <div class="col-md-8">
        <div class="d-block">
            <div class="panel-default emailPreference">
                <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                    <h2 class="box-title"><?= __(empty($emailPreference->id) ? 'Add Email Preference' : 'Edit Email Preference') ?></h2>
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'), 'escape' => false]); ?>
                </div><!-- /.box-header -->
                <?= $this->Form->create($emailPreference, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => __('Title')]); ?>
                            </div>
                            <div class="form-group">
                                <?php echo $this->Form->control('layout_html', ['class' => 'form-control', 'rows' => 13, 'placeholder' => __('Layout Html')]);
                                ?>
                            </div>
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.box-body -->
                <div class="panel-footer">
                    <?php echo $this->Form->button("<i class='fa fa-fw fa-save'></i> " . __('Submit'), ['class' => 'btn btn-primary btn-flat', 'title' => __('Submit'), 'escapeTitle' => false]); ?>
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Back'), ['action' => 'index'], ['class' => 'btn btn-warning btn-flat', 'title' => __('Cancel'), 'escape' => false]); ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
        </div>

    <div class="col-md-4">
        <div class="d-block">
            <div class="panel-default emailPreference">
                <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                    <h2 class="box-title">
                        <i class="fa fa-exclamation"></i> Important Rules
                    </h2>

                </div><!-- /.box-header -->
                <div class="panel-body">
                    <p>
                        For each email style or email preference that would be added to the system, make sure it has these hooks:
                    </p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <small class="bg-light-yellow label-xs white-color rounded">
                                ##SYSTEM_LOGO##
                            </small> - Will be replaced by logo from the admin settings.
                        </li>
                        <li class="list-group-item">
                            <small class="bg-light-yellow label-xs white-color rounded">
                                ##SYSTEM_APPLICATION_NAME##
                            </small> - Will be replaced by application name from admin settings.
                        </li>
                        <li class="list-group-item">
                            <small class="bg-light-yellow label-xs white-color rounded">
                                ##EMAIL_CONTENT##
                            </small> - Will be replaced by email message from email hook settings.
                        </li>
                        <li class="list-group-item">
                            <small class="bg-light-yellow label-xs white-color rounded">
                                ##EMAIL_FOOTER##
                            </small> - Will be replaced by email footer from email hook settings.
                        </li>
                    </ul>
                </div><!-- ./box-body -->
            </div>
        </div>
    </div>
</div>
