<?php  
if (!empty($control_number)):
    $tbl_cps = mysqli_query($conn,"SELECT * FROM `tbl_cps` where control_number = '$control_number' ");
    while ($rows = mysqli_fetch_array($tbl_cps)) {
        
        $get_uid                = $rows['uid'];
        $cps_new_control_num     = $rows['cps_new_control_num'];
        $cps_up_control_num     = $rows['cps_up_control_num'];
        $control_number     = $rows['control_number'];
        $form_type          = $rows['form_type'];
        $fullname           = $rows['fullname'];
        $email_add          = $rows['email_add'];
        $contact_no         = $rows['contact_no'];
        $system_name        = $rows['system_name'];
        $hostname           = $rows['hostname'];
        $pattern            = $rows['pattern'];
        $instance_name      = $rows['instance_name'];
        $location           = $rows['location'];
        $env_profile        = $rows['env_profile'];
        $ip_add             = $rows['ip_add'];
        $ip_group           = $rows['ip_group'];

        // New cps data
        $vcpu_size          = $rows['vcpu_size'];
        $vcpu_filesystem    = $rows['vcpu_filesystem'];
        $vcpu_remarks       = $rows['vcpu_remarks'];
        $ram_size           = $rows['ram_size'];
        $ram_filesystem     = $rows['ram_filesystem'];
        $ram_remarks        = $rows['ram_remarks'];
        // New CPS data
        
        $ue_enroll_size     = $rows['ue_enroll_size'];
        $ue_filesystem      = $rows['ue_filesystem'];
        $ue_remarks         = $rows['ue_remarks'];

        $status             = $rows['status'];
        $date_requested     = $rows['date_requested'];
        $revised            = $rows['revised'];
        $num_revised        = $rows['num_revised'];
        $cancelled          = $rows['cancelled'];

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
    $tbl_cps = mysqli_query($conn,"SELECT * FROM `tbl_cps` where control_number = '$cps_new_control_num' ");
    while ($rows_2 = mysqli_fetch_array($tbl_cps)) {
        $vcpu_size_old      = $rows_2['vcpu_size'];

        $ram_size_old           = $rows_2['ram_size'];
        $ue_enroll_size_old     = $rows_2['ue_enroll_size'];
    }

    $tbl_cps_up = mysqli_query($conn,"SELECT * FROM `tbl_cps` where control_number = '$cps_up_control_num' ");
    while ($rows_3 = mysqli_fetch_array($tbl_cps_up)) {
        $vcpu_size_up      = $rows_3['vcpu_size'];

        $ram_size_up           = $rows_3['ram_size'];
        $ue_enroll_size_up     = $rows_3['ue_enroll_size'];
    }


endif;
?>
<form class="text-dark" id="frm_cps_del_id" method="post" autocomplete="off">
    <div id="view_cps_delete<?php echo empty($control_number) ? '' : $control_number; ?>" class="modal fade" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false" >
        <div class="modal-dialog modal-xl modal-fullscreen-xl-down" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row g-0 d-flex flex-column-reverse flex-lg-row w-100 gap-3 gap-lg-0">
                        <div class="col-md-12 col-lg-6 col-xl-6 offset-lg-1 offset-xl-1">
                            <h4 class="modal-title fw-bold">BSP CLOUDPAK SYSTEM FORM (DELETE)</h4>
                        </div>
                        <div class="col-md-12 col-lg-4 col-xl-3 offset-lg-1 offset-xl-2 d-lg-flex justify-content-lg-end">
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
                             <label class="form-label d-block">Control No:&nbsp; <span class="fw-bold"><?php echo empty($control_number) ? '' : 'CPS/'.$control_number; ?></span></label>
                             <input type="hidden" name="txt_control_number" value="<?php echo empty($control_number) ? '' : $control_number; ?>" readonly >
                             <input type="hidden" name="fullname" value="<?php echo empty($fullname) ? $my_fullname : ucwords($fullname); ?>" >
                             <input type="hidden" name="contact_no" value="<?php echo empty($contact_no) ? '' : $contact_no; ?>" readonly>
                             <input type="hidden" name="email_add" value="<?php echo empty($email) ? '' : $email; ?>" readonly>
                             <input type="hidden" name="form_owner_mail" value="<?php echo empty($email_add) ? '' : $email_add; ?>" readonly>
                             <input type="hidden" name="form_type" value="<?php echo empty($form_type) ? '' : $form_type; ?>" readonly>
                             <input type="hidden" name="num_revised" value="<?php echo empty($num_revised) ? '' : $num_revised; ?>" readonly placeholder="Total Revised">
                             <input type="hidden" name="his_role" value="<?php echo empty($my_role) ? '' : $my_role; ?>" readonly>
                            <input type="hidden" name="cps_new_control_num" value="<?php echo empty($cps_new_control_num) ? '' : $cps_new_control_num; ?>" readonly>
                            <input type="hidden" name="cps_up_control_num" id="cps_up_control_num" value="<?php echo empty($cps_up_control_num) ? '' : $cps_up_control_num; ?>"  placeholder="CPS Update No." >
                            <input type="hidden" name="his_uid" value="<?php echo empty($get_uid) ? '' : $get_uid; ?>" readonly>
                        </div>
                    </div>
                            
                    <h4 class="text-capitalize text-center fw-bold mt-3">Site information</h4>
                    <div class="row d-flex justify-content-center g-0 mb-2">
                        <div class="col-lg-10">
                            <div class="table-responsive mb-2">
                                <table class="table text-nowrap align-middle border border-secondary text-dark table-sm">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th colspan="2">System Name</th>
                                            
                                            <th>Instance Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="2">
                                                <input class="form-control text-dark" type="text" name="cps_del_system_name" id="cps_del_system_name" value="<?php echo empty($system_name) ? '' : $system_name; ?>" readonly />
                                            </td>
                                            
                                            <td>
                                                <input class="form-control text-dark" type="text" name="cps_del_instance_name" id="cps_del_instance_name" value="<?php echo empty($instance_name) ? '' : $instance_name; ?>" readonly />
                                            </td>
                                        </tr>
                                        <tr class="bg-dark text-white fw-bold">
                                            <td>Location</td>
                                            <td>Envi Profile</td>
                                            <th>Pattern</th> 
                                        </tr>
                                        <tr>
                                            <td>
                                                <select class="form-select text-dark" name="cps_del_location" id="cps_del_location" required>
                                                    <option value="" selected>Select location</option>
                                                    <option value="ho" <?php echo empty($location) ? '' : ($location == 'ho' ? 'selected' : ''); ?> >HO</option>
                                                    <option value="spc" <?php echo empty($location) ? '' : ($location == 'spc' ? 'selected' : ''); ?> >SPC</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-select text-dark" name="cps_del_env_profile" id="cps_del_env_profile" required>
                                                    <option value="" selected>Select Envi Profile</option>
                                                    <option value="platinum" <?php echo empty($env_profile) ? '' : ($env_profile == 'platinum' ? 'selected' : ''); ?> >Platinum</option>
                                                    <option value="silver" <?php echo empty($env_profile) ? '' : ($env_profile == 'silver' ? 'selected' : ''); ?> >Gold</option>
                                                    <option alue="gold" <?php echo empty($env_profile) ? '' : ($env_profile == 'gold' ? 'selected' : ''); ?> >Silver</option>
                                                    <option value="bronze" <?php echo empty($env_profile) ? '' : ($env_profile == 'bronze' ? 'selected' : ''); ?> >Bronze</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input class="form-control text-dark" type="text" name="cps_del_pattern" id="cps_del_pattern" value="<?php echo empty($pattern) ? '' : $pattern; ?>" readonly />
                                            </td>  
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <h4 class="text-capitalize text-center fw-bold">Delete Request</h4>
                            <div class="table-responsive">
                                <table class="table table-borderless align-middle text-nowrap border border-secondary text-dark table-sm">
                                    <thead class="bg-dark text-white">
                                        <tr >
                                            <th><span class="invisible"></span></th>
                                            <th>FROM:</th>
                                            <th colspan="3">TO:</th>
                                        </tr>
                                        <tr>
                                            <th>Description</th>
                                            <th>Requested</th>
                                            <th>Requested</th>
                                            <th>Information</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="fw-bold">Hostname</td>
                                            <td colspan="2">
                                                <?php if (empty($control_number)): ?>
                                                    <div class="input-group">
                                                        <input class="form-control text-dark shadow-none" type="search" name="cps_del_search_txt" id="cps_del_search_txt" value="<?php echo empty($hostname) ? '' : $hostname; ?>" >
                                                        <button class="btn btn-secondary shadow-none" type="button" id="btn_cps_del_search" name="btn_cps_del_search">Search</button>   
                                                    </div>                                                
                                                    <div class="position-absolute">
                                                       <ul class="list-group rounded-bottom shadow user-select-none" id="cps_del_search_result"></ul> 
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (!empty($control_number)): ?>
                                                        <input class="form-control text-dark shadow-none" type="text" name="cps_del_search_txt" id="cps_del_search_txt" readonly value="<?php echo empty($hostname) ? '' : $hostname; ?>" >
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">IP Address</td>
                                            <td colspan="4">
                                                <input class="form-control text-dark" type="text" name="cps_del_ip_add" id="cps_del_ip_add" value="<?php echo empty($ip_add) ? '' : $ip_add; ?>"  readonly/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">IP Group</td>
                                            <td colspan="4">
                                                <input class="form-control text-dark" type="text" name="cps_del_ip_group" id="cps_del_ip_group" value="<?php echo empty($ip_group) ? '' : $ip_group; ?>" readonly />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">vCPU</td>
                                            <td>
                                                <input class="form-control text-dark" type="text" name="cps_del_vcpu_size" id="cps_del_vcpu_size" value="<?php echo empty($vcpu_size_old) ? '' : $vcpu_size_old; ?>" readonly /> 
                                            </td>
                                            <td>
                                                <input class="form-control text-dark" type="text" name="cps_del_vcpu_size_req" id="cps_del_vcpu_size_req" value="<?php echo empty($vcpu_size) ? '' : $vcpu_size; ?>"  readonly />
                                            </td>
                                            <td>
                                                <input class="form-control text-dark" type="text" name="cps_del_vcpu_filesystem" id="cps_del_vcpu_filesystem" value="<?php echo empty($vcpu_filesystem) ? '' : $vcpu_filesystem; ?>" readonly />
                                            </td>
                                            <td>
                                                <input class="form-control text-dark" type="text" name="cps_del_vcpu_remarks" id="cps_del_vcpu_remarks"  value="<?php echo empty($vcpu_remarks) ? '' : $vcpu_remarks; ?>" readonly />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">RAM (GB)</td>
                                            <td>
                                                <input class="form-control text-dark" type="text" name="cps_del_ram_size" id="cps_del_ram_size" value="<?php echo empty($ram_size_old) ? '' : $ram_size_old; ?>"  readonly /> 
                                            </td>
                                            <td>
                                                <input class="form-control text-dark" type="text" name="cps_del_ram_size_req" id="cps_del_ram_size_req" value="<?php echo empty($ram_size) ? '' : $ram_size; ?>" readonly />
                                            </td>
                                            <td>
                                                <input class="form-control text-dark" type="text"  name="cps_del_ram_filesystem" id="cps_del_ram_filesystem" value="<?php echo empty($ram_filesystem) ? '' : $ram_filesystem; ?>" readonly  />
                                            </td>
                                            <td>
                                                <input class="form-control text-dark" type="text" name="cps_del_ram_remarks" id="cps_del_ram_remarks"  value="<?php echo empty($ram_remarks) ? '' : $ram_remarks; ?>" readonly />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">User Registration</td>
                                            <td>
                                                <input class="form-control text-dark" type="text" name="cps_del_ue_enroll_size" id="cps_del_ue_enroll_size" value="<?php echo empty($ue_enroll_size_old) ? '' : $ue_enroll_size_old; ?>"  readonly /> 
                                            </td>
                                            <td>
                                                <input class="form-control text-dark" type="text" name="cps_del_ue_enroll_size_req" id="cps_del_ue_enroll_size_req" value="<?php echo empty($ue_enroll_size) ? '' : $ue_enroll_size; ?>" readonly/>
                                            </td>
                                            <td>
                                                <input class="form-control text-dark" type="text" name="cps_del_ue_filesystem" id="cps_del_ue_filesystem" value="<?php echo empty($ue_filesystem) ? '' : $ue_filesystem; ?>" readonly />
                                            </td>
                                            <td>
                                                <input class="form-control text-dark" type="text" name="cps_del_ue_remarks" id="cps_del_ue_remarks" value="<?php echo empty($ue_remarks) ? '' : $ue_remarks; ?>" readonly />
                                            </td>
                                        </tr>
                                        <tbody id="cps_del_load_others"></tbody>
                                        <?php 
                                            if (!empty($control_number)):
                                                $num = 1;
                                                $sql = mysqli_query($conn,"SELECT * FROM tbl_forms_others where hostname = '$hostname' and form_type = '3' and control_number = '$cps_new_control_num' ");
                                                $count = mysqli_num_rows($sql);

                                                // If hostname is Exist!
                                                if ($count > 0):
                                                    $sql_2 = mysqli_query($conn,"SELECT * FROM tbl_forms_others where hostname = '$hostname' and form_type = '3-1' and control_number = '$cps_up_control_num' ");
                                                    $count_2 = mysqli_num_rows($sql_2);
                                                    if ($count_2 > 0) {
                                                        // if there is HCI Update data, It will fetch the HCI Update Data of DISK
                                                        while ($rows_2 = mysqli_fetch_assoc($sql_2)) {
                                                            echo '<tr>';
                                                            echo '<td class="text-dark fw-bold">Disk (GB) '.$num++.'</td>';
                                                            echo '<td><input class="form-control text-dark" type="text" id="others_1[]" name="others_1[]" value="'.$rows_2['others_1'].'" readonly></td>';
                                                            echo '<td><input class="form-control text-dark" type="text" id="others_2[]" name="others_2[]" value="'.$rows_2['others_2'].'" readonly></td>';
                                                            echo '<td><input class="form-control text-dark" type="text" id="others_3[]" name="others_3[]" value="'.$rows_2['others_3'].'" readonly ></td>';
                                                            echo '<td><input class="form-control text-dark" type="text" id="others_4[]" name="others_4[]" value="'.$rows_2['others_4'].'" readonly ></td>';
                                                            echo '</tr>';
                                                        }
                                                    }else{
                                                        // if there is no HCI Update, The system will get the Data of HCI new and fetch to all textbox!
                                                        while ($rows = mysqli_fetch_assoc($sql)) {
                                                            echo '<tr>';
                                                            echo '<td class="text-dark fw-bold">Disk (GB) '.$num++.'</td>';
                                                            echo '<td><input class="form-control text-dark" type="text" id="others_1[]" name="others_1[]" value="'.$rows['others_1'].'" readonly></td>';
                                                            echo '<td><input class="form-control text-dark" type="text" id="others_2[]" name="others_2[]" readonly></td>';
                                                            echo '<td><input class="form-control text-dark" type="text" id="others_3[]" name="others_3[]" readonly></td>';
                                                            echo '<td><input class="form-control text-dark" type="text" id="others_4[]" name="others_4[]" readonly ></td>';
                                                            echo '</tr>';
                                                        }
                                                    }
                                                endif;
                                            endif;
                                            if (empty($control_number)):
                                                    // the purpose of this is to display the blank textfield of DISK GB
                                                    echo '<tr id="hci_del_disk">';
                                                    echo '<td class="text-dark fw-bold">Disk (GB) </td>';
                                                    echo '<td><input class="form-control text-dark" type="text" readonly></td>';
                                                    echo '<td><input class="form-control text-dark" type="text" readonly></td>';
                                                    echo '<td><input class="form-control text-dark" type="text" readonly ></td>';
                                                    echo '<td><input class="form-control text-dark" type="text" readonly ></td>';
                                                    echo '</tr>';                                       
                                            endif;
                                        ?> 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <?php
                                include 'components/comment.php';
                            ?>
                        </div>
                    </div>
                    <?php
                        include 'components/authority.php';
                    ?>
                </div>
                <?php if (!empty($control_number)): ?>
                <div class="modal-footer d-flex justify-content-end">       
                    <?php if ($status == 1 && $my_role == 1): ?> <!-- // Draft button -->
                    <div>
                        <button class="btn btn-secondary me-2" type="submit" name="btn_update_cps_del" id="btn_update_cps_del" ><i class="fa-fw fas fa-refresh me-1"></i>Update</button>
                        <button class="btn btn-primary" type="submit" name="btn_submit_draft_cps_del" id="btn_submit_draft_cps_del" ><i class="fa-fw fas fa-paper-plane me-1"></i>Resubmit</button>
                    </div>
                    <?php endif; ?>
                    <?php if ($my_role == 1 && $revised == 1): ?>
                    <div>
                        <button class="btn btn-primary" type="submit" name="btn_resubmit_cps_del" id="btn_resubmit_cps_del" ><i class="fa-fw fas fa-paper-plane me-1"></i>Resubmit</button>
                    </div>    
                    <?php endif; ?>
                    <?php if ($status == 0 && $my_role == 1): ?> <!-- // Disapproved  -->
                    <!-- <div>
                        <button class="btn btn-primary" type="submit" name="btn_resubmit" id="btn_resubmit">Resubmit</button>  
                    </div> -->
                    <?php endif; ?>
                    <?php if ($my_role == 1 && $status == 2): ?>
                    <div>
                        <button class="btn btn-danger" type="submit" name="btn_cancel_cps_del" id="btn_cancel_cps_del" ><i class="fa-fw fas fa-times me-1"></i>Cancel</button>
                    </div>    
                    <?php endif; ?>
                    <?php if ($status == 2 && $my_role == 2): ?> <!-- // button for Approver -->
                    <div>
                        <button class="btn btn-outline-success me-2" type="submit" name="btn_approver" id="btn_approver" ><i class="fw-fw fas fa-check me-1"></i>Approve</button>      
                        <button class="btn btn-outline-danger me-2" type="submit" name="app_disapproved" id="app_disapproved" ><i class="fa-fw fas fa-times me-1"></i>Disapprove</button>
                        <button class="btn btn-danger" type="submit" name="approver_returned" id="approver_returned" ><i class="fa-fw fas fa-times me-1"></i>Return to Sender</button> 
                    </div>
                    <?php endif; ?>
                    <?php if ($status == 3 && $my_role == 3): ?> <!-- // Button for Reciever -->
                    <div>
                        <button class="btn btn-outline-success me-2" type="submit" name="btn_reciever" id="btn_reciever" ><i class="fa-fw fas fa-check me-1"></i>Acknowledge Receipt</button>      
                        <!-- <button class="btn btn-outline-danger" type="submit" name="rec_disapproved" ><i class="fa-fw fas fa-times me-1"></i>Return to Sender</button>  -->
                    </div>
                    <?php endif; ?>
                    <?php if ($status == 4 && $my_role == 4): ?> <!-- // Button for Performer -->
                    <div>
                        <button class="btn btn-outline-success me-2" type="submit" name="btn_performer" id="btn_performer" ><i class="fa-fw fas fa-check me-1"></i>Task Complete</button>      
                        <!-- <button class="btn btn-outline-danger" type="submit" name="performer_disapproved" ><i class="fa-fw fas fa-times me-1"></i>Return to Sender</button>  -->
                    </div>
                    <?php endif; ?>
                    <?php if ($status == 5 && $my_role == 5): ?> <!-- // Button for Confirmer -->
                    <div>
                        <button class="btn btn-outline-success me-2" type="submit" name="btn_confirmer" id="btn_confirmer" ><i class="fa-fw fas fa-check me-1"></i>Confirm</button>
                    </div>
                    <?php endif; ?>
                    <?php if ($status == 6 && $my_role == 6): ?> <!-- // Button for Verifier -->
                    <div>
                        <button class="btn btn-outline-success me-2" type="submit" name="btn_verifier" id="btn_verifier" ><i class="fa-fw fas fa-check me-1"></i>Verify</button>                                      
                    </div>
                    <?php endif; ?>    
                </div>
                <?php endif; ?>
                <?php if (empty($control_number)): ?>
                    <div class="modal-footer d-flex justify-content-end">
                        <div>
                            <button class="btn btn-secondary" type="submit" name="btn_save_cps_del" id="btn_save_cps_del" disabled><i class="fa-fw fas fa-file me-1"></i>Draft</button>
                            <button class="btn btn-primary" type="submit" name="btn_submit_cps_del" id="btn_submit_cps_del" disabled><i class="fa-fw fas fa-paper-plane me-1"></i>Submit</button>                                
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</form>