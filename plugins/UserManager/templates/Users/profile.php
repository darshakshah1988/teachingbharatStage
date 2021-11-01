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
<div class="White79">
        <div class="TeacheProfileTop">
            <div class="container">
                <?= $this->cell('UserManager.User', ['id' => $user->id])->render('profile_header') ?>
                <div class="col-md-12 action">

                <?php if($user->role == "teacher"){ ?>

                        <div class="col-sm-3">

                            <p>Experience : <span><?= $user->user_profile->experience ?><?php echo $user->user_profile->experience_month ? "." . $user->user_profile->experience_month : "" ?></span> Year(s)</p>
                        </div>
                        <?php if(!empty($user->user_profile->rate)){ ?>
                        <div class="col-sm-3">
                            <p>Rate : <span>₹ <?= $user->user_profile->rate ?? 0 ?>/Hour</span></p>
                        </div>
                    <?php } ?>
                        <?php if($this->getRequest()->getAttribute('identity') && $this->getRequest()->getAttribute('identity')->id == $user->id){ ?>
                        <div class="col-sm-3">
                            <?= $this->Html->link(__d('cake_d_c/users', 'Edit Profile'), ['plugin' => 'UserManager', 'controller' => 'Users', 'action' => 'updateProfile'], ['escape' => false, 'class' => 'btn btn-block bs']); ?>
                        </div>
                        <div class="col-sm-3">
                            <?= $this->Html->link(__d('cake_d_c/users', 'Change Password'), ['plugin' => 'UserManager', 'controller' => 'Users', 'action' => 'changePassword'], ['escape' => false, 'class' => 'btn btn-block ts']); ?>
                        </div>
                    <?php }
                    if($this->getRequest()->getAttribute('identity') && $this->getRequest()->getAttribute('identity')->id != $user->id){
                    ?>
                        <div class="col-md-3">
                            <a href="javascript:void(0)" id="bookSession" class="btn btn-block bs">BOOK SESSIONS</a>
                        </div>
                    <?php }elseif(!$this->getRequest()->getAttribute('identity')){ ?>
                        <div class="col-md-3">
                            <a href="javascript:void(0)" class="btn btn-block bs loginrequired">BOOK SESSIONS</a>
                        </div>
                    <?php } ?>
                <?php } elseif($this->getRequest()->getAttribute('identity') && $this->getRequest()->getAttribute('identity')->id == $user->id){ ?>

                    <div class="col-md-3">
                        <?= $this->Html->link(__d('cake_d_c/users', 'Edit Profile'), ['plugin' => 'UserManager', 'controller' => 'Users', 'action' => 'updateProfile'], ['escape' => false, 'class' => 'btn btn-block bs']); ?>
                    </div>
                    <div class="col-md-3">
                        <a href="" class="btn btn-block bs">My Account</a>
                    </div>
                    <div class="col-md-3">
                        <?= $this->Html->link(__d('cake_d_c/users', 'Change Password'), ['plugin' => 'UserManager', 'controller' => 'Users', 'action' => 'changePassword'], ['escape' => false, 'class' => 'btn btn-block ts']); ?>
                    </div>
                    <div class="col-md-3">
                        <?= $this->Html->link(__d('cake_d_c/users', 'Sign out'), ['plugin' => 'UserManager', 'controller' => 'Users', 'action' => 'logout'], ['escape' => false, 'class' => 'btn btn-block ts']); ?>
                    </div>

            <?php } ?>


            </div>
            </div>
        </div>

        <div class="GreyBg">
            <div class="container">
                <div class="col-md-12 TPContent">
                    <div class="col-md-6 <?= $user->role == "teacher" ? "" : "col-md-offset-3" ?>">
                        <div class="col-md-12 TPBbox">
                            <h2 class="title">About Me</h2>
                            <p class="status"><?= $user->user_profile->about_me ?? "" ?></p>
                            <div class="col-md-12 bx">
                                <h5><i class="glyphicon glyphicon-map-marker"></i><span>From </span>
                                    <?php echo $user->user_profile ? $this->cell('Locations.Location::getParents', [$user->user_profile->location_id])->render('get_parent_no_links') : "" ?>
                                    <?= $user->user_profile->location->title ?? "" ?>
                                </h5>
                                <h5><i class="glyphicon glyphicon-map-marker"></i><span>Address </span>
                                    <?= $user->user_profile->address_line_1 ?? "" ?>
                                </h5>
                                <?php if(!empty($user->languages)){ ?>
                                <h5><i class="glyphicon glyphicon-volume-down"></i><span>Speaks</span>
                                    <?php
                                        $languags = [];
                                        foreach($user->languages as $language){
                                            $languags[] = $language->title;
                                        }
                                        echo implode(", ", $languags);
                                    ?>
                                </h5>
                                <?php }
								if($this->getRequest()->getAttribute('identity') && $this->getRequest()->getAttribute('identity')->id == $user->id){
									?>
                                <h5><i class="glyphicon glyphicon-envelope"></i><span>Email </span><?= $user->email ?></h5>
                                <?php if($user->user_profile && $user->user_profile->mobile){ ?>
                                <h5><i class="glyphicon glyphicon-earphone"></i><span>Contact </span><?= $user->user_profile->mobile ?></h5>
                                <?php }
								}
								?>
                            </div>
                        </div>
                        <?php if($user->role == "teacher"){ ?>
                        <div class="col-md-12 TPBbox">
                            <h2 class="title">Subjects Taught</h2>
                            <div class="col-md-12 bx">
                                <table>
                                    <tr>
                                        <td><?= $user->user_profile->primary_subject->title ?? "N/A" ?></td>
                                        <!-- <td><span>CBSC 8-10th</span></td> -->
                                    </tr>
                                    <tr>
                                        <td><?= $user->user_profile->secondary_subject->title ?? "N/A" ?></td>
                                        <!-- <td><span>CBSC 8-10th</span><span>ICSC 8-10th</span></td> -->
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="col-md-12 TPBbox">
                        <h2 class="title">Additional Information</h2>
                        <div class="col-md-12 bx">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Date of Birth</th>
                                    <td><?= $user->user_profile->dob ?? "N/A" ?></td>
                                </tr>
                                <tr>
                                    <th>PIN Number</th>
                                    <td><?= $user->user_profile->pin_number ?? "N/A" ?></td>
                                </tr>
                                <tr>
                                    <th>Alt Mobile Number</th>
                                    <td><?= $user->user_profile->alt_mobile ?? "N/A" ?></td>
                                </tr>
                                <tr>
                                    <th>Highest Qualification</th>
                                    <td><?= $user->user_profile->qualification ?? "N/A" ?></td>
                                </tr>
                                <tr>
                                    <th>Educated from College / University</th>
                                    <td><?= $user->user_profile->college_university ?? "N/A" ?></td>
                                </tr>
                                <tr>
                                    <th>Current Occupation</th>
                                    <td><?= $user->user_profile->occupation->title ?? "N/A" ?></td>
                                </tr>
                                <tr>
                                    <th>Prior experience in teaching</th>
                                    <td><?= $user->user_profile->experience ?><?php echo $user->user_profile->experience_month ? "." . $user->user_profile->experience_month : "" ?> Year(s)</td>
                                </tr>
                                <tr>
                                    <th>Grades</th>
                                    <td>
                                        <?php if($user->grading_types){
                                            $grds = [];
                                            foreach($user->grading_types as $gread){
                                                $grds[] = $gread->title;
                                            }
                                        } ?>
                                        <?= isset($grds) && !empty($grds) ? implode(", ", $grds) : "N/A" ?>

                                    </td>
                                </tr>
                                <tr>
                                    <th>Hours you will be available in Weekdays</th>
                                    <td><?= $user->user_profile->hours_inweekdays ." hour(s)" ?? "N/A" ?></td>
                                </tr>
                                <tr>
                                    <th>Hours you will be available in Weekend</th>
                                    <td><?= $user->user_profile->hours_inweekend ." hour(s)" ?? "N/A" ?></td>
                                </tr>
                                <tr>
                                    <th>Do you have Digital pen and Tablet</th>
                                    <td><?= $user->user_profile->is_digital_pen_tablet ?? "N/A" ?></td>
                                </tr>
                                <tr>
                                    <th>Available Timings for Teaching</th>
                                    <td><?= $user->user_profile->alt_mobile ?? "N/A" ?></td>
                                </tr>
                                <tr>
                                    <th>Do you have Internet speed more than 1 mbps</th>
                                    <td><?= $user->user_profile->is_internet_speed_mbps == true ? "Yes" : "No" ?></td>
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

                            </table>
                        </div>
                    </div>
                    <?php if($this->getRequest()->getAttribute('identity') && $this->getRequest()->getAttribute('identity')->id == $user->id){ ?>

                     <div class="col-md-12 TPBbox">
                                <h5>Documents</h5>
                                <hr>

                                <table class="table table-bordered" id="userDocsTable">
                                    <thead>
                                        <tr>
                                            <th width="10%">S.R</th>
                                            <th width="60%">Document Type</th>
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
                                                    echo $this->Html->link("<span class=''> Download</span>", ['controller' => 'UserDocuments', 'action' => 'download',$document->id],['escape' => false, 'target' => '_blank']);
                                                    ?>
                                                </td>
                                            </tr>
                                         <?php } } ?>
                                    </tbody>
                                </table>
                            </div>

                    <?php }
                     } ?>


                    </div>

                    <?php if($user->role == "teacher" && !empty($user->reviews)){ ?>
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
                                        <p class="user"><?= $review->name ?><span><?= $review->designation ?></span></p>
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
    </div>

<?php
$this->assign('title', "Profile");
$this->Html->meta(
    'keywords', 'Profile', ['block' => true]
);
$this->Html->meta(
    'description', 'Profile', ['block' => true]
);

//$this->Html->css(['/assets/plugins/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min'], ['block' => true]);
//$this->Html->script(['/assets/plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min'], ['block' => true])//;
echo $this->Html->css(['/assets/plugins/datetimepicker-master/jquery.datetimepicker'], ['block' => true]);
echo $this->Html->script(['/assets/plugins/datetimepicker-master/build/jquery.datetimepicker.full.min'], ['block' => true]);
echo $this->Html->script(['common', 'Users'], ['block' => true]);
 ?>

<style type="text/css">
    .jconfirm{
        z-index: 9999 !important;
    }
</style>

 <script>
<?php $this->Html->scriptStart(['block' => true]); ?>
$userObj = new Users();

$(document).on("click", "#allReviews", function(event) {
        event.preventDefault();
        $userObj.getReviews({'title': 'Rating & Reviews','url': '<?= $this->Url->build(['controller' => 'Users', 'action' => 'getReviews', $user->id]) ?>'});
});

$(document).on("click", "#bookSession", function(event) {
        event.preventDefault();
        $userObj.bookSession({'title': 'Book Session','url': '<?= $this->Url->build(['controller' => 'Users', 'action' => 'session', $user->id]) ?>'});
});

$(".loginrequired").on("click", function(event){
                event.preventDefault();
                $.confirm({
                    title: '',
                    columnClass: 'medium',
                    content: 'You are not authorized to access that course. please login to book session!!',
                    buttons: {
                          Ok: function(){
                              location.href = '<?= $this->Url->build(['controller' => 'Users', 'action' => 'login', 'plugin' => 'UserManager', '?' => ['redirect' => $this->Url->build(['controller' => 'Users', 'action' => 'profile', $user->id],['fullBase' => true])]]) ?>';
                          }
                      }
                });
            });

<?php $this->Html->scriptEnd(); ?>
</script>
