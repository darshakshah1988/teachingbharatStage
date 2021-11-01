<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $emailHooks
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
        <small><?php echo __('Here you can manage the email hooks'); ?></small>
</div>
<?php $this->end(); ?> 
<div class="row">
    <?php
        if($this->request->getAttribute('identity')->can('create' , $canEmailHook)){
            $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('New Email Hook'), ["action" => "add"], ["class" => "btn btn-block btn-primary btn-sm btn-flat", "escape" => false]);
        }
        ?>
    <div class="col-7 col-sm-12 col-md-7">
        <div class="panel-default">
        <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
            <h2>&nbsp;</h2>
            <?php if($this->request->getAttribute('identity')->can('create', $canEmailHook)){ ?>
            <div class="d-flex flex-wrap">
                <?= $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('New Email Hook'), ["action" => "add"], ["class" => "btn btn-block btn-primary btn-sm btn-flat", "escape" => false]) ?>
            </div>
            <?php } ?>
        </div>
        <div class="panel-body">
            <div class="timeline">
            <?php if (!empty($emailHooks->toArray())) { ?>
                <?php
                    $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                    foreach ($emailHooks as $hook):
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
                        <h3 class="timeline-header" style="<?php echo $hook->status == 0 ? "text-decoration: line-through;" : ""; ?>"><?php echo $this->Html->link($hook->title, ['controller' => 'EmailHooks', 'action' => 'view', $hook->id]); ?> (<?php echo $hook->slug; ?>)</h3>
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
    </div>

    <div class="col-md-5">
        <div class="d-block">
            <div class="panel-default">
                <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                    <h2 class="box-title"><i class="fa fa-anchor"></i> Quick Start</h2>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?= $this->Form->create($canEmailHook, ['url' => ['action' => 'add'], 'id' => 'quickStartForm', 'enctype' => 'multipart/form-data', 'templates' => 'default_form']) ?>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                        <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => __('Title')]); ?>
                            </div>
                            <div class="form-group">
                                <?php echo $this->Form->control('slug', ['class' => 'form-control', 'required' => false, 'placeholder' => __('Hook'), 'label' => ['text' => 'Hook'],'templates' => [
                            'input' => '<input type="{{type}}" name="{{name}}"{{attrs}}/><span class="invalid-feedback" role="alert"></span>',
                ]]); ?>
                                <p class="help-block">No space, separate each word with underscore. (if you want auto generated then please leave blank)</p>
                            </div>
                            <div class="form-group">
                                <?php echo $this->Form->control('description', ['class' => 'form-control', 'type' => 'textarea', 'placeholder' => __('Description')]); ?>
                            </div>
                            <div class="form-group">
                                <?php echo $this->Form->control('status', ['options' => [1 => "Active", 0 => "Inactive"],'empty' => false, 'class' => 'form-control']); ?>
                            </div>
                        </div>
                    </div> <!-- /.row -->
                </div><!-- /.box-body -->
                <div class="panel-footer">
                    <?php echo $this->Form->button("<span class='ladda-label'><i class='fa fa-fw fa-save'></i> " . __('Submit').'</span>', ['class' => 'btn btn-primary l-button btn-flat','data-size'=>'xs', 'title' => __('Submit'), 'escapeTitle' => false]); ?>
                </div>
                <?= $this->Form->end() ?>

            </div>
        </div>
        </div>
</div>

<script>
<?php $this->Html->scriptStart(['block' => true]); ?>

<?php $this->Html->scriptEnd(); ?>
</script>
