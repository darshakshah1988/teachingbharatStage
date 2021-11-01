<?php
$this->layout = "authdefault";
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $course
 */
?>
<div class="White79">
    <div class="GreyBg">
        <div class="container">
            <div class="col-md-12 AddTest RTestMark">
                <?= $this->Flash->render() ?>
                <div class="col-md-12 ATtitle">
                    <h3><?= __(empty($course->id) ? 'Add Master Session' : 'Edit Master Session') ?></h3>
                </div>
                <?= $this->Form->create($course, ['context' => ['validator' => 'session'], 'role' => 'form', 'enctype' => 'multipart/form-data', 'templates' => 'bootstrap_validation', 'novalidate' => true]) ?>
                <?= $this->Form->hidden('status', ['value' => 0]); ?>
                <div class="col-md-12 ATField">
                    <div class="row nopadding">
                        <div class="col-md-12">
                                <?= $this->Form->control('title', ['class' => 'MyInput', 'placeholder' => __('Enter Session Name'), 'label' => 'Enter Session Name *']); ?>
                        </div>
                    </div>
                    <div class="row nopadding">
                         <div class="col-sm-4">
                                <?= $this->Form->control('board_id', ['options' => $boards, 'empty' => 'Select Brand', 'class' => 'MyInput', 'label' => 'Board *']); ?>
                        </div>
                        <div class="col-sm-4">
                                <?= $this->Form->control('grading_type_id', ['options' => $gradingTypes, 'empty' => 'Select Class', 'class' => 'MyInput', 'label' => 'Class *']); ?>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <?= $this->Form->control('subject_id', ['class' => 'MyInput', 'empty' => __('Select Subject'), 'label' => 'Subject *']); ?>
                            </div>
                        </div>
                        
                    </div>

                   <div class="row nopadding">
                        <div class="col-md-6">
                            <?= $this->Form->control('start_date', ['type' => 'text','class' => 'MyInput', 'id' => 'start_date', 'placeholder' => __('Session Start Date'), 'label' => 'Session Start Date *']) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $this->Form->control('end_date', ['type' => 'text','class' => 'MyInput', 'id' => 'end_date', 'placeholder' => __('Session End Date'), 'label' => 'Session End Date *']) ?>
                        </div>
						<div class="col-md-8">
                            <?= $this->Form->control('no_of_seats', ['type' => 'number','class' => 'MyInput','min'=>"1", 'placeholder' => __('Number Of Seats'), 'label' => 'Number Of Seats *']) ?>
                        </div>
                        <div class="col-md-8">
                                <?= $this->Form->control('course_url', ['class' => 'MyInput', 'placeholder' => __('Enter Course URL'), 'label' => 'Past Course URL']); ?>
                        </div>
                        <div class="col-md-12">
                                <?= $this->Form->control('what_learn', ['type' => 'text','class' => 'MyInput', 'placeholder' => __('What you will learn'), 'label' => 'What you will learn']); ?>
                                <span>
                                    <small>Add semi-colon(;) separated text for list of text</small>
                                </span>
                        </div>
                       <!--  <div class="col-md-12">
                             <?= $this->Form->control('short_description', ['class' => 'MyInput', 'placeholder' => __('This will apprear at the Banner Area.. Max 256 words'), 'rows' => 5]) ?>
                        </div> -->
                        <div class="col-md-12">
                            <?= $this->Form->control('description', ['class' => 'MyInput', 'placeholder' => __('Session Description'), 'label' => 'Session Overview *', 'id' => 'ckeditor1']) ?>
                        </div>

                       <!--  <div class="col-md-12">
                            <?= $this->Form->control('features', ['class' => 'MyInput', 'placeholder' => __('Why you will Choose this Course'), 'label' => 'Session Features', 'id' => 'ckeditor2']) ?>
                        </div>  -->
                      
                    </div>
                    <div class="col-md-12 nopadding mt50">
                        <div class="col-sm-2 col-sm-offset-3">
                            <?php echo $this->Form->input('save', ['type' => 'submit', 'class' => 'btn btn-block btn-success MyBBtn', 'title' => __('Save Draft'), 'value' => empty($course->id) ? __('CREATE') : __('Update'), 'escapeTitle' => false]); ?>
                        </div>
                        <!-- <div class="col-sm-2">
                            <?php echo $this->Form->input('save_draft', ['type' => 'submit', 'class' => 'btn btn-block btn-success MyBBtn', 'title' => __('Save Draft'),'value' => __('SAVE DRAFT'), 'escapeTitle' => false]); ?>
                        </div> -->
                        <div class="col-sm-2">
                            <?php echo $this->Html->link(__('CANCEL'), ['action' => 'masterSessions'], ['class' => 'btn btn-block btn-danger MyBBtn', 'title' => __('Cancel'), 'escape' => false]); ?>
                        </div>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

<?php
$this->assign('title', __(empty($course->id) ? 'Add Master Session' : 'Edit Master Session'));
$this->Html->meta(
    'keywords', "Teaching Bharat | Online Master Session | online education | online master session video", ['block' => true]
);
$this->Html->meta(
    'description', "Teaching Bharat | Online Master Session | online master session education | online master session video", ['block' => true]
);

?>

<?php 
echo $this->Html->css(['/assets/plugins/dropify-master/dist/css/dropify.min.css'],['block' => true]);
echo $this->Html->script(['/assets/plugins/dropify-master/dist/js/dropify.min.js', 'https://cdn.ckeditor.com/4.14.0/basic/ckeditor.js'],['block' => true]);

$this->Html->css(['/assets/plugins/datetimepicker-master/jquery.datetimepicker'], ['block' => true]);
$this->Html->script(['/assets/plugins/datetimepicker-master/build/jquery.datetimepicker.full.min'], ['block' => true]);
 ?>
<script>
<?php $this->Html->scriptStart(['block' => true]); ?>
$(document).ready(function(){
           // Basic
    $('.dropify').dropify();
    // CKEDITOR.replace( 'ckeditor1');
    // CKEDITOR.replace( 'ckeditor2' );
    $("#start_date").datetimepicker({
        format: 'Y-m-d H:i:s',
        step:15,
        onShow: function () {
                    this.setOptions({
                        //minDate: 0,
                        minDate: 0
                    });
                } 
        }).attr('readonly', 'readonly');

    $( "#end_date" ).datetimepicker({
            format: 'Y-m-d H:i:s',
            step:15,
            onShow: function () {
                    this.setOptions({
                        minDate:$('#start_date').val() ? $('#start_date').val() : 0,
                        //minTime:$('#fdate').val()?$('#fdate').val():false
                    });
                }                    
        }).attr('readonly', 'readonly'); 
});
<?php $this->Html->scriptEnd(); ?>
</script>
