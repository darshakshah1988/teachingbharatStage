<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $newspost
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
          <h2 class="text-theme-colored font-36">Facilities</h2>
          <ol class="breadcrumb text-center mt-10 white">
            <li><?= $this->Html->link(__('Home'), ['controller' => 'Pages', 'action' => 'display','plugin' => \Cake\Core\Configure::read('Tech.theme_name')]) ?></li>
            <li class="active">Facilities</li>
          </ol>
        </div>
      </div>
    </div>
  </div>      
</section>

<!-- Section: Blog -->
<section>
  <div class="container mt-30 mb-30 pt-30 pb-30">
    <div class="mtli-row-clearfix text-center">
         <?php if(!$services->isEmpty()){ 
        foreach($services as $service){
        ?>
        <div class="col-sm-4">
            <div class="icon-box iconbox-theme-colored bg-lighter">
              <a class="icon icon-dark icon-bordered icon-rounded icon-border-effect effect-rounded" href="<?php echo $this->Url->build(['controller' => 'Services', 'action' => 'detail', 'plugin' => 'Services', $service->slug]) ?>">
                <i class="fa fa-<?php echo $service->service_icon ?>"></i>
              </a>
              <h5 class="icon-box-title">
                <?php echo $this->Text->truncate($service->title, 60, ['ellipsis' => '...','exact' => false]); ?>
              </h5>
              <p class="text-gray">
                <?php echo $this->Text->truncate($service->short_description, 175, ['ellipsis' => '...','exact' => false]); ?>
              </p>
              <!-- <a class="" href="#">Read more</a> -->
              <?php echo $this->Html->link("Read More", ['controller' => 'Services', 'action' => 'detail', 'plugin' => 'Services', $service->slug], ['class' => 'btn btn-flat btn-dark btn-sm mt-15']) ?>
            </div>
        </div>
        <?php } } ?>
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