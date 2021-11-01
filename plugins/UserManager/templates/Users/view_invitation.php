<?php
//$this->layout = false;
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
<table class="table table-bordered">
    <thead>
        <tr>
            <td>User</td>
            <td>Date</td>
            <td>Amount</td>
        </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $key => $user) { ?>
        <tr>
            <td><?= $user->email ?></td>
            <td><?= $user->created->format('jS D, Y') ?></td>
            <td><?= $this->Number->currency("500", 'INR') ?></td>
        </tr>
      <?php } ?>        
        
    </tbody>
</table>