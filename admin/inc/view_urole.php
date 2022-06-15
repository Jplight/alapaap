                <!-- Modal Component -->
                <form method="POST">
                    <div class="modal" id="view_r<?=$rows_users['uid'];?>" tabindex="-1" data-bs-backdrop="modal" data-bs-keyboard="false" >
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Status</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="fullname" value="<?=$my_fullname; ?>" readonly="readonly">
                                    <input type="hidden" name="email_add" value="<?=$email_add; ?>" readonly="readonly">
                                    <div class="d-block">
                                        <label class="fw-bold mb-2">Name: </label> <span><?=ucwords($rows_users['fullname']);?></span>
                                    </div>
                                    <div class="d-block">
                                        <label class="fw-bold mb-2">Primary Role: </label>
                                        <span><?php echo $primary;?>
                                    </div>
                                    

                                    <div class="mb-2 d-block">
                                        <div class="row">
                                            <div class="col-2">
                                                <label class="fw-bold">Other Role's:</label>
                                            </div>
                                            <div class="col-10">
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
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Modal Component -->