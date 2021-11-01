<?php
use Cake\Core\Configure;

$this->layout = 'CustomTheme.auth';
?>
<!-- in /templates/Users/login.php -->
<div class="col-md-7 d-flex align-items-center flex-wrap">
    <?= $this->Form->create() ?>
        <div class="full-wdth">
            <h1>Welcome</h1>
            <p>Sign in to continue with your email id and password</p>
            <?= $this->Flash->render() ?>
            <div class="form-group inp-field d-flex align-items-center flex-wrap">
                    <?php echo $this->Html->image('CustomTheme./images/email-icon.png') ?>
                    <div class="flex">
                        <?= $this->Form->control('email', ['required' => false, 'class' => 'form-control', 'placeholder' => 'Enter your Login Email ID', 'templates' => [
                                'input' => '<input type="{{type}}" name="{{name}}"{{attrs}}/>',
                                'inputContainer' => '{{content}}',
                                'formGroup' => '{{label}}{{input}}{{error}}',
                                'label' => '<label {{attrs}}>{{text}}</label>',
                            ]]) ?>
                    </div>
            </div>
            <div class="form-group inp-field d-flex align-items-center flex-wrap">
                <?php echo $this->Html->image('CustomTheme./images/password-icon.png') ?>
                    <div class="flex">
                        <?= $this->Form->control('password', ['required' => false, 'class' => 'form-control', 'placeholder' => 'Enter your password', 'templates' => [
                                'input' => '<input type="{{type}}" name="{{name}}"{{attrs}}/>',
                                'inputContainer' => '{{content}}',
                                'formGroup' => '{{label}}{{input}}{{error}}',
                                'label' => '<label {{attrs}}>{{text}}</label>',
                            ]]) ?>
                    </div>
            </div>
            <div class="form-group">
                <?= $this->Form->submit(__('Sign In'), ['class' => 'signin-btn']); ?>
            </div>
            <div class="d-flex justify-content-between flex-wrap">
                <div class="check-custom">
                    <?php echo $this->Form->checkbox('remember_me', ['hiddenField' => false, 'id' => 'remember']); ?>
                    <label for="remember">Remember Me</label>
                </div>
                <?php echo $this->Html->link("Forgot Password?", ['controller' => 'AdminUsers', 'action' => 'forgotPassword', 'plugin' => 'AdminUserManager']) ?>
            </div>
        </div>
    <?= $this->Form->end() ?>            
</div>

<?php
$this->assign('title', Configure::read('Setting.SYSTEM_APPLICATION_NAME') . " ERP System Login");
$this->Html->meta(
    'keywords', Configure::read('Setting.SYSTEM_APPLICATION_NAME') . " ERP System Login", ['block' => true]
);
$this->Html->meta(
    'description', Configure::read('Setting.SYSTEM_APPLICATION_NAME') . " ERP System Login", ['block' => true]
);
?>