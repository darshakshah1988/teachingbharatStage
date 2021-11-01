<?php
/**
 * Copyright 2010 - 2020, Cake Development Corporation (https://www.cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2020, Cake Development Corporation (https://www.cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * @var \CakeDC\Users\Model\Entity\User $user
 */
?>

<div class="SLoginArea">
        <div class="container">
            <div class="col-md-12">
                <div class="col-md-4 col-md-offset-4 SLbox">
                    <div class="col-md-12 LoginTop">
                        <?= $this->Html->image("LogoIcon.png") ?>
                        <h2>Forgot Password</h2>
                    </div>
                    <div class="col-md-12">
                    	<?= $this->Flash->render() ?>
                    	<?= $this->Flash->render('auth') ?>
    					<?= $this->Form->create($user, ['templates' => [
                            'inputContainer' => '<div class="input {{type}}{{required}}"><div class="form-group">{{content}}</div></div>', 
                            'input' => '<input type="{{type}}" name="{{name}}"{{attrs}}/><span class="invalid-feedback" role="alert"></span>',
                            'label' => '<label{{attrs}} class="control-label">{{text}}</label>',
                                'formGroup' => '{{label}}{{input}}{{error}}',
                                ]]) ?>
                            <div class="form-group">
                                <label><?= __d('cake_d_c/users', 'Registered Email') ?></label>
                                <?= $this->Form->control('reference', ['class' => 'form-control mytbox', 'placeholder' => 'Registered Email', 'required' => true, 'label' => false]) ?>
                            </div>
                            <?= $this->Form->button(__d('cake_d_c/users', 'Reset Password'), ['class' => 'btn btn-block mybtn']); ?>
                        <?= $this->Form->end() ?>
                    </div>
                    <div class="col-md-12 LoginFS">
                    	<?php echo $this->Html->link(__d('cake_d_c/users', 'Login to your Account'), ['action' => 'login']); ?>
                    </div>
                </div>
            </div>
        </div>
  </div>
