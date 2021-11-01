<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $navigations
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Navigation') ?>  
        </h1>
        <small><?php echo __('Here you can manage the navigations'); ?></small>
</div>
<?php $this->end(); ?>   
<div class="row navigations index content">

<div class="col-12 col-sm-12 col-md-12">
                <div class="panel-default">
                    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                        <h2><?= __('navigation') ?> List</h2> 
                        <div class="d-flex flex-wrap"><?= $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('New Navigation'), ["action" => "add"], ["class" => "btn btn-block btn-primary btn-sm btn-flat", "escape" => false]) ?></div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Parent Menu</th>
                                    <th><?= $this->Paginator->sort('title') ?></th>
                                    <th><?= $this->Paginator->sort('menu_link') ?></th>
                                    <th><?= $this->Paginator->sort('status') ?></th>
                                    <th>Position</th>
                                    <th><?= $this->Paginator->sort('created') ?></th>
                    
                    
                        <th class="action-col">Action</th>
                                </tr>                                           
                              </thead>
                              <tbody>
                                <?php if (!empty($navigations->toArray())): 
                                    $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                    foreach ($navigations as $navigation): ?>
                                 <tr>
                                    <td><?= $this->Number->format($i) ?>.</td>
                                    <td><?php echo $this->cell('Cms.Navigations::getParentMenus', [$navigation->id]); ?></td>  
                                    <td><?= h($navigation->title) ?></td>
                                    <td>
                                        <?php
                                        $json_url = json_decode($navigation->menu_link, true);
                                        //dump($json_url);
                                        if (empty($json_url)) {
                                           $json_url = $navigation->menu_link;
                                        } else {
                                            $json_url['prefix'] = FALSE;
                                        }
                                        if(\Cake\Routing\Router::routeExists($json_url)){
                                                echo $this->Url->build($json_url, ['fullBase' => true]);
                                            }else{
                                                echo $navigation->json_path;
                                                echo "<br><strong>Error:</strong> This Route could not be found.";
                                            }
                                        //echo $this->Url->build($json_url, true);
                                        ?>
                                    </td>  
                                    <td>
                                    <?php if ($navigation->status == 1) {
                                            echo "Active";
                                        }else{
                                            echo "In-active";
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php echo $this->Html->link('Up', ['action' => 'moveUp', $navigation->id]) ?>

                                    <?php echo $this->Html->link('Down', ['action' => 'moveDown', $navigation->id]) ?>
                                </td>
                                <td>
                             <?php if ($navigation->created) {
                                echo $navigation->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                            </td>
            

                        <td class="action-col">
                <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $navigation->id],['class' => 'btn btn-block btn-warning btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View navigation'),'title'=>__('View navigation')]) ?> 

                <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'add', $navigation->id], ['class' => 'btn btn-block btn-success btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit navigation'),'title'=>__('Edit navigation')]) ?> 

                <?= $this->Html->link("<i class=\"fa fa-trash\"></i>", ['action' => 'delete', $navigation->id], ['class' => 'confirmDeleteBtn btn btn-block btn-danger btn-xs btn-flat', 'data-url'=> $this->Url->build(['action' => 'delete', $navigation->id]), 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit navigation'),'title'=>__('Delete navigation')]) ?>
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
