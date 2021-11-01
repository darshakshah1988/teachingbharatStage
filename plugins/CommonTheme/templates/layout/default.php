<?php

/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Core\Configure;

?>
<!DOCTYPE html>
<html>
    <head>
<?= $this->Html->charset() ?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
        <meta name="author" content="Hanuman Yadav" />
        <title>
            <?= $this->fetch('title') ?>
        </title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?= $this->fetch('meta') ?>
        <?php echo $this->Html->meta( "img/uploads/" . Configure::read("LISTING_ID") . '/settings/' . Configure::read("Setting.MAIN_FAVICON"), "img/uploads/" . Configure::read("LISTING_ID") . '/settings/' . Configure::read("Setting.MAIN_FAVICON"), ['type' => 'icon']); ?>

        <?php
        echo $this->Html->css([
            '/assets/charity/css/bootstrap.min',
            '/assets/charity/css/jquery-ui.min',
            '/assets/charity/css/animate',
            '/assets/charity/css/css-plugin-collections',
            '/assets/charity/css/menuzord-skins/menuzord-bottom-trace.css?1543979586298',
            '/assets/charity/css/style-main',
            '/assets/charity/css/style',
            '/assets/charity/css/preloader',
            '/assets/charity/css/custom-bootstrap-margin-padding',
            '/assets/charity/css/responsive', 
            '/assets/charity/css/colors/theme-skin-red', 
            '/assets/plugins/jquery-confirm-v3.3.4/dist/jquery-confirm.min',
       ]);

        ?>
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

<?= $this->fetch('css') ?>
       
    </head>
    <body class="has-side-panel side-panel-right fullwidth-page side-push-panel">
        
        <div id="wrapper" class="clearfix">
        
            <div id="preloader">
                <div id="spinner">
                <div class="preloader-dot-loading">
                    <div class="cssload-loading"><i></i><i></i><i></i><i></i></div>
                </div>
                </div>
                <div id="disable-preloader" class="btn btn-default btn-sm">Disable Preloader</div>
            </div>
            
                <?php echo $this->element("header"); ?>
                <!-- Start main-content -->
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
                <?php echo $this->element("footer"); ?>

        </div>
        <?php
        echo $this->Html->script([
            '/assets/charity/js/jquery-2.2.0.min',
            '/assets/charity/js/jquery-ui.min',
            '/assets/charity/js/bootstrap.min',
            '/assets/charity/js/jquery-plugin-collection',
            '/assets/plugins/ckeditor/ckeditor',
            '/assets/charity/js/custom',
            '/assets/plugins/jquery-confirm-v3.3.4/dist/jquery-confirm.min.js',
         ]);
        ?>
        <?php echo $this->fetch('script'); ?> 
        <script>
            if(window.location.hash) {
                var hash = window.location.hash.substring(1); //Puts hash in variable, and removes the # character
                   if(hash=="enquiry"){
                        qEnQsc(0);
                        location.hash = '';
                    }else if(hash=="enquiryset"){
                        
                        setTimeout(function(){ qEnQsc(0); }, 1000);
                        location.hash = '';
                    }
                    
                    // if(hash=="gallery"){
                    //     galleryBox(0);
                    //     location.hash = '';
                    // }
            }
        $(document).on("click",".qEnqBtn",function(){
            qEnQsc(0);
        });
    
        function qEnQsc(offset){
            if($(".quickquery").length > 0){
                $('html,body').animate({
                  scrollTop: $(".quickquery").offset().top + offset
                }, 1000);
            }else if($("#admissionEnquiry").length > 0){
            $('html,body').animate({
                  scrollTop: $("#admissionEnquiry").offset().top
                }, 1000);
                $("#admissionEnquiry input#full-name").trigger("click");
            }else{
                window.location.href = "/pages#enquiryset";
            }
        
        }
            <?php /*?>$(function(){
                var current = location.pathname;
                var hashes = '<?= $this->request->getQuery('tags') ?>';
                $('ul.menuzord-menu li').removeClass('active');
                $('ul.menuzord-menu li a').each(function(){
                    var $this = $(this);
                    // if the current path is like this link, make it active
                    if($this.attr('href').indexOf(current) !== -1 && hashes == ""){
                        $this.parent('li').addClass('active');
                    }
                })
            });<?php */?>
            $(function () {
                setNavigation();
            });
            function setNavigation() {
            $('ul.menuzord-menu li').removeClass('active');
                var path = window.location.pathname;
                //console.log(path);
                //path = path.replace(/\/$/, "");
                path = decodeURIComponent(path);
                //console.log(path);
                $("ul.menuzord-menu li a").each(function () {
                    var href = $(this).attr('href');
                    //console.log(href);
                    // if (path.substring(0, href.length) === href) {
                    if (path === href) {
                        //console.log(href.length);
                        //console.log(path.substring(0, href.length));
                        $(this).closest('li').addClass('active');
                        $(this).closest('li.sub-nav').addClass('active');
                        $(this).closest('li.location_nav').addClass('active');
                    }
                });
            }


        </script>
    </body>
</html>
