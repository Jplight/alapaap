<form method="POST">
    <div class="modal fade" id="userid<?=$rows_users['uid'];?>" tabindex="-1" data-bs-backdrop="modal" data-bs-keyboard="false" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">User Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="uid" value="<?=$rows_users['uid']; ?>" readonly="readonly">
                    <div class="mb-2 d-block">
                        <div class="row">
                            <div class="col-2 ">
                                <label class="fw-bold form-check-label">Name:</label>
                            </div>
                            <div class="col-10 ">
                                <span><?=ucwords($rows_users['first_name']); ?></span>
                                <span><?=ucwords($rows_users['middle_name']); ?></span>
                                <span><?=ucwords($rows_users['last_name']); ?></span>                                
                            </div>
                        </div>
                    </div>
                    <div class="mb-2 d-block">
                        <div class="row">
                            <div class="col-2 ">
                                <label class="fw-bold form-check-label">Email:</label>
                            </div>
                            <div class="col-10 ">
                                <span><?=$rows_users['email_add']; ?></span>                               
                            </div>
                        </div>
                    </div>
                    <div class="mb-2 d-block">
                        <div class="row">
                            <div class="col-2">
                                <label class="fw-bold">Role:</label>
                            </div>
                            <div class="col-10">
                                <div class="d-block">
                                   <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="chk_requestor" id="chk_req" title="aw" value="1" <?php echo strpos($rows_users['role'],"1") !== false ? 'checked' :''; ?> >
                                        <label class="form-check-label" for="chk_req">Requestor</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="chk_approver" id="chk_app" title="aw" value="2" <?php echo strpos($rows_users['role'],"2") !== false ? 'checked' :''; ?> >
                                        <label class="form-check-label" for="chk_app">Approver</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="chk_reciever" id="chk_rec" title="aw" value="3" <?php echo strpos($rows_users['role'],"3") !== false ? 'checked' :''; ?> >
                                        <label class="form-check-label" for="chk_rec">Reciever</label>
                                    </div> 
                                </div>
                                <div class="d-block">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="chk_performer" id="chk_per" title="aw" value="4" <?php echo strpos($rows_users['role'],"4") !== false ? 'checked' :''; ?> >
                                        <label class="form-check-label" for="chk_per">Performer</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="chk_confirmer" id="chk_con" title="aw" value="5" <?php echo strpos($rows_users['role'],"5") !== false ? 'checked' :''; ?> >
                                        <label class="form-check-label" for="chk_con">Confirmer</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="chk_verifier" id="chk_ver" title="aw" value="6" <?php echo strpos($rows_users['role'],"6") !== false ? 'checked' :''; ?> >
                                        <label class="form-check-label" for="chk_ver">Verifier</label>
                                    </div>
                                </div>
                            </div>
                        </div>        
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-danger shadow-none btn-sm" type="button"  data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-outline-success btn-sm shadow-none" type="submit" name="btn_update_role" id="btn_update_role" >Update</button>
                </div>
            </div>
        </div>
    </div>
</form>
