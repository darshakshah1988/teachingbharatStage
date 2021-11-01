<div class="col-sm-2 dp">
    <?php 
    if (!empty($user->image_path) && !empty($user->profile_photo) && file_exists("img/".$user->image_path . $user->profile_photo)) { 
        $userPhoto = $user->image_path . $user->profile_photo;
    }else{
        $userPhoto = \Cake\Core\Configure::read('Users.Avatar.placeholder');
    }
   echo $this->Html->image($userPhoto, ['width' => '180', 'height' => '180']);
    ?>
</div>
<div class="col-sm-10 details">
    <h1><?= $user->first_name . " <span>" . $user->last_name  ?></span></h1>
    <?php if($user->role == "teacher"){ ?>
        <p>Qualification: <?= $user->user_profile->qualification ?? "" ?></p>
    <?php }else{ ?>
        <p>Grade: <?= $user->user_profile->grading_type->title ?? "" ?></p>
    <?php } ?>
</div>
