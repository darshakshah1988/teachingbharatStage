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