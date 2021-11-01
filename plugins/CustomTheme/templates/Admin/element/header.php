<?php 
use Cake\Core\Configure;
?>
<header class="header">
    <div class="header-top bdr-btm d-flex justify-content-between flex-wrap align-items-center">
        <?php echo $this->Html->link($this->Html->image("uploads/" . Configure::read('LISTING_ID') ."/settings/".Configure::read('Setting.ADMIN_LOGO'), ["alt" => "logo", "style" => "max-height:65px; max-width:100%;"]),['controller' => 'Dashboards', 'action' => 'index', 'plugin' => 'AdminUserManager'], ['class'=>'logo', 'escape' => false]); ?>
        
       <!--  <a href="#" class="logo">
            <?php //echo $this->Html->image('CustomTheme./images/logo.png', ['class' => '']) ?>
        </a> -->
        <div class="header-right navbar-expand-md d-flex flex-wrap">
            <div class="search-sec sep-v">
                <div class="navbar navbar-expand-md">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#Document-Search" aria-controls="Document-Search" aria-expanded="false" aria-label="Toggle navigation"><i class="far fa-file-alt"></i>Document search</button>
                <div class="collapse navbar-collapse" id="Document-Search">
                    <div class="d-flex justify-content-between flex-wrap align-items-center " >
                        <?php echo $this->Html->image('CustomTheme./images/doc-search.png', ['class' => 'search-icon']) ?>
                        <div class="srch-cont flex">
                            <label>Document Search</label>
                            <input type="text" name="search" class="form-control" placeholder="Enter document name...">
                        </div>
                        <button type="button" class="search-btn">
                        <?php echo $this->Html->image('CustomTheme./images/search-arrow.png', ['class' => 'search-icon']) ?>
                           </button>
                    </div>
                </div>
                </div>
            </div>
            <div class="search-sec sep-v">
                <div class="navbar navbar-expand-md">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#search-cont" aria-controls="search-cont" aria-expanded="false" aria-label="Toggle navigation"><i class="fas fa-search"></i>Search</button>
                    <div class="collapse navbar-collapse" id="search-cont">
                        <div class="d-flex justify-content-between flex-wrap align-items-center">
                            <?php echo $this->Html->image('CustomTheme./images/search.png', ['class' => 'search-icon']) ?>
                            <div class="srch-cont flex">
                                <label>Search</label>
                                <input type="text" name="search" class="form-control" placeholder="Name, ID and company name...">
                            </div>
                            <button type="button" class="search-btn">
                            <?php echo $this->Html->image('CustomTheme./images/search-arrow.png', ['class' => '']) ?>
                               
                            </button>
                        </div>
                    </div>
                </div>
            </div>                   
            <div class="notification-sec dropdown d-flex flex-wrap sep-v">
                <a href="JavaScript:Void(0);" class="dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $this->Html->image('CustomTheme./images/notification.png', ['class' => '']) ?>
                    <span class="msg-no">4</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <div class="content-scroll">
                    <ul>
                        <li><a class="dropdown-item" href="#">Menu Option 1</a></li>
                        <li><a class="dropdown-item" href="#">Menu Option 2</a></li>
                        <li><a class="dropdown-item" href="#">Menu Option 3</a></li>
                        <li><a class="dropdown-item" href="#">Menu Option 4</a></li>
                        <li><a class="dropdown-item" href="#">Menu Option 1</a></li>
                        <li><a class="dropdown-item" href="#">Menu Option 2</a></li>
                    </ul>
                    </div>
                    <div class="notification-footer">
                        <a href="#" class="btn-view-all">View All</a>
                    </div>
                </div>
            </div>
            <div class="user-sec dropdown">
                <a href="#" class="name-sec dropdown-toggle d-flex flex-wrap align-items-center" role="button" id="user-droppdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php
                            if ($this->request->getAttribute('identity')->profile_photo && file_exists("img/".$this->request->getAttribute('identity')->image_path . $this->request->getAttribute('identity')->profile_photo)) {
                                 $userPhoto = $this->request->getAttribute('identity')->image_path . $this->request->getAttribute('identity')->profile_photo;
                            }else{
                                $userPhoto = "no_image.gif";
                            }
                            echo $this->Html->image($userPhoto, ['class' => 'user-img', 
                                'style' => 'max-height:97px']);
                             ?>
                     <?php //echo $this->Html->image('CustomTheme./images/user-img.jpg', ['class' => 'user-img']) ?>
                    <span> 
                        <?php echo $this->request->getAttribute('identity')->name;
                            $listRole = [];
                            foreach($this->request->getAttribute('identity')->roles as $hrole){
                                $listRole[] = $hrole->title;
                            }

                         ?>
                        <span class="welcome-txt"><?php echo implode(", ", $listRole); ?></span>
                        
                    </span>
                    <i class="fas fa-ellipsis-v"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="user-droppdown">
                    <ul>
                        <li>
                            <?php echo $this->Html->link("My Profile", ['controller' => 'AdminUsers', 'action' => 'view', $this->request->getAttribute('identity')->id, 'plugin' => 'AdminUserManager'], ['class' => 'dropdown-item']) ?>
                            </li>
                            <li>
                            <?php echo $this->Html->link("Edit Profile", ['controller' => 'AdminUsers', 'action' => 'add', $this->request->getAttribute('identity')->id, 'plugin' => 'AdminUserManager'], ['class' => 'dropdown-item']) ?>
                            </li>
                            <li>
                            <?php echo $this->Html->link("Change Password", ['controller' => 'AdminUsers', 'action' => 'changePassword', 'plugin' => 'AdminUserManager'], ['class' => 'dropdown-item']) ?>
                            </li>
                            <li>
                            <?php echo $this->Html->link("Logout", ['controller' => 'AdminUsers', 'action' => 'logout', 'plugin' => 'AdminUserManager'], ['class' => 'dropdown-item']) ?>
                            </li>
                    </ul> 
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-xl">
      <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
        <i class="fas fa-bars"></i>
      </button>
      <?php 
      if(Configure::read('Tech.listing_type_id') == 1){
        echo $this->element('topNav');
      }else if(in_array(Configure::read('Tech.listing_type_id'), [2, 3, 4, 5])){
        echo $this->element('institution'); 
      }
       ?>
    </nav>  
</header>