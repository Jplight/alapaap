<!-- Modal Component Approve-->
<form method="POST" id="frm_approve_account" action="model/new_accounts.php" >
    <div class="modal" id="new_account<?=$rows_users['uid'];?>" data-bs-backdrop="modal" data-bs-keyboard="false" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-wrap text-center">
                    <input type="hidden" name="uid_account" value="<?=$rows_users['uid'];?>">
                    <input type="hidden" name="email_add" value="<?=$rows_users['email_add'];?>">
                    <input type="hidden" name="approver_mail" value="<?=$email;?>">
                    <h3 class="modal-title mb-5">Do you want to <span class="text-success">approve</span> this account?</h3>
                    <button class="btn btn-outline-danger shadow-none" type="button" data-bs-dismiss="modal">No</button>
                    <button class="btn btn-outline-success shadow-none" type="submit" name="btn_approved_yes" id="btn_approved_yes">Yes</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Modal Component Approve-->

<!-- Modal Component Disapprove -->
<form method="POST" id="frm_disapprove_account">
    <div class="modal" id="remove_account<?=$rows_users['uid'];?>" data-bs-backdrop="modal" data-bs-keyboard="false" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-wrap text-center">
                    <h3 class="modal-title mb-5">Do you want to <span class="text-danger">disapprove</span> this account?</h3>
                    <button class="btn btn-outline-secondary shadow-none" type="button" data-bs-dismiss="modal">No</button>
                    <button class="btn btn-outline-danger shadow-none" type="button" name="" id="">Yes</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Modal Component Disapprove -->