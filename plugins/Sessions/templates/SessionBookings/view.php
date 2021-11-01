 <div class="row">
    <div class="col-md-12" id="sessionBookingDetail">
        <table class="table table-bordered">
            <tr>
                <td>Student Name</td>
                <td><strong><?= $this->Html->link($sessionBooking->user->name, ['controller' => 'Users', 'action' => 'profile', 'plugin' => 'UserManager', $sessionBooking->user_id], ['class' => 'namme']); ?></strong></td>
            </tr>

            <tr>
                <td>Topic</td>
                <td><strong><?= $sessionBooking->topic ?></strong></td>
            </tr>
            <!-- <tr>
                <td>Session on</td>
                <td><strong>English - Topic here</strong></td>
            </tr>
            <tr>
                <td>Session type</td>
                <td><strong>Once</strong></td>
            </tr> -->
            <tr>
                <td>Session Start Time</td>
                <td><strong><?= $sessionBooking->start_date ? $sessionBooking->start_date->format('D - jS M, Y H:i A') : "N/A" ?></strong></td>
            </tr>
            <tr>
                <td>Session End Time</td>
                <td><strong><?= $sessionBooking->end_date ? $sessionBooking->end_date->format('D - jS M, Y  H:i A') : "N/A"?></strong></td>
            </tr>
            <tr>
                <td>Topic</td>
                <td><?= $sessionBooking->topic ?></td>
            </tr>
            <tr>
                <td>Note</td>
                <td><?= $sessionBooking->note ?></td>
            </tr>

        <?php if(!$sessionBooking->session_status){ ?>
            <tr>
                <td>Reason:</td>
                <td>
                    <textarea class="form-control" name="reason" id="reason" placeholder="Reason"></textarea>
                </td>
            </tr>
        <?php }else{ ?>
            <tr>
                <td>Comment:</td>
                <td>
                   <?php 
                    echo $sessionBooking->reason;
                   ?>
                </td>
            </tr>
        <?php } ?>

        </table>
    </div>
</div>

<?php 
//dump($sessionBooking->session_status);
?>

<script>
    <?php if($sessionBooking->session_status == 2){ ?>
        $(".modal-footer").html('<button type="button" class="btn" data-dismiss="modal">Close</button>');
       
        
        // $(".modal-footer .modelAction.accept").remove();
        // $(".modal-footer .modelAction.sessionModify").remove();
        // $(".modal-footer .modelAction.sessionDecline").remove();
    <?php }else if($sessionBooking->session_status == 1){ ?>
        $(".modal-footer .modelAction.accept").remove();
    <?php } ?> 
</script>