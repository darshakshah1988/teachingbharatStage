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
                        <h2><i class="glyphicon glyphicon-list-alt"></i>My Micro Sessions</h2>
                    </div>
                    <div class="col-sm-3">
                        <?= $this->Html->link("Add A Micro Session", ['action' => 'add'], ['class' => 'btn mybtn btn-block']) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="col-md-12 nopadding mt20">
                <?= $this->Flash->render() ?>
                    <div class="col-md-12">
                        <table class="table table-bordered ssTable">
                            <thead>
                                <tr>
                                    <th>Course</th>
                                    <th>Grade / Subject</th>
                                    <th>Duration</th> 
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                             <?php if (!empty($microSessions->toArray())):
                                $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                foreach ($microSessions as $course): ?>
                                <tr>
                                    <td>
                                        <?= $this->Html->link($course->title, ['action' => 'view', $course->id], ['class' => 'namme']) ?>
                                    </td>
                                    <td>
                                        <p class="sstopic"><?= $course->title ?><br>
                                            </p>
                                    </td>
                                    
                                    <td>
                                        <p class="ssdate"><?= $course->duration ?> Hours</p>
                                    </td>
                                    <td>
                                        <p class="sstopic"><?= $this->Number->currency($course->price, 'INR') ?></p>
                                    </td>
                                    <td><?= $course->status == 1 ? "Active" : "In-Active" ?></td>
                                    <td class="text-right">
                                        <?= $this->Html->link('<i class="fa fa-plus"></i> Chapter', ['controller' => 'MicroSessionChapters', 'action' => 'index', $course->id], ['class' => 'btn btn-success', 'escape' => false]) ?>

                                        <?= $this->Html->link('View', ['controller' => 'MicroSessions', 'action' => 'view', $course->id], ['class' => 'btn btn-success']) ?>

                                        <?= $this->Html->link('Edit', ['controller' => 'MicroSessions', 'action' => 'add', $course->id], ['class' => 'btn btn-primary']) ?>

                                        <?= $this->Html->link("Delete", ['action' => 'delete', $course->id], ['class' => 'confirmDeleteBtn btn btn-danger', 'data-url'=> $this->Url->build(['action' => 'delete', $course->id]), 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Edit course'),'title'=>__('Delete course')]) ?> 
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


<?php 
echo $this->Html->css(['/assets/plugins/dropify-master/dist/css/dropify.min.css','https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css
'],['block' => true]);
echo $this->Html->script(['/assets/plugins/dropify-master/dist/js/dropify.min.js', 'https://cdn.ckeditor.com/4.14.0/basic/ckeditor.js','https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js'],['block' => true]);
echo $this->Html->script(['common'], ['block' => true]); ?>

