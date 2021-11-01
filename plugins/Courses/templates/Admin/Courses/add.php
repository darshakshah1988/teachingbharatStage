<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $course
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Course') ?>
        </h1>
        <small><?php echo empty($course->id) ? __('Here you can add New course') : __('Here you can edit course'); ?></small>
</div>
<?php $this->end(); ?>

<div class="row courses index content">
<div class="col-12 col-sm-12 col-md-12">
        <div class="panel-default">
            <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= __(empty($course->id) ? 'Add Course' : 'Edit Course') ?></h2>
                <div class="d-flex flex-wrap">
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>

            <?= $this->Form->create($course, ['role' => 'form', 'enctype' => 'multipart/form-data', 'templates' => 'horizontal_form']) ?>
            <div class="panel-body">

<?php
                    echo $this->Form->control('title', ['class' => 'form-control', 'placeholder' => __('Title')]);
                    echo $this->Form->control('board_id', ['empty' => 'Select Board', 'class' => 'form-control']);

                    echo $this->Form->control('grading_type_id', ['empty' => 'Select Class', 'options' => $gradingTypes, 'class' => 'form-control', 'label' => 'Class']);

                    echo $this->Form->control('subject_id', ['class' => 'form-control', 'label' => 'Subject']);
                    
                   echo $this->Form->control('duration', ['class' => 'form-control', 'placeholder' => __('i.e 15 Hours'), 'label' => 'Duration *']);
                   
                   echo $this->Form->control('price', ['class' => 'form-control', 'placeholder' => __('Price e.g ₹ 12500'), 'label' => 'Price *', 'min' => 0]);

                   echo $this->Form->control('discount_price', ['class' => 'form-control', 'placeholder' => __('Discount Price e.g ₹ 9999'), 'min' => 0]);

                    echo $this->Form->control('position', ['class' => 'form-control', 'placeholder' => __('Position')]);
                    echo $this->Form->control('short_description', ['class' => 'form-control', 'placeholder' => __('This will apprear at the Banner Area.. Max 256 words'), 'rows' => 5]);
                    
                    echo $this->Form->control('description', ['class' => 'form-control ckeditor', 'placeholder' => __('Course Description'), 'label' => 'Course Description *', 'id' => 'ckeditor1']);

                    echo $this->Form->control('status', ['options' => [1 => "Active", 0 => "Inactive"], 'empty' => false, 'class' => 'form-control', 'placeholder' => __('Status')]);

                ?>
                
                <div class="form-group">
                    <div class="row input select">
                        <label class="col-md-3 control-label" for="is_free">Free</label>
                        <div class="col-md-8">
                            <?= $this->Form->checkbox('is_free', [ 'class' => 'D-checkbox', 'id' => 'is_free']); ?>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="panel-footer d-flex flex-wrap justify-content-between align-items-center">
                <?php echo $this->Form->button("<i class='fa fa-fw fa-save'></i> " . __('Submit'), ['class' => 'btn btn-primary btn-sm btn-flat my-button', 'title' => __('Submit'), 'escapeTitle' => false]); ?>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Cancel'), 'escape' => false]); ?>
            </div>
            <?= $this->Form->end() ?>

        </div>
    </div>
</div>

