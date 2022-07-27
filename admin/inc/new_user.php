<!-- Modal Component -->
<form method="POST">
    <div class="modal" id="new_user" tabindex="-1" data-bs-backdrop="modal" data-bs-keyboard="false" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New user</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label class="fw-bold mb-3">Account Details</label>
                    <div class="mb-2">
                        <label for="d-block">Role</label>
                        <select class="form-select" name="u_role" id="" required>
                            <option selected value="">Select Role</option>
                            <option value="1">Requestor</option>
                            <option value="2">Approver</option>
                            <option value="3">Receiver</option>
                            <option value="4">Performer</option>
                            <option value="5">Confirmer</option>
                            <option value="6">Verifier</option>
                            <option value="admin">Administrator</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="d-block">Email</label>
                        <input class="form-control" type="email" name="email_add" autocomplete="off" required>
                        <?php echo (!empty($message_error)) ? $message_error : ''; ?>
                    </div>
                    <div class="mb-2">
                        <!-- <label for="d-block">Generated Password</label> -->
                        <div class="input-group">
                            <input type="hidden" class="form-control"  name="pass" rel="gp" data-size="10" data-character-set="a-z,A-Z,0-9,#" readonly required >
                            <!-- <span class="input-group-btn">
                                <button type="button" class="btn btn-default getNewPass">
                                    <span class="fa fa-refresh"></span>
                                </button>
                            </span> -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer ">
                    <button class="btn btn-outline-danger shadow-none btn-sm" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-outline-success btn-sm shadow-none" type="submit" name="btn_new_u" id="btn_new_u">Add</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Modal Component -->