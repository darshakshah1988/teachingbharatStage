<?php
$is_loginrequired = false;
if(!$this->request->getAttribute('identity')){
            $is_loginrequired = true;
}
?>
<section class="course_list_banner">
    <div class="container">
        <div class="col-sm-12 nopadding">
            <div class="col-sm-7 clb-texts">
                <h3>LIVE MASTER CLASSES</h3>
                <h2>ADVANCED LEARNIG WITH EASE</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>

            </div>
            <div class="col-sm-4 col-sm-offset-1">
                <?= $this->Html->image("new/master-class-banner.png", ['class' => 'img-full']) ?>
               <!--  <img src="Include/img/new/master-class-banner.png" class="img-full" /> -->
            </div>
        </div>
    </div>
</section>
    <div class="new-grey">
        <div class="container">
            <div class="col-sm-12 new-c-area">
                <div class="col-sm-3 new-c-filter">
                    <?= $this->Form->create(null, ['role' => 'form', 'enctype' => 'multipart/form-data', 'type' => 'get','valueSources' => ['query', 'context'], 'templates' => [
                        'checkboxWrapper' => '{{label}}',
                        'nestingLabel' => '<li><label{{attrs}}>{{text}}{{input}}<span class="checkmark"></span></label></li>',
                    ], 'id' => 'formElms']) ?>
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
                    <?= $this->Form->end() ?>
                </div>

                <div class="col-sm-9 new-c-list">
                    <div>
                      <!-- Nav tabs -->
                      <ul class="nav nav-tabs master_class_tab" role="tablist">
                        <li role="presentation"><a href="#live" aria-controls="live" role="tab" data-toggle="tab">Live Now</a></li>
                        <li role="presentation" class="active"><a href="#upcoming" aria-controls="upcoming" role="tab" data-toggle="tab">Upcoming</a></li>
                        <li role="presentation"><a href="#past" aria-controls="past" role="tab" data-toggle="tab">Past</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" id="loaderContaner" style="min-height: 250px;" class="tab-pane pad-t-20 active">
                            
                        </div>
                       <!--  <div role="tabpanel" id="loaderContaner" class="tab-pane active pad-t-20" id="upcoming">
                            
                        </div>
                        <div role="tabpanel" id="loaderContaner" class="tab-pane pad-t-20" id="past">
                           
                        </div> -->
                    </div>

                </div>
            </div>
        </div>
    </div>

<?php 
echo $this->Html->css(['master_class.css'],['block' => true]);
echo $this->Html->script(['/assets/plugins/jquery-loading-overlay-master/dist/loadingoverlay.min'],['block' => true]);
echo $this->Html->script(['common', 'Courses'], ['block' => true]); ?>
<script>
<?php $this->Html->scriptStart(['block' => true]); ?>

$('.nav-tabs a').on('shown.bs.tab', function (e) {
    if(history.pushState) {
        history.pushState(null, null, e.target.hash); 
    } else {
        window.location.hash = e.target.hash; //Polyfill for old browsers
    }
    getSessions();
})

$coursesObj = new Courses();
var commonMes = new common();
getSessions();
//
$(document).on("change", "form#formElms input", function(event) {
        event.preventDefault();
        getSessions();
});

$(document).on("click", "#keywordBtn", function(event) {
        event.preventDefault();
        getSessions();
});

$(document).on("keydown", "input[name='keyword']", function(e) {
        var code = e.keyCode || e.which;
        if(code == 13){
            getSessions();
        } 
});
$(document).on("click", ".loginrequired", function(event){
    event.preventDefault();
    var _this = $(this);
    $.confirm({ 
        title: '',
        columnClass: 'medium',
        content: 'You are not authorized to access that session. please login to register into session!!',
        buttons: {
              Ok: function(){
                  location.href = '<?= $this->Url->build(['controller' => 'Users', 'action' => 'login', 'plugin' => 'UserManager']) ?>?redirect=' + _this.data('redirect');
              }
          }
    });
});

$(document).on("click", ".joinSession", function(event){
    event.preventDefault();
    var _this = $(this);
    $coursesObj.joinSession({'url': _this.attr('href'), postData: {id : _this.data('id')}});
});

function getSessions(){
    let postData = $("form#formElms").serialize();
    var url = window.location.href;
    var activeTab = url.substring(url.indexOf("#") + 1);
    if(activeTab == "live" || activeTab == "upcoming" || activeTab == "past"){
        activeTab = activeTab;
    }else{
        var defaultTab = $("ul.master_class_tab li.active a").attr("aria-controls");
        activeTab = defaultTab;
    }
   
    if (history.pushState) {
           // var newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
            var newUrl = '<?= $this->Url->build(['controller' => 'Courses', 'action' => 'sessions'], ['fullBase' => true]) ?>?tab='+ activeTab + '&' + postData;
            window.history.pushState({path:newUrl},'',newUrl);
        }
       $coursesObj.getCourses({'url': '<?= $this->Url->build(['controller' => 'Courses', 'action' => 'getSessions']) ?>', postData: $("form#formElms").serialize() + "&tab="+ activeTab});
}
 
<?php $this->Html->scriptEnd(); ?>
</script>

<style type="text/css">
    #zmmtg-root{
        display:none;
    }
	body {
		overflow: scroll !important;
	}
</style>
<script src="https://source.zoom.us/1.8.6/lib/vendor/react.min.js"></script>
<script src="https://source.zoom.us/1.8.6/lib/vendor/react-dom.min.js"></script>
<script src="https://source.zoom.us/1.8.6/lib/vendor/redux.min.js"></script>
<script src="https://source.zoom.us/1.8.6/lib/vendor/redux-thunk.min.js"></script>
<script src="https://source.zoom.us/1.8.6/lib/vendor/lodash.min.js"></script>
<script src="https://source.zoom.us/zoom-meeting-1.8.6.min.js"></script>
<?php 
echo $this->Html->script(['/js/zoom/tool','/js/zoom/vconsole.min','/js/zoom/index']);?>