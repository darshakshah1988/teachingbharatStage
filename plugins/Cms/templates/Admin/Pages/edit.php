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
            <?php
            $this->loadHelper('Form', [
                'templates' => 'default_form',
            ]);
            ?>
            <?= $this->Form->create($page, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
            <div class="panel-body">
                
<?php
                    echo $this->Form->control('listing_id', ['class' => 'form-control', 'placeholder' => __('Listing Id')]);
                    echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => __('Title')]);
                    echo $this->Form->control('sub_title', ['class' => 'form-control', 'placeholder' => __('Sub Title')]);
                    echo $this->Form->control('slug', ['class' => 'form-control', 'placeholder' => __('Slug')]);
                    echo $this->Form->control('short_description', ['class' => 'form-control', 'placeholder' => __('Short Description')]);
                    echo $this->Form->control('description', ['class' => 'form-control', 'placeholder' => __('Description')]);
                    echo $this->Form->control('banner', ['class' => 'form-control', 'placeholder' => __('Banner')]);
                    echo $this->Form->control('banner_dir', ['class' => 'form-control', 'placeholder' => __('Banner Dir')]);
                    echo $this->Form->control('banner_size', ['class' => 'form-control', 'placeholder' => __('Banner Size')]);
                    echo $this->Form->control('banner_type', ['class' => 'form-control', 'placeholder' => __('Banner Type')]);
                    echo $this->Form->control('meta_title', ['class' => 'form-control', 'placeholder' => __('Meta Title')]);
                    echo $this->Form->control('meta_keyword', ['class' => 'form-control', 'placeholder' => __('Meta Keyword')]);
                    echo $this->Form->control('meta_description', ['class' => 'form-control', 'placeholder' => __('Meta Description')]);
                    echo $this->Form->control('status', ['class' => 'form-control', 'placeholder' => __('Status')]);
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