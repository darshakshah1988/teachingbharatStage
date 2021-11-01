<?php 
$this->layout = "authdefault";
?>
<div class="SLoginArea">
        <div class="container">
            <div class="col-md-12">
                <div class="col-md-4 col-md-offset-4 SLbox">
                    <div class="col-md-12 LoginTop">
                        <?= $this->Html->image("LogoIcon.png") ?>
                        <h2>Please enter the new password</h2>
                    </div>
                    <div class="col-md-12">
                        <?= $this->Flash->render() ?>
                        <?= $this->Flash->render('auth') ?>
                        <?= $this->Form->create($user, ['templates' => 'bootstrap_validation']) ?>
                           <?php if ($validatePassword) : ?>
                                <div class="form-group">
                                    <?= $this->Form->control('current_password', [
                                        'type' => 'password',
                                        'required' => true,
                                        'label' => __d('cake_d_c/users', 'Current password'),
                                        'class' => 'form-control',
                                        'placeholder' => 'Current password']);
                                    ?>
                                </div>
                                <?php endif; ?>      
                            <div class="form-group">
                                    <?= $this->Form->control('password', [
                                    'type' => 'password',
                                    'required' => true,
                                    'label' => __d('cake_d_c/users', 'New password'),
                                    'class' => 'form-control',
                                    'placeholder' => 'New password']);
                                ?>
                                </div>
                                <div class="form-group">
                                    <?= $this->Form->control('password_confirm', [
                                    'type' => 'password',
                                    'required' => true,
                                    'label' => __d('cake_d_c/users', 'Re-type Password'),
                                    'class' => 'form-control',
                                    'placeholder' => 'Re-type Password']);
                                ?>
                                </div>
                            <?= $this->Form->button(__d('cake_d_c/users', 'Submit'), ['class' => 'btn btn-block mybtn']); ?>
                        <?= $this->Form->end() ?>
                    </div>
                    
                </div>
            </div>
        </div>
  </div>
  <?php /* ?>
<div class="users form">
    <?= $this->Flash->render('auth') ?>
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __d('cake_d_c/users', 'Please enter the new password') ?></legend>
        <?php if ($validatePassword) : ?>
            <?= $this->Form->control('current_password', [
                'type' => 'password',
                'required' => true,
                'label' => __d('cake_d_c/users', 'Current password')]);
            ?>
        <?php endif; ?>
        <?= $this->Form->control('password', [
            'type' => 'password',
            'required' => true,
            'label' => __d('cake_d_c/users', 'New password')]);
        ?>
        <?= $this->Form->control('password_confirm', [
            'type' => 'password',
            'required' => true,
            'label' => __d('cake_d_c/users', 'Confirm password')]);
        ?>

    </fieldset>
    <?= $this->Form->button(__d('cake_d_c/users', 'Submit')); ?>
    <?= $this->Form->end() ?>
</div>
<?php */ ?>