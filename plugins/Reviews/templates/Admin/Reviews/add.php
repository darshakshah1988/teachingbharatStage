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
            <?= __('Manage {0} Review', ucfirst($this->request->getQuery('review_type'))) ?>
        </h1>
        <small><?php echo empty($review->id) ? __('Here you can add new {0} review', $this->request->getQuery('review_type')) : __('Here you can edit {0} review', $this->request->getQuery('review_type')); ?></small>
</div>
<?php $this->end(); ?>

<div class="row reviews index content">
<div class="col-12 col-sm-12 col-md-12">
        <div class="panel-default">
            <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= __(empty($review->id) ? 'Add Review' : 'Edit Review') ?></h2>
                <div class="d-flex flex-wrap">
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index', '?' => $this->request->getQuery()], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>

            <?= $this->Form->create($review, ['role' => 'form', 'enctype' => 'multipart/form-data', 'templates' => 'horizontal_form']) ?>
            <div class="panel-body">

<?php
                echo $this->Form->hidden('review_type', ['value' => $this->request->getQuery('review_type')]);
                    //echo $this->Form->control('user_id', ['options' => $users, 'empty' => true, 'class' => 'form-control']);
                    if($this->request->getQuery('review_type') == "course" || $this->request->getQuery('review_type') == "session"){

                        echo $this->Form->control('course_id', ['options' => $courses, 'class' => 'form-control', 'empty' => 'Select Course']);
                    }else{
                        echo $this->Form->control('user_id', ['options' => $users, 'class' => 'form-control', 'empty' => 'Select User']);
                    }
                    

                    echo $this->Form->control('name', ['class' => 'form-control', 'placeholder' => __('Name')]);
                    echo $this->Form->control('rating', ['options' => [1 => '1 star', 2 => '2 star', 3 => '3 star', 4 => '4 star', 5 => '5 star'],'class' => 'form-control', 'placeholder' => __('Rating')]);
                    echo $this->Form->control('description', ['class' => 'form-control', 'placeholder' => __('Description')]);
                   
                  echo $this->Form->control('photo', ['type' => 'file', 'required' => false]);
                    if (!empty($review->photo_path) && !is_array($review->photo) && file_exists("img/" . $review->photo_path . $review->photo)) { ?>
                        <div class="form-group">
                            <?php
                            echo $this->Html->image($review->photo_path . $review->photo, ['class' => 'img-thumbnail', 'style' => 'max-height:100px']);
                            ?>
                        </div>
                    <?php } ?>

                    <?php
                    echo $this->Form->control('designation', ['class' => 'form-control', 'placeholder' => __('Designation')]);
                     echo $this->Form->control('location', ['class' => 'form-control', 'placeholder' => __('Location')]);
                     echo $this->Form->control('status', ['options' => [1 => "Active", 0 => "Inactive"], 'empty' => false, 'class' => 'form-control', 'placeholder' => __('Status')]);
                     ?>
              
            </div>
            <div class="panel-footer d-flex flex-wrap justify-content-between align-items-center">
                <?php echo $this->Form->button("<i class='fa fa-fw fa-save'></i> " . __('Submit'), ['class' => 'btn btn-primary btn-sm btn-flat my-button', 'title' => __('Submit'), 'escapeTitle' => false]); ?>
            <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> " . __('Cancel'), ['action' => 'index', '?' => $this->request->getQuery()], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Cancel'), 'escape' => false]); ?>
            </div>
            <?= $this->Form->end() ?>

        </div>
    </div>
</div>