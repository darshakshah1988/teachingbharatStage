<?php 
    $thumb = ['w' => '350', 'h' => '300','fit'=>'crop'];
    $large = ['w' => '900', 'h' => '780','fit'=>'crop'];
?>
<?php if(!empty($galleries->media_files)): 
    $inc = 0;
    foreach($galleries->media_files as $mediaImg):
   if (!empty($mediaImg->media_image_path) && !empty($mediaImg->media_image) && file_exists("img/".$mediaImg->media_image_path . $mediaImg->media_image)) {
        $imagename = $mediaImg->media_image_path . $mediaImg->media_image;
    } else{
        $imagename = "no_image.gif";
    }
?>
<!-- Portfolio Item Start -->
<div class="gallery-item">
    <div class="thumb">
      <?php echo $this->Glide->image($imagename, $thumb, ['class' => 'img-fullwidth']); ?>
      <div class="overlay-shade"></div>
      <div class="icons-holder">
        <div class="icons-holder-inner">
          <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
            <a data-lightbox="image" href="<?php echo $this->Glide->url($imagename, $large); ?>"  data-lightbox-gallery="gallery"><i class="fa fa-picture-o"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Portfolio Item End -->
<?php 
$inc++;
endforeach; ?>
<?php endif; ?>