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
                    <h3><?= __(empty($course->id) ? 'Add New Course' : 'Edit Course') ?></h3>
                </div>
                <?= $this->Form->create($course, ['role' => 'form', 'enctype' => 'multipart/form-data', 'templates' => 'bootstrap_validation', 'novalidate' => true]) ?>
                <?= $this->Form->hidden('status', ['value' => 0]); ?>
                <div class="col-md-12 ATField">
                    <div class="row nopadding">
                        <div class="col-md-12">
                                <?= $this->Form->control('title', ['class' => 'MyInput', 'placeholder' => __('Enter Course Name'), 'label' => 'Course Name *']); ?>
                        </div>
                    </div>
                    <div class="row nopadding">
                         <div class="col-sm-3">
                                <?= $this->Form->control('board_id', ['options' => $boards, 'empty' => 'Select Brand', 'class' => 'MyInput', 'label' => 'Board *']); ?>
                        </div>
                        <div class="col-sm-3">
                                <?= $this->Form->control('grading_type_id', ['options' => $gradingTypes, 'empty' => 'Select Class', 'class' => 'MyInput', 'label' => 'Class *']); ?>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <?= $this->Form->control('subject_id', ['class' => 'MyInput', 'empty' => __('Select Subject'), 'label' => 'Subject *']); ?>
                            </div>
                        </div>
                        <div class="col-sm-3">
                                <?= $this->Form->control('duration', ['class' => 'MyInput', 'placeholder' => __('i.e 15 Hours'), 'label' => 'Duration *']) ?>
                        </div>
                    </div>

                    <div class="row nopadding">
                        <div class="col-sm-3">
                                <?= $this->Form->control('price', ['class' => 'MyInput', 'placeholder' => __('Price e.g ₹ 12500'), 'label' => 'Price *', 'min' => 0]) ?>
                        </div>
                        <div class="col-sm-3">
                                <?= $this->Form->control('discount_price', ['class' => 'MyInput', 'placeholder' => __('Discount Price e.g ₹ 9999'), 'min' => 0]) ?>
                        </div>
                        <div class="col-sm-3">
                                <label>&nbsp;</label>
                                <?= $this->Form->checkbox('is_free', [ 'class' => 'D-checkbox', 'id' => 'is_free']); ?><label for="is_free" class="D-label">Free Course</label>
                        </div>
                        <div class="col-sm-3">
                                <?php //echo $this->Form->control('status', ['options' => [1 => "Active", 0 => "Inactive"], 'empty' => false, 'class' => 'MyInput', 'label' => __('Status')]); ?>
                        </div>
                    </div>
                   <div class="row nopadding">
                        <div class="col-md-12">
                            <?= $this->Form->control('sample_video', ['class' => 'MyInput', 'placeholder' => __('Youtube, Vimeo Link')]) ?>
                        </div>
                        <div class="col-md-12">
                             <?= $this->Form->control('short_description', ['class' => 'MyInput', 'placeholder' => __('This will apprear at the Banner Area.. Max 256 words'), 'rows' => 5]) ?>
                        </div>
                        <div class="col-md-12">
                            <?= $this->Form->control('description', ['class' => 'MyInput', 'placeholder' => __('Course Description'), 'label' => 'Course Description *', 'id' => 'ckeditor1']) ?>
                        </div>

                        <div class="col-md-12">
                            <?= $this->Form->control('features', ['class' => 'MyInput', 'placeholder' => __('Why you will Choose this Course'), 'label' => 'Course Features *', 'id' => 'ckeditor2']) ?>
                        </div> 
                      
                    </div>
                    <div class="col-md-12 nopadding mt50">
                        <div class="col-sm-2 col-sm-offset-3">
                            <?php echo $this->Form->input('save', ['type' => 'submit', 'class' => 'btn btn-block btn-success MyBBtn', 'title' => __('Save Draft'), 'value' => __(empty($course->id) ? __('CREATE') : 'Update') , 'escapeTitle' => false]); ?>
                        </div>
                        <!-- <div class="col-sm-2">
                            <?php echo $this->Form->input('save_draft', ['type' => 'submit', 'class' => 'btn btn-block btn-success MyBBtn', 'title' => __('Save Draft'),'value' => __('SAVE DRAFT'), 'escapeTitle' => false]); ?>
                        </div> -->
                        <div class="col-sm-2">
                            <?php echo $this->Html->link(__('CANCEL'), ['action' => 'myCourses'], ['class' => 'btn btn-block btn-danger MyBBtn', 'title' => __('Cancel'), 'escape' => false]); ?>
                        </div>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

<?php
$this->assign('title', __(empty($course->id) ? 'Add New Course' : 'Edit Course'));
$this->Html->meta(
    'keywords', "Teaching Bharat | Online course | online education | online video", ['block' => true]
);
$this->Html->meta(
    'description', "Teaching Bharat | Online course | online education | online video", ['block' => true]
);

?>

<?php 
echo $this->Html->css(['/assets/plugins/dropify-master/dist/css/dropify.min.css'],['block' => true]);
echo $this->Html->script(['/assets/plugins/dropify-master/dist/js/dropify.min.js', 'https://cdn.ckeditor.com/4.14.0/basic/ckeditor.js'],['block' => true]);
 ?>
<script>
<?php $this->Html->scriptStart(['block' => true]); ?>
$(document).ready(function(){
           // Basic
    $('.dropify').dropify();
    CKEDITOR.replace( 'ckeditor1' );
    CKEDITOR.replace( 'ckeditor2' );
});
<?php $this->Html->scriptEnd(); ?>
</script>
