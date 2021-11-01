<?php 
$carouselImg = ['w' => '75', 'h' => '75','fit'=>'crop'];
 if(!$events->isEmpty()){ 
  foreach($events as $event){
    ?>
<div class="event media sm-maxwidth400 p-15 mt-0 mb-15">
    <div class="row">
      <div class="col-xs-3 p-0">
        <div class="thumb pl-15">
          <?php
            if (!empty($event->banner) && file_exists("img/".$event->banner_path . $event->banner)) {
                 echo $this->Glide->image($event->banner_path . $event->banner, $carouselImg, ['class' => 'media-object']);
            }else{
                echo $this->Glide->image("no_image.gif", $carouselImg, ['class' => 'media-object']);
            }
            ?>
          <?php 
        
        //echo $this->Glide->image("banners/RD7.jpg", $carouselImg, ['class' => 'media-object']);
        ?>
        </div>
      </div>
      <div class="col-xs-6 p-0 pl-15">
        <div class="event-content">
          <h5 class="media-heading text-uppercase font-11">
            <?php echo $this->Html->link($this->Text->truncate($event->title, 40, ['ellipsis' => '...','exact' => false]), ['controller' => 'Events', 'action' => 'detail', 'plugin' => 'Events', $event->slug], ['class' => '']) ?>
          </h5>
          <ul>
            <li><i class="fa fa-clock-o"></i> at <?php echo $event->start_date->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_FORMAT')) ?></li>
            <li> <i class="fa fa-map-marker"></i> <?php echo $event->location; ?>.</li>
          </ul>                    
        </div>                
      </div>
      <div class="col-xs-3 pr-0">
        <div class="event-date text-center">
          <ul>
            <li class="font-24 text-theme-colored font-weight-700"><?php echo $event->start_date->format('d') ?></li>
            <li class="font-20 text-center text-uppercase"><?php echo $event->start_date->format('M') ?></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
<?php } } ?>
