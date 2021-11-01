<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $page
 */
$bannerImgSize = ['w' => '1700', 'h' => '742','fit'=>'crop'];
$backImg = "uploads/banners/banne-733.jpg";
 if (!empty($page->image_path) && !empty($page->banner) && file_exists("img/".$page->image_path . $page->banner)) {
   $backImg = $page->image_path . $page->banner;
}
?>

<div class="InnerArea">
  <img src="<?php echo $this->Glide->url($backImg, $bannerImgSize); ?>" width="100%" />
  <div class="container">
      <div class="col-md-12 Imarea">
        <div class="col-md-12 logoIconMiddle">
            <?php echo $this->Html->image("LogoIcon.png"); ?>
          </div>
          <div class="col-md-12 InnerText <?= $page->slug == "about-teaching-bharat" ? "text-center" : "" ?>">
            <h2 class="InnTitle"><?= $page->title ?></h2>
            <?= $this->Text->autoParagraph($page->description); ?>
          </div>
      </div>
  </div>
</div>

 <div class="HomeWhyUs">
            <div class="container">
                <div class="col-md-12  wow fadeInUp animated" data-wow-delay="0.4s">
                    <h1 style="text-align: center; text-shadow: none; margin-bottom: 30px">Why from <span>Rudraa</span></h1>
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="col-md-12 HWBox">
                                <div class="col-md-12">
                                  <?php echo $this->Html->image("b1.png", ['class' => 'no-bg']); ?>
                                </div>
                                <div class="col-md-12">
                                    <h2>LIVE PERSONALIZED TEACHING</h2>
                                    <p>Learn online Live interactive classes by Expert faculty at your Personal Computer.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="col-md-12 HWBox">
                                <div class="col-md-12">
                                    <?php echo $this->Html->image("b2.png", ['class' => 'no-bg']); ?>
                                </div>
                                <div class="col-md-12">
                                    <h2>LEARN ANYTIME ANYWHERE</h2>
                                    <p>Learn online Live interactive Classes Anywhere Anytime at your Place with Rudraa.org</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="col-md-12 HWBox">
                                <div class="col-md-12">
                                    <?php echo $this->Html->image("b3.png", ['class' => 'no-bg']); ?>
                                </div>
                                <div class="col-md-12">
                                    <h2>SAVE TIME AND ENERGY</h2>
                                    <p>Save your Transportation time and Energy, Reduce the time for finding best Teacher.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-md-offset-2">
                            <div class="col-md-12 HWBox">
                                <div class="col-md-12">
                                    <?php echo $this->Html->image("b4.png", ['class' => 'no-bg']); ?>
                                </div>
                                <div class="col-md-12">
                                    <h2>ECONOMICAL LEARNING</h2>
                                    <p>Cheaper than Physical Classes. Choose from several Learning plans from Rudraa.org</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="col-md-12 HWBox">
                                <div class="col-md-12">
                                    <?php echo $this->Html->image("b5.png", ['class' => 'no-bg']); ?>
                                </div>
                                <div class="col-md-12">
                                    <h2>innovative methodology</h2>
                                    <p>Rudraa is giving you Innovative and unique methodology to make your Doubts more Clear.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="Imarea">
        <div class="container">
            <div class="col-md-7 InnerText text-justify">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.

                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.

                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
                </p>
                <div class="col-sm-12 call-on-1">
                    <p>CLick below button and Explore the Learning World</p>
                    <div class="col-sm-4 col-sm-offset-4">
                        <a href="#" class="call-on-btn-1 mt10">Browser All</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <a href="#" data-toggle="modal" data-target="#Video">
                  <?php echo $this->Html->image("reviewimg.gif", ['class' => 'img-full mt20']); ?>
                </a>
            </div>
        </div>
    </div>

<?php
$this->assign('title', $page->meta_title);
$this->Html->meta(
    'keywords', $page->meta_keyword, ['block' => true]
);
$this->Html->meta(
    'description', $page->meta_description, ['block' => true]
);

?>