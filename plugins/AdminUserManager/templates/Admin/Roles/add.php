<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $role
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Role') ?>  
        </h1>
        <small><?php echo empty($role->id) ? __('Here you can add New role') : __('Here you can edit role'); ?></small> 
</div>
<?php $this->end(); ?>

<div class="row roles index content">
<div class="col-12 col-sm-12 col-md-12">
        <div class="panel-default">
            <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= __(empty($role->id) ? 'Add Role' : 'Edit Role') ?></h2>
                <div class="d-flex flex-wrap">
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>
            <?php
            $this->loadHelper('Form', [
                'templates' => 'horizontal_form',
            ]);
            ?>
            <?= $this->Form->create($role, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
            <div class="panel-body">
                
            <?php
                    //echo $this->Form->control('listing_type_id', ['class' => 'form-control', 'empty' => __('Select Listing Type'), 'default' => 3]);
                    echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => __('Title')]);
                    echo $this->Form->control('sort_order', ['class' => 'form-control','min' => 0, 'placeholder' => __('Sort Order')]);
                    // echo $this->Form->control('admin_users._ids', ['options' => $adminUsers, 'class' => 'form-control multi']);
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