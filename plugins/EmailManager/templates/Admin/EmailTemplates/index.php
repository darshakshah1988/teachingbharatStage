<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $emailTemplates
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
        <small><?php echo __('Here you can manage the email templates'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row emailTemplates">
    <div class="col-md-7">
    <div class="d-block">
        <div class="panel-default">
                    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                        <h2><span class="caption-subject font-green bold uppercase">List <?php echo __('Email Templates'); ?></span></h2>
                        <div class="box-tools">
                        <?php if($this->request->getAttribute('identity')->can('create', $canEmailTemplates)){ ?>
                                <div class="d-flex flex-wrap">
                                    <?= $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('New Email Template'), ["action" => "add"], ["class" => "btn btn-success btn-flat", "escape" => false]) ?>
                                </div>
                        <?php } ?>
                        </div>
                    </div><!-- /.box-header -->
                        <div class="panel-body table-responsive">
                            <?php if (!empty($emailTemplates->toArray())) { ?>
                                <div class="timeline">
                                <?php
                                $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                foreach ($emailTemplates as $emailTemplate):
                                    ?>
                                    <!-- timeline time label -->
                                    <div class="time-label">
                                        <span class="bg-red"><?php echo $emailTemplate->created->format('d M, Y'); ?></span>
                                    </div>
                                    <!-- /.timeline-label -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fa fa-anchor bg-blue"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="fa fa-clock-o"></i> <?php echo $emailTemplate->created->format('H:i A'); ?></span>

                                            <h3 class="timeline-header" style="<?php echo $emailTemplate->status == 0 ? "text-decoration: line-through;" : ""; ?>"><?= $this->Html->link($emailTemplate->email_hook->title . " (" . $emailTemplate->email_hook->slug . ")", ['controller' => 'EmailHooks', 'action' => 'view', $emailTemplate->email_hook->id]) ?></h3>
                                            <div class="timeline-body">
                                                <h3 style="margin-top: 0px;"> <small>
                                                <?= $emailTemplate->has('email_preference') ? $this->Html->link($emailTemplate->email_preference->title, ['controller' => 'EmailPreferences', 'action' => 'view', $emailTemplate->email_preference->id]) : '' ?>
                                                    </small>
                                                </h3>
                                                <?php echo $emailTemplate->subject; ?>
                                            </div>
                                            <div class="timeline-footer form-inline">

                                            <?php if($this->request->getAttribute('identity')->can('view', $emailTemplate)){
                                                    echo $this->Html->link('<i class="fa fa-eye" data-toggle="tooltip" data-placement="left" data-title="View" data-original-title="" title=""></i>', ['action' => 'view', $emailTemplate->id], ['class' => 'btn btn-block btn-warning btn-xs btn-flat mrg-r10', 'escape' => false]);
                                                }
                                                if($this->request->getAttribute('identity')->can('update', $emailTemplate)){
                                                    echo $this->Html->link('<i class="fa fa-edit" data-toggle="tooltip" data-placement="right" data-title="Edit" data-original-title="Edit" title=""></i>', ['action' => 'add', $emailTemplate->id], ['class' => 'btn btn-block btn-success btn-xs btn-flat mrg-r10', 'escape' => false]);
                                                }
                                                if($this->request->getAttribute('identity')->can('delete', $emailTemplate)){
                                                    echo $this->Html->link('<i class="fa fa-trash" data-toggle="tooltip" data-placement="right" data-title="Delete Hook" data-original-title="Edit" title=""></i>', ['action' => 'delete', $emailTemplate->id], ['class' => 'confirmDeleteBtn btn btn-block btn-danger btn-xs btn-flat', 'escape' => false]);
                                                }
                                                ?>


                                                <?php //echo $this->Html->link('<i class="fa fa-eye" data-toggle="tooltip" data-placement="left" data-title="View" data-original-title="" title=""></i>', ['action' => 'view', $emailTemplate->id], ['class' => 'btn btn-default btn-xs', 'escape' => false]);

                                                ?>

                                            <?php //echo $this->Html->link('<i class="fa fa-pencil-square-o" data-toggle="tooltip" data-placement="right" data-title="Edit" data-original-title="Edit" title=""></i>', ['action' => 'add', $emailTemplate->id], ['class' => 'btn btn-primary btn-xs btn-flat', 'escape' => false]); ?>
                                            <?php //echo $this->Form->postLink("<i class=\"fa fa-trash\"></i>", ['action' => 'delete', $emailTemplate->id], ['onClick' => 'confirmDelete(this, \'' . $emailTemplate->email_hook->title . '\')', 'class' => 'btn btn-danger btn-xs btn-flat', 'data-toggle' => 'tooltip', 'escape' => false, 'alt' => __('Delete Email Templates'), 'title' => __('Delete Email Templates')]) ?>

                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $i++;
                                endforeach;
                                ?>
                                <div>
                                    <i class="fas fa-clock bg-gray"></i>
                                </div>
                            </div>
                            <?php
                            } else {
                                    echo "<div style='align:center;'>  <strong>Record Not Available</strong> </div>";
                            }
                        ?>
                    </div>
        </div>
    </div>
    </div>
    <div class="col-md-5">
        <div class="d-block">
            <div class="panel-default">
                <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                    <h2>
                        <i class="fa fa-exclamation"></i> Important Rules
                    </h2>
                </div><!-- /.box-header -->
                <div class="panel-body">
                    <p>For each email hook that would be added to the sytem, make sure to follow these rules:</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            Use <small class="bg-light-yellow label-xs white-color rounded">##SYSTEM_APPLICATION_NAME##</small>
                            on the subject or message to print application name defined by admin settings.
                        </li>
                        <li class="list-group-item">
                            Use <small class="bg-light-yellow label-xs white-color rounded">##USER_EMAIL##</small>
                            on the subject or message to print user email.
                        </li>
                        <li class="list-group-item">
                            Use <small class="bg-light-yellow label-xs white-color rounded">##USER_NAME##</small>
                            on the subject or message to print user name.
                        </li>
                        <li class="list-group-item">
                            Use <small class="bg-light-yellow label-xs white-color rounded">##first_name##</small>
                            on the subject or message to print first name.
                        </li>
                        <li class="list-group-item">
                            Use <small class="bg-light-yellow label-xs white-color rounded">##last_name##</small>
                            on the subject or message to print last name.
                        </li>
                        <li class="list-group-item">Make sure the message contain <small class="bg-light-yellow label-xs white-color rounded">##MESSAGE##</small>.</li>
                    </ul>
                </div>
            </div>

            <div class="panel-default">
                <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                    <h2><i class="fa fa-anchor"></i> Quick Start</h2>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                    <?= $this->Form->create($canEmailTemplates, ['url' => ['action' => 'add'], 'id' => 'quickStartForm', 'enctype' => 'multipart/form-data', 'templates' => 'default_form']) ?>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger print-error-msg" style="display:none">
                                <ul></ul>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php echo $this->Form->control('email_hook_id', ['options' => $emailHooks, 'class' => 'form-control','templates' => [
                            'select' => '<select name="{{name}}"{{attrs}}>{{content}}</select><span class="invalid-feedback" role="alert"></span>',
                        ]]); ?>
                            </div>
                            <div class="form-group">
                                <?php echo $this->Form->control('subject', ['class' => 'form-control', 'placeholder' => __('Subject'),'templates' => [
                            'input' => '<input type="{{type}}" name="{{name}}"{{attrs}}/><span class="invalid-feedback" role="alert"></span>',
                        ]]); ?>
                            </div>
                            <div class="form-group">
                                <?php echo $this->Form->control('description', ['type' => 'textarea', 'rows' => 6, 'class' => 'form-control', 'placeholder' => __('Description'),'templates' => [
                            'textarea' => '<textarea name="{{name}}"{{attrs}}>{{value}}</textarea><span class="invalid-feedback" role="alert"></span>',
                ]]); ?>
                            </div>
                            <div class="form-group">
                                <?php echo $this->Form->control('footer_text', ['type' => 'textarea', 'rows' => 3, 'class' => 'form-control', 'placeholder' => __('Footer Text'),'templates' => [
                            'textarea' => '<textarea name="{{name}}"{{attrs}}>{{value}}</textarea><span class="invalid-feedback" role="alert"></span>',
                ]]); ?>
                            </div>
                            <div class="form-group">
                                <?php echo $this->Form->control('email_preference_id', ['options' => $emailPreferences, 'class' => 'form-control']); ?>
                                                            </div>
                                                            <div class="form-group">
                                <?php echo $this->Form->control('status', ['options' => [1 => "Active", 0 => "Inactive"], 'class' => 'form-control']);
                                ?>
                            </div>
                        </div>
                    </div> <!-- /.row -->
                </div><!-- /.box-body -->
                <div class="panel-footer">
                    <?php echo $this->Form->button("<span class='ladda-label'><i class='fa fa-fw fa-save'></i> " . __('Submit') . '</span>', ['class' => 'btn btn-primary l-button', 'data-size' => 'xs', 'title' => __('Submit'), 'escapeTitle' => false]); ?>
                </div>
                    <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
