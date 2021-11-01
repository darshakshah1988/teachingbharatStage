
 <?php
 $this->layout = "mycalendar";
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $microSession
 */
//echo "<pre>";
//print_r($orders);
//die;

?>



<div class="new-header-style-1">
    <div class="container">
        <div class="col-sm-12 text-center">
            <h2>Calendar</h2>
            <p>Lorem ipsum dolor sit consectetur adipiscin sed do eiusmod</p>
        </div>
    </div>
</div>
<div class="GreyBg">
    <div class="container" style="width: 100%">
        <div class="col-md-2 nopadding MyCalSide">
            <h1>Upcoming Sessions</h1>
            <?php
            if(count($upcomingSessions) > 0){
                foreach($upcomingSessions as $key => $upcomingSession){
                    if(count($upcomingSession) > 0){
                ?>
                <div class="col-md-12 box">
                    <h2><?= $key; ?></h2>
                    <?php
                    foreach($upcomingSession as $chapters){
                    ?>
                        <p><?= $chapters['title']; ?></p>
                        <h5><?= $chapters['timing']; ?></h5>
                    <?php
                    }
                    ?>
                </div>
            <?php
                    }
                }
            } ?>
        </div>
        <div class="col-md-10 mb40">
            <div id='calendar'></div>
        </div>
    </div>
</div>
</div>
    <?php
echo $this->Html->css(['fullcalendar.css','//fullcalendar.print.css'],['block' => true]);
echo $this->Html->script(['http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js','moment.min.js','micro/jquery.min.js','micro/fullcalendar.min.js','micro/bootstrap.min.js','micro/custom.js']);
 ?>
<script>
    <?php $this->Html->scriptStart(['block' => true]); ?>
    $(document).ready(function () {
        $('#calendar').fullCalendar({
            defaultDate: '<?php echo date('Y-m-d') ?>',
            editable: true,
            eventLimit: false, // allow "more" link when too many events
            events: [
            <?php foreach($orders as $chap):
                  if($chap->micro_session_chapters['id']){
                ?>

                {
                    id: <?php echo $chap->micro_session_chapters['id'] ?>,
                    title: '<?php echo date('h:i A', strtotime($chap->micro_session_chapters['start_date'].' '.$chap->micro_session_chapters['start_time'])).' - '.date('h:i A', strtotime($chap->micro_session_chapters['end_date'].' '.$chap->micro_session_chapters['end_time'])).' '.$chap->micro_session_chapters['title'] ?>',
                    start: '<?php echo date('Y-m-d', strtotime($chap->micro_session_chapters['start_date'])) ?>',
                    end: '<?php echo date('Y-m-d', strtotime($chap->micro_session_chapters['end_date'])) ?>',
                },
                <?php }
            endforeach;?>

             <?php foreach($packageschapter as $pkg_chap):
                  if($pkg_chap->micro_session_chapters['id']){
                ?>

                {
                    id: <?php echo $pkg_chap->micro_session_chapters['id'] ?>,
                    title: '<?php echo date('h:i A', strtotime($pkg_chap->micro_session_chapters['start_date'].' '.$pkg_chap->micro_session_chapters['start_time'])).' - '.date('h:i A', strtotime($pkg_chap->micro_session_chapters['end_date'].' '.$pkg_chap->micro_session_chapters['end_time'])).' '.$pkg_chap->micro_session_chapters['title'] ?>',
                    start: '<?php echo date('Y-m-d', strtotime($pkg_chap->micro_session_chapters['start_date'])) ?>',
                    end: '<?php echo date('Y-m-d', strtotime($pkg_chap->micro_session_chapters['end_date'])) ?>',
                },
                <?php }
            endforeach;

            ?>

            ]
        });
    });
<?php $this->Html->scriptEnd(); ?>
</script>
