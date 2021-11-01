<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $adminUsers
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Staff Users') ?>  
        </h1>
        <small><?php echo __('Here you can manage the staff users'); ?></small>
</div>
<?php $this->end(); ?>   
<div class="row adminUsers index content">

<div class="col-12 col-sm-12 col-md-12">
                <div class="panel-default">
                    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                        <h2>Staff Users</h2>
                        <div class="d-flex flex-wrap">
                           <?= $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('New Staff User'), ["action" => "add"], ["class" => "btn btn-block btn-primary btn-sm btn-flat", "escape" => false]) ?>
                       </div>
                    </div>
                    <div class="panel-body">
                        
                        <div class="table-responsive">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th>#</th>
                        
                    <th>Image</th>
                     <th><?= $this->Paginator->sort('first_name', 'Name') ?></th>
                    
                     <th><?= $this->Paginator->sort('mobile') ?></th>
                    
                     <th><?= $this->Paginator->sort('dob') ?></th>
                    
                     <th><?= $this->Paginator->sort('email') ?></th>
                    
                     <th><?= $this->Paginator->sort('status') ?></th>
                    
                     <th><?= $this->Paginator->sort('is_verified') ?></th>
                    
                     <th><?= $this->Paginator->sort('created') ?></th>
                    
                     
                                  <th class="action-col">Action</th>
                                </tr>                                           
                              </thead>
                              <tbody>
                                <?php if (!empty($adminUsers->toArray())): 
                                    $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                    foreach ($adminUsers as $adminUser): ?>
                                 <tr>
                                    <td><?= $this->Number->format($i) ?>.</td>
                                    <td><?php 
                                    
                                            if ((!empty($adminUser->image_path) && !empty($adminUser->profile_photo)) && file_exists("img/".$adminUser->image_path . $adminUser->profile_photo)) { 
                                                 $userPhoto = $adminUser->image_path . $adminUser->profile_photo;
                                            }else{
                                                $userPhoto = "site_user.png";
                                            }
                                            echo $this->Html->image($userPhoto, ['class' => 'img-thumbnail', 'alt' => 'Image', 'width' => 100, 'height' => 100]);
                                            ?>
                                        </td>

        <td><?= h($adminUser->name) ?></td>
            
        <td><?= h($adminUser->mobile) ?></td>
            
        <td><?= h($adminUser->dob) ?></td>
        <td><?= h($adminUser->email) ?></td>
                <td>
            <?php if ($adminUser->status == 1) {
                    echo "Yes";
                }else{
                    echo "No";
                }
            ?>
        </td>
                <td>
            <?php if ($adminUser->is_verified == 1) {
                    echo "Yes";
                }else{
                    echo "No";
                }
            ?>
        </td>

            <td>
     <?php if ($adminUser->created) {
        echo $adminUser->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
        }
    ?>
    </td>
            

                            <td class="action-col">
                <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $adminUser->id],['class' => 'btn btn-block btn-warning btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View admin user'),'title'=>__('View admin user')]) ?> 

                <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'add', $adminUser->id], ['class' => 'btn btn-block btn-success btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit admin user'),'title'=>__('Edit admin user')]) ?> 


                <?= $this->Html->link("<i class=\"fa fa-trash\"></i>", ['action' => 'delete', $adminUser->id], ['class' => 'confirmDeleteBtn btn btn-block btn-danger btn-xs btn-flat', 'data-url'=> $this->Url->build(['action' => 'delete', $adminUser->id]), 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Delete admin user'),'title'=>__('Delete admin user')]) ?> 

                    </td> 
                </tr>
                                <?php $i++; endforeach; ?>
                            <?php else: ?>
                            <tr> <td colspan='19' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> </tr>
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
