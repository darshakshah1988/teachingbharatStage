<?php
use Cake\Core\Configure;

$this->layout = 'CustomTheme.auth';
?>
<!-- in /templates/Users/login.php -->
<div class="col-md-7 d-flex align-items-center flex-wrap">
    <?= $this->Form->create($adminUser) ?>
        <div class="full-wdth">
            <h1>Reset Your password ?</h1>
            <?php
            //dump($adminUser);
            ?>
            <?= $this->Flash->render() ?>
            <div class="form-group inp-field d-flex align-items-center flex-wrap">
                <?php echo $this->Html->image('CustomTheme./images/password-icon.png') ?>
                    <div class="flex">
                        <?= $this->Form->control('password', ['value'=>!empty($this->request->getData('password'))?$this->request->getData('password') : "", 'required' => false, 'class' => 'form-control', 'placeholder' => 'Enter your password', 'templates' => [
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
                <?= $this->Form->submit(__('Reset'), ['class' => 'signin-btn']); ?>
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