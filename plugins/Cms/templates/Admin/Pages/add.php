<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $page
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Page') ?>
        </h1>
        <small><?php echo empty($page->id) ? __('Here you can add New page') : __('Here you can edit page'); ?></small>
</div>
<?php $this->end(); ?>

<div class="row pages index content">
<div class="col-12 col-sm-12 col-md-12">
        <div class="panel-default">
            <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= __(empty($page->id) ? 'Add Page' : 'Edit Page') ?></h2>
                <div class="d-flex flex-wrap">
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>
            <?= $this->Form->create($page, ['role' => 'form', 'enctype' => 'multipart/form-data', 'templates' => 'default_form']) ?>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <?php
                        echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => __('Title')]);
                        echo $this->Form->control('sub_title', ['class' => 'form-control', 'placeholder' => __('Sub Title')]);
                        echo $this->Form->control('slug', ['class' => 'form-control', 'placeholder' => __('Slug')]);
                        echo $this->Form->control('short_description', ['type' => 'textarea','class' => 'form-control', 'placeholder' => __('Short Description')]);
                         ?>
                    </div>
                    <div class="col-md-6">
                        <?php
                         echo $this->Form->control('meta_title', ['class' => 'form-control', 'placeholder' => __('Meta Title')]);
                    echo $this->Form->control('meta_keyword', ['class' => 'form-control', 'placeholder' => __('Meta Keyword')]);
                    echo $this->Form->control('meta_description', ['class' => 'form-control', 'placeholder' => __('Meta Description')]);
                        ?>
                        <div class="form-group">
                        <?php echo $this->Form->control('banner', ['type' => 'file']); ?>
                       <?php
                       if (!empty($page->image_path) && !empty($page->banner) && file_exists("img/".$page->image_path . $page->banner)) { ?>
                        <div class="form-group">
                            <?php
                            echo $this->Html->image($page->image_path . $page->banner, ['class' => 'img-thumbnail', 'style' => 'max-height:100px']);
                            ?>
                            <?php
                            echo $this->Html->link("<i class=\"fa fa-trash\"></i> ", ['action' => 'deleteimg', $page->id], ['id'=>'confirmDeletePhoto', 'class' => 'btn btn-danger btn-sm', 'escape' => false,'style'=>'margin-left:10px;']);
                            ?>
                             </div>
                        <?php } ?>

                    </div><!-- /.form-group --> 
                    </div>
                </div>
                <?php

                    echo $this->Form->control('description', ['type' => 'textarea', 'class' => 'form-control ckeditor', 'placeholder' => __('Description')]);
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
