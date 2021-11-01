<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $newspost
 */
$large = ['w' => '1250', 'h' => '450','fit'=>'crop'];
$imagename = $newspost->header_path . $newspost->header_image;
?>
 <!-- Section: inner-header -->
<section class="inner-header divider layer-overlay overlay-dark" data-bg-img="<?php echo $this->Glide->url($imagename, $large); ?>">
  <div class="container pt-30 pb-30">
    <!-- Section Content -->
    <div class="section-content text-center">
      <div class="row"> 
        <div class="col-md-6 col-md-offset-3 text-center">
          <h2 class="text-theme-colored font-36"><?= $this->Text->truncate($newspost->title, 50, ['ellipsis' => '...','exact' => false]) ?></h2>
          <ol class="breadcrumb text-center mt-10 white">
            <li><?= $this->Html->link(__('Home'), ['controller' => 'Pages', 'action' => 'display','plugin' => \Cake\Core\Configure::read('Tech.theme_name')]) ?></li>
            <li><?= $this->Html->link(__('News'), ['controller' => 'Newsposts', 'action' => 'index','plugin' => 'News']) ?></li>
            <li class="active"><?= $this->Text->truncate($newspost->title, 50, ['ellipsis' => '...','exact' => false]) ?></li>
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
      <div class="col-md-10 col-md-offset-1">
        <div class="blog-posts single-post">
          <article class="post clearfix mb-0">
            <?php if (!empty($newspost->banner_image) && file_exists("img/".$newspost->banner_path . $newspost->banner_image)) { 
                $carouselImg = ['w' => '730', 'h' => '350','fit'=>'crop'];
                ?>
            <div class="entry-header">
              <div class="post-thumb thumb"> 
                <?php
                     echo $this->Glide->image($newspost->banner_path . $newspost->banner_image, $carouselImg, ['class' => 'img-responsive img-fullwidth']);
                    ?>
              </div>
            </div>
        <?php } ?>
            <div class="entry-title pt-0">
              <h3><a href="javascript:void(0);"><?= $newspost->title ?></a></h3>
            </div>
            <div class="entry-meta">
              <ul class="list-inline">
                <li>Posted: <span class="text-theme-colored"><?= $newspost->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_FORMAT')) ?></span></li>
                <li>By: <span class="text-theme-colored"><?= $newspost->admin_user->name ?></span></li>
              </ul>
            </div>
            <div class="entry-content mt-10">
              <?= $newspost->description ?>
              <div class="mt-30 mb-0">
                    <h5 class="pull-left mt-10 mr-20 text-theme-colored">Share:</h5>
                    <ul class="styled-icons icon-circled m-0">
                      <li><a href="#" data-bg-color="#3A5795"><i class="fa fa-facebook text-white"></i></a></li>
                      <li><a href="#" data-bg-color="#55ACEE"><i class="fa fa-twitter text-white"></i></a></li>
                      <li><a href="#" data-bg-color="#A11312"><i class="fa fa-google-plus text-white"></i></a></li>
                    </ul>
                  </div>
            </div>
          </article>         
        </div>
      </div>
    </div>
  </div>
</section>