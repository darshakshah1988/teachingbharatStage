<?php
//$this->layout = "authdefault";
/**
 * Copyright 2010 - 2019, Cake Development Corporation (https://www.cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2018, Cake Development Corporation (https://www.cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<div class="SLoginArea">
        <div class="container">
            <div class="col-md-12">
                <div class="col-md-8 col-md-offset-2 FTStep">
                    <div class="col-md-12 nopadding">
                        <div class="col-md-3">
                            <?= $this->Html->image('RudraaBot.jpg') ?>
                        </div>
                        <div class="col-md-9">
                            <h2>Hey this is <span>OMM</span>,</h2>
                            <h3>Your Personal Virtual Assistant</h3>
                            <p><span>I'll help you to find the best teacher for you !</span></p>
                        </div>
                        <div class="col-md-12 bottom">
                            <div class="col-md-12 text-center">
                                <?= $this->Html->link("Lets get Start", ['controller' => 'Users', 'action' => 'assistant', 'plugin' => 'UserManager', '?' => ['step' => 'grade']], ['class' => 'nxtbtn']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
$this->assign('title', "Virtual Assistant");
$this->Html->meta(
    'keywords', 'Virtual Assistant', ['block' => true]
);
$this->Html->meta(
    'description', 'Virtual Assistant', ['block' => true]
);

//$this->Html->css(['/assets/plugins/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min'], ['block' => true]);
//$this->Html->script(['/assets/plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min'], ['block' => true])//;
?> 