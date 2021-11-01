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
        <small><?php echo __('Here you can view micro session chapter Detail'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row microSessionChapters view content">
<div class="col-12 col-sm-12 col-md-12">
    <div class="panel-default">
        <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= h($microSessionChapter->title) ?></h2>
                <div class="d-flex flex-wrap">
                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i> " . __('Edit Micro Session Chapter'), ['action' => 'add', $microSessionChapter->id], ['class' => 'btn btn-block btn-success btn-sm btn-flat mrg-r20', 'escape' => false]) ?>
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>
            <div class="panel-body">
<table class="table table-hover table-bordered">
                <tr>
                    <th width="20%"><?= __('Title') ?></th>
                    <td><?= h($microSessionChapter->title) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Video Url') ?></th>
                    <td><?= h($microSessionChapter->video_url) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Chapter File') ?></th>
                    <td><?= h($microSessionChapter->chapter_file) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Chapter File Dir') ?></th>
                    <td><?= h($microSessionChapter->chapter_file_dir) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Chapter File Type') ?></th>
                    <td><?= h($microSessionChapter->chapter_file_type) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Short Description') ?></th>
                    <td><?= h($microSessionChapter->short_description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($microSessionChapter->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Micro Session Id') ?></th>
                    <td><?= $this->Number->format($microSessionChapter->micro_session_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Chapter File Size') ?></th>
                    <td><?= $this->Number->format($microSessionChapter->chapter_file_size) ?></td>
                </tr>
                <tr>
                    <th><?= __('Position') ?></th>
                    <td><?= $this->Number->format($microSessionChapter->position) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td>
                        <?php if ($microSessionChapter->created) {
                                echo $microSessionChapter->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td>
                        <?php if ($microSessionChapter->modified) {
                                echo $microSessionChapter->modified->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Is Free') ?></th>
                    <td><?= $microSessionChapter->is_free ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($microSessionChapter->description)); ?>
                </blockquote>
            </div>

        </div>
    </div>
</div>



