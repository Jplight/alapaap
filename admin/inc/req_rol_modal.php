            <!-- Modal Component -->
            <form method="POST">
                <div class="modal" id="view_req<?=$users_id; ?>" tabindex="-1" data-bs-backdrop="modal" data-bs-keyboard="false" >
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Action</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="d-block">
                                    <input type="hidden" name="users_id" value="<?=$users_id; ?>" name="">
                                    <input type="hidden" name="his_id" value="<?=$his_id; ?>" name="">
                                </div>
                                <label class="mb-3 text-wrap"><span class="fw-bold text-dark"><?=$fullname; ?></span> has been requesting for another role. Would you like to authorize it?</label>
                                <div class="mb-2 d-block">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="fw-bold">Role requested:</label>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-block">
                                                <?php if (strpos($multi_role,"1") !== false):  ?>
                                                    <input type="hidden" name="chk_requestor" value="1" readonly>
                                                    <label class="d-block" ><div class="spinner-grow spinner-grow-sm me-1" role="status"></div>Requestor Role</label>
                                                <?php endif; ?>
                                                <?php if (strpos($multi_role,"2") !== false):  ?>
                                                    <input type="hidden" name="chk_approver" value="2" readonly>
                                                    <label class="d-block" ><div class="spinner-grow spinner-grow-sm me-1" role="status"></div>Approver Role</label>
                                                <?php endif; ?>
                                                <?php if (strpos($multi_role,"3") !== false):  ?>
                                                    <input type="hidden" name="chk_reciever" value="3" readonly>
                                                    <label class="d-block" ><div class="spinner-grow spinner-grow-sm me-1" role="status"></div>Receiver Role</label>
                                                <?php endif; ?>
                                                <?php if (strpos($multi_role,"4") !== false):  ?>
                                                    <input type="hidden" name="chk_performer" value="4" readonly>
                                                    <label class="d-block" ><div class="spinner-grow spinner-grow-sm me-1" role="status"></div>Performer Role</label>
                                                <?php endif; ?>
                                                <?php if (strpos($multi_role,"5") !== false):  ?>
                                                    <input type="hidden" name="chk_confirmer" value="5" readonly>
                                                    <label class="d-block" ><div class="spinner-grow spinner-grow-sm me-1" role="status"></div>Confirmer Role</label>
                                                <?php endif; ?>
                                                <?php if (strpos($multi_role,"6") !== false):  ?>
                                                    <input type="hidden" name="chk_verifier" value="6" readonly>
                                                    <label class="d-block" ><div class="spinner-grow spinner-grow-sm me-1" role="status"></div>Verifier Role</label>
                                                <?php endif; ?>
                                            </div>                                            
                                        </div>
                                    </div>        
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger btn-sm shadow-none" type="submit" name="btn_reject_role" id="btn_reject_role">Reject</button>
                                <button class="btn btn-outline-success btn-sm shadow-none" type="submit" name="btn_approve_role" id="btn_approved_role">Approve</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Modal Component -->