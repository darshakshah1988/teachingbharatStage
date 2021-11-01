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
        <small><?php echo __('Here you can view transaction Detail'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row transactions view content">
<div class="col-12 col-sm-12 col-md-12">
    <div class="panel-default">
        <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= h($transaction->id) ?></h2>
                <div class="d-flex flex-wrap">
                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i> " . __('Edit Transaction'), ['action' => 'add', $transaction->id], ['class' => 'btn btn-block btn-success btn-sm btn-flat mrg-r20', 'escape' => false]) ?>
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>
            <div class="panel-body">
<table class="table table-hover table-bordered">
                <tr>
                    <th width="20%"><?= __('User Id') ?></th>
                    <td><?= h($transaction->user_id) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Transaction Type') ?></th>
                    <td><?= h($transaction->transaction_type) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Transaction Status') ?></th>
                    <td><?= h($transaction->transaction_status) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('TransactionId') ?></th>
                    <td><?= h($transaction->transactionId) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($transaction->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Amount') ?></th>
                    <td><?= $this->Number->format($transaction->amount) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td>
                        <?php if ($transaction->created) {
                                echo $transaction->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td>
                        <?php if ($transaction->modified) {
                                echo $transaction->modified->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Transaction Responce') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($transaction->transaction_responce)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Note') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($transaction->note)); ?>
                </blockquote>
            </div>

        </div>
    </div>
</div>



