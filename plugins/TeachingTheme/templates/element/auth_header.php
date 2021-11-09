<?php
use Cake\Core\Configure;
//dump($this->request->getAttribute('identity')->id);
//dump($this->request->getAttribute('identity')->getOriginalData());
?>

<nav class="<?= $this->request->getParam('controller') == "Pages" && $this->request->getParam('action') == "display" ? "navbar navbar-default" : "navbar navbar-default navbar-fixed-top" ?>">
  <div class="container" style="width: 100%">
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

                        <li class="active">
                          <?= $this->Html->link('Dashboard', ['plugin' => 'UserManager', 'controller' => 'Dashboard', 'action' => 'index'], ['escape' => false]); ?>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Offerings</a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Monthly Tuitions</a></li>
                                <li><a href="#">Explore Courses</a></li>
                                <li><a href="#">Clear Doubts Now</a></li>
                            </ul>
                        </li>
                        <li><a href="MySessionBooked.html">My Sessions</a></li>
                        <li><a href="MySubscriptions.html">My Subscriptions</a></li>
                        <li><a href="MyTeachers.html">My Teachers</a></li>
                        <li><a href="MyCalendar.html">My Calendar</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">More</a>
                            <ul class="dropdown-menu">
                                <li><a href="FreeResources.html">Free Resources</a></li>
                                <li><a href="TestList.html">Test / Assignments</a></li>
                                <li><a href="NotesFolders.html">Notes</a></li>
                                <li><a href="TryWhiteboard.html">WhiteBoard</a></li>
                                <li><a href="SystemCheck.html">System Check</a></li>
                                <li><a href="#">Support</a></li>
                            </ul>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">

                        <li class="dropdown">

                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-bell noti"></i></a>

                            <ul class="dropdown-menu notidd">

                                <li><a href="#">New notification text goes here New notification text goes here</a></li>

                                <li><a href="#">New notification text goes here</a></li>

                                <li><a href="#">New notification text goes here</a></li>

                                <li><a href="#">New notification text goes here</a></li>

                            </ul>

                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span><i class="glyphicon glyphicon-user"></i><?= $this->request->getAttribute('identity')->username ?> <i class="glyphicon glyphicon-menu-down"></i></span></a>

                            <ul class="dropdown-menu userdd">
                                <li>
                                  <?= $this->Html->link('<i class="glyphicon glyphicon-user"></i> ' . __d('cake_d_c/users', 'My Profile'), ['plugin' => 'CakeDC/Users', 'controller' => 'Users', 'action' => 'profile'], ['escape' => false]); ?>
                                </li>

                                <li>
                                  <?= $this->Html->link('<i class="fas fa-share-alt-square"></i> ' . __d('cake_d_c/users', 'Referrals'), ['plugin' => 'CakeDC/Users', 'controller' => 'Users', 'action' => 'profile'], ['escape' => false]); ?>
                                </li>

                                <!-- <li><a href="MyAccount.html"><i class="glyphicon glyphicon-briefcase"></i>My Account</a></li>
 -->
                                <li>
                                  <?= $this->Html->link('<i class="glyphicon glyphicon-log-out"></i> ' . __d('cake_d_c/users', 'Sign Out'), ['plugin' => 'CakeDC/Users', 'controller' => 'Users', 'action' => 'logout'], ['escape' => false]); ?>
                                 <!--  <a href="#"><i class="glyphicon glyphicon-log-out"></i>Sign Out</a> -->
                                </li>
                            </ul>
                        </li>

                    </ul>
          </div>
      </div>
  </div>
</nav>
