<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $medias
 */
$large = ['w' => '1250', 'h' => '450','fit'=>'crop'];
$imagename = $metaData['image_path'] . $metaData['banner'];
?>
 <!-- Section: inner-header -->
<section class="inner-header divider layer-overlay overlay-dark" data-bg-img="<?php echo $this->Glide->url($imagename, $large); ?>">
  <div class="container pt-30 pb-30">
    <!-- Section Content -->
    <div class="section-content text-center">
      <div class="row"> 
        <div class="col-md-6 col-md-offset-3 text-center">
          <h2 class="text-theme-colored font-36">Photo Gallery</h2>
          <ol class="breadcrumb text-center mt-10 white">
            <li><?= $this->Html->link(__('Home'), ['controller' => 'Pages', 'action' => 'display','plugin' => \Cake\Core\Configure::read('Tech.theme_name')]) ?></li>
            <li class="active">Media Gallery</li>
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
            <!-- Works Filter -->
            <div class="portfolio-filter font-alt align-center">
              <a href="#" class="active" data-filter="*">All</a>
              <?php foreach ($medias as $media) { ?>
                <a href="#gall_<?php echo $media->id; ?>" class="" data-filter=".gall_<?php echo $media->id; ?>"><?php echo $media->title; ?></a>
              <?php } ?>
            </div>
            <!-- End Works Filter -->

            
            <!-- Portfolio Gallery Grid -->
            <div id="grid" class="gallery-isotope grid-4 gutter clearfix">
            <?php 
              $thumb = ['w' => '350', 'h' => '300','fit'=>'crop'];
              $large = ['w' => '900', 'h' => '780','fit'=>'crop'];
            foreach ($medias as $media) { 
                  foreach ($media->media_files as $mediaImg) {
                    if (!empty($mediaImg->media_image_path) && !empty($mediaImg->media_image) && file_exists("img/".$mediaImg->media_image_path . $mediaImg->media_image)) {
                          $imagename = $mediaImg->media_image_path . $mediaImg->media_image;
                      } else{
                          $imagename = "no_image.gif";
                      }
              ?>
              <!-- Portfolio Item Start -->
              <div class="gallery-item gall_<?php echo $media->id; ?>">
                <div class="thumb">
                  <?php echo $this->Glide->image($imagename, $thumb, ['class' => 'img-fullwidth']); ?>
                  <div class="overlay-shade"></div>
                  <div class="icons-holder">
                    <div class="icons-holder-inner">
                      <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                        <a data-lightbox="image" href="<?php echo $this->Glide->url($imagename, $large); ?>"><i class="fa fa-plus"></i></a>
                      </div>
                    </div>
                  </div>
                  <a class="hover-link" data-lightbox="image" href="<?php echo $this->Glide->url($imagename, $large); ?>">View more</a>
                </div>
              </div>
              <!-- Portfolio Item End -->
              <?php } } ?>
              

            </div>
            <!-- End Portfolio Gallery Grid -->
          </div>
        </div>
      </div>
    </section>

<?php
$this->assign('title', $metaData['meta_title']);
$this->Html->meta(
    'keywords', $metaData['meta_keyword'], ['block' => true]
);
$this->Html->meta(
    'description', $metaData['meta_description'], ['block' => true]
);
?>