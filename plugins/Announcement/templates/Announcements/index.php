<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $announcements
 */
$large = ['w' => '1250', 'h' => '450','fit'=>'crop'];
if (!empty($metaData['image_path']) && !empty($metaData['banner']) && file_exists("img/".$metaData['image_path'] . $metaData['banner'])) {

    }
$imagename = $metaData['image_path'] . $metaData['banner'];
?>
<!-- Section: inner-header -->
<section class="inner-header divider layer-overlay overlay-dark" data-bg-img="<?php echo $this->Glide->url($imagename, $large); ?>">
  <div class="container pt-30 pb-30">
    <!-- Section Content -->
    <div class="section-content text-center">
      <div class="row"> 
        <div class="col-md-6 col-md-offset-3 text-center">
          <h2 class="text-theme-colored font-36">Circulars & Notices</h2>
          <ol class="breadcrumb text-center mt-10 white">
            <li><?= $this->Html->link(__('Home'), ['controller' => 'Pages', 'action' => 'display','plugin' => \Cake\Core\Configure::read('Tech.theme_name')]) ?></li>
            <li class="active">Circulars & Notices</li>
          </ol>
        </div>
      </div>
    </div>
  </div>      
</section>

<!-- Section: event calendar -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                <div id="accordion1" class="panel-group accordion">
                <?php
                    if (!$announcements->isEmpty()) {
                        foreach ($announcements as $announcement) {
                             ?>
                        <div class="panel">
                                <div class="panel-title"> 
                                    <a data-parent="#accordion1<?= $announcement->id?>" id="<?php echo $announcement->slug ?>" data-toggle="collapse" href="#accordion1<?= $announcement->id?>" class="" aria-expanded="true"> <span class="open-sub"></span> <?php echo $announcement->title; ?></a> 
                                </div>
                                <div id="accordion1<?= $announcement->id?>" class="panel-collapse collapse" role="tablist" aria-expanded="true">
                                <div class="panel-content">
                                    <?php echo ($announcement->description); ?>
                                    <div class="row">
                                        <div class="col-sm-12">
                                        <ul class="list-inline">
                                            <li>Posted: <span class="text-theme-colored"><?= $announcement->created->format('d F, Y '); ?></span></li>
                                            <li>By: <span class="text-theme-colored"><?= $announcement->admin_user->name ?></span></li>
                                            <?php /* ?><li>Download:  <?php echo $this->Html->link("<i class=\"fa fa-cloud-download\"></i>", ['action' => 'download','prefix' => 'admin','_ext' => 'pdf', $announcement->slug],['class' => 'btn btn-border btn-theme-colored btn-flat btn-xs', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Download announcement'),'title'=>__('Download announcement')]); ?>
                                            </li>
                                            <?php */ ?>
                                        </ul>
                                        </div>
                                    </div>
                                </div>
                                </div>
                        </div>
                    <?php
                        }
                    }
                ?>
                </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <nav>
                            <?php echo $this->element('pagination'); ?>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<script>
<?php $this->Html->scriptStart(['block' => true]); ?>
if(window.location.hash) {
    var hash = window.location.hash.substring(1); //Puts hash in variable, and removes the # character
    if($("#" + hash).length > 0){
        $("#" + hash).trigger("click");
    }
}
<?php $this->Html->scriptEnd(); ?>
</script>
