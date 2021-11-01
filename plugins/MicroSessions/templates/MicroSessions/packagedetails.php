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

        <?php 
         foreach ($allpackages as $pack): 
            if($pack->package_file!='')
            {
        echo $this->Html->image('uploads/packages/package_file/'.$pack->package_file, ['class' => 'img-full']); 
           }else{ ?>
<img src="/img/packages/pro-banner.jpg" class="img-full">
           <?php }
endforeach;
        ?>
     
    <div class="container top-130">
        <div class="col-sm-8">
            <div class="col-sm-12 package-body-white">
                <div class="row">
                    <div class="col-sm-12 package-heading">
                        <h3>About <span><?=$pack->package_name;?></span></h3>
                    </div>
                  <div class="col-sm-12 pad-15-all">
                    <?php foreach ($allpackages as $pack): ?>
                    <div class="col-sm-12 pad-15-all">
                       <?=html_entity_decode($pack->about);?>
                       <?=html_entity_decode($pack->what_included);?>
                       <?=html_entity_decode($pack->what_best);?>
                    </div>
                    <?php endforeach; ?>
                  </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 package-heading top-border-line">
                        <h3>Who are the Master Teachers in Teaching Bharat <span>Pro?</span></h3>
                    </div>
                    <div class="col-sm-12 pad-15-all">
                    <?php 

//echo "<pre>";                              
//print_r($teacher);
//die;
							  foreach ($teacher as $tech): ?>
                        <div class="col-sm-4">
                            <div class="col-sm-12 packages-teacher-box">
                                <div class="packages-teacher-box-inner" style="min-height: 240px;">
                                    
        <?php  
        if (!empty($tech->user->photo_dir) && !empty($tech->user->profile_photo) && file_exists("img/".$tech->user->photo_dir . $tech->user->profile_photo)) { 
        $userPhoto = $tech->user->photo_dir . $tech->user->profile_photo;
        }else{
        $userPhoto = 'Authors/01.jpg';
        }

        echo $this->Html->image($userPhoto, ['class' => 'ptb-image'])?>
                                    
                                    <h4><?= $this->Html->link($tech->first_name.' '.$tech->last_name, ['controller' => 'Users', 'action' => 'profile', 'plugin' => 'UserManager', $tech->user_profile->user_id], ['class' => 'name']) ?></h4>
                                    <p><?= $tech->user_profile->college_university.' '.$tech->user_profile->qualification ?></p>
                    
                                   <!-- <p>Physics</p>-->
                                    <?= $this->Html->link('View Details', ['controller' => 'Users', 'action' => 'profile', 'plugin' => 'UserManager', $tech->user_profile->user_id], ['class' => 'instru-name']) ?>
									

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
                     <?= str_replace("<br>","",html_entity_decode($pack->faq));?>
                    
                </div>
            </div>
        </div>
         
       
        <div class="col-sm-4 sticky-top">
            <div class="col-sm-12 package-body-white ">
                <div class="row">
                    <div class="col-sm-12 package-heading">
                        <h3>Plans</h3>
                    </div>
                    <?php foreach ($allplans as $plan): ?>
                    <div class="col-sm-12 pad-15-all">
                        <p class="text-xs-p">Use coupon VFLASH for extra 20% off. Offer Ends soon!</p>
                        <div class="plan-selection-package selected">
                            
                            
                            <table>
                                <tr>
                                    <td>
                                        <h4><strong><?=$plan->plan_name;?></strong></h4>
                                     <!--    <h4><strong><? //=$plan->duration;?></strong> Month</h4> -->
                                        <h5><span class="price-cross">₹ <?=$plan->price;?> </span>₹ <?=$plan->price - $plan->discount_price;?>/month</h5>
                                    </td>
                                </tr>
                            </table>
                             
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
                            <?=$plan->other_details;?>
                        </div>
                        <div class="col-sm-12 pad-15-all text-center">
                        <?php echo $this->Html->link("PROCEED TO PAY", ['controller' => 'MicroSessions', 'action' => 'buypackage', $package_id, $plan->id], ['class' => 'cdm-right-buy-btn mb-20']) ?>
                           
                            <p class="text-xs-p">Terms & Condition applied</p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
       
        </div>
    </div>
</section>
