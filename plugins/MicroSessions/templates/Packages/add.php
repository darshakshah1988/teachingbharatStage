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
                    <h3><?= __(empty($package->id) ? 'Add New Package' : 'Edit Package') ?></h3>
                </div>
                <?= $this->Form->create($package, ['role' => 'form', 'enctype' => 'multipart/form-data', 'templates' => 'bootstrap_validation', 'novalidate' => true]) ?>
                <?= $this->Form->hidden('status', ['value' => 0]); ?>
                <div class="col-md-12 ATField">
                    <div class="row nopadding">
                        <div class="col-md-12">
                                <?= $this->Form->control('package_name', ['class' => 'MyInput', 'placeholder' => __('Enter Name'), 'label' => 'Name *']); ?>
                        </div>
                    </div>
                  <!--   <div class="row nopadding">
                        <div class="col-md-12">
                                <? //= $this->Form->control('package_title', ['class' => 'MyInput', 'placeholder' => __('Enter Title'), 'label' => 'Title *']); ?>
                        </div>
                    </div> -->
                    <div class="row nopadding">
                         <div class="col-sm-3">
                                <?= $this->Form->control('board_id', ['options' => $boards, 'empty' => 'Select Brand', 'class' => 'MyInput', 'label' => 'Board *']); ?>
                        </div>
                        <div class="col-sm-3">
                                <?= $this->Form->control('grading_type_id', ['options' => $gradingTypes, 'empty' => 'Select Class', 'class' => 'MyInput', 'label' => 'Class *']); ?>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <?= $this->Form->control('subject_id', ['type' => 'select',
                                                'multiple'=>true,
                                                'options' => $subjects,'class' => 'MyInput', 'empty' => __('Select Subject'), 'label' => 'Subject *']); ?>
                            </div>
                        </div>               
                       
                    </div>
                    <div class="row nopadding">                       
                        
                        <div class="col-sm-3">
                                <?php echo $this->Form->control('status', ['options' => [1 => "Active", 0 => "Inactive"], 'empty' => false, 'class' => 'MyInput', 'label' => __('Status')]); ?>
                        </div>
                         


                    </div>
                    
                   <div class="row nopadding">

                   <div class="col-md-3">                        
        <?php $nominate_file_path = "";
        if (!empty($package->package_file_path) && !empty($package->package_file) && file_exists("img/".$package->package_file_path . $package->package_file)) {
                $nominate_file_path = WWW_ROOT .'img/'. $package->package_file_path."/".$package->package_file;
            } 

echo $this->Form->control('package_file', ['type' => 'file', 'class' => 'dropify', 'data-height' => 30, 'label' => 'Upload Background Image' , 'data-default-file' => $nominate_file_path]);
            ?>
        </div>                       
                        <!-- <div class="col-md-12">
                             <?= $this->Form->control('short_description', ['class' => 'MyInput', 'placeholder' => __('This will apprear at the Banner Area.. Max 256 words'), 'rows' => 5]) ?>
                        </div>
                        <div class="col-md-12">
                            <?= $this->Form->control('description', ['type'=>'textarea','class' => 'MyInput', 'placeholder' => __('Description'), 'label' => 'Description *', 'id' => 'ckeditor1']) ?>
                        </div> -->

                        <div class="col-md-12">
                            <?= $this->Form->control('about', ['type'=>'textarea','class' => 'MyInput', 'placeholder' => __('About'), 'label' => 'About *', 'id' => 'ckeditor2']) ?>
                        </div>
                        <div class="col-md-12">
                            <?= $this->Form->control('what_included', ['type'=>'textarea','class' => 'MyInput', 'placeholder' => __('What Included'), 'label' => 'What Included *', 'id' => 'ckeditor3']) ?>
                        </div>

                        <div class="col-md-12">
                            <?= $this->Form->control('what_best', ['type'=>'textarea','class' => 'MyInput', 'placeholder' => __('What Best'), 'label' => 'What Best *', 'id' => 'ckeditor4']) ?>
                        </div>

                        <div class="col-md-12">
                            <?= $this->Form->control('faq', ['type'=>'textarea','class' => 'MyInput', 'placeholder' => __('FAQ'), 'label' => 'FAQ *', 'id' => 'ckeditor5']) ?>
                        </div>

                    </div>
                    <div class="col-md-12 nopadding mt50">
                        <div class="col-sm-2 col-sm-offset-3">
                            <?php echo $this->Form->input('save', ['type' => 'submit', 'class' => 'btn btn-block btn-success MyBBtn', 'title' => __('Save Draft'), 'value' => __(empty($package->id) ? __('CREATE') : 'Update') , 'escapeTitle' => false]); ?>
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
$this->assign('title', __(empty($package->id) ? 'Add New Package' : 'Edit Package'));
$this->Html->meta(
    'keywords', "Teaching Bharat | Online course | online education | online video", ['block' => true]
);
$this->Html->meta(
    'description', "Teaching Bharat | Online course | online education | online video", ['block' => true]
);

?>

<?php 
echo $this->Html->css(['/assets/plugins/dropify-master/dist/css/dropify.min.css','https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css
'],['block' => true]);
echo $this->Html->script(['/assets/plugins/dropify-master/dist/js/dropify.min.js', 'ckeditor/ckeditor.js','https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js'],['block' => true]);
 ?>
<script>
<?php $this->Html->scriptStart(['block' => true]); ?>
$(document).ready(function(){
           // Basic
    $('.dropify').dropify();
    CKEDITOR.replace( 'ckeditor1' );
   CKEDITOR.replace( 'ckeditor2' );
   CKEDITOR.replace( 'ckeditor3' );
    CKEDITOR.replace( 'ckeditor4' );
   CKEDITOR.replace( 'ckeditor5' );
});
<?php $this->Html->scriptEnd(); ?>
</script>


