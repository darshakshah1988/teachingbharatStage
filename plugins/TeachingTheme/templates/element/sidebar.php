<!--Side Menu starts here-->
<aside class="side-nav navbar-expand-xl">
    <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas2">
        <i class="fas fa-chevron-right"></i>
      </button>
    <div class="nav-sec navbar-collapse offcanvas-collapse2">
        <ul>
            <li>
                <a href="#">
                    <span>
                        <?php echo $this->Html->image('CustomTheme./images/birthday-reminder.png', ['class' => '']) ?>
                       <span class="birthday-reminder">4</span>
                    </span>
                    Upcoming Birthdays
                </a>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span>
                        <?php echo $this->Html->image('CustomTheme./images/masters.png', ['class' => '']) ?>
                     </span>
                    Masters
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdown03">
                    <ul>
                        <li>
                            <?php echo $this->Html->link("Roles", ['controller' => "Roles", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'AdminUserManager'], ['class' => 'dropdown-item']) ?>
                           </li>
                            <li>
                            <?php echo $this->Html->link("Academic Staff", ['controller' => "AdminUsers", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'AdminUserManager'], ['class' => 'dropdown-item']) ?>
                           </li>

                    </ul>
                </div>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span>
                         <?php echo $this->Html->image('CustomTheme./images/directory-icon.png', ['class' => '']) ?>
                     </span>
                    Listings
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdown03">
                    <ul>
                        <li>
                            <?php echo $this->Html->link("Listing Types", ['controller' => "ListingTypes", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'Listings'], ['class' => 'dropdown-item']) ?>
                        </li>
                        <li>
                            <?php echo $this->Html->link("Listing categories", ['controller' => "ListingTypeCategories", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'Listings'], ['class' => 'dropdown-item']) ?>
                        </li>
                        <li>
                            <?php echo $this->Html->link("Listings", ['controller' => "Listings", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'Listings'], ['class' => 'dropdown-item']) ?>
                        </li>
                    </ul>
                </div>
            </li>
            
            <li>
                <a href="#">
                    <span>
                        <?php echo $this->Html->image('CustomTheme./images/assigned-leads.png', ['class' => '']) ?>
                    </span>
                    Assigned Leads
                </a>
            </li>
            
            <li>
                <a href="#">
                    <span>
                        <?php echo $this->Html->image('CustomTheme./images/client-user.png', ['class' => '']) ?>
                    </span>
                    Clients
                </a>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span>
                        <?php echo $this->Html->image('CustomTheme./images/email-template.png', ['class' => '']) ?>
                    </span>
                    CMS Manager
                </a>
                <div class="dropdown-menu" aria-labelledby="">
                    <ul>
                        <li>
                            <?php echo $this->Html->link("Pages", ['controller' => "Pages", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'Cms'], ['class' => 'dropdown-item']) ?>
                           </li>
                            <li>
                            <?php echo $this->Html->link("Modules", ['controller' => "Modules", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'Cms'], ['class' => 'dropdown-item']) ?>
                           </li>
                       </ul>
                </div>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span>
                        <?php echo $this->Html->image('CustomTheme./images/email-template.png', ['class' => '']) ?>
                    </span>
                    Email Template
                </a>
                <div class="dropdown-menu" aria-labelledby="">
                    <ul>
                        <li>
                            <?php echo $this->Html->link("Email Hook", ['controller' => "Roles", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'AdminUserManager'], ['class' => 'dropdown-item']) ?>
                           </li>
                            <li>
                            <?php echo $this->Html->link("Academic Staff", ['controller' => "AdminUsers", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'AdminUserManager'], ['class' => 'dropdown-item']) ?>
                           </li>
                       </ul>
                </div>
            </li>
            
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span>
                        <?php echo $this->Html->image('CustomTheme./images/email-template.png', ['class' => '']) ?>
                    </span>
                    Email Template
                </a>
                <div class="dropdown-menu" aria-labelledby="">
                    <ul>
                        <li>
                            <?php echo $this->Html->link("Email Hook", ['controller' => "Roles", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'AdminUserManager'], ['class' => 'dropdown-item']) ?>
                           </li>
                            <li>
                            <?php echo $this->Html->link("Academic Staff", ['controller' => "AdminUsers", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'AdminUserManager'], ['class' => 'dropdown-item']) ?>
                           </li>
                       </ul>
                </div>
            </li>
            <li>
                <a href="#">
                    <span>
                        <?php echo $this->Html->image('CustomTheme./images/setting.png', ['class' => '']) ?>
                    </span>
                    Settings
                </a>
            </li>
            <li>
                <a href="#">
                    <span>
                        <?php echo $this->Html->image('CustomTheme./images/logout.png', ['class' => '']) ?>
                    </span>
                    Logout
                </a>
            </li>
        </ul>
    </div>
</aside>
<!--Side Menu ends here-->