<?php
use Cake\I18n\Date;
use Cake\I18n\I18n;
use Cake\Chronos\Chronos;
use Cake\Core\Configure;
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $order
 */
$this->layout = "authdefault";
?>
<div class="new-header-style-1">
    <div class="container">
        <div class="col-sm-12 text-center">
            <h2>CERTIFICATE</h2>
            <!-- <p><?= $order->id ?> CBSE 10th | 10th July, 2020</p> -->
        </div>
    </div>
</div>

<section class="new-grey">
        <div class="container">
            <div class="col-sm-12 mb40">
                <?= $this->Flash->render() ?>
                <div class="col-sm-12 certificate-main">
                    <?php echo $this->Html->image("certificate.jpg", ['class' => 'certi-main-img']) ?>
                    <p class="cetify-label">This to certify that</p>
                    <h2 class="certify-name"><?= $order->user->name ?></h2>
                    <p class="certify-des">Lorem ipsum dolor sit amet, consectetur adipiscing elit, <b><?= implode(", ", $order_courses) ?></b> incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat</p>
                    <div class="signNdate" style="position: absolute; top: 75%; width: 100%">
                        <div style="float: left; margin-top: 12px; margin-left: 23%;">
                            <?= date('j M, Y') ?>
                        </div>
                        <div style="float: right; margin-right: 227px;">
                            <?php echo $this->Html->image("sign.png", ['class' => '', 'style' => 'height:42px;']) ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 text-center mt30 mb40">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

                    <div class="col-sm-12 certy-buttons">
                        <?= $this->Html->link('<i class="glyphicon glyphicon-save"></i> Download certificate', ['controller' => 'Orders', 'action' => 'downloadCertificate', $order->id], ['escape' => false]) ?>

                        <?= $this->Html->link('<i class="glyphicon glyphicon-share-alt"></i> Email certificate', ['controller' => 'Orders', 'action' => 'emailCertificate', $order->id], ['escape' => false]) ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

