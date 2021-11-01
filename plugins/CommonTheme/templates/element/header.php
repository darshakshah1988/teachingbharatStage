<?php 
use Cake\Core\Configure;
?>
<!-- Header -->
<header id="header" class="header">
    <div class="header-top bg-deep xs-text-center">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="widget no-border m-0">
              <ul class="styled-icons icon-dark icon-circled icon-theme-colored icon-sm">
                <?php if(Configure::read('Setting.FACEBOOK_URL')){ ?>
                <li>
                  <a href="<?php echo Configure::read('Setting.FACEBOOK_URL'); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                </li>
              <?php } if(Configure::read('Setting.TWITTER_URL')){ ?>
                <li>
                  <a href="<?php echo Configure::read('Setting.TWITTER_URL'); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                </li>
              <?php } if(Configure::read('Setting.INSTAGRAM_URL')){ ?>
                <li>
                  <a href="<?php echo Configure::read('Setting.INSTAGRAM_URL'); ?>" target="_blank"><i class="fa fa-instagram"></i></a>
                </li>
                <?php } if(Configure::read('Setting.YOUTUBE_URL')){ ?>
                <li>
                  <a href="<?php echo Configure::read('Setting.YOUTUBE_URL'); ?>" target="_blank"><i class="fa fa-youtube"></i></a>
                </li>
              <?php } ?>
            </ul>
            </div>
          </div>
          <div class="col-md-9">
            <div class="widget no-border m-0">
              <ul class="list-inline xs-text-center text-right mt-5">
                <li class="m-0 pl-10 pr-10"> <i class="fa fa-phone text-theme-colored"></i> <a class="text-gray" href="callto:<?php echo Configure::read('Setting.TELEPHONE'); ?>"><?php echo Configure::read('Setting.TELEPHONE'); ?></a> </li>
                <li class="m-0 pl-10 pr-10"> <i class="fa fa-envelope-o text-theme-colored"></i> <a class="text-gray" href="mailto:<?php echo Configure::read('Setting.ADMIN_EMAIL'); ?>"><?php echo Configure::read('Setting.ADMIN_EMAIL'); ?></a> </li>
                <li class="sm-display-block mt-sm-10 mb-sm-10">
                  <a class="btn btn-colored btn-flat btn-theme-colored" href="#">Student Login</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
     <div class="header-top p-0 xs-text-center bg-lightest">
      <div class="container pt-0 pb-0">
        <div class="row">
          <div class="col-xs-12 col-sm-3 col-md-3">
            <div class="widget no-border m-0">
              <?php //echo $this->Html->link($this->Html->image("uploads/" . LISTING_ID . '/settings/' . $ConfigSettings['MAIN_LOGO'], ["alt" => "logo"]),['controller'=>'Pages','action'=>'display','plugin' => 'YadavsenaTheme'],['escape'=>false, 'class'=>'menuzord-brand']);
            //echo $this->Html->link($this->Html->image("logo-2.png", ["alt" => "logo"]),['controller'=>'Pages','action'=>'display','plugin' => 'CommonTheme'],['escape'=>false, 'class'=>'menuzord-brand xs-pull-center mb-15']);

             ?>
             <?php echo $this->Html->link($this->Html->image("uploads/" . Configure::read('LISTING_ID') ."/settings/".Configure::read('Setting.MAIN_LOGO'), ["alt" => "logo", "style" => "max-height:65px; max-width:200px;"]),['controller' => 'Pages', 'action' => 'display','plugin' => \Cake\Core\Configure::read('Tech.theme_name')], ['class'=>'menuzord-brand xs-pull-center mb-10', 'escape' => false]); ?>
            </div>
          </div>
          <div class="col-xs-12 col-sm-3 col-md-3">
            <div class="mt-10 mb-10 text-center sm-text-center">
               <?php if(Configure::read('Setting.REGISTRATION_NUMBER')){ ?>
                <nav>
                  <ul class="pager">
                    <li><a href="javascript:void(0)"><?php echo Configure::read('Setting.REGISTRATION_NUMBER'); ?></a></li>
                  </ul>
              </nav>
            <?php } ?>
              </div>
          </div>

          <div class="col-xs-12 col-sm-3 col-md-3">
            <div class="widget no-border m-0">
              <div class="mt-10 mb-10 text-right sm-text-center">
                <div class="font-20 text-black-333 text-uppercase mb-5 font-weight-600"><i class="fa fa-phone-square text-theme-colored font-24"></i> <?php echo Configure::read('Setting.TELEPHONE'); ?></div>
                <a class="font-12 text-gray" href="#">Call us for more details!</a>
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-3 col-md-3">
            <div class="widget no-border m-0">
              <div class="mt-10 mb-10 text-right sm-text-center">
                <div class="font-20 text-black-333 text-uppercase mb-5 font-weight-600"><i class="fa fa-envelope text-theme-colored font-24"></i> Mail us today</div>
                <a class="font-12 text-gray" href="#"> <?php echo Configure::read('Setting.ADMIN_EMAIL'); ?></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="header-nav">
      <div class="header-nav-wrapper navbar-scrolltofixed bg-light">
        <div class="container">
          <nav id="menuzord" class="menuzord red bg-light">
            
           
            <ul class="menuzord-menu">
            <?php echo $this->cell('Cms.Navigations::navigation', ['options'=> ['Navigations.is_top' => 1]])->render('navigation'); ?> 
             <!--    <li><a href="/" class="waves-effect waves-dark">Home Page</a></li>
                <li><a href="/#/about-us" class="waves-effect waves-dark">About Us</a>
                  <ul class="dropdown">
                    <li>
                        <a href="#">VISION</a>
                      </li>
                      <li><a href="#">Mission</a></li>
                      <li><a href="#">Father’s message</a></li>
                      <li><a href="#">Mother’s Message</a></li>
                      <li><a href="#">Chairman's message</a></li>
                      <li><a href="#">Principal's Message</a></li>
                      <li><a href="#">Infrastructure</a></li>
                      <li><a href="#">Our Fraternity</a></li>
                      <li><a href="#">Enrolled Students</a></li>
                      <li><a href="#">Our Staff</a>
                      </li>
                    </ul>
                </li>
                <li><a href="/#/academics" class="waves-effect waves-dark">Academics</a></li>
                <li><a href="/#/admission" class="waves-effect waves-dark">Admission</a></li>
                <li><a href="/#/admission" class="waves-effect waves-dark">Circulars & Notices</a>
                  <ul class="dropdown">
                    <li><a href="#">Announcement</a></li>
                    <li><a href="#">Downloads</a></li>
                    <li><a href="#">Achievements</a></li>
                  </ul>
                </li>
                <li><a href="/#/student-corner" class="waves-effect waves-dark">Student Corner</a></li>
                <li><a href="/#/facilities" class="waves-effect waves-dark">Facilities</a></li>
                <li><a href="/#/gallery" class="waves-effect waves-dark">Media</a>
                  <ul class="dropdown">
                    <li><a href="#">Photo Galler</a></li>
                    <li><a href="#">Video Galler</a></li>
                    <li><a href="#">News/Media Gallery</a></li>
                  </ul>
                </li>
                <li><a href="/#/contact-us" class="waves-effect waves-dark">Contact Us</a></li>
              </ul>
              <ul class="pull-right hidden-sm hidden-xs">
              <li>
                <a class="btn btn-colored btn-flat btn-theme-colored mt-15" href="#">Enroll Now</a>
              </li> -->
            </ul>
            <ul class="pull-right hidden-sm hidden-xs">
              <li>
                <button type="button" class="btn btn-colored btn-flat btn-theme-colored mt-15 qEnqBtn">Enroll Now</button>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </header>
   <!-- divider: Register/login Now -->
    