 <div class="row">
    <div class="col-sm-12 Date">
        <h1><?= $sessionBooking->start_date->format('j') ?></h1>
        <p><?= $sessionBooking->start_date->format('M, Y') ?></p>
    </div>
    <div class="col-sm-12 SesDetatils">
        <div class="col-sm-6">
            <h2>Requested By</h2>
            <p>
                <?php
                echo $this->Html->link($sessionBooking->user->name, ['controller' => 'Users', 'action' => 'profile', 'plugin' => 'UserManager', $sessionBooking->user_id], ['target' => '_blank']);
                 ?>(Me)
                
            </p>
        </div>
        <div class="col-sm-6 alignright">
            <h2>Requested To</h2>
            <p>
                <?php 
                echo $this->Html->link($sessionBooking->teacher->name, ['controller' => 'Users', 'action' => 'profile', 'plugin' => 'UserManager', $sessionBooking->teacher_id], ['target' => '_blank']);
                ?>(Teacher)
            </p>
        </div>
    </div>
    <div class="col-sm-12 SesDeta">
        
        <div class="col-sm-6">
            <div class="col-sm-12 box">
                <h2>Session On</h2>
                <p><?= $sessionBooking->start_date ? $sessionBooking->start_date->format('D dS M, H:i A') : "N/A" ?></p>
            </div>
        </div>
         <div class="col-sm-6">
            <div class="col-sm-12 box">
                <h2>Session From</h2>
                <p><?= $sessionBooking->end_date ? $sessionBooking->end_date->format('D dS M, H:i A') : "N/A" ?></p>
            </div>
        </div>
       <!--  <div class="col-sm-3">
            <div class="col-sm-12 box">
                <h2>Time</h2>
                <p>07 : 00 PM</p>
            </div>
        </div> -->
    </div>
    <div class="col-sm-12 topic">
        <h3>Topics</h3>
        <p><?= $sessionBooking->topic ?></p>
    </div>
    <?php if(!empty($sessionBooking->teacher_comment)){ ?>
    <div class="col-sm-12 topic">
        <h3>Comment</h3>
        <p><?= $sessionBooking->teacher_comment ?></p>
    </div>
    <?php } ?>
    <div class="col-sm-12 action">
        <div class="col-sm-4">
            <h2>Status</h2>
            <p>
                 <?php if($sessionBooking->session_status == 0 || empty($sessionBooking->session_status)){
                        echo 'Awaiting teacher response';
                    }else if($sessionBooking->session_status == 1){
                        echo '<span style="color:green">Accept</span>';
                    }else if($sessionBooking->session_status == 2){
                        echo 'Decline';
                    }  ?>
            </p>
        </div>
       <!--  <div class="col-sm-8">
            <div class="col-sm-7">
                <a href="javascript:void(0);" data-id="<?= $sessionBooking->id ?>" class="green studentAccept">ACCEPT</a>
            </div>
            <div class="col-sm-5">
                <a href="javascript:void(0);" data-id="<?= $sessionBooking->id ?>" class="red studentDecline">DECLINE</a>
            </div>
        </div> -->
    </div>
</div>