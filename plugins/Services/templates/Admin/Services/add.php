<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $service
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Service') ?>
        </h1>
        <small><?php echo empty($service->id) ? __('Here you can add New service') : __('Here you can edit service'); ?></small>
</div>
<?php $this->end(); ?>

<div class="row services index content">
<div class="col-12 col-sm-12 col-md-12">
        <div class="panel-default">
            <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= __(empty($service->id) ? 'Add Service' : 'Edit Service') ?></h2>
                <div class="d-flex flex-wrap">
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>

            <?= $this->Form->create($service, ['role' => 'form', 'enctype' => 'multipart/form-data', 'templates' => 'horizontal_form']) ?>
            <div class="panel-body">

                    <?php
                    $fonturl = $this->Url->build(['controller' => 'Pages', 'action' => 'icons', 'plugin' => false, 'prefix' => false]);
                    echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => __('Title')]);
                    echo $this->Form->control('slug', ['class' => 'form-control', 'placeholder' => __('Slug')]);
                    echo $this->Form->control('service_icon', ['class' => 'form-control', 'placeholder' => __('Icon'), 'templates' => ['formGroup' => '{{label}}<div class="col-md-8">{{input}}{{error}}<span>Please use <a href="'.$fonturl.'" target="_blank">font icons</a> for institution Icon</span></div>']]);
                    echo $this->Form->control('short_description', ['type' => 'textarea','class' => 'form-control', 'placeholder' => __('Short Description')]);
                    echo $this->Form->control('description', ['type' => 'textarea','class' => 'form-control ckeditor', 'placeholder' => __('Description')]); ?>

                        <?php
                    echo $this->Form->control('banner_image', ['type' => 'file','label' => 'Thumb Banner Image']);
                    if (!empty($service->banner_path) && !is_array($service->banner_image) && file_exists("img/" . $service->banner_path . $service->banner_image)) { ?>
                        <div class="form-group">
                            <div class="col-md-8 offset-3">
                                 <?php
                            echo $this->Html->image($service->banner_path . $service->banner_image, ['class' => 'img-thumbnail', 'style' => 'max-height:100px']);
                            ?>
                            </div>
                           
                        </div>
                    <?php } ?>

                     <?php
                    echo $this->Form->control('header_image', ['type' => 'file','label' => 'Header Banner Image']);
                    if (!empty($service->header_path) && !is_array($service->header_image) && file_exists("img/" . $service->header_path . $service->header_image)) { ?>
                        <div class="form-group">
                            <div class="col-md-8 offset-3">
                            <?php
                            echo $this->Html->image($service->header_path . $service->header_image, ['class' => 'img-thumbnail', 'style' => 'max-height:100px']);

                            ?>
                        </div>
                        </div>
                    <?php } ?>

                    <?php
                    echo $this->Form->control('status', ['options' => [1 => "Active", 0 => "Inactive"],'empty' => false,'class' => 'form-control', 'placeholder' => __('Status')]);
                    echo $this->Form->control('position', ['class' => 'form-control', 'placeholder' => __('Position')]);
                ?>
            </div>
            <div class="panel-footer d-flex flex-wrap justify-content-between align-items-center">
                <?php echo $this->Form->button("<i class='fa fa-fw fa-save'></i> " . __('Submit'), ['class' => 'btn btn-primary btn-sm btn-flat my-button', 'title' => __('Submit'), 'escapeTitle' => false]); ?>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Cancel'), 'escape' => false]); ?>
            </div>
            <?= $this->Form->end() ?>

        </div>
    </div>
</div>