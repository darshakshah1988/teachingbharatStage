<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $microSession
 */
$session = $this->request->getSession();
$user_id=$session->read('teacher_session_id');
$user_email = @$this->getRequest()->getAttribute('identity')->email; 

      
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
                    <h3><?= __(empty($microSession->id) ? 'Add New MicroSession' : 'Edit MicroSession') ?></h3>
                </div>
                <?= $this->Form->create($microSession, ['role' => 'form', 'enctype' => 'multipart/form-data', 'templates' => 'bootstrap_validation', 'novalidate' => true]) ?>
                <?= $this->Form->hidden('status', ['value' => 0]);  ?>
                <div class="col-md-12 ATField">
                    <div class="row nopadding">
                        <div class="col-md-12">
                                <?= $this->Form->control('title', ['class' => 'MyInput', 'placeholder' => __('Enter Name'), 'label' => 'Name *']); ?>
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
                                <?= $this->Form->control('duration', ['class' => 'MyInput duration','empty' => __('Duration'), 'placeholder' => __('i.e 15 Hours'), 'label' => 'Duration *']) ?>
                        </div>
                    </div>


                <div class="row nopadding">
                    <div class="col-sm-3">
                          <?= $this->Form->checkbox('add_package', [ 'class' => 'D-checkbox', 'id' => 'add_package']); ?><label for="add_package" class="D-label">Select Package</label>                        
                        </div>
                        <div id="show_packages" style="display:none">
                        <div class="col-sm-3">
                                <?php echo $this->Form->control('package_id', ['options' => $packages, 'empty' => 'Select Package', 'class' => 'MyInput package', 'label' => __('Package *')]); ?>
                        </div>

                         <div id="show_plan" style="display:none" class="col-sm-3">
                                <?php echo $this->Form->control('plan_id', ['options' => $plans, 'empty' => 'Select Plan', 'class' => 'MyInput plan', 'label' => __('Plan *')]); ?>
                       </div>
                        </div>

                          <div id="show_price" >
                        <div class="col-sm-3">
                                <?= $this->Form->control('price', ['class' => 'MyInput price', 'placeholder' => __('Price e.g ₹ 12500'), 'id'=>'price', 'label' => 'Price *', 'min' => 0]) ?>
                        </div>
                        <div class="col-sm-3">
                                <?= $this->Form->control('discount_price', ['id'=>'discount_price','class' => 'MyInput dprice', 'placeholder' => __('Discount Price e.g ₹ 9999'), 'min' => 0]) ?>
                        </div>
                        
                    </div>
                      

</div>
 <div class="row nopadding" >
  <div class="col-sm-3">
                                <?php echo $this->Form->control('academic_year_id', ['options' => [1 => "2021", 0 => "2022"], 'empty' => false, 'class' => 'MyInput', 'label' => __('Academic Year')]); ?>
                        </div>

                        
						<?php 
						$isSuperuser = @$this->getRequest()->getAttribute('identity')->is_superuser;
						if($isSuperuser == 1){
						?>
                        <div class="col-sm-3">
                                <?php echo $this->Form->control('status', ['options' => [1 => "Active", 0 => "Inactive"], 'empty' => false, 'class' => 'MyInput', 'label' => __('Status')]); ?>
                        </div>
                        <?php } ?>
                    
                        <div class="col-sm-6">
                                <label>Select Day&nbsp;</label>
                                <?= $this->Form->checkbox('monday', [ 'class' => 'D-checkbox', 'id' => 'monday']); ?><label for="monday" class="D-label">M</label>
                                <?= $this->Form->checkbox('tuesday', [ 'class' => 'D-checkbox', 'id' => 'tuesday']); ?><label for="tuesday" class="D-label">T</label>
                                <?= $this->Form->checkbox('wednesday', [ 'class' => 'D-checkbox', 'id' => 'wednesday']); ?><label for="wednesday" class="D-label">W</label>
                                <?= $this->Form->checkbox('thursday', [ 'class' => 'D-checkbox', 'id' => 'thursday']); ?><label for="thursday" class="D-label">Th</label>
                                <?= $this->Form->checkbox('friday', [ 'class' => 'D-checkbox', 'id' => 'friday']); ?><label for="friday" class="D-label">F</label>
                                <?= $this->Form->checkbox('saturday', [ 'class' => 'D-checkbox', 'id' => 'saturday']); ?><label for="saturday" class="D-label">S</label>
                                <?= $this->Form->checkbox('sunday', [ 'class' => 'D-checkbox', 'id' => 'sunday']); ?><label for="sunday" class="D-label">S</label>
                        </div>
                                            
                    </div>
					
                   <div class="row nopadding">                       
        <div class="col-lg-12 col-md-6 col-xs-1">                        
        <?php 

    //      [microsession_file] => 495999163336479122713.png
    // [microsession_file_dir] => webroot\img\uploads\MicroSessions\microsession_file\
    // [microsession_file_size] => 885397
    // [microsession_file_type] => image/png
       
          $nominate_file_path = '';


          if(!isset($microSession->microsession_file))
          {

            echo $this->Form->control('microsession_file', ['type' => 'file', 'class' => 'dropify', 'data-height' => 30, 'label' => 'Microsession Image' , 'data-default-file' => $nominate_file_path]);
            
            }
            else
            {
                echo $this->Form->control('microsession_file', ['type' => 'file', 'class' => 'dropify', 'data-height' => 30, 'label' => 'Microsession Image' , 'data-default-file' => $nominate_file_path]);
                echo "<img src='/".$microSession->microsession_file_dir."".$microSession->microsession_file."' width=250px height=250px style='float:left' alt='".$microSession->microsession_file."' />";
            }


            ?>


        </div>


                        <div class="col-md-12">
                              <?= $this->Form->control('short_description', ['type'=>'textarea','class' => 'MyInput', 'placeholder' => __('Feature'), 'label' => 'Feature *', 'id' => 'ckeditor1']) ?> 
                           
                        </div>
                         <div class="col-md-12">
                              <?= $this->Form->control('description', ['type'=>'textarea','class' => 'MyInput', 'placeholder' => __('Description'), 'label' => 'Description *', 'id' => 'ckeditor3']) ?> 
                           
                        </div>

                         <div class="col-md-12">
                            <?= $this->Form->control('faq', ['type'=>'textarea','class' => 'MyInput', 'placeholder' => __('FAQ'), 'label' => 'FAQ *', 'id' => 'ckeditor2']) ?>
                        </div> 
                      
                    </div>
                    <div class="col-md-12 nopadding mt50">
                        <div class="col-sm-2 col-sm-offset-3">
                            <?php echo $this->Form->input('save', ['type' => 'submit', 'class' => 'btn btn-block btn-success MyBBtn', 'title' => __('Save Draft'), 'value' => __(empty($microSession->id) ? __('CREATE') : 'Update') , 'escapeTitle' => false]); ?>
                        </div>
                        <!-- <div class="col-sm-2">
                            <?php echo $this->Form->input('save_draft', ['type' => 'submit', 'class' => 'btn btn-block btn-success MyBBtn', 'title' => __('Save Draft'),'value' => __('SAVE DRAFT'), 'escapeTitle' => false]); ?>
                        </div> -->
                        <div class="col-sm-2">
                            <?php echo $this->Html->link(__('CANCEL'), ['action' => 'index'], ['class' => 'btn btn-block btn-danger MyBBtn', 'title' => __('Cancel'), 'escape' => false]); ?>
                        </div>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

<?php
$this->assign('title', __(empty($microSession->id) ? 'Add New MicroSession' : 'Edit MicroSession'));
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

//var selectedsubject= $('#subject-id').val();
var selectedpkg= $('#package-id').val();
var selectedpln= $('#plan-id').val();
if(selectedpkg != '')
{
    $('#show_packages').show();
    $('#add_package').prop('checked', true);
}
if(selectedpln != '')
{
    $('#show_plan').show(); 
}
  if($('#add_package').prop("checked") == true){
$('#show_price').hide();
}
//console.log("===="+selectedpkg+selectedpln);
           // Basic
        $('#add_package').change(function() {
            
        if(this.checked) {
             $('#show_packages').show();
             $('#show_price').hide();
             $("#price").val(0);
             $("#discount_price").val(0);
        }else{
             $('#show_packages').hide();
             $('#show_price').show();
             $("#package-id").val('');
             $("#plan-id").val('');
        }
             
    });
    
// regarding subject

$('#subject-id').change(function() {            
        var subject_id = this.value;
$('#show_plan').hide();
$("#package-id").val('');
$("#plan-id").val('');
        var actionUrl= window.location.protocol+"//"+window.location.host+"/micro-sessions/micro-sessions/getPackagesub/"+subject_id;
         //console.log(actionUrl);   
        $.ajax({
                method: 'get',
                url : actionUrl,
               // data: {package_id:data},
                success: function( response )
                {    
                var items =response.allPackages;

                //alert(items);
                // $('#show_plan').show();
                $('#package-id').empty();
                $('#package-id').append(`<option value="">Select Package</option>`);
                $.each(items, function(key, value) {
                  $('#package-id').append(`<option value="${key}">${value}</option>`);
                });

                }
        });
    });


    $('#package-id').change(function() {            
        var package_id = this.value;
        var actionUrl= window.location.protocol+"//"+window.location.host+"/micro-sessions/micro-sessions/getPlans/"+package_id;
         //console.log(actionUrl);   
        $.ajax({
                method: 'get',
                url : actionUrl,
               // data: {package_id:data},
                success: function( response )
                {    
                var items =response.allPlans;
                 $('#show_plan').show();
                $('#plan-id').empty();
                $('#plan-id').append(`<option value="">Select Plan</option>`);
                $.each(items, function(key, value) {
                  $('#plan-id').append(`<option value="${key}">${value}</option>`);
                });

                }
        });
    });


    $('.dropify').dropify();
    CKEDITOR.replace( 'ckeditor1' );
    CKEDITOR.replace( 'ckeditor2' );
    CKEDITOR.replace( 'ckeditor3' );
});

(function($) {
  $.fn.inputFilter = function(inputFilter) {
    return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      } else {
        this.value = "";
      }
    });
  };
}(jQuery));

$(".duration").inputFilter(function(value) {
    return /^\d*$/.test(value);    // Allow digits only, using a RegExp
  });
$(".price").inputFilter(function(value) {
    return /^\d*$/.test(value);  // No decimal
})
$(".dprice").inputFilter(function(value) {
    return /^\d*$/.test(value);  // No decimal
})



$('.package, .plan, .D-checkbox').change(function() {
    var stat = $('.D-checkbox').prop('checked');
    if(stat == true)
    {
        if($('.package').val() == "" || $('.plan').val() == "")
        {
        $('.package').attr('required','required');
        $('.plan').attr('required','required');
        $('.MyBBtn').attr('disabled','disabled');
        alert("please select package/plan");
        }
        else
        {
        $('.MyBBtn').removeAttr('disabled');
        }
    }
    else
    {
        $('.MyBBtn').removeAttr('disabled');

    }
})
<?php $this->Html->scriptEnd(); ?>
</script>


