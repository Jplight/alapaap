<?php if (!empty($control_number)): ?>
                    <div class="modal-footer d-flex justify-content-end">       
                        <?php if ($status == 1 && $my_role == 1): ?> <!-- // Draft button -->
                        <div>
                            <button class="btn btn-secondary me-2" type="submit" name="btn_update" id="btn_update" ><i class="fa-fw fas fa-refresh me-1"></i>Update</button>
                            <button class="btn btn-primary" type="submit" name="btn_submit_draft" id="btn_submit_draft" ><i class="fa-fw fas fa-paper-plane me-1"></i>Resubmit</button>
                        </div>
                        <?php endif; ?>
                        <?php if ($my_role == 1 && $revised == 1): ?>
                        <div>
                            <button class="btn btn-primary" type="submit" name="btn_resubmit" id="btn_resubmit" ><i class="fa-fw fas fa-paper-plane me-1"></i>Resubmit</button>
                        </div>    
                        <?php endif; ?>
                        <?php if ($status == 0 && $my_role == 1): ?> <!-- // Disapproved  -->
                        <!-- <div>
                            <button class="btn btn-primary" type="submit" name="btn_resubmit" id="btn_resubmit">Resubmit</button>  
                        </div> -->
                        <?php endif; ?>
                        <?php if ($my_role == 1 && $status == 2): ?>
                        <div>
                            <div class="btn btn-danger" id="hci_cancel_1" ><i class="fa-fw fas fa-times me-1"></i>Cancel</div>
                            <button type="submit" name="btn_cancel" hidden></button>
                        </div>    
                        <?php endif; ?>
                        <?php if ($status == 2 && $my_role == 2): ?> <!-- // button for Approver -->
                        <div>
                            <button class="btn btn-outline-success launchModal" type="button" id="btn_approver" data-bs-toggle="modal" data-bs-target="#myModal2<?php echo empty($control_number) ? '' : $control_number; ?>" value="Approved this form?" ><i class="fa-fw fas fa-check me-1"></i>Approve</button>
                            <button class="btn btn-outline-danger launchModal" type="button" id="app_disapproved" data-bs-toggle="modal" data-bs-target="#myModal2<?php echo empty($control_number) ? '' : $control_number; ?>" value="Disapprove this form?" ><i class="fa-fw fas fa-close me-1"></i>Disapprove</button>
                            <button class="btn btn-danger launchModal" type="button" id="approver_returned" data-bs-toggle="modal" data-bs-target="#myModal2<?php echo empty($control_number) ? '' : $control_number; ?>" value="Returned this form?" ><i class="fa-fw fas fa-rotate-left me-1"></i>Return to Sender</button>
                        </div> 
                        <?php endif; ?>
                        <?php if ($status == 3 && $my_role == 3): ?> <!-- // Button for Reciever -->
                        <div>
                            <button class="btn btn-outline-success launchModal" type="button" id="btn_reciever" data-bs-toggle="modal" data-bs-target="#myModal2<?php echo empty($control_number) ? '' : $control_number; ?>" value="Acknowledge this request?" ><i class="fa-fw fas fa-check me-1"></i>Acknowledge Request</button> 
                            <!-- <button class="btn btn-outline-danger" type="submit" name="rec_disapproved" ><i class="fa-fw fas fa-times me-1"></i>Return to Sender</button>  -->
                        </div>
                        <?php endif; ?>
                        <?php if ($status == 4 && $my_role == 4): ?> <!-- // Button for Performer -->
                        <div>
                            <button class="btn btn-outline-success launchModal" type="button" id="btn_performer" data-bs-toggle="modal" data-bs-target="#myModal2<?php echo empty($control_number) ? '' : $control_number; ?>" value="Are you sure you perform this request?" ><i class="fa-fw fas fa-check me-1"></i>Request Perform</button>      
                            <!-- <button class="btn btn-outline-danger" type="submit" name="performer_disapproved" ><i class="fa-fw fas fa-times me-1"></i>Return to Sender</button>  -->
                        </div>
                        <?php endif; ?>
                        <?php if ($status == 5 && $my_role == 5): ?> <!-- // Button for Confirmer -->
                        <div>
                            <button class="btn btn-outline-success launchModal" type="button" id="btn_confirmer" data-bs-toggle="modal" data-bs-target="#myModal2<?php echo empty($control_number) ? '' : $control_number; ?>" value="Confirm this request?" ><i class="fa-fw fas fa-check me-1"></i>Request Perform</button>
                        </div>
                        <?php endif; ?>
                        <?php if ($status == 6 && $my_role == 6): ?> <!-- // Button for Verifier -->
                        <div>
                            <button class="btn btn-outline-success launchModal" type="button" id="btn_verifier" data-bs-toggle="modal" data-bs-target="#myModal2<?php echo empty($control_number) ? '' : $control_number; ?>" value="Verify this request?" ><i class="fa-fw fas fa-check me-1"></i>Verify</button>                                     
                        </div>
                        <?php endif; ?>    
                    </div>
                <?php endif; ?>
                <?php if (empty($control_number)): ?>
                    <div class="modal-footer d-flex justify-content-end">
                        <div>
                            <!-- <button type="submit" name="btn_savehci" hidden></button>
                            <button type="submit" name="btn_submit_hci" hidden></button> -->
                            <button class="btn btn-secondary" name="btn_savehci" type="submit" id="btn_savehci"><i class="fa-fw fas fa-file me-1"></i>Draft</button>
                            <button class="btn btn-primary" name="btn_submit_hci" type="submit" id="btn_submit_hci"><i class="fa-fw fas fa-paper-plane me-1"></i>Submit</button>
                        </div>
                    </div>
                <?php endif; ?>