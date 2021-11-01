<?php
$this->layout = "authdefault";
/**
 * Copyright 2010 - 2019, Cake Development Corporation (https://www.cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2018, Cake Development Corporation (https://www.cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
use Cake\Routing\Router;
?>
<div class="new-header-style-1">
    <div class="container">
        <div class="col-sm-12 text-center">
            <h2>Refer and Earn</h2>
            <p>Teaching Bharat's Referral Program</p>
        </div>
    </div>
</div>


 <section class="new-grey pad80-0">
        <div class="container">
            <div class="col-sm-10 col-sm-offset-1">
            <div class="col-sm-7">
                <h2 class="mt-0">Some nice title for this referral page goes here. Change it.</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>

                <label class="mt40">Your Invite Link</label>
                <div class="input-group">
                  <input type="text" id="inviteLink" class="form-control radius-shadow-none" value="<?php echo Router::url(['controller' => 'Users', 'action' => 'referral','plugin'=>'UserManager',$this->request->getAttribute('identity')->code], true) ?>">
                  <span class="input-group-btn">
                    <button class="btn btn-default" id="copyLink" type="button">Copy</button>
                  </span>
                </div>
                <label class="mt40">Send Invitation</label>
                <div class="input-group">
                  <input type="text" class="form-control radius-shadow-none" id="invitationEmails" placeholder="Email, Email, ...">
                  <span class="input-group-btn">
                    <button class="btn btn-default btn-success" id="sendInvitation" type="button">Send Invitation</button>
                  </span>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="col-sm-12 referral-right-box">
                    <!-- <img src="Include/img/dollar.svg" width="70px"> -->
                    <?= $this->Html->image('dollar.svg', ['width' => '70px']) ?>

                    <h3><strong>Your Credits</strong></h3>
                    <table class="table">
                       <!--  <tr>
                            <td>Pending</td>
                            <td><strong><?= $this->Number->currency($pending, 'INR') ?></strong></td>
                        </tr> -->
                        <tr>
                            <td>Amount</td>
                            <td><strong><?= $this->Number->currency($referrarAmount, 'INR') ?></strong></td>
                        </tr>
                    </table>
                    <a href="javascript:void(0)" class="new-btn btn-block" id="viewInvitation">View Invite Details</a>

                </div>
            </div>
        </div>
        </div>
    </section>


<?php
$this->assign('title', "Refer and Earn");
$this->Html->meta(
    'keywords', 'Refer and Earn', ['block' => true]
);
$this->Html->meta(
    'description', 'Refer and Earn', ['block' => true]
);

//$this->Html->css(['/assets/plugins/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min'], ['block' => true]);
//$this->Html->script(['/assets/plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min'], ['block' => true])//;
echo $this->Html->script(['common', 'Users'], ['block' => true]);
?> 
<style type="text/css">
.copiedText{ 
    color: #08c495;
    position: absolute;
    left: 20%;
    top: -10px;
    font-weight: bold;
 }
</style>
<script type="text/javascript">
<?php $this->Html->scriptStart(['block' => true]); ?>
$userObj = new Users();
    $('#copyLink').on('click', function(e) {
          var _this = $(this);
          $("#inviteLink").select();
          document.execCommand("copy");
          _this.append("<div class='copiedText'>Copied</div>");
          setTimeout(() => _this.find(".copiedText").remove(), 1000);
      });
$('#impRules li').on('click', function(e) {
    e.preventDefault();
      var _this = $(this);
      var $temp = $("<input>");
      $("body").append($temp);
      $temp.val(_this.find('small').text().trim()).select();
      document.execCommand("copy");
      $temp.remove();
      _this.append("<div class='copiedText'>Copied</div>");
      setTimeout(() => _this.find(".copiedText").remove(), 1000);
  });

$(document).on("click", "#sendInvitation", function(event) {
        event.preventDefault();
        if($("#invitationEmails").val() == ""){
          $.alert({
                  title: 'Error',
                  icon: 'fa fa-warning',
                  type: 'orange',
                  content: 'Email is required for send invitation.',
              });
          return false;
        }
        $userObj.sendInvitation({'title': 'Change Mobile','url': '<?php echo $this->Url->build(['controller' => 'Users', 'action' => 'sendInvitation']) ?>', filters: {emails: $("#invitationEmails").val()}});
});

$(document).on("click", "#viewInvitation", function(event) {
        event.preventDefault();
        $userObj.viewInvitation({'title': 'Invite List','url': '<?php echo $this->Url->build(['controller' => 'Users', 'action' => 'viewInvitation']) ?>'});
});
<?php $this->Html->scriptEnd(); ?> 
</script>
