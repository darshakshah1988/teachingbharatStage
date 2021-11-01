<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $microSessionChapters
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
        <small><?php echo __('Here you can manage the micro session chapters'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row microSessionChapters index content">

<div class="col-12 col-sm-12 col-md-12">
                <div class="panel-default">
                    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                        <h2><?= __('Micro Session Chapter') ?> List</h2>
                        <div class="d-flex flex-wrap"><?= $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('New Micro Session Chapter'), ["action" => "add"], ["class" => "btn btn-block btn-primary btn-sm btn-flat", "escape" => false]) ?></div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= $this->Paginator->sort('micro_session_id') ?></th>
                                    <th><?= $this->Paginator->sort('title') ?></th>
                                    <th><?= $this->Paginator->sort('video_url') ?></th>
                                    <th><?= $this->Paginator->sort('chapter_file') ?></th>
                                    <th><?= $this->Paginator->sort('chapter_file_dir') ?></th>
                                    <th><?= $this->Paginator->sort('chapter_file_size') ?></th>
                                    <th><?= $this->Paginator->sort('chapter_file_type') ?></th>
                                    <th><?= $this->Paginator->sort('short_description') ?></th>
                                    <th><?= $this->Paginator->sort('position') ?></th>
                                    <th><?= $this->Paginator->sort('is_free') ?></th>
                                    <th><?= $this->Paginator->sort('created') ?></th>
                        <th class="action-col">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php if (!empty($microSessionChapters->toArray())):
                                    $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                    foreach ($microSessionChapters as $microSessionChapter): ?>
                                 <tr>
                                    <td><?= $this->Number->format($i) ?>.</td>
                            <td><?= $this->Number->format($microSessionChapter->micro_session_id) ?></td>
                                <td><?= h($microSessionChapter->title) ?></td>


                                <td><?= h($microSessionChapter->video_url) ?></td>


                                <td><?= h($microSessionChapter->chapter_file) ?></td>


                                <td><?= h($microSessionChapter->chapter_file_dir) ?></td>


                                <td><?= $this->Number->format($microSessionChapter->chapter_file_size) ?></td>
                                <td><?= h($microSessionChapter->chapter_file_type) ?></td>


                                <td><?= h($microSessionChapter->short_description) ?></td>


                                <td><?= $this->Number->format($microSessionChapter->position) ?></td>
                                    <td>
                                    <?php if ($microSessionChapter->is_free == 1) {
                                            echo "Yes";
                                        }else{
                                            echo "No";
                                        }
                                    ?>
                                </td>

                                <td>
                             <?php if ($microSessionChapter->created) {
                                echo $microSessionChapter->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                            </td>


                        <td class="action-col">
                <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $microSessionChapter->id],['class' => 'btn btn-block btn-warning btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View micro session chapter'),'title'=>__('View micro session chapter')]) ?>

                <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'add', $microSessionChapter->id], ['class' => 'btn btn-block btn-success btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit micro session chapter'),'title'=>__('Edit micro session chapter')]) ?>

                <?= $this->Html->link("<i class=\"fa fa-trash\"></i>", 'javascript:void(0)', ['class' => 'deleteWithReload btn btn-block btn-danger btn-xs btn-flat', 'data-url'=> $this->Url->build(['action' => 'delete', $microSessionChapter->id]), 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit micro session chapter'),'title'=>__('Delete micro session chapter')]) ?>
                    </td>
                </tr>
                                <?php $i++; endforeach; ?>
                            <?php else: ?>
                            <tr> <td colspan='13' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> </tr>
                            <?php endif; ?>
                              </tbody>
                            </table>
                        </div>
                        <div class="pagination-sec d-flex justify-content-between flex-wrap align-items-center">
                            <?php echo $this->element('pagination'); ?>
                        </div>
                    </div>
                </div>
            </div>
