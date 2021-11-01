<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $enquiries
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Enquiry/Lead') ?>
        </h1>
        <small><?php echo __('Here you can manage the enquiries/leads'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row enquiries index content">

<div class="col-12 col-sm-12 col-md-12">
<div class="panel-default">
    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
        <h2><?= __('Enquiry') ?> List</h2>
        <div class="d-flex flex-wrap">
            <button class="btn btn-block bg-blue btn-sm btn-flat mr-2" id="AddPriorities" data-title="Priority" data-url="<?php echo $this->Url->build(['controller' => 'PriorityTypes', 'action' => 'add']); ?>"><i class="fa fa-plus"></i> Add Priorities</button>
            <button id="AddStatus" data-title="Enquiry Status" data-url="<?php echo $this->Url->build(['controller' => 'EnquiryStatuses', 'action' => 'add']); ?>" class="btn btn-block bg-purple btn-sm btn-flat mr-2"><i class="fa fa-plus"></i> Add Status</button>
            <?= $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('New Enquiry'), ["controller" => "Enquiries", "action" => "add"], ["class" => "btn btn-block btn-primary btn-sm btn-flat", "escape" => false]) ?>
        </div>
    </div>

    <div class="panel-body">


        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                            <div class="left-component d-flex flex-wrap">
                                

                            </div>
                            <div class="right-component d-flex flex-wrap">
                                <?php 
                                if(!$enquiryStatuses->isEmpty()){
                                    foreach ($enquiryStatuses as $key => $enquiryStatus) { ?>
                                        <button type="button" class="btn btn-block white-color btn-flat" style="background-color: <?php echo $enquiryStatus->color ?>">
                                            <?php echo $enquiryStatus->title ?>
                                        </button> &nbsp; 
                                  <?php  }
                                  }
                                ?>
                            </div>
                        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th><?= $this->Paginator->sort('subject') ?></th>
                    <!-- <th><?= $this->Paginator->sort('admin_user_id', 'Created By') ?></th> -->
                    <th><?= $this->Paginator->sort('enquiry_type','Type') ?></th>
                    <th><?= $this->Paginator->sort('full_name') ?></th>
                    <th><?= $this->Paginator->sort('mobile') ?></th>
                    <th><?= $this->Paginator->sort('email') ?></th>
                    <th><?= $this->Paginator->sort('address') ?></th>
                    <th><?= $this->Paginator->sort('priority_type_id', 'Priority') ?></th>
                    <th><?= $this->Paginator->sort('enquiry_status_id', 'Status') ?></th>
                    <th><?= $this->Paginator->sort('assigned_user_id', 'Assign To') ?></th>
                    <th><?= $this->Paginator->sort('end_date') ?></th> 
                    <th><?= $this->Paginator->sort('created') ?></th>

            <th class="action-col">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php if (!empty($enquiries->toArray())):
                    $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                    foreach ($enquiries as $enquiry):
                        $color = null;
                        if(!empty($enquiry->latest_comment) && !empty($enquiry->latest_comment->enquiry_status)){
                            $color = $enquiry->latest_comment->enquiry_status->color;
                        }else if(!empty($enquiry->enquiry_status)){
                            $color = $enquiry->enquiry_status->color;
                        }
                    ?>
                <tr <?php echo $color ? 'style="background:'.$color.'; color: #FFF;"' : ''; ?>>
                    <td><?= $this->Number->format($i) ?>.</td>
                    <td><?= h($enquiry->subject) ?></td>
                    <!-- <td>
                        <?= $enquiry->has('admin_user') ? $this->Html->link($enquiry->admin_user->name, ['controller' => 'AdminUsers', 'action' => 'view','plugin' => 'AdminUserManager', $enquiry->admin_user->id]) : '-' ?>
                    </td> -->
                    <td><?= h($enquiry->enquiry_type) ?></td>
                    <td><?= h($enquiry->full_name) ?></td>
                    <td><?= h($enquiry->mobile) ?></td>
                    <td><?= h($enquiry->email) ?></td>
                    <td><?= h($enquiry->address) ?></td>
                    <td>
                        <?= $enquiry->has('priority_type') ? $this->Html->link($enquiry->priority_type->title, ['controller' => 'PriorityTypes', 'action' => 'view', $enquiry->priority_type->id]) : '' ?>
                    </td>
                         <td>
                        <?php if(!empty($enquiry->latest_comment) && !empty($enquiry->latest_comment->enquiry_status)){ 
                            echo $enquiry->latest_comment->enquiry_status->title;
                         }else{
                        echo $enquiry->has('enquiry_status') ? $this->Html->link($enquiry->enquiry_status->title, ['controller' => 'EnquiryStatuses', 'action' => 'view', $enquiry->enquiry_status->id]) : '';
                    } ?>
                    </td>
                <td>
                    <?= $enquiry->has('assigned_user') ? $this->Html->link($enquiry->assigned_user->name, ['controller' => 'AdminUsers', 'action' => 'view','plugin' => 'AdminUserManager', $enquiry->assigned_user->id]) : '-' ?>
                </td>
                <!-- <td><?= h($enquiry->referred_by) ?></td> -->
                <td>
                <?php if ($enquiry->end_date) {
                        echo $enquiry->end_date->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_FORMAT'));
                    }
                ?>
                </td>
                <td>
                <?php if ($enquiry->created) {
                        echo $enquiry->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                    }
                ?>
            </td>

            <td class="action-col">

            <?= $this->Html->link("<i class=\"fas fa-comments\"></i>", ['action' => 'comment', $enquiry->id],['class' => 'btn btn-block bg-blue btn-xs btn-flat toDoAssign', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Comment'),'title'=>__('Comment')]) ?>

            <?= $this->Html->link("<i class=\"fa fa-reply\"></i>", ['action' => 'todo', $enquiry->id],['class' => 'btn btn-block bg-purple btn-xs btn-flat toDoAssign', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Add To - DO'),'title'=>__('Add To - DO')]) ?>

            <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $enquiry->id],['class' => 'btn btn-block btn-warning btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View enquiry'),'title'=>__('View enquiry')]) ?>

            <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'add', $enquiry->id], ['class' => 'btn btn-block btn-success btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit enquiry'),'title'=>__('Edit enquiry')]) ?>

            <?= $this->Html->link("<i class=\"fa fa-trash\"></i>", 'javascript:void(0)', ['class' => 'deleteWithReload btn btn-block btn-danger btn-xs btn-flat', 'data-url'=> $this->Url->build(['action' => 'delete', $enquiry->id]), 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit enquiry'),'title'=>__('Delete enquiry')]) ?>
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
<?php
echo $this->Html->script('Inquiry',['block' => true]);
echo $this->Html->css(['/assets/plugins/x-editable-develop/dist/bootstrap4-editable/css/bootstrap-editable.css', '/assets/plugins/Color-Picker/jquery.minicolors']);
echo $this->Html->script(['/assets/plugins/x-editable-develop/dist/bootstrap4-editable/js/bootstrap-editable.min', '/assets/plugins/jquery-ui/jquery-ui.min.js', '/assets/plugins/Color-Picker/jquery.minicolors.min.js'],['block' => true]);
?>
<style>
.popover{
    z-index:99999999 !important;
}
</style>
<script>
<?php $this->Html->scriptStart(['block' => 'inlineScript']); ?>
$obj = new Inquiry();
$(document).on("click", "#AddPriorities", function() {
       $obj.addMasters({'title': $(this).data('title'),'url': $(this).data('url')});
});
$(document).on("click", "#AddStatus", function() {
       $obj.addMasters({'title': $(this).data('title'),'url': $(this).data('url')});
});
$(document).on("click", ".toDoAssign", function(event) {
        event.preventDefault();
       $obj.addTodo({'title': 'Add To-Do List','url': $(this).attr('href')});
});
// $(document).on("click", ".editPrioritType", function() {
//        $obj.addMasters({'title': $(this).data('title'),'url': $(this).data('url')});
// });
<?php $this->Html->scriptEnd(); ?>
</script>
