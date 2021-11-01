<?= $this->Form->create(null, ['url' => ['controller' => 'SessionBookings', 'action' => 'book', 'plugin' => 'Sessions', $user->id],'role' => 'form', 'enctype' => 'multipart/form-data', 'templates' => [
        'formGroup' => '{{label}}{{input}}{{error}}',
        'inputContainer' => '<div class="form-group"><div class="input {{type}}{{required}}">{{content}}</div></div>',
        // Container element used by control() when a field has an error.
        'inputContainerError' => '<div class="form-group"><div class="input {{type}}{{required}} error">{{content}}</div></div>',
        'label' => '<label class="control-label"{{attrs}}>{{text}}</label>',
    ], 'data-group-name' => 'digits', 'data-group-name' => 'digits', 'data-group-name' => 'digits']) ?>
<div class="col-md-12">
    <div class="form-group">
        <?= $this->Form->control('topic', ['class' => 'form-control', 'placeholder' => 'Session Topic']) ?>
    </div>
</div>
<!-- <div class="col-md-4">
    <div class="form-group">
        <?= $this->Form->control('subject_id', ['options' => $subjects, 'label' => false, 'class' => 'form-control', 'empty' => 'Select Subject']) ?>
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
        <?php
        //echo $this->Form->control('grading_type_id', ['options' => $gradingTypes, 'class' => 'form-control', 'empty' => 'Select Grade', 'label' => false]); ?>
    </div>
</div>
<div class="col-md-4">
    <div class="form-group">
        <?php 
            //echo $this->Form->control('board_id', ['options' => $boards, 'class' => 'form-control', 'empty' => 'Select Board', 'label' => false]);
         ?>
    </div>
</div> -->

<div class="col-md-6">
    <div class="form-group">
        <?= $this->Form->control('start_date', ['type' => 'text','class' => 'MyInput', 'id' => 'start_date', 'placeholder' => __('Session Start Date'), 'label' => 'Session Start Date *']) ?>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <?= $this->Form->control('end_date', ['type' => 'text','class' => 'MyInput', 'id' => 'end_date', 'placeholder' => __('Session End Date'), 'label' => 'Session End Date *']) ?>
    </div>
</div>

<!-- <div class="col-md-12">
    <div class="form-group">
        <?php 
            //echo $this->Form->control('booking_date', ['type' => 'date', 'class' => 'form-control', 'placeholder' => 'Choose your prefered date', 'label' => 'Choose your prefered date']);
         ?>
    </div>
</div> -->

<div class="col-md-12">
    <div class="form-group">
        <?php 
            echo $this->Form->control('note', ['type' => 'textarea', 'class' => 'form-control', 'placeholder' => 'Comment']);
         ?>
    </div>
</div>
<?= $this->Form->end() ?>



<script>
<?php $this->Html->scriptStart(['block' => true]); ?>
$(document).ready(function(){
           // Basic
    $('.dropify').dropify();
    // CKEDITOR.replace( 'ckeditor1');
    // CKEDITOR.replace( 'ckeditor2' );
    
});
<?php $this->Html->scriptEnd(); ?>
</script>