<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $coupon
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Coupon') ?>
        </h1>
        <small><?php echo empty($coupon->id) ? __('Here you can add New coupon') : __('Here you can edit coupon'); ?></small>
</div>
<?php $this->end(); ?>

<div class="row coupons index content">
<div class="col-12 col-sm-12 col-md-12">
        <div class="panel-default">
            <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= __(empty($coupon->id) ? 'Add Coupon' : 'Edit Coupon') ?></h2>
                <div class="d-flex flex-wrap">
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>

            <?= $this->Form->create($coupon, ['role' => 'form', 'enctype' => 'multipart/form-data', 'templates' => 'horizontal_form']) ?>
            <div class="panel-body">

<?php
                    echo $this->Form->control('name', ['class' => 'form-control', 'placeholder' => __('Name')]);
                    echo $this->Form->control('code', ['class' => 'form-control', 'placeholder' => __('Code')]);
                    echo $this->Form->control('coupon_type', ['class' => 'form-control', 'placeholder' => __('Coupon Type')]);
                    echo $this->Form->control('discount', ['class' => 'form-control', 'placeholder' => __('Discount')]);
                    echo $this->Form->control('total', ['class' => 'form-control', 'placeholder' => __('Total')]);
                    echo $this->Form->control('date_start', ['empty' => true, 'class' => 'form-control datepicker', 'placeholder' => __('Date Start')]);
                    echo $this->Form->control('date_end', ['empty' => true, 'class' => 'form-control datepicker', 'placeholder' => __('Date End')]);
                    echo $this->Form->control('uses_total', ['class' => 'form-control', 'placeholder' => __('Uses Total')]);
                    echo $this->Form->control('uses_customer', ['class' => 'form-control', 'placeholder' => __('Uses Customer')]);
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