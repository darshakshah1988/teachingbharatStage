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
        <div class="TeacheProfileTop StudentMainBg">
            <div class="container">
                <div class="col-md-12 nopadding">
                    <?= $this->cell('UserManager.User', ['id' => $this->getRequest()->getAttribute('identity')->id]) ?>
                </div>
                <?php if($this->getRequest()->getAttribute('identity')->role == "teacher"){ ?>
                <div class="col-md-12 action">
                    <div class="col-sm-4">
                        <p>Total Hours Taught on Rudraa : <span>145</span></p>
                    </div>
                    <div class="col-sm-3">
                        <p>Total Earnings : <span>₹ 45715</span></p>
                    </div>
                    <div class="col-sm-3">
                        <p>My Rate : <span>₹ 0/Hour</span></p>
                    </div>
                    <div class="col-sm-2">
                        <?= $this->Html->link('View Profile', ['plugin' => 'UserManager', 'controller' => 'Users', 'action' => 'profile'], ['escape' => false, 'class' =>' btn btn-block bs']); ?>
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>

        <div class="GreyBg">
            <div class="container">
                <div class="col-md-12 TPContent">
                    <div class="col-md-9">

                        <?php if($this->getRequest()->getAttribute('identity')->role == "teacher"){ ?>
                         <div class="col-md-12 TPBbox">
                            <div class="col-sm-4">
                                <a href="<?= $this->Url->build(['controller' => 'Courses', 'action' => 'MyCourses', 'plugin' => 'Courses']) ?>">
                                    <div class="col-md-12 statbx">
                                        <?= $this->Html->image('TI1.png') ?>
                                        <h3>MY COURSES</h3>
                                        <h2><?= $courseCount ?></h2>
                                    </div>
                                </a>
                            </div>
                        <div class="col-sm-4">
                            <a href="<?= $this->Url->build(['controller' => 'SessionBookings', 'action' => 'index', 'plugin' => 'Sessions']) ?>">
                                <div class="col-md-12 statbx">
                                    <?= $this->Html->image('TI2.png') ?>
                                    <h3>MY SESSIONS</h3>
                                    <h2><?= $sessionCount ?></h2>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-4">
                            <a href="#">
                                <div class="col-md-12 statbx">
                                    <?= $this->Html->image('TI3.png') ?>
                                    <h3>MY STUDENTS</h3>
                                    <h2>381</h2>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php } ?>

                        <div class="col-md-12 TPBbox">
                            <div class="col-md-12 nopadding std-dash">
                                <h2 class="title">Your This Week Learning Basic Report</h2>

                                <div class="daybox">
                                    <p class="day">
                                        <span>SUN</span><br>
                                        23/10/2016
                                    </p>

                                    <h4>4 Hrs</h4>

                                </div>

                                <div class="daybox">

                                    <p class="day">

                                        <span>MON</span><br>

                                        24/10/2016

                                    </p>

                                    <h4>2.3 Hrs</h4>

                                </div>

                                <div class="daybox Active">

                                    <p class="day">

                                        <span>TUE</span><br>

                                        25/10/2016

                                    </p>

                                    <h4>5 Hrs</h4>

                                </div>

                                <div class="daybox">

                                    <p class="day">

                                        <span>WED</span><br>

                                        26/10/2016

                                    </p>

                                </div>

                                <div class="daybox">

                                    <p class="day">

                                        <span>THU</span><br>

                                        27/10/2016

                                    </p>

                                </div>

                                <div class="daybox">

                                    <p class="day">

                                        <span>FRI</span><br>

                                        28/10/2016

                                    </p>

                                </div>

                                <div class="daybox">

                                    <p class="day">

                                        <span>SAT</span><br>

                                        29/10/2016

                                    </p>

                                </div>

                            </div>

                        </div>


                        <?php
                            $userSessionData = $this->getRequest()->getAttribute('identity');
                            echo $this->cell('Sessions.Session::dashboard', ['type' => 'pending','user' => $userSessionData]);
                        ?>



                           <?php
                            $userSessionData = $this->getRequest()->getAttribute('identity');
                            echo $this->cell('Sessions.Session::dashboard', ['type' => 'upcoming','user' => $userSessionData]);
                        ?>



                    </div>

                    <div class="col-md-3">

                        <div class="col-md-12 pad15 TPBbox">

                            <h2 class="title">Notification(12)</h2>

                            <a href="#">

                                <div class="col-md-12 notilst">

                                    <h6>You have received New Session Request</h6>

                                    <p>10 mins ago</p>

                                </div>

                            </a>

                            <a href="#">

                                <div class="col-md-12 notilst">

                                    <h6>Your Payment is successfuly Done Amt: Rs 1250</h6>

                                    <p>10 mins ago</p>

                                </div>

                            </a>

                            <a href="#">

                                <div class="col-md-12 notilst">

                                    <h6>You have received New Session Request</h6>

                                    <p>10 mins ago</p>

                                </div>

                            </a>

                            <a href="#">

                                <div class="col-md-12 notilst">

                                    <h6>Your Payment is successfuly Done Amt: Rs 1250</h6>

                                    <p>10 mins ago</p>

                                </div>

                            </a>

                            <div class="col-md-12 centeralign">

                                <br>

                                <a href="AllNotifications.html" class="btn btn-xs btn-primary">View all Notification</a>

                            </div>

                        </div>

                        <div class="col-md-12 pad15 TPBbox">

                            <h2 class="title">Activities (17)</h2>

                            <a href="#">

                                <div class="col-md-12 notilst">

                                    <h5>Viral Modi (Teacher) has inserted in Notes on Maths</h5>

                                    <p>10 mins ago</p>

                                </div>

                            </a>

                            <a href="#">

                                <div class="col-md-12 notilst">

                                    <h5>Today is xxx xxx's Birthday</h5>

                                    <p>10 mins ago</p>

                                </div>

                            </a>

                            <div class="col-md-12 centeralign">

                                <br>

                                <a href="AllActivities.html" class="btn btn-xs btn-primary">View all Activities</a>

                            </div>

                        </div>

                        <div class="col-md-12 pad15 TPBbox">

                            <h2 class="title">My Subscriptions</h2>

                            <div class="form-group">

                                <label>Subject</label>

                                <input type="text" class="form-control" placeholder="subject" />

                            </div>

                            <div class="form-group">

                                <label>Comment</label>

                                <textarea class="form-control" placeholder="comment" rows="4"></textarea>

                            </div>
                            <a href="#" class="btn btn-block btn-primary">SUBMIT</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php
echo $this->Html->css(['/assets/plugins/datetimepicker-master/jquery.datetimepicker'], ['block' => true]);
echo $this->Html->script(['/assets/plugins/datetimepicker-master/build/jquery.datetimepicker.full.min'], ['block' => true]);
echo $this->Html->script(['/assets/plugins/jquery-loading-overlay-master/dist/loadingoverlay.min'],['block' => true]);
echo $this->Html->script(['common', 'Users'], ['block' => true]); ?>
<script>
<?php $this->Html->scriptStart(['block' => true]); ?>
$users = new Users();

$(document).on("click", ".sessionDetail", function(event) {
        event.preventDefault();
        let _this = $(this);
        $users.getSessionContent({'url': _this.data('url'),'type' : _this.data('type'), 'title': _this.data('title'), 'id': _this.data('id')});
});

$(document).on("click", ".modelAction", function(event) {
        event.preventDefault();
        let _this = $(this);
        $users.modelAction({'url': '<?= $this->Url->build(['plugin' => 'Sessions', 'controller' => 'SessionBookings', 'action' => 'sessionStatus']) ?>', 'data': {'session_status' : _this.data('type'), 'id' :  _this.data('id')}});
});

$(document).on("click", ".sessionModify", function(event) {
        event.preventDefault();
        let _this = $(this);
        $users.sessionModify({'url': '<?= $this->Url->build(['plugin' => 'Sessions', 'controller' => 'SessionBookings', 'action' => 'sessionModify']) ?>', 'data': {'id' :  _this.data('id')}});
});

$(document).on("click", ".sessionReschedule", function(event) {
        event.preventDefault();
        let _this = $(this);
        $users.sessionReschedule({'url': $('#sessionReschedule').attr('action'), 'data': $('#sessionReschedule').serialize()});
});

<?php $this->Html->scriptEnd(); ?>
</script>
