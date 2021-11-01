<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $setting
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Setting') ?>  
        </h1>
        <small><?php echo empty($setting->id) ? __('Here you can add New setting') : __('Here you can edit setting'); ?></small> 
</div>
<?php $this->end(); ?>

<div class="row settings index content">
<div class="col-12 col-sm-12 col-md-12">
        <div class="panel-default">
            <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= __(empty($setting->id) ? 'Add Setting' : 'Edit Setting') ?></h2>
                <div class="d-flex flex-wrap">
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>
            <?php
            $this->loadHelper('Form', [
                'templates' => 'default_form',
            ]);
            ?>
            <?= $this->Form->create($setting, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
            <div class="panel-body">
                
<?php
                    echo $this->Form->control('listing_id', ['class' => 'form-control', 'placeholder' => __('Listing Id')]);
                    echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => __('Title')]);
                    echo $this->Form->control('slug', ['class' => 'form-control', 'placeholder' => __('Slug')]);
                    echo $this->Form->control('config_value', ['class' => 'form-control', 'placeholder' => __('Config Value')]);
                    echo $this->Form->control('manager', ['class' => 'form-control', 'placeholder' => __('Manager')]);
                    echo $this->Form->control('field_type', ['class' => 'form-control', 'placeholder' => __('Field Type')]);
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