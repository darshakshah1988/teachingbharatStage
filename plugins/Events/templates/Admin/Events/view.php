<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $event
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Event') ?>  
        </h1>
        <small><?php echo __('Here you can view event Detail'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row events view content">
<div class="col-12 col-sm-12 col-md-12">
    <div class="panel-default">
        <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= h($event->title) ?></h2>
                <div class="d-flex flex-wrap">
                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i> " . __('Edit Event'), ['action' => 'add', $event->id], ['class' => 'btn btn-block btn-success btn-sm btn-flat mrg-r20', 'escape' => false]) ?>
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>
            <div class="panel-body">
                <table class="table table-hover table-bordered">
                <tr>
                    <th width="20%"><?= __('Admin User') ?></th>
                    <td>
                        <?= $event->has('admin_user') ? $this->Html->link($event->admin_user->name, ['controller' => 'AdminUsers', 'action' => 'view', $event->admin_user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Listing') ?></th>
                    <td><?= $event->has('listing') ? $this->Html->link($event->listing->title, ['controller' => 'Listings', 'action' => 'view', $event->listing->id]) : '' ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Title') ?></th>
                    <td><?= h($event->title) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Sub Title') ?></th>
                    <td><?= h($event->sub_title) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Short Description') ?></th>
                    <td><?= h($event->short_description) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Location') ?></th>
                    <td><?= h($event->location) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Organizar Name') ?></th>
                    <td><?= h($event->organizar_name) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Organizer Email') ?></th>
                    <td><?= h($event->organizer_email) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Organizer Contact Number') ?></th>
                    <td><?= h($event->organizer_contact_number) ?></td>
                </tr>
                
                <tr>
                    <th width="20%"><?= __('Meta Title') ?></th>
                    <td><?= h($event->meta_title) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Meta Keyword') ?></th>
                    <td><?= h($event->meta_keyword) ?></td>
                </tr>
                <tr>
                    <th width="20%"><?= __('Meta Description') ?></th>
                    <td><?= h($event->meta_description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Start Date') ?></th>
                    <td>
                        <?php if ($event->start_date) {
                                echo $event->start_date->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('End Date') ?></th>
                    <td>
                        <?php if ($event->end_date) {
                                echo $event->end_date->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td>
                        <?php if ($event->created) {
                                echo $event->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td>
                        <?php if ($event->modified) {
                                echo $event->modified->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $event->status ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph($event->description); ?>
                </blockquote>
            </div>

        </div>
    </div>
</div>


