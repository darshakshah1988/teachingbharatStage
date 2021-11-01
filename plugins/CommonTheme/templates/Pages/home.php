<!-- Section: home -->
<section id="home" class="divider">
<?php 
    $thumb = ['w' => '100', 'h' => '60','fit'=>'crop'];
    $large = ['w' => '1250', 'h' => '450','fit'=>'crop'];
?>
 <div class="container-fluid p-0">

        <!-- Slider Revolution Start -->
        <div class="rev_slider_wrapper">
          <div class="rev_slider" data-version="5.0">
            <ul>
              <?php echo $this->cell('Media.Banner::defaultBanner'); ?> 
            </ul>
          </div><!-- end .rev_slider -->
        </div>
        <!-- end .rev_slider_wrapper -->
   </div>
   
</section>

 <!-- Section: About -->
    <section> 
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <div class="image-carousel">
              <?php echo $this->cell('Media.Banner::banners', [ 'options' => ['banner_id' => \Cake\Core\Configure::read('Setting.ABOUT_US_BANNER')]])->render('carousel'); ?> 
            </div>
          </div>
          <div class="col-sm-12 col-md-6">
            <?php echo $this->cell('Cms.Page', [ 'options' => ['slug' => 'welcome-page']]); ?>
          </div>
        </div>
      </div>
    </section>

<!-- Section: Divider -->
<section class="divider parallax layer-overlay overlay-dark-8" data-bg-img="<?php echo $this->Glide->url("banners/jaipur_school_staff.jpg", ['w' => '1250', 'h' => '300','fit'=>'crop']); ?>">
  <div class="container">
    <div class="section-content">
      <div class="row">
        <div class="col-md-10 col-md-offset-1 text-center">
          <h2 class="text-uppercase font-weight-600 text-white">We responsibility for you 
          Just call at <span class="text-theme-colored"><?php echo \Cake\Core\Configure::read('Setting.TELEPHONE'); ?></span> for emergency service</h2>
          <button type="button" class="btn btn-default btn-theme-colored btn-circled btn-sm qEnqBtn">ADMISSION ENQUIRY</button>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Section: featured project -->
    <section >
      <div class="container">
        <div class="row">

          <div class="col-sm-12 col-md-4 wow fadeInLeft">
            <h4 class="text-uppercase line-bottom mt-0">Latest News</h4>
            <div class="featured-project-carousel owl-nav-top">
             <?php echo $this->cell('News.News'); ?> 
            </div>
          </div>
          <div class="col-sm-12 col-md-4 wow fadeInUp">
            <h4 class="text-uppercase line-bottom mt-0">Events</h4>
            <div class="bxslider bx-nav-top">
              <?php echo $this->cell('Events.Event'); ?> 
            </div>
          </div>
          <div class="col-sm-12 col-md-4 wow fadeInRight">
            <h4 class="text-uppercase line-bottom mt-0">Circulars & Notices</h4>
            <div class="opening-hours">
              <?php echo $this->cell('Announcement.Announcement'); ?> 
              
            </div>
          </div>
        </div>
      </div>
    </section>

<section class="bg-lightest"> 
      <div class="container-fluid">
        <div class="section-title text-center">
          <div class="row">
            <div class="col-md-8 col-md-offset-2">
              <h3 class="text-uppercase mt-0">Top-Class Facilities</h3>
              <div class="title-icon">
                <i class="flaticon-charity pe-7s-network"></i>
              </div>
              <p>Technology-driven classrooms, upgraded libraries with more than 10K books, medical facilities, and extra-curriculum activities make JIS one of the profound schools for learning in Jaipur.</p>
            </div>
          </div>
        </div>
        <div class="row mtli-row-clearfix text-center mt-60">
          <!-- https://www.jisjaipur.in/ -->
        <?php echo $this->cell('Services.Service'); ?> 
        </div>
      </div>
    </section>


<!-- divider: Donate Now -->
    <section class="divider" id="admissionEnquiry" data-bg-img="<?php echo $this->Glide->url("enquiry-banner-01.jpg", ['w' => '900', 'h' => '450','fit'=>'crop']); ?>">
      <div class="container pt-0 pb-0">
        <div class="row">
          <div class="col-md-7">
            <div class="bg-theme-colored-transparent-deep p-40">
              <h4 class="text-uppercase line-bottom text-white">ADMISSION ENQUIRY</h4>
              
              <!-- Paypal Both Onetime/Recurring Form Starts -->
             <!--  <form id="paypal_donate_form_onetime_recurring" class="form-text-white"> -->
                <?= $this->Form->create(null, ['role' => 'form','url' => ['controller' => 'Enquiries', 'action' => 'add', 'plugin' => 'Enquiry'],'id' => 'enquiryForm', 'class' => 'form-text-white', 'templates' => 'default_form']) ?>
                <div class="row">

                  <div class="col-sm-12">
                    <div class="form-group mb-20">
                      <?php echo $this->Form->control('full_name', ['class' => 'form-control', 'placeholder' => __('Your Name*'), 'label' => __('Your Name*')]); ?>
                      
                    </div>
                  </div>

                  <div class="col-sm-12">
                    <div class="form-group mb-20">
                      <?php echo $this->Form->control('mobile', ['class' => 'form-control', 'placeholder' => __('Phone Number*'), 'label' => __('Phone Number*')]); ?>
                    </div>
                  </div>

                  <div class="col-sm-12">
                    <div class="form-group mb-20">
                      <?php echo $this->Form->control('email', ['class' => 'form-control', 'placeholder' => __('Email Address*'), 'label' => __('Email Address*')]); ?>
                     </div>
                  </div>

                  <div class="col-sm-12">
                    <div class="form-group mb-20">
                      <?php echo $this->Form->control('description', ['type' => 'textarea','class' => 'form-control', 'placeholder' => __('Message'), 'label' => __('Message')]); ?>
                    </div>
                  </div>

                  <div class="col-sm-12">
                    <div class="form-group mb-20">
                      <?php echo $this->Form->button(__('Submit Enquiry'), ['type' => 'submit','class' => 'btn btn-flat btn-dark mt-10 pl-30 pr-30', 'title' => __('Submit'), 'escapeTitle' => false, 'data-loading-text' => 'Please wait...']); ?>
                    </div>
                  </div>
                </div>
              <?= $this->Form->end() ?>

            </div>
          </div>
          <div class="col-md-5"> &nbsp;
          </div>
        </div>
      </div>
    </section>


<!-- Section: Volunteer -->
  <section>
    <?php $carouselTeacher = ['w' => '270', 'h' => '270','fit'=>'crop']; ?>
    <div class="container">
      <div class="section-title text-center">
        <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <h3 class="text-uppercase mt-0">Meet Our Best Tutors</h3>
            <div class="title-icon">
              <i class="flaticon-charity pe-7s-users"></i>
            </div>
            <p>One of the most qualified, experienced & dedicated team  with most advanced academic system!</p>
          </div>
        </div>
      </div>
      <div class="section-content">
        <div class="row multi-row-clearfix">
          <div class="col-md-12 text-left sm-text-center">
            <div class="volunteers-carousel owl-nav-top" data-dots="true">
              <div class="item">
                <div class="volunteer maxwidth400">
                  <div class="thumb">
                <?php 
                  echo $this->Glide->image("banners/teachers/team5.jpg", $carouselTeacher, ['class' => 'img-fullwidth']);
                  ?>
                  </div>
                  <div class="overlay">
                    <div class="content text-center">
                      <h4 class="author mb-0"><a href="#" class="text-white">Rohan Jonson</a></h4>
                      <h6 class="title text-black font-14 mt-5 mb-15">Joined: May, 15</h6>
                      <ul class="styled-icons icon-gray icon-sm mt-10">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="volunteer maxwidth400">
                  <div class="thumb">
                  <?php 
                  echo $this->Glide->image("banners/teachers/sm-3.jpg", $carouselTeacher, ['class' => 'img-fullwidth']);
                  ?>
                  </div>
                  <div class="overlay">
                    <div class="content text-center">
                      <h4 class="author mb-0"><a href="#" class="text-white">Hanuman Yadav</a></h4>
                      <h6 class="title text-black font-14 mt-5 mb-15">Joined: May, 15</h6>
                      <ul class="styled-icons icon-gray icon-sm mt-10">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="volunteer maxwidth400">
                  <div class="thumb">
                  <?php 
                  echo $this->Glide->image("banners/teachers/1.png", $carouselTeacher, ['class' => 'img-fullwidth']);
                  ?>
                  </div>
                  <div class="overlay">
                    <div class="content text-center">
                      <h4 class="author mb-0"><a href="#" class="text-white">Mahendra</a></h4>
                      <h6 class="title text-black font-14 mt-5 mb-15">Joined: May, 15</h6>
                      <ul class="styled-icons icon-gray icon-sm mt-10">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="volunteer maxwidth400">
                  <div class="thumb">
                <?php 
                  echo $this->Glide->image("banners/teachers/red.jpg", $carouselTeacher, ['class' => 'img-fullwidth']);
                  ?>
                  </div>
                  <div class="overlay">
                    <div class="content text-center">
                      <h4 class="author mb-0"><a href="#" class="text-white">Alex Jacobson</a></h4>
                      <h6 class="title text-black font-14 mt-5 mb-15">Joined: May, 15</h6>
                      <ul class="styled-icons icon-gray icon-sm mt-10">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="volunteer maxwidth400">
                  <div class="thumb">
                    <?php 
                  echo $this->Glide->image("banners/teachers/3.png", $carouselTeacher, ['class' => 'img-fullwidth']);
                  ?>
                  </div>
                  <div class="overlay">
                    <div class="content text-center">
                      <h4 class="author mb-0"><a href="#" class="text-white">Alex Jacobson</a></h4>
                      <h6 class="title text-black font-14 mt-5 mb-15">Joined: May, 15</h6>
                      <ul class="styled-icons icon-gray icon-sm mt-10">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>



<section class="divider parallax layer-overlay text-center overlay-dark-8" data-bg-img="<?php echo $this->Glide->url("banners/jaipur_school_staff.jpg", ['w' => '1900', 'h' => '1200','fit'=>'crop']); ?>">
  <div class="container pt-120 pb-120">
    <div class="row">
          <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
            <div class="funfact text-center">
              <i class="pe-7s-smile mt-5 text-theme-colored"></i>
              <h2 data-animation-duration="2000" data-value="5248" class="animate-number text-theme-colored mt-0 font-48">0</h2>
              <h5 class="text-white text-uppercase mb-0">Happy Students</h5>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
            <div class="funfact text-center">
              <i class="pe-7s-note2 mt-5 text-theme-colored"></i>
              <h2 data-animation-duration="2000" data-value="675" class="animate-number text-theme-colored mt-0 font-48">0</h2>
              <h5 class="text-white text-uppercase mb-0">Our Courses</h5>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-3 mb-md-50">
            <div class="funfact text-center">
              <i class="pe-7s-users mt-5 text-theme-colored"></i>
              <h2 data-animation-duration="2000" data-value="248" class="animate-number text-theme-colored mt-0 font-48">0</h2>
              <h5 class="text-white text-uppercase mb-0">Our Teachers</h5>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-3 mb-md-0">
            <div class="funfact text-center">
              <i class="pe-7s-cup mt-5 text-theme-colored"></i>
              <h2 data-animation-duration="2000" data-value="24" class="animate-number text-theme-colored mt-0 font-48">0</h2>
              <h5 class="text-white text-uppercase mb-0">Awards Won</h5>
            </div>
          </div>
        </div>
  </div>
</section>

<!-- Section: Gallery -->
<section id="gallery" class="">
  <div class="container">
    <div class="section-content">
      <div class="row">
        <div class="col-md-7 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.3s">
          <h3 class="text-uppercase title line-bottom mt-0 mb-30"><i class="fa fa-calendar text-gray-darkgray mr-10"></i>Photo <span class="text-theme-colored">Gallery</span></h3>
          <!-- Portfolio Gallery Grid -->

          <div class="gallery-isotope grid-3 gutter clearfix" data-lightbox="gallery">

            
            <?php echo $this->cell('Media.Banner::defaultGallery'); ?>
            
          </div>
          <!-- End Portfolio Gallery Grid -->
        </div>
        <div class="col-md-5 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.3s">
          <h3 class="text-uppercase title line-bottom mt-0 mb-30 mt-sm-40"><i class="fa fa-calendar text-gray-darkgray mr-10"></i>Client <span class="text-theme-colored">Parents Speak</span></h3>

          <div class="bxslider bx-nav-top">
            <?php echo $this->cell('Testimonials.Testimonial'); ?> 
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
$this->assign('title', $metaData['meta_title']);
$this->Html->meta(
    'keywords', $metaData['meta_keyword'], ['block' => true]
);
$this->Html->meta(
    'description', $metaData['meta_description'], ['block' => true]
);
?>
<?php 
echo $this->Html->css(['/assets/charity/js/revolution-slider/css/settings', '/assets/charity/js/revolution-slider/css/layers', '/assets/charity/js/revolution-slider/css/navigation','/assets/plugins/jquery-confirm-v3.3.4/dist/jquery-confirm.min'],['block' => true]);
echo $this->Html->script(['/assets/charity/js/revolution-slider/js/jquery.themepunch.tools.min.js', '/assets/charity/js/revolution-slider/js/jquery.themepunch.revolution.min.js', 'common', 'Inquiry', '/assets/plugins/jquery-confirm-v3.3.4/dist/jquery-confirm.min.js'],['block' => true]);
 ?>
 <style type="text/css">
   #enquiryForm span.invalid-feedback{color: #FFF}
 </style>
<script>
<?php $this->Html->scriptStart(['block' => true]); ?>
 $formFubmit = new Inquiry();
$(document).on("submit","form#enquiryForm ", function(event){
      event.preventDefault();
      $formFubmit.submitEnquiry($(this));

});


$(document).ready(function(e) {
            $(".rev_slider").revolution({
              sliderType:"standard",
              sliderLayout: "auto",
              dottedOverlay: "none",
              delay: 5000,
              navigation: {
                  keyboardNavigation: "off",
                  keyboard_direction: "horizontal",
                  mouseScrollNavigation: "off",
                  onHoverStop: "off",
                  touch: {
                      touchenabled: "on",
                      swipe_threshold: 75,
                      swipe_min_touches: 1,
                      swipe_direction: "horizontal",
                      drag_block_vertical: false
                  },
                  arrows: {
                      style: "gyges",
                      enable: true,
                      hide_onmobile: false,
                      hide_onleave: true,
                      hide_delay: 200,
                      hide_delay_mobile: 1200,
                      tmp: '',
                      left: {
                          h_align: "left",
                          v_align: "center",
                          h_offset: 0,
                          v_offset: 0
                      },
                      right: {
                          h_align: "right",
                          v_align: "center",
                          h_offset: 0,
                          v_offset: 0
                      }
                  },
                  bullets: {
                    enable:true,
                    hide_onmobile:true,
                    hide_under:960,
                    style:"zeus",
                    hide_onleave:false,
                    direction:"horizontal",
                    h_align:"right",
                    v_align:"bottom",
                    h_offset:80,
                    v_offset:50,
                    space:5,
                    tmp:'<span class="tp-bullet-image"></span><span class="tp-bullet-imageoverlay"></span><span class="tp-bullet-title">{{title}}</span>'
                }
              },
              responsiveLevels: [1240, 1024, 778, 480],
              visibilityLevels: [1240, 1024, 778, 480],
              gridwidth: [1170, 1024, 778, 480],
              gridheight: [550, 768, 960, 720],
              lazyType: "none",
              parallax: {
                  origo: "slidercenter",
                  speed: 1000,
                  levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 46, 47, 48, 49, 50, 100, 55],
                  type: "scroll"
              },
              shadow: 0,
              spinner: "off",
              stopLoop: "on",
              stopAfterLoops: 0,
              stopAtSlide: -1,
              shuffle: "off",
              autoHeight: "off",
              fullScreenAutoWidth: "off",
              fullScreenAlignForce: "off",
              fullScreenOffsetContainer: "",
              fullScreenOffset: "0",
              hideThumbsOnMobile: "off",
              hideSliderAtLimit: 0,
              hideCaptionAtLimit: 0,
              hideAllCaptionAtLilmit: 0,
              debugMode: false,
              fallbacks: {
                  simplifyAll: "off",
                  nextSlideOnWindowFocus: "off",
                  disableFocusListener: false,
              }
            });
          });
<?php $this->Html->scriptEnd(); ?>
</script>