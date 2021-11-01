<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $enquiry
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Enquiry') ?>  
        </h1>
        <small><?php echo __('Here you can view enquiry Detail'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row enquiries view content">
<div class="col-12 col-sm-12 col-md-12">
    <div class="panel-default">
        <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= h($enquiry->id) ?></h2>
                <div class="d-flex flex-wrap">
                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i> " . __('Edit Enquiry'), ['action' => 'add', $enquiry->id], ['class' => 'btn btn-block btn-success btn-sm btn-flat mrg-r20', 'escape' => false]) ?>
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>
            <div class="panel-body">
<table class="table table-hover table-bordered">
                <tr>
                    <th width="20%"><?= __('Listing') ?></th>
                    <td><?= $enquiry->has('listing') ? $this->Html->link($enquiry->listing->title, ['controller' => 'Listings', 'action' => 'view', $enquiry->listing->id]) : '' ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Admin User') ?></th>
                    <td><?= $enquiry->has('admin_user') ? $this->Html->link($enquiry->admin_user->title, ['controller' => 'AdminUsers', 'action' => 'view', $enquiry->admin_user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Enquiry Type') ?></th>
                    <td><?= h($enquiry->enquiry_type) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Referred By') ?></th>
                    <td><?= h($enquiry->referred_by) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Subject') ?></th>
                    <td><?= h($enquiry->subject) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Full Name') ?></th>
                    <td><?= h($enquiry->full_name) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Mobile') ?></th>
                    <td><?= h($enquiry->mobile) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Email') ?></th>
                    <td><?= h($enquiry->email) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Address') ?></th>
                    <td><?= h($enquiry->address) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Priority Type') ?></th>
                    <td><?= $enquiry->has('priority_type') ? $this->Html->link($enquiry->priority_type->title, ['controller' => 'PriorityTypes', 'action' => 'view', $enquiry->priority_type->id]) : '' ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Enquiry Status') ?></th>
                    <td><?= $enquiry->has('enquiry_status') ? $this->Html->link($enquiry->enquiry_status->title, ['controller' => 'EnquiryStatuses', 'action' => 'view', $enquiry->enquiry_status->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($enquiry->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Assigned User Id') ?></th>
                    <td><?= $this->Number->format($enquiry->assigned_user_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('End Date') ?></th>
                    <td>
                        <?php if ($enquiry->end_date) {
                                echo $enquiry->end_date->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td>
                        <?php if ($enquiry->created) {
                                echo $enquiry->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td>
                        <?php if ($enquiry->modified) {
                                echo $enquiry->modified->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($enquiry->description)); ?>
                </blockquote>
            </div>

        </div>
    </div>
</div>



<?php if (!empty($enquiry->enquiry_comments)) : ?>
                <div class="col-12 col-sm-12 col-md-12">
                <div class="panel-default">
                    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                        <h2><?= __('Related Enquiry Comments') ?></h2>
                </div>
                <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Enquiry Id') ?></th>
                            <th><?= __('Comment') ?></th>
                            <th><?= __('Enquiry Status Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($enquiry->enquiry_comments as $enquiryComments) : ?>
                        <tr>
                            <td><?= h($enquiryComments->id) ?></td>
                            <td><?= h($enquiryComments->enquiry_id) ?></td>
                            <td><?= h($enquiryComments->comment) ?></td>
                            <td><?= h($enquiryComments->enquiry_status_id) ?></td>
                            <td><?= h($enquiryComments->created) ?></td>
                            <td><?= h($enquiryComments->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'EnquiryComments', 'action' => 'view', $enquiryComments->id], ['class' => 'btn btn-block btn-warning btn-xs btn-flat']) ?> 

                                <?= $this->Html->link(__('Edit'), ['controller' => 'EnquiryComments', 'action' => 'edit', $enquiryComments->id], ['class' => 'btn btn-block btn-success btn-xs btn-flat']) ?> 

                                <?= $this->Html->link(__('Delete'), 'javascript:void(0)', ['data-message' => __('Are you sure you want to delete # {0}?', $enquiryComments->id), 'data-url'=> $this->Url->build(['controller' => 'EnquiryComments', 'action' => 'delete', $enquiryComments->id]), 'class' => 'deleteWithReload btn btn-block btn-danger btn-xs btn-flat']) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
