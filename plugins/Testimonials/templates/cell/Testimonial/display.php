<?php if(!$testimonials->isEmpty()){ 
  $inc = 1;
foreach($testimonials as $testimonial){
  ?>
<div class="border-1px <?php echo (($inc%2)==0) ? "border-left-theme-color-2-6px" : "border-right-theme-color-2-6px" ?> media sm-maxwidth400 p-15 mt-0 mb-15">
  <div class="testimonial pt-10">
    <div class="ml-0">
      <p><?php echo $testimonial->description; ?></p>
      <p class="author mt-10">- <span class="text-theme-colored"><?php echo $testimonial->name; ?>,</span> <small><em><?php echo $testimonial->designation; ?></em></small></p>
    </div>
  </div>
</div>
<?php 
$inc++;
 } 
} 
?>
