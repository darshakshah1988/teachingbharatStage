<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $medias
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage '.$title) ?>  
        </h1>
        <small><?php echo __('Here you can manage the ' . strtolower($title)); ?></small>
</div>
<?php $this->end(); ?>   
<div class="row medias index content">

<div class="col-12 col-sm-12 col-md-12">
                <div class="panel-default">
                    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                        <h2><?= __($title) ?> List</h2> 
                        <div class="d-flex flex-wrap"><?= $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('New '.$title), ["action" => "add", '?' => ['type' => $slug]], ["class" => "btn btn-block btn-primary btn-sm btn-flat", "escape" => false]) ?></div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                    
                                    <th><?= $this->Paginator->sort('title') ?></th>
                    
                                    <th><?= $this->Paginator->sort('status') ?></th>
                    
                    
                                    <th><?= $this->Paginator->sort('created') ?></th>
                    
                                    <th class="action-col">Action</th> 
                                </tr>                                           
                              </thead>
                              <tbody>
                                <?php if (!empty($medias->toArray())): 
                                    $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                    foreach ($medias as $media): ?>
                                 <tr>
                                    <td><?= $this->Number->format($i) ?>.</td>
                                    <td><?= h($media->id) ?></td>
                                    <td><?= h($media->title) ?></td>
                                    <td>
                                    <?php if ($media->status == 1) {
                                            echo "Yes";
                                        }else{
                                            echo "No";
                                        }
                                    ?>
                                </td>

                                <td>
                             <?php if ($media->created) {
                                echo $media->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                               
                            ?>
                            </td>
            

                        <td class="action-col">
                <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $media->id, '?' => ['type' => $slug]],['class' => 'btn btn-block btn-warning btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View media'),'title'=>__('View media')]) ?> 

                <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'add', $media->id, '?' => ['type' => $slug]], ['class' => 'btn btn-block btn-success btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit media'),'title'=>__('Edit media')]) ?> 

                <?= $this->Html->link("<i class=\"fa fa-trash\"></i>", ['action' => 'delete', $media->id], ['class' => 'confirmDeleteBtn btn btn-block btn-danger btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit media'),'title'=>__('Delete media')]) ?>
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
