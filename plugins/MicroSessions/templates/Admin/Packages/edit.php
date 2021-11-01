<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $package
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Package') ?>
        </h1>
        <small><?php echo empty($package->id) ? __('Here you can add New package') : __('Here you can edit package'); ?></small>
</div>
<?php $this->end(); ?>

<div class="row packages index content">
<div class="col-12 col-sm-12 col-md-12">
        <div class="panel-default">
            <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= __(empty($package->id) ? 'Add Package' : 'Edit Package') ?></h2>
                <div class="d-flex flex-wrap">
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>

            <?= $this->Form->create($package, ['role' => 'form', 'enctype' => 'multipart/form-data', 'templates' => 'horizontal_form']) ?>
            <div class="panel-body">

<?php
                    echo $this->Form->control('package_id', ['class' => 'form-control', 'placeholder' => __('Package Id')]);
                    echo $this->Form->control('listing_id', ['class' => 'form-control', 'placeholder' => __('Listing Id')]);
                    echo $this->Form->control('slug', ['class' => 'form-control', 'placeholder' => __('Slug')]);
                    echo $this->Form->control('user_id', ['class' => 'form-control', 'placeholder' => __('User Id')]);
                    echo $this->Form->control('package_name', ['class' => 'form-control', 'placeholder' => __('Package Name')]);
                    echo $this->Form->control('package_title', ['class' => 'form-control', 'placeholder' => __('Package Title')]);
                    echo $this->Form->control('grading_type_id', ['class' => 'form-control', 'placeholder' => __('Grading Type Id')]);
                    echo $this->Form->control('board_id', ['class' => 'form-control', 'placeholder' => __('Board Id')]);
                    echo $this->Form->control('subject_id', ['class' => 'form-control', 'placeholder' => __('Subject Id')]);
                    echo $this->Form->control('short_description', ['class' => 'form-control', 'placeholder' => __('Short Description')]);
                    echo $this->Form->control('description', ['class' => 'form-control', 'placeholder' => __('Description')]);
                    echo $this->Form->control('start_date', ['class' => 'form-control', 'placeholder' => __('Start Date')]);
                    echo $this->Form->control('end_date', ['class' => 'form-control', 'placeholder' => __('End Date')]);
                    echo $this->Form->control('status', ['class' => 'form-control', 'placeholder' => __('Status')]);
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