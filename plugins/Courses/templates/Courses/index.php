<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $courses
 */
?>
 <section class="course_list_banner">
        <div class="container">
            <div class="col-sm-12 nopadding">
                <div class="col-sm-7 clb-texts">
                    <h2>A Complete New</h2>
                    <h3>Online Learning Experience</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>

                </div>
                <div class="col-sm-4 col-sm-offset-1">
                    <?php echo $this->Html->image('new/course-list-top-img.png', ['class' => 'img-full']) ?>
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
                    <!-- <div class="col-sm-12 new-c-filter-block">
                        <h2>Courses Type</h2>
                        <label class="d-check-sm"> 
                            Standard Courses
                            <input type="checkbox" checked="checked">
                            <span class="checkmark"></span>
                        </label>
                        <label class="d-check-sm">
                            1-to-1 Live
                            <input type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                    </div> -->
                    <div class="col-sm-12 new-c-filter-block">
                        <h2>Board / Target</h2>
                        <ul class="searchbar">
                            <?php
                            echo $this->Form->select('boards', $boards, ['multiple' => 'checkbox', 
                                        'label' => ['class' => 'd-check-sm']]);
                            ?>
                        </ul>
                        <!-- <label class="d-check-sm">
                            CBSE
                            <input type="checkbox" checked="checked">
                            <span class="checkmark"></span>
                        </label>
                        <label class="d-check-sm"> 
                            ICSE
                            <input type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                        <label class="d-check-sm">
                            IGCSE
                            <input type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                        <label class="d-check-sm">
                            State Board
                            <input type="checkbox">
                            <span class="checkmark"></span>
                        </label> -->
                    </div>
                    <div class="col-sm-12 new-c-filter-block">
                        <h2>Grade</h2>
                        <ul class="searchbar">
                            <?php
                                echo $this->Form->select('grading_types', $gradingTypes, ['multiple' => 'checkbox', 
                                        'label' => ['class' => 'd-check-sm']]);
                            ?>
                        </ul>
                        <!-- <table class="check-table">
                            <tr>
                                <td>
                                    <label class="d-check-sm">
                                        3rd
                                        <input type="checkbox" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <label class="d-check-sm">
                                        8th
                                        <input type="checkbox" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="d-check-sm">
                                        4th
                                        <input type="checkbox" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <label class="d-check-sm">
                                        9th
                                        <input type="checkbox" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="d-check-sm">
                                        5th
                                        <input type="checkbox" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <label class="d-check-sm">
                                        10th
                                        <input type="checkbox" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="d-check-sm">
                                        6th
                                        <input type="checkbox" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <label class="d-check-sm">
                                        11th
                                        <input type="checkbox" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="d-check-sm">
                                        7th
                                        <input type="checkbox" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <label class="d-check-sm">
                                        12th
                                        <input type="checkbox" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                            </tr>
                        </table> -->
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
                    <div class="col-sm-12 searchbar">
                        <div class="input-group">
                          <input type="text" name="keyword" class="form-control" value="<?= $this->request->getQuery('keyword') ?>" placeholder="Search a Course...">
                          <span class="input-group-btn">
                            <button class="btn btn-default" id="keywordBtn" type="button"><i class="glyphicon glyphicon-search"></i></button>
                          </span>
                        </div>
                    </div>
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
echo $this->Html->script(['/assets/plugins/jquery-loading-overlay-master/dist/loadingoverlay.min'],['block' => true]);
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
            var newUrl = '<?= $this->Url->build(['controller' => 'Courses', 'action' => 'index'], ['fullBase' => true]) ?>?'+postData;
            window.history.pushState({path:newUrl},'',newUrl);
        }
       $coursesObj.getCourses({'url': '<?= $this->Url->build(['controller' => 'Courses', 'action' => 'getCourses']) ?>', postData: $("form#formElms").serialize() + "&keyword="+ $("input[name='keyword']").val()});
}

<?php $this->Html->scriptEnd(); ?>
</script>