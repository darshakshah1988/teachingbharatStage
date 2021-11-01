<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $user
 */
$preUrl = $this->request->referer() ? $this->request->referer() : ['action' => 'index'];
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb', ['custom' => [['title' => ucfirst($user->role)."s", 'url' => ['controller' => 'Users', 'action' => $user->role == "teacher" ? 'index' : 'students']], ['title' => 'View Detail']]]) ?>
        </nav>
        <h1>
            <?= __('Manage User') ?>  
        </h1>
        <small><?php echo __('Here you can view user Detail'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row users view content">
<div class="col-12 col-sm-12 col-md-12">
    <div class="panel-default">
        <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= h($user->name) ?></h2>
                <div class="d-flex flex-wrap">
                   <!--  <?= $this->Html->link("<i class=\"fa fa-edit\"></i> " . __('Edit User'), ['action' => 'add', $user->id], ['class' => 'btn btn-block btn-success btn-sm btn-flat mrg-r20', 'escape' => false]) ?> -->
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), $preUrl, ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>
            <div class="panel-body">
            <table class="table table-hover table-bordered">
                <tr>
                    <th width="20%"><?= __('Role') ?></th>
                    <td><?= ucfirst($user->role) ?></td>
                </tr>

                 <tr>
                    <th width="20%"><?= __('Email') ?></th>
                    <td><?= h($user->email) ?></td>
                </tr>
               
                <tr>
                    <th width="20%"><?= __('Name') ?></th>
                    <td><?= h($user->name) ?></td>
                </tr>
              <?php if($user->has('user_profile')){ ?>
                <tr>
                    <th><?= __('Mobile') ?></th>
                    <td><?= $user->user_profile->mobile ?></td>
                </tr>
                <?php if(!empty($user->user_profile->alt_mobile)){ ?>
                <tr>
                    <th><?= __('Alt. Mobile') ?></th>
                    <td><?= $user->user_profile->alt_mobile ?></td>
                </tr>
            <?php } ?>

                <tr>
                    <th><?= __('Date Of Birth') ?></th>
                    <td><?= $user->user_profile->dob ? $user->user_profile->dob->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_FORMAT')) : "N/A" ?></td>
                </tr>

        <?php if($user->user_profile->has('location')){ ?>
                <tr>
                    <th><?= __('Location') ?></th>
                    <td><?= $user->user_profile->location->title ?></td>
                </tr>
            <?php } ?>

                <tr>
                    <th><?= __('Address') ?></th>
                    <td><?= $user->user_profile->address_line_1 ?></td>
                </tr>

                <tr>
                    <th><?= __('Pin Number') ?></th>
                    <td><?= $user->user_profile->pin_number ?></td>
                </tr>
                <?php if(!empty($user->user_profile->gender)){ ?>
                    <tr>
                        <th><?= __('Gender') ?></th>
                        <td><?= $user->user_profile->gender ?></td>
                    </tr>
                <?php } ?>


                 <?php if($user->role == "teacher"){ ?>
                    <tr>
                        <th><?= __('Qualification') ?></th>
                        <td><?= $user->user_profile->qualification ?></td>
                    </tr>

                     <tr>
                        <th><?= __('Educated from College / University') ?></th>
                        <td><?= $user->user_profile->college_university ?></td>
                    </tr>

                    <tr>
                        <th><?= __('Current Occupation') ?></th>
                        <td><?= $user->user_profile->occupation->title ?></td>
                    </tr>

                    <tr>
                        <th><?= __('Prior experience in teaching') ?></th>
                        <td><?= $user->user_profile->experience ?></td>
                    </tr>

                    <tr>
                        <th><?= __('Primary Subject of Teaching') ?></th>
                        <td><?= $user->user_profile->primary_subject->title ?></td>
                    </tr>

                    <tr>
                        <th><?= __('Secondary Subject of Teaching(if any)') ?></th>
                        <td><?= $user->user_profile->secondary_subject->title ?></td>
                    </tr>

                    <tr>
                        <th><?= __('Grade you would to to Teach') ?></th>
                        <td>
                            <?php 
                            $brd = [];
                            foreach($user->boards as $board){
                                $brd[] = $board->title;
                            } ?>
                            <?= implode(", ", $brd) ?>
                                
                            </td>
                    </tr>

                    <tr>
                        <th><?= __('Hours you will be available on Teaching Bharat for Teaching') ?></th>
                        <td><?= $user->user_profile->hours_inweekdays ?> Hours(s) In Weekdays</td>
                    </tr>

                    <tr>
                        <th><?= __('Hours you will be available on Teaching Bharat for Teaching') ?></th>
                        <td><?= $user->user_profile->hours_inweekend ?> Hours(s) In Weekend</td>
                    </tr>

                    <tr>
                        <th><?= __('Do you have Digital pen and Tablet') ?></th>
                        <td><?= $user->user_profile->is_digital_pen_tablet == 1 ? "Yes" : "No"; ?></td>
                    </tr>
 
                    <tr>
                        <th><?= __('Available Timings') ?></th>
                        <td>
                            <?php 
                            $timings = [];
                            foreach($user->teacher_schedules as $timing){
                                $timings[] = $timing->title;
                            } ?>
                            <?= implode(", ", $timings) ?>
                        </td>
                    </tr>

                    <tr>
                        <th><?= __('Do you have Internet speed more than 1 mbps') ?></th>
                        <td><?= $user->user_profile->is_internet_speed_mbps == 1 ? "Yes" : "No"; ?></td>
                    </tr>

                    <tr>
                        <th><?= __('How did u hear about Teaching Bharat') ?></th>
                        <td><?= $user->user_profile->source_of_rudraa ?></td>
                    </tr>

                    <?php if(!empty($user->user_profile->achievement)){ ?>
                     <tr>
                        <th><?= __('Achievement') ?></th>
                        <td><?= $user->user_profile->achievement ?></td>
                    </tr>
                    <?php } ?>

                    <?php if(!empty($user->user_profile->other_achievement)){ ?>
                     <tr>
                        <th><?= __('Other Achievement') ?></th>
                        <td><?= $user->user_profile->other_achievement ?></td>
                    </tr>
                    <?php } ?>

                    <?php if(!empty($user->user_profile->digital_experience)){ ?>
                     <tr>
                        <th><?= __('Digital Experience') ?></th>
                        <td><?= $user->user_profile->digital_experience ?></td>
                    </tr>
                    <?php } ?>

                    <tr>
                        <th><?= __('Resume') ?></th>
                        <td>
                            <?php 

                            if (!empty($user->user_profile->resume_path) && !empty($user->user_profile->resume) && file_exists("img/".$user->user_profile->resume_path . $user->user_profile->resume)) { 
                                $ext = pathinfo($user->user_profile->resume, PATHINFO_EXTENSION);
                                echo "<ul class='list-unstyled' style='max-width:20%'> ";
                                    echo "<li style='border-bottom:dashed 1px #3c8dbc'> <i class='fas fa-cloud-download-alt'></i> &nbsp; ";
                                    echo $this->Html->link("<span class=''>Resume Download</span>", ['controller' => 'Users', 'action' => 'FileDownload',$user->user_profile->id],['escape' => false]);
                                    echo "</li>";
                                echo "</ul>";
                            }

                            ?>
                        </td>
                    </tr>

                <?php } ?>



            <?php } ?>
              
                <tr>
                    <th><?= __('Created') ?></th>
                    <td>
                        <?php if ($user->created) {
                                echo $user->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td>
                        <?php if ($user->modified) {
                                echo $user->modified->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                
                <tr>
                    <th><?= __('Active') ?></th>
                    <td><?= $user->active ? __('Active') : __('In-active'); ?></td>
                </tr>
              
            </table>

        </div>
    </div>
</div>


<?php if($user->role == "teacher" && !empty($user->user_documents)){ ?>
<div class="col-12 col-sm-12 col-md-12">
    <div class="panel-default">
        <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
            <h2><?= __('Documents') ?></h2>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="userDocsTable">
                <thead>
                    <tr>
                        <th width="10%">S.R</th>
                        <th width="30%">Document Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if(!empty($user->user_documents)){
                    foreach($user->user_documents as $in => $document){ ?>
                        <tr class="doc-row-<?= $document->id ?>">
                            <td class="srn"><?= ($in + 1) ?>.</td>
                            <td><?= \Cake\Core\Configure::read('constants.DOCUMENT_TYPE')[$document->document_type_id] ?? "" ?></td>
                            <td>
                                <?php
                                echo $this->Html->link("<span class=''> Download</span>", ['controller' => 'Users', 'action' => 'uDocdownload',$document->id],['escape' => false, 'target' => '_blank']);
                                ?>
                            </td>
                        </tr>
                     <?php } } ?>
                </tbody>
            </table>
        </div>
        </div>
    </div>
</div>
<?php } ?>


<?php if (!empty($user->grading_types)) : ?>
<div class="col-12 col-sm-12 col-md-12">
    <div class="panel-default">
        <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
            <h2><?= __('Related Grading Types') ?></h2>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <tr>
                    <th>#</th>
                    <th><?= __('Title') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php $i = 1; 
                foreach ($user->grading_types as $gradingTypes) : ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= h($gradingTypes->title) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['controller' => 'GradingTypes', 'action' => 'view', $gradingTypes->id, 'plugin' => 'Courses'], ['class' => 'btn btn-block btn-warning btn-xs btn-flat']) ?> 

                        <?= $this->Html->link(__('Edit'), ['controller' => 'GradingTypes', 'action' => 'add', $gradingTypes->id, 'plugin' => 'Courses'], ['class' => 'btn btn-block btn-success btn-xs btn-flat']) ?> 
                    </td>
                </tr>
                <?php $i++;  
            endforeach; ?>
            </table>
        </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if (!empty($user->teacher_schedules)) : ?>
                <div class="col-12 col-sm-12 col-md-12">
                <div class="panel-default">
                    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                        <h2><?= __('Related Teacher Schedules') ?></h2>
                </div>
                <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th>#</th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Start At') ?></th>
                            <th><?= __('End At') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php  $inc = 1;
                        foreach ($user->teacher_schedules as $teacherSchedules) : ?>
                        <tr>
                            <td><?= $inc ?></td>
                            <td><?= h($teacherSchedules->title) ?></td>
                            <td><?= h($teacherSchedules->start_at) ?></td>
                            <td><?= h($teacherSchedules->end_at) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'TeacherSchedules', 'action' => 'view', $teacherSchedules->id], ['class' => 'btn btn-block btn-warning btn-xs btn-flat']) ?> 

                                <?= $this->Html->link(__('Edit'), ['controller' => 'TeacherSchedules', 'action' => 'add', $teacherSchedules->id], ['class' => 'btn btn-block btn-success btn-xs btn-flat']) ?> 

                            </td>
                        </tr>
                        <?php $inc++;
                        endforeach; ?>
                    </table>
                </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
<?php if (!empty($user->social_accounts)) : ?>
                <div class="col-12 col-sm-12 col-md-12">
                <div class="panel-default">
                    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                        <h2><?= __('Related Social Accounts') ?></h2>
                </div>
                <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Provider') ?></th>
                            <th><?= __('Username') ?></th>
                            <th><?= __('Reference') ?></th>
                            <th><?= __('Avatar') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Link') ?></th>
                            <th><?= __('Token') ?></th>
                            <th><?= __('Token Secret') ?></th>
                            <th><?= __('Token Expires') ?></th>
                            <th><?= __('Active') ?></th>
                            <th><?= __('Data') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->social_accounts as $socialAccounts) : ?>
                        <tr>
                            <td><?= h($socialAccounts->id) ?></td>
                            <td><?= h($socialAccounts->user_id) ?></td>
                            <td><?= h($socialAccounts->provider) ?></td>
                            <td><?= h($socialAccounts->username) ?></td>
                            <td><?= h($socialAccounts->reference) ?></td>
                            <td><?= h($socialAccounts->avatar) ?></td>
                            <td><?= h($socialAccounts->description) ?></td>
                            <td><?= h($socialAccounts->link) ?></td>
                            <td><?= h($socialAccounts->token) ?></td>
                            <td><?= h($socialAccounts->token_secret) ?></td>
                            <td><?= h($socialAccounts->token_expires) ?></td>
                            <td><?= h($socialAccounts->active) ?></td>
                            <td><?= h($socialAccounts->data) ?></td>
                            <td><?= h($socialAccounts->created) ?></td>
                            <td><?= h($socialAccounts->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'SocialAccounts', 'action' => 'view', $socialAccounts->id], ['class' => 'btn btn-block btn-warning btn-xs btn-flat']) ?> 

                                <?= $this->Html->link(__('Edit'), ['controller' => 'SocialAccounts', 'action' => 'edit', $socialAccounts->id], ['class' => 'btn btn-block btn-success btn-xs btn-flat']) ?> 

                                <?= $this->Html->link(__('Delete'), 'javascript:void(0)', ['data-message' => __('Are you sure you want to delete # {0}?', $socialAccounts->id), 'data-url'=> $this->Url->build(['controller' => 'SocialAccounts', 'action' => 'delete', $socialAccounts->id]), 'class' => 'deleteWithReload btn btn-block btn-danger btn-xs btn-flat']) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
<?php if (!empty($user->user_tokens)) : ?>
                <div class="col-12 col-sm-12 col-md-12">
                <div class="panel-default">
                    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                        <h2><?= __('Related User Tokens') ?></h2>
                </div>
                <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('User Type') ?></th>
                            <th><?= __('Token Type') ?></th>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Token') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->user_tokens as $userTokens) : ?>
                        <tr>
                            <td><?= h($userTokens->id) ?></td>
                            <td><?= h($userTokens->user_id) ?></td>
                            <td><?= h($userTokens->user_type) ?></td>
                            <td><?= h($userTokens->token_type) ?></td>
                            <td><?= h($userTokens->email) ?></td>
                            <td><?= h($userTokens->token) ?></td>
                            <td><?= h($userTokens->created) ?></td>
                            <td><?= h($userTokens->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'UserTokens', 'action' => 'view', $userTokens->id], ['class' => 'btn btn-block btn-warning btn-xs btn-flat']) ?> 

                                <?= $this->Html->link(__('Edit'), ['controller' => 'UserTokens', 'action' => 'edit', $userTokens->id], ['class' => 'btn btn-block btn-success btn-xs btn-flat']) ?> 

                                <?= $this->Html->link(__('Delete'), 'javascript:void(0)', ['data-message' => __('Are you sure you want to delete # {0}?', $userTokens->id), 'data-url'=> $this->Url->build(['controller' => 'UserTokens', 'action' => 'delete', $userTokens->id]), 'class' => 'deleteWithReload btn btn-block btn-danger btn-xs btn-flat']) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
