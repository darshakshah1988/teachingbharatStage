<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $plan
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Plan') ?>  
        </h1>
        <small><?php echo __('Here you can view plan Detail'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row plans view content">
<div class="col-12 col-sm-12 col-md-12">
    <div class="panel-default">
        <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= h($plan->id) ?></h2>
                <div class="d-flex flex-wrap">
                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i> " . __('Edit Plan'), ['action' => 'add', $plan->id], ['class' => 'btn btn-block btn-success btn-sm btn-flat mrg-r20', 'escape' => false]) ?>
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>
            <div class="panel-body">
<table class="table table-hover table-bordered">
                <tr>
                    <th width="20%"><?= __('Slug') ?></th>
                    <td><?= h($plan->slug) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('User Id') ?></th>
                    <td><?= h($plan->user_id) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Plan Name') ?></th>
                    <td><?= h($plan->plan_name) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Duration') ?></th>
                    <td><?= h($plan->duration) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Features') ?></th>
                    <td><?= h($plan->features) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Other Details') ?></th>
                    <td><?= h($plan->other_details) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($plan->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Plan Id') ?></th>
                    <td><?= $this->Number->format($plan->plan_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Listing Id') ?></th>
                    <td><?= $this->Number->format($plan->listing_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Price') ?></th>
                    <td><?= $this->Number->format($plan->price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Discount Price') ?></th>
                    <td><?= $this->Number->format($plan->discount_price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Start Date') ?></th>
                    <td>
                        <?php if ($plan->start_date) {
                                echo $plan->start_date->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('End Date') ?></th>
                    <td>
                        <?php if ($plan->end_date) {
                                echo $plan->end_date->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td>
                        <?php if ($plan->created) {
                                echo $plan->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td>
                        <?php if ($plan->modified) {
                                echo $plan->modified->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $plan->status ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>

        </div>
    </div>
</div>



