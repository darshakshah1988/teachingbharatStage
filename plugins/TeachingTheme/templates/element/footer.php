<?php 
use Cake\Core\Configure;
?>
 <div class="Footer">
    <div class="container">
        <div class="col-md-12 f-one">
            <div class="col-sm-6 text-right">
                <p>Register For Free</p>
                <h3>All New Learning Universe</h3>
            </div>
            <div class="col-sm-3 wow fadeInUp animated" data-wow-delay="0.4s">
                <?= $this->Html->link('Register Now', ['controller' => 'Users', 'action' => 'register', 'plugin' => 'UserManager'], ['class' => 'btn btn-block']) ?>
                <!-- <a href="#" class="btn btn-block">Register Now</a> -->
            </div>
        </div>
    </div>
        <div class="container f-two">
            <div class="col-md-3 f-con-new">
                <div class="col-md-12">
                    <h6>Feel free to contact us</h6>
                    <h3><span>Call :</span> <?php echo Configure::read('Setting.TELEPHONE'); ?></h3>
                    <h4><span>Email :</span> <?php echo Configure::read('Setting.ADMIN_EMAIL'); ?></h4>
                    <h5>Get Socialsed with us</h5>
                    <a href="#">
                        <?= $this->Html->image('sn1.png') ?>
                    </a>
                    <a href="#">
                        <?= $this->Html->image('sn2.png') ?>
                    </a>
                    <a href="#">
                        <?= $this->Html->image('sn3.png') ?>
                    </a>
                    <a href="#">
                        <?= $this->Html->image('sn4.png') ?>   
                    </a>
                </div>
            </div>
            <div class="col-md-9 nopadding">
                <div class="col-sm-5">
                    <div class="col-md-12 fblock">
                        <h1>Teaching Bharat</h1>
                        <p class="footer-text-p">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
                    </div>
                </div>
              <?php echo $this->cell('Cms.Navigations::navigation',['conditions' => ['Navigations.is_bottom' => 1]])->render('footer'); ?>
            </div>
        </div>
        <div class="bottomFooter">
            <div class="container">
                <div class="col-md-12">
                    <p>Copyright <?php echo date('Y'); ?> All Rights are Reserved by <?php echo Configure::read('Setting.SYSTEM_APPLICATION_NAME'); ?></p>
                </div>
            </div>
        </div>
    </div>
 <div class="modal fade" id="commonModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content DModal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"></h4>
                </div>
                <div class="modal-body">
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>