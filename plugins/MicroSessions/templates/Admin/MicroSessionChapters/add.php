<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $microSessionChapter
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Micro Session Chapter') ?>
        </h1>
        <small><?php echo empty($microSessionChapter->id) ? __('Here you can add New micro session chapter') : __('Here you can edit micro session chapter'); ?></small>
</div>
<?php $this->end(); ?>

<div class="row microSessionChapters index content">
<div class="col-12 col-sm-12 col-md-12">
        <div class="panel-default">
            <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= __(empty($microSessionChapter->id) ? 'Add Micro Session Chapter' : 'Edit Micro Session Chapter') ?></h2>
                <div class="d-flex flex-wrap">
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>

            <?= $this->Form->create($microSessionChapter, ['role' => 'form', 'enctype' => 'multipart/form-data', 'templates' => 'horizontal_form']) ?>
            <div class="panel-body">

<?php
                    echo $this->Form->control('micro_session_id', ['class' => 'form-control', 'placeholder' => __('Micro Session Id')]);
                    echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => __('Title')]);
                    echo $this->Form->control('video_url', ['class' => 'form-control', 'placeholder' => __('Video Url')]);
                    echo $this->Form->control('chapter_file', ['class' => 'form-control', 'placeholder' => __('Chapter File')]);
                    echo $this->Form->control('chapter_file_dir', ['class' => 'form-control', 'placeholder' => __('Chapter File Dir')]);
                    echo $this->Form->control('chapter_file_size', ['class' => 'form-control', 'placeholder' => __('Chapter File Size')]);
                    echo $this->Form->control('chapter_file_type', ['class' => 'form-control', 'placeholder' => __('Chapter File Type')]);
                    echo $this->Form->control('short_description', ['class' => 'form-control', 'placeholder' => __('Short Description')]);
                    echo $this->Form->control('description', ['class' => 'form-control', 'placeholder' => __('Description')]);
                    echo $this->Form->control('position', ['class' => 'form-control', 'placeholder' => __('Position')]);
                    echo $this->Form->control('is_free', ['class' => 'form-control', 'placeholder' => __('Is Free')]);
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