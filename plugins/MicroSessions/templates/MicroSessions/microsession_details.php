 <?php
 $this->layout = "microsessionfront";
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $microSession
 */
?>

 <?php

$totalchapt=count($microDetails['micro_session_chapters']);
$startDate=$microDetails['micro_session_chapters'][0]->start_date;
$endDate= $microDetails['micro_session_chapters'][$totalchapt-1]->end_date;

?>
<style>
.schedule-right-action, .schedule-right-action:focus {
    display: inline-block;
    float: right;
    margin-left: 15px;
    font-size: 12px;
    color: #ed4426;
    margin-top: 3px;
}
.complete{
    display:none;
}

.more{
    background:lightblue;
    color:navy;
    font-size:13px;
    padding:3px;
    cursor:pointer;
}
.viewDetailBtn{
    float: right;
    background: #F00;
    color: #FFF;
    padding: 3px 5px;
    vertical-align: middle;
    border-radius: 4px;
    font-size: 12px;
    font-weight: bold;
}
</style>
   <div class="White79" style="background: #e4e7ea">
    <div class="CourseBann">
        <div class="container">
            <div class="col-md-12 nopadding">
                <div class="col-md-7">
                    <h1><?= $microDetails->title?></h1>
                    <h5><span>Subject : <?= $microDetails->subject->title ?></span><span>Grade : <?= $microDetails->grading_type->title ?>th</span></h5>
                    <p>
                        <span>ABOUT THIS SESSION</span><br>
                        <br>
                        <?= $microDetails->description?>

                    </p>
                    <?php
                    if($alreadyPurchased == 0 && $this->getRequest()->getAttribute('identity')->role == "student"){
                    ?>
                    <?php echo $this->Html->link("Buy Now", ['controller' => 'MicroSessions', 'action' => 'buyNow', $microDetails->id], ['class' => 'mybtn mt10']) ?>
                <?php } ?>
                </div>
                <div class="col-md-4 col-md-offset-1">
                    <h6>Session Fee</h6>
                    <h2>₹ <?= (number_format($microDetails->price-$microDetails->discount_price,2))?>&nbsp;&nbsp; <?php if($microDetails->price != '' && $microDetails->price-$microDetails->discount_price < $microDetails->price){ ?><span class="no-price-cross" style="color: #999; font-size: 15px">₹ <?= number_format($microDetails->price,2) ?></span> <?php } ?></h2>
                    <div class="col-md-12 price">
                        <p><i class="glyphicon glyphicon-time"></i>Course Duration : <span><?=$microDetails->duration?> Hrs</span></p>
                        <p><i class="glyphicon glyphicon-play-circle"></i>Starts on : <span><?=$startdate=date('d,F',strtotime($startDate)); ?></span></p>
                        <p><i class="glyphicon glyphicon-play-circle"></i>Ends on : <span><?=$enddate=date('d,F',strtotime($endDate)); ?></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="col-md-12 MCContent">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-12" style="margin-bottom: 30px">
                        <div class="col-md-12 TeacherBox" style="margin: 0px">

                            <div class="col-md-6" style="padding-top: 20px">
                                <?php

                                    //echo "<pre>";
                                    //print_r($microDetails);
                                    //die;

                                        // dump($microDetails->user->image_path . $microDetails->user->profile_photo);
                                        $userPhoto = 'Authors/01.jpg';
                                         if (!empty($microDetails->user->photo_dir) && !empty($microDetails->user->profile_photo) && is_file(ROOT.DS.$microDetails->user->photo_dir . $microDetails->user->profile_photo)) {
                                            $userPhoto = $microDetails->user->photo_dir . $microDetails->user->profile_photo;
                                            $userPhoto = str_replace(DS,'/',$userPhoto);
                                        }
                                        ?>
                                        <img src="/<?php echo $userPhoto;  ?>" class="user-img">
                                <h3>
				<?= $this->Html->link($microDetails->user->first_name.' '.$microDetails->user->last_name, ['controller' => 'Users', 'action' => 'profile', 'plugin' => 'UserManager', $microDetails->user->id], ['class' => 'instru-name']) ?>


                               </h3>
                                <p><?= $teacher_profile->qualification.', '.$teacher_profile->college_university ?>


                                </p>
                                 <h4>Ratings :
                                <?php
                                for($s = 1; $s <= 5; $s++){

                                        if(isset($teacher_rating->rating) && $s <= round($teacher_rating->rating)){
                                            echo '<i class="glyphicon glyphicon-star"></i>';
                                        }else{
                                            echo '<i class="glyphicon glyphicon-star-empty" style=""></i>';
                                        }
                                 } ?></h4>

                                                        <h3 class="mt-10"><i class="fas fa-comment-dots mr-5"></i><strong class="mr-5"><?php //echo count($microDetails->user->reviews); ?></strong>
                                                        </h3>

                            </div>

                            <div class="col-md-6 cddata">
                                <!-- <div class="col-md-10 col-md-offset-2 box">
                                    <p>Batch Timing</p>
                                    <h4>7:30 pm - 8:30 pm</h4>
                                </div> -->
                                <div class="col-md-10 col-md-offset-2 box">
                                    <p>Classes conducted on</p>
                                <h4>
                                <span  <?php if($microDetails->monday!='1') { echo "class='off'"; } ?>>M</span>
                                <span  <?php if($microDetails->tuesday!='1') { echo "class='off'"; } ?>>T</span>
                                <span  <?php if($microDetails->wednesday!='1') { echo "class='off'" ;} ?>>W</span>
                                <span  <?php if($microDetails->thursday!='1') { echo "class='off'"; } ?>>T</span>
                                <span  <?php if($microDetails->friday!='1') { echo "class='off'"; } ?>>F</span>
                                <span  <?php if($microDetails->saturday!='1') { echo "class='off'"; } ?>>S</span>
                                <span  <?php if($microDetails->sunday!='1') { echo "class='off'"; } ?>>S</span>
                                </h4>
                                </div>

                                <?php
                                if($alreadyPurchased == 0 && $this->getRequest()->getAttribute('identity')->role == "student"){
                                ?>
                                    <div class="col-md-8 col-md-offset-2 box">
                                        <?php echo $this->Html->link("ENTROLL NOW", ['controller' => 'MicroSessions', 'action' => 'buyNow', $microDetails->id], ['class' => 'call-on-btn-2']) ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-md-12 schmain">
                            <div class="col-md-12 nopadding">
                               <?php



                                foreach ($microDetails['micro_session_chapters'] as $loop => $chap):

                                    ?>
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

                                <div class="col-md-12 flex mb15">
                                    <div class="col-xs-2 datesche">
                                        <h3><?= date('d', strtotime($chap->start_date));?></h3>
                                            <p><?= date('M', strtotime($chap->start_date));?></p>
                                            <p><?= date('h:i A', strtotime($chap->start_time));?> - <?= date('h:i A', strtotime($chap->end_time));?></p>

                                    </div>
                                    <div class="col-xs-10 txtsche">
                                        <p><span></span><?= $chap->title ?></p>
                                        <p><span>By:</span> <?= $this->Html->link($microDetails->user->first_name.' '.$microDetails->user->last_name, ['controller' => 'Users', 'action' => 'profile', 'plugin' => 'UserManager', $microDetails->user->id], ['class' => 'instru-name']) ?></a>

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
                                         </p>
                                    </div>

                                </div>
                                 <?php

                            endforeach; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <h4>Recommended Courses</h4>
                <?php

                //echo "<pre>";
                //print_r($courses);
                //die;

                       $count=0;
                foreach ($courses as $course): ?>
                <div class="col-md-12 nopadding coursebox1 micro-courses-box bg-white">
                    <div class="col-md-12 nopadding">
                        <?php echo $this->Html->image('micro-courses/samplebanner.jpg', ['class' => 'micro-courses-list-banner']) ?>

                    </div>
                    <div class="col-md-12 area">
                        <h2 class="micro-list-title"><?=$course->title ?></h2>
                        <ul>
                            <li><i class="glyphicon glyphicon-menu-hamburger"></i><strong><?=$course->grading_type_id ?>th Grade</strong></li>
                            <li><i class="glyphicon glyphicon-bookmark"></i><?= $course->title ?></li>
                            <li><span>&nbsp;₹</span><?=(number_format($course->price-$course->discount_price, 2)) ?>
                                <?php if($course->price != '' && $course->price-$course->discount_price < $course->price): ?>
                                <span class="no-price-cross">₹ <?=($course->price) ?>&nbsp;</span>
                            <?php endif;?>
                            <?= $this->Html->link('View Details >>', ['plugin' => 'Courses','controller' => 'Courses', 'action' => 'view', $course->id], ['class' => 'viewDetailBtn']) ?>
                            </li>
                        </ul>
                    </div>

                </div>
                <?php
                 $count++;
                 if($count==2):
                  break;
                  endif;
                  endforeach; ?>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
$(document).on("click", "#completeSession", function(event){
    $('#sessionCompletedMsg').modal('show');
});
$(document).ready(function(){
    $(".more").toggle(function(){
    $(this).text("less..").siblings(".complete").show();
}, function(){
    $(this).text("more..").siblings(".complete").hide();
});
});
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
