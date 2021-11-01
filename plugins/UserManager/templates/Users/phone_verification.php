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
					<p>We will send you an <strong>One Time Password</strong> on this mobile number.</p>
				</div>
				<div class="col-md-12">
					<?= $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'sendPhoneVerifyOtp', $userProfile->id ?? null],'role' => 'form', 'enctype' => 'multipart/form-data', 'templates' => 'horizontal_form']) ?>
						<div class="form-group">
							<label>Enter Mobile Number</label>
							<input type="text" class="form-control mytbox" value="<?= $userProfile->mobile ?? "" ?>" name="mobile" placeholder="" required />
						</div>
						 <?= $this->Form->button(__d('cake_d_c/users', 'GET OTP'), ['class' => 'btn btn-block mybtn']); ?>
					</form>
				</div>
				<div class="col-md-12 LoginFS">
					<a href="/register">Back</a>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
echo $this->Html->css(['/assets/plugins/dropify-master/dist/css/dropify.min.css'],['block' => true]);
echo $this->Html->script('https://use.fontawesome.com/fbf7ab0391.js',['block' => true]);
 ?>
