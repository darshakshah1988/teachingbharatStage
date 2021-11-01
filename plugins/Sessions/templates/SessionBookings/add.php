<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $sessionBooking
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Session Booking') ?>
        </h1>
        <small><?php echo empty($sessionBooking->id) ? __('Here you can add New session booking') : __('Here you can edit session booking'); ?></small>
</div>
<?php $this->end(); ?>

<div class="row sessionBookings index content">
<div class="col-12 col-sm-12 col-md-12">
        <div class="panel-default">
            <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= __(empty($sessionBooking->id) ? 'Add Session Booking' : 'Edit Session Booking') ?></h2>
                <div class="d-flex flex-wrap">
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>

            <?= $this->Form->create($sessionBooking, ['role' => 'form', 'enctype' => 'multipart/form-data', 'templates' => 'horizontal_form']) ?>
            <div class="panel-body">

<?php
                    echo $this->Form->control('user_id', ['options' => $users, 'class' => 'form-control']);
                    echo $this->Form->control('teacher_id', ['options' => $teacher, 'class' => 'form-control']);
                    echo $this->Form->control('subject_id', ['options' => $subjects, 'class' => 'form-control']);
                    echo $this->Form->control('grading_type_id', ['options' => $gradingTypes, 'class' => 'form-control']);
                    echo $this->Form->control('board_id', ['options' => $boards, 'class' => 'form-control']);
                    echo $this->Form->control('booking_date', ['empty' => true, 'class' => 'form-control datepicker', 'placeholder' => __('Booking Date')]);
                    echo $this->Form->control('teacher_schedule_id', ['options' => $teacherSchedules, 'class' => 'form-control']);
                    echo $this->Form->control('razorpay_order', ['class' => 'form-control', 'placeholder' => __('Razorpay Order')]);
                    echo $this->Form->control('note', ['class' => 'form-control', 'placeholder' => __('Note')]);
                    echo $this->Form->control('payment_method', ['class' => 'form-control', 'placeholder' => __('Payment Method')]);
                    echo $this->Form->control('transaction_status', ['class' => 'form-control', 'placeholder' => __('Transaction Status')]);
                    echo $this->Form->control('transactionId', ['class' => 'form-control', 'placeholder' => __('Transaction Id')]);
                    echo $this->Form->control('signature', ['class' => 'form-control', 'placeholder' => __('Signature')]);
                    echo $this->Form->control('transaction_responce', ['class' => 'form-control', 'placeholder' => __('Transaction Responce')]);
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