<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $page
 */
$bannerImgSize = ['w' => '1100', 'h' => '300','fit'=>'crop'];
$backImg = "uploads/banners/banne-733.jpg";
 if (!empty($page->image_path) && !empty($page->banner) && file_exists("img/".$page->image_path . $page->banner)) {
   $backImg = $page->image_path . $page->banner;
}
?>

<!-- Section: inner-header -->
    <section class="inner-header divider layer-overlay overlay-dark" data-bg-img="<?php echo $this->Glide->url($backImg, $bannerImgSize); ?>">
      <div class="container pt-30 pb-30">
        <!-- Section Content -->
        <div class="section-content text-center">
          <div class="row"> 
            <div class="col-md-6 col-md-offset-3 text-center">
              <h2 class="text-theme-colored font-36"><?= h($page->title) ?></h2>
              <ol class="breadcrumb text-center mt-10 white">
                <li><?php echo $this->Html->link('Home',['controller'=>'Pages','action'=>'display','plugin' => NULL]); ?></li>
                <li class="active"><?= h($page->title) ?></li>
              </ol>
            </div>
          </div>
        </div>
      </div>      
    </section>

<section id="inner-headline">
   <div class="container">
         <div class="about">
            <?= $this->Text->autoParagraph($page->description); ?>
        </div>
</div>
</section>

<?php
$this->assign('title', $page->meta_title);
$this->Html->meta(
    'keywords', $page->meta_keyword, ['block' => true]
);
$this->Html->meta(
    'description', $page->meta_description, ['block' => true]
);

?>