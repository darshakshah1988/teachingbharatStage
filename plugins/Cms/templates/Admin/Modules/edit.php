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
            <?php
            $this->loadHelper('Form', [
                'templates' => 'default_form',
            ]);
            ?>
            <?= $this->Form->create($module, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
            <div class="panel-body">
                
<?php
                    echo $this->Form->control('listing_id', ['options' => $listings, 'class' => 'form-control']);
                    echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => __('Title')]);
                    echo $this->Form->control('plugin', ['class' => 'form-control', 'placeholder' => __('Plugin')]);
                    echo $this->Form->control('controller', ['class' => 'form-control', 'placeholder' => __('Controller')]);
                    echo $this->Form->control('action', ['class' => 'form-control', 'placeholder' => __('Action')]);
                    echo $this->Form->control('json_path', ['class' => 'form-control', 'placeholder' => __('Json Path')]);
                    echo $this->Form->control('query_string', ['class' => 'form-control', 'placeholder' => __('Query String')]);
                    echo $this->Form->control('banner', ['class' => 'form-control', 'placeholder' => __('Banner')]);
                    echo $this->Form->control('banner_dir', ['class' => 'form-control', 'placeholder' => __('Banner Dir')]);
                    echo $this->Form->control('banner_size', ['class' => 'form-control', 'placeholder' => __('Banner Size')]);
                    echo $this->Form->control('banner_type', ['class' => 'form-control', 'placeholder' => __('Banner Type')]);
                    echo $this->Form->control('meta_title', ['class' => 'form-control', 'placeholder' => __('Meta Title')]);
                    echo $this->Form->control('meta_keyword', ['class' => 'form-control', 'placeholder' => __('Meta Keyword')]);
                    echo $this->Form->control('meta_description', ['class' => 'form-control', 'placeholder' => __('Meta Description')]);
                ?>
            </div>
            <div class="panel-footer d-flex flex-wrap justify-content-between align-items-center">
                <?php echo $this->Form->button("<i class='fa fa-fw fa-save'></i> " . __('Submit'), ['class' => 'btn btn-primary btn-sm btn-flat my-button', 'title' => __('Submit'), 'escapeTitle' => false]); ?>  
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Cancel'), 'escape' => false]); ?>
            </div>
            <?= $this->Form->end() ?>

        </div>
    </div>
</div>