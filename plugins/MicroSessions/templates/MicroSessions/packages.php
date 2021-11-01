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
 <section class="package-pro-header">
    <img src="/img/packages/pro-banner.jpg" class="img-full">
    <div class="container top-130">
        <div class="col-sm-8">
            <div class="col-sm-12 package-body-white">
                <div class="row">
                    <div class="col-sm-12 package-heading">
                        <h3>About <span>Pro Packages</span></h3>
                    </div>
                    <?php 
                    //echo "<pre>";
                    //print_r($allpackages);
                    //echo $allpackages;
                    // die;

                    ?>
                    <div class="col-sm-12 pad-15-all">
                        <ul class="star-bullets">
                            <?php foreach ($allpackages as $pack): ?>
                            <li><?=$pack->package_name;?><br><?=$pack->short_description;?></li>
                             <?php  
                            //endif;
                            endforeach; ?>
                            
                        </ul>
                       <!--- <div class="col-sm-12 text-center pad-15-all">
                            <a href="#" class="watch-video-btn">Watch Video<img src="/img/packages/video.svg" /></a>
                        </div>--->
                        <div class="col-sm-12 pad-15-all">
                            <h4 class="mb-20">What is included in Teaching Bharat PRO?</h4>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="col-sm-12 icon-box-package">
                                        <span class="icon-box-img-bg">
                                            <img src="/img/packages/icon-1.svg" />
                                        </span>
                                        <h5>Clear your doubts during the LIVE Class</h5>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="col-sm-12 icon-box-package">
                                        <span class="icon-box-img-bg">
                                            <img src="/img/packages/icon-2.svg" />
                                        </span>
                                        <h5>Notes, Assignment & Recording after Class</h5>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="col-sm-12 icon-box-package">
                                        <span class="icon-box-img-bg">
                                            <img src="/img/packages/icon-3.svg" />
                                        </span>
                                        <h5>Chapter wise Test and performance report</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 pad-15-all">
                            <h4 class="mb-20">Why Teaching Bharat PRO is thebest?</h4>
                            <div class="row">
                                <div class="col-sm-12 mb-20">
                                    <h5><img src="/img/packages/icon-4.svg" width="20px" /> Online LIVE Classes</h5>
                                    <ul class="package-tick-list">
                                        <li><img src="/img/packages/check.svg" width="12px"> LIVE & Interactive Teaching Style</li>
                                        <li><img src="/img/packages/check.svg" width="12px"> Fun Visualizations</li>
                                        <li><img src="/img/packages/check.svg" width="12px"> Engaging Quizzes & Leaderboards</li>
                                        <li><img src="/img/packages/check.svg" width="12px"> Replays of past sessions</li>
                                    </ul>
                                </div>
                                <div class="col-sm-12 mb-20">
                                    <h5><img src="/img/packages/icon-5.svg" width="20px" /> Test Series & Analysis</h5>
                                    <ul class="package-tick-list">
                                        <li><img src="/img/packages/check.svg" width="12px"> Test on every chapter</li>
                                        <li><img src="/img/packages/check.svg" width="12px"> Test analysis and discussion</li>
                                    </ul>
                                </div>
                                <div class="col-sm-12">
                                    <h5><img src="/img/packages/icon-6.svg" width="20px" /> Assignment & Study Materials</h5>
                                    <ul class="package-tick-list">
                                        <li><img src="/img/packages/check.svg" width="12px"> Get notes curated by top Subject experts</li>
                                        <li><img src="/img/packages/check.svg" width="12px"> Class Notes, Assignments after every class</li>
                                        <li><img src="/img/packages/check.svg" width="12px"> Special exam focussed study material</li>
                                        <li><img src="/img/packages/check.svg" width="12px"> Access recordings of all LIVE classes</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 package-heading top-border-line">
                        <h3>Who are the Master Teachers in Teaching Bharat <span>Pro?</span></h3>
                    </div>
                    <div class="col-sm-12 pad-15-all">
                    <?php 
                                foreach ($teacher as $tech): ?>
                        <div class="col-sm-4">
                            <div class="col-sm-12 packages-teacher-box">
                                <div class="packages-teacher-box-inner">
                                    
                                <?php 
                                      

                                        
                                         if (!empty($tech->user->photo_dir) && !empty($tech->user->profile_photo) && file_exists("img/".$tech->user->photo_dir . $tech->user->profile_photo)) { 
                                            $userPhoto = $tech->user->photo_dir . $tech->user->profile_photo;
                                        }else{
                                            $userPhoto = 'Authors/01.jpg';
                                        }

                                        echo $this->Html->image($userPhoto, ['class' => 'ptb-image'])?>
                                    
                                    <h4><?= $this->Html->link($tech->first_name.' '.$tech->last_name, ['action' => 'teachersession', $tech->id], ['class' => 'name']) ?></h4>
                                    <p>B.Tech, Alliance University</p>
                                    <p>Physics</p>
                                    <a href="#">View Details</a>
                                </div>
                            </div>
                        </div>
                       <?php  
                            //endif;
                            endforeach; ?>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 package-heading top-border-line">
                        <h3>Frequently Asked Questions</h3>
                    </div>
                    <div class="col-sm-12 pad-15-all">
                        <div class="panel-group faq-panel-package" id="accordion" role="tablist" aria-multiselectable="true">
                          <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                              <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                  1. Do I need a special device to attend classes?
                                </a>
                              </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                              <div class="panel-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                              </div>
                            </div>
                          </div>
                          <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">
                              <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                  2. Is there a limit to the number of courses I can access as part of this subscription?
                                </a>
                              </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                              <div class="panel-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                              </div>
                            </div>
                          </div>
                          <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                              <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                  3. What if all the batches have already started and I have missed some LIVE classes?
                                </a>
                              </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                              <div class="panel-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 sticky-top">
            <div class="col-sm-12 package-body-white ">
                <div class="row">
                    <div class="col-sm-12 package-heading">
                        <h3>Plans</h3>
                    </div>
                    <div class="col-sm-12 pad-15-all">
                        <p class="text-xs-p">Use coupon VFLASH for extra 20% off. Offer Ends soon!</p>
                        <div class="plan-selection-package selected">
                            
                            <?php foreach ($allplans as $plan): ?>
                            <table>
                                <tr>
                                    <td>
                                        <h4><strong><?=$plan->plan_name;?></strong></h4>
                                        <h4><strong><?=$plan->duration;?></strong> Month</h4>
                                        <h5><span class="price-cross">₹ <?=$plan->price;?></span>₹ <?=$plan->discount_price;?>/month</h5>
                                    </td>
                                </tr>
                            </table>
                             <?php  
                            
                            endforeach; ?>
                        </div>
                       <!-- <div class="plan-selection-package">
                            <table>
                                <tr>
                                    <td>
                                        <h4>Till Jun'21<span>2020-21 academic year.</span></h4>
                                        <h5><span class="price-cross">₹2000</span>₹1402/month<span class="discount-number">7% Saved</span></h5>
                                    </td>
                                </tr>
                            </table>
                        </div>-->
                        <div class="col-sm-12 pad-15-all">
                            <h5>Included in this plan</h5>
                            <ul class="star-bullets full-width-li">
                                <li>Unlimited LIVE Interactive Classes</li>
                                <li>Test Series & Analysis</li>
                                <li>Assignments & Notes</li>
                            </ul>
                        </div>
                        <div class="col-sm-12 pad-15-all text-center">
                            <a href="#" class="cdm-right-buy-btn mb-20">PROCEED TO PAY</a>
                            <p class="text-xs-p">Terms & Condition applied</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
