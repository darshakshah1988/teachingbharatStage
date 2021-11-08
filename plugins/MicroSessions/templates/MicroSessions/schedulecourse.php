<?php
//$this->layout = "microsessionfront";
$this->layout = "authdefault";
/**
* @var \App\View\AppView $this
* @var \Cake\Datasource\EntityInterface $microSession
*/
?>
<?php
echo $this->Html->css([
    'bootstrap.css',
    'micro/Dstyle.css'
]);
$totalchapt=count($microDetails['micro_session_chapters']);
$startDate= isset($microDetails['micro_session_chapters'][0]->start_date)?$microDetails['micro_session_chapters'][0]->start_date:'';
$endDate= isset($microDetails['micro_session_chapters'][0]->end_date)?$microDetails['micro_session_chapters'][$totalchapt-1]->end_date:'';

echo $this->Html->css(['/css/purchased_courses.css'],['block' => true]);


//echo "<pre>";
//print_r($microDetails); die;


?>
<div class="schedule-course-header">
    <div class="container">
        <div class="col-sm-9">
            <h2><?php echo $microDetails['title'];?></h2>
            <p><i class="glyphicon glyphicon-calendar"></i>Stats on <strong>
                <?php echo date('dS M', strtotime($startDate));?> </strong> - <strong>
                    <?php echo date('dS M', strtotime($endDate));?></strong></p>
                    <p><i class="glyphicon glyphicon-time"></i>Duration <strong><?php echo $microDetails['duration'];?> Hrs</strong> - <strong>
                        <?php if($microDetails['monday']==1){
                            echo "MON, ";
                        }
                        if($microDetails['tuesday']==1){
                            echo "TUE, ";
                        }
                        if($microDetails['wednesday']==1){
                            echo "WED, ";
                        }
                        if($microDetails['thursday']==1){
                            echo "THU, ";
                        }
                        if($microDetails['friday']==1){
                            echo "FRI, ";
                        }
                        if($microDetails['saturday']==1){
                            echo "SAT, ";
                        }
                        if($microDetails['sunday']==1){
                            echo "SUN";
                        }
                        ?></strong></p>
                    </div>
                    <?php
                    $userDetails= $microDetails['user'];
                    ?>
                    <div class="col-sm-3 schedule-course-header-teacher" >
                        <h3>Taught by</h3>
                        <?php
                        if (!empty($userDetails->photo_dir) && !empty($userDetails->profile_photo) && file_exists("img/".$userDetails->photo_dir . $userDetails->profile_photo)) {
                            $userPhoto = $userDetails->photo_dir . $userDetails->user->profile_photo;
                        }else{
                            $userPhoto = 'Authors/01.jpg';
                        }

                        echo $this->Html->image($userPhoto, ['class' => 'schteacher'])?>

                        <h4><?= $this->Html->link($userDetails->first_name.' '.$userDetails->last_name, ['action' => 'teachersession', $userDetails->id], ['class' => 'name']) ?></h4>
                        <p><a href="#" data-toggle="modal" data-target="#bookNowPopup" class="btn btn-xs btn-dss">Book Now</a></p>
                    </div>

                </div>
            </div>
            <div class="student-schedule-tab-bar">
                <div class="container">
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#Assign" aria-controls="Assign" role="tab" data-toggle="tab">Schedule</a></li>
                            <li role="presentation"><a href="#content" aria-controls="content" role="tab" data-toggle="tab">CONTENT</a></li>
                            <li role="presentation"><a href="#test" aria-controls="test" role="tab" data-toggle="tab">TEST</a></li>
                            <li role="presentation"><a href="#myprogress" aria-controls="myprogress" role="tab" data-toggle="tab">MY PROGRESS</a></li>
                            <li role="presentation"><a href="#Generated" aria-controls="Generated" role="tab" data-toggle="tab">FAQs</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-md-12 Testarea mt30">
                        <div class="col-md-12 ">
                            <div>
                                <div class="tab-content mt10">

                                    <div role="tabpanel" class="tab-pane active" id="Assign">
                                        <div class="col-sm-8">
                                            <!-- <div class="row">
                                            <div class="col-sm-5 col-sm-offset-7 searchbar mb-20">
                                            <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search from past sessions">
                                            <span class="input-group-btn">
                                            <button class="btn btn-default" type="button"><i class="glyphicon glyphicon-search"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>--->
                            <!--   <div class="col-sm-12 schedule-session-message">
                            <h3>You have no upcoming classes</h3>
                        </div> -->
                        <div class="col-md-12 schmain pad-0-l-r">
                            <div class="col-md-12 nopadding">
                                <?php
                                $loop = 0;
                                foreach ($microDetails['micro_session_chapters'] as $chap): ?>
                                <div class="col-md-12 flex mb15">
                                    <div class="col-xs-2 datesche">
                                        <h3><?= date('d', strtotime($chap->start_date));?></h3>
                                        <p><?= date('M', strtotime($chap->start_date));?></p>
                                        <p><?= date('h:i A', strtotime($chap->start_time));?> - <?= date('h:i A', strtotime($chap->end_time));?></p>
                                    </div>
                                    <div class="col-xs-10 txtsche">
                                        <p><span></span><?=$chap->title;?></p>
                                        <p><span>By:</span> <a href="#" class="theme-link-a">Teacher Name</a>
                                            <input type="hidden" name="display_name" id="display_name_<?= $loop ?>" value="<?= $this->request->getSession()->read('Auth.User.name') ?>">
                                            <input type="hidden" name="meeting_number" id="meeting_number_<?= $loop ?>" value="88982625484">
                                            <input type="hidden" name="meeting_pwd" id="meeting_pwd_<?= $loop ?>" value="00752">
                                            <input type="hidden" name="meeting_email" id="meeting_email_<?= $loop ?>" value="<?= $this->request->getSession()->read('Auth.User.email') ?>">

                                            <select id="meeting_role_<?= $loop ?>" class="sdk-select" style="display: none;">
                                                <option value=0 <?= ($this->request->getSession()->read('Auth.User.role') == 'student')?'selected':'' ?>>Attendee</option>
                                                <option value=1 <?= ($this->request->getSession()->read('Auth.User.role') == 'teacher')?'selected':'' ?>>Host</option>
                                                <option value=5>Assistant</option>
                                            </select>
                                            <select id="meeting_china_<?= $loop ?>" class="sdk-select" style="display: none;">
                                                <option value=0 selected>Global</option>
                                                <option value=1>China</option>
                                            </select>
                                            <select id="meeting_lang_<?= $loop ?>" class="sdk-select" style="display: none;">
                                                <option value="en-US" selected>English</option>
                                                <option value="de-DE">German Deutsch</option>
                                                <option value="es-ES">Spanish Español</option>
                                                <option value="fr-FR">French Français</option>
                                                <option value="jp-JP">Japanese 日本語</option>
                                                <option value="pt-PT">Portuguese Portuguese</option>
                                                <option value="ru-RU">Russian Русский</option>
                                                <option value="zh-CN">Chinese 简体中文</option>
                                                <option value="zh-TW">Chinese 繁体中文</option>
                                                <option value="ko-KO">Korean 한국어</option>
                                                <option value="vi-VN">Vietnamese Tiếng Việt</option>
                                                <option value="it-IT">Italian italiano</option>
                                            </select>


                                            <!--  <a class="schedule-right-action" href="#"><i class="glyphicon glyphicon-repeat"></i>Replay</a>
                                            <a class="schedule-right-action" href="#"><i class="glyphicon glyphicon-list-alt"></i>Get Notes</a></p> -->
                                            <?php
                                            $sessonEnd = strtotime($chap->start_date.' '.$chap->end_time);
                                            $currentTime = time();
                                            if($sessonEnd > $currentTime){
                                                ?>
                                                <a class="schedule-right-action joinSession" href="javascript:void(0)" id="joinSession" ><i class="glyphicon glyphicon-off"></i>Join Session</a>
                                                <?php
                                            }else{
                                                ?>
                                                <a class="schedule-right-action completeSession" href="javascript:void(0)" id="completeSession" ><i class="glyphicon glyphicon-off"></i>Join Session</a>
                                                <?php
                                            }
                                            ?>

                                        </div>
                                    </div>
                                    <?php $loop++; endforeach; ?>
                                    <!--<div class="col-sm-12 text-center mt-20">
                                    <a href="#" class="my-btn-ft">Load More</a>
                                </div>-->
                            </div>
                        </div>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane" id="Generated">
                    <div class="col-sm-8">
                        <div class="col-sm-12">
                            <p><?= $microDetails->faq; ?></p>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="content">
                    <div class="col-sm-8">
                        <div class="col-sm-12">
                            <h4><?= $microDetails->short_description; ?></h4>
                            <p><?= $microDetails->description; ?></p>
                        </div>
                    </div>
                </div>



                <div role="tabpanel" class="tab-pane" id="test">
                    <div class="col-sm-8">
                        <div class="col-sm-12">
                            Records are not available.
                        </div>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane" id="myprogress">
                    <div class="col-sm-8">
                        <div class="col-sm-12">
                            <div class="col-sm-12 schedule-session-message">
                                <h3>My Progress.</h3>
                            </div>
                            <?php
                            $totalChapters = $upcomingChapters = $completedChapters =0;
                            if(isset($microDetails['micro_session_chapters']) && count($microDetails['micro_session_chapters']) > 0){
                                $totalChapters = count($microDetails['micro_session_chapters']);
                            }
                            foreach($microDetails['micro_session_chapters'] as $chapterData){
                                $currentTime = time();
                                $startTime = strtotime($chap->start_date.' '.$chap->start_time);
                                $endTime = strtotime($chap->end_date.' '.$chap->end_time);
                                if($startTime > $currentTime){
                                    $upcomingChapters = $upcomingChapters+1;
                                }
                                if($endTime < $currentTime){
                                    $completedChapters = $completedChapters+1;
                                }
                            }
                            ?>
                            <div class="col-md-12 schmain pad-0-l-r">
                                <div class="col-md-12 nopadding">
                                    <div class="col-md-12 flex mb15">
                                        <div class="col-xs-4 datesche">
                                            <h3><?php echo $totalChapters; ?></h3>
                                            <p>Total Chapters</p>
                                        </div>
                                        <div class="col-xs-8 txtsche">
                                            <p style="vertical-align:middel;"><span>Upcoming:</span> <span style="font-size:22px; font-weight:bold;"> <?= $upcomingChapters; ?></span></p>
                                            <p style="vertical-align:middel;"><span>Completed:</span> <span style="font-size:22px; font-weight:bold;"> <?= $completedChapters; ?></span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4 schedule-right-section">
                    <h4>MicroSession Features</h4>
                    <?php echo $microDetails['short_description'];?>
                </div>
            </div>
        </div>

    </div>
</div>

</div>
</div>
<?php
$loginUserName = @$this->getRequest()->getAttribute('identity')->first_name.' '.@$this->getRequest()->getAttribute('identity')->last_name;
$loginEmail = @$this->getRequest()->getAttribute('identity')->email;
$loginID = @$this->getRequest()->getAttribute('identity')->id;
?>
<div class="modal fade" id="bookNowPopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content DModal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Book Now</h4>
            </div>
            <div class="modal-body">
                <?= $this->Form->create(null, [ 'novalidate' => true, 'id' => 'bookNowForm']); ?>
                <?= $this->Form->hidden('teacher_id', ['value' => $userDetails->id]);  ?>
                <?= $this->Form->hidden('user_id', ['value' => $loginID]);  ?>
                <div class="row">
                    <div class="col-sm-12 Date">
                        <h2><?= $this->Html->link($userDetails->first_name.' '.$userDetails->last_name, ['action' => 'teachersession', $userDetails->id], ['class' => 'name popupTitle']) ?></h2>
                    </div>
                    <div id="bookoNowForm" style="display:block;">
                        <div class="col-sm-12 SesDetatils">
                            <div class="col-sm-6">
                                <h2>Name*</h2>
                                <p><input type="text" class="form-control" name="userName" id="userName" value="<?= $loginUserName; ?>" required></p>
                            </div>
                            <div class="col-sm-6">
                                <h2>Email Address*</h2>
                                <p><input type="text" class="form-control" name="userEmailAddress" id="userEmailAddress" value="<?= $loginEmail; ?>" required></p>
                            </div>

                            <div class="col-sm-6">
                                <h2>Contact Number*</h2>
                                <p><input type="text" class="form-control" name="userContactNumber" id="userContactNumber" value="" required></p>
                            </div>
                            <div class="col-sm-12">
                                <h2>Message</h2>
                                <p><textarea type="text" class="form-control" name="userMessage" id="userMessage"></textarea></p>
                            </div>
                        </div>
                        <div class="col-sm-12 action">
                            <div class="col-sm-5">
                                <a href="javascript:void(0);" class="red bookNowButton">SUBMIT</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="sessionCompletedMsg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content DModal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Alert!</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 Date">
                        <p>This session has been completed.</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php
echo $this->Html->css(['master_class.css'],['block' => true]);
echo $this->Html->script(['/assets/plugins/jquery-loading-overlay-master/src/loadingoverlay.min'],['block' => true]);
echo $this->Html->script(['common', 'Courses'], ['block' => true]); ?>
<script>
<?php $this->Html->scriptStart(['block' => true]); ?>
$coursesObj = new Courses();
$(document).on("click", ".joinFree", function(event){
    event.preventDefault();
    var _this = $(this);
    $coursesObj.joinSession({'url': _this.attr('href'), postData: {id : _this.data('id')}});
});
$(document).on("click", "#completeSession", function(event){
    $('#sessionCompletedMsg').modal('show');
});
var frmSubmitted = 0;
$(document).ready(function(){
    $('.bookNowButton').click(function(){
        var flag = 0;
        if(frmSubmitted == 0){
            if($.trim($('#userName').val()) == ""){
                alert('Please enter your name');
                $('#userName').focus();
                frmSubmitted = 0;
                flag = 1; return false;
            }
            if($.trim($('#userEmailAddress').val()) == ""){
                alert('Please enter your email address');
                $('#userEmailAddress').focus();
                frmSubmitted = 0;
                flag = 1; return false;
            }
            if($.trim($('#userContactNumber').val()) == ""){
                alert('Please enter your contact number');
                $('#userContactNumber').focus();
                frmSubmitted = 0;
                flag = 1; return false;
            }
            if(flag == 0){
                $(this).html('Processing...');
                frmSubmitted = 1;
                $.ajax({
                    type: 'POST',
                    url: '<?= $this->Url->build('/micro-sessions/micro-sessions/send-book-now-request')?>',
                    data: $('#bookNowForm').serialize(),
                    success: function(msg){
                        if(msg == 'Success'){
                            frmSubmitted = 0;
                            $('#bookoNowForm').html('<div class="col-sm-12"><div class="alert alert-success">Your booking request has been sent successfully.</div></div>');
                        }else{
                            $('#bookoNowForm').html('<div class="col-sm-12"><div class="alert alert-danger">Some thing want to wrong, please try after sometime.</div></div>');
                        }
                        setTimeout(function(){location.reload();},5000);
                    }
                });
            }
        }
    });
    $('#bookNowPopup').on('hidden.bs.modal', function (e) {
        $('.bookNowButton').html('Submit');
        frmSubmitted = 0;
    })
});
<?php $this->Html->scriptEnd(); ?>
</script>

<style type="text/css">
#zmmtg-root{
    display:none;
}
body {
    overflow: scroll !important;
}
a.btn-dss {
    background: linear-gradient(
        -45deg
        , #e8023d, #ed4b26);
        padding: 5px 15px;
        color: #fff;
        transition: 0.4s;
    }
    /*.Testarea .TestTable1 {
    background: #fff;
    border-top: 4px solid #ed4426;
    padding: 15px;
    }*/
</style>
<script src="https://source.zoom.us/1.8.6/lib/vendor/react.min.js"></script>
<script src="https://source.zoom.us/1.8.6/lib/vendor/react-dom.min.js"></script>
<script src="https://source.zoom.us/1.8.6/lib/vendor/redux.min.js"></script>
<script src="https://source.zoom.us/1.8.6/lib/vendor/redux-thunk.min.js"></script>
<script src="https://source.zoom.us/1.8.6/lib/vendor/lodash.min.js"></script>
<script src="https://source.zoom.us/zoom-meeting-1.8.6.min.js"></script>
<?php
echo $this->Html->script(['/js/zoom/tool','/js/zoom/vconsole.min','/js/zoom/index']);?>
