<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $courses
 */
 use Cake\Routing\Router; 
$this->layout = "ajax";
$is_loginrequired = false;
if(!$this->request->getAttribute('identity')){
            $is_loginrequired = true;
}
?>

<div class="row">
    <?php if (!empty($courses->toArray())):
        $rowBreak = 1;
        $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
		$loop = 0;
    foreach ($courses as $course): ?>
    <div class="col-sm-6">
        <div class="col-sm-12 master-class-box">
            <h2><?= $this->Html->link($course->title, ['plugin' => 'Courses', 'controller' => 'Courses', 'action' => 'sessionDetail', $course->id], ['escape' => false]); ?></h2>
            <h5>Gread <?= $course->grading_type->title ?> <span><?= $course->start_date->format('D dS M, H:i A') ?></span></h5>
            <table class="mcb-details">
                <tr>
                    <td>
                        <?php 
                        // dump($course->user->image_path . $course->user->profile_photo);
                         if (!empty($course->user->image_path) && !empty($course->user->profile_photo) && file_exists("img/".$course->user->image_path . $course->user->profile_photo)) { 
                            $userPhoto = $course->user->image_path . $course->user->profile_photo;
                        }else{
                            $userPhoto = 'Authors/01.jpg';
                        }

                        echo $this->Html->image($userPhoto, ['class' => 'user-img'])?>
                    </td>
                    <td>
                        <p>Teaching By</p>
                        <h4><?= $course->user->name ?></h4>
                    </td>
                    <td class="text-right">
                        <p><span><?= $course->user->user_profile->primary_subject->title ?> & <?= $course->user->user_profile->secondary_subject->title ?> Expert</span></p>
                        <h6><?= $course->user->user_profile->qualification ?>, <?= $course->user->user_profile->college_university ?></h6>
                    </td>
                </tr>
            </table>
            <hr> 
            <table class="master-class-box-footer">
                <tr>
                    <td>
                        <?php if($course->total_watching){ ?>
                            <h3><?= $course->total_watching ?> Watching..</h3>
                        <?php } ?>
                    </td>
                    <td class="text-right">
                        <?php 
                        if($tab != "past"){
                            if(!$this->request->getAttribute('identity')){
                            echo $this->Html->link('Join For Free <i class="glyphicon glyphicon-menu-right"></i>', 'javascript:void(0);', ['escape' => false, 'class' => 'tb-btn-md loginrequired', 'data-redirect' => $this->Url->build(['controller' => 'Courses', 'action' => 'sessionDetail', 'plugin' => 'Courses', $course->id],['fullBase' => true])]);
                            }else{
								if($tab == "live"){ 
									if(!empty($course->meetings) && ($course->end_date > date('Y-m-d H:i:s') && $course->start_date<=date('Y-m-d H:i:s'))) {
										if(empty($course->order_courses)){
										 if($this->request->getAttribute('identity')){
											if($course->user_id != $this->getRequest()->getAttribute('identity')->id){
												echo $this->Html->link('Join for Free', ['plugin' => 'Orders', 'controller' => 'Orders', 'action' => 'sessionBooking', $course->id], ['escape' => false, 'class' => 'tb-btn-md joinSession', 'data-id' => $course->id]);  
											}
											
										}else{
											echo $this->Html->link('Join for Free', ['plugin' => 'Orders', 'controller' => 'Orders', 'action' => 'sessionBooking', $course->id], ['escape' => false, 'class' => 'tb-btn-md loginrequired joinSessionHide', 'data-id' => $course->id]);  
										}  
									}else {
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
                                    <a href="javascript:void(0)" id="joinSession" class="tb-btn-md" onclick="joinSession(<?= $loop ?>)">Join Session</a>
                                    <?php
                                    $loop++;
									}
									}
								} else if($tab=='upcoming') {
									if(!empty($course->order_courses)){
										echo $this->Html->link('Already Registered <i class="glyphicon glyphicon-menu-right"></i>',['plugin' => 'Courses', 'controller' => 'Courses', 'action' => 'sessionDetail', $course->id], ['escape' => false, 'class' => 'tb-btn-md']);	
									}  else {
										echo $this->Html->link('Join For Free <i class="glyphicon glyphicon-menu-right"></i>', ['plugin' => 'Orders', 'controller' => 'Orders', 'action' => 'sessionBooking', $course->id], ['escape' => false, 'class' => 'tb-btn-md joinSession', 'data-id' => $course->id]);
									}
								} else {
									if(empty($course->order_courses)){
										echo $this->Html->link('Join For Free <i class="glyphicon glyphicon-menu-right"></i>', ['plugin' => 'Orders', 'controller' => 'Orders', 'action' => 'sessionBooking', $course->id], ['escape' => false, 'class' => 'tb-btn-md joinSession', 'data-id' => $course->id]);
									}else{
										//echo $this->Html->link('Join <i class="glyphicon glyphicon-menu-right"></i>', ['plugin' => 'Courses', 'controller' => 'Courses', 'action' => 'joinSession', $course->id], ['escape' => false,'style' => '', 'class' => 'tb-btn-md', 'data-id' => $course->id]);  
									}
								}
                            }
                        }else{
                            // echo $this->Html->link('Join <i class="glyphicon glyphicon-menu-right"></i>', ['plugin' => 'Courses', 'controller' => 'Courses', 'action' => 'pastSession', $course->id], ['escape' => false,'style' => '', 'class' => 'tb-btn-md', 'data-id' => $course->id]);  

                            if(empty($course->order_courses)){
								echo $this->Html->link('Join for Free', ['plugin' => 'Orders', 'controller' => 'Orders', 'action' => 'sessionBooking', $course->id], ['escape' => false, 'class' => 'tb-btn-md joinSession', 'data-id' => $course->id]);
                            } else {
								echo $this->Html->link('Already Registered <i class="glyphicon glyphicon-menu-right"></i>',['plugin' => 'Courses', 'controller' => 'Courses', 'action' => 'sessionDetail', $course->id], ['escape' => false, 'class' => 'tb-btn-md']);	
							}
                        }
                         
                            ?> 
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <?php if($rowBreak>0 && ($rowBreak%2 ==0)) { ?>
    <div class="clearfix"></div>
    <?php } $rowBreak++; $i++; endforeach; ?>
<?php else: ?>
        <div class="col-md-12" style="text-align:center;">
            <strong>Record Not Available</strong>  
        </div>
<?php endif; ?>

</div>
