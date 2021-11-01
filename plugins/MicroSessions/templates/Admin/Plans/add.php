<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $plan
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Plan') ?>
        </h1>
        <small><?php echo empty($plan->id) ? __('Here you can add New plan') : __('Here you can edit plan'); ?></small>
</div>
<?php $this->end(); ?>

<div class="row plans index content">
<div class="col-12 col-sm-12 col-md-12">
        <div class="panel-default">
            <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= __(empty($plan->id) ? 'Add Plan' : 'Edit Plan') ?></h2>
                <div class="d-flex flex-wrap">
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>

            <?= $this->Form->create($plan, ['role' => 'form', 'enctype' => 'multipart/form-data', 'templates' => 'horizontal_form']) ?>
            <div class="panel-body">

<?php
                    echo $this->Form->control('plan_id', ['class' => 'form-control', 'placeholder' => __('Plan Id')]);
                    echo $this->Form->control('listing_id', ['class' => 'form-control', 'placeholder' => __('Listing Id')]);
                    echo $this->Form->control('slug', ['class' => 'form-control', 'placeholder' => __('Slug')]);
                    echo $this->Form->control('user_id', ['class' => 'form-control', 'placeholder' => __('User Id')]);
                    echo $this->Form->control('plan_name', ['class' => 'form-control', 'placeholder' => __('Plan Name')]);
                    echo $this->Form->control('duration', ['class' => 'form-control', 'placeholder' => __('Duration')]);
                    echo $this->Form->control('price', ['class' => 'form-control', 'placeholder' => __('Price')]);
                    echo $this->Form->control('discount_price', ['class' => 'form-control', 'placeholder' => __('Discount Price')]);
                    echo $this->Form->control('features', ['class' => 'form-control', 'placeholder' => __('Features')]);
                    echo $this->Form->control('other_details', ['class' => 'form-control', 'placeholder' => __('Other Details')]);
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