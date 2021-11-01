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
<style>
#otp-btn{
	display:none;
}
</style>
<div class="SLoginArea">
        <div class="container">
            <div class="col-md-12">
				<?= $this->Form->create(null, ['templates' => [
                            'inputContainer' => '<div class="input {{type}}{{required}}"><div class="form-group">{{content}}</div></div>', 
                            'input' => '<input type="{{type}}" name="{{name}}"{{attrs}}/><span class="invalid-feedback" role="alert"></span>',
                            'label' => '<label{{attrs}} class="control-label">{{text}}</label>',
                                'formGroup' => '{{label}}{{input}}{{error}}',
                                ],'id'=>"login"]) ?>
                <div class="col-md-4 col-md-offset-4 SLbox" id="login-box">
                    <div class="col-md-12 LoginTop">
                        <?= $this->Html->image("LogoIcon.png") ?>
                        <h2>Login</h2>
                    </div>
                    <div class="col-md-12">
                        <?= $this->Flash->render() ?>
                        <?= $this->Flash->render('auth') ?>
                       
                            <div class="form-group">
								<input type="hidden" name="login_type" id="login_type" value="0">
								<input type="hidden" name="sms_otp" id="sms_otp" value="<?= rand(1000,9999) ?>">
                                <?= $this->Form->control('username', ['label' => __d('cake_d_c/users', 'Username / Email / Mobile No'),'class' => 'form-control mytbox','placeholder' => 'Username / Email / Mobile No' ,"id"=>"txt_uname", 'required' => true]) ?>
                                <p id="ErrorMsgMobile" style="color:red"></p>
                            </div>
                            <div class="form-group password-div" >
                                <?= $this->Form->control('password', ['label' => __d('cake_d_c/users', 'Password'),'placeholder' => 'Password','class' => 'form-control mytbox', 'required' => false]) ?>
                            </div>
                         
                      
                    </div>
					 <div class="col-md-12 LoginFS">
					 <?= $this->Form->button(__d('cake_d_c/users', 'Login'), ['class' => 'btn btn-block mybtn',"id"=>'login-btn']); ?> 
					  <?= $this->Form->button(__d('cake_d_c/users', 'GET OTP'), ['class' => 'btn btn-block mybtn', 'type' => "button", "id"=>'otp-btn']); ?>
					  </div>
                    <div class="col-md-12 LoginFS">
                        <?php
                        $registrationActive = Configure::read('Users.Registration.active');
                        
                        if (Configure::read('Users.Email.required')) {
                            if ($registrationActive) {
                                echo '';
                            }
                            echo $this->Html->link(__d('cake_d_c/users', 'Forgot Password?'), ['action' => 'requestResetPassword']);
                        }
                        ?>
                    </div>
                    <div class="col-md-12 nopadding Sslogin">
                        <?= implode(' ', $this->User->socialLoginList()); ?>
                        <!-- <div class="col-md-12"> 
                            <a href="#">
                                <img src="Include/img/SocialLogin1.png" /></a>
                        </div>
                        <div class="col-md-12">
                            <a href="#">
                                <img src="Include/img/SocialLogin2.png" /></a>
                        </div> -->
                    </div>
                    <div class="col-md-12 nopadding SwpipeLogin">
                        <?php
                        if ($registrationActive) {
                            echo $this->Html->link(__d('cake_d_c/users', 'Dont have Account? Sign Up here'), ['action' => 'register']);
                        }
                         ?>
                    </div>
                </div>
				<div class="col-md-4 col-md-offset-4 SLbox" id="otp-box" style="display:none;">
				
					 <div class="col-md-12 LoginTop">
                        <?= $this->Html->image("LogoIcon.png") ?>
                        <h2>OTP - Verification</h2><br>
                        <p style="background-color: #008000; color: white;line-height: 35px;">Enter OTP sent to <strong id="otp-number"></strong></p>
                    </div>
                    <div class="col-md-12">
                            <div class="form-group">
								<input type="hidden" name="new_mobile" id="new_mobile" value="">
                                <input type="text" name="otp[0]" class="form-control mytbox otp-input" id="digit-1" data-next="digit-2" />
								<input type="text" name="otp[1]" class="form-control mytbox otp-input" id="digit-2" data-next="digit-3" data-previous="digit-1" />
								<input type="text" name="otp[2]" class="form-control mytbox otp-input" id="digit-3" data-next="digit-4" data-previous="digit-2" />
								<input type="text" name="otp[3]" class="form-control mytbox otp-input" id="digit-4"data-previous="digit-3" />
                            </div>
							<?= $this->Form->button(__d('cake_d_c/users', 'Login'), ['class' => 'btn btn-block mybtn',"type"=>"button", "id"=>'login-btn']); ?> 
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
				 
				 <?= $this->Form->end() ?>
			</div>
        </div>
    </div>

<?php 
echo $this->Html->css(['/assets/plugins/dropify-master/dist/css/dropify.min.css'],['block' => true]);
echo $this->Html->script('https://use.fontawesome.com/fbf7ab0391.js',['block' => true]);
 ?>
 <script>
<?php $this->Html->scriptStart(['block' => true]); ?>
$("#txt_uname").on("keyup", function(event){
	var pw_filter = /^[0-9-+]+$/;
	if( pw_filter.test($(this).val()) && $(this).val().length === 10 ){
		$(".password-div").hide();
		$("#login-btn").hide();
		$("#otp-btn").show();
	} else {
		$(".password-div").show();
		$("#login-btn").show();
		$("#otp-btn").hide();
	}
});
$(".back").on("click", function(event){
	$("#login-box").show();
	$("#otp-box").hide();
});

$(document).on("click", "#otp-btn", function(event) {
	$.ajax({
				url: "<?= $this->Url->build(['controller' => 'Users', 'action' => 'checkMobileNumber','plugin' => 'UserManager']) ?>",
				type: 'POST',
				dataType: 'json',
				data: {'mobile':$('#txt_uname').val()},
				headers: {
					"accept": "application/json",
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				success: function (data) {
					if(data == 0) {
						$('#txt_uname').focus();
						$('#txt_uname').css({"border":"2px solid #ed4426"});
						$('#ErrorMsgMobile').text('User not register with this Mobile No !');
					} else {
						$('#txt_uname').css({"border":"1px solid #8e8e8e"});
						$('#ErrorMsgMobile').text('');
						$.ajax({
							url: "<?= $this->Url->build(['controller' => 'Users', 'action' => 'sendPhoneVerifyOtp','plugin' => 'UserManager']) ?>",
							type: 'POST',
							dataType: 'json',
							data: $("#login").serialize(),
							headers: {
								"accept": "application/json",
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							},
							success: function (data) {
								if(data.status == true){
									$("#login-box").hide();
									$("#otp-box").show();
									$("#login-btn1").show();
									$("#login_type").val(1);
									$("#otp-number").text($("#txt_uname").val());
								}else{
									
								} 
							},error: function (xhr, ajaxOptions, thrownError) {
								console.log(xhr);
								var errors = JSON.parse(xhr.responseText);
								var title =   JSON.parse(xhr.responseText).message;
								
							}

						});
					}
				},error: function (xhr, ajaxOptions, thrownError) {
					console.log(xhr);
					var errors = JSON.parse(xhr.responseText);
					var title =   JSON.parse(xhr.responseText).message;
					
				}

			});
	
})
$(document).on("click", ".resend-otp", function(event) {
		$.ajax({
		url: "<?= $this->Url->build(['controller' => 'Users', 'action' => 'sendPhoneVerifyOtp','plugin' => 'UserManager']) ?>",
		type: 'POST',
		dataType: 'json',
		data: $("#login").serialize(),
		headers: {
			"accept": "application/json",
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		success: function (data) {
			if(data.status == true){
				$("#login-box").hide();
				$("#otp-box").show();
				$("#login-btn1").show();
				$("#login_type").val(1);
				alert("OTP resent to "+$("#txt_uname").val());
			}else{
				
			} 
		},error: function (xhr, ajaxOptions, thrownError) {
			console.log(xhr);
			var errors = JSON.parse(xhr.responseText);
			var title =   JSON.parse(xhr.responseText).message;
			
		}

	});
})

$(document).on("click", "#login-btn", function(event) {
	if($("#login_type").val() == 1){
		$.ajax({
			url: "<?= $this->Url->build(['controller' => 'Users', 'action' => 'verifyOtp','plugin' => 'UserManager']) ?>",
			type: 'POST',
			dataType: 'json',
			data: $("#login").serialize(),
			headers: {
				"accept": "application/json",
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function (data) {
				if(data.status == true){
					$("#txt_uname").val(data.username);
					$("#password").val(data.password);
					$("#login").submit();
				} else {
					alert("Invalid OTP");
				}
			},error: function (xhr, ajaxOptions, thrownError) {
				console.log(xhr);
				var errors = JSON.parse(xhr.responseText);
				var title =   JSON.parse(xhr.responseText).message;
				
			}
		});
	} else {
		$("#login").submit();
	}
		
});
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