<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $page
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Page') ?>  
        </h1>
        <small><?php echo __('Here you can view page Detail'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row pages view content">
<div class="col-12 col-sm-12 col-md-12">
    <div class="d-block">
    <div class="panel-default">
            <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= h($page->title) ?></h2>
                <div class="d-flex flex-wrap">
                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i> " . __('Edit Page'), ['action' => 'add', $page->id], ['class' => 'btn btn-block btn-success btn-sm btn-flat mrg-r20', 'escape' => false]) ?>
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>
            <div class="panel-body">
            <table class="table table-hover table-bordered">
                <tr>
                    <th width="20%"><?= __('Title') ?></th>
                    <td><?= h($page->title) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Sub Title') ?></th>
                    <td><?= h($page->sub_title) ?></td>
                </tr>
                <tr> 
                    <th width="20%"><?= __('Slug') ?></th>
                    <td><?= h($page->slug) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Short Description') ?></th>
                    <td><?= h($page->short_description) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Meta Title') ?></th>
                    <td><?= h($page->meta_title) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Meta Keyword') ?></th>
                    <td><?= h($page->meta_keyword) ?></td>
                </tr>

                <tr>
                    <th width="20%"><?= __('Meta Description') ?></th>
                    <td><?= $this->Text->autoParagraph(h($page->meta_description)); ?></td>
                </tr>
               
                <tr>
                    <th><?= __('Created') ?></th>
                    <td>
                        <?php if ($page->created) {
                                echo $page->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td>
                        <?php if ($page->modified) {
                                echo $page->modified->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                
            </table>

        </div>
    </div>
    </div>

    

</div>

<div class="col-12 col-sm-12 col-md-12">
        <div class="d-block">
        <div class="panel-default">
            <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= __('Description') ?></h2>
            </div>
            <div class="panel-body"><?= $this->Text->autoParagraph($page->description); ?></div>
        </div>
    </div>
</div>

