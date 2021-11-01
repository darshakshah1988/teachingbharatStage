<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $enquiryStatus
 */
$this->layout = "ajax";
?>
<div class="row enquiryStatuses index content">
    <div class="col-12 col-sm-12 col-md-12">
            <?= $this->Form->create($user, ['role' => 'form', 'enctype' => 'multipart/form-data', 'templates' => 'horizontal_form']) ?>
                <?php
                    echo $this->Form->control('active', ['options' => [1 => 'Approved', 0 => 'Unapprove'], 'class' => 'form-control', 'empty' => __('Teacher Status'), 'label' => 'Teacher Status']);
                    echo $this->Form->control('comment', ['class' => 'form-control', 'placeholder' => __('Comment'), 'label' => 'Comment']);
                ?>
            <?= $this->Form->end() ?>
    </div>
 
</div>
