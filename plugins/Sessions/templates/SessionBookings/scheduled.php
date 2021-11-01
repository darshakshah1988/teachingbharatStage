<?php
$this->layout = "authdefault";
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $sessionBookings
 */
?>


<div class="new-header-style-1">
    <div class="container">
        <div class="col-sm-12 text-center">
            <h2>Scheduled Sessions</h2>
           <!--  <p>Lorem ipsum dolor sit consectetur adipiscin sed do eiusmod</p> -->
        </div>
    </div>
</div>
<div class="GreyBg">
    <div class="container">
        <div class="col-sm-3 col-sm-offset-9 mt30">
            <?= $this->Html->link('Session Requested <i class="glyphicon glyphicon-menu-right"></i>',['action' => 'index'], ['escape' => false, 'class' => 'btn mybtn btn-block']) ?>
           
        </div>
    </div>
    <div class="container">
        <div class="col-md-10 col-md-offset-1 TPBbox mb40">
                <h3 class="intt">UPCOMING SESSION</h3>
                <?php if (!empty($sessionBookings->toArray())):
                        $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
                        foreach ($sessionBookings as $sessionBooking): ?>
                <div class="col-md-12 ssbox flex">
                    <div class="col-xs-1 nopadding">
                        <?php 
                        // dump($sessionBooking->user->image_path . $sessionBooking->user->profile_photo);
                         if (!empty($sessionBooking->user->image_path) && !empty($sessionBooking->user->profile_photo) && file_exists("img/".$sessionBooking->user->image_path . $sessionBooking->user->profile_photo)) { 
                            $userPhoto = $sessionBooking->user->image_path . $sessionBooking->user->profile_photo;
                        }else{
                            $userPhoto = 'Authors/01.jpg';
                        }

                        echo $this->Html->image($userPhoto, ['class' => 'ssuser']);
                        ?>
                    </div>
                    <div class="col-xs-9">
                        <h2>Topic: <?= $sessionBooking->topic ?></span></h2>
                        <p>Student : <?= $this->Html->link($sessionBooking->user->name, ['controller' => 'Users', 'action' => 'profile', 'plugin' => 'UserManager', $sessionBooking->user_id], ['class' => 'namme']); ?></p>
                        <h5>Session on : <span><?= $sessionBooking->start_date ? $sessionBooking->start_date->format('jS M, Y H:i A') : "" ?> | <?= $sessionBooking->end_date ? $sessionBooking->end_date->format('jS M, Y H:i A') : "" ?></span></h5>
                    </div>
                    <div class="col-xs-2 showda">
                        <h1><?= $sessionBooking->start_date->format('d') ?></h1>
                        <h2><?= $sessionBooking->start_date->format('M') ?></h2>
                    </div>
                </div>
                 <?php $i++; endforeach; ?>
                            <?php else: ?>
                             <div class="tbodyNotFound" style="text-align:center; line-height: 250px;"><strong>Record Not Available</strong> </div>
                            <?php endif; ?>
               
            </div>
    </div>
</div>

<?php 
echo $this->Html->script(['/assets/plugins/jquery-loading-overlay-master/dist/loadingoverlay.min'],['block' => true]);
echo $this->Html->script(['common', 'Users'], ['block' => true]); ?>
<script>
<?php $this->Html->scriptStart(['block' => true]); ?>
$users = new Users();

$(document).on("click", ".sessionDetail", function(event) {
        event.preventDefault();
        let _this = $(this);
        $users.getSessionContent({'url': _this.data('url'),'type' : _this.data('type'), 'title': _this.data('title'), 'id': _this.data('id')});
});

$(document).on("click", ".modelAction", function(event) {
        event.preventDefault();
        let _this = $(this);
        $users.modelAction({'url': '<?= $this->Url->build(['controller' => 'SessionBookings', 'action' => 'sessionStatus']) ?>', 'data': {'session_status' : _this.data('type'), 'id' :  _this.data('id')}});
});

$(document).on("click", ".sessionModify", function(event) {
        event.preventDefault();
        let _this = $(this);
        $users.sessionModify({'url': '<?= $this->Url->build(['controller' => 'SessionBookings', 'action' => 'sessionModify']) ?>', 'data': {'id' :  _this.data('id')}});
});

$(document).on("click", ".sessionReschedule", function(event) {
        event.preventDefault();
        let _this = $(this);
        $users.sessionReschedule({'url': $('#sessionReschedule').attr('action'), 'data': $('#sessionReschedule').serialize()});
});

<?php $this->Html->scriptEnd(); ?>
</script>