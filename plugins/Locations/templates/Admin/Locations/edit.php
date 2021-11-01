<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $location
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Location') ?>
        </h1>
        <small><?php echo empty($location->id) ? __('Here you can add New location') : __('Here you can edit location'); ?></small>
</div>
<?php $this->end(); ?>

<div class="row locations index content">
<div class="col-12 col-sm-12 col-md-12">
        <div class="panel-default">
            <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= __(empty($location->id) ? 'Add Location' : 'Edit Location') ?></h2>
                <div class="d-flex flex-wrap">
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>

            <?= $this->Form->create($location, ['role' => 'form', 'enctype' => 'multipart/form-data', 'templates' => 'horizontal_form']) ?>
            <div class="panel-body">

<?php
                    echo $this->Form->control('parent_id', ['options' => $parentLocations, 'class' => 'form-control']);
                    echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => __('Title')]);
                    echo $this->Form->control('slug', ['class' => 'form-control', 'placeholder' => __('Slug')]);
                    echo $this->Form->control('latitude', ['class' => 'form-control', 'placeholder' => __('Latitude')]);
                    echo $this->Form->control('longitude', ['class' => 'form-control', 'placeholder' => __('Longitude')]);
                    echo $this->Form->control('iso_alpha2_code', ['class' => 'form-control', 'placeholder' => __('Iso Alpha2 Code')]);
                    echo $this->Form->control('iso_alpha3_code', ['class' => 'form-control', 'placeholder' => __('Iso Alpha3 Code')]);
                    echo $this->Form->control('iso_numeric_code', ['class' => 'form-control', 'placeholder' => __('Iso Numeric Code')]);
                    echo $this->Form->control('formatted_address', ['class' => 'form-control', 'placeholder' => __('Formatted Address')]);
                    echo $this->Form->control('status', ['class' => 'form-control', 'placeholder' => __('Status')]);
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