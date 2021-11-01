<?php
use Cake\Routing\Router; 
$this->layout = "authdefault";
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $sessionBookings
 */
?>

<style type="text/css">
    #zmmtg-root{
        display:none;
    }
	body {
		overflow: scroll !important;
	}
</style>
<div class="new-header-style-1">
    <div class="container">
        <div class="col-sm-12 text-center">
            <h2>Requested Sessions</h2>
           <!--  <p>Lorem ipsum dolor sit consectetur adipiscin sed do eiusmod</p> -->
        </div>
    </div>
</div>

<div class="GreyBg">
    <div class="container">
        <?php  if($this->getRequest()->getAttribute('identity')->role == "teacher"){ ?>
            <div class="col-sm-3 col-sm-offset-9 mt30">
                <?= $this->Html->link('Session Scheduled <i class="glyphicon glyphicon-menu-right"></i>',['action' => 'scheduled'], ['escape' => false, 'class' => 'btn mybtn btn-block']) ?>
            </div>
        <?php } ?>
    </div>
    <div class="container">
        <div class="col-md-12 nopadding mb40">
            <h3 class="intt">SESSION REQUESTS</h3>
            <div class="col-md-12">
                <div class="table-responsive">
                <table class="table table-bordered ssTable">
                    <thead>
                        <tr>
                            <th>Session Request</th>
                            <th>Session Topic</th>
                            <th>Session Start Time</th>
                            <th>Session End Time</th>
                            <th>Status</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
						
                        if (!empty($sessionBookings->toArray())):
                                    $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
									$loop = 0;
                                    foreach ($sessionBookings as $sessionBooking): 
									//dd($sessionBooking);
									?>
                        <tr>
                            <td>
							<?php  if($this->getRequest()->getAttribute('identity')->role == "teacher"){ ?>
								From
							<?php 
							} else {
							?>
                                To 
                                <?php
							}
                                    if($this->getRequest()->getAttribute('identity')->role == "teacher"){
                                        echo $this->Html->link($sessionBooking->user->name, ['controller' => 'Users', 'action' => 'profile', 'plugin' => 'UserManager', $sessionBooking->user_id], ['class' => 'namme']);
                                    }else{
                                        echo $this->Html->link($sessionBooking->teacher->name, ['controller' => 'Users', 'action' => 'profile', 'plugin' => 'UserManager', $sessionBooking->teacher_id], ['class' => 'namme']);
                                    }
                                 ?>
                                <br>
                                <p class="sstime">
                                    <?= $sessionBooking->created->timeAgoInWords(['format' => 'MMM d, YYY', 'end' => '+1 year']) ?>
                                </p>
                            </td>
                            <td>
                                <?= $sessionBooking->topic ?><br>
                            </td>
                            <td>
                                <p class="ssdate">
                                    <?= $sessionBooking->start_date ? $sessionBooking->start_date->format('D dS M, H:i A') : "N/A" ?><br>
                                </p>
                            </td>
                            <td>
                                <p class="ssdate">
                                    <?= $sessionBooking->end_date ? $sessionBooking->end_date->format('D dS M, H:i A') : "N/A" ?><br>
                                </p>
                            </td>
                            <td>
                                <?php if($sessionBooking->session_status == 0 || empty($sessionBooking->session_status)){
                                    echo '<span class="btn btn-xs btn-danger">Awaiting Teacher Response</span>';
                                }else if($sessionBooking->session_status == 1){
                                    echo '<span class="btn btn-xs btn-success">Accept</span>';
                                }else if($sessionBooking->session_status == 2){
                                    echo '<span class="btn btn-xs btn-danger">Decline</span>';
                                }  ?>
                            </td>
							<td>
								<?php
                                if($sessionBooking->end_date){
                                    $meetingTime = strtotime($sessionBooking->end_date->format('Y-m-d H:i:s'));    
                                }else{
                                     $meetingTime = null;
                                }
								$currentTime = time();
								if($meetingTime>=$currentTime) {
									$flag = 1;
								} else {
									$flag = 0;
								}
								
								if($sessionBooking->session_status == 1){
									if(!empty($sessionBooking->meetings) && $flag ==1) {
									?>
                                    <input type="hidden" name="display_name" id="display_name_<?= $loop ?>" value="<?= $this->request->getSession()->read('Auth.User.name') ?>">

                                    <input type="hidden" name="meeting_number" id="meeting_number_<?= $loop ?>" value="<?= $sessionBooking->meetings[0]->meeting_id ?>">
                                    <input type="hidden" name="meeting_pwd" id="meeting_pwd_<?= $loop ?>" value="<?= $sessionBooking->meetings[0]->password ?>">
                                    <input type="hidden" name="meeting_url" id="meeting_url_<?= $loop ?>" value="<?php echo Router::url(null, true) ?>">
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
                                    <a href="javascript:void(0)" id="joinSession" class="btn btn-dss btn-block joinSession">Join Session</a>
                                    <?php
                                    $loop++;
									}
									//echo $this->Html->link('Join Session', ['controller' => 'SessionBookings', 'action' => 'joinSession', 'plugin' => 'Sessions'], ['class' => 'btn btn-dss']);
								}
								?>
                                <?php if($this->getRequest()->getAttribute('identity')->role == "student"){ ?>

                                <a href="javascript:void(0)" class="btn btn-dss btn-block sessionDetail" data-type="student" data-url="<?= $this->Url->build(['controller' => 'SessionBookings', 'action' => 'sessionRequest', $sessionBooking->id]) ?>" data-title="Session Requested" data-meeting="<?= $flag ?>" data-id="<?= $sessionBooking->id ?>" data-sessionStatus="<?= $sessionBooking->session_status ?>">View Detail</a>
                            <?php }else{ ?>

                                <a href="javascript:void(0)" class="btn btn-dss btn-block sessionDetail" data-type="teacher" data-url="<?= $this->Url->build(['controller' => 'SessionBookings', 'action' => 'view', $sessionBooking->id]) ?>" data-title="Session Request | <?= $sessionBooking->created->format('jS F, Y') ?> (<?= $sessionBooking->created->format('H:i a') ?>)" data-id="<?= $sessionBooking->id ?>" data-meeting="<?= $flag ?>" data-sessionStatus="<?= $sessionBooking->session_status ?>">View Detail</a>
                            <?php } ?>
                            </td>
                            <!--<td>
                                To 
                                <?php
                                    if($this->getRequest()->getAttribute('identity')->role == "teacher"){
                                        echo $this->Html->link($sessionBooking->user->name, ['controller' => 'Users', 'action' => 'profile', 'plugin' => 'UserManager', $sessionBooking->user_id], ['class' => 'namme']);
                                    }else{
                                        echo $this->Html->link($sessionBooking->teacher->name, ['controller' => 'Users', 'action' => 'profile', 'plugin' => 'UserManager', $sessionBooking->teacher_id], ['class' => 'namme']);
                                    }
                                    //echo $this->Html->link('Join Session', ['controller' => 'SessionBookings', 'action' => 'joinSession', 'plugin' => 'Sessions'], ['class' => 'btn btn-dss']);
                                ?>
                               <?php if($this->getRequest()->getAttribute('identity')->role == "student"){ ?>
                                    <a href="javascript:void(0)" class="btn btn-dss sessionDetail" data-type="student" data-url="<?= $this->Url->build(['controller' => 'SessionBookings', 'action' => 'sessionRequest', $sessionBooking->id]) ?>" data-title="Session Requested" data-id="<?= $sessionBooking->id ?>">View Detail</a>
                                <?php }else{ ?>
                                    <a href="javascript:void(0)" class="btn btn-dss sessionDetail" data-type="teacher" data-url="<?= $this->Url->build(['controller' => 'SessionBookings', 'action' => 'view', $sessionBooking->id]) ?>" data-title="Session Request | <?= $sessionBooking->created->format('jS F, Y') ?> (<?= $sessionBooking->created->format('H:i a') ?>)" data-id="<?= $sessionBooking->id ?>">View Detail</a>
                                <?php } ?>
                            </td>-->
                           
                        </tr>

                         <?php $i++;  endforeach; ?>
                            <?php else: ?>
                            <tr> <td colspan='16' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> </tr>
                            <?php endif; ?>
                       
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    span.btn{
        cursor: default !important;
    }
</style>
 
<?php 
echo $this->Html->css(['/assets/plugins/datetimepicker-master/jquery.datetimepicker'], ['block' => true]);
echo $this->Html->script(['/assets/plugins/datetimepicker-master/build/jquery.datetimepicker.full.min'], ['block' => true]);
echo $this->Html->script(['/assets/plugins/jquery-loading-overlay-master/dist/loadingoverlay.min'],['block' => true]);
echo $this->Html->script(['common', 'Users'], ['block' => true]); ?>
<script src="https://source.zoom.us/1.8.6/lib/vendor/react.min.js"></script>
<script src="https://source.zoom.us/1.8.6/lib/vendor/react-dom.min.js"></script>
<script src="https://source.zoom.us/1.8.6/lib/vendor/redux.min.js"></script>
<script src="https://source.zoom.us/1.8.6/lib/vendor/redux-thunk.min.js"></script>
<script src="https://source.zoom.us/1.8.6/lib/vendor/lodash.min.js"></script>
<script src="https://source.zoom.us/zoom-meeting-1.8.6.min.js"></script>
<script>
<?php $this->Html->scriptStart(['block' => true]); ?>
$users = new Users();

$(document).on("click", ".sessionDetail", function(event) {
        event.preventDefault();
		
        let _this = $(this);
        $users.getSessionContent({'url': _this.data('url'),'type' : _this.data('type'), 'title': _this.data('title'), 'id': _this.data('id'), 'meeting': _this.data('meeting'), 'sessionStatus': _this.data('sessionstatus')});
});

$(document).on("click", ".modelAction", function(event) {
        event.preventDefault();
        let _this = $(this);
        $users.modelAction({'url': '<?= $this->Url->build(['controller' => 'SessionBookings', 'action' => 'sessionStatus']) ?>', 'data': {'session_status' : _this.data('type'), 'id' :  _this.data('id'), 'reason' : $('#sessionBookingDetail #reason').val()}});
}); 

$(document).on("click", ".sessionModify", function(event) {
        event.preventDefault();
        let _this = $(this);
        $users.sessionModify({'url': '<?= $this->Url->build(['controller' => 'SessionBookings', 'action' => 'sessionModify']) ?>', 'data': {'id' :  _this.data('id')}});
});

$(document).on("click", ".sessionReschedule", function(event) {
        event.preventDefault();
        let _this = $(this);
        $users.sessionReschedule({'url': $('#sessionReschedule').attr('action'), 'data': $('#sessionReschedule').serialize()});
});

<?php $this->Html->scriptEnd(); ?>
</script>
<?php 
echo $this->Html->script(['/js/zoom/tool','/js/zoom/vconsole.min','/js/zoom/index']);?>