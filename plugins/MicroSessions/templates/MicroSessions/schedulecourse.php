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
$startDate=$microDetails['micro_session_chapters'][0]->start_date;
$endDate= $microDetails['micro_session_chapters'][$totalchapt-1]->end_date;

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

       <div class="container-fluid">
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
                                            <p><?= date('H:i', strtotime($chap->start_time));?> - <?= date('H:i A', strtotime($chap->end_time));?></p>
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
                                             <a class="schedule-right-action joinSession" href="javascript:void(0)" id="joinSession" ><i class="glyphicon glyphicon-off"></i>Join Session</a>
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
                            <div class="row">

                                    <p><?=$microDetails->faq;?></p>

                                </div>
                            </div>
                                </div>
                                   <div role="tabpanel" class="tab-pane" id="content">
                                    <div class="col-sm-8">
                            <div class="row">



                                </div>
                            </div>
                                </div>
                                   <div role="tabpanel" class="tab-pane" id="test">
                                    <div class="col-sm-8">
                            <div class="row">



                                </div>
                            </div>
                                </div>
                                   <div role="tabpanel" class="tab-pane" id="myprogress">
                                    <div class="col-sm-8">
                            <div class="row">



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


<?php
echo $this->Html->css(['master_class.css'],['block' => true]);
echo $this->Html->script(['/assets/plugins/jquery-loading-overlay-master/dist/loadingoverlay.min'],['block' => true]);
echo $this->Html->script(['common', 'Courses'], ['block' => true]); ?>
<?php $this->Html->scriptStart(['block' => true]); ?>
$coursesObj = new Courses();
$(document).on("click", ".joinFree", function(event){
    event.preventDefault();
    var _this = $(this);
    $coursesObj.joinSession({'url': _this.attr('href'), postData: {id : _this.data('id')}});
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
