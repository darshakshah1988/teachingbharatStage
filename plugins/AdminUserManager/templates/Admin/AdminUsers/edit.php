<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $adminUser
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Admin User') ?>  
        </h1>
        <small><?php echo empty($adminUser->id) ? __('Here you can add New admin user') : __('Here you can edit admin user'); ?></small> 
</div>
<?php $this->end(); ?>

<div class="row adminUsers index content">
<div class="col-12 col-sm-12 col-md-12">
        <div class="panel-default">
            <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= __(empty($adminUser->id) ? 'Add Admin User' : 'Edit Admin User') ?></h2>
                <div class="d-flex flex-wrap">
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>
            <?php
            $this->loadHelper('Form', [
                'templates' => 'default_form',
            ]);
            ?>
            <?= $this->Form->create($adminUser, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
            <div class="panel-body">
                
<?php
                    echo $this->Form->control('listing_id', ['class' => 'form-control', 'placeholder' => __('Listing Id')]);
                    echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => __('Title')]);
                    echo $this->Form->control('first_name', ['class' => 'form-control', 'placeholder' => __('First Name')]);
                    echo $this->Form->control('middle_name', ['class' => 'form-control', 'placeholder' => __('Middle Name')]);
                    echo $this->Form->control('last_name', ['class' => 'form-control', 'placeholder' => __('Last Name')]);
                    echo $this->Form->control('mobile', ['class' => 'form-control', 'placeholder' => __('Mobile')]);
                    echo $this->Form->control('dob', ['class' => 'form-control', 'placeholder' => __('Dob')]);
                    echo $this->Form->control('email', ['class' => 'form-control', 'placeholder' => __('Email')]);
                    echo $this->Form->control('profile_photo', ['class' => 'form-control', 'placeholder' => __('Profile Photo')]);
                    echo $this->Form->control('photo_dir', ['class' => 'form-control', 'placeholder' => __('Photo Dir')]);
                    echo $this->Form->control('photo_size', ['class' => 'form-control', 'placeholder' => __('Photo Size')]);
                    echo $this->Form->control('photo_type', ['class' => 'form-control', 'placeholder' => __('Photo Type')]);
                    echo $this->Form->control('password', ['class' => 'form-control', 'placeholder' => __('Password')]);
                    echo $this->Form->control('is_supper_admin', ['class' => 'form-control', 'placeholder' => __('Is Supper Admin')]);
                    echo $this->Form->control('status', ['class' => 'form-control', 'placeholder' => __('Status')]);
                    echo $this->Form->control('is_verified', ['class' => 'form-control', 'placeholder' => __('Is Verified')]);
                    echo $this->Form->control('login_count', ['class' => 'form-control', 'placeholder' => __('Login Count')]);
                    echo $this->Form->control('roles._ids', ['options' => $roles, 'class' => 'form-control multi']);
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