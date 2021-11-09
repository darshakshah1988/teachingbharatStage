<?php ?>
<html>
<body>
<div style="padding:25px 0px;margin:0;background:#fff">
  <div style="max-width:600px;width:90%;min-height:auto;margin:auto;background:#fff">
    <div style="padding:0x">
      <div>
        <table width="100%" cellpadding="10" cellspacing="0" style="background:#e8023d; border-bottom:1px solid #ccc;">
          <tbody>
            <tr>
              <td valign="top"><table width="" cellpadding="0" cellspacing="0" >
                  <tbody>
                    <tr>
                      <td><h1 style="font-family:helvetica,arial,sans-serif;font-size:28px; margin:0px; padding:0px; text-align:left;"> <a title="" href="https://www.teachingbharat.com/" style="text-decoration:none;color:#555555; "><img src="https://teachingbharat.com/img/uploads/4/settings/1635762802_logo.png" alt="Teachingbharat" title="Teachingbharat" width="165" /></a> </h1></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
          </tbody>
        </table>
      </div>

      <div style="color:#000;padding:5px;">
        <p style="float:right;font-size:13px;text-align:left;font-family:Tahoma, Geneva, sans-serif;"> Date: <strong><?php echo(date('F dS, Y'));?></strong> </p>

        <p style="font-size:13px;text-align:left; margin-bottom:0px; padding:0px;font-family:Tahoma, Geneva, sans-serif;">Dear <?php echo(ucwords($user->first_name.' '.$user->last_name));?>,</p>

      </div>

      <div style="padding:5px">

        <table width="100%" cellpadding="4" cellspacing="0">
            <tr>
              <td width="150" style="border-bottom:1px solid #f3f3f3;font-size:13px;font-family:Tahoma, Geneva, sans-serif;"> User Name:</td>
              <td style="border-bottom:1px solid #f3f3f3;font-size:13px;font-family:Tahoma, Geneva, sans-serif;"><?php echo(ucwords($postData['userName']));?></td>
            </tr>

            <tr>
              <td width="150" style="border-bottom:1px solid #f3f3f3;font-size:13px;font-family:Tahoma, Geneva, sans-serif;"> Email Address:</td>
              <td style="border-bottom:1px solid #f3f3f3;font-size:13px;font-family:Tahoma, Geneva, sans-serif;"><?php echo($postData['userEmailAddress']);?></td>
            </tr>

            <tr>
              <td width="150" style="border-bottom:1px solid #f3f3f3;font-size:13px;font-family:Tahoma, Geneva, sans-serif;"> Contact Number:</td>
              <td style="border-bottom:1px solid #f3f3f3;font-size:13px;font-family:Tahoma, Geneva, sans-serif;"><?php echo($postData['userContactNumber']);?></td>
            </tr>

            <tr>
              <td width="150" style="border-bottom:1px solid #f3f3f3;font-size:13px;font-family:Tahoma, Geneva, sans-serif;">Message:</td>
              <td style="border-bottom:1px solid #f3f3f3;font-size:13px;font-family:Tahoma, Geneva, sans-serif;"><?php echo(nl2br($postData['userMessage']));?></td>
            </tr>

        </table>
      </div>
      </div>

      <div style="clear:both"></div>
      <div style="padding-top:15px; padding-bottom:15px;text-align:center;font-family:Tahoma, Geneva, sans-serif;font-size:11px;color:#fff;line-height:15px;border-top:1px solid #e5e5e5; background:#e8023d; margin-top:50px;"> <span>Copyright <?= date('Y'); ?> All Rights are Reserved by Teaching Bharat</span></div>
    </div>
  </div>
</div>
</body>
</html>
