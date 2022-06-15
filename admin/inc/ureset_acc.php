
<!-- Modal Component -->
<form method="POST">
    <div class="modal" id="reset_user<?=$rows_users['uid'];?>" tabindex="-1" data-bs-backdrop="modal" data-bs-keyboard="false" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <input type="text" value="<?=$rows_users['email_add']; ?>">
                    <input type="text" value="<?=$rows_users['uid']; ?>">
                    <h5 class="modal-title" id="exampleModalLabel">Forgot Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label class="fw-bold text-wrap d-block mb-3">Would you like to send special link in this account?</label>
                    <div class="d-block mb-3">
                        <label class="fw-bold">Account Name: </label><label for=""><?=$rows_users['email_add']; ?></label>
                    </div>
                    
                    <label class="mb-1 fw-bold d-block">Note:</label>
                    <label class="mb-3 text-wrap">This will help the user to change their password in case of emergency!</label>
                    <div class="mb-2 d-block text-end">
                        <button class="btn btn-outline-primary shadow-none btn-sm" type="button" data-bs-dismiss="modal">No</button>       
                        <a class="btn btn-outline-danger shadow-none btn-sm" href="../model/ureset_acc.php?uid=<?=$rows_users['uid']; ?>&email=<?=$rows_users['email_add']; ?>" name="btn_reset_acc" id="btn_reset_acc">Yes</a>       
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Modal Component -->