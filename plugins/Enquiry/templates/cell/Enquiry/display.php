  <div class="table-responsive enquiries">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th><?= $this->Paginator->sort('subject') ?></th>
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
                    $i = 1;
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

            <?= $this->Html->link("<i class=\"fas fa-comments\"></i>", ['controller' => 'Enquiries','action' => 'comment','plugin' => 'Enquiry', $enquiry->id],['class' => 'btn btn-block bg-blue btn-xs btn-flat toDoAssign', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Comment'),'title'=>__('Comment')]) ?>

            <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['controller' => 'Enquiries','action' => 'view','plugin' => 'Enquiry', $enquiry->id],['class' => 'btn btn-block btn-warning btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View enquiry'),'title'=>__('View enquiry')]) ?>
                </td>
            </tr>
                <?php $i++; endforeach; ?>
            <?php else: ?>
            <tr> <td colspan='16' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> </tr>
            <?php endif; ?>
                </tbody>
            </table>
        </div>