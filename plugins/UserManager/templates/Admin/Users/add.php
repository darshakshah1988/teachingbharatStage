<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $user
 */
$preUrl = $this->request->referer() ? $this->request->referer() : (!empty($user->id) ? ($user->role == "student" ? ['action' => 'students'] : ['action' => 'index']) : ['action' => 'index']);
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb', ['custom' => [['title' => isset($user->role) ? ucfirst($user->role) ."s" : "Users", 'url' => ['controller' => 'Users', 'action' => isset($user->role) && $user->role == "student" ? 'students' : 'index']], ['title' => __(empty($user->id) ? 'Add {0}' : 'Edit {0}', $user->role)]]]) ?>
        </nav>
        <h1>
            <?= __('Manage User') ?>
        </h1>
        <small><?php echo empty($user->id) ? __('Here you can add New user') : __('Here you can edit user'); ?></small>
</div>
<?php $this->end(); ?>

<div class="row users index content">
<div class="col-12 col-sm-12 col-md-12">
        <div class="panel-default">
            <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= __(empty($user->id) ? 'Add {0}' : 'Edit {0}', $user->role) ?></h2>
                <div class="d-flex flex-wrap">
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), $preUrl, ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>

            <?= $this->Form->create($user, ['role' => 'form', 'enctype' => 'multipart/form-data', 'templates' => 'horizontal_form']) ?>
            <div class="panel-body">

                <?php
                    echo $this->Form->control('username', ['class' => 'form-control', 'placeholder' => __('Username')]);
					
                    echo $this->Form->control('email', ['class' => 'form-control', 'placeholder' => __('Email')]);
					if($user->role == 'teacher') {
						echo $this->Form->control('zoom_email', ['type'=>'email','class' => 'form-control', 'placeholder' => __('Zoom Email')]);
					}
                    echo $this->Form->control('first_name', ['class' => 'form-control', 'placeholder' => __('First Name')]);
                    echo $this->Form->control('last_name', ['class' => 'form-control', 'placeholder' => __('Last Name')]);
                    echo $this->Form->control('user_profile.mobile', ['label' => __('Mobile'), 'class' => 'form-control my-field', 'placeholder' => 'Mobile']);
                    
                    echo $this->Form->control('user_profile.alt_mobile', ['label' => __('Alt Number'), 'class' => 'form-control my-field', 'placeholder' => 'Alt Mobile Number']);
                    
                    echo $this->Form->control('user_profile.dob', ['label' => __('Date of Birth'), 'class' => 'form-control my-field', 'pattern' => '\d{4}-\d{2}-\d{2}']);
                    
                    echo $this->Form->control('user_profile.location_id', ['options' => $locations, 'class' => 'form-control my-field', 'empty' => 'Select Your State']);
                    
                    echo $this->Form->control('user_profile.address_line_1', ['label' => __('Address'), 'class' => 'form-control my-field', 'placeholder' => 'Address', ]);

                    
                    if($user->role == "teacher"){

                        echo $this->Form->control('user_profile.pin_number', ['label' => __('PIN Number'), 'class' => 'form-control', 'placeholder' => 'PIN Number', ]);

                        echo $this->Form->control('user_profile.qualification', ['label' => __('Highest Qualification'), 'class' => 'form-control', 'placeholder' => 'Highest Qualification' ]);
                        echo $this->Form->control('user_profile.college_university', ['label' => __('Educated from College / University'), 'class' => 'form-control my-field', 'placeholder' => 'College / University']);

                        echo $this->Form->control('user_profile.occupation_id', ['options' => $occupations, 'label' => __('Current Occupation'), 'class' => 'form-control my-field', 'empty' => 'Current Occupation']);

                        echo $this->Form->control('user_profile.experience', ['options' => [1 => 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20], 'label' => __('Prior experience in teaching'), 'class' => 'form-control', 'empty' => 'Year', ]);

                        echo $this->Form->control('user_profile.experience_month', ['options' => [1 => 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],'label' =>['text' => '&nbsp;', 'escape' => false], 'class' => 'form-control', 'empty' => 'Month', ]);

                        echo $this->Form->control('user_profile.primary_subject_id', 
                                ['options' => $subjects, 'label' => __('Primary Subject of Teaching'), 'class' => 'form-control my-field', 'empty' => 'Select Subject']); 

                        echo $this->Form->control('user_profile.secondary_subject_id', 
                                ['options' => $subjects, 'label' => __('Secondary Subject of Teaching(if any)'), 'class' => 'form-control my-field', 'empty' => 'Select Subject']);
                        echo $this->Form->control('user_profile.hours_inweekdays', ['options' => [1 => 1, 2, 3, 4, 5, 6, 7, 8], 'label' => __('Hours you will be available on Teaching Bharat for Teaching'), 'class' => 'form-control my-field', 'empty' => 'In Weekdays', ]);

                        echo $this->Form->control('user_profile.hours_inweekend', ['options' => [1 => 1, 2, 3, 4, 5, 6, 7, 8], 'label' => __('Hours you will be available on Teaching Bharat for Teaching'), 'class' => 'form-control my-field', 'empty' => 'In Weekend', ]);

                        echo $this->Form->control('is_digital_pen_tablet', ['options' => [1 => 'Yes', 0 => 'No'], 'label' => __('Do you have Digital pen and Tablet'), 'class' => 'form-control my-field', 'empty' => 'Select', ]);

                        echo $this->Form->control('user_profile.is_internet_speed_mbps', ['options' => [1 => 'Yes', 0 => 'No'], 'label' => __('Do you have Internet speed more than 1 mbps'), 'class' => 'form-control my-field', 'empty' => 'Select', ]);

                        echo $this->Form->control('user_profile.source_of_rudraa', ['label' => __('How did u hear about Teaching Bharat'), 'class' => 'form-control my-field', 'placeholder' => 'Specify', ]);
                        echo $this->Form->control('user_profile.achievement', ['label' => __('Achievement'), 'class' => 'form-control', 'placeholder' => 'Achievement' ]);

                        echo $this->Form->control('user_profile.other_achievement', ['label' => __('Other Achievement'), 'class' => 'form-control', 'placeholder' => 'Other Achievement' ]);

                         echo $this->Form->control('user_profile.digital_experience', ['label' => __('Digital Experience'), 'class' => 'form-control', 'placeholder' => 'Digital Experience' ]);

                        echo $this->Form->control('grading_types._ids', ['options' => $gradingTypes, 'class' => 'form-control multi']);
                        echo $this->Form->control('boards._ids', ['options' => $boards, 'class' => 'form-control multi']);
                        echo $this->Form->control('teacher_schedules._ids', ['options' => $teacherSchedules, 'class' => 'form-control multi']);

                        echo $this->Form->control('user_profile.resume', ['type' => 'file', 'class' => 'dropify', 'data-height' => 30, 'label' => 'Update your Resume', 'required' => false]);

                        if (!empty($user->user_profile->resume_path) && !empty($user->user_profile->resume) && file_exists("img/".$user->user_profile->resume_path . $user->user_profile->resume)) {
                                $ext = pathinfo($user->user_profile->resume, PATHINFO_EXTENSION);
                                echo "<div class='row'><div class='col-md-8 offset-3'><ul class='list-unstyled' style='max-width:20%'> ";
                                    echo "<li style='border-bottom:dashed 1px #3c8dbc'> <i class='fas fa-cloud-download-alt'></i> &nbsp; ";
                                    echo $this->Html->link("<span class=''>Resume Download</span>", ['controller' => 'Users', 'action' => 'FileDownload',$user->user_profile->id],['escape' => false]);
                                    echo "</li>";
                                echo "</ul></div></div>";
                            }
                    }else{
                        echo $this->Form->control('active', ['options' => [1 => 'Active', 0 => 'In-Active'], 'class' => 'form-control', 'placeholder' => __('Active')]);
                    }
                    
                ?>
            </div>
            <div class="panel-footer d-flex flex-wrap justify-content-between align-items-center">
                <?php echo $this->Form->button("<i class='fa fa-fw fa-save'></i> " . __('Submit'), ['class' => 'btn btn-primary btn-sm btn-flat my-button', 'title' => __('Submit'), 'escapeTitle' => false]); ?>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Cancel'), $preUrl, ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Cancel'), 'escape' => false]); ?>
            </div>
            <?= $this->Form->end() ?>

        </div>
    </div>
</div>