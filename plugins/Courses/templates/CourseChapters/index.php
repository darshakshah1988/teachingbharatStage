<?php
$this->layout = "authdefault";
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $courseChapters
 */
?>
<div class="White79">
    <div class="GreyBg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 TitleStripp">
                    <div class="col-sm-9">
                        <h2><i class="glyphicon glyphicon-list-alt"></i>
                            <?= $this->Text->truncate($course->title, 50,  ['ellipsis' => '...', 'exact' => false]) ?></h2>
                    </div>
                    <div class="col-sm-3">
                        <?= $this->Form->button("Add Chapter", ['type' => 'button', 'class' => 'btn mybtn btn-block', 'id' => 'addChapters','data-title' => 'Add Chapter', 'data-url' => $this->Url->build(['action' => 'add', '?' => ['course_id' => $course->id]])]) ?>
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
                                    <th>#</th>
                                    <th>Course</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Chapter Status</th>
                                    <th>Created</th>
                                    <th class="action-col" width="25%">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php if (!empty($courseChapters->toArray())):
                                    $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                                    foreach ($courseChapters as $courseChapter): ?>
                                 <tr>
                                    <td><?= $this->Number->format($i) ?>.</td>
                                    <td><?= $this->Html->link($courseChapter->course->title, ['action' => 'view', $courseChapter->course_id], ['class' => 'namme']) ?></td>
                                    <td><?= h($courseChapter->title) ?></td>
                                    <td><?= h($courseChapter->short_description) ?></td>
                                    <td>
                                        <?php if ($courseChapter->is_free == 1) {
                                                echo "Free";
                                            }else{
                                                echo "Paid";
                                            }
                                        ?>
                                    </td>

                                        <td>
                                         <?php if ($courseChapter->created) {
                                            echo $courseChapter->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_TIME_FORMAT'));
                                            }
                                        ?>
                                        </td>


                                        <td class="action-col">

                                        <?= $this->Html->link('View', ['action' => 'view', $courseChapter->id], ['class' => 'btn btn-success']) ?>

                                        <?= $this->Form->button("Edit Chapter", ['type' => 'button', 'class' => 'btn btn-primary', 'id' => 'addChapters','data-title' => 'Add Chapter', 'data-url' => $this->Url->build(['action' => 'add', $courseChapter->id, '?' => ['course_id' => $course->id]])]) ?>

                                        <?= $this->Html->link("Delete", ['action' => 'delete', $courseChapter->id], ['class' => 'confirmDeleteBtn btn btn-danger', 'data-url'=> $this->Url->build(['action' => 'delete', $courseChapter->id]), 'escape' => false,'data-toggle'=>'tooltip','alt'=>__('Delete Chapter'),'title'=>__('Delete Chapter')]) ?> 



                                        </td>
                                </tr>
                                <?php $i++; endforeach; ?>
                                <?php else: ?>
                                <tr> <td colspan='13' align='center' class="tbodyNotFound" style="text-align:center;"> <strong>Record Not Available</strong> </td> 
                                </tr>
                                <?php endif; ?>
                              </tbody>
                            </table>
                    </div>
                    <div class="col-md-12 pagination-sec d-flex justify-content-between flex-wrap align-items-center">
                            <?php //echo $this->element('pagination'); ?>
                        </div>
                </div>
        </div>
    </div>
</div>
<?php 
echo $this->Html->css(['/assets/plugins/dropify-master/dist/css/dropify.min.css'],['block' => true]);
echo $this->Html->script(['/assets/plugins/dropify-master/dist/js/dropify.min.js', 'https://cdn.ckeditor.com/4.14.0/basic/ckeditor.js'],['block' => true]);
echo $this->Html->script(['common', 'Courses'], ['block' => true]); ?>
<script type="text/javascript">
<?php $this->Html->scriptStart(['block' => true]); ?>
$coursesObj = new Courses();
// $(document).on("click","#addChapters ", function(event){
//       event.preventDefault();
//       $coursesObj.addChapters($(this));
// });
$(document).on("click", "#addChapters", function(event) {
        event.preventDefault();
        console.log($(this));
       $coursesObj.addChapters({'title': $(this).data('title'),'url': $(this).data('url'), filters: {course_id: <?= $course->id ?>}});
});
<?php $this->Html->scriptEnd(); ?> 
</script>
<?php
$this->assign('title', $metaData['meta_title']);
$this->Html->meta(
    'keywords', $metaData['meta_keyword'], ['block' => true]
);
$this->Html->meta(
    'description', $metaData['meta_description'], ['block' => true]
);
?>