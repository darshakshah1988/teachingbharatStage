<?php
use Cake\Core\Configure;
?>
<nav class="<?= $this->request->getParam('controller') == "Pages" && $this->request->getParam('action') == "display" ? "navbar navbar-default" : "navbar navbar-default navbar-fixed-top" ?>">
  <div class="container-fluid">
      <div class="mynve-container">
          <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
              <?php echo $this->Html->link($this->Html->image("uploads/" . Configure::read('LISTING_ID') ."/settings/".Configure::read('Setting.MAIN_LOGO'), ["alt" => "logo", "style" => ""]),['controller' => 'Pages', 'action' => 'display','plugin' => \Cake\Core\Configure::read('Tech.theme_name')], ['class'=>'navbar-brand', 'escape' => false]); ?>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <?php
                  if((isset($header) && $header == "auth") && $this->request->getAttribute('identity') && in_array($this->request->getAttribute('identity')->get('role'), ['teacher', 'student'])){
                    echo $this->element('authmenu');
                  }else{
                    echo $this->cell('Cms.Navigations::navigation', ['options'=> ['Navigations.is_top' => 1]])->render('navigation');
                  }
                ?>
               <!--li>
                  <?= $this->Html->link('Become a Teacher', ['plugin' => 'UserManager', 'controller' => 'Users', 'action' => 'register'], ['escape' => false]); ?>
                    </li-->


              </ul>
              <ul class="nav navbar-nav navbar-right">
                <?php if($this->request->getAttribute('identity')){ ?>
                  <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span><i class="glyphicon glyphicon-user"></i><?= $this->request->getAttribute('identity')->username ?> <i class="glyphicon glyphicon-menu-down"></i></span></a>

                            <ul class="dropdown-menu userdd">
                                <li>
                              <?= $this->Html->link('<i class="glyphicon glyphicon-user"></i> ' . __d('cake_d_c/users', 'My Profile'), ['plugin' => 'UserManager', 'controller' => 'Users', 'action' => 'profile'], ['escape' => false]); ?>
                                </li>

                                <li>
                                  <?= $this->Html->link('<i class="fas fa-share-alt-square"></i> Referrals', ['plugin' => 'UserManager', 'controller' => 'Users', 'action' => 'Referrals'], ['escape' => false]); ?>
                                </li>

                                <li>
                                  <?= $this->Html->link('<i class="fas fa-share-alt-square"></i> Purchase history', ['plugin' => 'Orders', 'controller' => 'Orders', 'action' => 'index'], ['escape' => false]); ?>
                                </li>

                                <!-- <li>
                                  <?= $this->Html->link('<i class="fas fa-share-alt-square"></i> Master Session Registrations', ['plugin' => 'Orders', 'controller' => 'Orders', 'action' => 'session'], ['escape' => false]); ?>
                                </li> -->

                               <!--  <li><a href="MyAccount.html"><i class="glyphicon glyphicon-briefcase"></i>My Account</a></li> -->

                                <li>
                                  <?= $this->Html->link('<i class="glyphicon glyphicon-log-out"></i> ' . __d('cake_d_c/users', 'Sign Out'), ['plugin' => 'UserManager', 'controller' => 'Users', 'action' => 'logout'], ['escape' => false]); ?>
                                 <!--  <a href="#"><i class="glyphicon glyphicon-log-out"></i>Sign Out</a> -->
                                </li>
                            </ul>
                        </li>
                <?php }else{ ?>
                  <li>
                    <?= $this->Html->link(__d('cake_d_c/users', 'Sign In'), ['plugin' => 'UserManager', 'controller' => 'Users', 'action' => 'login'], ['escape' => false]); ?>

                  </li>
                  <li>
                    <?= $this->Html->link(__d('cake_d_c/users', 'Register'), ['plugin' => 'UserManager', 'controller' => 'Users', 'action' => 'register'], ['escape' => false, 'class' => 'loginbtn']); ?>
                  </li>
                <?php } ?>
              </ul>
          </div>
      </div>

  </div>
</nav>
<style type="text/css">
.parent {display: block;position: relative;float: left;}
.parent a{margin: 10px;
color: #1d1d1d;
    font-family: 'Roboto', sans-serif;
    padding: 10px 5px 10px 20px;
    font-size: 13px;
    transition: 0.4s;
}
.parent:hover > ul {display:block;position:absolute;}
.child {display: none;}
.child li {background-color: #E4EFF7;line-height: 30px;border-bottom:#CCC 1px solid;border-right:#CCC 1px solid; width:100%;}
.child li a{color: #000000;}
ul{list-style: none;margin: 0;padding: 0px;
    border-color: none;
    border-radius: 5px;
    min-width: 225px;}
ul ul ul{left: 100%;top: 0;margin-left:1px;}
li:hover {}
.parent li:hover {background: #f5f5f5;}
.expand{font-size:12px;float:right;margin-right:5px;}

</style>
