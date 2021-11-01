<?php
$this->layout = "authdefault";
/**
 * Copyright 2010 - 2019, Cake Development Corporation (https://www.cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2018, Cake Development Corporation (https://www.cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<style>
.jconfirm-bg{position: fixed;
background: rgba(0,0,0, 0.6);
top: 0;
left: 0;
right: 0;
bottom: 0;
}
.jconfirm-light{
    position: fixed;
    top: 10%;
    left: 0;
    right: 0;
    width: 740px;
    margin: 0px auto;
    padding: 10px 20px;

    z-index: 9999;
}
.jconfirm-box{
    width: 100% !important;
    padding: 15px !important;
}
.jconfirm-box{background: #FFF;
margin: 0px auto;
z-index: 999999;}
.jconfirm-holder{padding: 0 !important;}
</style>
<div class="White79">
<?= $this->Form->create($user, ['templates' => 'bootstrap_validation']) ?>
    <div class="TeacheProfileTop">
        <div class="container">
            <div class="col-md-12 nopadding">
                <?php
                    if (!empty($user->image_path) && !empty($user->profile_photo) && file_exists("img/".$user->image_path . $user->profile_photo)) {
                        $userPhoto = $user->image_path . $user->profile_photo;
                    }else{
                        if(!empty($this->request->getData('base64img'))){
                            $userPhoto = $this->request->getData('base64img');
                        }else{
                            $userPhoto = \Cake\Core\Configure::read('Users.Avatar.placeholder');
                        }
                    }
                    echo $this->Form->control('base64img', ['type'=>'hidden']);
                    ?>
                <div class="col-sm-2 dp">
                    <?= $this->Html->image($userPhoto,
                    ['width' => '180', 'height' => '180', 'class' => 'crpdimage']
                ); ?>
                <label class="btn btn-xs btn-success btn-file" id="imageCroping">
                        <i class="glyphicon glyphicon-pencil"></i>
                </label>
            </div>
                <div class="col-sm-10 details">
                    <h1><?= $user->first_name . " <span>" . $user->last_name  ?></span></h1>
                    <p>
                        <?php if($this->getRequest()->getAttribute('identity')->role == "teacher"){
                            echo $this->Form->control('user_profile.qualification', ['label' => __('Highest Qualification'), 'class' => 'form-control', 'placeholder' => 'Highest Qualification', 'style' => 'width: 200px', 'label' => false ]);
                        }else{
                            echo $this->Form->control('user_profile.grading_type_id', ['class'=>'form-control', 'label' => false, 'empty' => 'Select Grade', 'style' => 'width: 200px']);
                        }
                        ?>
                    </p>
                </div>
            </div>
            <div class="col-md-12 action">
                <?php if($this->getRequest()->getAttribute('identity')->role == "teacher"){ ?>
                    <div class="col-md-3">
                        <p>Experience : <span><?= $user->user_profile->experience ?><?php echo $user->user_profile->experience_month ? "." . $user->user_profile->experience_month : "" ?></span> Year(s)</p>
                    </div>
                    <div class="col-md-6">
                        <p>Rate :<span>
                            <?= $this->Form->control('user_profile.rate', ['class'=>'small-input-1', 'label' => false, 'placeholder' => '₹', 'min' => 0, 'templates' => ['inputContainer' => '{{content}}']]) ?>
                            </span>/ HOUR</p>
                    </div>
                <?php } ?>
                <div class="col-md-3<?= $this->getRequest()->getAttribute('identity')->role == "teacher" ? "" : " col-md-offset-9" ?>">
                    <?= $this->Html->link(__d('cake_d_c/users', 'Change Password'), ['plugin' => 'UserManager', 'controller' => 'Users', 'action' => 'changePassword'], ['escape' => false, 'class' => 'btn btn-block ts']); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="GreyBg">
        <div class="container">
            <div class="col-md-12 TPContent">
                <div class="col-md-6 <?= $this->getRequest()->getAttribute('identity')->role == "teacher" ? "" : "col-md-offset-3" ?>">
                    <div class="col-md-12 TPBbox">
                         <?= $this->Flash->render() ?>
                         <?php
                          echo $this->Form->control('first_name', ['label' => __d('cake_d_c/users', 'First Name *'), 'class' => 'form-control', 'placeholder' => 'First Name']);

                        echo $this->Form->control('last_name', ['label' => __d('cake_d_c/users', 'Last Name'), 'class' => 'form-control', 'placeholder' => 'Last Name']);
                         ?>
                        <h2 class="title">About Me</h2>
                        <?= $this->Form->control('user_profile.about_me', ['type' => 'textarea', 'class'=>'form-control', 'rows' => 7, 'label' => false, 'placeholder' => 'Amout Me']) ?>
                            <div class="col-md-12 bx">
                                <h5><i class="glyphicon glyphicon-map-marker"></i><span>From </span></h5>
                                <?= $this->Form->control('user_profile.location_id', ['options' => $locations, 'class' => 'form-control', 'empty' => 'Select Your State', 'label' => false]); ?>

                                <h5><i class="glyphicon glyphicon-map-marker"></i><span>Address </span></h5>
                                <?= $this->Form->control('user_profile.address_line_1', ['label' => __('Address'), 'class' => 'form-control', 'placeholder' => 'Address', 'label' => false ]); ?>

                                <h5><i class="glyphicon glyphicon-volume-down"></i><span>Speaks </span></h5>
                                <?= $this->Form->control('languages._ids', ['class'=>'form-control selectLanguages', 'options' =>  $languages, 'label' => false, 'placeholder' => 'Speaks', 'multiple' => true]) ?>
                                <h5><i class="glyphicon glyphicon-envelope"></i><span>Email </span></h5>
                                <?= $this->Form->control('email', ['class'=>'form-control', 'label' => false, 'placeholder' => 'Email', 'readonly' => true]) ?>
                                <h5><i class="glyphicon glyphicon-earphone"></i><span>Contact </span></h5>
                                <?= $this->Form->control('user_profile.mobile', ['class'=>'form-control', 'label' => false, 'placeholder' => 'Mobile', 'readonly' => true]) ?>
                                <?= $this->Html->link("Change Mobile", ['action' => 'changeMobile', $this->getRequest()->getAttribute('identity')->id], ['class' => 'changeMobile', 'data-id' => $user->id]) ?>
                            </div>
                    </div>
                    <?php if($this->getRequest()->getAttribute('identity')->role == "teacher"){ ?>

                         <div class="col-md-12 TPBbox">
                            <?php
                           echo $this->Form->control('user_profile.pin_number', ['label' => __('PIN Number'), 'class' => 'form-control', 'placeholder' => 'PIN Number', ]);

                             //echo $this->Form->control('user_profile.qualification', ['label' => __('Highest Qualification'), 'class' => 'form-control', 'placeholder' => 'Highest Qualification' ]);

                        echo $this->Form->control('user_profile.college_university', ['label' => __('Educated from College / University'), 'class' => 'form-control ', 'placeholder' => 'College / University']);

                        echo $this->Form->control('user_profile.occupation_id', ['options' => $occupations, 'label' => __('Current Occupation'), 'class' => 'form-control', 'empty' => 'Current Occupation']);
                        ?>
                        <div class="row">

                            <div class="col-md-6">
                        <?php
                        echo $this->Form->control('user_profile.experience', ['options' => [1 => 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20], 'label' => __('Prior experience in teaching'), 'class' => 'form-control', 'empty' => 'Year', ]);
                        ?>
                    </div>
<div class="col-md-6">
                        <?php

                        echo $this->Form->control('user_profile.experience_month', ['options' => [1 => 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],'label' =>['text' => '&nbsp;', 'escape' => false], 'class' => 'form-control my-field', 'empty' => 'Month', ]);

                        ?>
                    </div>
                </div>

                        <?php

                        echo $this->Form->control('user_profile.primary_subject_id',
                                ['options' => $subjects, 'label' => __('Primary Subject of Teaching'), 'class' => 'form-control', 'empty' => 'Select Subject']);

                        echo $this->Form->control('user_profile.secondary_subject_id',
                                ['options' => $subjects, 'label' => __('Secondary Subject of Teaching(if any)'), 'class' => 'form-control', 'empty' => 'Select Subject']);

                        echo $this->Form->control('user_profile.hours_inweekdays', ['options' => [1 => 1, 2, 3, 4, 5, 6, 7, 8], 'label' => __('Hours you will be available on Teaching Bharat for Teaching'), 'class' => 'form-control', 'empty' => 'In Weekdays', ]);

                        echo $this->Form->control('user_profile.hours_inweekend', ['options' => [1 => 1, 2, 3, 4, 5, 6, 7, 8], 'label' => __('Hours you will be available on Teaching Bharat for Teaching'), 'class' => 'form-control', 'empty' => 'In Weekend', ]);

                        echo $this->Form->control('is_digital_pen_tablet', ['options' => [1 => 'Yes', 0 => 'No'], 'label' => __('Do you have Digital pen and Tablet'), 'class' => 'form-control', 'empty' => 'Select', ]);

                        echo $this->Form->control('user_profile.is_internet_speed_mbps', ['options' => [1 => 'Yes', 0 => 'No'], 'label' => __('Do you have Internet speed more than 1 mbps'), 'class' => 'form-control', 'empty' => 'Select', ]);

                        echo $this->Form->control('user_profile.achievement', ['label' => __('Achievement'), 'class' => 'form-control', 'placeholder' => 'Achievement' ]);

                        echo $this->Form->control('user_profile.other_achievement', ['label' => __('Other Achievement'), 'class' => 'form-control', 'placeholder' => 'Other Achievement' ]);

                         echo $this->Form->control('user_profile.digital_experience', ['label' => __('Digital Experience'), 'class' => 'form-control', 'placeholder' => 'Digital Experience' ]);

                        echo $this->Form->control('user_profile.source_of_rudraa', ['label' => __('How did u hear about Teaching Bharat'), 'class' => 'form-control', 'placeholder' => 'Specify', ]);
                                ?>
                            </div>

                            <div class="col-md-12 TPBbox">
                                <?php
                                echo $this->Form->control('grading_types._ids', ['options' => $gradingTypes, 'class' => 'form-control multi']);
                                echo $this->Form->control('boards._ids', ['options' => $boards, 'class' => 'form-control multi']);
                                echo $this->Form->control('teacher_schedules._ids', ['options' => $teacherSchedules, 'class' => 'form-control multi']);
                                ?>
                            </div>


                         <?php } ?>

                        <div class="col-md-12 TPBbox">
                            <div class="col-md-12 text-center">
                                <?= $this->Form->button(__d('cake_d_c/users', 'SAVE Profile'), ['class'=>'btn mybtn']) ?>
                            </div>
                            <div class="col-md-12 mt20 text-center">
                                <?= $this->Html->link('Cancel', ['action' => 'profile']) ?>
                            </div>
                        </div>
                </div>

                <?php
                if($user->role == "teacher" && !empty($user->reviews)){

                    ?>
                    <div class="col-md-6">
                        <div class="col-md-12 TPBbox">
                            <h2 class="title">Rating & Reviews</h2>
                            <h5 class="rating"><span><?= round($user->avg_rating,1) ?> / 5</span>
                                <?php for($s = 1; $s <= 5; $s++){
                                        if($s <= round($user->avg_rating)){
                                            echo '<i class="glyphicon glyphicon-star"></i>';
                                        }else{
                                            echo '<i class="glyphicon glyphicon-star-empty" style=""></i>';
                                        }
                                    } ?>
                                - <?= $user->total_rating ?> Rating</h5>


                                <?php foreach($user->reviews as $review){ ?>
                                    <div class="col-md-12 ratebox">
                                        <p class="user"><?= $review->name ?><span>8 CBSE Mathematics, Bangalore</span></p>
                                        <p class="user">
                                            <?php for($s = 1; $s <= 5; $s++){
                                                if($s <= $review->rating){
                                                    echo '<i class="glyphicon glyphicon-star"></i>';
                                                }else{
                                                    echo '<i class="glyphicon glyphicon-star-empty" style=""></i>';
                                                }
                                            } ?>
                                        </p>
                                        <p class="comment"><?php
                                                    echo $this->Text->truncate($review->description,450,
                                                            [
                                                                'ellipsis' => '...',
                                                                'exact' => false
                                                            ]
                                                        );
                                                        ?></p>
                                    </div>
                                <?php }

                                if($user->total_rating > 2){
                                ?>
                            <div class="col-md-12 reviewbtn">
                                <a href="javascript:void(0)" class="btn" id="allReviews">Read All Reviews</a>
                            </div>
                        <?php } ?>
                        </div>
                    </div>
                    <?php } ?>
            </div>
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>

<?php
$this->assign('title', "Update profile");
$this->Html->meta(
    'keywords', 'Update profile', ['block' => true]
);
$this->Html->meta(
    'description', 'Update profile', ['block' => true]
);

//$this->Html->css(['/assets/plugins/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min'], ['block' => true]);
//$this->Html->script(['/assets/plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min'], ['block' => true])//;

echo $this->Html->css(['/assets/plugins/cropperjs-master/docs/css/maincropper.css', '/assets/plugins/cropperjs-master/docs/css/cropper.css'], ['block' => true]);
echo $this->Html->script(['/assets/plugins/cropperjs-master/docs/js/cropper.js'], ['block' => true]);
//echo $this->Html->css(['/assets/plugins/select2-4/dist/css/select2.min.css'],['block' => true]);
//echo $this->Html->script('/assets/plugins/select2-4/dist/js/select2.min',['block' => true]);
//echo $this->Html->css(['/assets/plugins/dropify-master/dist/css/dropify.min.css'],['block' => true]);
//echo $this->Html->script(['/assets/plugins/dropify-master/dist/js/dropify.min.js'],['block' => true]);
echo $this->Html->script(['common', 'Users','jquery-confirm'], ['block' => true]);



 ?>
 <script>
<?php $this->Html->scriptStart(['block' => true]); ?>

var crpConfirm = null;
var cropperFx = null;
$userObj = new Users();
$(document).on('click','#imageCroping', function(event){
        event.preventDefault();
        var _this = $(this);
           crpConfirm = $.confirm({
                useBootstrap: false,
                boxWidth: '70%',
                content: function () {
                    var self = this;
                    return $.ajax({
                        url: '<?= $this->Url->build(['controller' => 'Users', 'action' => 'croping']); ?>',
                        dataType: 'html',
                        method: 'get'
                    }).done(function (response) {
                        self.setContent(response);
                        self.setTitle("Profile Image");
                    }).fail(function(){
                        self.setContent('Something went wrong.');
                    });
                },
                 buttons: {
                    crop: {
                        text: 'Crop',
                        isHidden: true,
                        btnClass: 'btn waves-effect waves-light btn-primary proceedBtn',
                        action: function(){
                            var imageType = this.$content.find('#uploadedImageType').val();
                            console.log($('#cropperImage').length);
                            console.log(imageType);
                            if($('#cropperImage').length > 0){
                                 console.log($('.profile_photo_name').val());
                                result = cropperFx['getCroppedCanvas']({width: 200, height: 200 });
                                //console.log(result);
                                var imagebase = (result.toDataURL(imageType));
                                $(".crpdimage").attr('src', imagebase);
                                $( 'input[name=base64img]' ).val(imagebase);
                            }
                        }
                    },
                    Cancel: function () {
                    }
                }
            });


      //  $('#manuModal').modal('show');
    });
    $(document).ready(function() {
		/*$(".selectLanguages").select2({
			placeholder: "Select a langages",
			allowClear: true
		});*/
	});

$(document).on("click", ".changeMobile", function(event) {
        event.preventDefault();
        $userObj.changeMobile({'title': 'Change Mobile','url': $(this).attr('href'), filters: {user_id: '<?= $user->id ?>'}});
});

$(document).on("click", "#uploadDocuments", function(event) {
        event.preventDefault();
        $userObj.addDocuments({'title': 'Upload Documents','url': '<?= $this->Url->build(['controller' => 'UserDocuments', 'action' => 'add', '?' => ['user_id' => $user->id]]) ?>', filters: {user_id: '<?= $user->id ?>'}});
});

$(document).on("click", ".udocDelete", function(event) {
        event.preventDefault();
        $userObj.deleteDocuments({'title': 'Delete Documents','url': $(this).attr('href'), filters: {user_id: '<?= $user->id ?>'}});
});
$(document).on("click", "#allReviews", function(event) {
        event.preventDefault();
        $userObj.getReviews({'title': 'Rating & Reviews','url': '<?= $this->Url->build(['controller' => 'Users', 'action' => 'getReviews', $user->id]) ?>'});
});
<?php $this->Html->scriptEnd(); ?>
</script>
