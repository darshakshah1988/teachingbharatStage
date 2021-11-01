<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $newsposts
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Newspost') ?>
        </h1>
        <small><?php echo __('Here you can manage the newsposts'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row newsposts index content">

<div class="col-12 col-sm-12 col-md-12">
                <div class="panel-default">
                    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                        <h2><?= __('Newspost') ?> List</h2>
                        <div class="d-flex flex-wrap"><?= $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('New Newspost'), ["action" => "add"], ["class" => "btn btn-block btn-primary btn-sm btn-flat", "escape" => false]) ?></div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Banner</th>
                                    <th><?= $this->Paginator->sort('title') ?></th>
                                    <th><?= $this->Paginator->sort('short_description') ?></th>
                                    <th><?= $this->Paginator->sort('status') ?></th>
                                    <th><?= $this->Paginator->sort('created') ?></th>
                                    <th class="action-col">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php if (!empty($newsposts->toArray())):
                                    $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                    foreach ($newsposts as $newspost): ?>
                                 <tr>
                                    <td><?= $this->Number->format($i) ?>.</td>
                                    <td> 
                                        <?php
                                        if (!empty($newspost->banner_image) && file_exists("img/".$newspost->banner_path . $newspost->banner_image)) {
                                            echo $this->Html->image($newspost->banner_path . $newspost->banner_image, ['class' => 'img-thumbnail', 'alt' => 'Image', 'style' => 'max-height:90px']);
                                        }else{
                                            echo $this->Html->image("no_image.gif", ['class' => 'img-thumbnail', 'alt' => 'Image', 'style' => 'max-height:90px']);
                                        }
                                        ?>
                                    </td>
                                <td>
                                        <?= h($newspost->title) ?>
                                        <small style="display: block;">(<?= h($newspost->slug) ?>)</small>
                                </td>
                                <td><?= h($newspost->short_description) ?></td>
                                    <td>
                                    <?php if ($newspost->status == 1) {
                                            echo "Active";
                                        }else{
                                            echo "In-Active";
                                        }
                                    ?>
                                </td>
                                <td>
                             <?php if ($newspost->created) {
                                echo $newspost->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                            </td>


                        <td class="action-col">
                        <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $newspost->id],['class' => 'btn btn-block btn-warning btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View newspost'),'title'=>__('View newspost')]) ?>

                        <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'add', $newspost->id], ['class' => 'btn btn-block btn-success btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit newspost'),'title'=>__('Edit newspost')]) ?>

                        <?= $this->Html->link("<i class=\"fa fa-trash\"></i>", ['action' => 'delete', $newspost->id], ['class' => 'confirmDeleteBtn btn btn-block btn-danger btn-xs btn-flat', 'data-url'=> $this->Url->build(['action' => 'delete', $newspost->id]), 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit newspost'),'title'=>__('Delete newspost')]) ?>
                            </td> 
                        </tr>
                                <?php $i++; endforeach; ?>
                            <?php else: ?>
                            <tr> <td colspan='8' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> </tr>
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
