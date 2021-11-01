<?php
$this->layout = "authdefault";
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $plans
 */
?>
<div class="White79">
    <div class="GreyBg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 TitleStripp">
                    <div class="col-sm-9">
                        <h2><i class="glyphicon glyphicon-list-alt"></i>My Plans</h2>
                    </div>
                    <div class="col-sm-3">
                        <?= $this->Html->link("Add A Plan", ['action' => 'add',$package_id], ['class' => 'btn mybtn btn-block']) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="col-md-12 nopadding mt20">
                <?= $this->Flash->render() ?>
                    <div class="col-md-12">
                        <table class="table table-bordered ssTable">
                            <thead>
                                <tr>
								<th>id</th>
								<th>Plan Name</th>
								<th>Duration</th>
								<th>Price</th>
								<th>Discount Price</th>
								<th>Status</th>
								<th>Created Date</th>
                    <!--<th><?//= $this->Paginator->sort('id') ?></th>
                    <th><?//= $this->Paginator->sort('plan_name') ?></th>
                    <th><?//= $this->Paginator->sort('duration') ?></th>
                    <th><?//= $this->Paginator->sort('price') ?></th>
                    <th><?//= $this->Paginator->sort('discount_price') ?></th>
                    <th><?//= $this->Paginator->sort('status') ?></th>
                    <th><?//= $this->Paginator->sort('created') ?></th>--->
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
                            </thead>
                            <tbody>
                             <?php if (!empty($plans->toArray())):
                                $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                              foreach ($plans as $plan): ?>
                                <tr>
                                    <td>
                                        <?= $plan->id ?>
                                    </td>
                                     <td>
                                        <?= $this->Html->link($plan->plan_name, ['action' => 'view', $plan->id], ['class' => 'namme']) ?>
                                    </td>                                    
                                    </td>
                                    
                                    <td>
                                        <p class="ssdate"><?= $plan->duration ?> Hours</p>
                                    </td>
                                    <td>
                                        <p class="sstopic"><?= $this->Number->currency($plan->price, 'INR') ?></p>
                                    </td>
                                    <td>
                                        <p class="sstopic"><?= $this->Number->currency($plan->discount_price, 'INR') ?></p>
                                    </td>
                                    <td><?= $plan->status == 1 ? "Active" : "In-Active" ?></td>  <td>
                                        <p class="ssdate"><?= $plan->created ?></p>
                                    </td>
                                    <td class="text-right">                                    
                                        <?= $this->Html->link('View', ['controller' => 'Plans', 'action' => 'view', $plan->id,$package_id], ['class' => 'btn btn-success']) ?>

                                        <?= $this->Html->link('Edit', ['controller' => 'Plans', 'action' => 'edit', $plan->id,$package_id], ['class' => 'btn btn-primary']) ?>                                        
                                        <?= $this->Html->link("Delete", ['action' => 'delete', $plan->id,$package_id], ['class' => 'confirmDeleteBtn btn btn-danger', 'data-url'=> $this->Url->build(['action' => 'delete', $plan->id,$package_id]), 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit plan'),'title'=>__('Delete plan')]) ?> 
                                    </td>
                                </tr>
                                <?php $i++; endforeach; ?>
                                <?php else: ?>
                                    <tr> <td colspan='20' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
</div>
<?php 
echo $this->Html->css(['/assets/plugins/dropify-master/dist/css/dropify.min.css','https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css
'],['block' => true]);
echo $this->Html->script(['/assets/plugins/dropify-master/dist/js/dropify.min.js', 'https://cdn.ckeditor.com/4.14.0/basic/ckeditor.js','https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js'],['block' => true]);
echo $this->Html->script(['common'], ['block' => true]); ?>