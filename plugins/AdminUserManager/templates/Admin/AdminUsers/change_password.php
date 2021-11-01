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
            <?= __('Change Password') ?>  
        </h1>
      
</div>
<?php $this->end(); ?>

<div class="row adminUsers index content">
<div class="col-12 col-sm-12 col-md-12">
        <div class="panel-default">
            <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= __('Change Password') ?></h2>
                <div class="d-flex flex-wrap">
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>
            <?= $this->Form->create($adminUser, ['role' => 'form','type' => 'file', 'templates' => 'horizontal_form']) ?>
            <?php $pass = $this->request->getData('password') ? $this->request->getData('password') : ""; ?>
            <div class="panel-body">
                <?php
                    echo $this->Form->control('old_password', ['type' => 'password','class' => 'form-control', 'placeholder' => __('Your Current Password')]);
                    echo $this->Form->control('password', ['type' => 'password','class' => 'form-control', 'placeholder' => __('New Password'), 'value' => $pass]);
                    echo $this->Form->control('confirm_password', ['type' => 'password','class' => 'form-control', 'placeholder' => __('Confirm Password')]);
                ?>
            </div>
            <div class="panel-footer d-flex flex-wrap justify-content-between align-items-center">
                <?php echo $this->Form->button("<i class='fa fa-fw fa-save'></i> " . __('Change Password'), ['class' => 'btn btn-primary btn-sm btn-flat my-button', 'title' => __('Submit'), 'escapeTitle' => false]); ?>  
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Cancel'), 'escape' => false]); ?>
            </div>
            <?= $this->Form->end() ?>

        </div>
    </div>
</div>
