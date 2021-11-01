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

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <?= $this->fetch('meta') ?>
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

   <link href="https://fonts.googleapis.com/css?family=Poppins:200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i&display=swap" rel="stylesheet">
   <?php
        echo $this->Html->css([
            'CustomTheme.bootstrap.min',
            'CustomTheme.style',
            'CustomTheme.responsive', 
       ]);
    ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
<div class="login-bg d-flex justify-content-center align-items-center flex-wrap">
    <div class="login-sec">
        <div class="row">
            <div class="col-md-6 d-flex justify-content-center align-items-center flex-wrap">
                <!-- <img src="images/logo.png" alt="" class="logo-login-page"> -->
                <?php echo $this->Html->image('CustomTheme.cake-php-img.png', ['class' => 'logo-login-page']) ?>
            </div>
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </div>
</div>
 <?php
        echo $this->Html->script([
            'CustomTheme.jquery-2.2.3.min',
            'CustomTheme.bootstrap.min'
         ]);
        ?>   
</body>
</html>
