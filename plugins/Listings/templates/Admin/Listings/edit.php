<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $listing
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Listing') ?>  
        </h1>
        <small><?php echo empty($listing->id) ? __('Here you can add New listing') : __('Here you can edit listing'); ?></small> 
</div>
<?php $this->end(); ?>

<div class="row listings index content">
<div class="col-12 col-sm-12 col-md-12">
        <div class="panel-default">
            <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= __(empty($listing->id) ? 'Add Listing' : 'Edit Listing') ?></h2>
                <div class="d-flex flex-wrap">
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>
            <?php
            $this->loadHelper('Form', [
                'templates' => 'default_form',
            ]);
            ?>
            <?= $this->Form->create($listing, ['role' => 'form', 'enctype' => 'multipart/form-data']) ?>
            <div class="panel-body">
                
<?php
                    echo $this->Form->control('admin_user_id', ['class' => 'form-control', 'placeholder' => __('Admin User Id')]);
                    echo $this->Form->control('code', ['class' => 'form-control', 'placeholder' => __('Code')]);
                    echo $this->Form->control('listing_type_id', ['options' => $listingTypes, 'class' => 'form-control']);
                    echo $this->Form->control('parent_id', ['options' => $parentListings, 'empty' => true, 'class' => 'form-control']);
                    echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => __('Title')]);
                    echo $this->Form->control('slug', ['class' => 'form-control', 'placeholder' => __('Slug')]);
                    echo $this->Form->control('tag_line', ['class' => 'form-control', 'placeholder' => __('Tag Line')]);
                    echo $this->Form->control('protocol', ['class' => 'form-control', 'placeholder' => __('Protocol')]);
                    echo $this->Form->control('domain_name', ['class' => 'form-control', 'placeholder' => __('Domain Name')]);
                    echo $this->Form->control('registration_no', ['class' => 'form-control', 'placeholder' => __('Registration No')]);
                    echo $this->Form->control('registration_date', ['empty' => true, 'class' => 'form-control datepicker', 'placeholder' => __('Registration Date')]);
                    echo $this->Form->control('logo', ['class' => 'form-control', 'placeholder' => __('Logo')]);
                    echo $this->Form->control('logo_dir', ['class' => 'form-control', 'placeholder' => __('Logo Dir')]);
                    echo $this->Form->control('logo_size', ['class' => 'form-control', 'placeholder' => __('Logo Size')]);
                    echo $this->Form->control('logo_type', ['class' => 'form-control', 'placeholder' => __('Logo Type')]);
                    echo $this->Form->control('banner', ['class' => 'form-control', 'placeholder' => __('Banner')]);
                    echo $this->Form->control('banner_dir', ['class' => 'form-control', 'placeholder' => __('Banner Dir')]);
                    echo $this->Form->control('banner_size', ['class' => 'form-control', 'placeholder' => __('Banner Size')]);
                    echo $this->Form->control('banner_type', ['class' => 'form-control', 'placeholder' => __('Banner Type')]);
                    echo $this->Form->control('thumb_image', ['class' => 'form-control', 'placeholder' => __('Thumb Image')]);
                    echo $this->Form->control('thumb_image_dir', ['class' => 'form-control', 'placeholder' => __('Thumb Image Dir')]);
                    echo $this->Form->control('thumb_image_size', ['class' => 'form-control', 'placeholder' => __('Thumb Image Size')]);
                    echo $this->Form->control('thumb_image_type', ['class' => 'form-control', 'placeholder' => __('Thumb Image Type')]);
                    echo $this->Form->control('location_id', ['class' => 'form-control', 'placeholder' => __('Location Id')]);
                    echo $this->Form->control('address_line_1', ['class' => 'form-control', 'placeholder' => __('Address Line 1')]);
                    echo $this->Form->control('address_line_2', ['class' => 'form-control', 'placeholder' => __('Address Line 2')]);
                    echo $this->Form->control('postcode', ['class' => 'form-control', 'placeholder' => __('Postcode')]);
                    echo $this->Form->control('latitude', ['class' => 'form-control', 'placeholder' => __('Latitude')]);
                    echo $this->Form->control('longitude', ['class' => 'form-control', 'placeholder' => __('Longitude')]);
                    echo $this->Form->control('short_description', ['class' => 'form-control', 'placeholder' => __('Short Description')]);
                    echo $this->Form->control('description', ['class' => 'form-control', 'placeholder' => __('Description')]);
                    echo $this->Form->control('meta_title', ['class' => 'form-control', 'placeholder' => __('Meta Title')]);
                    echo $this->Form->control('meta_keyword', ['class' => 'form-control', 'placeholder' => __('Meta Keyword')]);
                    echo $this->Form->control('meta_description', ['class' => 'form-control', 'placeholder' => __('Meta Description')]);
                    echo $this->Form->control('is_visible', ['class' => 'form-control', 'placeholder' => __('Is Visible')]);
                    echo $this->Form->control('status', ['class' => 'form-control', 'placeholder' => __('Status')]);
                    echo $this->Form->control('sort_order', ['class' => 'form-control', 'placeholder' => __('Sort Order')]);
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