<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $announcement
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Announcement') ?>
        </h1>
        <small><?php echo empty($announcement->id) ? __('Here you can add New announcement') : __('Here you can edit announcement'); ?></small>
</div>
<?php $this->end(); ?>

<div class="row announcements index content">
<div class="col-12 col-sm-12 col-md-12">
        <div class="panel-default">
            <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= __(empty($announcement->id) ? 'Add Announcement' : 'Edit Announcement') ?></h2>
                <div class="d-flex flex-wrap">
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>

            <?= $this->Form->create($announcement, ['role' => 'form', 'enctype' => 'multipart/form-data', 'templates' => 'horizontal_form']) ?>
            <div class="panel-body">

<?php
                    echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => __('Title')]);
                    echo $this->Form->control('description', ['class' => 'form-control ckeditor', 'placeholder' => __('Description')]);
                    
                    //echo $this->Form->control('banner', ['class' => 'form-control', 'placeholder' => __('Popup Banner')]);
                    echo $this->Form->control('status', ['options' => [1 => "Active", 0 => "Inactive"],'class' => 'form-control','empty' => false, 'placeholder' => __('Status')]);
                    echo $this->Form->control('is_popup', ['options' => [0 => "No", 1 => "Yes"],'class' => 'form-control', 'placeholder' => __('Is Popup'),'empty' => false]);
                ?>
                <div class="form-group">
                        <?php echo $this->Form->control('banner', ['type' => 'file']); ?>
                       <?php
                       if (!empty($announcement->image_path) && !empty($announcement->banner) && file_exists("img/".$announcement->image_path . $announcement->banner)) { ?>
                        <div class="form-group">
                            <?php
                            echo $this->Html->image($announcement->image_path . $announcement->banner, ['class' => 'img-thumbnail', 'style' => 'max-height:100px']);
                            ?>
                            <?php
                            //echo $this->Html->link("<i class=\"fa fa-trash\"></i> ", ['action' => 'deleteimg', $announcement->id], ['id'=>'confirmDeletePhoto', 'class' => 'btn btn-danger btn-sm', 'escape' => false,'style'=>'margin-left:10px;']);
                            ?>
                             </div>
                        <?php } ?>

                    </div><!-- /.form-group --> 
            </div>
            <div class="panel-footer d-flex flex-wrap justify-content-between align-items-center">
                <?php echo $this->Form->button("<i class='fa fa-fw fa-save'></i> " . __('Submit'), ['class' => 'btn btn-primary btn-sm btn-flat my-button', 'title' => __('Submit'), 'escapeTitle' => false]); ?>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Cancel'), 'escape' => false]); ?>
            </div>
            <?= $this->Form->end() ?>

        </div>
    </div>
</div>