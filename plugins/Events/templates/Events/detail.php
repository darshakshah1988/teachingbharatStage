<?php

$large = ['w' => '1250', 'h' => '450','fit'=>'crop'];

if (!empty($event->banner_path) && !empty($event->banner) && file_exists("img/".$event->banner_path . $event->banner)) {
    $imagename = $event->banner_path . $event->banner;
} else {
    $imagename = "no_image.gif";
}
?>
<!-- Section: inner-header -->
<section class="inner-header divider layer-overlay overlay-dark" data-bg-img="<?php echo $this->Glide->url($imagename, $large); ?>">
  <div class="container pt-30 pb-30">
    <!-- Section Content -->
    <div class="section-content text-center">
      <div class="row"> 
        <div class="col-md-6 col-md-offset-3 text-center">
          <h2 class="text-theme-colored font-36"><?= $this->Text->truncate($event->title, 50, ['ellipsis' => '...','exact' => false]) ?></h2>
          <ol class="breadcrumb text-center mt-10 white">
            <li><?= $this->Html->link(__('Home'), ['controller' => 'Pages', 'action' => 'display','plugin' => \Cake\Core\Configure::read('Tech.theme_name')]) ?></li>
            <li><?php echo $this->Html->link(__d('events','Events'),['controller'=>'Events','action'=>'index']); ?></li>
            <li class="active"><?= $this->Text->truncate($event->title, 50, ['ellipsis' => '...','exact' => false]) ?></li>
          </ol>
        </div>
      </div>
    </div>
  </div>      
</section>

<!-- Section: inner-header -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <ul>
                    <li>
                        <h5>Topics:</h5>
                        <p><?php echo $event->title; ?></p>
                    </li>
                    <li>
                        <h5>Host:</h5>
                        <p><?php echo $event->organizar_name; ?></p>
                    </li>
                    <li>
                        <h5>Location:</h5>
                        <p><?php echo $event->location; ?></p>
                    </li>
                    <li>
                        <h5>Contact:</h5>
                        <p>
                        Email: <a href="mailto:<?php echo $event->organizer_email; ?>" class="text-theme-colored">
                            <?php echo $event->organizer_email; ?>
                        </a>
                    </p>
                    <p>
                    Mobile: <a href="callto:<?php echo $event->organizer_contact_number; ?>" class="text-theme-colored">
                            <?php echo $event->organizer_contact_number; ?>
                        </a>
                               
                        </p>
                    </li>
                    <li>
                        <h5>Start Date:</h5>
                        <p><?php echo $event->start_date->format(' d F, Y '); ?></p>
                    </li>
                    <li>
                        <h5>End Date:</h5>
                        <p><?php echo $event->end_date->format(' d F, Y '); ?></p>
                    </li>
                    <li>
                        <h5>Share:</h5>
                        
                    <!-- Go to www.addthis.com/dashboard to customize your tools -->
                    <div class="addthis_inline_share_toolbox_im71"></div>
    
                    </li>     
                </ul>
            </div>
            <div class="col-md-8">
                <div class="featured-project-carousel owl-carousel" id="event-slider">
                    <?php
                    $options = ['w' => 755, 'h' => 440,'fit'=>'crop']; 
                    foreach ($event->event_documents as $eventDocumentEach) {
                        ?>
                        <?php if ($eventDocumentEach->file_type == 1) { ?>  
                            <div class="item">
                                <?php 
                                $_tdir = $eventDocumentEach->image_path . $event->id . "/"; 
                                if (!empty($eventDocumentEach->banner) && file_exists("img/".$_tdir .$eventDocumentEach->banner)) {
                                        $photo = $_tdir .$eventDocumentEach->banner;
                                    } else {
                                        $photo = 'no_image.gif';
                                    }

                                echo $this->Glide->image($photo, $options, ['class' => 'img-fullwidth', 'alt' => $event->title,'title'=>$event->title]);
                                 
                                
                                // echo $this->Glide->image(($eventDocumentEach->file_name != '' ? $eventDocumentEach->file_name : 'https://placehold.it/755x480'), ['w' => '755', 'h' => '440'], ['class' => 'img-fullwidth', 'alt' => 'No Image', 'data-placeholder' => $this->Url->image('no_image.gif')]);
                                
                                ?>                                    
                            </div>
                        <?php } else if ($eventDocumentEach->file_type == 2) { ?>
                            <div class="item">    
                                <iframe src="<?php echo $eventDocumentEach->file_name; ?>" height="600" width="500" webkitallowfullscreen mozallowfullscreen allowfullscreen>
                                </iframe>
                            </div>
                            <?php
                        }
                        ?>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="row mt-60">
            <div class="col-md-12">
                <h4 class="text-uppercase line-bottom mt-0"><span><?= __d("Events","Event Description") ?></span></h4>
                <p><?php echo $event->description; ?></p>
            </div>
        </div>
    </div>
</section>


</div>

<section>
<div class="container pt-0">
    <div class="row mt-0">
        <div class="col-md-12">
        <h4 class="text-uppercase line-bottom mt-0"><span><?= __d("Events","Event Gallery") ?></span></h4>
            <div class="recent-project owl-carousel" id="event-gallery">
                <?php
                foreach ($event->event_documents as $eventDocumentEach) {
                    if ($eventDocumentEach->file_type == 1) {
                        ?>
                        <div class="item">
                            <?php 
                                $_tdir = $eventDocumentEach->image_path . $event->id . "/"; 
                                if (!empty($eventDocumentEach->banner) && file_exists("img/".$_tdir .$eventDocumentEach->banner)) {
                                        $photo = $_tdir .$eventDocumentEach->banner;
                                    } else {
                                        $photo = 'no_image.gif';
                                    }

                                $options = ['w' => 285, 'h' => 215,'fit'=>'crop']; 
                                echo $this->Glide->image($photo, $options, ['class' => 'img-responsive img-fullwidth', 'alt' => $event->title,'title'=>$event->title]);
                            
                            ?>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
</section>
</div>


<?php
$this->Html->css(['/assets/plugins/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min'], ['block' => true]);
$this->Html->css(['/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min'], ['block' => true]);
$this->Html->css(['/assets/plugins/iCheck/square/blue.css'], ['block' => true]);

$this->Html->css(['/css/validationEngine.jquery.css'], ['block' => true]);

$this->Html->script(['/assets/plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min'], ['block' => true]);
$this->Html->script(['/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min'], ['block' => true]);

$this->Html->script(['/js/jquery.validationEngine-en'], ['block' => true]);
$this->Html->script(['/js/jquery.validationEngine'], ['block' => true]);
$this->Html->script(['//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5d28e78f812b3404'], ['block' => true]);
?>
<!-- Go to www.addthis.com/dashboard to customize your tools -->

<script type="text/javascript">
<?php $this->Html->scriptStart(['block' => true]); ?>
        jQuery(document).ready(function () {
            if($("#formID").length > 0){
                $("#formID").validationEngine();
                
                jQuery('#id_date').datetimepicker({minView: 2, format: 'yyyy-mm-dd', 'showTimepicker': false, autoclose: true});
                        jQuery('#id_time').datetimepicker({
                //minView: 2,  dateFormat: '' ,, 'showDimepicker': false, autoclose: true
                        format: 'HH:ii p',
                        autoclose: true,
                        // todayHighlight: true,
                        showMeridian: true,
                        startView: 1,
                        maxView: 1
                });
                
                jQuery('#id_datetime').datetimepicker({format: 'yyyy-mm-dd H:i:s', autoclose: true });
            }
                
        
    });
            
      
<?php $this->Html->scriptEnd(); ?>
</script>