<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $course
 */
 use Cake\Routing\Router;
?>
<section class="master_class_header">
    <div class="container">
        <div class="col-sm-10 col-sm-offset-1 master-detail-top-text">
            <h5><span>FREE</span> LIVE ONLINE MASTERCLASS</h5>
            <h2><?= $course->title ?></h2>
            <?php 
            $allowCounter = true;
            if($course->order_courses && !empty($course->order_courses)){ 
                $allowCounter = false;
             } 
             ?>
            <div class="col-sm-6 col-sm-offset-3 master-counter" style="<?= $allowCounter ? "display:none;" : "" ?>">
			<?php 
			if($course->no_of_seats > count($course->order_courses)) {
				$leftSeats = $course->no_of_seats - count($course->order_courses);
			?>
                <h6>Filling fast! Last <?php echo $leftSeats ?> <?php 
				if($leftSeats > 1) {
					echo 'Seats';
				} else {
					echo 'Seat';
				}
				?> left.</h6>
			<?php 
			} else {
			?>
				<h6>Slot full. No seats left.</h6>
			<?php 
			}
			?>
                <h2 id="startTimeCounter"></h2>
            </div>
            
        </div>
        <div class="col-sm-10 col-sm-offset-1 master-detail-top-box">
            <?php 
			$loop = 0;
                // dump($course->user->image_path . $course->user->profile_photo);
                 if (!empty($course->user->image_path) && !empty($course->user->profile_photo) && file_exists("img/".$course->user->image_path . $course->user->profile_photo)) { 
                    $userPhoto = $course->user->image_path . $course->user->profile_photo;
                }else{
                    $userPhoto = 'Authors/01.jpg';
                }

                echo $this->Html->image($userPhoto, ['class' => 'master-detail-top-box-profile'])?>
            <div class="col-sm-12">
                <h5><?= $course->title ?></h5>
                <h3><?= $course->user->name ?><span><?= $course->user->user_profile->qualification ?>, <?= $course->user->user_profile->college_university ?></span></h3>
                <ul class="master-detail-top-box-bullets">
                    <li><?= $course->user->user_profile->experience ?> experience</li>
                    <?php if(!empty($course->user->user_profile->achievement)){ ?>
                        <li><?= $course->user->user_profile->achievement ?></li>
                    <?php } ?>
                    <?php if(!empty($course->user->user_profile->other_achievement)){ ?>
                        <li><?= $course->user->user_profile->other_achievement ?></li>
                    <?php } ?>
                    <?php if(!empty($course->user->user_profile->digital_experience)){ ?>
                        <li><?= $course->user->user_profile->digital_experience ?></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="row">
                <div class="col-sm-12 master-detail-top-box-bottom">
                    <div class="col-sm-4">
                        <h3><?= $course->start_date->format('D dS M, H:i A') ?> </h3>
                    </div>
                    <div class="col-sm-4">
                        <h3>Grade - <?= $course->grading_type->title ?></h3>
                    </div>
                    <div class="col-sm-4">
                        <?php
                        if($course->end_date > date('Y-m-d H:i:s') && $course->start_date<=date('Y-m-d H:i:s')){
							
                        if(empty($course->order_courses)){
                             if($this->request->getAttribute('identity')){
                                if($course->user_id != $this->getRequest()->getAttribute('identity')->id){
                                    echo $this->Html->link('Register for Free', ['plugin' => 'Orders', 'controller' => 'Orders', 'action' => 'sessionBooking', $course->id], ['escape' => false, 'class' => 'tb-btn-md joinSession', 'data-id' => $course->id]);  
                                }else{
                                    //echo $this->Html->link('Join', ['plugin' => 'Courses', 'controller' => 'Courses', 'action' => 'joinSession', $course->id], ['escape' => false, 'class' => 'tb-btn-md showJoinButton', 'data-id' => $course->id]);
                                }
                                
                            }else{
                                echo $this->Html->link('Register for Free', ['plugin' => 'Orders', 'controller' => 'Orders', 'action' => 'sessionBooking', $course->id], ['escape' => false, 'class' => 'tb-btn-md loginrequired joinSessionHide', 'data-id' => $course->id]);  
                            }  
                        }else if(!empty($course->meetings)){
							?>
							<input type="hidden" name="display_name" id="display_name_<?= $loop ?>" value="<?= $this->request->getSession()->read('Auth.User.name') ?>">
							<input type="hidden" name="meeting_number" id="meeting_number_<?= $loop ?>" value="<?= $course->meetings[0]->meeting_id ?>">
							<input type="hidden" name="meeting_pwd" id="meeting_pwd_<?= $loop ?>" value="<?= $course->meetings[0]->password ?>">
							<input type="hidden" name="meeting_email" id="meeting_email_<?= $loop ?>" value="<?= $this->request->getSession()->read('Auth.User.email') ?>">
							<input type="hidden" name="meeting_url" id="meeting_url_<?= $loop ?>" value="<?php echo Router::url(null, true) ?>">
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
							<a href="javascript:void(0)" id="joinSession" class="tb-btn-md joinSession"> Join Session</a>
							<?php
                             //echo $this->Html->link('Register for Free', ['plugin' => 'Orders', 'controller' => 'Orders', 'action' => 'sessionBooking', $course->id], ['escape' => false, 'class' => 'tb-btn-md loginrequired joinSessionHide', 'data-id' => $course->id]);  
                        }
                       // echo $this->Html->link('Join Session', ['plugin' => 'Courses', 'controller' => 'Courses', 'action' => 'joinSession', $course->id], ['escape' => false,'style' => 'display:none;', 'class' => 'tb-btn-md showJoinButton', 'data-id' => $course->id]);  
                    } else {
						if(!empty($course->order_courses)){
							echo $this->Html->link('Already Registered ',"javascript:void(0)", ['escape' => false, 'class' => 'tb-btn-md']);	
						}  else {
							echo $this->Html->link('Join for Free', ['plugin' => 'Orders', 'controller' => 'Orders', 'action' => 'sessionBooking', $course->id], ['escape' => false, 'class' => 'tb-btn-md joinSession', 'data-id' => $course->id]);
						}
					}
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="master_class_body">
    <div class="container">
        <?php if(!empty($course->description)){ ?>
            <div class="col-sm-10 col-sm-offset-1">
                <h3 class="master-title-3 text-center">What you will learn</h3>
                <?php $learns = explode(";", $course->what_learn);
                if(!empty($learns)){
                 ?>
                <ul class="master-bullets-1">
                    <?php foreach($learns as $lrn){ 
                        if(!empty(trim($lrn))){
                        ?>
                    <li><?= trim($lrn) ?></li>
                    <?php } 
                        }
                    ?>
                </ul>
                <div class="clearfix"></div>
                <?php } ?>
                 <p class="mt40 text-center"><?= $course->description ?></p>
            </div>
        <?php } ?>
    </div>
</section>

<?php if(!empty($interstes->toArray())){ ?> 
<section class="master_class_bottom">
     <div class="container"> 
        <div class="col-sm-12">
            <h3 class="master-title-3 text-center mt0">YOU MIGHT ALSO BE INTERESTED IN</h3>
            <?php foreach ($interstes as $interste): ?>
            <div class="col-sm-4">
                <div class="col-sm-12 master-class-box">
                    <h2><?= $this->Html->link($interste->title, ['plugin' => 'Courses', 'controller' => 'Courses', 'action' => 'sessionDetail', $interste->id], ['escape' => false]); ?></h2>
                    <h5>Gread <?= $interste->grading_type->title ?> <span><?= $interste->start_date->format('D dS M, H:i A') ?></span></h5>
                    <table class="mcb-details">
                        <tr>
                            <td>
                                <?php 
                                // dump($interste->user->image_path . $interste->user->profile_photo);
                                 if (!empty($interste->user->image_path) && !empty($interste->user->profile_photo) && file_exists("img/".$interste->user->image_path . $interste->user->profile_photo)) { 
                                    $userPhoto = $interste->user->image_path . $interste->user->profile_photo;
                                }else{
                                    $userPhoto = 'Authors/01.jpg';
                                }

                                echo $this->Html->image($userPhoto, ['class' => 'user-img'])?>
                            </td>
                            <td>
                                <p>Teaching By</p>
                                <h4><?= $interste->user->name ?></h4>
                            </td>
                            <td class="text-right">
                                <p><span><?= $interste->user->user_profile->primary_subject->title ?> & <?= $interste->user->user_profile->secondary_subject->title ?> Expert</span></p>
                                <h6><?= $interste->user->user_profile->qualification ?>, <?= $interste->user->user_profile->college_university ?></h6>
                            </td>
                        </tr>
                    </table>
                    <hr> 
                    <table class="master-class-box-footer">
                        <tr>
                            <td><!--<h3>642 Watching..</h3>--></td>
                            <!--<td class="text-right">
                                <?php 
                                   if(!$this->request->getAttribute('identity')){
                                    echo $this->Html->link('Join For Free <i class="glyphicon glyphicon-menu-right"></i>', 'javascript:void(0);', ['escape' => false, 'class' => 'tb-btn-md loginrequired', 'data-redirect' => $this->Url->build(['controller' => 'Courses', 'action' => 'sessionDetail', 'plugin' => 'Courses', $interste->id],['fullBase' => true])]);
                                    }else{
                                        if(empty($interste->order_courses)){
                                            echo $this->Html->link('Join For Free <i class="glyphicon glyphicon-menu-right"></i>', ['plugin' => 'Orders', 'controller' => 'Orders', 'action' => 'sessionBooking', $interste->id], ['escape' => false, 'class' => 'tb-btn-md joinSession', 'data-id' => $interste->id]);
                                        }else{
                                            echo $this->Html->link('Join <i class="glyphicon glyphicon-menu-right"></i>', ['plugin' => 'Courses', 'controller' => 'Courses', 'action' => 'joinSession', $interste->id], ['escape' => false,'style' => '', 'class' => 'tb-btn-md', 'data-id' => $interste->id]);  
                                        }
                                    }
                                
                                 ?> 
                            </td>-->
                        </tr>
                    </table>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div> 
</section>
<?php } ?>

<?php if($course->session_reviews && !empty($course->session_reviews)){ ?>
<section class="master_class_testi">
    <div class="container">
        <div class="col-sm-12">
            <h3 class="master-title-3 text-center mt0">
            WHAT STUDENTS HAVE SAID ABOUT OUR PREVIOUS MASTER CLASSES</h3>
            <?php foreach($course->session_reviews as $review){ ?>
            <div class="col-sm-6">
                <div class="col-sm-12 master-testimonial-box">
                    <div class="col-xs-3 text-center">
                        <?php 
                            // dump($course->user->image_path . $course->user->photo);
                             if (!empty($review->photo_path) && !empty($review->photo) && file_exists("img/".$review->photo_path . $review->photo)) { 
                                $userPhoto = $review->photo_path . $review->photo;
                            }else{
                                $userPhoto = 'Authors/01.jpg';
                            }
                            echo $this->Html->image($userPhoto, ['class' => '']);
                        ?>
                    </div>
                    <div class="col-xs-9">
                        <h3><?= $review->name ?></h3>
                        <h5><?= $review->designation ?> - <?= $review->location ?></h5>
                        <p><?= $review->description ?></p>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>
    </div>
</section>
<?php } ?>

<?php
$this->assign('title', $course->title);
$this->Html->meta(
    'keywords', "Teaching Bharat | Online course | online education | online video", ['block' => true]
);
$this->Html->meta(
    'description', $course->short_description, ['block' => true]
);
?>
<?php 
echo $this->Html->css(['master_class.css'],['block' => true]);
echo $this->Html->script(['/assets/plugins/jquery-loading-overlay-master/dist/loadingoverlay.min'],['block' => true]);
echo $this->Html->script(['common', 'Courses'], ['block' => true]); 
echo $this->Html->css(['/assets/plugins/countdownTimer/src/css/jQuery.countdownTimer.css'], ['block' => true]);
echo $this->Html->script(['/assets/plugins/countdownTimer/src/js/jQuery.countdownTimer.js'], ['block' => true]);
?>

<style type="text/css">
    #zmmtg-root{
        display:none;
    }
	#joinSession {
		display:block !important; 
	}
	body {
		overflow: scroll !important;
	}
</style>
<script>
<?php $this->Html->scriptStart(['block' => true]); ?>
$coursesObj = new Courses();
$(document).on("click", ".joinSession", function(event){
    event.preventDefault();
    var _this = $(this);
    $coursesObj.joinSession({'url': _this.attr('href'), postData: {id : _this.data('id')}}); 
});


$("#startTimeCounter").countdowntimer({
          dateAndTime : "<?php echo $course->start_date->format('Y/m/d'); ?> <?php echo $course->start_date->format('H:i:s'); ?>",
          size : "",
          fontColor : "#FFC107",
          borderColor : "rgba(0, 0, 0, 0)",
          backgroundColor : "rgba(0, 0, 0, 0)",
          //regexpMatchFormat: "([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})"‚
          //regexpReplaceWith: "$1<sup>days</sup> / $2<sup>hours</sup> / $3<sup>minutes</sup> / $4<sup>seconds</sup>",
          timeUp : timeIsUpm,
         //expiryUrl : "<?php //echo $this->Url->build(['plugin' => 'Courses', 'controller' => 'Courses', 'action' => 'joinSession', $course->id]); ?>"
        });
function timeIsUpm() {
    // Simulate a mouse click:
    <?php if($this->request->getAttribute('identity')){ ?>
    //window.location.href = "<?php //echo $this->Url->build(['plugin' => 'Courses', 'controller' => 'Courses', 'action' => 'joinSession', $course->id]); ?>";
<?php } ?>
    //console.log("join", "<?= $allowCounter?>");
    <?php if(!$allowCounter){ ?> 
         $(".showJoinButton").show();
         $(".joinSession").hide();
         $(".joinSessionHide").hide();
     <?php }else{ ?>
        $(".showJoinButton").hide();
         $(".joinSession").show();
         $(".joinSessionHide").show();
     <?php } ?>
}

$(document).on("click", ".loginrequired", function(event){
    event.preventDefault();
    var _this = $(this);
    $.confirm({ 
        title: '',
        columnClass: 'medium',
        content: 'You are not authorized to access that session. please login to register into session!!',
        buttons: {
              Ok: function(){
                  location.href = '<?= $this->Url->build(['controller' => 'Users', 'action' => 'login', 'plugin' => 'UserManager']) ?>?redirect=<?= $this->Url->build(['controller' => 'Courses', 'action' => 'sessionDetail', 'plugin' => 'Courses', $course->id],['fullBase' => true]) ?>';
              }
          }
    });
});
<?php $this->Html->scriptEnd(); ?>

</script>


<script src="https://source.zoom.us/1.8.6/lib/vendor/react.min.js"></script>
<script src="https://source.zoom.us/1.8.6/lib/vendor/react-dom.min.js"></script>
<script src="https://source.zoom.us/1.8.6/lib/vendor/redux.min.js"></script>
<script src="https://source.zoom.us/1.8.6/lib/vendor/redux-thunk.min.js"></script>
<script src="https://source.zoom.us/1.8.6/lib/vendor/lodash.min.js"></script>
<script src="https://source.zoom.us/zoom-meeting-1.8.6.min.js"></script>
<?php 
echo $this->Html->script(['/js/zoom/tool','/js/zoom/vconsole.min','/js/zoom/index']);?>