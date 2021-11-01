  <?php if(!$announcements->isEmpty()){ 
    ?>
  <ul class="list-border list theme-colored angle-double-right">
    <?php foreach($announcements as $announcement){ ?>
    <li class="clearfix">
      <span>
        <?php echo $this->Html->link($announcement->title, ['controller' => 'Announcements', 'action' => 'index','plugin' => 'Announcement', "#" => $announcement->slug], ['class' => 'text-uppercase_nos']) ?>
      </span>
      <div class="value pull-right flip"> <i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $announcement->created->format(\Cake\Core\Configure::read('Setting.ADMIN_DATE_FORMAT')); ?>  </div>
    </li>
    <?php } ?>
  </ul>
  <?php if($announcements->count() > 8){ 
echo $this->Html->link("View All", ['controller' => 'Announcements', 'action' => 'index','plugin' => 'Announcement'], ['class' => 'btn btn-dark btn-theme-colored btn-xs mt-10 pull-right']);
   } 
 } 
 ?>