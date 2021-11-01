<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $users
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb', ['custom' => [['title' => $this->request->getParam('action') == "students" ? "Students" : "Teachers"]]]) ?>
        </nav>
        <h1>
            <?= __('Manage {0}', $this->request->getParam('action') == "students" ? "Students" : "Teachers") ?>
        </h1>
        <small><?php echo __('Here you can manage the {0}', $this->request->getParam('action') == "students" ? "students" : "teachers"); ?></small>
</div>
<?php $this->end(); ?>
<div class="row users index content">

<div class="col-12 col-sm-12 col-md-12">
    <div class="panel-default">
        <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
            <h2><?= isset($type) && $type == "student" ? __('Student') : __('Teacher') ?> List</h2>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                        <th>#</th>
                        <th><?= $this->Paginator->sort('first_name', 'Name') ?></th>
                        <th><?= $this->Paginator->sort('email') ?></th>
                        <th><?= $this->Paginator->sort('mobile') ?></th>
                        <th><?= $this->Paginator->sort('active', 'Status') ?></th>
                        <th><?= $this->Paginator->sort('created') ?></th>
                        <th class="action-col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (!empty($users->toArray())):
                        $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                        foreach ($users as $user): ?>
                     <tr>
                        <td><?= $this->Number->format($i) ?>.</td>
                        <td>
                            <?= h($user->name) ?>
                            <?php
                                if(!empty($user->user_profile->sms_otp)){
                                    echo "<br><small>(".$user->user_profile->sms_otp.")</small>";
                                }
                             ?>
                            </td>
                        <td><?= h($user->email) ?></td>
                        <td><?= $user->user_profile->mobile ?? "N/A" ?></td>
                        <td>
                            <?php if ($user->active == 1) {
                                echo "<span class=\"btn-success label-xs white-color rounded\">Active</span>";
                                }else{
                                echo "<span class=\"bg-danger label-xs white-color rounded\">In-Active</span>";
                                }
                            ?>
                        </td>

                    <td>
                     <?php if ($user->created) {
                        echo $user->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                        }
                    ?>
                    </td>

                    <td class="action-col">
                    <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $user->id],['class' => 'btn btn-block btn-warning btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View user'),'title'=>__('View user')]) ?>

                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'add', $user->id], ['class' => 'btn btn-block btn-success btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit user'),'title'=>__('Edit user')]) ?>

                    <?= $this->Html->link("<i class=\"fa fa-trash\"></i>", ['action' => 'delete', $user->id], ['class' => 'confirmDeleteBtn btn btn-block btn-danger btn-xs btn-flat', 'data-url'=> $this->Url->build(['action' => 'delete', $user->id]), 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Delete user'),'title'=>__('Delete user')]) ?>

                    <?php
					if($user->role == "teacher"){
                        echo $this->Html->link("<i class=\"fa fa-reply\"></i>", 'javascript:void(0)', ['class' => 'approveUnApprove btn btn-block bg-light-blue btn-xs btn-flat', 'data-url'=> $this->Url->build(['action' => 'userStatus', $user->id]), 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Approve User'),'title'=>__('Approve User')]);
                    } ?>

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
<?php
echo $this->Html->script('Users',['block' => true]);
?>
<script>
<?php $this->Html->scriptStart(['block' => 'inlineScript']); ?>
$obj = new Users();
$(document).on("click", ".approveUnApprove", function() {
       $obj.teacherApprove({'title': 'Reviewed','url': $(this).data('url')});
});
<?php $this->Html->scriptEnd(); ?>
</script>