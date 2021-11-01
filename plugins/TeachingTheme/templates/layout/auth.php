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
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?= $this->fetch('meta') ?>
        <?php echo $this->Html->meta( "img/uploads/" . Configure::read("LISTING_ID") . '/settings/' . Configure::read("Setting.MAIN_FAVICON"), "img/uploads/" . Configure::read("LISTING_ID") . '/settings/' . Configure::read("Setting.MAIN_FAVICON"), ['type' => 'icon']); ?>

        <?php
            echo $this->Html->css([
                'bootstrap',
                'style',
                'animate',
                '/assets/plugins/jquery-confirm-v3.3.4/dist/jquery-confirm.min',
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
        
        <?php echo $this->element("auth_header"); ?>
        <!-- Start main-content -->
        <?= $this->fetch('content') ?>
        <?php echo $this->element("footer"); ?>
        <?php
        echo $this->Html->script([
            '/assets/charity/js/jquery-2.2.0.min',
            '/assets/charity/js/jquery-ui.min',
            '/assets/charity/js/bootstrap.min',
            'wow.min',
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
        $(document).ready(function () {
            $(window).bind('scroll', function () {
                var navHeight = $(window).height() - 70;
                if ($(window).scrollTop() > navHeight) {
                    $('nav.abt').addClass('fixed');
                }
                else {
                    $('nav.abt').removeClass('fixed');
                }
            });
        });

        $('ul.nav li.dropdown').hover(function () {
            $(this).find('.dropdown-menu').stop(true, true).delay(20).fadeIn(500);
        }, function () {
            $(this).find('.dropdown-menu').stop(true, true).delay(20).fadeOut(500);
        });
        </script>
    </body>
</html>
