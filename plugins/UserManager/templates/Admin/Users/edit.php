<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $user
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage User') ?>
        </h1>
        <small><?php echo empty($user->id) ? __('Here you can add New user') : __('Here you can edit user'); ?></small>
</div>
<?php $this->end(); ?>

<div class="row users index content">
<div class="col-12 col-sm-12 col-md-12">
        <div class="panel-default">
            <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= __(empty($user->id) ? 'Add User' : 'Edit User') ?></h2>
                <div class="d-flex flex-wrap">
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>

            <?= $this->Form->create($user, ['role' => 'form', 'enctype' => 'multipart/form-data', 'templates' => 'horizontal_form']) ?>
            <div class="panel-body">

<?php
                    echo $this->Form->control('username', ['class' => 'form-control', 'placeholder' => __('Username')]);
                    echo $this->Form->control('email', ['class' => 'form-control', 'placeholder' => __('Email')]);
                    echo $this->Form->control('password', ['class' => 'form-control', 'placeholder' => __('Password')]);
                    echo $this->Form->control('first_name', ['class' => 'form-control', 'placeholder' => __('First Name')]);
                    echo $this->Form->control('last_name', ['class' => 'form-control', 'placeholder' => __('Last Name')]);
                    echo $this->Form->control('token', ['class' => 'form-control', 'placeholder' => __('Token')]);
                    echo $this->Form->control('token_expires', ['empty' => true, 'class' => 'form-control datepicker', 'placeholder' => __('Token Expires')]);
                    echo $this->Form->control('api_token', ['class' => 'form-control', 'placeholder' => __('Api Token')]);
                    echo $this->Form->control('activation_date', ['empty' => true, 'class' => 'form-control datepicker', 'placeholder' => __('Activation Date')]);
                    echo $this->Form->control('secret', ['class' => 'form-control', 'placeholder' => __('Secret')]);
                    echo $this->Form->control('secret_verified', ['class' => 'form-control', 'placeholder' => __('Secret Verified')]);
                    echo $this->Form->control('tos_date', ['empty' => true, 'class' => 'form-control datepicker', 'placeholder' => __('Tos Date')]);
                    echo $this->Form->control('active', ['class' => 'form-control', 'placeholder' => __('Active')]);
                    echo $this->Form->control('is_superuser', ['class' => 'form-control', 'placeholder' => __('Is Superuser')]);
                    echo $this->Form->control('role', ['class' => 'form-control', 'placeholder' => __('Role')]);
                    echo $this->Form->control('additional_data', ['class' => 'form-control', 'placeholder' => __('Additional Data')]);
                    echo $this->Form->control('listing_id', ['class' => 'form-control', 'placeholder' => __('Listing Id')]);
                    echo $this->Form->control('grading_types._ids', ['options' => $gradingTypes, 'class' => 'form-control multi']);
                    echo $this->Form->control('teacher_schedules._ids', ['options' => $teacherSchedules, 'class' => 'form-control multi']);
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