<?= $this->Form->create($sessionBooking, ['url' => ['controller' => 'SessionBookings', 'action' => 'sessionRescheduled', 'plugin' => 'Sessions', $sessionBooking->id],'role' => 'form', 'id' => 'sessionReschedule', 'enctype' => 'multipart/form-data', 'templates' => [
        'formGroup' => '{{label}}{{input}}{{error}}',
        'inputContainer' => '<div class="form-group"><div class="input {{type}}{{required}}">{{content}}</div></div>',
        // Container element used by control() when a field has an error.
        'inputContainerError' => '<div class="form-group"><div class="input {{type}}{{required}} error">{{content}}</div></div>',
        'label' => '<label class="control-label"{{attrs}}>{{text}}</label>',
    ], 'data-group-name' => 'digits', 'data-group-name' => 'digits', 'data-group-name' => 'digits']) ?>


<div class="col-md-12">
        <?= $this->Form->control('start_date', ['type' => 'text','class' => 'form-control', 'id' => 'start_date', 'placeholder' => __('Session Start Date'), 'label' => 'Session Start Date *']) ?>
</div>
<div class="col-md-12">
        <?= $this->Form->control('end_date', ['type' => 'text','class' => 'form-control', 'id' => 'end_date', 'placeholder' => __('Session End Date'), 'label' => 'Session End Date *']) ?>
</div>
<div class="col-md-12">
        <?= $this->Form->control('teacher_comment', ['type' => 'textarea','class' => 'form-control', 'placeholder' => __('Comment'), 'label' => 'Comment *']) ?>
</div>
<?= $this->Form->end() ?>

<script>
    $("#start_date").datetimepicker({
        format: 'Y-m-d H:i:s',
        step: 60,
        onShow: function () {
                    this.setOptions({
                        //minDate: 0,
                        minDate: $('#end_date').val() ? $('#end_date').val() : 0
                    });
                } 
        }).attr('readonly', 'readonly');

    $( "#end_date" ).datetimepicker({
            format: 'Y-m-d H:i:s',
            step: 60,
            onShow: function () {
                    this.setOptions({
                        minDate:$('#start_date').val() ? $('#start_date').val() : 0,
                        //minTime:$('#fdate').val()?$('#fdate').val():false
                    });
                }                    
        }).attr('readonly', 'readonly'); 
</script>