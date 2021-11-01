<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $microSession
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Micro Session') ?>
        </h1>
        <small><?php echo empty($microSession->id) ? __('Here you can add New micro session') : __('Here you can edit micro session'); ?></small>
</div>
<?php $this->end(); ?>

<div class="row microSessions index content">
<div class="col-12 col-sm-12 col-md-12">
        <div class="panel-default">
            <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= __(empty($microSession->id) ? 'Add Micro Session' : 'Edit Micro Session') ?></h2>
                <div class="d-flex flex-wrap">
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>

            <?= $this->Form->create($microSession, ['role' => 'form', 'enctype' => 'multipart/form-data', 'templates' => 'horizontal_form']) ?>
            <div class="panel-body">

<?php
                    echo $this->Form->control('listing_id', ['options' => $listings, 'class' => 'form-control']);
                    echo $this->Form->control('slug', ['class' => 'form-control', 'placeholder' => __('Slug')]);
                    echo $this->Form->control('user_id', ['options' => $users, 'class' => 'form-control']);
                    echo $this->Form->control('parent_id', ['options' => $parentMicroSessions, 'empty' => true, 'class' => 'form-control']);
                    echo $this->Form->control('grading_type_id', ['options' => $gradingTypes, 'class' => 'form-control']);
                    echo $this->Form->control('academic_year_id', ['options' => $academicYears, 'class' => 'form-control']);
                    echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => __('Title')]);
                    echo $this->Form->control('board_id', ['options' => $boards, 'class' => 'form-control']);
                    echo $this->Form->control('subject_id', ['options' => $subjects, 'class' => 'form-control']);
                    echo $this->Form->control('duration', ['class' => 'form-control', 'placeholder' => __('Duration')]);
                    echo $this->Form->control('price', ['class' => 'form-control', 'placeholder' => __('Price')]);
                    echo $this->Form->control('discount_price', ['class' => 'form-control', 'placeholder' => __('Discount Price')]);
                    echo $this->Form->control('is_free', ['class' => 'form-control', 'placeholder' => __('Is Free')]);
                    echo $this->Form->control('short_description', ['class' => 'form-control', 'placeholder' => __('Short Description')]);
                    echo $this->Form->control('description', ['class' => 'form-control', 'placeholder' => __('Description')]);
                    echo $this->Form->control('section_name', ['class' => 'form-control', 'placeholder' => __('Section Name')]);
                    echo $this->Form->control('code', ['class' => 'form-control', 'placeholder' => __('Code')]);
                    echo $this->Form->control('start_date', ['class' => 'form-control', 'placeholder' => __('Start Date')]);
                    echo $this->Form->control('end_date', ['class' => 'form-control', 'placeholder' => __('End Date')]);
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