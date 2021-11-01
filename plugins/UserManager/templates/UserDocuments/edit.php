<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $userDocument
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage User Document') ?>
        </h1>
        <small><?php echo empty($userDocument->id) ? __('Here you can add New user document') : __('Here you can edit user document'); ?></small>
</div>
<?php $this->end(); ?>

<div class="row userDocuments index content">
<div class="col-12 col-sm-12 col-md-12">
        <div class="panel-default">
            <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= __(empty($userDocument->id) ? 'Add User Document' : 'Edit User Document') ?></h2>
                <div class="d-flex flex-wrap">
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>

            <?= $this->Form->create($userDocument, ['role' => 'form', 'enctype' => 'multipart/form-data', 'templates' => 'horizontal_form']) ?>
            <div class="panel-body">

<?php
                    echo $this->Form->control('user_id', ['options' => $users, 'class' => 'form-control']);
                    echo $this->Form->control('document_type_id', ['class' => 'form-control', 'placeholder' => __('Document Type Id')]);
                    echo $this->Form->control('document_file', ['class' => 'form-control', 'placeholder' => __('Document File')]);
                    echo $this->Form->control('document_dir', ['class' => 'form-control', 'placeholder' => __('Document Dir')]);
                    echo $this->Form->control('document_size', ['class' => 'form-control', 'placeholder' => __('Document Size')]);
                    echo $this->Form->control('document_type', ['class' => 'form-control', 'placeholder' => __('Document Type')]);
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