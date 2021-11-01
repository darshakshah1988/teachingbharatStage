<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $reviews
 */
?>
<?php $this->start('breadcrumb'); ?>
<div class="content-top-sec">
        <nav aria-label="breadcrumb">
          <?= $this->element('breadcrumb') ?>
        </nav>
        <h1>
            <?= __('Manage {0} Review', ucfirst($this->request->getQuery('review_type'))) ?>
        </h1>
        <small><?php echo __('Here you can manage {0} reviews', $this->request->getQuery('review_type')); ?></small>
</div>
<?php $this->end(); ?>
<div class="row reviews index content">

<div class="col-12 col-sm-12 col-md-12">
                <div class="panel-default">
                    <div class="panel-heading d-flex flex-wrap justify-content-between align-items-center">
                        <h2><?= __('Review') ?> List</h2>
                        <div class="d-flex flex-wrap"><?= $this->Html->link("<i class=\"fa fa-plus\"></i> " . __('New Review'), ["action" => "add", '?' => $this->request->getQuery()], ["class" => "btn btn-block btn-primary btn-sm btn-flat", "escape" => false]) ?></div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= $this->request->getQuery('review_type') == "user" ? $this->Paginator->sort('user_id') : $this->Paginator->sort('course_id') ?></th>
                                    <th><?= $this->Paginator->sort('name') ?></th>
                                    <th><?= $this->Paginator->sort('rating') ?></th>
                                    <th><?= $this->Paginator->sort('status') ?></th>
                                    <th><?= $this->Paginator->sort('created') ?></th>
                                    <th class="action-col">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php if (!empty($reviews->toArray())):
                                    $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                    foreach ($reviews as $review): ?>
                                     <tr>
                                        <td><?= $this->Number->format($i) ?>.</td>
                                       
                                            <td>
                                                <?php if($this->request->getQuery('review_type') == "user"){ 
                                                echo $review->has('user') ? $this->Html->link($review->user->name, ['controller' => 'Users', 'action' => 'view','plugin' => 'UserManager', $review->user->id]) : '';
                                                 } else{
                                                echo $review->has('course') ? $this->Html->link($review->course->title, ['controller' => 'Courses', 'action' => 'view','plugin' => 'Courses', $review->course->id]) : '';
                                                } 
                                                ?>
                                        </td>
                                    <td><?= h($review->name) ?></td>
                                    <td><?= $this->Number->format($review->rating) ?> Star</td>

                                        <td>
                                        <?php if ($review->status == 1) {
                                                echo "Active";
                                            }else{
                                                echo "In-Active";
                                            }
                                        ?>
                                    </td>

                                    <td>
                                 <?php if ($review->created) {
                                    echo $review->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                    }
                                ?>
                                </td>


                                    <td class="action-col">
                            <?= $this->Html->link("<i class=\"fa fa-fw fa-eye\"></i>", ['action' => 'view', $review->id, '?' => $this->request->getQuery()],['class' => 'btn btn-block btn-warning btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('View review'),'title'=>__('View review')]) ?>

                            <?= $this->Html->link("<i class=\"fa fa-edit\"></i>", ['action' => 'add', $review->id, '?' => $this->request->getQuery()], ['class' => 'btn btn-block btn-success btn-xs btn-flat', 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit review'),'title'=>__('Edit review')]) ?>

                            <?= $this->Html->link("<i class=\"fa fa-trash\"></i>", 'javascript:void(0)', ['class' => 'deleteWithReload btn btn-block btn-danger btn-xs btn-flat', 'data-url'=> $this->Url->build(['action' => 'delete', $review->id]), 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit review'),'title'=>__('Delete review')]) ?>
                                </td>
                                </tr>
                                <?php $i++; endforeach; ?>
                            <?php else: ?>
                            <tr> <td colspan='12' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> </tr>
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
