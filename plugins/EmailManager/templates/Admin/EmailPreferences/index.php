<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $emailPreferences
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
        <small><?php echo __('Here you can manage the email preferences'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row emailPreferences">
    <div class="col-md-8">
        <div class="panel-default">
            <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2 class="box-title"><span class="caption-subject font-green bold uppercase">List <?php echo __('Email Preferences'); ?></span></h2>
                <?php if($this->request->getAttribute('identity')->can('create', $canEmailPreferences)){ ?>
                    <div class="d-flex flex-wrap">
                        <?= $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('New Email Preference'), ["action" => "add"], ["class" => "btn btn-block btn-primary btn-sm btn-flat", "escape" => false]) ?>
                    </div>
            <?php } ?>
            </div><!-- /.box-header -->
            <div class="panel-body table-responsive">
                <?php if (!empty($emailPreferences->toArray())) { ?>
                    <div class="timeline">
                        <?php
                        $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                        foreach ($emailPreferences as $emailPreference):
                            ?>
                            <!-- timeline time label -->
                            <div class="time-label">
                                <span class="bg-red"><?php echo $emailPreference->created->format('d M, Y'); ?></span>
                            </div>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <div>
                                <i class="fa fa-anchor bg-blue"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> <?php echo $emailPreference->created->format('H:i A'); ?></span>

                                    <h3 class="timeline-header"><?php echo $this->Html->link($emailPreference->title, ['controller' => 'EmailPreferences', 'action' => 'view', $emailPreference->id]); ?></h3>
                                    <div class="timeline-body">
                                        <?php echo $emailPreference->description; ?>
                                    </div>
                                    <div class="timeline-footer">
                                        <?php echo $this->Html->link('<i class="fa fa-eye" data-toggle="tooltip" data-placement="left" data-title="View" data-original-title="" title=""></i>', ['controller' => 'EmailPreferences', 'action' => 'view', $emailPreference->id], ['class' => 'btn btn-block btn-warning btn-xs btn-flat mrg-r10', 'escape' => false]);             ?>
                                        <?php echo $this->Html->link('<i class="fa fa-edit" data-toggle="tooltip" data-placement="right" data-title="Edit" data-original-title="Edit" title=""></i>', ['controller' => 'EmailPreferences', 'action' => 'add', $emailPreference->id], ['class' => 'btn btn-block btn-success btn-xs btn-flat mrg-r10', 'escape' => false]); ?>
                                        <?php /* ?> <?= $this->Form->postLink("<i class=\"fa fa-trash\"></i>", ['action' => 'delete', $emailPreference->id], ['onClick' => 'confirmDelete(this, \'' . $emailPreference->title . '\')', 'class' => 'btn btn-danger btn-xs', 'data-toggle' => 'tooltip', 'escape' => false, 'alt' => __('Delete Email Layout'), 'title' => __('Delete Email Layout')]) ?> <?php */ ?>
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
