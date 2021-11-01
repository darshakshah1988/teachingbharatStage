 <div class="TeacherBlueBg">
        <div class="container">
            <div class="col-md-12">
                <?= $this->Flash->render() ?>
                <?= $this->Form->create($user, ['templates' =>'bootstrap_validation', 'type' => 'file', 'novalidate' => true]) ?>
                <?= $this->Form->control('role', ['value' => 'teacher', 'type' => 'hidden']); ?>
                <div class="col-md-12 Tbox"> 
                    <div class="col-md-12 topp">
                        <h3>REGISTER AS TEACHER</h3>
                        <p>Start Teaching Online with Teaching Bharat</p> 
                    </div>
                    <div class="col-md-12">
                        <div class="row"> 
                            <div class="col-md-4">
                                <?= $this->Form->control('first_name', ['label' => __d('cake_d_c/users', 'First Name *'), 'class' => 'form-control my-field', 'placeholder' => 'First Name']); ?>
                            </div>
                            <div class="col-md-4">
                                <?= $this->Form->control('last_name', ['label' => __d('cake_d_c/users', 'Last Name'), 'class' => 'form-control my-field', 'placeholder' => 'Last Name']); ?>
                            </div>
                            <div class="col-md-4">
                                <?= $this->Form->control('email', ['label' => __d('cake_d_c/users', 'Email *'), 'class' => 'form-control my-field', 'placeholder' => 'Your Email']); ?>
                            </div>
                        </div>
                        <div class="row"> 

                            <div class="col-md-4">
                                <?= $this->Form->control('user_profile.mobile', ['label' => __('Mobile *'), 'class' => 'form-control my-field', 'placeholder' => 'Mobile']); ?>
                            </div>
                            
                            <div class="col-md-4">
                                <?= $this->Form->control('user_profile.alt_mobile', ['label' => __('Alt Number'), 'class' => 'form-control my-field', 'placeholder' => 'Alt Mobile Number']); ?>
                            </div>
                            <div class="col-md-4">
                                <?= $this->Form->control('user_profile.dob', ['label' => __('Date of Birth *'), 'class' => 'form-control my-field', 'placeholder' => 'Date of Birth']); ?>
                            </div>
                            </div>
                        <div class="row"> 

                            <div class="col-md-4">
                                <?= $this->Form->control('user_profile.location_id', ['options' => $locations, 'class' => 'form-control my-field', 'empty' => 'Select Your State']); ?>
                            </div>

                            <div class="col-md-4">
                                <?= $this->Form->control('user_profile.address_line_1', ['label' => __('Address'), 'class' => 'form-control my-field', 'placeholder' => 'Address', ]); ?>
                            </div>

                            <div class="col-md-4">
                                <?= $this->Form->control('user_profile.pin_number', ['label' => __('PIN Number'), 'class' => 'form-control my-field', 'placeholder' => 'PIN Number', ]); ?>
                            </div>
                            </div>
                            <div class="row"> 

                             <div class="col-md-12">
                                <hr class="blk" />
                            </div>
                            </div>
                        <div class="row"> 

                             <div class="col-md-4">
                                <?= $this->Form->control('user_profile.qualification', ['label' => __('Highest Qualification *'), 'class' => 'form-control my-field', 'placeholder' => 'Highest Qualification' ]); ?>
                            </div>
                            <div class="col-md-4">
                                <?= $this->Form->control('user_profile.college_university', ['label' => __('Educated from College / University *'), 'class' => 'form-control my-field', 'placeholder' => 'College / University', ]); ?>
                            </div>

                             <div class="col-md-4">
                                <?= $this->Form->control('user_profile.occupation_id', ['options' => $occupations, 'label' => __('Current Occupation'), 'class' => 'form-control my-field', 'empty' => 'Current Occupation', ]); ?>
                            </div>
                            </div>
                        <div class="row"> 

                            <div class="col-md-2">
                                <?= $this->Form->control('user_profile.experience', ['options' => [1 => 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20], 'label' => __('Experience'), 'class' => 'form-control my-field', 'empty' => 'Year', ]); ?>
                            </div>
                            <div class="col-md-2">
                                <?= $this->Form->control('user_profile.experience_month', ['options' => [1 => 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],'label' =>['text' => '&nbsp;', 'escape' => false], 'class' => 'form-control my-field', 'empty' => 'Month', ]); ?>
                            </div>

                            <div class="col-md-4">
                                <?= $this->Form->control('user_profile.primary_subject_id', 
                                ['options' => $subjects, 'label' => __('Primary Subject of Teaching'), 'class' => 'form-control my-field', 'empty' => 'Select Subject', ]); 
                                ?>
                            </div>

                            <div class="col-md-4">
                                <?= $this->Form->control('user_profile.secondary_subject_id', 
                                ['options' => $subjects, 'label' => __('Secondary Subject of Teaching(if any)'), 'class' => 'form-control my-field', 'empty' => 'Select Subject', ]); ?>
                            </div>
                            </div>
                       <div class="row"> 
                        <div class="form-group col-md-12">
                            <label>Tick the grade you would to to Teach</label><br>
                            <?php 
                                // $options = [
                                //     ['text' => '4 & 5', 'value' => 1, 'class' => 'D-checkbox'],
                                //     ['text' => '6 to 8', 'value' => 2, 'class' => 'D-checkbox'],
                                //     ['text' => '9 & 10', 'value' => 3, 'class' => 'D-checkbox'],
                                //     ['text' => '11 & 12 ( Regular )', 'value' => 4, 'class' => 'D-checkbox'],
                                //     ['text' => '11 & 12 (JEE Main Level)', 'value' => 5, 'class' => 'D-checkbox'],
                                // ];
                                echo $this->Form->select('boards._ids', $teacherBoards, ['multiple' => 'checkbox', 
                                    'label' => ['class' => 'D-label']]);

                             ?>
                            <!-- <label>Tick the grade you would to to Teach</label><br>
                            <input type="checkbox" id="g1" class="D-checkbox" /><label for="g1" class="D-label">4 & 5</label><span class="pipe"></span>
                            <input type="checkbox" id="g2" class="D-checkbox" /><label for="g2" class="D-label">6 to 8</label><span class="pipe"></span>
                            <input type="checkbox" id="g3" class="D-checkbox" /><label for="g3" class="D-label">9 & 10</label><span class="pipe"></span>
                            <input type="checkbox" id="g4" class="D-checkbox" /><label for="g4" class="D-label">11 & 12 ( Regular )</label><span class="pipe"></span>
                            <input type="checkbox" id="g5" class="D-checkbox" /><label for="g5" class="D-label">11 & 12 (JEE Main Level)</label><span class="pipe"></span> -->
                            <!-- <a href="#" class="btn btn-success btn-xs" data-toggle="modal" data-target="#Specify"><i class="glyphicon glyphicon-plus"></i></a> -->
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="form-group col-md-4">
                             <?= $this->Form->control('user_profile.hours_inweekdays', ['options' => [1 => 1, 2, 3, 4, 5, 6, 7, 8], 'label' => __('Hours you will be available on Teaching Bharat for Teaching in weekdays*'), 'class' => 'form-control my-field', 'empty' => 'In Weekdays', ]); ?>
                        </div>
                        <div class="form-group col-md-4">
                            <?= $this->Form->control('user_profile.hours_inweekend', ['options' => [1 => 1, 2, 3, 4, 5, 6, 7, 8], 'label' => __('Hours you will be available on Teaching Bharat for Teaching in weekends*'), 'class' => 'form-control my-field', 'empty' => 'In Weekend', ]); ?>
                            
                        </div>
                        <div class="form-group col-md-4">
                             <?= $this->Form->control('is_digital_pen_tablet', ['options' => [1 => 'Yes', 0 => 'No'], 'label' => __('Do you have Digital pen and Tablet'), 'class' => 'form-control my-field', 'empty' => 'Select', ]); ?> 
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="form-group col-md-12">
                            <label>Available Timings on Teaching Bharat for Teaching</label><br>
                            <?php 
                                echo $this->Form->select('teacher_schedules._ids', $schedules, [
                                    'multiple' => 'checkbox', 
                                    'label' => ['class' => 'D-label'],
                                    'templateVars' => ['spcls' => 'pipe']
                                    ]);
                             ?>
                           
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="col-md-12">
                            <hr class="blk" />
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="form-group col-md-4">
                            <?= $this->Form->control('user_profile.is_internet_speed_mbps', ['options' => [1 => 'Yes', 0 => 'No'], 'label' => __('Do you have Internet speed more than 1 mbps'), 'class' => 'form-control my-field', 'empty' => 'Select', ]); ?>
                        </div>
                        <div class="form-group col-md-4">
                            <?= $this->Form->control('user_profile.source_of_rudraa', ['label' => __('How did u hear about Teaching Bharat *'), 'class' => 'form-control my-field', 'placeholder' => 'Specify', ]); ?>
                        </div>
                        <div class="form-group col-md-4 smalldropify">
                            <label>Upload your Resume *</label><br>
                            <!-- <span class="btn btn-success btn-block btn-file">
                                Browse <input type="file">
                            </span> -->
                            <?= $this->Form->control('user_profile.resume', ['type' => 'file', 'class' => 'dropify', 'data-height' => 30, 'label' => false]) ?>
                        </div>
                    </div>
                    <div class="row"> 
                    <div class="col-md-12">
                            <hr class="blk" />
                        </div>
                    </div>
                    <div class="row"> 
                    <div class="col-md-12 nopadding SwpipeLogin">
                        <div class="col-md-4 col-md-offset-4">
                            <?= $this->Form->button(__d('cake_d_c/users', 'Submit and Apply'), ['class'=>'btn btn-block btn-primary mt-40 color-white']) ?>
                        </div>    
                    </div>
                </div>
                </div>
        <?= $this->Form->end() ?>
            </div>
        </div>
    </div>

<?php 
echo $this->Html->css(['/assets/plugins/dropify-master/dist/css/dropify.min.css'],['block' => true]);
echo $this->Html->script('/assets/plugins/dropify-master/dist/js/dropify.min.js',['block' => true]);
 ?>
<script>
<?php $this->Html->scriptStart(['block' => true]); ?>
$(document).ready(function(){
           // Basic
    $('.dropify').dropify();
});
<?php $this->Html->scriptEnd(); ?>
</script>