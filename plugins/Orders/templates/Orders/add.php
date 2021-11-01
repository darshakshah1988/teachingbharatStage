<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $order
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Order') ?>
        </h1>
        <small><?php echo empty($order->id) ? __('Here you can add New order') : __('Here you can edit order'); ?></small>
</div>
<?php $this->end(); ?>

<div class="row orders index content">
<div class="col-12 col-sm-12 col-md-12">
        <div class="panel-default">
            <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= __(empty($order->id) ? 'Add Order' : 'Edit Order') ?></h2>
                <div class="d-flex flex-wrap">
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>

            <?= $this->Form->create($order, ['role' => 'form', 'enctype' => 'multipart/form-data', 'templates' => 'horizontal_form']) ?>
            <div class="panel-body">

<?php
                    echo $this->Form->control('invoice_no', ['class' => 'form-control', 'placeholder' => __('Invoice No')]);
                    echo $this->Form->control('user_id', ['options' => $users, 'class' => 'form-control']);
                    echo $this->Form->control('amount', ['class' => 'form-control', 'placeholder' => __('Amount')]);
                    echo $this->Form->control('discount', ['class' => 'form-control', 'placeholder' => __('Discount')]);
                    echo $this->Form->control('total_amount', ['class' => 'form-control', 'placeholder' => __('Total Amount')]);
                    echo $this->Form->control('order_date', ['empty' => true, 'class' => 'form-control datepicker', 'placeholder' => __('Order Date')]);
                    echo $this->Form->control('razorpay_order', ['class' => 'form-control', 'placeholder' => __('Razorpay Order')]);
                    echo $this->Form->control('note', ['class' => 'form-control', 'placeholder' => __('Note')]);
                    echo $this->Form->control('invoice_file', ['class' => 'form-control', 'placeholder' => __('Invoice File')]);
                    echo $this->Form->control('phinxlog._ids', ['options' => $phinxlog, 'class' => 'form-control multi']);
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