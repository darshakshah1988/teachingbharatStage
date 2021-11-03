<?php 
use Cake\Core\Configure;
?>
<li><?= $this->Html->link('Dashboard', ['controller' => 'Dashboard', 'action' => 'index', 'plugin' => 'UserManager']) ?></li>
<?php if($this->request->getAttribute('identity')->get('role') == "student"){ ?>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Explore</a>
    <?= $this->cell('Cms.Navigations::boards') ?>
</li>
<?php } if($this->request->getAttribute('identity')->get('role') == "student"){ ?>
    <li>
            <?= $this->Html->link('Live Classes <sup class="menu-sup">New</sup>', ['controller' => 'Courses', 'action' => 'sessions', 'plugin' => 'Courses'], ['escape' => false]) ?>
       </li>
       <?php

       echo $this->element('sessionsmenu');

       ?>
    <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
        My Content
    </a>
    <ul class="dropdown-menu">
        <li>
             <?= $this->Html->link('Microsession', ['controller' => 'MicroSessions', 'action' => 'microsessionslist', 'plugin' => 'MicroSessions']) ?>
         </li>
       <li>
            <?= $this->Html->link('My Courses', ['controller' => 'Courses', 'action' => 'CourseList', 'plugin' => 'Courses']) ?>
        </li>
       <li>
        <?= $this->Html->link('Master Session', ['controller' => 'Courses', 'action' => 'masterSessionList', 'plugin' => 'Courses']) ?>
        </li>
        <li>
            <?= $this->Html->link('My Calendar', ['controller' => 'MicroSessions', 'action' => 'mycalendar', 'plugin' => 'MicroSessions']) ?>
       </li>
    </ul>
</li>



<?php }else{ ?>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
        My Content
    </a>
    <?php
    if($this->request->getParam('action') != 'profile'){ echo $this->element('sessionsmenu'); }
    ?>
    <ul class="dropdown-menu">
       <li>
            <?= $this->Html->link('My Courses', ['controller' => 'Courses', 'action' => 'MyCourses', 'plugin' => 'Courses']) ?>
        </li>
       <li>
            <?= $this->Html->link('Master Session', ['controller' => 'Courses', 'action' => 'masterSessions', 'plugin' => 'Courses']) ?>
       </li>
       <li>
            <?= $this->Html->link('Micro Session', ['controller' => 'MicroSessions', 'action' => 'index', 'plugin' => 'MicroSessions']) ?>
       </li>
       <li>
            <?= $this->Html->link('My Calendar', ['controller' => 'MicroSessions', 'action' => 'mycalendar', 'plugin' => 'MicroSessions']) ?>
       </li>
       <?php
	   	$adminEmails = Configure::read('Setting.KEY');
		$adminEmails = array_map('trim', explode(',',$adminEmails));
        $isAdmin = @$this->getRequest()->getAttribute('identity')->email;
        if(in_array($isAdmin, $adminEmails)){
		  ?>
       <li>
            <?= $this->Html->link('Packages', ['controller' => 'Packages', 'action' => 'index', 'plugin' => 'MicroSessions']) ?>
       </li>
       <?php } ?>


    </ul>
</li>


<!-- <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
        My Package
    </a>
    <ul class="dropdown-menu">
       <li><a href="#">Board</a></li>
        <li><a href="#">Grade</a></li>
        <li><a href="#">Subject</a></li>
        <li><a href="#">Package</a></li>

    </ul>
</li> -->
<?php } ?>
<li><?= $this->Html->link('My Sessions', ['controller' => 'SessionBookings', 'action' => 'index', 'plugin' => 'Sessions']) ?></li>
<li><a href="#">My Subscriptions</a></li>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">More</a>
    <ul class="dropdown-menu">
        <li>
            <?= $this->Html->link("Search Assistant", ['controller' => 'Users', 'action' => 'assistant', 'plugin' => 'UserManager']) ?>
        </li>
        <li><a href="#">Free Resources</a></li>
        <li><a href="#">Content Library</a></li>
        <li><a href="#">WhiteBoard</a></li>
        <li><a href="#">System Check</a></li>
        <li><a href="#">Support</a></li>
    </ul>
</li>
