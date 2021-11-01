<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $courses
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Course') ?>
        </h1>
        <small><?php echo __('Here you can manage the courses'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row courses index content">

<div class="col-12 col-sm-12 col-md-12">
                <div class="panel-default">
                    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                        <h2><?= __('Course') ?> List</h2>
                        <!-- <div class="d-flex flex-wrap"><?= $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('New Course'), ["action" => "add"], ["class" => "btn btn-block btn-primary btn-sm btn-flat", "escape" => false]) ?></div> -->
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= $this->Paginator->sort('title', 'Course') ?></th>
                                    <th>Grade / Subject</th>
                                    <th><?= $this->Paginator->sort('duration', 'Duration') ?></th>
                                    <th><?= $this->Paginator->sort('price') ?></th>
                                    <th>Total Chapter</th>
                                    <th>Status</th>
                                    <th><?= $this->Paginator->sort('created') ?></th>
                                    <th class="action-col">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php if (!empty($courses->toArray())):
                                    $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                    foreach ($courses as $course): ?>
                                    <tr>
                                        <td><?= $this->Number->format($i) ?>.</td>
                                        <td>
                                            <?= $this->Html->link($course->title, ['plugin' => 'Courses', 'controller' => 'Courses', 'action' => 'view','plugin' => 'Courses','prefix' => false, $course->id], ['target' => '_blank']) ?>
                                        </td>
                                        <td>
                                            <p class="sstopic"><?= $course->board->title ?><br>
                                            <small><span>(<?= $course->subject->title ?>)</span></small>
                                            </p>
                                        </td>
                                        <td><?= $course->duration ?> Hours</td>
                                        <td><?= $this->Number->currency($course->price, 'INR') ?></td>

                                        <td><?= $course->total_chapters ?></td>
                                        <td>
                                            <?php if ($course->status == 1) {
                                                echo "<span class=\"btn-success label-xs white-color rounded\">Active</span>";
                                                }else{
                                                echo "<span class=\"bg-danger label-xs white-color rounded\">In-Active</span>";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                             <?php if ($course->created) {
                                                echo $course->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                                }
                                            ?>
                                        </td>
                                    <td class="action-col">
                                    <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $course->id],['class' => 'btn btn-block btn-warning btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View course'),'title'=>__('View course')]) ?>

                                    <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'add', $course->id], ['class' => 'btn btn-block btn-success btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit course'),'title'=>__('Edit course')]) ?>


                                    <?= $this->Html->link("<i class=\"fa fa-trash\"></i>", ['action' => 'delete', $course->id], ['class' => 'confirmDeleteBtn btn btn-block btn-danger btn-xs btn-flat', 'data-url'=> $this->Url->build(['action' => 'delete', $course->id]), 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Delete course'),'title'=>__('Delete course')]) ?> 
                                    </td>
                                </tr>
                                    <?php $i++; endforeach; ?>
                                <?php else: ?>
                                <tr> <td colspan='10' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> 
                                </tr>
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
