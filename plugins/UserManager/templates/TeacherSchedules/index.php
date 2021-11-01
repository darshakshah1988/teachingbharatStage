<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $teacherSchedules
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Teacher Schedule') ?>
        </h1>
        <small><?php echo __('Here you can manage the teacher schedules'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row teacherSchedules index content">

<div class="col-12 col-sm-12 col-md-12">
                <div class="panel-default">
                    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                        <h2><?= __('Teacher Schedule') ?> List</h2>
                        <div class="d-flex flex-wrap"><?= $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('New Teacher Schedule'), ["action" => "add"], ["class" => "btn btn-block btn-primary btn-sm btn-flat", "escape" => false]) ?></div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= $this->Paginator->sort('title') ?></th>
                                    <th><?= $this->Paginator->sort('status') ?></th>
                                    <th><?= $this->Paginator->sort('created') ?></th>
                        <th class="action-col">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php if (!empty($teacherSchedules->toArray())):
                                    $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                    foreach ($teacherSchedules as $teacherSchedule): ?>
                                 <tr>
                                    <td><?= $this->Number->format($i) ?>.</td>
                            <td><?= h($teacherSchedule->title) ?></td>


                                    <td>
                                    <?php if ($teacherSchedule->status == 1) {
                                            echo "Yes";
                                        }else{
                                            echo "No";
                                        }
                                    ?>
                                </td>

                                <td>
                             <?php if ($teacherSchedule->created) {
                                echo $teacherSchedule->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                            </td>


                        <td class="action-col">
                <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $teacherSchedule->id],['class' => 'btn btn-block btn-warning btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View teacher schedule'),'title'=>__('View teacher schedule')]) ?>

                <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'add', $teacherSchedule->id], ['class' => 'btn btn-block btn-success btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit teacher schedule'),'title'=>__('Edit teacher schedule')]) ?>


                <?= $this->Html->link("<i class=\"fa fa-trash\"></i>", ['action' => 'delete', $teacherSchedule->id], ['class' => 'confirmDeleteBtn btn btn-block btn-danger btn-xs btn-flat', 'data-url'=> $this->Url->build(['action' => 'delete', $teacherSchedule->id]), 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Delete teacher schedule'),'title'=>__('Delete teacher schedule')]) ?> 
                

                    </td>
                </tr>
                                <?php $i++; endforeach; ?>
                            <?php else: ?>
                            <tr> <td colspan='5' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> </tr>
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
