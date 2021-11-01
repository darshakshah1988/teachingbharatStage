<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $subject
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Subject') ?>
        </h1>
        <small><?php echo empty($subject->id) ? __('Here you can add New subject') : __('Here you can edit subject'); ?></small>
</div>
<?php $this->end(); ?>

<div class="row subjects index content">
<div class="col-12 col-sm-12 col-md-12">
        <div class="panel-default">
            <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= __(empty($subject->id) ? 'Add Subject' : 'Edit Subject') ?></h2>
                <div class="d-flex flex-wrap">
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>

            <?= $this->Form->create($subject, ['role' => 'form', 'enctype' => 'multipart/form-data', 'templates' => 'horizontal_form']) ?>
            <div class="panel-body">

<?php
                    echo $this->Form->control('course_id', ['options' => $courses, 'empty' => true, 'class' => 'form-control']);
                    echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => __('Title')]);
                    echo $this->Form->control('max_weekly_classes', ['class' => 'form-control', 'placeholder' => __('Max Weekly Classes')]);
                    echo $this->Form->control('credit_hours', ['class' => 'form-control', 'placeholder' => __('Credit Hours')]);
                    echo $this->Form->control('is_activity', ['class' => 'form-control', 'placeholder' => __('Is Activity')]);
                    echo $this->Form->control('is_exam', ['class' => 'form-control', 'placeholder' => __('Is Exam')]);
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