                <!-- Modal Component -->
                <?php
                    $getEmail = mysqli_query($conn,"select * from tbl_backup_pass where email_add = '".$rows_users['email_add']."' ");
                    $getData = mysqli_fetch_array($getEmail);
                
                ?>
                
                <form method="POST">
                    <div class="modal" id="view_uacc<?=$rows_users['uid'];?>" tabindex="-1" data-bs-backdrop="modal" data-bs-keyboard="false" >
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">User Credentials</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                
                                    <div class="d-block">
                                        <label class="fw-bold mb-2">Email: </label> <span><?=$getData['email_add']; ?></span>
                                    </div>
                                    <div class="d-block">
                                        <label class="fw-bold mb-2">Primary Role: </label>
                                        <span>
                                            <?php 

                                                foreach($getEmail as $getEmail){
                                                    
                                                    if ($getData['role'] == '1'){
                                                        echo 'Requester';
                                                    }
                                                    if ($getData['role'] == '2'){
                                                        echo 'Approver';
                                                    }
                                                    if ($getData['role'] == '3'){
                                                        echo 'Receiver';
                                                    }
                                                    if ($getData['role'] == '4'){
                                                        echo 'Performer';
                                                    }
                                                    if ($getData['role'] == '5'){
                                                        echo 'Confirmer';
                                                    }
                                                    if ($getData['role'] == '6'){
                                                        echo 'Verifier';
                                                    }
                                                    if ($getData['role'] == 'admin'){
                                                        echo 'Administrator';
                                                    }
                                                }
                                            
                                            ?>

                                        </span>
                                    </div>
                                    <!-- <div class="d-block">
                                        <label class="fw-bold mb-2">Password: </label>
                                        <span id="p1"><?=$getData['password'];?></span>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Modal Component -->