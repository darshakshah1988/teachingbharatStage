<?php 
    $thumb = ['w' => '100', 'h' => '60','fit'=>'crop'];
    $large = ['w' => '1250', 'h' => '450','fit'=>'crop'];
?>
<?php if(!empty($banner)): 
    
$mediaImg = $banner->media_files[0] ?? [];
if(!empty($mediaImg)):
  $imagename = null;
  if (!empty($mediaImg->media_image_path) && !empty($mediaImg->media_image) && file_exists("img/".$mediaImg->media_image_path . $mediaImg->media_image)) {
        $imagename = "img/".$mediaImg->media_image_path . $mediaImg->media_image;
       //echo $this->Glide->url($imagename, $thumb);
    }

 ?>
<div class="HomeBanner" style="<?php echo $imagename ? "background: url('".$imagename."') no-repeat center top !important;" : ""; ?>">
<div class="container">
  <div class="col-md-7 home-banner-texts">
    <h6 class="header-bm-name"><?= $mediaImg->sub_title ?></h6>
    <h3><?= $mediaImg->title ?></h3>
    <h4><?= $mediaImg->description ?></h4>
    <?php if(!empty($mediaImg->external_link)){ ?>
    <a href="<?= $mediaImg->external_link ?>" target="_blank" class="h-b-btn">Choose your Course</a>
  <?php } ?>
  </div>
 <div class="col-md-5 home-right-img">
                <a href="#" data-toggle="modal" data-target="#Video">
                    <?php echo $this->Html->image('bannerimage.png'); ?>
                  </a>
            </div>
        </div> 
    </div>

<?php 
  endif;
endif;
 ?>