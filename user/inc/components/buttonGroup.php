<?php if ($status == 2 && $my_role == 2): ?>
<!-- // button for Approver -->
<div>
    <button class="btn btn-outline-success launchModal" type="button" id="btn_approver" data-bs-toggle="modal"
        data-bs-target="#myModal2<?php echo $formt; echo empty($control_number) ? '' : $control_number; ?>"
        value="Do you want to approved this request?"><i class="fa-fw fas fa-check me-1"></i>Approve</button>
    <button class="btn btn-outline-danger launchModal" type="button" id="app_disapproved" data-bs-toggle="modal"
        data-bs-target="#myModal2<?php echo $formt; echo empty($control_number) ? '' : $control_number; ?>"
        value="Do you want to disapprove this request?"><i class="fa-fw fas fa-close me-1"></i>Disapprove</button>
    <button class="btn btn-danger launchModal" type="button" id="approver_returned" data-bs-toggle="modal"
        data-bs-target="#myModal2<?php echo $formt; echo empty($control_number) ? '' : $control_number; ?>"
        value="Do you want to returned this request?"><i class="fa-fw fas fa-rotate-left me-1"></i>Return to Sender</button>
</div>
<?php endif; ?>
<?php if ($status ==3 && $my_role == 3): ?>
<!-- // Button for Reciever -->
<div>
    <button class="btn btn-outline-success launchModal" type="button" id="btn_reciever" data-bs-toggle="modal" data-bs-target="#myModal2<?php echo $formt; echo empty($control_number) ? '' : $control_number; ?>" value="Do you want to acknowledge this request?">
        <i class="fa-fw fas fa-check me-1"></i>
        Acknowledge Requests
    </button>
    <!-- <button class="btn btn-outline-danger" type="submit" name="rec_disapproved" ><i class="fa-fw fas fa-times me-1"></i>Return to Sender</button>  -->
</div>
<?php endif; ?>
<?php if ($status == 4 && $my_role == 4): ?>
<!-- // Button for Performer -->
<div>
    <button class="btn btn-outline-success launchModal" type="button" id="btn_performer" data-bs-toggle="modal"
        data-bs-target="#myModal2<?php echo $formt; echo empty($control_number) ? '' : $control_number; ?>"
        value="Do you want to perform this request?"><i class="fa-fw fas fa-check me-1"></i>Perform</button>
    <!-- <button class="btn btn-outline-danger" type="submit" name="performer_disapproved" ><i class="fa-fw fas fa-times me-1"></i>Return to Sender</button>  -->
</div>
<?php endif; ?>
<?php if ($status == 5 && $my_role == 5): ?>
<!-- // Button for Confirmer -->
<div>
    <button class="btn btn-outline-success launchModal" type="button" id="btn_confirmer" data-bs-toggle="modal"
        data-bs-target="#myModal2<?php echo $formt; echo empty($control_number) ? '' : $control_number; ?>"
        value="Do you want to confirm this request?"><i class="fa-fw fas fa-check me-1"></i>Confirm</button>
</div>
<?php endif; ?>
<?php if ($status == 6 && $my_role == 6): ?>
<!-- // Button for Verifier -->
<div>
    <button class="btn btn-outline-success launchModal" type="button" id="btn_verifier" data-bs-toggle="modal"
        data-bs-target="#myModal2<?php echo $formt; echo empty($control_number) ? '' : $control_number; ?>"
        value="Do you want to verify this request?"><i class="fa-fw fas fa-check me-1"></i>Verify</button>
</div>
<?php endif; ?>