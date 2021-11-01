<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $roles
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Role') ?>  
        </h1>
        <small><?php echo __('Here you can manage the roles'); ?></small>
</div>
<?php $this->end(); ?>   
<div class="row roles index content">

<div class="col-12 col-sm-12 col-md-12">
                <div class="panel-default">
                    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                        <h2><?= __('Role') ?> List</h2>
                       <!--  <div class="d-flex flex-wrap">
                             <?= $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('New Role'), ["action" => "add"], ["class" => "btn btn-block btn-primary btn-sm btn-flat", "escape" => false]) ?>
                         </div> -->
                    </div>
                    <div class="panel-body">
                        
                        <div class="table-responsive">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th>#</th>
                        
                    <!--  <th><?= $this->Paginator->sort('listing_type_id', 'Listing Type') ?></th> -->
                    <th><?= $this->Paginator->sort('title') ?></th>
                    
                     <th><?= $this->Paginator->sort('created') ?></th>
                    
                     
                                  <th class="action-col">Action</th>
                                </tr>                                           
                              </thead>
                              <tbody>
                                <?php if (!empty($roles->toArray())): 
                                    $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                    foreach ($roles as $role): ?>
                                 <tr>
                                    <td><?= $this->Number->format($i) ?>.</td>
                                   <!--  <td><?= $role->has('listing_type') ? $this->Html->link($role->listing_type->title, ['controller' => 'ListingTypes', 'action' => 'view', $role->listing_type->id,'plugin' => 'Listings']) : '' ?></td> -->
                                    <td><?= h($role->title) ?></td>
            
                                    <td>
                                   <?php if ($role->created) {
                                      echo $role->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                      }
                                  ?>
                                  </td>
                                          

                            <td class="action-col">
                <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $role->id],['class' => 'btn btn-block btn-warning btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View role'),'title'=>__('View role')]) ?> 

                <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'add', $role->id], ['class' => 'btn btn-block btn-success btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit role'),'title'=>__('Edit role')]) ?> 

               
               <!--  <?= $this->Html->link("<i class=\"fa fa-trash\"></i>", ['action' => 'delete', $role->id], ['class' => 'confirmDeleteBtn btn btn-block btn-danger btn-xs btn-flat', 'data-url'=> $this->Url->build(['action' => 'delete', $role->id]), 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Delete Role'),'title'=>__('Delete Role')]) ?>  -->
                    </td>
                </tr>
                                <?php $i++; endforeach; ?>
                            <?php else: ?>
                            <tr> <td colspan='6' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> </tr>
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
