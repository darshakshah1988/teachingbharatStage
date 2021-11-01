<!--Side Menu starts here-->
<aside class="side-nav navbar-expand-xl">
    <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas2">
        <i class="fa fa-chevron-right"></i>
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
                        <?php /*if($this->request->getAttribute('identity')->is_supper_admin == 1){ ?>
                        <li>
                            <?php echo $this->Html->link("Roles", ['controller' => "Roles", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'AdminUserManager'], ['class' => 'dropdown-item']) ?>
                           </li>
                       <?php } */?>
                           
                           <?php if($this->request->getAttribute('identity')->is_supper_admin == 1){ ?>
                           <li>
                            <?php echo $this->Html->link("Banners", ['controller' => "Medias", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'Media', '?' => ['type' => 'banner']], ['class' => 'dropdown-item']) ?>
                           </li>
                           <?php /* ?>
                           <li>
                            <?php echo $this->Html->link("Photo Gallery", ['controller' => "Medias", 'action' => 'gallery', 'prefix' => 'Admin', 'plugin' => 'Media', '?' => ['type' => 'gallery']], ['class' => 'dropdown-item']) ?>
                           </li>
                           <li>
                            <?php echo $this->Html->link("Downloads", ['controller' => "Medias", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'Media', '?' => ['type' => 'download']], ['class' => 'dropdown-item']) ?>
                           </li>
                           <li>
                            <?php echo $this->Html->link("Testimonials", ['controller' => "Testimonials", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'Testimonials'], ['class' => 'dropdown-item']) ?>
                           </li>
                            <?php */ ?>
                       <?php } ?>

                          <li>
                            <?php echo $this->Html->link("Grades", ['controller' => "GradingTypes", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'Courses'], ['class' => 'dropdown-item']) ?>
                           </li>

                           <li>
                            <?php echo $this->Html->link("Boards", ['controller' => "Boards", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'Courses'], ['class' => 'dropdown-item']) ?>
                           </li>

                           <li>
                            <?php echo $this->Html->link("Teacher Schedules", ['controller' => "TeacherSchedules", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'UserManager'], ['class' => 'dropdown-item']) ?>
                           </li>

                           <li>
                            <?php echo $this->Html->link("Subjects", ['controller' => "Subjects", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'Courses'], ['class' => 'dropdown-item']) ?>
                           </li>

                            <li>
                              <?php echo $this->Html->link("Occupations", 
                              ['controller' => "Occupations", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'UserManager'
                            ], ['class' => 'dropdown-item']) ?>
                             </li>
                            <li>
                            <?php echo $this->Html->link("Courses", ['controller' => "Courses", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'Courses'], ['class' => 'dropdown-item']) ?>
                           </li>

                           <li>
                            <?php echo $this->Html->link("Locations", ['controller' => "Locations", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'Locations'], ['class' => 'dropdown-item']) ?>
                           </li>

                           <li>
                            <?php echo $this->Html->link("Course Reviews", ['controller' => "Reviews", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'Reviews', '?' => ['review_type' => 'course']], ['class' => 'dropdown-item']) ?>
                           </li>

                           <li>
                            <?php echo $this->Html->link("Master Session Review", ['controller' => "Reviews", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'Reviews', '?' => ['review_type' => 'session']], ['class' => 'dropdown-item']) ?>
                           </li>

                           <li>
                            <?php echo $this->Html->link("User Reviews", ['controller' => "Reviews", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'Reviews', '?' => ['review_type' => 'user']], ['class' => 'dropdown-item']) ?>
                           </li>

                           <li>
                            <?php echo $this->Html->link("Promotions", ['controller' => "Coupons", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'Promotions'], ['class' => 'dropdown-item']) ?>
                           </li>
                    </ul>
                </div>
            </li>
             <?php /* ?>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span>
                         <?php echo $this->Html->image('CustomTheme./images/directory-icon.png', ['class' => '']) ?>
                     </span>
                    Listings
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdown03">
                    <ul>
                        <?php if($this->request->getAttribute('identity')->is_supper_admin == 1){ ?>
                        <li>
                            <?php echo $this->Html->link("Listing Types", ['controller' => "ListingTypes", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'Listings'], ['class' => 'dropdown-item']) ?>
                        </li>
                        <li>
                            <?php echo $this->Html->link("Listing categories", ['controller' => "ListingTypeCategories", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'Listings'], ['class' => 'dropdown-item']) ?>
                        </li>
                    <?php } ?>
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
        <?php */ ?>

        <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span>
                         <?php echo $this->Html->image('CustomTheme./images/client-user.png', ['class' => '']) ?>
                     </span>
                    Users
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdown03">
                    <ul>
                        <li>
                            <?php echo $this->Html->link("Teachers", ['controller' => "Users", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'UserManager'], ['class' => 'dropdown-item']) ?>
                        </li>
                        <li>
                            <?php echo $this->Html->link("Students", ['controller' => "Users", 'action' => 'students', 'prefix' => 'Admin', 'plugin' => 'UserManager'], ['class' => 'dropdown-item']) ?>
                        </li>
                   
                    </ul>
                </div>
            </li>
           
        <?php if($this->request->getAttribute('identity')->is_supper_admin == 1){ ?>
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
                           <li>
                            <?php echo $this->Html->link("Navigations", ['controller' => "Navigations", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'Cms'], ['class' => 'dropdown-item']) ?>
                           </li>
                           <?php /* ?>
                           <li>
                            <?php echo $this->Html->link("News", ['controller' => "Newsposts", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'News'], ['class' => 'dropdown-item']) ?>
                           </li>
                           <li>
                            <?php echo $this->Html->link("Events", ['controller' => "Events", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'Events'], ['class' => 'dropdown-item']) ?>
                           </li>
                           <li>
                            <?php echo $this->Html->link("Circulars & Notices", ['controller' => "Announcements", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'Announcement'], ['class' => 'dropdown-item']) ?>
                           </li>
                           <?php */ ?>
                       </ul>
                </div>
            </li>
        <?php } ?>

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
                            <?php echo $this->Html->link("Email Hook", ['controller' => "EmailHooks", "action" => "index", 'plugin' => 'EmailManager', 'prefix' => 'Admin'], ['class' => 'dropdown-item']) ?>
                           </li>
                            <li>
                            <?php echo $this->Html->link("Email Preferences", ['controller' => "EmailPreferences", "action" => "index", 'plugin' => 'EmailManager', 'prefix' => 'Admin'], ['class' => 'dropdown-item']) ?>
                           </li>
                           <li>
                            <?php echo $this->Html->link("Email Templates", ['controller' => "EmailTemplates", "action" => "index", 'plugin' => 'EmailManager', 'prefix' => 'Admin'], ['class' => 'dropdown-item']) ?>
                           </li>
                        <?php if($this->request->getAttribute('identity')->is_supper_admin == 1){ ?>
                           <li>
                            <?php
                                echo $this->Html->link("Email Queue", ['controller' => 'Queue', 'action' => 'index', 'plugin' => 'Queue'], ["class" => "", "escape" => false]);
                                ?>
                           </li>
                           <li>
                            <?php echo $this->Html->link("Enquiries", ['controller' => "Enquiries", "action" => "index", 'plugin' => 'Enquiry', 'prefix' => 'Admin'], ['class' => 'dropdown-item']) ?>
                           </li>
                       <?php } ?>

                    </ul>
                </div>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span>
                        <?php echo $this->Html->image('CustomTheme./images/setting.png', ['class' => '']) ?>
                    </span>
                    Settings
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownsetting">
                    <ul>
                      <li>
                            <?php echo $this->Html->link("Roles", ['controller' => "Roles", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'AdminUserManager'], ['class' => 'dropdown-item']) ?>
                           </li>
                            <li>
                            <?php echo $this->Html->link("Academic Staff", ['controller' => "AdminUsers", 'action' => 'index', 'prefix' => 'Admin', 'plugin' => 'AdminUserManager'], ['class' => 'dropdown-item']) ?>
                           </li>
                            <li>
                                <?php echo $this->Html->link(" Logo/Fav icon", ['controller' => "Settings", "action" => "logos", 'plugin' => 'Settings', 'prefix' => 'Admin'], ['class' => 'dropdown-item']) ?>
                            </li>

                            <li>
                                <?php echo $this->Html->link("Settings", ['controller' => "Settings", "action" => "index", 'plugin' => 'Settings', 'prefix' => 'Admin'], ['class' => 'dropdown-item']) ?>
                            </li>
                            <?php if($this->request->getAttribute('identity')->is_supper_admin == 1){ ?>
                            <li>
                                <?php echo $this->Html->link("Language", ['controller' => "Languages", "action" => "index", 'plugin' => 'Language', 'prefix' => 'Admin'], ['class' => 'dropdown-item']) ?>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </li>
            <li>
                <a href="<?php echo $this->Url->build(['controller' => 'AdminUsers', 'action' => 'logout', 'plugin' => 'AdminUserManager']) ?>">
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
