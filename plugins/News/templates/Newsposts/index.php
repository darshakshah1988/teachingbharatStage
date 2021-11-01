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
          <h2 class="text-theme-colored font-36">News</h2>
          <ol class="breadcrumb text-center mt-10 white">
            <li><?= $this->Html->link(__('Home'), ['controller' => 'Pages', 'action' => 'display','plugin' => \Cake\Core\Configure::read('Tech.theme_name')]) ?></li>
            <li class="active">News</li>
          </ol>
        </div>
      </div>
    </div>
  </div>      
</section>

<!-- Section: Blog -->
<section>
  <div class="container mt-30 mb-30 pt-30 pb-30">
    <div class="row">
      <?php foreach ($newsposts as $newspost){ ?>
        <div class="col-sm-6 col-md-4 col-lg-4">
        <article class="post clearfix maxwidth600 mb-30">
            <div class="entry-header">
            <div class="post-thumb thumb"> 
                <?php
                $carouselImg = ['w' => 360, 'h' => 220,'fit'=>'crop'];
              if (!empty($newspost->banner_image) && file_exists("img/".$newspost->banner_path . $newspost->banner_image)) {
                $photo = $newspost->banner_path . $newspost->banner_image;
              }else{
                $photo = "no_image.gif";
              }
              echo $this->Html->link($this->Glide->image($photo, $carouselImg, ['class' => 'img-responsive img-fullwidth']),['controller'=>'Newsposts', 'action' => 'detail','plugin' => 'News',$newspost->slug],['escape'=>false]);
              ?>
         </div>
         </div>
            <div class="entry-content border-1px p-20">
          <h5 class="entry-title mt-0 pt-0"><?= $this->Html->link($this->Text->truncate($newspost->title, 30,['ellipsis' => '...', 'exact' => false ]),['controller'=>'Newsposts', 'action' => 'detail','plugin' => 'News',$newspost->slug],['escape'=>false,'class'=>'font-12']) ?></h5>
          <p class="text-left mb-20 mt-15 font-13"><?= $this->Text->truncate($newspost->short_description, 130,['ellipsis' => '...', 'exact' => false ]) ?></p>
           <?= $this->Html->link(__('Read more'), ['controller' => 'Newsposts', 'action' => 'detail','plugin' => 'News', $newspost->slug], ['class'=>'btn btn-dark btn-theme-colored btn-xs btn-flat pull-left mt-0']); ?>
          <ul class="list-inline entry-date pull-right font-10 mt-5">
            <li><?= $this->Html->link($newspost->admin_user->name .' |', 'javascript:void(0)', ['class'=>'text-theme-colored', 'style'=>'']); ?></li>
            <li><span class="text-theme-colored"><?= $newspost->created->format('M d, Y'); ?></span></li>
          </ul>
          <div class="clearfix"></div>
          </div>
        </article>
        </div>
        <?php } ?>
      
      </div>
      
      <div class="row">
        <div class="col-sm-12">
          <?php echo $this->element('pagination'); ?>
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