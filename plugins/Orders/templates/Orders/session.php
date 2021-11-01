<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $orders
 */
$this->layout = "authdefault";
?>
<div class="new-header-style-1">
    <div class="container">
        <div class="col-sm-12 text-center">
            <h2>Students registered for Master session</h2>
            <!-- <p>Teaching Bharat's Master session history</p> -->
        </div>
    </div>
</div>
 <section class="White79">
    <div class="container">
        <div class="col-sm-12">
            <?= $this->Flash->render() ?>
            <div class="form-group">
                 <ul class="nav nav-tabs">
                      <li >
                        <?= $this->Html->link('Purchase history', ['plugin' => 'Orders', 'controller' => 'Orders', 'action' => 'index'], ['escape' => false]); ?>
                    </li>
                    <li class="active">
                        <?= $this->Html->link('Master session', ['plugin' => 'Orders', 'controller' => 'Orders', 'action' => 'session'], ['escape' => false]); ?>
                    </li>
                     <li>
                    <?= $this->Html->link('Micro Session', ['plugin' => 'Orders', 'controller' => 'Orders', 'action' => 'microsession'], ['escape' => false]); ?>
                    </li>



                </ul>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered ssTable">
                  <thead>
                    <tr>
                        <th>#</th>
                        <?php if($this->request->getAttribute('identity')->role == "teacher"){ ?>
                            <th>Student</th>
                        <?php } ?>
                        <th>Session Title</th>
                        <th>Session Date</th>

                        <!-- <th class="action-col">Action</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (!empty($orders->toArray())):
                        $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                        foreach ($orders as $order):
                            $order_courses = $order->order_courses[0] ?? "";
                            //dump($order_courses);
                            ?>
                        <tr>
                            <td><?= $this->Number->format($i) ?>.</td>
                            <?php if($this->request->getAttribute('identity')->role == "teacher"){ ?>
                                <td>
                                    <?= $this->Html->link($order->user->name, ['controller' => 'Users', 'action' => 'profile', 'plugin' => 'UserManager', $order->user_id], ['class' => '', 'escape' => false]) ?>
                                </td>
                            <?php } ?>
                            <td><?= $this->Html->link($order_courses->course->title, ['plugin' => 'Courses','controller' => 'Courses', 'action' => 'sessionDetail', $order_courses->course->id], ['class' => '', 'target' => '_blank']) ?></td>
                            <td>
                             <?= $order_courses->course->start_date->format('D dS M, h:i A') ?>
                            </td>
                            <?php /* ?>
                            <td class="action-col">
                            <?php
                                if($this->request->getAttribute('identity')->role == "teacher"){

                                 }
                                if($order_courses->course->end_date < date('Y-m-d H:i:s')){
                                 echo $this->Html->link('Join Session', ['plugin' => 'Courses', 'controller' => 'Courses', 'action' => 'pastSession', $order_courses->course->id], ['escape' => false,'style' => '', 'class' => 'tb-btn-md', 'data-id' => $order_courses->course->id]);
                                }else if($order_courses->course->start_date <= date('Y-m-d H:i:s') && $order_courses->course->end_date >= date('Y-m-d H:i:s')){
                                    echo $this->Html->link('Join Session', ['plugin' => 'Courses', 'controller' => 'Courses', 'action' => 'joinSession', $order_courses->course->id], ['escape' => false,'style' => '', 'class' => 'tb-btn-md', 'data-id' => $order_courses->course->id]);
                                }
                            ?>
                            </td>
                            <?php */ ?>
                            </tr>
                            <?php $i++; endforeach; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan='11' align='center' class="tbodyNotFound" style="text-align:center;">
                                    <strong>Record Not Available</strong>
                                </td>
                            </tr>
                        <?php endif; ?>
                  </tbody>
                </table>
            </div>
            <div class="pagination-sec d-flex justify-content-between flex-wrap align-items-center">
                <?php
                $totalCount = $this->Paginator->params()['count'] ?? 0;
                if($totalCount > \Cake\Core\Configure::read('Setting.PAGE_LIMIT')){
                    echo $this->element('pagination');
                }
                 ?>
            </div>
        </div>
    </div>
</section>

<?php
$this->assign('title', 'Purchase history');
$this->Html->meta(
    'keywords', 'Purchase history', ['block' => true]
);
$this->Html->meta(
    'description', 'Purchase history', ['block' => true]
);
?>

<?php
echo $this->Html->css(['/assets/plugins/countdownTimer/src/css/jQuery.countdownTimer.css'], ['block' => true]);
echo $this->Html->script(['/assets/plugins/countdownTimer/src/js/jQuery.countdownTimer.js'], ['block' => true]);
?>


<script>
<?php $this->Html->scriptStart(['block' => true]); ?>


<?php $this->Html->scriptEnd(); ?>
</script>
