 <?php if (!empty($sessionBookings->toArray())){ ?>
<div class="col-md-12 TPBbox">
    <?php if($type == "pending"){
    ?>
 <h2 class="title">NEW SESSIONS REQUEST RECEIVED (<?= count($sessionBookings) ?>)</h2>
<?php }else{ ?>
<h2 class="title">UPCOMING SESSION 
    <?php if($this->getRequest()->getAttribute('identity')->role == "teacher"){ 
    echo $this->Html->link("View All", ['plugin' => 'Sessions','controller' => 'SessionBookings', 'action' => 'scheduled'], ['class' => 'btn btn-xs btn-default pull-right']); 
     } ?>
</h2>
<?php } ?>
<?php foreach ($sessionBookings as $sessionBooking){
 ?>
<div class="col-md-12 ssbox <?= $type == "pending" ? "new" : "" ?> flex">
    <div class="col-xs-1 nopadding">
         <?php 
        // dump($sessionBooking->user->image_path . $sessionBooking->user->profile_photo);
         if($this->getRequest()->getAttribute('identity')->role == "teacher"){
             if (!empty($sessionBooking->user->image_path) && !empty($sessionBooking->user->profile_photo) && file_exists("img/".$sessionBooking->user->image_path . $sessionBooking->user->profile_photo)) { 
                $userPhoto = $sessionBooking->user->image_path . $sessionBooking->user->profile_photo;
            }else{
                $userPhoto = 'Authors/01.jpg';
            }
        }else{
             if (!empty($sessionBooking->teacher->image_path) && !empty($sessionBooking->teacher->profile_photo) && file_exists("img/".$sessionBooking->teacher->image_path . $sessionBooking->teacher->profile_photo)) { 
                $userPhoto = $sessionBooking->teacher->image_path . $sessionBooking->teacher->profile_photo;
            }else{
                $userPhoto = 'Authors/01.jpg';
            }
        }
        echo $this->Html->image($userPhoto, ['class' => 'ssuser']);
        ?>
    </div>
    <div class="col-xs-9">
        <h2>Session on <?= $sessionBooking->topic ?></h2>
        <p>Student : 
            <?php
                if($this->getRequest()->getAttribute('identity')->role == "teacher"){
                    echo $this->Html->link($sessionBooking->user->name, ['controller' => 'Users', 'action' => 'profile', 'plugin' => 'UserManager', $sessionBooking->user_id], ['class' => 'namme']);
                }else{
                    echo $this->Html->link($sessionBooking->teacher->name, ['controller' => 'Users', 'action' => 'profile', 'plugin' => 'UserManager', $sessionBooking->teacher_id], ['class' => 'namme']);
                }
             ?>
        </p> 
        <h5>Session on : <span><?= $sessionBooking->start_date ? $sessionBooking->start_date->format('jS M, Y H:i A') : "" ?> | <?= $sessionBooking->end_date ? $sessionBooking->end_date->format('jS M, Y H:i A') : "" ?></span></h5>
    </div>
<?php  if($type == "pending"){ ?>
    <div class="col-xs-2 nopadding">
         <a href="javascript:void(0)" class="btn btn-block sessionDetail" data-type="teacher" data-url="<?= $this->Url->build(['plugin' => 'Sessions','controller' => 'SessionBookings', 'action' => 'view', $sessionBooking->id]) ?>" data-title="Session Request | <?= $sessionBooking->created->format('jS F, Y') ?> (<?= $sessionBooking->created->format('H:i a') ?>)" data-id="<?= $sessionBooking->id ?>">Detail</a>
    </div>
<?php } ?>
</div>
<?php } ?>
</div>
<?php } ?>

