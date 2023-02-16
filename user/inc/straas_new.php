<?php  
if (!empty($control_number)):
    $tbl_straas = mysqli_query($conn,"SELECT * FROM `tbl_straas` where control_number = '$control_number' ");
    while ($rows = mysqli_fetch_array($tbl_straas)) {
        $get_uid            = $rows['uid'];
        $control_number     = $rows['control_number'];
        $form_type          = $rows['form_type'];
        $fullname           = $rows['fullname'];
        $email_add          = $rows['email_add'];
        $contact_no         = $rows['contact_no'];
        $department         = $rows['department'];
        $location           = $rows['location'];

        $hostname           = $rows['hostname'];
        $host_port               = $rows['host_port'];
        $host_port_comment       = $rows['host_port_comment'];     

        $status             = $rows['status'];
        $date_requested     = $rows['date_requested'];
        $revised            = $rows['revised'];
        $num_revised        = $rows['num_revised'];

        $approver_id        = $rows['approver_id'];
        $approver           = $rows['approver'];
        $app_status         = $rows['app_status'];
        $appr_date          = $rows['appr_date'];

        $reciever_id        = $rows['reciever_id'];
        $reciever           = $rows['reciever'];
        $rec_status         = $rows['rec_status'];
        $rec_date           = $rows['rec_date'];

        $performer_id       = $rows['performer_id'];
        $performer          = $rows['performer'];
        $perf_status        = $rows['perf_status'];
        $perform_date       = $rows['perform_date'];

        $verifier           = $rows['verifier'];
        $ver_status         = $rows['ver_status'];
        $ver_date           = $rows['ver_date']; 

        $verifier_2         = $rows['verifier_2'];
        $ver2_status        = $rows['ver2_status'];
        $ver2_date          = $rows['ver2_date'];     
    }
endif;
?>
<form method="post" autocomplete="off" id="form_new" name="form_new" action="" enctype="multipart/form-data">
    <div id="view_straas<?php echo empty($control_number) ? '' : $control_number; ?>" class="modal myModal" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-xl modal-fullscreen-xl-down" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row g-0 d-flex flex-column-reverse flex-lg-row w-100 gap-3 gap-lg-0">
                        <div class="col-md-12 col-lg-5 col-xl-4 offset-lg-1 offset-xl-1">
                            <h4 class="modal-title fw-bold">BSP STRAAS REQUEST FORM</h4>
                        </div>
                        <div class="col-md-12 col-lg-5 col-xl-5 offset-lg-1 offset-xl-2 d-lg-flex justify-content-lg-end">
                            <img class="img-fluid me-lg-5" src="assets/img/ebiz-logo.png" width="230px" />
                        </div>
                    </div>
                    <button class="btn shadow-none" data-bs-toggle="tooltip" data-bs-placement="bottom" type="button" data-bs-dismiss="modal" title="Close">
                        <i class="fas fa-times fa-2x text-danger"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row g-0 d-flex flex-column-reverse flex-lg-row w-100 gap-3 gap-lg-0">
                        <div class="col-md-12 col-lg-5 col-xl-4 offset-lg-1 offset-xl-1">
                            <label class="form-label d-block">Date Requested: <span class="fw-bold"><?php echo empty($date_requested) ? date('F d, Y') : date('F d, Y - h:i A',strtotime($date_requested)); ?></span></label>
                            <label class="form-label d-block">Control No:&nbsp; <span class="fw-bold"><?php echo empty($control_number) ? '' : 'STRAAS/'.$control_number; ?></span></label>
                            <input type="hidden" name="txt_control_number" value="<?php echo empty($control_number) ? '' : $control_number; ?>" readonly >
                            <input type="hidden" name="contact_no" value="<?php echo empty($contact_no) ? '' : $contact_no; ?>" readonly>
                            <input type="hidden" name="email_add" value="<?php echo empty($email) ? '' : $email; ?>" readonly>
                            <input type="hidden" name="form_owner_mail" value="<?php echo empty($email_add) ? '' : $email_add; ?>" readonly>
                            <input type="hidden" name="form_type" value="<?php echo empty($form_type) ? '' : $form_type; ?>" readonly>
                            <input type="hidden" name="num_revised" value="<?php echo empty($num_revised) ? '' : $num_revised; ?>" readonly placeholder="Total Revised">
                            <input type="hidden" name="his_role" value="<?php echo empty($my_role) ? '' : $my_role; ?>" readonly>
                            <input type="hidden" name="his_uid" value="<?php echo empty($get_uid) ? '' : $get_uid; ?>" readonly>
                        </div>
                    </div>
                    
                    <h4 class="text-capitalize text-center mt-3 fw-bold">Site information</h4>
                    <div class="row d-flex justify-content-center g-0 mb-5">
                        <div class="col-lg-10">
                            <div class="table-responsive mb-2">
                                <table class="table table-borderless text-nowrap align-middle table-sm border border-secondary">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th>Name</th>
                                            <th>Department<span class="text-danger ms-2">*</span></th>
                                            <th>Location<span class="text-danger ms-2">*</span></th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-dark">
                                        <tr>
                                            <td>
                                                <input class="form-control text-dark" type="text" name="fullname" value="<?php echo empty($fullname) ? $my_fullname : ucwords($fullname); ?>" readonly="readonly" />
                                            </td>
                                            <td>
                                                <input class="form-control text-dark" type="text" name="department" value="<?php echo empty($department) ? '' : $department; ?>" required/>
                                            </td>
                                            <td>
                                                <select class="form-select text-dark"  name="location" required>
                                                    <option value="" selected="">Select your Location</option>
                                                    <option value="HO"  <?php echo empty($location) ? '' : ($location == 'HO' ? 'selected' : ''); ?> >HO - Head Office</option>
                                                    <option value="LFC" <?php echo empty($location) ? '' : ($location == 'LFC' ? 'selected' : ''); ?> >LFC - Local Fallback Center</option>
                                                    <option value="SPC" <?php echo empty($location) ? '' : ($location == 'SPC' ? 'selected' : ''); ?> >SPC - Security Plant Complex</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr class="bg-dark text-white fw-bold">
                                           
                                            <td colspan="3">Host Name<span class="text-danger ms-2">*</span></td>
                                        </tr>
                                        <tr>
                                            <td class="align-top" colspan="3">
                                                <input class="form-control text-dark" type="text" id="hostname" name="hostname" value="<?php echo empty($hostname) ? '' : $hostname; ?>" placeholder="Input your Host Name" required onkeypress="return /[0-9A-Z.-_]/i.test(event.key)" />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <h4 class="text-capitalize text-center fw-bold">Request Information</h4>
                            <div class="table-responsive">
                                <table class="table table-borderless align-middle text-nowrap text-dark table-sm border border-secondary" id="straas_tab_logic">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th>Description</th>
                                            <th colspan="2">Requested</th>   
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="fw-bold">Host Port<span class="text-danger ms-2">*</span></td>
                                            <td>
                                                <input class="form-control text-dark" type="text" name="host_port" value="<?php echo empty($host_port) ? '' : $host_port; ?>"  required maxlength="30" onkeypress="return /[a-zA-Z0-9]/i.test(event.key)" >
                                            </td>
                                            <td>
                                                <input class="form-control text-dark" type="text" name="host_port_comment" value="<?php echo empty($host_port_comment) ? '' : $host_port_comment; ?>" placeholder="Optional" />
                                            </td>
                                        </tr>
                                        <!-- Display data of DISK GB -->
                                        <?php
                                            if (!empty($control_number)):
                                                $num = 1;
                                                $display = mysqli_query($conn,"SELECT * FROM tbl_forms_others where form_type = '$form_type' and control_number = '$control_number' ");
                                                while ($rows = mysqli_fetch_array($display)):     
                                        ?>
                                        <tr>
                                            <td class="fw-bold">Volumes <?=$num++; ?></td>
                                            <td>
                                                <input type="hidden" name="others_id[]" value="<?=$rows['others_id']; ?>" >
                                                <input class="form-control text-dark volume_id1" type="text" name='others_1[]' value="<?=$rows['others_1']?>" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" >
                                            </td>
                                            <td>
                                                <input class="form-control text-dark uname1" type="text" name='others_2[]' value="<?=$rows['others_2']?>" placeholder="Optional">
                                            </td>
                                        </tr>
                                        <?php 
                                                endwhile; 
                                            endif;
                                            
                                        ?>
                                        <!-- Display data of DISK GB -->

                                        <!-- View data in DISK GB -->
                                        <?php if (empty($control_number)): ?>
                                        <tr id='straas_addr1'>
                                            <td class="fw-bold">Volumes<span class="text-danger ms-2">*</span></td>
                                            <td>
                                                <div class="d-flex justify-content-end position-relative">
                                                    <input type="hidden" name="others_id[]" >
                                                    <input class="form-control text-dark volume_id1" type="text" name='others_1[]' required onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" >

                                                    <div class="position-absolute me-2 bg-white d-flex align-self-center" style="z-index:4;">
                                                        <div class="d-flex flex-column ">
                                                            <button class="btn btn-sm " type="button" id="add_row_straas"><i class="fa-fw fas fa-plus"></i></button>
                                                        </div>  
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <input class="form-control text-dark uname1" type="text" name='others_2[]' placeholder="Optional">
                                            </td>
                                        </tr>
                                        <?php endif; ?>
                                        <!-- View data in DISK GB -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <?php include 'components/comment.php'; ?>
                        </div>
                    </div>
                    <?php include 'components/authority.php'; ?>
                </div>

                <?php if (!empty($control_number)): ?>
                    <div class="modal-footer d-flex justify-content-end">       
                        <?php if ($status == 1 && $my_role == 1): ?> <!-- // Draft button -->
                        <div>
                            <button class="btn btn-secondary me-2" type="submit" name="btn_straas_update" id="btn_straas_update" ><i class="fa-fw fas fa-refresh me-1"></i>Update</button>
                            <button class="btn btn-primary" type="submit" name="btn_straas_submit_draft" id="btn_straas_submit_draft" ><i class="fa-fw fas fa-paper-plane me-1"></i>Resubmit</button>
                        </div>
                        <?php endif; ?>
                        <?php if ($my_role == 1 && $revised == 1): ?>
                        <div>
                            <button class="btn btn-primary" type="submit" name="btn_straas_resubmit" id="btn_straas_resubmit" ><i class="fa-fw fas fa-paper-plane me-1"></i>Resubmit</button>
                        </div>    
                        <?php endif; ?>
                        <?php if ($status == 0 && $my_role == 1): ?> <!-- // Disapproved  -->
                        <!-- <div>
                            <button class="btn btn-primary" type="submit" name="btn_straas_resubmit" id="btn_straas_resubmit">Resubmit</button>  
                        </div> -->
                        <?php endif; ?>
                        <?php if ($my_role == 1 && $status == 2): ?>
                        <div>
                            <button class="btn btn-danger launchModal" type="button" id="btn_cancel_straas" data-bs-toggle="modal" data-bs-target="#myModal2<?php echo $formt; echo empty($control_number) ? '' : $control_number; ?>" value="Do you want to cancel this request?"><i class="fa-fw fas fa-times me-1"></i>Cancel</button>
                        </div>    
                        <?php endif; ?>
                        
                        <?php include 'components/buttonGroup.php';?>
                    </div>
                <?php endif; ?>
                <?php if (empty($control_number)): ?>
                    <div class="modal-footer d-flex justify-content-end">
                        <div>
                            <!-- <button type="submit" name="btn_save_straas" hidden></button>
                            <button type="submit" name="btn_submit_straas" hidden></button> -->
                            <button class="btn btn-secondary" name="btn_save_straas" type="submit" id="btn_save_straas"><i class="fa-fw fas fa-file me-1"></i>Draft</button>
                            <button class="btn btn-primary" name="btn_submit_straas" type="submit" id="btn_submit_straas"><i class="fa-fw fas fa-paper-plane me-1"></i>Submit</button>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php include 'components/promtMessage.php';?>
</form>




