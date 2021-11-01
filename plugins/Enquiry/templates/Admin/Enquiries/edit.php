<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $enquiry
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Enquiry') ?>  
        </h1>
        <small><?php echo empty($enquiry->id) ? __('Here you can add New enquiry') : __('Here you can edit enquiry'); ?></small> 
</div>
<?php $this->end(); ?>

<div class="row enquiries index content">
<div class="col-12 col-sm-12 col-md-12">
        <div class="panel-default">
            <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= __(empty($enquiry->id) ? 'Add Enquiry' : 'Edit Enquiry') ?></h2>
                <div class="d-flex flex-wrap">
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>
            <?php
            $this->loadHelper('Form', [
                'errorClass' => 'is-invalid',
                'templates' => 'default_form',
            ]);
            ?>
            <?= $this->Form->create($enquiry, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
            <div class="panel-body">
                
<?php
                    echo $this->Form->control('listing_id', ['options' => $listings, 'class' => 'form-control']);
                    echo $this->Form->control('admin_user_id', ['options' => $adminUsers, 'empty' => true, 'class' => 'form-control']);
                    echo $this->Form->control('enquiry_type', ['class' => 'form-control', 'placeholder' => __('Enquiry Type')]);
                    echo $this->Form->control('referred_by', ['class' => 'form-control', 'placeholder' => __('Referred By')]);
                    echo $this->Form->control('subject', ['class' => 'form-control', 'placeholder' => __('Subject')]);
                    echo $this->Form->control('full_name', ['class' => 'form-control', 'placeholder' => __('Full Name')]);
                    echo $this->Form->control('mobile', ['class' => 'form-control', 'placeholder' => __('Mobile')]);
                    echo $this->Form->control('email', ['class' => 'form-control', 'placeholder' => __('Email')]);
                    echo $this->Form->control('address', ['class' => 'form-control', 'placeholder' => __('Address')]);
                    echo $this->Form->control('description', ['class' => 'form-control', 'placeholder' => __('Description')]);
                    echo $this->Form->control('priority_type_id', ['options' => $priorityTypes, 'empty' => true, 'class' => 'form-control']);
                    echo $this->Form->control('enquiry_status_id', ['options' => $enquiryStatuses, 'empty' => true, 'class' => 'form-control']);
                    echo $this->Form->control('assigned_user_id', ['class' => 'form-control', 'placeholder' => __('Assigned User Id')]);
                    echo $this->Form->control('end_date', ['empty' => true, 'class' => 'form-control datepicker', 'placeholder' => __('End Date')]);
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