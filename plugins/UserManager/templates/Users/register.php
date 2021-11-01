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
                <div class="col-md-8 col-md-offset-2 SLbox" id="registration-box">
                    <div class="col-md-12 LoginTop">
                        <?= $this->Html->image("LogoIcon.png") ?>
                        <h2>Student Registration</h2>
                    </div>
                    <div class="col-md-12">
						<?= $this->Flash->render() ?>
                        <?= $this->Flash->render('auth') ?>
                        <?= $this->Form->create($user, ['templates' => 'bootstrap_validation', 'id'=>'register']) ?>
                         
						<div class="row">
                            <div class="col-md-6 form-group">
								<input type="hidden" name="sms_otp" id="sms_otp" value="<?= rand(1000,9999) ?>">
								<input type="hidden" name="is_mobile_verified" id="is_mobile_verified" value=0>
                                <?= $this->Form->control('first_name', ['label' => __d('cake_d_c/users', 'First Name'), 'class' => 'form-control mytbox', 'placeholder' => 'First Name']); ?>
                            </div>
                            <div class="col-md-6 form-group">
                                <?= $this->Form->control('last_name', ['label' => __d('cake_d_c/users', 'Last name'), 'class' => 'form-control mytbox', 'placeholder' => 'Last Name']); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <?= $this->Form->control('email', ['label' => __d('cake_d_c/users', 'Email'), 'class' => 'form-control mytbox', 'placeholder' => 'Your Email']); ?>
								<p id="ErrorMsgEmail" style="color:red"></p>
                            </div>
                            <div class="col-md-6 form-group">
                                <?= $this->Form->control('username', ['label' => __d('cake_d_c/users', 'Username'), 'class' => 'form-control mytbox', 'placeholder' => 'Your Username']); ?>
								<p id="ErrorMsgUname" style="color:red"></p>
                            </div>
                            </div>
                           
                            <div class="row">
                                 <div class="col-md-6 form-group">
                                    <?= $this->Form->control('user_profile.mobile', ['label' => __d('cake_d_c/users', 'Contact Number'), 'class' => 'form-control mytbox', 'placeholder' => 'Your Contact Number']); ?>
									<p id="ErrorMsgMobile" style="color:red"></p>
                                </div>
                                <div class="col-md-6 form-group">
                                <?= $this->Form->control('user_profile.location_id', ['options' => $locations, 'class' => 'form-control mytbox', 'empty' => 'Select Your State', 'label' =>  __d('cake_d_c/users', 'Location')]); ?>    
                             
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-md-6 form-group">
                                <?= $this->Form->control('password', ['label' => __d('cake_d_c/users', 'Password'), 'class' => 'form-control mytbox', 'placeholder' => 'Password']); ?>
								<p id="ErrorMsgPwd" style="color:red"></p>
                            </div>
                            <div class="col-md-6 form-group">
                                <?= $this->Form->control('password_confirm', [
                                    'required' => true,
                                    'type' => 'password',
                                    'label' => __d('cake_d_c/users', 'Confirm password'),
                                    'class' => 'form-control mytbox', 
                                    'placeholder' => 'Confirm password'
                                ]); ?>
								<p id="ErrorMsgCPwd" style="color:red"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3 mt20 mb40">
                                <?= $this->Form->button(__d('cake_d_c/users', 'Submit'), ['class'=>'btn btn-block mybtn', "style"=>"display:none", "id"=>"submitButton"]);
                                ?>
								<?= $this->Form->button(__d('cake_d_c/users', 'Next'), ['class'=>'btn btn-block mybtn', 'type'=>'button', 'id'=>'registerrequired'])
								?>
                            </div>
                        </div>
                        <?= $this->Form->end() ?>
                    </div>
                    <div class="col-md-12 Sslogin">
                        <?= implode(' ', $this->User->socialLoginList()); ?>
                    </div>
                    <div class="col-md-12 nopadding SwpipeLogin">
                        <?php echo $this->Html->link('Already have Account? Login here', ['action' => 'login']) ?>
                    </div>
                </div>
				<div class="col-md-4 col-md-offset-4 SLbox" id="otp-box" style="display:none;">
					 <div class="col-md-12 LoginTop">
                        <?= $this->Html->image("LogoIcon.png") ?>
                        <h2>OTP - Verification</h2><br>
                        <p style="background-color: #008000; color: white;line-height: 35px;">Enter OTP sent to <strong id="otp-number"></strong></p>
                    </div>
                    <div class="col-md-12">
                        <?= $this->Form->create(null) ?>
                            <div class="form-group">
								<input type="hidden" name="new_mobile" id="new_mobile" value="">
                                <input type="text" name="otp[0]" class="form-control mytbox otp-input" id="digit-1" data-next="digit-2" />
								<input type="text" name="otp[1]" class="form-control mytbox otp-input" id="digit-2" data-next="digit-3" data-previous="digit-1" />
								<input type="text" name="otp[2]" class="form-control mytbox otp-input" id="digit-3" data-next="digit-4" data-previous="digit-2" />
								<input type="text" name="otp[3]" class="form-control mytbox otp-input" id="digit-4"data-previous="digit-3" />
                            </div>
							<?= $this->Form->button(__d('cake_d_c/users', 'VERIFIY & PROCEED'), ['class' => 'btn btn-block mybtn mt20','type'=>'button', 'id'=>'verify_proceed']); ?>
                        </form>
                    </div>
                    <div class="col-md-12 LoginFS">
						<div style="float:left;width:50%;text-align: left;">
							<a href="javascript:void(0)" class="back">Back</a>
						</div>
						<div style="float:left;width:50%;">
							<a href="javascript:void(0)" class="resend-otp">Resend OTP</a>
						</div>
                    </div>
				</div>
            </div>
        </div>
    </div>
<?php 
echo $this->Html->css(['/assets/plugins/dropify-master/dist/css/dropify.min.css'],['block' => true]);
echo $this->Html->script('https://use.fontawesome.com/fbf7ab0391.js',['block' => true]);
echo $this->Html->script(['common', 'Users'], ['block' => true]);
 ?>
 <script>
<?php $this->Html->scriptStart(['block' => true]); ?>
$userObj = new Users();

$(document).on("click", "#registerrequired", function(event) {
		var email=$('#email').val();
		
		var pattern = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
		if(email==""){
			$('#ErrorMsgEmail').text('Please enter your Email!');
			$('#email').focus();
			$('#email').css({"border":"2px solid #ed4426"});
			return false;
		} else  if(!pattern.test(email)) {
			$('#ErrorMsgEmail').text('Please enter Valid Email!');
			$('#email').focus();
			$('#email').css({"border":"2px solid #ed4426"});
		} else {
			$('#ErrorMsgEmail').text('');
			$('#email').css({"border":"1px solid #8e8e8e"});
		}
		if($('#username').val()==""){
			$('#ErrorMsgUname').text('Please enter your Username!');
			$('#username').focus();
			$('#username').css({"border":"2px solid #ed4426"});
			return false;
		}else {
			$('#ErrorMsgUname').text('');
			$('#username').css({"border":"1px solid #8e8e8e"});
		}
		var phone=$('#user-profile-mobile').val();
		var pw_filter = /^[0-9-+]+$/;
		if(phone=="") {
			$('#ErrorMsgMobile').text('Please enter Mobile No!');
			$('#user-profile-mobile').focus();
			$('#user-profile-mobile').css({"border":"2px solid #ed4426"});
			return false;
		} else if( !pw_filter.test(phone) ){
			$('#ErrorMsgMobile').text('Please enter Valid Mobile No!');
			$('#user-profile-mobile').focus();
			$('#user-profile-mobile').css({"border":"2px solid #ed4426"});
			return false;
		} else if(phone.length < 10){
			$('#ErrorMsgMobile').text('Please enter minimum 10 digits Mobile No!');
			$('#user-profile-mobile').focus();
			$('#user-profile-mobile').css({"border":"2px solid #ed4426"});
			return false;
		} else {
			$.ajax({
				url: "<?= $this->Url->build(['controller' => 'Users', 'action' => 'checkMobileNumber','plugin' => 'UserManager']) ?>",
				type: 'POST',
				dataType: 'json',
				data: {'mobile':$('#user-profile-mobile').val()},
				headers: {
					"accept": "application/json",
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				success: function (data) {
					if(data == 1) {
						$('#ErrorMsgMobile').text(' Mobile No Already Exist');
						$('#user-profile-mobile').focus();
						$('#user-profile-mobile').css({"border":"2px solid #ed4426"});
					} else {
						$('#ErrorMsgMobile').text('');
						$('#user-profile-mobile').css({"border":"1px solid #8e8e8e"});
					}
				},error: function (xhr, ajaxOptions, thrownError) {
					console.log(xhr);
					var errors = JSON.parse(xhr.responseText);
					var title =   JSON.parse(xhr.responseText).message;
					
				}

			});
			
		}
		var pwd=$('#password').val();
		if(pwd==""){
			$('#ErrorMsgPwd').text('Please enter Password!');
			$('#password').focus();
			$('#password').css({"border":"2px solid #ed4426"});
			return false;
		}else if(pwd.length <6){
			$('#ErrorMsgPwd').text('Please enter six Character Password!');
			$('#password').css({"border":"2px solid #ed4426"});
			$('#password').focus();
			return false;
		}else if(pwd !== $("#password-confirm").val()){
			$('#ErrorMsgPwd').text('');
			$('#ErrorMsgCPwd').text('Password not matched!');
			$('#password-confirm').css({"border":"2px solid #ed4426"});
			$('#password-confirm').focus();
			return false;
		}  else {
			$('#password-confirm').css({"border":"1px solid #8e8e8e"});
			$('#password').css({"border":"1px solid #8e8e8e"});
			$('#ErrorMsgCPwd').text('');
			$('#ErrorMsgPwd').text('');
		}
		$("#registration-box").hide();
		$("#otp-box").show();
		$("#new_mobile").val(phone);
		$("#otp-number").text(phone);
		sendAjaxData(0);
});
$(".back").on("click", function(event){
	var val = Math.floor(1000 + Math.random() * 9000);
	$("#sms_otp").val(val);
	$("#registration-box").show();
	$("#otp-box").hide();
});
$(".resend-otp").on("click", function(event){
	sendAjaxData(1);
});
$("#verify_proceed").on("click", function(event){
	var otp_str = $("#digit-1").val()+''+$("#digit-2").val()+''+$("#digit-3").val()+''+$("#digit-4").val();
	if($("#sms_otp").val() === otp_str) {
		$("#is_mobile_verified").val(1);
		$("#register").submit();
	} else {
		alert("OTP is Invalid");
	}
});
function sendAjaxData(resend=0){
	$.ajax({
		url: "<?= $this->Url->build(['controller' => 'Users', 'action' => 'sendPhoneVerifyOtp','plugin' => 'UserManager']) ?>",
		type: 'POST',
		dataType: 'json',
		data: $("#register").serialize(),
		headers: {
			"accept": "application/json",
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		success: function (data) {
			if(resend == 1) {
				alert("OTP resent to "+$('#user-profile-mobile').val());
			}
		},error: function (xhr, ajaxOptions, thrownError) {
			console.log(xhr);
			var errors = JSON.parse(xhr.responseText);
			var title =   JSON.parse(xhr.responseText).message;
			
		}

	});
}
$(document).ready(function () {
	var charLimit = 1;
    $(".otp-input").keydown(function(e) {
		 var keys = [8, 9, 19, 20, 27, 33, 34, 35, 36, 37, 38, 39, 40, 45, 46, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105, 144, 145];
        if (e.which == 8 && this.value.length == 0) {
            $(this).prev('.otp-input').focus();
        } else if ($.inArray(e.which, keys) >= 0) {
            return true;
        } else if (this.value.length >= charLimit) {
            $(this).next('.otp-input').focus();
            return false;
        } else if (e.shiftKey || e.which <= 48 || e.which >= 58) {
            return false;
        }
    }).keyup (function () {
        if (this.value.length >= charLimit) {
            $(this).next('.otp-input').focus();
            return false;
        }
    });	
}); 
<?php $this->Html->scriptEnd(); ?>
</script>