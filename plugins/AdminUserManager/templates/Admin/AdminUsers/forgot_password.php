<?php
use Cake\Core\Configure;

$this->layout = 'CustomTheme.auth';
?>
<!-- in /templates/Users/login.php -->
<div class="col-md-7 d-flex align-items-center flex-wrap">
    <?= $this->Form->create() ?>
        <div class="full-wdth">
            <h1>Forgot Password</h1>
            <p>Enter your registered email.</p>
            <?= $this->Flash->render() ?>
            <div class="form-group inp-field d-flex align-items-center flex-wrap">
                    <?php echo $this->Html->image('CustomTheme./images/email-icon.png') ?>
                    <div class="flex">
                        <?= $this->Form->control('email', ['required' => true, 'class' => 'form-control', 'placeholder' => 'Enter your registered email', 'templates' => [
                                'input' => '<input type="{{type}}" name="{{name}}"{{attrs}}/>',
                                'inputContainer' => '{{content}}',
                                'formGroup' => '{{label}}{{input}}{{error}}',
                                'label' => '<label {{attrs}}>{{text}}</label>',
                            ]]) ?>
                    </div>
            </div>
            
            <div class="form-group">
                <?= $this->Form->button(__('Send Password Reset Link'), ['type' => 'submit','class' => 'signin-btn']); ?>
                <?php echo $this->Html->link("Login?", ['controller' => 'AdminUsers', 'action' => 'login', 'plugin' => 'AdminUserManager'], ['class' => 'float-right']) ?>
            </div>
            
        </div>
    <?= $this->Form->end() ?>            
</div>
<?php
$this->assign('title', Configure::read('Setting.SYSTEM_APPLICATION_NAME') . " ERP System");
$this->Html->meta(
    'keywords', Configure::read('Setting.SYSTEM_APPLICATION_NAME') . " ERP System", ['block' => true]
);
$this->Html->meta(
    'description', Configure::read('Setting.SYSTEM_APPLICATION_NAME') . " ERP System", ['block' => true]
);
?>