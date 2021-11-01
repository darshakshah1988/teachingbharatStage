<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */
use Cake\Core\Configure;
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <?= $this->fetch('meta') ?>
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <meta name="csrf-token" content="<?php echo $this->request->getAttribute('csrfToken'); ?>">

     <?php echo $this->Html->meta( "img/uploads/" . Configure::read("LISTING_ID") . '/settings/' . Configure::read("Setting.MAIN_FAVICON"), "img/uploads/" . Configure::read("LISTING_ID") . '/settings/' . Configure::read("Setting.MAIN_FAVICON"), ['type' => 'icon']); ?>

   <link href="https://fonts.googleapis.com/css?family=Poppins:200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i&display=swap" rel="stylesheet">
   <?php
        echo $this->Html->css([
            'CustomTheme.bootstrap.min',
            'CustomTheme.style',
            'CustomTheme.responsive',
            '/assets/charity/css/font-awesome.min.css',
            '/assets/charity/css/font-awesome-animation.min',
            'CustomTheme.fontawesome',
            'CustomTheme.custom',
            // '/assets/plugins/jquery-confirm-v3.3.4/dist/jquery-confirm.min',
            '/assets/plugins/waitMe/waitMe.min.css',
          //  '/assets/plugins/ladda-bootstrap-master/dist/ladda.min' 
       ]);
    ?>
    <?= $this->fetch('css') ?>
    <style>
        .required label.control-label::after {
            color: #cc0000;
            content: "*";
            font-weight: bold;
            margin-left: 5px;
        }
        label.rmstrict::after {
            content: "";
            font-weight: bold;
            margin-left: 5px;
        }
    </style>

</head>
<body class="commercial-admin">

<!--Header starts here-->
<?php echo $this->element('header'); ?>
<!--Header ends here-->
<?php echo $this->element('sidebar'); ?>

<!--Main Content starts here-->
<div class="main-container">
    <?= $this->fetch('breadcrumb') ?>
    <?= $this->Flash->render() ?>
    <div class="content-sec">
            <?= $this->fetch('content') ?>
    </div>
</div>
<!--Main Content ends here-->

<?php
echo $this->Html->script([
    'CustomTheme.jquery-3.4.1.min.js',
    'CustomTheme.bootstrap.bundle.min',
    'CustomTheme.offcanvas',
    'CustomTheme.responsive-tab',
    'common',
    'common-ready',
    // '/assets/plugins/jquery-confirm-v3.3.4/dist/jquery-confirm.min.js',
    '/assets/plugins/waitMe/waitMe.min.js',
    // '/assets/plugins/ladda-bootstrap-master/dist/spin.min',
//    '/assets/plugins/ladda-bootstrap-master/dist/ladda.min',
    '/assets/plugins/ckeditor/ckeditor',
 ]);
?>
<script type="text/javascript">
            $(function () {
                setNavigation();
            });
            function setNavigation() {
            $('ul.navbar-nav li').removeClass('active');
                var path = window.location.pathname;
                console.log(path);
                //path = path.replace(/\/$/, "");
                path = decodeURIComponent(path);
                //console.log(path);
                $("ul.navbar-nav li a").each(function () {
                    var href = $(this).attr('href');
                    //console.log(href);
                    // if (path.substring(0, href.length) === href) {
                    if (path === href) {
                        //console.log(href.length);
                        //console.log(path.substring(0, href.length));
                        $(this).closest('li.nav-item').addClass('active');
                        $(this).closest('li.sub-nav').addClass('active');
                        //$(this).closest('li.location_nav').addClass('active');
                    }
                });
            }
</script>
<?= $this->fetch('script') ?>
<?= $this->fetch('inlineScript') ?>
</body>
</html>
