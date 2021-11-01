<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $courses
 */
$this->layout = "ajax";
?>
<?php if (!empty($courses->toArray())):
        $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
    foreach ($courses as $course):
    $imgpath=$course->microsession_file_dir? $course->microsession_file_dir.$course->microsession_file : "img/micro-courses/samplebanner.jpg";

    $startTimeStr = 0;
    $startTime = 0;
    $currentTime = time();
    if(isset($course->micro_session_chapters) && isset($course->micro_session_chapters[0]) && !empty($course->micro_session_chapters[0]->start_date)){
        $startTimeStr = strtotime($course->micro_session_chapters[0]->start_date.' '.$course->micro_session_chapters[0]->start_time);
        $startTime = date('d M, Y',$startTimeStr);
    }
    if($startTimeStr >= $currentTime){
     ?>
    <!-- a href="<?= $this->Url->build(['plugin' => 'MicroSessions', 'controller' => 'MicroSessions', 'action' => 'microsessionDetails', $course->id]) ?>" -->
             <div class="col-md-4 p10">
                        <div class="col-md-12 nopadding coursebox1 micro-courses-box" style="min-width: 260px;min-height: 308px;">
                            <div class="col-md-12 nopadding">
                                <img height="124px" src="/<?= $imgpath?>" class="micro-courses-list-banner" />
                            </div>
                            <div class="col-md-12 area">
                                <h2 class="micro-list-title"><?= ucfirst($course->title); ?></h2>
                                <ul>
                                    <li><i class="glyphicon glyphicon-menu-hamburger"></i><strong><?= $course->grading_type->title; ?> Grade</strong></li>
                                    <li><i class="glyphicon glyphicon-bookmark"></i><?= $course->subject->title ?></li>
                                    <li><i class="glyphicon glyphicon-time"></i><?= $startTime; ?></li>
                                 <!--    <li><i class="glyphicon glyphicon-time"></i><strong>Recorded Courses</strong></li> -->
                                </ul>
                            </div>
                            <div class="col-md-12 bottom">
                                <div class="col-md-7  p10">
                                    <p><span class="no-price-cross">₹<?= $course->price?></span>
                                        <span>₹</span><?= $course->price-$course->discount_price?></p>
                                </div>
                                <div class="col-md-5 p10">
                                    <a href="<?= $this->Url->build(['plugin' => 'MicroSessions', 'controller' => 'MicroSessions', 'action' => 'microsessionDetails', $course->id]) ?>">Buy Now <i class="glyphicon glyphicon-menu-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
    <!-- /a -->
<?php $i++;
}
endforeach; ?>
<?php else: ?>
        <div style="text-align:center;">
            <strong>Record Not Available</strong>
        </div>
<?php endif;

?>

<?php
// echo $this->Html->css(['micro_courses.css','Dstyle.css'],['block' => true]);?>
