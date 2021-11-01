<?php 
    $thumb = ['w' => '100', 'h' => '60','fit'=>'crop'];
    $large = ['w' => '1250', 'h' => '450','fit'=>'crop'];
?>
<?php if(!empty($banner)): 
    $inc = 0;
    foreach($banner->media_files as $mediaImg):
   if (!empty($mediaImg->media_image_path) && !empty($mediaImg->media_image) && file_exists("img/".$mediaImg->media_image_path . $mediaImg->media_image)) {
        $imagename = $mediaImg->media_image_path . $mediaImg->media_image;
    } else{
        $imagename = "no_image.gif";
    }
?>
            <!-- SLIDE <?php echo $inc; ?> -->
              <li data-index="rs-<?php echo $inc; ?>" data-transition="random" data-slotamount="7"  data-easein="default" data-easeout="default" data-masterspeed="1000"  data-thumb="<?php echo $this->Glide->url($imagename, $thumb); ?>"  data-rotate="0"  data-fstransition="fade" data-fsmasterspeed="1500" data-fsslotamount="7" data-saveperformance="off"  data-title="<?php echo $mediaImg->title; ?>" data-description="">
                <!-- MAIN IMAGE -->
               <!--  <img src="http://placehold.it/1920x1280"  alt=""  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-bgparallax="6" data-no-retina> -->
            <?php 
                echo $this->Glide->image($imagename, $large, ['data-bgposition' => 'center center', 'data-bgfit' => 'cover', 'data-bgrepeat' => 'no-repeat', 'class' => 'rev-slidebg', 'data-bgparallax' => '6', 'data-no-retina' => true]);
                ?>
                <!-- LAYERS -->
            <?php if(!empty($mediaImg->title)){ ?>
                <!-- LAYER NR. <?php echo $inc; ?> -->
                <div class="tp-caption BigBold-Title tp-resizeme rs-parallaxlevel-0 text-uppercase"
                  id="rs-<?php echo $inc; ?>-layer-1"

                  data-x="['left','left','left','left']" 
                  data-hoffset="['50','50','30','17']" 
                  data-y="['bottom','bottom','bottom','bottom']" 
                  data-voffset="['130','110','180','160']" 
                  data-fontsize="['40','80','60','50']"
                  data-lineheight="['42','70','50','50']"
                  data-width="['none','none','none','400']"
                  data-height="none"
                  data-whitespace="['nowrap','nowrap','nowrap','normal']"
                  data-transform_idle="o:1;"
                  data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeInOut;" 
                  data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
                  data-mask_in="x:0px;y:[100%];" 
                  data-mask_out="x:inherit;y:inherit;" 
                  data-start="500" 
                  data-splitin="none" 
                  data-splitout="none" 
                  data-basealign="slide" 
                  data-responsive_offset="on"
                  style="z-index: 6; white-space: nowrap; text-shadow: 1px 1px 2px black, 0 0 1em gray, 0 0 0.2em gray;">
                  <?php echo $mediaImg->title; ?>
                </div>
            <?php } 
             if(!empty($mediaImg->description)){ ?>
                <!-- LAYER NR. <?php echo $inc; ?> -->
                <div class="tp-caption BigBold-SubTitle tp-resizeme rs-parallaxlevel-0"
                  id="rs-<?php echo $inc; ?>-layer-2"

                  data-x="['left','left','left','left']" 
                  data-hoffset="['55','55','33','20']" 
                  data-y="['bottom','bottom','bottom','bottom']" 
                  data-voffset="['60','1','74','58']" 
                  data-fontsize="['17','15','15','13']"
                  data-lineheight="['24','24','24','20']"
                  data-width="['410','410','410','280']"
                  data-height="['60','100','100','100']"
                  data-whitespace="normal"
                  data-transform_idle="o:1;"
                  data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeInOut;" 
                  data-transform_out="y:50px;opacity:0;s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
                  data-start="650" 
                  data-splitin="none" 
                  data-splitout="none" 
                  data-basealign="slide" 
                  data-responsive_offset="on"
                  style="z-index: 7; min-width: 410px; max-width: 410px; max-width: 60px; max-width: 60px; white-space: normal;text-shadow: 1px 1px 2px black, 0 0 1em gray, 0 0 0.2em gray; color: white;">
                  <?php echo $mediaImg->description; ?>
                </div>
            <?php } if(!empty($mediaImg->external_link)){  ?>

                <!-- LAYER NR. <?php echo $inc; ?> -->
                <div class="tp-caption btn btn-default btn-transparent btn-flat btn-lg pl-40 pr-40 rs-parallaxlevel-0"

                  id="rs-<?php echo $inc; ?>-layer-3"
                  data-x="['left','left','left','left']" 
                  data-hoffset="['470','480','30','20']" 
                  data-y="['bottom','bottom','bottom','bottom']" 
                  data-voffset="['50','50','30','20']" 
                  data-width="none"
                  data-height="none"
                  data-whitespace="nowrap"
                  data-transform_idle="o:1;"
                  data-transform_hover="o:1;rX:0;rY:0;rZ:0;z:0;s:300;e:Power1.easeInOut;"
                  data-style_hover="c:rgba(255, 255, 255, 1.00);bc:rgba(255, 255, 255, 1.00);cursor:pointer;"
                  data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeInOut;" 
                  data-transform_out="y:50px;opacity:0;s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" 
                  data-start="650" 
                  data-splitin="none" 
                  data-splitout="none" 
                  data-actions='[{"event":"click","action":"simplelink","target":"_self", "url": "<?php echo $mediaImg->external_link; ?>"}]'
                  data-basealign="slide" 
                  data-responsive_offset="on"
                  style="z-index: 8; white-space: nowrap;border-color:rgba(255, 255, 255, 0.25);outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box; white-space: normal;text-shadow: 1px 1px 2px black, 0 0 1em gray, 0 0 0.2em gray; color:#FFFFFF">View More Detail 
                </div>
            <?php } ?>
              </li>
    <?php 
   // if(!empty($bannerImg->external_link)):
   //  if (!empty($bannerImg->image) && file_exists($_dir . $bannerImg->image)) {
   //      $imagename = str_replace("img/", "", $_dir) . $bannerImg->image;
   //      $banner = $this->Glide->image($imagename, ['w' => '1250', 'h' => '300','fit'=>'crop']);
   //  }else{
   //      $banner = $this->Glide->image('no_image.gif', ['w' => '1250', 'h' => '300','fit'=>'crop']);
   //  }
   //      echo $this->Html->link($banner,$bannerImg->external_link,['escape'=>false]);
   //  else:
   //      if (!empty($bannerImg->image) && file_exists($_dir . $bannerImg->image)) {
   //          $imagename = str_replace("img/", "", $_dir) . $bannerImg->image;
   //          echo $this->Glide->image($imagename, ['w' => '1250', 'h' => '300','fit'=>'crop']);
   //      }else{
   //          echo $this->Glide->image('no_image.gif', ['w' => '1250', 'h' => '300','fit'=>'crop']);
   //      }
        
   //  endif;  
	 
//	$this->Thumb()
    ?>
   <?php /*?> <div class="flex-caption">
        <h3><?= $bannerImg->title ?></h3> 
        <?php if(!empty($bannerImg->description)): ?>
        <p><?= $bannerImg->description ?></p> 
        <?php endif; ?>
    </div><?php */?>
<?php 
$inc++;
endforeach; ?>
<?php endif; ?>