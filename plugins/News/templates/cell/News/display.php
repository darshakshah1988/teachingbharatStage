 <?php if(!$newsposts->isEmpty()){ 
  foreach($newsposts as $newspost){
    ?>
 <div class="item">
      <div class="causes bg-lighter box-hover-effect effect1 sm-maxwidth500 mb-sm-30">
        <div class="thumb">
          <?php 
          $carouselImg = ['w' => '360', 'h' => '195','fit'=>'crop'];
          
          ?>
          <?php
            if (!empty($newspost->banner_image) && file_exists("img/".$newspost->banner_path . $newspost->banner_image)) {
                 echo $this->Glide->image($newspost->banner_path . $newspost->banner_image, $carouselImg, ['class' => 'img-fullwidth']);
            }else{
                echo $this->Glide->image("no_image.gif", $carouselImg, ['class' => 'img-fullwidth']);
            }
            ?> 
        </div>
        <div class="causes-details clearfix border-bottom p-10 pt-10">
          <h5 class="entry-title mt-0 pt-0">
            <?php echo $this->Html->link($newspost->title, ['controller' => 'Newsposts', 'action' => 'detail', 'plugin' => 'News', $newspost->slug], ['class' => 'text-uppercase text-theme-colored']) ?>
            </h5>
          
            <p class="text-left mb-10 mt-10 font-13">
                <?php echo $this->Text->truncate($newspost->short_description, 175, ['ellipsis' => '...','exact' => false]); ?>
              </p>
             <div class="donate-details">
              <?php echo $this->Html->link("Read More", ['controller' => 'Newsposts', 'action' => 'detail', 'plugin' => 'News', $newspost->slug], ['class' => 'btn btn-dark btn-theme-colored btn-flat btn-sm pull-left mt-0']) ?>
             </div>
        </div>
      </div>
    </div>
<?php } } ?>

