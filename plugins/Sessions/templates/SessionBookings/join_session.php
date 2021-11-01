<?php
$this->layout = "authdefault";
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $sessionBookings
 */
?>
<link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.8.6/css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.8.6/css/react-select.css" />
<meta name="format-detection" content="telephone=no">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<style>
	.sdk-select {
		height: 34px;
		border-radius: 4px;
	}
	#zmmtg-root {
		position: initial !important;
		height: auto !important;
	}
	.websdktest button {
		float: right;
		margin-left: 5px;
	}

	#nav-tool {
		margin-bottom: 0px;
	}

	#show-test-tool {
		position: absolute;
		top: 100px;
		left: 0;
		display: block;
		z-index: 99999;
	}

	#display_name {
		width: 250px;
	}


	#websdk-iframe {
		width: 700px;
		height: 500px;
		border: 1px;
		border-color: red;
		border-style: dashed;
		position: fixed;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		left: 50%;
		margin: 0;
	}
</style>
<div class="new-header-style-1">
    <div class="container">
        <div class="col-sm-12 text-center">
            <h2>Join Session</h2>
        </div>
    </div>
</div>

<div class="GreyBg">
    <div class="container">
			<?php 
			//if($sessionBooking->session_status == 0){
			?>
				<!--<div class="col-sm-12 Nosession">
					<?php echo $this->Html->image("NoDefault.png",array()); ?>
					<h3>No Session Found</h3>
				</div>-->
			<?php
			//} else {
				$url = "https://zoom.us/oauth/authorize?response_type=code&client_id=".CLIENT_ID."&redirect_uri=".REDIRECT_URI;

			?>
				<div class="col-sm-8 col-sm-offset-2">
					<div class="col-sm-7">
						 <a href="<?php echo $url ?>" class="btn btn-dss">Login with Zoom</a>
					</div>
				</div>
			<?php 
			//}
			?>
			<!--<nav id="nav-tool" class="navbar navbar-inverse ">
				<div id="navbar" class="websdktest">
					<form class="navbar-form navbar-right" id="meeting_form">
						<div class="form-group">
							<input type="text" name="display_name" id="display_name" value="1.8.6#CDN" maxLength="100"
								placeholder="Name" class="form-control" required>
						</div>
						<div class="form-group">
							<input type="text" name="meeting_number" id="meeting_number" value="" maxLength="200"
								style="width:150px" placeholder="Meeting Number" class="form-control" required>
						</div>
						<div class="form-group">
							<input type="text" name="meeting_pwd" id="meeting_pwd" value="" style="width:150px"
								maxLength="32" placeholder="Meeting Password" class="form-control">
						</div>
						<div class="form-group">
							<input type="text" name="meeting_email" id="meeting_email" value="" style="width:150px"
								maxLength="32" placeholder="Email option" class="form-control">
						</div>

						<div class="form-group">
							<select id="meeting_role" class="sdk-select">
								<option value=0>Attendee</option>
								<option value=1>Host</option>
								<option value=5>Assistant</option>
							</select>
						</div>
						<div class="form-group">
							<select id="meeting_china" class="sdk-select">
								<option value=0>Global</option>
								<option value=1>China</option>
							</select>
						</div>
						<div class="form-group">
							<select id="meeting_lang" class="sdk-select">
								<option value="en-US">English</option>
								<option value="de-DE">German Deutsch</option>
								<option value="es-ES">Spanish Español</option>
								<option value="fr-FR">French Français</option>
								<option value="jp-JP">Japanese 日本語</option>
								<option value="pt-PT">Portuguese Portuguese</option>
								<option value="ru-RU">Russian Русский</option>
								<option value="zh-CN">Chinese 简体中文</option>
								<option value="zh-TW">Chinese 繁体中文</option>
								<option value="ko-KO">Korean 한국어</option>
								<option value="vi-VN">Vietnamese Tiếng Việt</option>
								<option value="it-IT">Italian italiano</option>
							</select>
						</div>

						<input type="hidden" value="" id="copy_link_value" />
						<button type="submit" class="btn btn-primary" id="join_meeting">Join</button>
                    <button type="submit" class="btn btn-primary" id="clear_all">Clear</button>
                    <button type="button" link="" onclick="window.copyJoinLink('#copy_join_link')"
                        class="btn btn-primary" id="copy_join_link">Copy Direct join link</button>

					</form>
				</div>
			</nav>-->
    </div>
</div>


<script>
<?php $this->Html->scriptStart(['block' => true]); ?>
        document.getElementById('show-test-tool-btn').addEventListener("click", function (e) {
            var textContent = e.target.textContent;
            if (textContent === 'Show') {
                document.getElementById('nav-tool').style.display = 'block';
                document.getElementById('show-test-tool-btn').textContent = 'Hide';
            } else {
                document.getElementById('nav-tool').style.display = 'none';
                document.getElementById('show-test-tool-btn').textContent = 'Show';
            }
        })
		<?php $this->Html->scriptEnd(); ?>
    </script>

    <script src="https://source.zoom.us/1.8.6/lib/vendor/react.min.js"></script>
    <script src="https://source.zoom.us/1.8.6/lib/vendor/react-dom.min.js"></script>
    <script src="https://source.zoom.us/1.8.6/lib/vendor/redux.min.js"></script>
    <script src="https://source.zoom.us/1.8.6/lib/vendor/redux-thunk.min.js"></script>
    <script src="https://source.zoom.us/1.8.6/lib/vendor/lodash.min.js"></script>
    <script src="https://source.zoom.us/zoom-meeting-1.8.6.min.js"></script>
<?php 
echo $this->Html->script(['/js/zoom/tool','/js/zoom/vconsole.min','/js/zoom/index']);?>
