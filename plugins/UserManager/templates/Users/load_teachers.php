<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $users
 */
$this->layout = "ajax";
?>
<?php if (!empty($users->toArray())):
        $i = ((($this->Paginator->param('page') - 1) * $this->Paginator->param('perPage')) + 1);
    foreach ($users as $user): 
        $avg = $user->avg_rating ? $user->avg_rating : 0;
        //dump($user);
        ?>
        <div class="col-sm-12 teacher-box-listview">
                <table>
                    <tr>
                        <td class="text-center">
                            <?php 
                                if (!empty($user->image_path) && !empty($user->profile_photo) && file_exists("img/".$user->image_path . $user->profile_photo)) { 
                                        $userPhoto = $user->image_path . $user->profile_photo;
                                    }else{
                                        $userPhoto = \Cake\Core\Configure::read('Users.Avatar.placeholder');
                                    }
                               echo $this->Html->image($userPhoto, ['width' => '100']);
                            ?>
                           <!--  <h6 class="green-color"><i class="glyphicon glyphicon-stop"></i> Online</h6> -->
                        </td>
                        <td>
                            <h3><?= $user->name ?></h3>
                            <p><?= $user->user_profile->qualification ?? "" ?>, <?= $user->user_profile->college_university ?? "" ?></p>
                            <p>Teaches - <?= $user->user_profile->primary_subject->title ?? "" ?> <?= isset($user->user_profile->secondary_subject) ? ", ". $user->user_profile->secondary_subject->title : "" ?></p>
                        </td>
                        <td>
                            <h4>
                                <?php for($s = 1; $s <= 5; $s++){
                                    if($s <= round($avg)){
                                        echo '<i class="fas fa-star"></i>';
                                    }else{
                                        echo '<i class="far fa-star" style=""></i>';
                                    }
                                } ?>
                                <!-- <i class="fa fa-star"></i> 
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half mr-5"></i> -->
                                <?= round($avg,1) ?>
                            </h4>
                            <h5>Teaching Experience : <?= $user->user_profile->experience ?? 0 ?><?php echo !empty($user->user_profile->experience_month) ? "." . $user->user_profile->experience_month : "" ?> Year(s)</h5>
                            <!-- <a href="TeacherProfile.html" class="tb-btn-md mt10">Profile</a> -->
                             <?= $this->Html->link("Profile <i class=\"glyphicon glyphicon-menu-right\"></i>", ['controller' => 'Users', 'action' => 'profile', 'plugin' => 'UserManager', $user->id], ['class' => 'tb-btn-md mt10', 'escape' => false]) ?>
                        </td>
                    </tr>
                </table>
            </div>
<?php $i++; endforeach; ?>
<?php else: ?>
        <div style="text-align:center;">
            <strong>Record Not Available</strong>  
        </div>
<?php endif; ?>
