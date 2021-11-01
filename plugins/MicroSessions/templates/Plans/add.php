<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $plan
 */
?>

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
                    <h3><?= __(empty($plan->id) ? 'Add New Plan' : 'Edit Plan') ?></h3>
                </div>
                <?= $this->Form->create($plan, ['role' => 'form', 'enctype' => 'multipart/form-data', 'templates' => 'bootstrap_validation', 'novalidate' => true]) ?>
                <?= $this->Form->hidden('status', ['value' => 0]); ?>
                <div class="col-md-12 ATField">
                    <div class="row nopadding">
                        <div class="col-md-12">
                                <?= $this->Form->control('plan_name', ['class' => 'MyInput', 'placeholder' => __('Enter Name'), 'label' => 'Name *']); ?>
                        </div>
                    </div>                    
                    <div class="row nopadding">
                         <div class="col-sm-3">
                                <?= $this->Form->control('price', ['class' => 'MyInput', 'placeholder' => __('Enter Price'), 'label' => 'Price *']); ?>
                        
                        </div>
                        <div class="col-sm-3">
                                <?= $this->Form->control('discount_price', ['class' => 'MyInput', 'placeholder' => __('Enter Discount Price'), 'label' => 'Discount Price *']); ?>
                        
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <?= $this->Form->control('duration', ['class' => 'MyInput', 'placeholder' => __('Enter Duration'), 'label' => 'Duration *']); ?>
                        
                            </div>
                        </div>               
                       
                    </div>
                    <div class="row nopadding">                       
                        
                        <div class="col-sm-3">
                                <?php echo $this->Form->control('status', ['options' => [1 => "Active", 0 => "Inactive"], 'empty' => false, 'class' => 'MyInput', 'label' => __('Status')]); ?>
                        </div>
                         
                    </div>
                    
                   <div class="row nopadding">                       
                        <!-- <div class="col-md-12">
                             <? //= $this->Form->control('features', ['class' => 'MyInput', 'placeholder' => __('Enter Features'), 'rows' => 5]) ?>
                        </div> -->
                        <div class="col-md-12">
                            <?= $this->Form->control('other_details', ['type'=>'textarea','class' => 'MyInput', 'placeholder' => __('Enter Description'), 'label' => 'Description *', 'id' => 'ckeditor1']) ?>
                        </div>
                    </div>
                    <div class="col-md-12 nopadding mt50">
                        <div class="col-sm-2 col-sm-offset-3">
                              <?php echo $this->Form->input('save', ['type' => 'submit', 'class' => 'btn btn-block btn-success MyBBtn', 'title' => __('Save Draft'), 'value' => __(empty($plan->id) ? __('CREATE') : 'Update') , 'escapeTitle' => false]); ?>                          
                        </div>
                        <!-- <div class="col-sm-2">
                            <?php echo $this->Form->input('save_draft', ['type' => 'submit', 'class' => 'btn btn-block btn-success MyBBtn', 'title' => __('Save Draft'),'value' => __('SAVE DRAFT'), 'escapeTitle' => false]); ?>
                        </div> -->
                        <div class="col-sm-2">
                            <?php echo $this->Html->link(__('CANCEL'), ['action' => 'index',$package_id], ['class' => 'btn btn-block btn-danger MyBBtn', 'title' => __('Cancel'), 'escape' => false]); ?>
                        </div>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

<?php
$this->assign('title', __(empty($plan->id) ? 'Add New Plan' : 'Edit Plan'));
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
echo $this->Html->script(['/assets/plugins/dropify-master/dist/js/dropify.min.js', '/assets/plugins/ckeditor/ckeditor.js','https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js'],['block' => true]);
 ?>
<script>
<?php $this->Html->scriptStart(['block' => true]); ?>
$(document).ready(function(){
           // Basic
    $('.dropify').dropify();
   CKEDITOR.replace( 'ckeditor1' );
});
<?php $this->Html->scriptEnd(); ?>
</script>


