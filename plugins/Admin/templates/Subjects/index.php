<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $subjects
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage Subject') ?>
        </h1>
        <small><?php echo __('Here you can manage the subjects'); ?></small>
</div>
<?php $this->end(); ?>
<div class="row subjects index content">

<div class="col-12 col-sm-12 col-md-12">
                <div class="panel-default">
                    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                        <h2><?= __('Subject') ?> List</h2>
                        <div class="d-flex flex-wrap"><?= $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('New Subject'), ["action" => "add"], ["class" => "btn btn-block btn-primary btn-sm btn-flat", "escape" => false]) ?></div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= $this->Paginator->sort('course_id') ?></th>
                                    <th><?= $this->Paginator->sort('title') ?></th>
                                    <th><?= $this->Paginator->sort('max_weekly_classes') ?></th>
                                    <th><?= $this->Paginator->sort('credit_hours') ?></th>
                                    <th><?= $this->Paginator->sort('is_activity') ?></th>
                                    <th><?= $this->Paginator->sort('is_exam') ?></th>
                                    <th><?= $this->Paginator->sort('position') ?></th>
                                    <th><?= $this->Paginator->sort('created') ?></th>
                        <th class="action-col">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php if (!empty($subjects->toArray())):
                                    $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                    foreach ($subjects as $subject): ?>
                                 <tr>
                                    <td><?= $this->Number->format($i) ?>.</td>
                                    <td>
                                        <?= $subject->has('course') ? $this->Html->link($subject->course->title, ['controller' => 'Courses', 'action' => 'view', $subject->course->id]) : '' ?>
                                    </td>
                                <td><?= h($subject->title) ?></td>


                                <td><?= $this->Number->format($subject->max_weekly_classes) ?></td>
                                <td><?= $this->Number->format($subject->credit_hours) ?></td>
                                    <td>
                                    <?php if ($subject->is_activity == 1) {
                                            echo "Yes";
                                        }else{
                                            echo "No";
                                        }
                                    ?>
                                </td>

                                    <td>
                                    <?php if ($subject->is_exam == 1) {
                                            echo "Yes";
                                        }else{
                                            echo "No";
                                        }
                                    ?>
                                </td>

                                <td><?= $this->Number->format($subject->position) ?></td>
                                <td>
                             <?php if ($subject->created) {
                                echo $subject->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                }
                            ?>
                            </td>


                        <td class="action-col">
                <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $subject->id],['class' => 'btn btn-block btn-warning btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View subject'),'title'=>__('View subject')]) ?>

                <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'add', $subject->id], ['class' => 'btn btn-block btn-success btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit subject'),'title'=>__('Edit subject')]) ?>

                <?= $this->Html->link("<i class=\"fa fa-trash\"></i>", 'javascript:void(0)', ['class' => 'deleteWithReload btn btn-block btn-danger btn-xs btn-flat', 'data-url'=> $this->Url->build(['action' => 'delete', $subject->id]), 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit subject'),'title'=>__('Delete subject')]) ?>
                    </td>
                </tr>
                                <?php $i++; endforeach; ?>
                            <?php else: ?>
                            <tr> <td colspan='10' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> </tr>
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
