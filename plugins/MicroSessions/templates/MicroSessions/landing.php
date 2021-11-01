<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $courses
 */
// $this->layout = "microsessionfront";
?>
<?php 
 echo $this->Html->css(['micro_courses.css','Dstyle.css'],['block' => true]);?>
 <section class="course_list_banner">
 <div class="container">
            <div class="col-sm-12 nopadding">
                <div class="col-sm-12 clb-texts" style="margin-top: 0px">
                    <h2>Micro Session - Boost your score</h2>
                </div>
            </div>
        </div>
    </section>
    <div class="new-grey">
        <div class="container">
            <div class="col-sm-12 new-c-area">
                <?= $this->Form->create(null, ['role' => 'form', 'enctype' => 'multipart/form-data', 'type' => 'get','valueSources' => ['query', 'context'], 'templates' => [
                            'checkboxWrapper' => '{{label}}',
                            'nestingLabel' => '<li><label{{attrs}}>{{text}}{{input}}<span class="checkmark"></span></label></li>',
                        ], 'id' => 'formElms']) ?>
                <div class="col-sm-3 new-c-filter">
                    <div class="col-sm-12 new-c-filter-block">
                        <h2>Board / Target</h2>
                        <ul class="searchbar">
                            <?php
                            echo $this->Form->select('boards', $boards, ['multiple' => 'checkbox', 
                                        'label' => ['class' => 'd-check-sm']]);
                            ?>
                        </ul>                       
                    </div>
                    <div class="col-sm-12 new-c-filter-block">
                        <h2>Grade</h2>
                        <ul class="searchbar">
                            <?php
                                echo $this->Form->select('grading_types', $gradingTypes, ['multiple' => 'checkbox', 
                                        'label' => ['class' => 'd-check-sm']]);
                            ?>
                        </ul>                      
                    </div>
                    <div class="col-sm-12 new-c-filter-block">
                        <h2>Subjects</h2>
                        <ul class="searchbar">
                            <?php
                                echo $this->Form->select('subjects', $subjects, ['multiple' => 'checkbox', 
                                        'label' => ['class' => 'd-check-sm']]);
                            ?>
                        </ul>
                    </div>
                </div>
                <?= $this->Form->end() ?>
                <div class="col-sm-9 new-c-list" >
                    <!-- <div class="col-sm-12 searchbar">
                        <div class="input-group">
                          <input type="text" name="keyword" class="form-control" value="<?= $this->request->getQuery('keyword') ?>" placeholder="Search a Session Title...">
                          <span class="input-group-btn">
                            <button class="btn btn-default" id="keywordBtn" type="button"><i class="glyphicon glyphicon-search"></i></button>
                          </span>
                        </div>
                    </div> -->
                    <div class="col-sm-12" id="loaderContaner" style="min-height: 500px;">
                        <div style="text-align:center;">
                            <strong>Record Not Available</strong>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php 
echo $this->Html->script(['https://cdnjs.cloudflare.com/ajax/libs/jquery-loading-overlay/2.1.7/loadingoverlay.min.js'],['block' => true]);
echo $this->Html->script(['common', 'Courses'], ['block' => true]); 
?>
<script>
<?php $this->Html->scriptStart(['block' => true]); ?>
$coursesObj = new Courses();
getCourses();
//
$(document).on("change", "form#formElms input", function(event) {
        event.preventDefault();
        getCourses();
});

$(document).on("click", "#keywordBtn", function(event) {
        event.preventDefault();
        getCourses();
});

$(document).on("keydown", "input[name='keyword']", function(e) {
        var code = e.keyCode || e.which;
        if(code == 13){
            getCourses();
        } 
});

    
function getCourses(){
    let postData = $("form#formElms").serialize();
    if (history.pushState) {
           // var newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
            var newUrl = '<?= $this->Url->build(['controller' => 'MicroSessions', 'action' => 'landing'], ['fullBase' => true]) ?>?'+postData;
            window.history.pushState({path:newUrl},'',newUrl);
        }
       $coursesObj.getCourses({'url': '<?= $this->Url->build(['controller' => 'MicroSessions', 'action' => 'getCourses']) ?>', postData: $("form#formElms").serialize() + "&keyword="+ $("input[name='keyword']").val()});
}

<?php $this->Html->scriptEnd(); ?>
</script>


