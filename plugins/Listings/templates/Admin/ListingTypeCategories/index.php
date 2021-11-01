<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $listingTypeCategories
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Listing Type Category') ?>  
        </h1>
        <small><?php echo __('Here you can manage the listing type categories'); ?></small>
</div>
<?php $this->end(); ?>   
<div class="row listingTypeCategories index content">

<div class="col-12 col-sm-12 col-md-12">
                <div class="panel-default">
                    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                        <h2><?= __('listingTypeCategory') ?> List</h2> 
                        <div class="d-flex flex-wrap">
                                                           <?= $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('New Listing Type Category'), ["action" => "add"], ["class" => "btn btn-block btn-primary btn-sm btn-flat", "escape" => false]) ?>
                                                       </div>
                    </div>
                    <div class="panel-body">
                        
                        <div class="table-responsive">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th>#</th>
                        
                     <th><?= $this->Paginator->sort('listing_type_id') ?></th>
                    
                     <th><?= $this->Paginator->sort('title') ?></th>
                    
                     <th><?= $this->Paginator->sort('sort_order') ?></th>
                    
                     <th><?= $this->Paginator->sort('created') ?></th>
                    
                     
                                  <th class="action-col">Action</th>
                                </tr>                                           
                              </thead>
                              <tbody>
                                <?php if (!empty($listingTypeCategories->toArray())): 
                                    $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                    foreach ($listingTypeCategories as $listingTypeCategory): ?>
                                 <tr>
                                    <td><?= $this->Number->format($i) ?>.</td>
                                               <td><?= $listingTypeCategory->has('listing_type') ? $this->Html->link($listingTypeCategory->listing_type->title, ['controller' => 'ListingTypes', 'action' => 'view', $listingTypeCategory->listing_type->id]) : '' ?></td>
        <td><?= h($listingTypeCategory->title) ?></td>
            

        <td><?= $this->Number->format($listingTypeCategory->sort_order) ?></td>
            <td>
     <?php if ($listingTypeCategory->created) {
        echo $listingTypeCategory->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
        }
    ?>
    </td>
            

                            <td class="action-col">
                <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $listingTypeCategory->id],['class' => 'btn btn-block btn-warning btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View listing type category'),'title'=>__('View listing type category')]) ?> 

                <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'add', $listingTypeCategory->id], ['class' => 'btn btn-block btn-success btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit listing type category'),'title'=>__('Edit listing type category')]) ?> 

                <?= $this->Html->link("<i class=\"fa fa-trash\"></i>", 'javascript:void(0)', ['class' => 'deleteWithReload btn btn-block btn-danger btn-xs btn-flat', 'data-url'=> $this->Url->build(['action' => 'delete', $listingTypeCategory->id]), 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit listing type category'),'title'=>__('Delete listing type category')]) ?>
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
