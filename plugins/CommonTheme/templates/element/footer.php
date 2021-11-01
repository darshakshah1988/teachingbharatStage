<?php 
use Cake\Core\Configure;
?>
<!-- Footer -->
  <footer id="footer" class="footer pb-0" data-bg-img="images/footer-bg.png" data-bg-color="#25272e">
    <div class="container pb-20">
      <div class="row multi-row-clearfix">
        <div class="col-sm-6 col-md-3">
          <div class="widget dark"> 
            <?php //echo $this->Html->link($this->Html->image("logo-2.png", ["alt" => "logo"]),['controller'=>'Pages','action'=>'display','plugin' => 'CommonTheme'],['escape'=>false, 'class'=>'']); ?>

            <?php echo $this->Html->link($this->Html->image("uploads/" . Configure::read('LISTING_ID') ."/settings/".Configure::read('Setting.MAIN_LOGO'), ["alt" => "logo", "style" => "max-height:100px;"]),['controller' => 'Pages', 'action' => 'display','plugin' => \Cake\Core\Configure::read('Tech.theme_name')], ['class'=>'', 'escape' => false]); ?>

            <p class="font-12 mt-20 mb-10">
              <?php echo $this->cell('Cms.Page', [ 'options' => ['slug' => 'welcome-page']])->render('footer'); ?>
          </p>
          <?php echo $this->Html->link('<i class="fa fa-angle-double-right text-theme-colored"></i> Read more', ['controller' => 'Pages', 'action' => 'detail', 'welcome-page', 'plugin' => 'Cms'], ['class'=>'text-gray font-12', 'escape' => false]) ?>
            <ul class="styled-icons icon-dark mt-20">
               <?php if(Configure::read('Setting.FACEBOOK_URL')){ ?>
                <li>
                  <a href="<?php echo Configure::read('Setting.FACEBOOK_URL'); ?>" data-bg-color="#3B5998" target="_blank"><i class="fa fa-facebook"></i></a>
                </li>
              <?php } if(Configure::read('Setting.TWITTER_URL')){ ?>
                <li>
                  <a href="<?php echo Configure::read('Setting.TWITTER_URL'); ?>" data-bg-color="#02B0E8" target="_blank"><i class="fa fa-twitter"></i></a>
                </li>
              <?php } if(Configure::read('Setting.INSTAGRAM_URL')){ ?>
                <li>
                  <a href="<?php echo Configure::read('Setting.INSTAGRAM_URL'); ?>" data-bg-color="#05A7E3" target="_blank"><i class="fa fa-instagram"></i></a>
                </li>
                <?php } if(Configure::read('Setting.YOUTUBE_URL')){ ?>
                <li>
                  <a href="<?php echo Configure::read('Setting.YOUTUBE_URL'); ?>" data-bg-color="#A11312" target="_blank"><i class="fa fa-youtube"></i></a>
                </li>
              <?php } ?>
            </ul>
          </div> 
        </div>
        <?php echo $this->cell('Cms.Navigations::navigation',['conditions' => ['Navigations.is_bottom' => 1]])->render('footer'); ?>
        <div class="col-sm-6 col-md-3">
          <div class="widget dark">
            <h5 class="widget-title line-bottom">Quick Contact</h5>
            <ul class="list-border">
              <li><a href="callto:<?php echo Configure::read('Setting.TELEPHONE'); ?>"><?php echo Configure::read('Setting.TELEPHONE'); ?></a></li>
              <li><a href="mailto:<?php echo Configure::read('Setting.ADMIN_EMAIL'); ?>"><?php echo Configure::read('Setting.ADMIN_EMAIL'); ?></a></li>
              <li><a href="#" class="lineheight-20"><?php echo Configure::read('Setting.OFFICE_ADDRESS'); ?></a></li>
            </ul>
            <!-- <p class="text-white mb-5 mt-15">Subscribe to our newsletter</p>
            <form id="footer-mailchimp-subscription-form" class="newsletter-form mt-10">
              <label class="display-block" for="mce-EMAIL"></label>
              <div class="input-group">
                <input type="email" value="" name="EMAIL" placeholder="Your Email"  class="form-control" data-height="37px" id="mce-EMAIL">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-colored btn-theme-colored m-0"><i class="fa fa-paper-plane-o text-white"></i></button>
                </span>
              </div>
            </form> -->
            <!-- Mailchimp Subscription Form Validation-->
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid bg-theme-colored p-20">
      <div class="row text-center">
        <div class="col-md-12">
          <p class="text-white font-11 m-0">Copyright &copy;<?php echo date('Y'); ?> <?php echo Configure::read('Setting.SYSTEM_APPLICATION_NAME'); ?>. All Rights Reserved</p>
        </div>
      </div>
    </div>
  </footer>
  <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>