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
            <?= __('Manage Email Template') ?>
        </h1>
        <small>
            <?php echo __('Here you can '.empty($emailTemplate->id) ? __('add new email template') : __('edit email template')); ?>
    </small>
</div>
<?php $this->end(); ?>
<div class="row" data-table="emailHooks">
    <div class="col-7 col-sm-12 col-md-7">
    <div class="d-block">
        <div class="panel-default emailHooks">
            <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2 class="box-title"><?= __(empty($emailTemplate->id) ? 'Add Email Hook' : 'Edit Email Hook') ?></h2>
                <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'), 'escape' => false]); ?>
                </div><!-- /.box-header -->
            <?= $this->Form->create($emailTemplate, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
            <div class="panel-body">
            <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php echo $this->Form->control('email_hook_id', ['options' => $emailHooks, 'class' => 'form-control']); ?>
                            </div>
                            <div class="form-group">
                                <?php echo $this->Form->control('template_type', ['options' => [1 => 'Email Template', 2 => 'SMS Template'], 'default' => 1,'class' => 'form-control']); ?>
                            </div>
                            <div class="form-group">
                            <?php echo $this->Form->control('subject', ['class' => 'form-control', 'placeholder' => __('Subject')]); ?>
                                </div>
                            <div class="form-group">
                           <?php echo $this->Form->control('description', ['class' => 'form-control ckeditor', 'placeholder' => __('Description')]); ?>
                                </div>
                            <div class="form-group">
                            <?php echo $this->Form->control('footer_text', ['class' => 'form-control', 'placeholder' => __('Footer Text')]); ?>
                                </div>
                            <div class="form-group">
                            <?php echo $this->Form->control('email_preference_id', ['options' => $emailPreferences, 'class' => 'form-control']); ?>
                            </div>
                            <div class="form-group">
                            <?php echo $this->Form->control('status', ['options' => [1 => "Active", 0 => "Inactive"], 'class' => 'form-control']);
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
                <h2 class="box-title"><i class="fa fa-anchor"></i> Last updated email hooks</h2>
            </div>
            <!-- /.box-header -->
            <div class="panel-body">
                            <?php if (!empty($templates->toArray())) { ?>
                                <div class="timeline">
                                <?php
                                $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                foreach ($templates as $template):
                                    ?>
                                    <!-- timeline time label -->
                                    <div class="time-label">
                                        <span class="bg-red"><?php echo $template->created->format('d M, Y'); ?></span>
                                    </div>
                                    <!-- /.timeline-label -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fa fa-anchor bg-blue"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="fa fa-clock-o"></i> <?php echo $template->created->format('H:i A'); ?></span>

                                            <h3 class="timeline-header"><?= $this->Html->link($template->email_hook->title . " (" . $template->email_hook->slug . ")", ['controller' => 'EmailHooks', 'action' => 'view', $template->email_hook->id]) ?></h3>
                                            <div class="timeline-body">
                                                <h3 style="margin-top: 0px;"> <small>
                                                <?= $template->has('email_preference') ? $this->Html->link($template->email_preference->title, ['controller' => 'EmailPreferences', 'action' => 'view', $template->email_preference->id]) : '' ?>
                                                    </small>
                                                </h3>
                                                <?php echo $template->subject; ?>
                                            </div>
                                            <div class="timeline-footer form-inline">

                                            <?php if($this->request->getAttribute('identity')->can('view', $template)){
                                                    echo $this->Html->link('<i class="fa fa-eye" data-toggle="tooltip" data-placement="left" data-title="View" data-original-title="" title=""></i>', ['action' => 'view', $template->id], ['class' => 'btn btn-block btn-warning btn-xs btn-flat mrg-r10', 'escape' => false]);
                                                }
                                                if($this->request->getAttribute('identity')->can('update', $template)){
                                                    echo $this->Html->link('<i class="fa fa-edit" data-toggle="tooltip" data-placement="right" data-title="Edit" data-original-title="Edit" title=""></i>', ['action' => 'add', $template->id], ['class' => 'btn btn-block btn-success btn-xs btn-flat mrg-r10', 'escape' => false]);
                                                }
                                                if($this->request->getAttribute('identity')->can('delete', $template)){
                                                    echo $this->Html->link('<i class="fa fa-trash" data-toggle="tooltip" data-placement="right" data-title="Delete Hook" data-original-title="Edit" title=""></i>', ['action' => 'delete', $template->id], ['class' => 'confirmDeleteBtn btn btn-block btn-danger btn-xs btn-flat', 'escape' => false]);
                                                }
                                                ?>
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
        <!-- /.box -->
    </div>
    </div>
</div>
