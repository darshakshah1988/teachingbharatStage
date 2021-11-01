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
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
       <style>
            /** 
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
            @page {
                margin: 0 0;
                width: 800px;
                height: 800px;
            }

            /** Define now the real margins of every page in the PDF **/
            body {
               margin: 0 0;
			   font-family:Arial, Helvetica, sans-serif;
            }
			/*.mainBg{ 
				background:url(<?= $this->Url->image('TeachingTheme.certificate.jpg', ['fullBase' => true,]); ?>);
                background-repeat:no-repeat;
                background-position: top center;
                width: 900px;
                height: 750px;
				margin:auto;
                background-size: contain;
			 }*/
             .mainBg{ 
                background:url("<?= WWW_ROOT . "img/certificate.jpg" ?>");
                background-repeat:no-repeat;
                background-position: top center;
                /*background-size: cover;
                background-size: 1100px 1000px;*/
                width: 900px;
                height: 750px;
                margin:auto;
                background-size: contain;
             }
			.clear{clear:both; }

            .certificate-main{ padding-top: 190px; text-align: center; }

            .certificate-main .cetify-label {
                font-size: 19px;
                color: #be9d58;
                text-transform: uppercase;
            }
            .certificate-main .certify-name {
                font-size: 32px;
                color: #000000;
                padding: 0px 20px;
            }
            .certify-des {
                font-size: 13px;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <?= $this->fetch('content') ?>
    </body>
</html>
