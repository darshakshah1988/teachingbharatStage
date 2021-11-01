<?php
$this->layout = "authdefault";
use Cake\Routing\Router; 
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $courses
 */
?>
<div class="White79">
    <div class="GreyBg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 TitleStripp">
                    <div class="col-sm-9">
                        <h2><i class="glyphicon glyphicon-list-alt"></i>Master Session Requests</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="col-md-12 nopadding mt20">
                <?= $this->Flash->render() ?>
                    <div class="col-md-12">
                        <table class="table table-bordered ssTable">
                            <thead>
                                <tr>
                                    <th>Session</th>
                                    <th>Board - Grade</th>
                                    <th>Subject</th>
                                    <th>Session Start Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                             <?php if (!empty($courses->toArray())):
                                $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
								$loop = 0;
                                foreach ($courses as $course): ?>
                                <tr>
                                    <td>
                                       <?= $this->Html->link($course->title, ['action' => 'session-detail', $course->id], ['class' => 'namme']) ?> 
                                    </td>
                                    <td>
                                        <p class="sstopic"><?= $course->board->title ?> - <?= $course->grading_type->title ?></p>
                                    </td>
                                    <td>
                                       <?= $course->subject->title ?>
                                    </td>

                                    <td>
                                       <?= $course->start_date->format('D dS M, H:i A') ?>
                                    </td>
                                    
                                <td>
                                 <?php 
                                    /* if($course->end_date < date('Y-m-d H:i:s')){
                                     echo $this->Html->link('Join Session', ['plugin' => 'Courses', 'controller' => 'Courses', 'action' => 'pastSession', $course->id], ['escape' => false,'style' => '', 'class' => 'tb-btn-md', 'data-id' => $course->id]); 
                                    }else if($course->start_date <= date('Y-m-d H:i:s') && $course->end_date >= date('Y-m-d H:i:s')){
                                        echo $this->Html->link('Join Session', ['plugin' => 'Courses', 'controller' => 'Courses', 'action' => 'joinSession', $course->id], ['escape' => false,'style' => '', 'class' => 'tb-btn-md', 'data-id' => $course->id]); 
                                    } */
								$meetingTime = strtotime($course->end_date->format('Y-m-d H:i:s'));
								$currentTime = time();
								if($meetingTime>=$currentTime) {
									$flag = 1;
								} else {
									$flag = 0;
								}
								if(!empty($course->meetings) && $flag ==1) {
								?>
								<input type="hidden" name="display_name" id="display_name_<?= $loop ?>" value="<?= $this->request->getSession()->read('Auth.User.name') ?>">
                                    <input type="hidden" name="meeting_number" id="meeting_number_<?= $loop ?>" value="<?= $course->meetings[0]->meeting_id ?>">
                                    <input type="hidden" name="meeting_pwd" id="meeting_pwd_<?= $loop ?>" value="<?= $course->meetings[0]->password ?>">
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
                                    <a href="javascript:void(0)" id="joinSession" class="btn btn-dss joinSession">Join Session</a>
                                    <?php
                                    $loop++;
									} else {
										?>
										<a href="javascript:void(0)" class="btn btn-dss" disabled>Join Session</a>
									<?php
									}
									?>
                                </td>
                                </tr>
                                <?php $i++; endforeach; ?>
                                <?php else: ?>
                                    <tr> <td colspan='20' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
</div>
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