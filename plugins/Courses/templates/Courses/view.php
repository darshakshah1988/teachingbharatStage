<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $course
 */
?>
<div class="course-detail-banner">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-8 cdb-left-main">

                        <div class="col-sm-12">
                            <div class="col-sm-12 nopadding">
                                <h2 class="cdb-course-title"><?= $course->title ?></h2>
                                <h5 class="course-banner-meta"><span>Subject : <?= $course->subject->title ?></span><span>Grade : <?= $course->grading_type->title ?></span></h5>
                                <p class="description"><?= h($course->short_description) ?></p>
                            </div>
                            <div class="col-sm-12 nopadding mt30">
                                <div class="col-sm-4 col-lg-3 col-md-3 col-xs-6 cdb-enrolled">
                                    <p>Duration</p>
                                    <h4><?= $course->duration ?> Hour(s)</h4>
                                </div>
                                <!-- <div class="col-sm-4 col-lg-3 col-md-3 col-xs-6 cdb-enrolled">
                                    <p>Starts On</p>
                                    <h4>25th Jun, 2020</h4>
                                </div> -->
                                <div class="col-sm-4 col-lg-3 col-md-3 col-xs-6 cdb-enrolled">
                                    <p>Total Enrolled</p>
                                    <h4> <?php $enrolled = $this->cell('Courses.Courses::enrolle',[$course->id]);
                                        echo $enrolled;
                                    ?> </h4>
                                </div>
                                <div class="col-sm-8 col-lg-3 col-md-4 col-xs-6 cdb-enrolled">
                                    <p>Course Fee</p>
                                    <h4>
                                        <?php if(!empty($course->discount_price)){ ?>
                                        <span><?= $this->Number->currency($course->price, 'INR') ?></span>
                                        <?= $this->Number->currency(($course->price - $course->discount_price), 'INR') ?>
                                    <?php } else {
                                        echo $this->Number->currency($course->price, 'INR');
                                    } ?>
                                    </h4>
                                </div>
                            </div>
                            <?php if(!$this->request->getAttribute('identity') || ($this->request->getAttribute('identity') && empty($course->order_courses)) && ($this->request->getAttribute('identity') && $this->request->getAttribute('identity')->id != $course->user_id)){ ?>
                                <div class="row">
                                    <div class="col-sm-5 mt50">
                                        <?php echo $this->Html->link("ENTROLL NOW", ['controller' => 'Courses', 'action' => 'buyNow', $course->id], ['class' => 'call-on-btn-2']) ?>
                                  </div>
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                    <?php if(!empty($course->sample_video)){ ?>
                    <div class="col-sm-4 cdb-video">
                        <div class="col-xs-12 cdm-video">
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#myVideoModal">
                                <?php
                                $sampleVideo = $course->sample_video;
                                $vId = explode("/", $course->sample_video);
                                echo $this->Html->image(
                                    'https://img.youtube.com/vi/'. (end($vId)) .'/0.jpg', ['class' => 'video-thumb']);

                                echo $this->Html->image('play-button.png', ['class' => 'play-btn']);
                                ?>
                                <p>Course Preview</p>
                            </a>
                        </div>
                        <div class="modal fade" id="myVideoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog  modal-lg" role="document">
                                <div class="modal-content" style="border-radius: 0px">
                                    <div class="modal-body" style="padding: 0px">
                                        <iframe width="100%" height="500" src="<?= $sampleVideo ?>" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" frameborder="0" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="course-detail-main">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-lg-8 col-md-7">
                    <div class="col-xs-12 cdm-section">
                        <h3 class="cdm-title"><span>Description</span></h3>
                        <div class="col-xs-12 nopadding">
                            <div class="col-xs-12 <?= strlen($course->description) > 200 ? "cdm-description" : "" ?>">
                                <?= $course->description ?>
                            </div>
                            <?php if(strlen($course->description) > 200){ ?>
                            <div class="col-xs-12 mt20">
                                <a href="javascrip:void(0)" class="color-orange" id="desc-read-more">+ Read more..</a>
                            </div>
                        <?php } ?>
                        <div class="col-xs-12 mt20">
                            <a href="javascrip:void(0)" class="color-orange" id="desc-less">- View less..</a>
                        </div>
                        </div>
                    </div>
                    <div class="col-xs-12 cdm-section">
                        <h3 class="cdm-title"><span>Course</span> Content</h3>
                        <div class="col-xs-12 no-pad">
                            <?php
                            $downloadableResourse = 0;
                            if($course->course_chapters){
                            $slides = $course->course_chapters;
                                foreach($course->course_chapters as $chkInc => $chapter) {
                                    $is_loginrequired = false;
                                    $purchaseRequired = false;
                                    if($chapter->is_free == 1 || ($this->request->getAttribute('identity') && !empty($course->order_courses))){
                                            $is_loginrequired = false;
                                        }else if(!$this->request->getAttribute('identity') && $chapter->is_free != 1){
                                            $is_loginrequired = true;
                                        }else if(($this->request->getAttribute('identity') && empty($course->order_courses)) && $chapter->is_free != 1){
                                            $purchaseRequired = true;
                                        }

                                        if($this->request->getAttribute('identity') && $this->request->getAttribute('identity')->id == $course->user_id){
                                            $is_loginrequired = false;
                                            $purchaseRequired = false;
                                        }

                                ?>
                                <div class="col-sm-12 course-content-box">
                                    <div class="ccb-title" id="ccb-title-<?= ($chkInc + 1) ?>">
                                        <table>
                                            <tr>
                                                <td><i class="glyphicon glyphicon-minus"></i>
                                                    Chapter <?= ($chkInc + 1) ?> - <?= $chapter->title ?>
                                                </td>
                                                <td> </td>
                                                <td></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="ccb-content" id="ccb-content-<?= ($chkInc + 1) ?>">
                                        <table>
                                            <?php if(!empty($chapter->video_url)){

                                                ?>
                                            <tr>
                                                <td><a href="javascript:void(0)" class="<?= ($is_loginrequired == true ? "loginrequired" : "") . ($purchaseRequired == true ? " purchaseRequired" : "") ?>" data-toggle="modal" data-target="#course-video-<?= $chkInc ?>"><i class="far fa-play-circle mr-5"></i><?= $chapter->title ?> - video</a></td>
                                                <td>
                                                    <?php if($chapter->is_free == 1 || ($this->request->getAttribute('identity') && !empty($course->order_courses)) || $this->request->getAttribute('identity') && $this->request->getAttribute('identity')->id == $course->user_id){ ?>
                                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#course-video-<?= $chkInc ?>">Preview</a>

                                                    <div class="modal fade" id="course-video-<?= $chkInc ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                        <div class="modal-dialog  modal-lg" role="document">
                                                            <div class="modal-content" style="border-radius: 0px">
                                                                <div class="modal-body" style="padding: 0px">
                                                                    <iframe width="100%" height="500" src="<?= $chapter->video_url ?>" frameborder="0" allowfullscreen></iframe>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php }
                                               /* elseif($this->request->getAttribute('identity') && !empty($course->order_courses)){

                                                } */
                                                ?>
                                                </td>
                                            </tr>
                                        <?php } if(!empty($chapter->chapter_file)){
                                                $downloadableResourse++;
                                             ?>
                                            <tr>
                                                <td>
                                                    <?php if($chapter->is_free == 1 || ($this->request->getAttribute('identity') && !empty($course->order_courses)) || $this->request->getAttribute('identity') && $this->request->getAttribute('identity')->id == $course->user_id){
                                                        echo $this->Html->link('<i class="fas fa-file-download mr-5"></i> Download Resourse', ['controller' => 'CourseChapters', 'action' => 'download', $chapter->id], ['escape' => false]);
                                                    }else{
                                                        echo $this->Html->link('<i class="fas fa-file-download mr-5"></i> Download Resourse', 'javascript:void(0)', ['escape' => false, 'class' => ($is_loginrequired == true ? "loginrequired" : "") . ($purchaseRequired == true ? " purchaseRequired" : "")]);
                                                    }?>

                                                </td>
                                                 <td>
                                                    <?php if($chapter->is_free == 1 || ($this->request->getAttribute('identity') && !empty($course->order_courses)) || $this->request->getAttribute('identity') && $this->request->getAttribute('identity')->id == $course->user_id){
                                                        echo $this->Html->link('Download', ['controller' => 'CourseChapters', 'action' => 'download', $chapter->id], ['escape' => false]);
                                                    }?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                            <tr>
                                                <td>
                                                    <?= $this->Html->link('<i class="far fa-file-alt mr-5"></i>READ BEFORE YOU START!', 'javascript:void(0)', ['class' => 'chapterDesc' . ($is_loginrequired == true ? " loginrequired" : "") .($purchaseRequired == true ? " purchaseRequired" : ""), 'escape' => false]) ?>

                                                </td>
                                                <td></td>
                                            </tr>
                                            <?php if($chapter->is_free == 1 || ($this->request->getAttribute('identity') && !empty($course->order_courses)) || $this->request->getAttribute('identity') && $this->request->getAttribute('identity')->id == $course->user_id){ ?>
                                                <tr class="chapterDescription" style="display:none;">
                                                    <td colspan="2">
                                                        <?= $chapter->description ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </table>
                                    </div>
                                </div>
                            <?php }
                            } ?>

                        </div>
                    </div>
                    <?php if(!empty($course->features)){ ?>
                    <div class="col-xs-12 cdm-section" id="whyyouChoseCourse">
                        <h3 class="cdm-title"><span>Why you will</span> Choose this Course</h3>
                        <div class="col-xs-12 nopadding">
                            <div class="col-xs-12">
                                <!-- <ul class="cdm-learn-poits">
                                    <li>Real-world skills to build real-world websites professional, beautiful and truly responsive websites</li>
                                    <li>The proven 7 real-world steps from complete scratch to a fully functional and optimized website</li>
                                    <li>Learn super cool jQuery effects like animations, scroll effects and "sticky" navigation</li>
                                    <li>A huge project that will teach you everything you need to know to get started with HTML5 and CSS3</li>
                                    <li>Simple-to-use web design guidelines and tips to make your website stand out from the crowd</li>
                                    <li>Downloadable lectures, code and design assets for the entire project</li>
                                </ul> -->
                                <?= $course->features ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                    <div class="col-xs-12 cdm-section">
                        <h3 class="cdm-title"><span>About the Instructor</span></h3>
                        <div class="col-xs-12">
                            <div class="col-xs-12 cdm-f-review cdm-instu">
                                <table>
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
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <h3>
                                                        <?php for($s = 1; $s <= 5; $s++){
                                                            if($s <= round($course->user->teacher_rating)){
                                                                echo '<i class="fas fa-star"></i>';
                                                            }else{
                                                                echo '<i class="far fa-star" style=""></i>';
                                                            }
                                                        } ?>
                                                        <?= round($course->user->teacher_rating,1) ?> Instructor Ratings</h3>

                                                    <h3 class="mt-10"><i class="fas fa-comment-dots mr-5"></i><strong class="mr-5"><?php echo count($course->user->reviews); ?></strong>Reviews</h3>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h3><i class="fas fa-users mr-5"></i><strong class="mr-5"><?php echo $enrolled ?></strong>Students</h3>
                                                    <h3 class="mt-10"><i class="fas fa-desktop mr-5"></i><strong class="mr-5"><?= $totalCourses ?></strong>Course(s)</h3>
                                                </div>
                                                <div class="col-sm-12 <?= isset($course->user->user_profile) && (strlen($course->user->user_profile->about_me) > 500) ? "instru-details" : "" ?>">
                                                    <?= $this->Html->link($course->user->name, ['controller' => 'Users', 'action' => 'profile', 'plugin' => 'UserManager', $course->user->id], ['class' => 'instru-name']) ?>

                                                    <h4 class="instru-desi"><?= $course->user->user_profile->qualification ?></h4>
                                                    <div class="clear-both"></div>
                                                    <div>
                                                        <?= $course->user->user_profile->about_me ?>
                                                    </div>
                                                </div>
                                                <?php if(!empty($course->user->user_profile->about_me) && strlen($course->user->user_profile->about_me) > 500){ ?>
                                                <div class="col-sm-12 mt-10">
                                                    <a href="javascrip:void(0)" class="color-orange" id="instructor-read">+ Read more..</a>
                                                </div>
                                            <?php } ?>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php if(!empty($course->reviews)){ ?>
                    <div class="col-xs-12 cdm-section">
                        <div class="col-xs-12">
                            <div class="cdm-review-main">
                                <div class="col-sm-12 cdm-tab-main">
                                    <div class="col-sm-8 col-sm-offset-2 reviews-2">
                                        <div class="col-sm-5">
                                            <h2><?= round($course->avg_rating,1) ?></h2>
                                            <span class="stars">
                                                <?php for($s = 1; $s <= 5; $s++){
                                                    if($s <= round($course->avg_rating)){
                                                        echo '<i class="fas fa-star"></i>';
                                                    }else{
                                                        echo '<i class="far fa-star" style=""></i>';
                                                    }
                                                } ?>
                                            </span>
                                            <p>From <?php echo count($course->reviews); ?> Review(s)</p>
                                        </div>
                                        <div class="col-sm-7">
                                            <?php
                                            $rtbl = [];

                                            foreach($course->reviews as $rv){
                                                $rtbl[$rv->rating]  = $rtbl[$rv->rating] ?? 0;
                                                $rtbl[$rv->rating]++;
                                            }
                                            //dump($rtbl);
                                            ?>
                                            <table>
                                                <tbody>
                                                    <?php for($s = 5; $s > 0; $s--){ ?>
                                                    <tr>
                                                        <td><?= $s ?><i class="fas fa-star"></i></td>
                                                        <td>
                                                            <div class="progress">
                                                                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?= (($rtbl[$s] ?? 0) / 5) * 100 ?>%;">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><?= $rtbl[$s] ?? 0 ?></td>
                                                    </tr>
                                                <?php } ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row cdm-review-list">
                                        <div class="col-sm-12 cdm-review-box">
                                            <table>
                                                <?php foreach($course->reviews as $review){ ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $this->Html->image('Authors/no-image.jpg', ['class' => '']) ?></td>

                                                    <td>
                                                    <span class="stars">
                                                        <?php for($s = 1; $s <= 5; $s++){
                                                                if($s <= $review->rating){
                                                                    echo '<i class="fas fa-star"></i>';
                                                                }else{
                                                                    echo '<i class="far fa-star" style=""></i>';
                                                                }
                                                            } ?>
                                                      </span>
                                                        <h3><?= $review->name ?></h3>
                                                        <h6>
                                                            <?= $review->created->timeAgoInWords(['format' => 'MMM d, YYY', 'end' => '+1 year']) ?></h6>
                                                    </td>
                                                    <td>
                                                        <?php
                                                    echo $this->Text->truncate($review->description,450,
                                                            [
                                                                'ellipsis' => '...',
                                                                'exact' => false
                                                            ]
                                                        );
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            </table>
                                        </div>
                                        <!-- <div class="col-sm-12 text-center mt-20">
                                            <a href="#" class="cdm-review-plus">+<?php echo count($course->reviews); ?> Review(s)</a>
                                        </div> -->
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php } ?>
                </div>
                <div class="col-xs-12 col-lg-4 col-md-5 cdm-right">

                    <div class="col-xs-12 cdm-right-details">
                        <?php if(!$this->request->getAttribute('identity') || ($this->request->getAttribute('identity') && empty($course->order_courses)) && ($this->request->getAttribute('identity') && $this->request->getAttribute('identity')->id != $course->user_id)){  ?>
                        <div class="col-xs-12">

                            <h3 class="cdm-right-price">
                                <?php if(!empty($course->discount_price)){ ?>
                                    <span><?= $this->Number->currency($course->price, 'INR') ?></span>
                                    <?= $this->Number->currency(($course->price - $course->discount_price), 'INR') ?>
                                    <?php
                                        $discP = round(($course->discount_price / $course->price) * 100, 2);
                                     ?>
                                    <sup><?= $discP ?>% Off</sup>
                                <?php } else {
                                    echo $this->Number->currency($course->price, 'INR');
                                } ?>

                            </h3>
                            <?php
                                echo $this->Html->link("<span>BUY</span> NOW", ['controller' => 'Courses', 'action' => 'buyNow', $course->id], ['class' => 'cdm-right-buy-btn', 'escape' => false]);

                             ?>
                        </div>
                    <?php } ?>

                        <div class="col-xs-12 mt30 cdm-right-what-you-get">
                            <h3>What you get</h3>
                            <p><i class="far fa-play-circle mr-5"></i><?= $course->duration ?> hour(s) on-demand video</p>
                            <!-- <p><i class="far fa-file-alt mr-5"></i><?= $course->total_chapters ?> articles</p> -->
                            <p><i class="fas fa-file-download mr-5"></i><?= $downloadableResourse ?> downloadable resources</p>
                            <p><i class="far fa-check-square mr-5"></i>Full lifetime access</p>
                            <p><i class="fas fa-trophy mr-5"></i>Certificate of Completion</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
$this->assign('title', $course->title);
$this->Html->meta(
    'keywords', "Teaching Bharat | Online course | online education | online video", ['block' => true]
);
$this->Html->meta(
    'description', $course->short_description, ['block' => true]
);

?>

<?php $this->Html->scriptStart(['block' => true]); ?>
$(document).ready(function () {

            if($("#whyyouChoseCourse").length > 0){
                $("#whyyouChoseCourse").find("ul").addClass("cdm-learn-poits");
            }

            $('.panel-collapse').on('show.bs.collapse', function () {
                $(this).siblings('.panel-heading').addClass('active');
            });

            $('.panel-collapse').on('hide.bs.collapse', function () {
                $(this).siblings('.panel-heading').removeClass('active');
            });

            $('.ccb-title').click(function () {
                $(this).find('.glyphicon-minus, .glyphicon-plus').toggleClass('glyphicon-plus glyphicon-minus');
            });
            <?php for($cct = 1; $cct <= $course->total_chapters; $cct++){ ?>
                $("#ccb-title-<?= $cct ?>").click(function () {
                    $("#ccb-content-<?= $cct ?>").slideToggle();
                });
            <?php } ?>

            // right-scroll and fixed

            var fixmeTop = $('.cdm-right-details').offset().top;

            $(window).scroll(function () {

                var currentScroll = $(window).scrollTop();

                if (currentScroll >= fixmeTop) {
                    $('.cdm-right-details').css({
                        position: 'fixed',
                        top: '65px',
                        right: '2%',
                        width: '32.2%',
                    });
                } else {
                    $('.cdm-right-details').css({
                        position: 'relative',
                        width: '100%',
                        right: 'auto',
                    });
                }

            });

            $.fn.followTo = function (pos) {
                var $this = this,
                    $window = $(window);

                $window.scroll(function (e) {
                    if ($window.scrollTop() > pos) {
                        $this.css({
                            position: 'absolute',
                            width: '100%',
                            right: 'auto',
                        });
                    }
                });
            };

            $('.cdm-right-details').followTo(2700);

            // Description Read more

            $("#desc-read-more").click(function () {
                $(".cdm-description").css("height", "auto");
                $(".cdm-description").css("overflow", "visible");
                $("#desc-read-more").css("display", "none");
                $("#desc-less").css("display", "block");
            });
            $("#desc-less").click(function () {
                $(".cdm-description").css("height", "100px");
                $(".cdm-description").css("overflow", "hidden");
                $("#desc-read-more").css("display", "block");
                $("#desc-less").css("display", "none");
            });

            // Instructor Ream more
            $("#instructor-read").click(function () {
                $(".instru-details").css("height", "auto");
                $(".instru-details").css("overflow", "visible");
                $("#instructor-read").css("display", "none");
            });

            $("a.chapterDesc").on("click", function(event){
                event.preventDefault();
                //console.log($(this).parent('tr'));
                $(this).closest('table').find('tr.chapterDescription').toggle();
            });

            $(".loginrequired").on("click", function(event){
                event.preventDefault();
                $.confirm({
                    title: '',
                    columnClass: 'medium',
                    content: 'You are not authorized to access that course. please login to visit course!!',
                    buttons: {
                          Ok: function(){
                              location.href = '<?= $this->Url->build(['controller' => 'Users', 'action' => 'login', 'plugin' => 'UserManager', '?' => ['redirect' => $this->Url->build(['controller' => 'Courses', 'action' => 'view', 'plugin' => 'Courses', $course->id],['fullBase' => true])]]) ?>';
                          }
                      }
                });
            });

            $(".purchaseRequired").on("click", function(event){
                event.preventDefault();
                $.confirm({
                    title: '',
                    columnClass: 'medium',
                    content: 'This is paid course that you need to buy',
                    buttons: {
                       buy: {
                        text: 'Buy Now',
                        btnClass: 'btn btn-block btn-success btn-sm',
                        action: function(){
                            location.href = "<?= $this->Url->build(['controller' => 'Courses', 'action' => 'buyNow', $course->id]) ?>";
                          }
                      }
                  }
                });
            })

        });
<?php $this->Html->scriptEnd(); ?>
