<?php
/**
 * Copyright 2010 - 2019, Cake Development Corporation (https://www.cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2018, Cake Development Corporation (https://www.cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

use Cake\Core\Configure;

?>
<div class="SLoginArea">
        <div class="container">
            <div class="col-md-12">
                <div class="col-md-4 col-md-offset-4 SLbox">
                    <div class="col-md-12 LoginTop">
                        <?= $this->Html->image("LogoIcon.png") ?>
                        <h2>OTP - Verification</h2><br>
                        <p>Enter OTP sent to <strong><?= $userProfile->mobile ?></strong></p>
                    </div>
                    <div class="col-md-12">
                        <?= $this->Form->create($userProfile, ['url' => ['controller' => 'Users', 'action' => 'getPhoneVerificationOtp', $userProfile->id],'role' => 'form', 'enctype' => 'multipart/form-data', 'templates' => 'horizontal_form', 'data-group-name' => 'digits', 'data-group-name' => 'digits', 'data-group-name' => 'digits']) ?>
                            <div class="form-group">
							<input type="hidden" name="new_mobile" value="<?= $userProfile->mobile ?>">
                                <input type="text" name="otp[0]" class="form-control mytbox otp-input" id="digit-1" data-next="digit-2" />
								<input type="text" name="otp[1]" class="form-control mytbox otp-input" id="digit-2" data-next="digit-3" data-previous="digit-1" />
								<input type="text" name="otp[2]" class="form-control mytbox otp-input" id="digit-3" data-next="digit-4" data-previous="digit-2" />
								<input type="text" name="otp[3]" class="form-control mytbox otp-input" id="digit-4"data-previous="digit-3" />
                            </div>
							<?= $this->Form->button(__d('cake_d_c/users', 'VERIFIY & PROCEED'), ['class' => 'btn btn-block mybtn mt20']); ?>
                        </form>
                    </div>
                    <div class="col-md-12 LoginFS">
					<?php echo $this->Html->link('RESEND OTP', ['action' => 'phone_verification',$userProfile->id]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php 
echo $this->Html->css(['/assets/plugins/dropify-master/dist/css/dropify.min.css'],['block' => true]);
echo $this->Html->script('https://use.fontawesome.com/fbf7ab0391.js',['block' => true]);
 ?>