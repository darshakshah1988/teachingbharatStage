 <?php
 $this->layout = "microsessionfront";
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $microSession
 */
?>

<?php 
echo $this->Html->css(['/css/packages.css'],['block' => true]);
 //echo "<pre>";
 //print_r($user); die;


 ?>
 <div class="White79">
        <div class="ECStrip">
            <div class="container">
                <div class="col-md-12">
                    <ul class="centeralign">
                        <li class="active"><a>1 - TO - 1</a></li>
                        <li><a href="MySubscriptionOneToFew.html">1 - TO - FEW</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="ECmain">
            <div class="container">
                <div class="col-md-12 nopadding">
                    <div class="col-md-12 listing">
                        <div class="col-md-3 col-sm-6">
                            <a href="MySubscriptionsDetail.html">
                                <div class="col-md-12 box">
                                    <h1>10th CBSC Maths</h1>
                                    <h2>Start Date : 15/07/2016</h2>
                                    <div class="col-md-12 teacher">
                                        <p>Teacher</p>
                                        <img src="../Include/img/testi1.jpg" />
                                        <span class="t-name-sub">Dhaval Khatri</span>
                                    </div>
                                    <div class="col-md-12 bottom">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em;">0%</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="MySubscriptionsDetail.html">
                                <div class="col-md-12 box">
                                    <h1>10th CBSC Maths</h1>
                                    <h2>Start Date : 15/07/2016</h2>
                                    <div class="col-md-12 teacher">
                                        <p>Teacher</p>
                                        <img src="../Include/img/testi1.jpg" />
                                        <span class="t-name-sub">Dhaval Khatri</span>
                                    </div>
                                    <div class="col-md-12 bottom">
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">Session Completed</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
