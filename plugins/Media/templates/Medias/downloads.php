<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $medias
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
          <h2 class="text-theme-colored font-36">Downloads</h2>
          <ol class="breadcrumb text-center mt-10 white">
            <li><?= $this->Html->link(__('Home'), ['controller' => 'Pages', 'action' => 'display','plugin' => \Cake\Core\Configure::read('Tech.theme_name')]) ?></li>
            <li class="active">Downloads</li>
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
                <?php
                    if (!empty($medias->toArray())) {
                        foreach ($medias as $download) {
                             ?>
                  <div class="heading-line-bottom">
              <h4 class="heading-title"><?php echo $download->title; ?></h4>
            </div>           
                <div id="accordion1" class="panel-group accordion transparent">
                <?php
                        foreach ($download->media_files as $file) {
                             ?>
                        <div class="panel">
                                <div class="panel-title"> <a data-parent="#accordion1" data-toggle="collapse" href="#accordion1<?= $file->id?>" class="" aria-expanded="true"> <span class="open-sub"></span> <?php echo $file->title; ?></a> </div>
                                <div id="accordion1<?= $file->id?>" class="panel-collapse collapse" role="tablist" aria-expanded="true">
                                <div class="panel-content">
                                    <?php 
                                    if(!empty($file->description)){

                                      echo "<p>".$file->description."</p>";
                                    }
                                     ?>
                                    <div class="row">
                                        <div class="col-sm-12">
                                        <ul class="list-inline">
                                            <li>Posted: <span class="text-theme-colored"><?= $file->created->format('d F, Y '); ?></span></li>
                                            
                                            <li>Download:  <?= $this->Html->link("<i class=\"fa fa-cloud-download\"></i>", ['controller' => 'Medias', 'action' => 'fileDownload', $file->id],['class' => 'btn btn-border btn-theme-colored btn-flat btn-xs', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Download File'),'title'=>__('Download File')]) ?>
                                            </li>
                                        </ul>
                                        </div>
                                    </div>
                                </div>
                                </div>
                        </div>
                    <?php
                    }
                ?>
                </div>
                <?php
                        }
                    }
                ?>
                    
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

<?php
$this->assign('title', $metaData['meta_title']);
$this->Html->meta(
    'keywords', $metaData['meta_keyword'], ['block' => true]
);
$this->Html->meta(
    'description', $metaData['meta_description'], ['block' => true]
);
?>