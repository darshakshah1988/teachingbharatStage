<section class="master_class_header">
    <div class="container">
        <div class="col-sm-10 col-sm-offset-1 master-detail-top-text">
            <h5><span>FREE</span> LIVE ONLINE MASTERCLASS</h5>
            <h2><?= $course->title ?></h2>
            <!-- <h3 class="mb-0">MasterClass is Live! Join now.</h3> -->
        </div>
        <div class="col-sm-8 col-sm-offset-2 master-video-box">
            <iframe width="100%" height="500" src="<?= $course->course_url ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
</section>
<!-- <section class="master-course-details">
    <div class="container">
        <div class="col-sm-12 master-course-details-titles">
            <h2><?= $course->title ?></h2>
        </div>
        <div class="col-sm-10 col-sm-offset-1 master-confirm-box">
            <h3 class="master-title-3 text-center">Course Overview</h3>
            <?= $course->description ?>
        </div>
    </div>
</section> -->
<section class="master-course-details">
    <div class="container">
        <div class="col-sm-12 master-course-details-titles">
            <h2>Game Creator Program</h2>
            <h2>LIVE online coding classes from Expoerts</h2>
            <h3>Launching - For kids of 6 - 12 years</h3>
        </div>
        <div class="col-sm-10 col-sm-offset-1 master-confirm-box">
            <h3 class="master-title-3 text-center">Course Overview</h3>
            <ul class="master-bullets-1">
                <li>Lorem dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</li>
                <li>Lorem ipsum consectetur adipiscing elit, sed do eiusmod tempor.</li>
                <li>Lorem  dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</li>
                <li>Lorem ipsum dolor sit amet, adipiscing elit, sed do eiusmod tempor.</li>
                <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, tempor.</li>
                <li>Lorem ipsum dolor sit amet, adipiscing elit, sed do eiusmod tempor.</li>
            </ul>
            <div class="clearfix"></div>
            <p class="mt40 text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
        </div>
        <div class="col-sm-12 text-center">
            <a href="#" class="master-l-btn-orange">BUY THIS COURSE NOW</a>
        </div>
    </div>
</section>
<!-- <section class="master_class_body-light">
    <div class="container">
        <div class="col-sm-10 col-sm-offset-1">
            <h3 class="master-title-3 text-center">WHO WILL TEACH</h3>
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators" style="bottom: -40px">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active" style="border-color: #000000"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1" style="border-color: #000000"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2" style="border-color: #000000"></li>
                  </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="item active col-sm-12 master-detail-top-box mb0">
                        <img src="Include/img/phase-3/teacher.jpg" class="master-detail-top-box-profile">
                        <div class="col-sm-12">
                            <h5>Coding Expert</h5>
                            <h3>LIPIKA SHARMA<span>B.Tech - MBA - PGDCS</span></h3>
                            <ul class="master-detail-top-box-bullets">
                                <li>2 years of Teaching experience</li>
                                <li>Taught and Mentored 2000 NTSE Aspirants</li>
                                <li>Got 200+ NTSE Selections</li>
                                <li>2.5 Years of teaching experience in Digital as well and reputed offline coaching institutes</li>
                            </ul>
                        </div>
                    </div>
                    <div class="item col-sm-12 master-detail-top-box mb0">
                        <img src="Include/img/phase-3/teacher.jpg" class="master-detail-top-box-profile">
                        <div class="col-sm-12">
                            <h5>Coding Expert</h5>
                            <h3>LIPIKA SHARMA<span>B.Tech - MBA - PGDCS</span></h3>
                            <ul class="master-detail-top-box-bullets">
                                <li>2 years of Teaching experience</li>
                                <li>Taught and Mentored 2000 NTSE Aspirants</li>
                                <li>Got 200+ NTSE Selections</li>
                                <li>2.5 Years of teaching experience in Digital as well and reputed offline coaching institutes</li>
                            </ul>
                        </div>
                    </div>
                    <div class="item col-sm-12 master-detail-top-box mb0">
                        <img src="Include/img/phase-3/teacher.jpg" class="master-detail-top-box-profile">
                        <div class="col-sm-12">
                            <h5>Coding Expert</h5>
                            <h3>LIPIKA SHARMA<span>B.Tech - MBA - PGDCS</span></h3>
                            <ul class="master-detail-top-box-bullets">
                                <li>2 years of Teaching experience</li>
                                <li>Taught and Mentored 2000 NTSE Aspirants</li>
                                <li>Got 200+ NTSE Selections</li>
                                <li>2.5 Years of teaching experience in Digital as well and reputed offline coaching institutes</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
<section class="master_class_body-white">
    <div class="container">
        <div class="col-sm-12">
            <h3 class="master-title-3 text-center">COURSE OFFERINGS</h3>
            <div class="col-sm-4">
                <div class="col-sm-12 master-offering-box">
                    <?php echo $this->Html->image("phase-3/01.svg", ['width' => '60px']) ?>
                  <!--   <img src="Include/img/phase-3/01.svg" width="60px"> -->
                    <h3>LIVE Interactive<br>Classes</h3>
                    <ul>
                        <li>LIVE & Interactive Teaching Style: Fun Visualizations, Quizzes & Leaderboards</li>
                        <li>Daily Classes on WAVE platform to clear all In-class doubts</li>
                        <li>Dual Teacher Model For Personal Attention</li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="col-sm-12 master-offering-box">
                    <?php echo $this->Html->image("phase-3/02.svg", ['width' => '60px']) ?>
                   <!--  <img src="Include/img/phase-3/02.svg" width="60px"> -->
                    <h3>Test Series &<br>Analysis</h3>
                    <ul>
                        <li>LIVE & Interactive Teaching Style: Fun Visualizations, Quizzes & Leaderboards</li>
                        <li>Daily Classes on WAVE platform to clear all In-class doubts</li>
                        <li>Dual Teacher Model For Personal Attention</li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="col-sm-12 master-offering-box">
                    <?php echo $this->Html->image("phase-3/03.svg", ['width' => '60px']) ?>
                    <h3>Assignments &<br>Notes</h3>
                    <ul>
                        <li>LIVE & Interactive Teaching Style: Fun Visualizations, Quizzes & Leaderboards</li>
                        <li>Daily Classes on WAVE platform to clear all In-class doubts</li>
                        <li>Dual Teacher Model For Personal Attention</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="master_class_bottom">
    <div class="container">
        <div class="col-sm-12">
            <div class="col-sm-6 master-get-table">
                <h3>WHAT YOU WILL GET</h3>
                <table>
                    <tr>
                        <td><?php echo $this->Html->image("phase-3/04.svg") ?></td>
                        <td>Track your progress and improve score</td>
                    </tr>
                    <tr>
                        <td><?php echo $this->Html->image("phase-3/05.svg") ?></td>
                        <td>Practice different varieties of questions</td>
                    </tr>
                    <tr>
                        <td><?php echo $this->Html->image("phase-3/06.svg") ?></td>
                        <td>Apply short tricks to solve problems faster</td>
                    </tr>
                    <tr>
                        <td><?php echo $this->Html->image("phase-3/07.svg") ?></td>
                        <td>Learn to use time Effectively in exam</td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-6">
                <h3>DETAILS AND PRICINGS</h3>
                <div class="col-sm-12 master-price-box">
                    <h3>STARTS ON <span>29th December, 2020</span></h3>
                    <h3>SCHEDULE on <span>30 DAYS: MON-SAT</span></h3>
                    <hr>
                    <h4><span>Price</span></h4>
                    <h2><span>₹ 10,000</span> ₹ 4,999/-</h2>
                    <h5>Save Additional 20% Off</h5>
                    <hr>
                    <a href="#" class="master-price-btn">ENROLL NOW</a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php 
echo $this->Html->css(['master_class.css'],['block' => true]);
?>