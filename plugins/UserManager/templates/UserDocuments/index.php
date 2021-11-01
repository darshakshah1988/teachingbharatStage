<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $userDocuments
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
        <small><?php echo __('Here you can manage the user documents'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row userDocuments index content">

<div class="col-12 col-sm-12 col-md-12">
                <div class="panel-default">
                    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                        <h2><?= __('User Document') ?> List</h2>
                        <div class="d-flex flex-wrap"><?= $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('New User Document'), ["action" => "add"], ["class" => "btn btn-block btn-primary btn-sm btn-flat", "escape" => false]) ?></div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= $this->Paginator->sort('user_id') ?></th>
                                    <th><?= $this->Paginator->sort('document_type_id') ?></th>
                                    <th><?= $this->Paginator->sort('document_file') ?></th>
                                    <th><?= $this->Paginator->sort('document_dir') ?></th>
                                    <th><?= $this->Paginator->sort('document_size') ?></th>
                                    <th><?= $this->Paginator->sort('document_type') ?></th>
                                    <th><?= $this->Paginator->sort('created') ?></th>
                        <th class="action-col">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php if (!empty($userDocuments->toArray())):
                                    $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                    foreach ($userDocuments as $userDocument): ?>
                                 <tr>
                                    <td><?= $this->Number->format($i) ?>.</td>
                                    <td>
                                        <?= $userDocument->has('user') ? $this->Html->link($userDocument->user->id, ['controller' => 'Users', 'action' => 'view', $userDocument->user->id]) : '' ?>
                                    </td>
                                <td><?= $this->Number->format($userDocument->document_type_id) ?></td>
                                <td><?= h($userDocument->document_file) ?></td>


                                <td><?= h($userDocument->document_dir) ?></td>


                                <td><?= $this->Number->format($userDocument->document_size) ?></td>
                                <td><?= h($userDocument->document_type) ?></td>


                                <td>
                             <?php if ($userDocument->created) {
                                echo $userDocument->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                            </td>


                        <td class="action-col">
                <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $userDocument->id],['class' => 'btn btn-block btn-warning btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View user document'),'title'=>__('View user document')]) ?>

                <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'add', $userDocument->id], ['class' => 'btn btn-block btn-success btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit user document'),'title'=>__('Edit user document')]) ?>

                <?= $this->Html->link("<i class=\"fa fa-trash\"></i>", 'javascript:void(0)', ['class' => 'deleteWithReload btn btn-block btn-danger btn-xs btn-flat', 'data-url'=> $this->Url->build(['action' => 'delete', $userDocument->id]), 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit user document'),'title'=>__('Delete user document')]) ?>
                    </td>
                </tr>
                                <?php $i++; endforeach; ?>
                            <?php else: ?>
                            <tr> <td colspan='9' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> </tr>
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
