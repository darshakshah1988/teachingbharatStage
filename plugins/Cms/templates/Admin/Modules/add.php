<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $module
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Module') ?>
        </h1>
        <small><?php echo empty($module->id) ? __('Here you can add New module') : __('Here you can edit module'); ?></small>
</div>
<?php $this->end(); ?>

<div class="row modules index content">
<div class="col-12 col-sm-12 col-md-12">
        <div class="panel-default">
            <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= __(empty($module->id) ? 'Add Module' : 'Edit Module') ?></h2>
                <div class="d-flex flex-wrap">
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>

            <?= $this->Form->create($module, ['role' => 'form', 'enctype' => 'multipart/form-data', 'templates' => 'default_form']) ?>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                <?php
                    echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => __('Title')]);
                    echo $this->Form->control('plugin', ['class' => 'form-control', 'placeholder' => __('Plugin')]);
                    echo $this->Form->control('controller', ['class' => 'form-control', 'placeholder' => __('Controller')]);
                    echo $this->Form->control('action', ['class' => 'form-control', 'placeholder' => __('Action')]);
                    echo $this->Form->control('query_string', ['class' => 'form-control', 'placeholder' => __('Query String')]); ?>
                    </div>
                    <div class="col-md-6">
                    <?php
                   echo $this->Form->control('meta_title', ['class' => 'form-control', 'placeholder' => __('Meta Title')]);
                    echo $this->Form->control('meta_keyword', ['class' => 'form-control', 'placeholder' => __('Meta Keyword')]);
                    echo $this->Form->control('meta_description', ['class' => 'form-control', 'placeholder' => __('Meta Description')]);
                ?>
                <div class="form-group">
                        <?php echo $this->Form->control('banner', ['type' => 'file']); ?>
                       <?php
                       if (!empty($module->image_path) && !empty($module->banner) && file_exists("img/".$module->image_path . $module->banner)) { ?>
                        <div class="form-group">
                            <?php
                            echo $this->Html->image($module->image_path . $module->banner, ['class' => 'img-thumbnail', 'style' => 'max-height:100px']);
                            ?>
                            <?php
                            echo $this->Html->link("<i class=\"fa fa-trash\"></i> ", ['action' => 'deleteimg', $module->id], ['id'=>'confirmDeletePhoto', 'class' => 'btn btn-danger btn-sm', 'escape' => false,'style'=>'margin-left:10px;']);
                            ?>
                             </div>
                        <?php } ?>

                    </div><!-- /.form-group -->
            </div>
        </div>
            </div>
            <div class="panel-footer d-flex flex-wrap justify-content-between align-items-center">
                <?php echo $this->Form->button("<i class='fa fa-fw fa-save'></i> " . __('Submit'), ['class' => 'btn btn-primary btn-sm btn-flat my-button', 'title' => __('Submit'), 'escapeTitle' => false]); ?>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Cancel'), 'escape' => false]); ?>
            </div>
            <?= $this->Form->end() ?>

        </div>
    </div>
</div>
