<?php  
// // straas Update table
if (!empty($control_number)):
    $tbl_straas_update = mysqli_query($conn,"SELECT * FROM `tbl_straas` where control_number = '$control_number' ");
    while ($rows = mysqli_fetch_array($tbl_straas_update)) {
        $get_uid                    = $rows['uid'];
        $straas_new_control_num        = $rows['straas_new_control_num'];
        $control_number             = $rows['control_number'];
        $form_type                  = $rows['form_type'];
        $fullname                   = $rows['fullname'];
        $email_add                  = $rows['email_add'];
        $contact_no                 = $rows['contact_no'];
        $department                 = $rows['department'];
        $location                   = $rows['location'];

        $hostname                   = $rows['hostname'];
        $straas_up_req_host_port            = $rows['host_port'];
        $straas_up_host_port_comment        = $rows['host_port_comment'];

        $status                     = $rows['status'];
        $date_requested             = $rows['date_requested'];
        $revised                    = $rows['revised'];
        $num_revised                = $rows['num_revised'];

        $approver_id                = $rows['approver_id'];
        $approver                   = $rows['approver'];
        $app_status                 = $rows['app_status'];
        $appr_date                  = $rows['appr_date'];

        $reciever_id                = $rows['reciever_id'];
        $reciever                   = $rows['reciever'];
        $rec_status                 = $rows['rec_status'];
        $rec_date                   = $rows['rec_date'];

        $performer_id               = $rows['performer_id'];
        $performer                  = $rows['performer'];
        $perf_status                = $rows['perf_status'];
        $perform_date               = $rows['perform_date'];

        $verifier                   = $rows['verifier'];
        $ver_status                 = $rows['ver_status'];
        $ver_date                   = $rows['ver_date']; 

        $verifier_2                 = $rows['verifier_2'];
        $ver2_status                = $rows['ver2_status'];
        $ver2_date                  = $rows['ver2_date'];     
    } 


    // //Fetch StraaS NEW table
    $tbl_straas = mysqli_query($conn,"SELECT * FROM `tbl_straas` where control_number = '$straas_new_control_num' ");
    while ($rows_2 = mysqli_fetch_array($tbl_straas)) {
       
        $straas_up_host_port                = $rows_2['host_port'];
        $date_accomplished          = $rows_2['date_requested'];
    }
endif;
?>
<form class="text-dark" id="form_update_straas" name="form_update_straas" method="post" autocomplete="off">
    <div id="view_straas_update<?php echo empty($control_number) ? '' : $control_number; ?>" class="modal" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-xl modal-fullscreen-xl-down" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row g-0 d-flex flex-column-reverse flex-lg-row w-100 gap-3 gap-lg-0">
                        <div class="col-md-12 col-lg-5 col-xl-4 offset-lg-1 offset-xl-1">
                            <h4 class="modal-title fw-bold text-nowrap">BSP STRAAS REQUEST FORM (UPDATE)</h4>
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
                            <label class="form-label d-block">Date Approved: <span class="fw-bold" id="straas_date_accomplished"><?php echo empty($date_accomplished) ? '' : $date_accomplished; ?></span></label>
                            <label class="form-label d-block">Control No:&nbsp; <span class="fw-bold"><?php echo empty($control_number) ? '' : 'straas/'.$control_number; ?></span></label>
                            <input type="hidden" name="txt_control_number" value="<?php echo empty($control_number) ? '' : $control_number; ?>" readonly >
                            <input type="hidden" name="contact_no" value="<?php echo empty($contact_no) ? '' : $contact_no; ?>" readonly>
                            <input type="hidden" name="email_add" value="<?php echo empty($email) ? '' : $email; ?>" readonly>
                            <input type="hidden" name="form_owner_mail" value="<?php echo empty($email_add) ? '' : $email_add; ?>" readonly>
                            <input type="hidden" name="form_type" value="<?php echo empty($form_type) ? '' : $form_type; ?>" readonly>
                            <input type="hidden" name="num_revised" value="<?php echo empty($num_revised) ? '' : $num_revised; ?>" readonly placeholder="Total Revised">
                            <input type="hidden" name="his_role" value="<?php echo empty($my_role) ? '' : $my_role; ?>" readonly>
                            <input type="hidden" name="straas_new_control_num" >
                            <input type="hidden" name="his_uid" value="<?php echo empty($get_uid) ? '' : $get_uid; ?>" readonly>
                        </div>
                    </div>

                    <h4 class="text-capitalize text-center mt-3 fw-bold">Site information</h4>
                    <div class="row d-flex justify-content-center g-0 mb-3">
                        <div class="col-lg-10">
                            <div class="table-responsive mb-2">
                                <table class="table table-borderless text-nowrap table-sm align-middle border border-secondary">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th>Name<span class="text-danger ms-2">*</span></th>
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
                                                <input class="form-control text-dark" type="text" name="straas_up_department" id="straas_up_department" value="<?php echo empty($department) ? '' : $department; ?>" readonly />
                                            </td>
                                            <td>
                                                <select class="form-select text-dark" name="straas_up_location" id="straas_up_location" required >
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
                                            
                                            <td colspan="3">
                                            <?php if (empty($control_number)): ?>
                                                <div class="input-group">
                                                    <input class="form-control text-dark shadow-none" type="search" name="straas_up_search_txt" id="straas_up_search_txt" value="<?php echo empty($hostname) ? '' : $hostname; ?>" onkeypress="return /[0-9A-Z.-_]/i.test(event.key)" >
                                                    <button class="btn btn-secondary shadow-none" type="button" id="btn_straas_up_search" name="btn_straas_up_search">Search</button>   
                                                </div>                                                
                                                <div class="position-absolute">
                                                   <ul class="list-group rounded-bottom shadow user-select-none" id="straas_up_search_result"></ul> 
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($control_number)): ?>
                                                    <input class="form-control text-dark shadow-none" type="text" name="straas_up_search_txt" id="straas_up_search_txt" readonly value="<?php echo empty($hostname) ? '' : $hostname; ?>" onkeypress="return /[0-9A-Z.-_]/i.test(event.key)" >
                                            <?php endif; ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <h4 class="text-capitalize text-center fw-bold">Change Request</h4>
                            <table class="table table-borderless align-middle text-nowrap table-sm text-dark border border-secondary">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th><span class="invisible"></span></th>
                                        <th>FROM:</th>
                                        <th colspan="2">TO:</th>
                                    </tr>
                                    <tr>
                                        <th>Description</th>
                                        <th>Requested</th>
                                        <th>Requested</th>
                                        <th>Comment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="fw-bold">Host Port<span class="text-danger ms-2">*</span></td>
                                        <td>
                                            <input class="form-control text-dark" type="text"  name="straas_up_host_port" id="straas_up_host_port" value="<?php echo empty($straas_up_host_port) ? '' : $straas_up_host_port; ?>" readonly />
                                        </td>
                                        <td>
                                            <input class="form-control text-dark" type="text" name="straas_up_req_host_port" id="straas_up_req_host_port" maxlength="2" value="<?php echo empty($straas_up_req_host_port) ? '' : $straas_up_req_host_port; ?>" onkeypress="return /[0-9]/i.test(event.key)" />
                                        </td>
                                        <td>
                                            <input class="form-control text-dark" type="text" name="straas_up_host_port_comment" id="straas_up_host_port_comment" value="<?php echo empty($straas_up_host_port_comment) ? '' : $straas_up_host_port_comment; ?>" />
                                        </td>
                                    </tr>
                                </tbody>
                             
                                <tbody id="straas_load_others"></tbody>
                                <?php 
                                    if (!empty($control_number)):
                                        $num = 1;
                                        $sql_2 = mysqli_query($conn,"SELECT * FROM tbl_forms_others where hostname = '$hostname' and form_type = '$form_type' and control_number = '$control_number' ");
                                        $count_2 = mysqli_num_rows($sql_2);
                                        if ($count_2 > 0) {
                                            while ($rows_2 = mysqli_fetch_assoc($sql_2)) {
                                                echo '<tr>';
                                                echo '<td class="text-dark fw-bold">Volume<span class="text-danger ms-2">*</span> '.$num++.' </td>';
                                                echo '<td><input type="hidden" name="others_id[]" value="'.$rows_2['others_id'].'" placeholder=""><input class="form-control text-dark" type="text" id="others_1[]" name="others_1[]" value="'.$rows_2['others_1'].'" readonly></td>';
                                                echo '<td><input class="form-control text-dark" type="text" id="others_2[]" name="others_2[]" value="'.$rows_2['others_2'].'" onkeypress="return /[0-9]/i.test(event.key)" ></td>';
                                                // echo '<td><input class="form-control text-dark" type="text" id="others_3[]" name="others_3[]" value="'.$rows_2['others_3'].'" ></td>';
                                                echo '<td><textarea class="form-control" id="others_3[]" rows="1" name="others_3[]" >'.$rows_2['others_3'].'</textarea></td>';
                                                echo '</tr>';
                                            }
                                        }else{
                                            echo '<tr>';
                                            echo '<td class="text-dark fw-bold">Volume<span class="text-danger ms-2">*</span></td>';
                                            echo '<td><input type="hidden" name="others_id[]" value="" placeholder=""><input class="form-control text-dark" type="text" id="others_1" name="others_1[]" value="" readonly onkeypress="return /[0-9]/i.test(event.key)"></td>';
                                            echo '<td><input class="form-control text-dark" type="text" id="others_2" name="others_2[]" ></td>';
                                            // echo '<td><input class="form-control text-dark" type="text" name="others_3[]"></td>';
                                            echo '<td><textarea class="form-control" name="others_3[]" id="others_2" rows="1"></textarea></td>';
                                            echo '</tr>';     
                                        }
                                    endif;
                                    if (empty($control_number)):
                                            // the purpose of this is to display the blank textfield of DISK GB
                                            echo '<tr id="straas_up_disk" >';
                                            echo '<td class="text-dark fw-bold">Volume<span class="text-danger ms-2">*</span></td>';
                                            echo '<td><input class="form-control text-dark" type="text" readonly></td>';
                                            echo '<td><input class="form-control text-dark" type="text" ></td>';
                                            // echo '<td><input class="form-control text-dark" type="text" ></td>';
                                            echo '<td><textarea class="form-control" name="others_3[]" id="others_2" rows="1"></textarea></td>';
                                            echo '</tr>';                                      
                                    endif;
                                ?>                               
                            </table>
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
                            <button class="btn btn-secondary me-2" type="submit" name="btn_straas_up_update" id="btn_straas_up_update"><i class="fa-fw fas fa-refresh me-1"></i>Update</button>
                            <button class="btn btn-primary" type="submit" name="btn_straas_up_submit_draft" id="btn_straas_up_submit_draft"><i class="fa-fw fas fa-paper-plane me-1"></i>Resubmit</button>
                        </div>
                        <?php endif; ?>
                        <?php if ($my_role == 1 && $revised == 1): ?>
                        <div>
                            <button class="btn btn-primary" type="submit" name="btn_straas_up_resubmit" id="btn_straas_up_resubmit"><i class="fa-fw fas fa-paper-plane me-1"></i>Resubmit</button>
                        </div>    
                        <?php endif; ?>
                        <?php if ($status == 0 && $my_role == 1): ?> <!-- // Disapproved  -->
                        <!-- <div>
                            <button class="btn btn-primary" type="submit" name="btn_resubmit" id="btn_resubmit">Resubmit</button>  
                        </div> -->
                        <?php endif; ?>
                        <?php if ($my_role == 1 && $status == 2): ?>
                        <div>
                            <button class="btn btn-danger launchModal" type="button" id="btn_straas_up_cancel" data-bs-toggle="modal" data-bs-target="#myModal2<?php echo $formt; echo empty($control_number) ? '' : $control_number; ?>" value="Do you want to cancel this request?"><i class="fa-fw fas fa-times me-1"></i>Cancel</button>
                            <!-- <button class="btn btn-danger" type="submit" name="btn_straas_up_cancel" id="btn_straas_up_cancel" ><i class="fa-fw fas fa-times me-1"></i>Cancel</button> -->
                        </div>    
                        <?php endif; ?>
                        <?php include 'components/buttonGroup.php';?>
                    </div>
                <?php endif; ?>
                <?php if (empty($control_number)): ?>
                    <div class="modal-footer d-flex justify-content-end">
                        <div>
                            <button class="btn btn-secondary" type="submit" id="btn_save_straas_up" name="btn_save_straas_up" disabled ><i class="fa-fw fas fa-file me-1" ></i>Draft</button>
                            <button class="btn btn-primary" type="submit"  id="btn_submit_straas_up" name="btn_submit_straas_up" disabled ><i class="fa-fw fas fa-paper-plane me-1"></i>Submit</button>      
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php include 'components/promtMessage.php';?>
</form>