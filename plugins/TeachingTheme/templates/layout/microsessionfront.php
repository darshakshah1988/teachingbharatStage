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
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?= $this->Html->charset() ?>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
        <meta name="author" content="Hanuman Yadav" />
        <title>
            <?= $this->fetch('title') ?>
        </title>
        <meta name="csrf-token" content="<?php echo $this->request->getAttribute('csrfToken'); ?>">
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?= $this->fetch('meta') ?>
        <?php echo $this->Html->meta( "img/uploads/" . Configure::read("LISTING_ID") . '/settings/' . Configure::read("Setting.MAIN_FAVICON"), "img/uploads/" . Configure::read("LISTING_ID") . '/settings/' . Configure::read("Setting.MAIN_FAVICON"), ['type' => 'icon']); ?>

        <?php
            echo $this->Html->css([
                'bootstrap.css',
                'micro/Dstyle.css',
                'micro/micro_courses.css',
                'micro/animate.css',
                'micro/owl.carousel.min.css',
                'micro/owl.theme.default.min.css' 
           ]);
        ?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Lobster" rel="stylesheet" />

    <?= $this->fetch('css') ?>
       
    </head>
    <body>
        
        
          <?php echo $this->element("header"); ?> 
        <!-- Start main-content -->
        <?= $this->fetch('content') ?>
       
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <?php 
        echo $this->Html->script([
            'micro/wow.min.js',
            'micro/jquery.min',
            'micro/bootstrap.min.js',
            'micro/custom.js',
            'micro/owl.carousel.js',
            'common-ready',
            // '/assets/plugins/jquery-confirm-v3.3.4/dist/jquery-confirm.min.js',
            // '/assets/plugins/ladda-bootstrap-master/dist/spin.min',
//            '/assets/plugins/ladda-bootstrap-master/dist/ladda.min',
         ]);
        ?>
        <script>
             new WOW().init();
        </script>
<script>
    $('.owl-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:false,
            dots: false,
            autoplay: true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:5
                }
            }
        });  
</script>

         <?php echo $this->fetch('script'); ?> 
          <?php echo $this->element("footer"); ?>
    </body>
</html>
