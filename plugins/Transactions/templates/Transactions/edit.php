<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $transaction
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Transaction') ?>
        </h1>
        <small><?php echo empty($transaction->id) ? __('Here you can add New transaction') : __('Here you can edit transaction'); ?></small>
</div>
<?php $this->end(); ?>

<div class="row transactions index content">
<div class="col-12 col-sm-12 col-md-12">
        <div class="panel-default">
            <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= __(empty($transaction->id) ? 'Add Transaction' : 'Edit Transaction') ?></h2>
                <div class="d-flex flex-wrap">
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>

            <?= $this->Form->create($transaction, ['role' => 'form', 'enctype' => 'multipart/form-data', 'templates' => 'horizontal_form']) ?>
            <div class="panel-body">

<?php
                    echo $this->Form->control('user_id', ['class' => 'form-control', 'placeholder' => __('User Id')]);
                    echo $this->Form->control('transaction_type', ['class' => 'form-control', 'placeholder' => __('Transaction Type')]);
                    echo $this->Form->control('transaction_status', ['class' => 'form-control', 'placeholder' => __('Transaction Status')]);
                    echo $this->Form->control('amount', ['class' => 'form-control', 'placeholder' => __('Amount')]);
                    echo $this->Form->control('transactionId', ['class' => 'form-control', 'placeholder' => __('Transaction Id')]);
                    echo $this->Form->control('transaction_responce', ['class' => 'form-control', 'placeholder' => __('Transaction Responce')]);
                    echo $this->Form->control('note', ['class' => 'form-control', 'placeholder' => __('Note')]);
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