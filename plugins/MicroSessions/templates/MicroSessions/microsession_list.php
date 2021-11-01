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
                                    <th>Course</th>
                                    <th>Grade / Subject</th>
                                    <th>Duration</th> 
                                    <th>Total Chapter</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                             <?php if (!empty($courses->toArray())):
                                $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                foreach ($courses as $course): ?>
                                <tr>
                                    <td>
                                        <?= $this->Html->link($course->title, ['action' => 'view', $course->id], ['class' => 'namme', 'target' => '_blank']) ?>
                                    </td>
                                    <td>
                                        <p class="sstopic"><?= $course->board->title ?><br>
                                            <span><?= $course->subject->title ?></span></p>
                                    </td>
                                    
                                    <td>
                                        <p class="ssdate"><?= $course->duration ?> Hours</p>
                                    </td>
                                    
                                    <td>
                                        <p class="ssdate"><?= $course->total_chapters ?></p>
                                    </td>
                                    <td class="text-right">
                                       
                                        <?= $this->Html->link('View', ['controller' => 'Courses', 'action' => 'view', $course->id], ['class' => 'btn btn-success']) ?>

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