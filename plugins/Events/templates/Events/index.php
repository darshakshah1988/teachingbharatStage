<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $events
 */
use Cake\I18n\Date;
$large = ['w' => '1250', 'h' => '450','fit'=>'crop'];
if (!empty($metaData['image_path']) && !empty($metaData['banner']) && file_exists("img/".$metaData['image_path'] . $metaData['banner'])) {

    }
$imagename = $metaData['image_path'] . $metaData['banner'];
?>
 <!-- Section: inner-header -->
<section class="inner-header divider layer-overlay overlay-dark" data-bg-img="<?php echo $this->Glide->url($imagename, $large); ?>">
  <div class="container pt-30 pb-30">
    <!-- Section Content -->
    <div class="section-content text-center">
      <div class="row"> 
        <div class="col-md-6 col-md-offset-3 text-center">
          <h2 class="text-theme-colored font-36">Events</h2>
          <ol class="breadcrumb text-center mt-10 white">
            <li><?= $this->Html->link(__('Home'), ['controller' => 'Pages', 'action' => 'display','plugin' => \Cake\Core\Configure::read('Tech.theme_name')]) ?></li>
            <li class="active">Events</li>
          </ol>
        </div>
      </div>
    </div>
  </div>      
</section>

 <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    if (!empty($events->toArray())) {
                        foreach ($events as $event) {
                            $dateStartDate = new Date($event->start_date);
                            $day = $dateStartDate->format('d');//date('d', strtotime($event->start_date));
                            $Month = $dateStartDate->format('M');//date('M', strtotime($event->start_date));
                            $year = $dateStartDate->format('Y');//date('Y', strtotime($event->start_date));
                            ?>
                            <div class="upcoming-events media maxwidth400 bg-light mb-20">
                                <div class="row equal-height">
                                    <div class="col-sm-3 pr-0 pr-sm-15">
                                        <div class="thumb p-15">
                                            <?php 
                                             $options = ['w' => 200, 'h' => 140,'fit'=>'crop']; 
                                             if (!empty($event->banner_path) && !empty($event->banner) && file_exists("img/".$event->banner_path . $event->banner)) {
                                                    $photo = $event->banner_path . $event->banner;
                                             } else {
                                                    $photo = "no_image.gif";
                                             }
                                        //echo $this->Glide->image($photo, $options, ['class' => 'img-responsive img-fullwidth', 'alt' => $event->title,'title'=>$event->title]);

                                     echo $this->Html->link($this->Glide->image($photo, $options, ['class' => 'img-responsive img-fullwidth', 'alt' => $event->title,'title'=>$event->title]),['controller'=>'Events', 'action' => 'detail','plugin' => 'Events',$event->slug],['escape'=>false]);
                                            
                                        ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-5 border-right pl-0 pl-sm-15">
                                        <div class="event-details p-15 mt-10">
                                            <h4 class="media-heading text-uppercase font-weight-500"><?php echo $event->title; ?></h4>
                                            <p>
                                                <?= $this->Text->truncate($event->short_description, 150, ['ellipsis' => '...','exact' => false]) ?>
                                            </p>
                                            <?= $this->Html->link("Details <i class=\"fa fa-angle-double-right\"></i>", ['action' => 'detail', $event->slug], ['class' => 'btn btn-flat btn-dark btn-theme-colored btn-sm mt-10', 'escape' => false, 'data-toggle' => 'tooltip', 'alt' => __('View event'), 'title' => __('View event')]) ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="event-count p-15 mt-10">
                                            <ul class="event-date list-inline font-16 text-uppercase mt-10 mb-10">
                                                <li class="p-15 mr-5 bg-lightest"><?= ($Month)?$Month:''; ?></li>
                                                <li class="p-15 pl-20 pr-20 mr-5 bg-lightest"><?= ($day)?$day:''; ?></li>
                                                <li class="p-15 bg-lightest"><?= ($year)?$year:''; ?></li>
                                            </ul>
                                            <ul>
                                                <li class="text-theme-colored">
                                                    <i class="fa fa-map-marker mr-5"></i> <?php echo $event->location; ?>
                                                </li>
                                                <li class="text-theme-colored">
                                                    <i class="fa fa-user mr-5"></i> <?php echo $event->organizar_name; ?>
                                                </li>
                                                <li class="text-theme-colored">
                                                    <i class="fa fa-envelope mr-5"></i> 
                                                    <a href="mailto:<?php echo $event->organizer_email; ?>" class="text-theme-colored">
                                                        <?php echo $event->organizer_email; ?>
                                                    </a>
                                                </li>
                                                <li class="text-theme-colored">
                                                    <i class="fa fa-phone mr-5"></i> 
                                                    <a href="callto:<?php echo $event->organizer_contact_number; ?>" class="text-theme-colored">
                                                        <?php echo $event->organizer_contact_number; ?>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <nav>
                            <?php echo $this->element('pagination'); ?>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
