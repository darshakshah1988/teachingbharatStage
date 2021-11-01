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
?>
<div class="col-md-12">
    <?= $this->Form->create(null, ['url' => ['controller' => 'Users', 'action' => 'sendOtp', $user->user_profile->id ?? null],'role' => 'form', 'enctype' => 'multipart/form-data', 'templates' => 'horizontal_form']) ?> 
        <div class="col-md-12 LoginTop">
            <h2>OTP - Verification</h2><br>
            <p>We will send you an <strong>One Time Password</strong> on this mobile number.</p>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label>Enter Mobile Number</label>
                <input type="text" class="form-control mytbox" name="mobile" value="<?= $user->user_profile->mobile ?? "" ?>" placeholder="Enter Mobile Number" required />
            </div>
        </div>
    </form>
</div>