<?php
//$this->layout = "authdefault";
/**
 * Copyright 2010 - 2019, Cake Development Corporation (https://www.cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2018, Cake Development Corporation (https://www.cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
 <div class="teacher-list-header">
        <div class="container">
            <div class="col-sm-12">
                <div class="col-sm-3">
                    <h2>Find A Teacher</h2>
                </div>
                <?= $this->Form->create(null, ['role' => 'form', 'enctype' => 'multipart/form-data', 'type' => 'get','valueSources' => ['query', 'context'], 'templates' => [
                            'checkboxWrapper' => '{{label}}',
                            'nestingLabel' => '<li><label{{attrs}}>{{text}}{{input}}<span class="checkmark"></span></label></li>',
                        ], 'id' => 'formElms']) ?>
                <div class="col-sm-9 tlh-filters">
                    <div class="col-sm-3">
                        <?php echo $this->Form->select('grading_types', $gradingTypes, ['class' => 'form-control grading_types', 'multiple' => true, 'hiddenField' => false]); ?>
                    </div>
                    <div class="col-sm-3">
                         <?php echo $this->Form->select('boards', $boards, ['class' => 'form-control boardsmSlt', 'multiple' => true, 'hiddenField' => false]); ?>
                    </div>
                    <div class="col-sm-3">
                        <?php echo $this->Form->select('subjects', $subjects, ['class' => 'form-control subjectsmslt', 'multiple' => true, 'hiddenField' => false]); ?>
                    </div>
                    <div class="col-sm-3">
                        <a href="javascript:void(0)" id="searchTeachers" class="search-teacher-btn">Search<i class="glyphicon glyphicon-menu-right"></i></a>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
   <div class="new-grey">
        <div class="container">
            <div class="col-sm-10 col-sm-offset-1 new-c-area">
                <div class="col-sm-2 new-c-filter">
                    <?= $this->Form->create(null, ['templates' =>'bootstrap_validation', 'type' => 'get','valueSources' => ['query', 'context'], 'id' => 'sidebarForm']) ?>
                    <div class="col-sm-12 new-c-filter-block">
                        <h2>Ratings</h2>
                        <!-- <label class="d-radio">Default
                          <input type="radio" name="radio" checked="checked">
                          <span class="checkmark-r"></span>
                        </label>
                        <label class="d-radio">High to Low
                          <input type="radio" name="radio">
                          <span class="checkmark-r"></span>
                        </label>
                        <label class="d-radio">Low to High
                          <input type="radio" name="radio">
                          <span class="checkmark-r"></span>
                        </label> -->
                    <?php
                        echo $this->Form->control('rating', [
                                    'type' => 'radio',
                                    'options' => ['Default', 'High to Low', 'Low to High'],
                                    'label' => false,
                                    'templateVars' => ['spcls' => 'checkmark-r'],
                                    'templates' => [
                                        'nestingLabel' => '{{hidden}}<label{{attrs}} class="d-radio">{{input}}{{text}} <span class="{{spcls}}"></span></label>  ']
                                    ]);
                    ?>

                    </div>

                    <div class="col-sm-12 new-c-filter-block">
                        <h2>Availability</h2>
                        <?php 
                                // echo $this->Form->select('teacher_schedules._ids', $schedules, [
                                //     'multiple' => 'checkbox', 
                                //     'label' => ['class' => 'd-radio'],
                                //     'templateVars' => ['spncls' => 'checkmark-r']
                                //     ]);
                                echo $this->Form->select('teacher_schedules', $schedules, [
                                    'multiple' => 'checkbox', 
                                    'label' => ['class' => 'D-label'],
                                    'templateVars' => ['spcls' => '']
                                    ]);
                             ?>
                    </div>

                    <?= $this->Form->end() ?>

                  <!--   <div class="col-sm-12 new-c-filter-block">
                        <h2>Status</h2>
                        <label class="d-radio">All
                          <input type="radio" name="radio" checked="checked">
                          <span class="checkmark-r"></span>
                        </label>
                        <label class="d-radio">Online
                          <input type="radio" name="radio">
                          <span class="checkmark-r"></span>
                        </label>
                        <label class="d-radio">Offline
                          <input type="radio" name="radio">
                          <span class="checkmark-r"></span>
                        </label>
                    </div> -->
                    <!-- <div class="col-sm-12 new-c-filter-block">
                        <h2>Gender</h2>
                        <label class="d-radio">All
                          <input type="radio" name="radio" checked="checked">
                          <span class="checkmark-r"></span>
                        </label>
                        <label class="d-radio">Male
                          <input type="radio" name="radio">
                          <span class="checkmark-r"></span>
                        </label>
                        <label class="d-radio">Female
                          <input type="radio" name="radio">
                          <span class="checkmark-r"></span>
                        </label>
                    </div> -->
                </div>
                <div class="col-sm-9 new-c-list teacherLoad">
                    <div style="text-align:center;">
                        <strong>Record Not Available</strong>  
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
$this->assign('title', "Teachers");
$this->Html->meta(
    'keywords', 'Teachers', ['block' => true]
);
$this->Html->meta(
    'description', 'Teachers', ['block' => true]
);

//echo $this->Html->css(['/assets/plugins/cropperjs-master/docs/css/maincropper.css', '/assets/plugins/cropperjs-master/docs/css/cropper.css'], ['block' => true]);
echo $this->Html->script(['/assets/plugins/jquery-loading-overlay-master/dist/loadingoverlay.min'],['block' => true]);
echo $this->Html->css(['/assets/plugins/select2-4/dist/css/select2.min.css'],['block' => true]);
echo $this->Html->script('/assets/plugins/select2-4/dist/js/select2.min',['block' => true]);
echo $this->Html->script(['common', 'Users'], ['block' => true]);
?> 

<style type="text/css">
    .select2-container--default .select2-selection--multiple{padding: 8px !important;}
</style>

<script>
<?php $this->Html->scriptStart(['block' => true]); ?>
$userObj = new Users();
loadTeachers();
$(document).ready(function() {
    $(".grading_types").select2({
        placeholder: "Choose Grade",
        allowClear: true
    });
    $(".boardsmSlt").select2({
        placeholder: "Choose Board",
        allowClear: true
    });
    $(".subjectsmslt").select2({
        placeholder: "Choose Subject",
        allowClear: true,
        //maximumInputLength: 5
    });
});

$(document).on("click", "#searchTeachers", function(event) {
        event.preventDefault();
        loadTeachers();
});

$(document).on("change", "input[name='rating']", function(event) {
        event.preventDefault();
        loadTeachers();
});

$(document).on("change", "input[name^='teacher_schedules']", function(event) {
        event.preventDefault();
        loadTeachers();
});

function loadTeachers(){
    let postData = $("form#formElms").serialize();
    let sidebarData = $("form#sidebarForm").serialize();
    let formData = '';
    if(!postData){
        formData = sidebarData;
    }else{
        formData = postData + "&" + sidebarData;
    }
    console.log(formData)
    if (history.pushState) {
           // var newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
            var newUrl = '<?= $this->Url->build(['controller' => 'Users', 'action' => 'teachers'], ['fullBase' => true]) ?>?type=ajax&'+formData;
            window.history.pushState({path:newUrl},'',newUrl);
        }
    $userObj.loadTeachers({'url': '<?= $this->Url->build(['controller' => 'Users', 'action' => 'loadTeachers', 'plugin' => 'UserManager']) ?>', postData: formData});
}

<?php $this->Html->scriptEnd(); ?>
</script>