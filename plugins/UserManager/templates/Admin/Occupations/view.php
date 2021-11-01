<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $occupation
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Occupation') ?>  
        </h1>
        <small><?php echo __('Here you can view occupation Detail'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row occupations view content">
<div class="col-12 col-sm-12 col-md-12">
    <div class="panel-default">
        <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                <h2><?= h($occupation->title) ?></h2>
                <div class="d-flex flex-wrap">
                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i> " . __('Edit Occupation'), ['action' => 'add', $occupation->id], ['class' => 'btn btn-block btn-success btn-sm btn-flat mrg-r20', 'escape' => false]) ?>
                    <?php echo $this->Html->link("<i class='fa fa-fw fa-chevron-circle-left'></i> ".__('Back'), ['action' => 'index'], ['class' => 'btn btn-default btn-sm btn-flat mrg-r10', 'title' => __('Back'),'escape'=>false]); ?>
                </div>
            </div>
            <div class="panel-body">
<table class="table table-hover table-bordered">
                <tr>
                    <th width="20%"><?= __('Title') ?></th>
                    <td><?= h($occupation->title) ?></td>
                </tr>
               
                <tr>
                    <th><?= __('Created') ?></th>
                    <td>
                        <?php if ($occupation->created) {
                                echo $occupation->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td>
                        <?php if ($occupation->modified) {
                                echo $occupation->modified->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                        </td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $occupation->status ? __('Active') : __('In-Active'); ?></td>
                </tr>
            </table>

        </div>
    </div>
</div>



<?php if (!empty($occupation->user_profiles)) : ?>
                <div class="col-12 col-sm-12 col-md-12">
                <div class="panel-default">
                    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                        <h2><?= __('Related User Profiles') ?></h2>
                </div>
                <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Alt Mobile') ?></th>
                            <th><?= __('Dob') ?></th>
                            <th><?= __('Location Id') ?></th>
                            <th><?= __('Address Line 1') ?></th>
                            <th><?= __('Address Line 2') ?></th>
                            <th><?= __('Postcode') ?></th>
                            <th><?= __('Latitude') ?></th>
                            <th><?= __('Longitude') ?></th>
                            <th><?= __('Gender') ?></th>
                            <th><?= __('Qualification') ?></th>
                            <th><?= __('College University') ?></th>
                            <th><?= __('Occupation Id') ?></th>
                            <th><?= __('Experience') ?></th>
                            <th><?= __('Primary Subject Id') ?></th>
                            <th><?= __('Secondary Subject Id') ?></th>
                            <th><?= __('Hours Inweekdays') ?></th>
                            <th><?= __('Hours Inweekend') ?></th>
                            <th><?= __('Is Digital Pen Tablet') ?></th>
                            <th><?= __('Is Internet Speed Mbps') ?></th>
                            <th><?= __('Source Of Rudraa') ?></th>
                            <th><?= __('Resume') ?></th>
                            <th><?= __('Resume Dir') ?></th>
                            <th><?= __('Resume Size') ?></th>
                            <th><?= __('Resume Type') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($occupation->user_profiles as $userProfiles) : ?>
                        <tr>
                            <td><?= h($userProfiles->id) ?></td>
                            <td><?= h($userProfiles->user_id) ?></td>
                            <td><?= h($userProfiles->alt_mobile) ?></td>
                            <td><?= h($userProfiles->dob) ?></td>
                            <td><?= h($userProfiles->location_id) ?></td>
                            <td><?= h($userProfiles->address_line_1) ?></td>
                            <td><?= h($userProfiles->address_line_2) ?></td>
                            <td><?= h($userProfiles->postcode) ?></td>
                            <td><?= h($userProfiles->latitude) ?></td>
                            <td><?= h($userProfiles->longitude) ?></td>
                            <td><?= h($userProfiles->gender) ?></td>
                            <td><?= h($userProfiles->qualification) ?></td>
                            <td><?= h($userProfiles->college_university) ?></td>
                            <td><?= h($userProfiles->occupation_id) ?></td>
                            <td><?= h($userProfiles->experience) ?></td>
                            <td><?= h($userProfiles->primary_subject_id) ?></td>
                            <td><?= h($userProfiles->secondary_subject_id) ?></td>
                            <td><?= h($userProfiles->hours_inweekdays) ?></td>
                            <td><?= h($userProfiles->hours_inweekend) ?></td>
                            <td><?= h($userProfiles->is_digital_pen_tablet) ?></td>
                            <td><?= h($userProfiles->is_internet_speed_mbps) ?></td>
                            <td><?= h($userProfiles->source_of_rudraa) ?></td>
                            <td><?= h($userProfiles->resume) ?></td>
                            <td><?= h($userProfiles->resume_dir) ?></td>
                            <td><?= h($userProfiles->resume_size) ?></td>
                            <td><?= h($userProfiles->resume_type) ?></td>
                            <td><?= h($userProfiles->created) ?></td>
                            <td><?= h($userProfiles->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'UserProfiles', 'action' => 'view', $userProfiles->id], ['class' => 'btn btn-block btn-warning btn-xs btn-flat']) ?> 

                                <?= $this->Html->link(__('Edit'), ['controller' => 'UserProfiles', 'action' => 'edit', $userProfiles->id], ['class' => 'btn btn-block btn-success btn-xs btn-flat']) ?> 

                                <?= $this->Html->link(__('Delete'), 'javascript:void(0)', ['data-message' => __('Are you sure you want to delete # {0}?', $userProfiles->id), 'data-url'=> $this->Url->build(['controller' => 'UserProfiles', 'action' => 'delete', $userProfiles->id]), 'class' => 'deleteWithReload btn btn-block btn-danger btn-xs btn-flat']) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
