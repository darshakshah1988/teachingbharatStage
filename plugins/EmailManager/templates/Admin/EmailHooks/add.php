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
            <?= __('Manage Email Hook/Slug') ?>
        </h1>
        <small><?php echo __('Here you can '.empty($emailHook->id) ? __('add new email hook') : __('edit email hook')); ?></small>
</div>
<?php $this->end(); ?>
<div class="row" data-table="emailHooks">
    <div class="col-7 col-sm-12 col-md-7">
    <div class="d-block">
        <div class="panel-default emailHooks">
            <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2 class="box-title"><?= __(empty($emailHook->id) ? 'Add Email Hook' : 'Edit Email Hook') ?></h2>
                <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Back'), ['action' => 'index'], ['class' => 'btn btn-default pull-right', 'title' => __('Cancel'), 'escape' => false]); ?>
                </div><!-- /.box-header -->
            <?= $this->Form->create($emailHook, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
            <div class="panel-body">
                        <div class="form-group">
                            <?php echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => __('Title')]); ?>
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->control('slug', ['class' => 'form-control', 'required' => false, 'placeholder' => __('Hook'), 'label' => ['text' => 'Hook']]); ?>
                            <p class="help-block">No space, separate each word with underscore. (if you want auto generated then please leave blank)</p>
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->control('description', ['class' => 'form-control', 'placeholder' => __('Description')]); ?>
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->control('status', ['options' => [1 => "Active", 0 => "Inactive"], 'empty' => false,'class' => 'form-control']); ?>
                        </div>
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
                <h2 class="box-title"><i class="fa fa-anchor"></i> Last updated email hooks</h2>
            </div>
            <!-- /.box-header -->
            <div class="panel-body">
            <div class="timeline">
            <?php if (!empty($hooks->toArray())) { ?>
                <?php
                    $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                    foreach ($hooks as $hook):
                        ?>
                    <!-- timeline time label -->
                    <div class="time-label">
                        <span class="bg-red"><?php echo $hook->created->format('d M, Y'); ?></span>
                    </div>
                    <!-- /.timeline-label -->
                    <!-- timeline item -->
                    <div>
                    <i class="fas fa-anchor bg-blue"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i> <?php echo $hook->created->format('H:i A'); ?></span>
                        <h3 class="timeline-header"><?php echo $this->Html->link($hook->title, ['controller' => 'EmailHooks', 'action' => 'view', $hook->id]); ?> (<?php echo $hook->slug; ?>)</h3>
                        <div class="clearfix"></div>

                        <div class="timeline-body">
                        <?php echo $hook->description;
                        ?>
                        </div>
                        <div class="timeline-footer">
                        <?php if($this->request->getAttribute('identity')->can('view', $hook)){
                            echo $this->Html->link('<i class="fa fa-eye" data-toggle="tooltip" data-placement="left" data-title="View" data-original-title="" title=""></i>', ['controller' => 'EmailHooks', 'action' => 'view', $hook->id], ['class' => 'btn btn-block btn-warning btn-xs btn-flat mrg-r10', 'escape' => false]);
                        }
                        if($this->request->getAttribute('identity')->can('update', $hook)){
                             echo $this->Html->link('<i class="fa fa-edit" data-toggle="tooltip" data-placement="right" data-title="Edit" data-original-title="Edit" title=""></i>', ['controller' => 'EmailHooks', 'action' => 'add', $hook->id], ['class' => 'btn btn-block btn-success btn-xs btn-flat mrg-r10', 'escape' => false]);
                         }
                         if($this->request->getAttribute('identity')->can('delete', $hook)){
                            echo $this->Html->link('<i class="fa fa-trash" data-toggle="tooltip" data-placement="right" data-title="Delete Hook" data-original-title="Edit" title=""></i>', ['controller' => 'EmailHooks', 'action' => 'delete', $hook->id], ['class' => 'confirmDeleteBtn btn btn-block btn-danger btn-xs btn-flat', 'escape' => false]);
                        }
                          ?>
                        </div>
                    </div>
                    </div>
                    <?php
                        $i++;
                        endforeach;
                    ?>
                    <!-- END timeline item -->
                    <div>
                        <i class="fas fa-clock bg-gray"></i>
                    </div>
                    <?php
                    } else {
                        echo "<div style='align:center;'>  <strong>Record Not Available</strong> </div>";
                    }
                    ?>
                </div>
            </div>

        </div>
        <!-- /.box -->
    </div>
    </div>
</div>
