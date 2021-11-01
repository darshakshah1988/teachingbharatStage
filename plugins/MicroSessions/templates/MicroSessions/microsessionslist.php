<?php
$this->layout = "authdefault";
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $courses
 */
?>
<div class="White79">
    <div class="GreyBg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 TitleStripp">
                    <div class="col-sm-9">
                        <h2><i class="glyphicon glyphicon-list-alt"></i>My Courses</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="col-md-12 nopadding mt20">
                    <div class="col-md-12">
                        <table class="table table-bordered ssTable">
                            <thead>
                                <tr>
                                    <th>MicroSession</th>
                                    <th>Subject/ Board</th>
                                    <th>Grade</th>
                                    <th>Duration</th>

                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                             <?php
                               $method='microsessionDetails';
                             if (!empty($orders->toArray())):
                                $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                foreach ($orders as $order):
                                    $order_courses = $this->Html->link($order->micro_sessions['title'], ['controller' => 'MicroSessions', 'action' => $method, 'plugin' => 'MicroSessions', $order->micro_sessions['id']], ['target' => '_blank', 'class' => 'namme']);
                                    ?>
                                <tr>
                                    <td><?= $order_courses? $order_courses: "" ?></td>
                                    <td><?= $order->subjects['title'] ?> | <?= $order->boards['title'] ?></td>
                                    <td><?= $order->grading_types['title'] ?> Grade</td>
                                    <td>
                                        <p class="ssdate"><?= $order->micro_sessions['duration']; ?> Hours</p>
                                    </td>


                                    <td class="text-center">
                                        <?= $this->Html->link('View', ['controller' => 'MicroSessions', 'action' => $method, 'plugin' => 'MicroSessions', $order->micro_sessions['id']], ['target' => '_blank', 'class' => 'btn btn-success']); ?>

                                    </td>
                                </tr>
                                <?php $i++; endforeach; ?>
                                <?php else: ?>
                                    <tr> <td colspan='20' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
</div>
