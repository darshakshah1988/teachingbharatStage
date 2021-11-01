<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $newspost
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Newspost') ?>
        </h1>
        <small><?php echo empty($newspost->id) ? __('Here you can add New newspost') : __('Here you can edit newspost'); ?></small>
</div>
<?php $this->end(); ?>
<?= $this->Form->create($newspost, ['role' => 'form', 'enctype' => 'multipart/form-data', 'templates' => 'default_form']) ?>

<div class="row newsposts index content">
<div class="col-12 col-sm-12 col-md-8">
    <div class="d-block">
        <div class="panel-default">
            <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= __(empty($newspost->id) ? 'Add Newspost' : 'Edit Newspost') ?></h2>
                <div class="d-flex flex-wrap">
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>
            
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <?php
                        echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => __('Title')]);
                        echo $this->Form->control('short_description', ['type' => 'textarea','class' => 'form-control', 'placeholder' => __('Short Description'), 'rows' => 9]);
                        ?>
                    </div>
                    <div class="col-md-6">
                        <?php
                        echo $this->Form->control('meta_title', ['class' => 'form-control', 'placeholder' => __('Meta Title')]);
                    echo $this->Form->control('meta_keyword', ['class' => 'form-control', 'placeholder' => __('Meta Keyword')]);
                    echo $this->Form->control('meta_description', ['class' => 'form-control', 'placeholder' => __('Meta Description')]);
                         ?>
                    </div>
                </div>
                
                <?php  
                    echo $this->Form->control('description', ['class' => 'form-control ckeditor', 'placeholder' => __('Description')]);
                    
                ?>
            </div>
            <div class="panel-footer d-flex flex-wrap justify-content-between align-items-center">
                <?php echo $this->Form->button("<i class='fa fa-fw fa-save'></i> " . __('Submit'), ['class' => 'btn btn-primary btn-sm btn-flat my-button', 'title' => __('Submit'), 'escapeTitle' => false]); ?>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Cancel'), 'escape' => false]); ?>
            </div>
           

        </div>
    </div>
    </div>

<div class="col-12 col-sm-12 col-md-4">
        <div class="d-block">
            <div class="panel-default">
                <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                    <h2><?php echo __("News Post Slug") ?></h2>
                </div>
                <div class="panel-body">
                    <?php
                        echo $this->Form->control('slug', ['class' => 'form-control', 'placeholder' => __('Slug')]);
                    ?>
                </div>
            </div>

            <div class="panel-default">
                <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                    <h2><?php echo __("Publish / Order") ?></h2>
                </div>
                <div class="panel-body">
                    <?php
                        echo $this->Form->control('status', ['options' => [1 => "Active", 0 => "Inactive"],'class' => 'form-control','empty' => false, 'placeholder' => __('Status')]);
                        echo $this->Form->control('position', ['class' => 'form-control', 'placeholder' => __('Position')]);
                    ?>
                </div>
            </div>


            <div class="panel-default">
                <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                    <h2><?php echo __("Banner Image") ?></h2>
                </div>
                <div class="panel-body">
                    <?php
                    echo $this->Form->control('banner_image', ['type' => 'file','label' => false]);
                    if (!empty($newspost->banner_path) && !is_array($newspost->banner_image) && file_exists("img/" . $newspost->banner_path . $newspost->banner_image)) { ?>
                        <div class="form-group">
                            <?php
                            echo $this->Html->image($newspost->banner_path . $newspost->banner_image, ['class' => 'img-thumbnail', 'style' => 'max-height:100px']);
                            ?>
                        </div>
                    <?php } ?> 
                </div>

                 <div class="panel-heading">
                    <h2><?php echo __("Header Banner") ?></h2>
                    </div>
                 <div class="panel-body">
                    <?php
                    echo $this->Form->control('header_image', ['type' => 'file','label' => false]);
                    if (!empty($newspost->header_path) && !is_array($newspost->header_image) && file_exists("img/" . $newspost->header_path . $newspost->header_image)) { ?>
                        <div class="form-group">
                            <?php
                            echo $this->Html->image($newspost->header_path . $newspost->header_image, ['class' => 'img-thumbnail', 'style' => 'max-height:100px']);

                            ?>
                        </div>
                    <?php } ?>
                 </div>

            </div>


    </div>
</div>
</div>
<?= $this->Form->end() ?>