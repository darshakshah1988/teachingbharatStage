<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $event
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Event') ?>
        </h1>
        <small><?php echo empty($event->id) ? __('Here you can add New event') : __('Here you can edit event'); ?></small>
</div>
<?php $this->end(); ?>

<div class="row events index content">
<div class="col-12 col-sm-12 col-md-12">
        <div class="panel-default">
            <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= __(empty($event->id) ? 'Add Event' : 'Edit Event') ?></h2>
                <div class="d-flex flex-wrap">
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>

            <?= $this->Form->create($event, ['role' => 'form', 'enctype' => 'multipart/form-data', 'templates' => 'horizontal_form']) ?>
            <div class="panel-body">

<?php
                    echo $this->Form->control('admin_user_id', ['options' => $adminUsers, 'class' => 'form-control']);
                    echo $this->Form->control('listing_id', ['options' => $listings, 'class' => 'form-control']);
                    echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => __('Title')]);
                    echo $this->Form->control('sub_title', ['class' => 'form-control', 'placeholder' => __('Sub Title')]);
                    echo $this->Form->control('short_description', ['class' => 'form-control', 'placeholder' => __('Short Description')]);
                    echo $this->Form->control('description', ['class' => 'form-control', 'placeholder' => __('Description')]);
                    echo $this->Form->control('location', ['class' => 'form-control', 'placeholder' => __('Location')]);
                    echo $this->Form->control('organizar_name', ['class' => 'form-control', 'placeholder' => __('Organizar Name')]);
                    echo $this->Form->control('organizer_email', ['class' => 'form-control', 'placeholder' => __('Organizer Email')]);
                    echo $this->Form->control('organizer_contact_number', ['class' => 'form-control', 'placeholder' => __('Organizer Contact Number')]);
                    echo $this->Form->control('banner', ['class' => 'form-control', 'placeholder' => __('Banner')]);
                    echo $this->Form->control('banner_dir', ['class' => 'form-control', 'placeholder' => __('Banner Dir')]);
                    echo $this->Form->control('banner_size', ['class' => 'form-control', 'placeholder' => __('Banner Size')]);
                    echo $this->Form->control('banner_type', ['class' => 'form-control', 'placeholder' => __('Banner Type')]);
                    echo $this->Form->control('start_date', ['class' => 'form-control', 'placeholder' => __('Start Date')]);
                    echo $this->Form->control('end_date', ['class' => 'form-control', 'placeholder' => __('End Date')]);
                    echo $this->Form->control('meta_title', ['class' => 'form-control', 'placeholder' => __('Meta Title')]);
                    echo $this->Form->control('meta_keyword', ['class' => 'form-control', 'placeholder' => __('Meta Keyword')]);
                    echo $this->Form->control('meta_description', ['class' => 'form-control', 'placeholder' => __('Meta Description')]);
                    echo $this->Form->control('status', ['class' => 'form-control', 'placeholder' => __('Status')]);
                    echo $this->Form->control('position', ['class' => 'form-control', 'placeholder' => __('Position')]);
                    echo $this->Form->control('phinxlog._ids', ['options' => $phinxlog, 'class' => 'form-control multi']);
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