<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $enquiryStatus
 */
$this->layout = "ajax";
?>
<div class="row enquiryStatuses index content">
<div class="col-12 col-sm-12 col-md-12">
            <?= $this->Form->create($enquiry, ['role' => 'form','context' => ['validator' => 'todo'], 'enctype' => 'multipart/form-data', 'templates' => 'horizontal_form']) ?>
                <?php
                    echo $this->Form->control('priority_type_id', ['class' => 'form-control', 'empty' => 'Select']);
                    echo $this->Form->control('assigned_user_id', ['class' => 'form-control', 'empty' => 'Select', 'label' => 'Assigned To']);
                    echo $this->Form->control('remark', ['class' => 'form-control ckeditor', 'placeholder' => 'Remark']);
                    echo $this->Form->control('end_date', ['class' => 'form-control datepicker', 'placeholder' => 'End Date']);
                    echo $this->Form->control('enquiry_status_id', ['class' => 'form-control', 'empty' => 'Select', 'label'=> 'Status']);
                ?>
            <?= $this->Form->end() ?>
    </div>
</div>
