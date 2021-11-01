<?php
$this->layout = "authdefault";
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $packages
 */
?>
<div class="White79">
    <div class="GreyBg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 TitleStripp">
                    <div class="col-sm-9">
                        <h2><i class="glyphicon glyphicon-list-alt"></i>My Packages</h2>
                    </div>
                    <div class="col-sm-3">
                        <?= $this->Html->link("Add A Package", ['action' => 'add'], ['class' => 'btn mybtn btn-block']) ?>
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
								<th>Package Name</th>
								<!-- <th>Package Title</th> -->
								<th>Status</th>
								<th>Created Date</th>
                                    <!---<th ><?//= $this->Paginator->sort('id') ?></th>
                                    <th><?//= $this->Paginator->sort('Package_name') ?></th>
                                    <th><?//= $this->Paginator->sort('package_title') ?></th>
                                    <th><?//= $this->Paginator->sort('status') ?></th>
                                    <th><?//= $this->Paginator->sort('created') ?></th>--->
                                    <th class="actions"><?= __('Actions') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                             <?php if (!empty($packages->toArray())):
                                $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                              foreach ($packages as $package): ?>
                                <tr>
                                    <td>
                                        <?= $package->id ?>
                                    </td>
                                     <td>
									 <?php if($package->status==1): ?>
                                        <?= $this->Html->link($package->package_name, ['plugin' => 'MicroSessions', 'controller' => 'MicroSessions','action' => 'packagedetails', $package->id], ['class' => 'namme']) ?>
										<?php else: ?>
											<p style="color: #ed4426;"><?= $package->package_name ?></p>
											<?php endif;?>
                                    </td>
                                    </td>

                                   <!--  <td>
                                        <p class="ssdate"><?php //= $package->package_title ?></p>
                                    </td> -->
                                    <td><?= $package->status == 1 ? "Active" : "In-Active" ?></td>  <td>
                                        <p class="ssdate"><?= $package->created ?></p>
                                    </td>
                                    <td class="text-right">
                                    <?= $this->Html->link('<i class="fa fa-plus"></i> Plans', ['controller' => 'Plans', 'action' => 'index', $package->id], ['class' => 'btn btn-success', 'escape' => false]) ?>
                                  <?php if($package->status==1): ?>
                                        <?= $this->Html->link('View', ['controller' => 'Packages', 'action' => 'view', $package->id], ['class' => 'btn btn-success']) ?>
										<?php else: ?>
										<p class="ssdate">View</p>
<?php endif;?>
                                        <?= $this->Html->link('Edit', ['controller' => 'Packages', 'action' => 'edit', $package->id], ['class' => 'btn btn-primary']) ?>

                                        <?= $this->Html->link("Delete", ['action' => 'delete', $package->id], ['class' => 'confirmDeleteBtn btn btn-danger', 'data-url'=> $this->Url->build(['action' => 'delete', $package->id]), 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit Package'),'title'=>__('Delete Package')]) ?>
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
