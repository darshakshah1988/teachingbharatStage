<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $modules
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Module') ?>  
        </h1>
        <small><?php echo __('Here you can manage the modules'); ?></small>
</div>
<?php $this->end(); ?>   
<div class="row modules index content">

<div class="col-12 col-sm-12 col-md-12">
                <div class="panel-default">
                    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                        <h2><?= __('Module') ?> List</h2> 
                        <div class="d-flex flex-wrap"><?= $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('New Module'), ["action" => "add"], ["class" => "btn btn-block btn-primary btn-sm btn-flat", "escape" => false]) ?></div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                    <th>#</th>
                    
                                    <th><?= $this->Paginator->sort('title') ?></th>
                    
                                    <th>Full URL</th>
                    
                                    <th><?= $this->Paginator->sort('created') ?></th>
                    
                                    <th class="action-col">Action</th>
                                </tr>                                           
                              </thead>
                              <tbody>
                                <?php if (!empty($modules->toArray())): 
                                    $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                    foreach ($modules as $module): ?>
                                 <tr>
                                    <td><?= $this->Number->format($i) ?>.</td>
                                    
                                    <td><?= h($module->title) ?></td>
                                    <td>
                                        <?php
                                            $json_url = json_decode($module->json_path, true);
                                            $json_url['prefix'] = false;
                                            if(\Cake\Routing\Router::routeExists($json_url)){
                                                echo $this->Url->build($json_url, ['fullBase' => true]);
                                            }else{
                                                echo $module->json_path;
                                                echo "<br><strong>Error:</strong> This Route could not be found.";
                                            }
                                            ?>
                                    </td>

                                    <td>
                                     <?php if ($module->created) {
                                        echo $module->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                        }
                                    ?>
                                    </td>
            

                                    <td class="action-col">
                            <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $module->id],['class' => 'btn btn-block btn-warning btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View module'),'title'=>__('View module')]) ?> 

                            <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'add', $module->id], ['class' => 'btn btn-block btn-success btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit module'),'title'=>__('Edit module')]) ?> 

                            <?= $this->Html->link("<i class=\"fa fa-trash\"></i>", ['action' => 'delete', $module->id], ['class' => 'confirmDeleteBtn btn btn-block btn-danger btn-xs btn-flat', 'data-url'=> $this->Url->build(['action' => 'delete', $module->id]), 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit module'),'title'=>__('Delete module')]) ?>
                                </td>
                            </tr>
                                <?php $i++; endforeach; ?>
                            <?php else: ?>
                            <tr> <td colspan='16' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> </tr>
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
