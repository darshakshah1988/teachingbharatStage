<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $courses
 */
$this->layout = "ajax";
?>
<?php if (!empty($courses->toArray())):
        $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
    foreach ($courses as $course): ?>
    <a href="<?= $this->Url->build(['plugin' => 'Courses', 'controller' => 'Courses', 'action' => 'view', $course->id]) ?>">
        <div class="col-sm-4">
            <div class="col-sm-12 new-c-box">
                <!-- <span class="c-tag">Upcoming</span> -->
                <p class="c-grade"><?= $course->board->title ?> - <?= $course->grading_type->title ?>: <?= $course->subject->title ?></p>
                <h2><?= $course->title ?></h2>
                <div class="col-sm-6 nopadding">
                    <?php if($course->is_free == 1) { ?>
                    <p class="c-meta">
                        <span>Free Course</span><br>
                    </p>
                    <?php }else{
                        echo '<p class="c-meta"><span>Paid Course</span><br></p>';
                    } ?>
                </div>
                <div class="col-sm-6 nopadding text-right">
                    <p class="c-meta">
                        <span>Duration</span><br>
                        <?= $course->duration ?> Hours
                    </p>
                </div>
                <div class="col-sm-12 nopadding">
                    <h3><?= $this->Number->currency($course->price, 'INR') ?> <i class="glyphicon glyphicon-menu-right"></i></h3>
                </div>
            </div>
        </div>
    </a>
<?php $i++; endforeach; ?>
<?php else: ?>
        <div style="text-align:center;">
            <strong>Record Not Available</strong>  
        </div>
<?php endif; ?>
