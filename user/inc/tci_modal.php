<?php  
if (!empty($control_number)):
    $tbl_tci = mysqli_query($conn,"SELECT * FROM `tbl_tci` where control_number = '$control_number' ");
    while ($rows = mysqli_fetch_array($tbl_tci)) {
        $get_uid            = $rows['uid'];
        $control_number     = $rows['control_number'];
        $form_type          = $rows['form_type'];
        $fullname           = $rows['fullname'];
        $email_add          = $rows['email_add'];
        $contact_no         = $rows['contact_no'];
        $department         = $rows['department'];
        $cluster            = $rows['cluster'];
        $location           = $rows['location'];

        $prob_descript      = $rows['prob_descript'];
        $act_taken          = $rows['act_taken'];
        $act_status         = $rows['act_status'];
        $remarks            = $rows['remarks'];

        $status             = $rows['status'];
        $revised            = $rows['revised'];
        $num_revised        = $rows['num_revised'];
        $date_requested     = $rows['date_requested'];

        $approver           = $rows['approver'];
        $app_status         = $rows['app_status'];
        $appr_date          = $rows['appr_date'];

        $reciever           = $rows['reciever'];
        $rec_status         = $rows['rec_status'];
        $rec_date           = $rows['rec_date'];

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
<form class="text-dark" method="post">
    <div id="view_tci<?php echo empty($control_number) ? '' : $control_number; ?>" class="modal fade" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-xl modal-fullscreen-xl-down" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row g-0 d-flex flex-column-reverse flex-lg-row w-100 gap-3 gap-lg-0">
                        <div class="col-md-12 col-lg-6 col-xl-6 offset-lg-1 offset-xl-1">
                            <h4 class="modal-title fw-bold">BSP TECHNICAL SUPPORT REQUEST FORM</h4>
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
                            <label class="form-label d-block">Control No:&nbsp; <span class="fw-bold"><?php echo empty($control_number) ? '' : 'Adhoc/'.$control_number; ?></span></label>
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
                    <h4 class="text-capitalize text-center fw-bold mt-3">Site information</h4>
                    <div class="row d-flex justify-content-center g-0 mb-2">
                        <div class="col-lg-10">
                            <div class="table-responsive mb-2">
                                <table class="table table-bordered text-nowrap  align-middle text-dark border border-secondary table-sm">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th >Name</th>
                                            <th>Department</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input class="form-control text-dark" type="text" name="fullname" value="<?php echo empty($fullname) ? $my_fullname : ucwords($fullname); ?>" readonly />
                                            </td>
                                            <td>
                                                <input class="form-control text-dark" type="text" name="department" value="<?php echo empty($department) ? '' : $department; ?>" required />
                                            </td>
                                        </tr>
                                        <tr class="bg-dark text-white fw-bold">
                                            <td>Cluster</td>
                                            <td>Location</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <select class="form-select text-dark" name="cluster" required>
                                                    <option value="" selected disabled>Select Location</option>
                                                    <option value="general_cluster" <?php echo empty($cluster) ? '' : ($cluster == 'general_cluster' ? 'selected' : ''); ?> >General Cluster</option>
                                                    <option value="sql_cluster" <?php echo empty($cluster) ? '' : ($cluster == 'sql_cluster' ? 'selected' : ''); ?> >SQL Cluster</option>
                                                    <option value="standalone_node" <?php echo empty($cluster) ? '' : ($cluster == 'standalone_node' ? 'selected' : ''); ?> >Standalone Node</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-select text-dark" name="location" required>
                                                    <option value="" selected disabled>Select Location</option>
                                                    <option value="ho" <?php echo empty($location) ? '' : ($location == 'ho' ? 'selected' : ''); ?> >Head Office</option>
                                                    <option value="lfc" <?php echo empty($location) ? '' : ($location == 'lfc' ? 'selected' : ''); ?>>Local Fallback Center</option>
                                                    <option value="dr" <?php echo empty($location) ? '' : ($location == 'dr' ? 'selected' : ''); ?>>Disaster Recovery</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <h4 class="text-capitalize text-center fw-bold">Support Information</h4>
                            <div class="table-responsive mb-3">
                                <table class="table table-borderless table-sm align-middle text-nowrap border border-secondary">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th colspan="3">Service Request Descriptions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="3">
                                                <textarea class="form-control text-dark" name="prob_descript" style="height: 150px;"><?php echo empty($prob_descript) ? '' : $prob_descript; ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <thead class="bg-dark text-white">
                                                <th>Action Taken</th>
                                                <th>Status</th>
                                                <th>Remarks</th>
                                            </thead>
                                        </tr>
                                        <tr>
                                            <td>
                                                <textarea class="form-control text-dark" name="act_taken" style="height: 150px;" ><?php echo empty($act_taken) ? '' : $act_taken; ?></textarea>
                                            </td>
                                            <td>
                                                <textarea class="form-control text-dark" name="act_status" style="height: 150px;"><?php echo empty($act_status) ? '' : $act_status; ?></textarea>
                                            </td>
                                            <td>
                                                <textarea class="form-control text-dark" name="remarks" style="height: 150px;"><?php echo empty($remarks) ? '' : $remarks; ?></textarea>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <div class="table-responsive">
                                <table class="table table-borderless table-sm align-middle border border-secondary">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th class="text-center" colspan="3">Remarks</th>
                                        </tr>
                                    </thead>
                                    <?php if (!empty($control_number)): ?>
                                    <tbody class="text-dark align-top">
                                        <?php

                                            $no_comments = '<td colspan="3">This form has no comments!</td>';
                                            $txt_area = '<td colspan="3"><textarea class="form-control text-dark" name="comments" placeholder="Please leave a comments here..."  ></textarea></td>';
                                            $tci_remarks = mysqli_query($conn,"SELECT * FROM tbl_remarks where control_number = '$control_number' and form_type = '$form_type' ORDER BY remarks_date ASC ");
                                            $tci_count = mysqli_num_rows($tci_remarks);
                                            if ($tci_count  == true){

                                                while($tci_remarks_rows = mysqli_fetch_array($tci_remarks)):
                                                    $com_id = $tci_remarks_rows['comment_id'];
                                                    $tci_role = $tci_remarks_rows['role'];
                                                    if (($my_role == 1 && $tci_role >=1 && $tci_role <=6) || ($my_role == 2 && $tci_role >=1 && $tci_role <=2) || ($my_role == 3 && $tci_role >=1 && $tci_role <=3) || ($my_role == 4 && $tci_role >=1 && $tci_role <=4) || ($my_role == 5 && $tci_role >=1 && $tci_role <=5) || ($my_role == 6 && $tci_role >=1 && $tci_role <=6) ):
                                                        echo '<td><input type="hidden" name="comment_id" value="'.$com_id.'"></td>';
                                                        echo '<tr>';
                                                        echo '<td width="25%"><span class="fw-bold">'.ucwords($tci_remarks_rows['fullname']).'</span><br><span class="small">'.$tci_remarks_rows['remarks_date'].'</span></td>';
                                                        echo '<td width="75%" colspan="2">'.$tci_remarks_rows['comments'].'</td>';
                                                        echo '</tr>';
                                                    endif;    
                                                endwhile;

                                                if ($my_role == 2 && $app_status == NULL || $my_role == 3 && $rec_status == NULL || $my_role == 4 && $perf_status == NULL || $my_role == 5 && $ver_status == NULL || $my_role == 6 && $ver2_status == NULL){
                                                     echo $txt_area;
                                                }
                                                if ($my_role == 1 && $status == 1 && $revised == NULL) {
                                                    echo $txt_area;
                                                }
                                                if ($my_role == 1 && $status == 0 && $revised == 1){
                                                    echo $txt_area;
                                                }
                                            }else{

                                                if ($my_role == 1 && $status == 1) {
                                                    echo $txt_area;
                                                }
                                                if ($my_role == 2 && $app_status == NULL || $my_role == 3 && $rec_status == NULL || $my_role == 4 && $perf_status == NULL || $my_role == 5 && $ver_status == NULL || $my_role == 6 && $ver2_status == NULL){
                                                    echo $txt_area;
                                                }
                                                if ($my_role == 2 && $app_status == 1 || $my_role == 3 && $rec_status == 1 || $my_role == 4 && $perf_status == 1 || $my_role == 5 && $ver_status == 1 || $my_role == 6 && $ver2_status == 1  ) {
                                                    echo $no_comments;
                                                }
                                                if (($my_role == 1 || $my_role ==2 ) && $status == 0 && $app_status == 0) {
                                                    echo $no_comments;
                                                }
                                                if ($my_role == 1 && $status == 2 ) {
                                                    echo $no_comments;
                                                }

                                            }
                                        ?>
                                    </tbody>
                                    <?php endif; ?>
                                    <?php if (empty($control_number)): ?>
                                    <tbody>
                                         <tr>
                                             <td colspan="3">
                                                 <textarea class="form-control text-dark" name="comments" placeholder="Please leave a comments here..."></textarea>
                                             </td>
                                         </tr>
                                     </tbody>    
                                    <?php endif; ?>                                    
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row g-1 d-flex justify-content-lg-center text-nowrap">
                        <div class="col-sm-12 col-md-6 col-lg-5 col-xl-5 offset-xl-0 p-3 border border-secondary">
                            <label class="form-label fw-bold d-block mb-3">Requested by</label>
                            <div class="d-flex flex-column justify-content-between flex-sm-row">
                                <div class="d-flex flex-column justify-content-between d-block w-100">
                                    <div class="d-flex flex-column justify-content-start">
                                        <label class="form-label" >
                                            <?php 
                                                if (!empty($fullname)) {
                                                    echo '<u>'.ucwords($fullname).'</u>';
                                                }else{
                                                    echo '<label class="form-label">__________________</label>';
                                                }
                                            ?>
                                        </label>
                                        <label class="form-label d-block">Name, BSP</label>
                                    </div>
                                </div>
                                <div class="d-flex flex-column justify-content-end d-block w-100">
                                    <div class="d-flex flex-column justify-content-start">
                                        <label class="form-label" >
                                            <?php 
                                                if (!empty($date_requested)) {
                                                    echo '<u>'.date('M d,  Y - h:i:A ',strtotime($date_requested)).'</u>';
                                                }else{
                                                    echo '<label class="form-label">__________________</label>';
                                                }
                                            ?>
                                        </label>
                                        <label class="form-label d-block">Date and Time</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-5 col-xl-5 p-3 border border-secondary">
                            <label class="form-label fw-bold d-block mb-3">Resolved by</label>
                            <div class="d-flex flex-column justify-content-between flex-sm-row">
                                <div class="d-flex flex-column justify-content-between d-block w-100">
                                    <div class="d-flex flex-column justify-content-start">
                                        <label class="form-label" >
                                            <?php
                                                if (!empty($perf_status)) {
                                                    if ((!empty($perf_status) && $my_role >= 4 && $my_role <= 6) || $my_role == 1 && $perf_status == 1) {
                                                        echo '<u>'.ucwords($performer).'</u>';
                                                    } 
                                                }else{
                                                    echo '<label class="form-label">__________________</label>';
                                                } 
                                            ?>
                                        </label>
                                        <label class="form-label d-block">Name, eBizolution</label>
                                    </div>
                                </div>
                                <div class="d-flex flex-column justify-content-end d-block w-100">
                                    <div class="d-flex flex-column justify-content-start">
                                        <label class="form-label" >
                                            <?php
                                                if (!empty($perf_status)) {
                                                    if ((!empty($perf_status) && $my_role >= 4 && $my_role <= 6) || $my_role == 1 && $perf_status == 1) {
                                                        echo '<u>'.date('M d,  Y - h:i:A ',strtotime($perform_date)).'</u>';
                                                    } 
                                                }else{
                                                    echo '<label class="form-label">__________________</label>';
                                                } 
                                            ?>
                                        </label>
                                        <label class="form-label d-block">Date and Time</label>
                                    </div>
                                </div>
                                <input type="hidden" name="performer_name" value="<?php echo empty($performer) ? $my_fullname : $performer; ?>">
                                <input type="hidden" name="performer_id" value="<?php echo empty($uid) ? '' : $uid; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row g-1 d-flex justify-content-lg-center text-nowrap">
                        <div class="col-sm-12 col-md-6 col-lg-5 col-xl-5 offset-xl-0 p-3 border border-secondary">
                            <label class="form-label fw-bold d-block mb-3">Acknowledged by</label>
                            <div class="d-flex flex-column justify-content-between flex-sm-row">
                                <div class="d-flex flex-column justify-content-between d-block w-100">
                                    <div class="d-flex flex-column justify-content-start">
                                        <label class="form-label" >
                                            <?php
                                                if (!empty($rec_status)) {
                                                    if ((!empty($rec_status) && $my_role >= 3 && $my_role <= 6) || ($my_role == 1 && $rec_status == 1)) {
                                                        echo '<u>'.ucwords($reciever).'</u>';
                                                    } 
                                                }else{
                                                    echo '<label class="form-label">__________________</label>';
                                                } 
                                            ?>
                                        </label>
                                        <label class="form-label d-block">Name, eBizolution</label>
                                    </div>
                                </div>
                                <div class="d-flex flex-column justify-content-end d-block w-100">
                                    <div class="d-flex flex-column justify-content-start">
                                        <label class="form-label" >
                                            <?php
                                                if (!empty($rec_status)) {
                                                    if ((!empty($rec_status) && $my_role >= 3 && $my_role <= 6) || ($my_role == 1 && $rec_status == 1)) {
                                                        echo '<u>'.date('M d,  Y - h:i:A ',strtotime($rec_date)).'</u>';
                                                    } 
                                                }else{
                                                    echo '<label class="form-label">__________________</label>';
                                                } 
                                            ?>
                                        </label>
                                        <label class="form-label d-block">Date and Time</label>
                                    </div>
                                </div>
                                <input type="hidden" name="reciever_name" value="<?php echo empty($reciever) ? $my_fullname : $reciever; ?>">
                                <input type="hidden" name="reciever_id" value="<?=$uid; ?>">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-5 col-xl-5 p-3 border border-secondary">
                            <label class="form-label fw-bold d-block mb-3">Confirmed by</label>
                            <div class="d-flex flex-column justify-content-between flex-sm-row">
                                <div class="d-flex flex-column justify-content-between d-block w-100">
                                    <div class="d-flex flex-column justify-content-start">
                                        <label class="form-label" >
                                            <?php
                                                if (!empty($ver_status)) {
                                                    if ((!empty($ver_status) && $my_role >= 5 && $my_role <= 6) || ($my_role == 1 && $ver_status == 1)) {
                                                        echo '<u>'.ucwords($verifier).'</u>';
                                                    } 
                                                }else{
                                                    echo '<label class="form-label">__________________</label>';
                                                } 
                                            ?>
                                        </label>
                                        <label class="form-label d-block">Name, eBizolution</label>
                                    </div>
                                </div>
                                <div class="d-flex flex-column justify-content-end d-block w-100">
                                    <div class="d-flex flex-column justify-content-start">
                                        <label class="form-label" >
                                            <?php
                                                if (!empty($ver_status)) {
                                                    if ((!empty($ver_status) && $my_role >= 5 && $my_role <= 6) || ($my_role == 1 && $ver_status == 1)) {
                                                        echo '<u>'.date('M d,  Y - h:i:A ',strtotime($ver_date)).'</u>';
                                                    } 
                                                }else{
                                                    echo '<label class="form-label">__________________</label>';
                                                } 
                                            ?>
                                        </label>
                                        <label class="form-label d-block">Date and Time</label>
                                    </div>
                                </div>
                                <input type="hidden" name="verifier_name" value="<?php echo empty($verifier) ? $my_fullname : $verifier ?>" >
                                <input type="hidden" name="verifier_id" value="<?php echo empty($uid) ? '' : $uid; ?>" >
                            </div>
                        </div>
                    </div>
                    <div class="row g-1 d-flex flex-row-reverse justify-content-lg-center text-nowrap">
                        <div class="col-sm-12 col-md-6 col-lg-5 col-xl-5 p-3 border border-secondary">
                            <label class="form-label fw-bold d-block mb-3">Verified by</label>
                            <div class="d-flex flex-column justify-content-between flex-sm-row">
                                <div class="d-flex flex-column justify-content-between d-block w-100">
                                    <div class="d-flex flex-column justify-content-start">
                                        <label class="form-label" >
                                            <?php
                                                if (!empty($ver2_status)) {
                                                    if ((!empty($ver2_status) && $my_role >= 6 && $my_role <= 7) || ($my_role == 1 && $ver2_status == 1)) {
                                                        echo '<u>'.ucwords($verifier_2).'</u>';
                                                    } 
                                                }else{
                                                    echo '<label class="form-label">__________________</label>';
                                                } 
                                            ?>
                                        </label>
                                        <label class="form-label d-block">Name, BSP</label>
                                    </div>
                                </div>
                                <div class="d-flex flex-column justify-content-end d-block w-100">
                                    <div class="d-flex flex-column justify-content-start">
                                        <label class="form-label" >
                                            <?php
                                                if (!empty($ver2_status)) {
                                                    if ((!empty($ver2_status) && $my_role >= 6 && $my_role <= 7) || ($my_role == 1 && $ver2_status == 1)) {
                                                        echo '<u>'.date('M d,  Y - h:i:A ',strtotime($ver2_date)).'</u>';
                                                    } 
                                                }else{
                                                    echo '<label class="form-label">__________________</label>';
                                                } 
                                            ?>
                                        </label>
                                        <label class="form-label d-block">Date and Time</label>
                                    </div>
                                </div>
                                <input type="hidden" name="verifier_2_name" value="<?php echo empty($verifier_2) ? $my_fullname : $verifier_2; ?>">
                                <input type="hidden" name="verifier_2id" value="<?=$uid; ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <?php if (!empty($control_number)): ?>
                    <div class="modal-footer d-flex justify-content-end">
                        <?php if ($status == 1 && $my_role == 1): ?> <!-- // Draft button -->
                        <div>
                            <button class="btn btn-secondary me-2" type="submit" name="btn_update_tci" id="btn_update_tci" ><i class="fa-fw fas fa-refresh me-1"></i>Update</button>
                            <button class="btn btn-primary" type="submit" name="btn_resubmit_tci_draft" id="btn_resubmit_tci_draft" ><i class="fa-fw fas fa-paper-plane me-1"></i>Resubmit</button>
                        </div>
                        <?php endif; ?>
                        <?php if  ($my_role == 1 && $revised == 1): ?> <!-- // Disapproved  -->
                        <div>
                            <button class="btn btn-primary" type="submit" name="btn_resubmit_tci" id="btn_resubmit_tci" ><i class="fa-fw fas fa-paper-plane me-1"></i>Resubmit</button>  
                        </div>
                        <?php endif; ?>
                        <?php if ($my_role == 1 && $status == 3): ?>
                        <div>
                            <button class="btn btn-danger" type="submit" name="btn_cancel" id="btn_cancel" ><i class="fa-fw fas fa-times me-1"></i>Cancel</button>
                        </div>    
                        <?php endif; ?>
                        <?php if ($status == 2 && $my_role == 2): ?> <!-- // button for Approver -->
                        <div>
                            <button class="btn btn-outline-success me-2" type="submit" name="btn_approver" id="name="btn_reciever" " ><i class="fw-fw fas fa-check me-1"></i>Approve</button>      
                            <button class="btn btn-outline-danger" type="submit" name="app_disapproved" id="app_disapproved" ><i class="fa-fw fas fa-times me-1"></i>Disapprove</button> 
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
                            <button class="btn btn-secondary" type="submit" name="btn_save_tci" id="btn_save_tci" ><i class="fa-fw fas fa-file me-1"></i>Draft</button>
                            <button class="btn btn-primary" type="submit" name="btn_submit_tci" id="btn_submit_tci" ><i class="fa-fw fas fa-paper-plane me-1"></i>Submit</button>                                
                        </div>
                    </div>    
                <?php endif; ?>
            </div>
        </div>
    </div>
</form>