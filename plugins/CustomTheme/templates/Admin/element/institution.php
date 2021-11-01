<div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
        <div class="nav-sec">           
            <div class="commercial-nav normal-admin-nav d-block">
                <ul class="navbar-nav sub-nav">
                    <li class="nav-item">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Website Management</a>
                        <div class="dropdown-menu">
                            <ul>
                                <li>
                            <?php echo $this->Html->link("Pages", ['controller' => "Pages", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'Cms'], ['class' => 'dropdown-item']) ?>
                           </li>
                            <li>
                            <?php echo $this->Html->link("Modules", ['controller' => "Modules", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'Cms'], ['class' => 'dropdown-item']) ?>
                           </li>
                           <li>
                            <?php echo $this->Html->link("Navigations", ['controller' => "Navigations", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'Cms'], ['class' => 'dropdown-item']) ?>
                           </li>
                           <li>
                            <?php echo $this->Html->link("Banners", ['controller' => "Medias", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'Media', '?' => ['type' => 'banner']], ['class' => 'dropdown-item']) ?>
                           </li>
                           <!-- <li>
                            <?php echo $this->Html->link("Photo Gallery", ['controller' => "Medias", 'action' => 'gallery', 'prefix' => 'Admin', 'plugin' => 'Media', '?' => ['type' => 'gallery']], ['class' => 'dropdown-item']) ?>
                           </li>
                           <li>
                            <?php echo $this->Html->link("Downloads", ['controller' => "Medias", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'Media', '?' => ['type' => 'download']], ['class' => 'dropdown-item']) ?>
                           </li> -->
                           <li>
                            <?php echo $this->Html->link("Testimonials", ['controller' => "Testimonials", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'Testimonials'], ['class' => 'dropdown-item']) ?>
                           </li>
                             </ul>
                        </div>
                    </li>
                   <!--  <li class="nav-item">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Collaboration</a>
                        <div class="dropdown-menu">
                            <ul>
                                <li>
                                    <?php echo $this->Html->link("Institution News", ['controller' => "Newsposts", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'News'], ['class' => 'dropdown-item']) ?>
                                </li>
                                <li>
                                    <?php echo $this->Html->link("Institution Events", ['controller' => "Events", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'Events'], ['class' => 'dropdown-item']) ?>
                                </li>
                                <li>
                                    <?php echo $this->Html->link("Circulars & Notices", ['controller' => "Announcements", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'Announcement'], ['class' => 'dropdown-item']) ?>
                                </li>
                             </ul>
                        </div>
                    </li> -->
                    <li class="nav-item">
                        <a href="#">Attendance</a>
                    </li>
                    <li class="nav-item">
                        <?php echo $this->Html->link("Inquiries", ['controller' => "Enquiries", "action" => "index", 'plugin' => 'Enquiry', 'prefix' => 'Admin'], ['class' => '']) ?>
                    </li>
                    <!-- <li class="nav-item">
                        <a href="#">Invoices</a>
                    </li>
                    <li class="nav-item">
                        <?php echo $this->Html->link("Facilities", ['controller' => "Services", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'Services'], ['class' => '']) ?>
                    </li>
                    
                    <li class="nav-item">
                        <a href="#">Reports</a>
                    </li>
                   
                    <li class="nav-item">
                        <a href="#">Document Repository</a>
                    </li> -->
                </ul>
            </div>
        </div>      
      </div>