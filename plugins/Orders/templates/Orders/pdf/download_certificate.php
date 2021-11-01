<?php
use Cake\I18n\Date;
use Cake\I18n\I18n;
use Cake\Chronos\Chronos;
use Cake\Core\Configure;
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $order
 */
$this->layout = "TeachingTheme.certificate";
?>
<div class="container mainBg">
        <div class="col-sm-12 certificate-main">
            <p class="cetify-label">This to certify that</p>
            <h2 class="certify-name">
                <span style="border-bottom: 0.5px solid #000000;"><?= $order->user->name ?></span>
            </h2>
            <p class="certify-des" style="width: 70%; margin: auto;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, <b><?= implode(", ", $order_courses) ?></b> incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat</p>
        </div>
        <div class="dateNsign">
            <table style="margin-top: 10px;">
                <tr>
                    <td style="font-size: 13px;"> &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp; 
                        <?= date('j M, Y') ?>
                    </td>
                    <td style="font-size: 13px;"> &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp;   &nbsp; &nbsp;   &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                        <img src="<?= WWW_ROOT . "img/sign.png" ?>" height="42" style="height: 38px">
                    </td>
                </tr>
            </table>
        </div>
</div>

