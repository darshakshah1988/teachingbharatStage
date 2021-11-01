<?php 
    $carouselImg = ['w' => '800', 'h' => '600','fit'=>'crop'];
?>
<?php if(!empty($banner)): 
    $inc = 0;
    foreach($banner->media_files as $mediaImg):
   if (!empty($mediaImg->media_image_path) && !empty($mediaImg->media_image) && file_exists("img/".$mediaImg->media_image_path . $mediaImg->media_image)) {
        $imagename = $mediaImg->media_image_path . $mediaImg->media_image;
    } else{
        $imagename = "no_image.gif";
    }
?>
  <div class="item">
    <div class="thumb">
      <?php 
        echo $this->Glide->image($imagename, $carouselImg);
        ?>
     </div>
  </div>
<?php 
$inc++;
endforeach; ?>
<?php endif; ?>