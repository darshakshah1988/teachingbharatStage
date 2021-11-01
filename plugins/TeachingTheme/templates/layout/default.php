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
                'bootstrap',
                'style',
                '/assets/charity/css/font-awesome.min.css',
                '/assets/charity/css/font-awesome-animation.min',
                'CustomTheme.fontawesome',
                'animate',
                // '/assets/plugins/jquery-confirm-v3.3.4/dist/jquery-confirm.min',
                'custom',
//                '/assets/plugins/ladda-bootstrap-master/dist/ladda.min' 
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
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
        <?php echo $this->element("footer"); ?>
        <?php
        echo $this->Html->script([
            '/assets/charity/js/jquery-2.2.0.min',
            '/assets/charity/js/jquery-ui.min',
            '/assets/charity/js/bootstrap.min',
            'wow.min',
            'custom',
            'common-ready',
            // '/assets/plugins/jquery-confirm-v3.3.4/dist/jquery-confirm.min.js',
            // '/assets/plugins/ladda-bootstrap-master/dist/spin.min',
//            '/assets/plugins/ladda-bootstrap-master/dist/ladda.min',
         ]);
        ?>
        <script>
             new WOW().init();
        </script>
	<!-- 	<script src="js/lib/jquery-1.10.2.js"></script> --></script>
    
		
<script>
  function initFreshChat() {
    window.fcWidget.init({
      token: "5169ced1-5909-4a9f-b627-f4cadbd66f7e",
      host: "https://wchat.in.freshchat.com"
    });
  }
  function initialize(i,t){var e;i.getElementById(t)?initFreshChat():((e=i.createElement("script")).id=t,e.async=!0,e.src="https://wchat.in.freshchat.com/js/widget.js",e.onload=initFreshChat,i.head.appendChild(e))}function initiateCall(){initialize(document,"freshchat-js-sdk")}window.addEventListener?window.addEventListener("load",initiateCall,!1):window.attachEvent("load",initiateCall,!1);
</script>
 <?php echo $this->fetch('script'); ?> 
    </body>
</html>
