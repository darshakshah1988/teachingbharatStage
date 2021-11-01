<?php
$this->layout = 'CustomTheme.auth';
?>
<!-- in /templates/Users/login.php -->
<div class="col-md-7 d-flex align-items-center flex-wrap">
    <?= $this->Form->create($adminUser) ?>
        <div class="full-wdth">
            <h1>Create Password</h1>
            <?php
            //dump($adminUser);
            ?>
            <?= $this->Flash->render() ?>
            <div class="form-group inp-field d-flex align-items-center flex-wrap">
                <?php echo $this->Html->image('CustomTheme./images/password-icon.png') ?>
                    <div class="flex">
                        <?= $this->Form->control('password', ['required' => false, 'class' => 'form-control', 'placeholder' => 'Enter your password', 'templates' => [
                                'input' => '<input type="{{type}}" name="{{name}}"{{attrs}}/>',
                                'inputContainer' => '{{content}}',
                                'inputContainerError' => '<div class="form-group"><div class="{{type}}{{required}} error">{{content}}</div></div>',
                                'formGroup' => '{{label}}{{input}}{{error}}',
                                'label' => '<label {{attrs}}>{{text}}</label>',
                            ]]) ?>
                    </div>
            </div>
            <small class="password-instrution">
                <i class="fa fa-info"></i> &nbsp;
                Password should be at least one number, one special character and have a mixture of uppercase and lowercase letters.
            </small>
            <div class="form-group inp-field d-flex align-items-center flex-wrap">
                <?php echo $this->Html->image('CustomTheme./images/password-icon.png') ?>
                    <div class="flex">
                        <?= $this->Form->control('confirm_password', ['required' => false,'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Enter Confirm password', 'templates' => [
                                'input' => '<input type="{{type}}" name="{{name}}"{{attrs}}/>',
                                'inputContainer' => '{{content}}',
                                'inputContainerError' => '<div class="form-group"><div class="{{type}}{{required}} error">{{content}}</div></div>',
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
                <a href="#">Forgot Password?</a>
            </div>
        </div>
    <?= $this->Form->end() ?>            
</div>