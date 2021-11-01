<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $review
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Review') ?>
        </h1>
        <small><?php echo empty($review->id) ? __('Here you can add New review') : __('Here you can edit review'); ?></small>
</div>
<?php $this->end(); ?>

<div class="row reviews index content">
<div class="col-12 col-sm-12 col-md-12">
        <div class="panel-default">
            <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= __(empty($review->id) ? 'Add Review' : 'Edit Review') ?></h2>
                <div class="d-flex flex-wrap">
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>

            <?= $this->Form->create($review, ['role' => 'form', 'enctype' => 'multipart/form-data', 'templates' => 'horizontal_form']) ?>
            <div class="panel-body">

<?php
                    echo $this->Form->control('user_id', ['options' => $users, 'empty' => true, 'class' => 'form-control']);
                    echo $this->Form->control('course_id', ['options' => $courses, 'class' => 'form-control']);
                    echo $this->Form->control('name', ['class' => 'form-control', 'placeholder' => __('Name')]);
                    echo $this->Form->control('rating', ['class' => 'form-control', 'placeholder' => __('Rating')]);
                    echo $this->Form->control('description', ['class' => 'form-control', 'placeholder' => __('Description')]);
                    echo $this->Form->control('photo', ['class' => 'form-control', 'placeholder' => __('Photo')]);
                    echo $this->Form->control('photo_dir', ['class' => 'form-control', 'placeholder' => __('Photo Dir')]);
                    echo $this->Form->control('photo_size', ['class' => 'form-control', 'placeholder' => __('Photo Size')]);
                    echo $this->Form->control('photo_type', ['class' => 'form-control', 'placeholder' => __('Photo Type')]);
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