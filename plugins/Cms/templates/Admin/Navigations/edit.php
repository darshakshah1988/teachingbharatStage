<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $navigation
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Navigation') ?>  
        </h1>
        <small><?php echo empty($navigation->id) ? __('Here you can add New navigation') : __('Here you can edit navigation'); ?></small> 
</div>
<?php $this->end(); ?>

<div class="row navigations index content">
<div class="col-12 col-sm-12 col-md-12">
        <div class="panel-default">
            <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= __(empty($navigation->id) ? 'Add Navigation' : 'Edit Navigation') ?></h2>
                <div class="d-flex flex-wrap">
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>
            <?php
            $this->loadHelper('Form', [
                'templates' => 'default_form',
            ]);
            ?>
            <?= $this->Form->create($navigation, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
            <div class="panel-body">
                
<?php
                    echo $this->Form->control('listing_id', ['class' => 'form-control', 'placeholder' => __('Listing Id')]);
                    echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => __('Title')]);
                    echo $this->Form->control('slug', ['class' => 'form-control', 'placeholder' => __('Slug')]);
                    echo $this->Form->control('parent_id', ['class' => 'form-control', 'placeholder' => __('Parent Id')]);
                    echo $this->Form->control('menu_link', ['class' => 'form-control', 'placeholder' => __('Menu Link')]);
                    echo $this->Form->control('is_nav_type', ['class' => 'form-control', 'placeholder' => __('Is Nav Type')]);
                    echo $this->Form->control('target', ['class' => 'form-control', 'placeholder' => __('Target')]);
                    echo $this->Form->control('lft', ['class' => 'form-control', 'placeholder' => __('Lft')]);
                    echo $this->Form->control('rght', ['class' => 'form-control', 'placeholder' => __('Rght')]);
                    echo $this->Form->control('status', ['class' => 'form-control', 'placeholder' => __('Status')]);
                    echo $this->Form->control('is_top', ['class' => 'form-control', 'placeholder' => __('Is Top')]);
                    echo $this->Form->control('is_bottom', ['class' => 'form-control', 'placeholder' => __('Is Bottom')]);
                    echo $this->Form->control('position', ['class' => 'form-control', 'placeholder' => __('Position')]);
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