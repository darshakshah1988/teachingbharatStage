<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $enquiryStatus
 */
$this->layout = "ajax";
?>
<div class="row enquiryStatuses index content">
<div class="col-12 col-sm-12 col-md-12">
<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th>Subject</th>
            <td><?php echo $enquiry->subject ?></td>
            <th>ID</th>
            <td>#<?php echo $enquiry->id ?></td>
        </tr>
        <tr>
            <th>Assigned To</th>
            <td><?php echo $enquiry->has('assigned_user') ? $enquiry->assigned_user->name : "" ?></td>
            <th>Assigned By</th>
            <td><?php echo $enquiry->has('admin_user') ? $enquiry->admin_user->name : "" ?></td>
        </tr>
        <tr>
            <th>Created On</th>
            <td><?php echo $enquiry->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT')); ?></td>
            <th>Last Updated</th>
            <td>
                <?php
                if(!empty($enquiry->enquiry_comments)){
                   $commentDat =  $enquiry->enquiry_comments[0] ?? null;
                   echo $commentDat ? $commentDat->modified->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT')) : "-";
                }else{
                    echo $enquiry->modified->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                }
                 ?>
            </td>
        </tr>
        <tr>
            <th>Status</th>
            <td><?= $enquiry->has('enquiry_status') ? $enquiry->enquiry_status->title : '' ?></td>
            <th>Priority Type</th>
            <td><?= $enquiry->has('priority_type') ? $enquiry->priority_type->title : '' ?></td>
        </tr>
        <tr>
            <th>Remark</th>
            <td colspan="3"><?php echo $enquiry->remark ?></td>
        </tr>
    </table>
</div>
</div>
<div class="col-12 col-sm-12 col-md-12 form-group">
        <?= $this->Form->create($enquiryComment, ['role' => 'form', 'enctype' => 'multipart/form-data', 'templates' => 'horizontal_form']) ?>
            <?php
                echo $this->Form->control('comment', ['class' => 'form-control ckeditor', 'placeholder' => 'Comment']);
                
                echo $this->Form->control('enquiry_status_id', ['class' => 'form-control', 'empty' => 'Select', 'label'=> 'Status']);
            ?>
        <?= $this->Form->end() ?>
    </div>

    <?php
    if(!empty($enquiry->enquiry_comments)){ ?>
    <div class="col-12 col-sm-12 col-md-12 form-group">
    <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>#</th>
                    <th width="60%">Comment</th>
                    <th width="30%">Posted By</th>
                </tr>
                <?php foreach($enquiry->enquiry_comments as $k => $comment){ ?>
                <tr class="row-<?php echo $comment->id ?>">
                    <td><?php echo ($k + 1) ?></td>
                    <td><?php echo $comment->comment; ?></td>
                    <td>
                        <?php echo $enquiry->assigned_user->name; ?>
                        <span style="display: block;"><strong>Status:</strong> <?php echo $comment->enquiry_status->title; ?></span>
                        <span style="display: block;"><strong>Posted On:</strong> <?php echo $comment->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT')); ?></span>
                    </td>
                </tr>
                <?php } ?>
            </table>
    </div>
    </div>
    <?php } ?>
</div>
