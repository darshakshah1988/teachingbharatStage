<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $language
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Language') ?>
        </h1>
        <small><?php echo empty($language->id) ? __('Here you can add New language') : __('Here you can edit language'); ?></small>
</div>
<?php $this->end(); ?>

<div class="row languages index content">
<div class="col-12 col-sm-12 col-md-12">
        <div class="panel-default">
            <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= __(empty($language->id) ? 'Add Language' : 'Edit Language') ?></h2>
                <div class="d-flex flex-wrap">
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>

            <?= $this->Form->create($language, ['role' => 'form', 'enctype' => 'multipart/form-data', 'templates' => 'horizontal_form']) ?>
            <div class="panel-body">

                <?php
                    echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => __('Title')]);
                    echo $this->Form->control('code', ['class' => 'form-control', 'placeholder' => __('Code')]);
                    echo $this->Form->control('locale', ['class' => 'form-control', 'placeholder' => __('Locale')]);
                    echo $this->Form->control('position', ['class' => 'form-control', 'placeholder' => __('Sort Order')]);
                    echo $this->Form->control('status', ['options' => [1 => "Active", 0 => "Inactive"], 'class' => 'form-control', 'empty' => false]);
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