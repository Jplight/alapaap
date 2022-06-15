<?php  
session_start();
include '../../model/connection.php';
$uid = $_SESSION['uid'];
$role = $_SESSION['role'];
if (!isset($uid)) {
    header("location: ../index.php");
}
$control_number = $_REQUEST['control_number'];
$sql = mysqli_query($conn,"SELECT * FROM tbl_user where uid = '$uid' and role = '$role' ");
while ($rows = mysqli_fetch_array($sql)):
    $my_fullname    = $rows['first_name']." ".$rows['last_name'];
    $email          = $rows['email_add'];
    $contact_no     = $rows['contact_no'];
    $my_role        = $rows['role'];
    $sub_role       = $rows['sub_role'];
    $role_count     = $my_role + 1;
endwhile;
?>
<!DOCTYPE html>
<html>
    <head >

        <title>Alapaap | Print Request</title>
        <link rel="icon" type="image/svg+xml" sizes="30x24" href="../../assets/img/android-chrome-192x192.png">
        <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
        <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
        <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="../assets/fonts/fontawesome5-overrides.min.css">
        <style type="text/css">
            table { page-break-inside:auto }
            tr    { page-break-inside:avoid; page-break-after:auto }
            thead { display:table-header-group; }
            tfoot { display:table-footer-group; }

            @page { 
                size: auto;
                margin: 20mm 0 10mm 0;
            }
            body {
                margin:0;
                padding:0;
            }    
        </style>
    </head>
    <body> 
        <div class="col-10 offset-1" >
            <?php  
                if (!empty($control_number)):
                    $tbl_hci = mysqli_query($conn,"SELECT * FROM `tbl_hci` where control_number = '$control_number' ");
                    while ($rows = mysqli_fetch_array($tbl_hci)) {
                        $control_number     = $rows['control_number'];
                        $form_type          = $rows['form_type'];
                        $fullname           = $rows['fullname'];
                        $email_add          = $rows['email_add'];
                        $contact_no         = $rows['contact_no'];
                        $department         = $rows['department'];
                        $location           = $rows['location'];
                        $cluster            = $rows['cluster'];

                        $hostname           = $rows['hostname'];
                        $vcpu               = $rows['vcpu'];
                        $vcpu_comment       = $rows['vcpu_comment'];
                        $ram                = $rows['ram'];
                        $ram_comment        = $rows['ram_comment'];
                        
                        $os                 = $rows['os'];
                        $os_comment         = $rows['os_comment'];

                        $txt_os_descript    = $rows['txt_os_descript'];
                        $txt_define_parti   = $rows['txt_define_parti'];

                        $ip_comment         = $rows['ip_comment'];
                        $vlan_comment       = $rows['vlan_comment'];

                        $ip_add_vlan        = $rows['ip_add_vlan'];
                        $txt_ip_vlan        = $rows['txt_ip_vlan'];
                        $hci_users          = $rows['hci_users'];
                        $txt_hci_users      = $rows['txt_hci_users'];

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
            <div class="">
                <div class="">
                    <div class="mt-5 d-flex justify-content-between">
                        <div class="col-md-6 col-lg-5 col-xl-4 offset-lg-1 offset-xl-1">
                            <h4 class="modal-title fw-bold">BSP HCI REQUEST FORM</h4>
                        </div>
                        <div class="col-md-6 col-lg-5 col-xl-5 offset-lg-1 offset-xl-2 d-lg-flex justify-content-lg-end">
                            <img class="img-fluid me-lg-5" src="../../assets/img/ebiz-logo.png" width="230px" />
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="row g-0 d-flex flex-column-reverse flex-lg-row w-100 gap-3 gap-lg-0">
                        <div class="col-md-12 col-lg-5 col-xl-4 offset-lg-1 offset-xl-1">
                            <label class="form-label d-block">Date Requested: <span class="fw-bold"><?php echo empty($date_requested) ? date('F d, Y') : date('F d, Y - h:i A',strtotime($date_requested)); ?></span></label>
                            <label class="form-label d-block">Control No:&nbsp; <span class="fw-bold"><?php echo empty($control_number) ? '' : 'HCI/'.$control_number; ?></span></label>
                        </div>
                    </div>

                    <h4 class="text-capitalize text-center mt-3 fw-bold">Site information</h4>
                    <div class="row d-flex justify-content-center g-0 mb-5">
                        <div class="col-lg-10">
                            <div class="table-responsive mb-2">
                                <table class="table table-borderless text-nowrap align-middle table-sm ">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th>Name</th>
                                            <th>Department</th>
                                            <th>Location</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-dark">
                                        <tr>
                                            <td>
                                                <input class="form-control form-control-sm text-dark" type="text" name="fullname" value="<?php echo empty($fullname) ? $my_fullname : ucwords($fullname); ?>" readonly="readonly" />
                                            </td>
                                            <td>
                                                <input class="form-control form-control-sm text-dark" type="text" name="department" value="<?php echo empty($department) ? '' : $department; ?>" required/>
                                            </td>
                                            <td>
                                                <select class="form-select form-select-sm text-dark"  name="location" required>
                                                    <option value="" selected="">Select your Location</option>
                                                    <option value="HO"  <?php echo empty($location) ? '' : ($location == 'HO' ? 'selected' : ''); ?> >HO - Head Office</option>
                                                    <option value="LFC" <?php echo empty($location) ? '' : ($location == 'LFC' ? 'selected' : ''); ?> >LFC - Local Fallback Center</option>
                                                    <option value="SPC" <?php echo empty($location) ? '' : ($location == 'SPC' ? 'selected' : ''); ?> >SPC - Security Plant Complex</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr class="bg-dark text-white fw-bold">
                                            <td>Cluster</td>
                                            <td colspan="3">Host Name</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <select class="form-select form-select-sm text-dark" name="cluster" required>
                                                    <option value="" selected>Select Cluster</option>
                                                    <option value="general_cluster" <?php echo empty($cluster) ? '' : ($cluster == 'general_cluster' ? 'selected' : ''); ?> >General Cluster</option>
                                                    <option value="sql_cluster"  <?php echo empty($cluster) ? '' : ($cluster == 'sql_cluster' ? 'selected' : ''); ?> >SQL Cluster</option>
                                                    <option value="standalone_node" <?php echo empty($cluster) ? '' : ($cluster == 'standalone_node' ? 'selected' : ''); ?> >DB Standalone Node</option>
                                                 </select>
                                            </td>
                                            <td class="align-top" colspan="3">
                                                <input class="form-control form-control-sm text-dark" type="text" id="hostname" name="hostname" value="<?php echo empty($hostname) ? '' : $hostname; ?>" placeholder="Input your Host Name" required />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <h4 class="text-capitalize text-center fw-bold">Request Information</h4>
                            <div class="table-responsive">
                                <table class="table table-borderless align-middle text-nowrap text-dark table-sm " id="hci_tab_logic">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th>Description</th>
                                            <th>Requested</th>
                                            <th>Comment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         
                                        <tr>
                                            <td class="fw-bold">vCPU</td>
                                            <td>
                                                <input class="form-control form-control-sm text-dark" type="text" name="vcpu" value="<?php echo empty($vcpu) ? '' : $vcpu; ?>" />
                                            </td>
                                            <td>
                                                <input class="form-control form-control-sm  text-dark" type="text" name="vcpu_comment" value="<?php echo empty($vcpu_comment) ? '' : $vcpu_comment; ?>" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">RAM (GB)</td>
                                            <td>
                                                <input class="form-control form-control-sm text-dark" type="text" name="ram" value="<?php echo empty($ram) ? '' : $ram; ?>" />
                                            </td>
                                            <td>
                                                <input class="form-control form-control-sm text-dark" type="text"  name="ram_comment" value="<?php echo empty($ram_comment) ? '' : $ram_comment; ?>" />
                                            </td>
                                        </tr>
                                        <tr class="align-top">
                                             <td class="fw-bold">OS</td>
                                             <td>
                                                 <select class="form-select form-select-sm text-dark" name="os" >
                                                    <option value="" selected>Select OS</option>
                                                    <option value="windows" <?php echo empty($os) ? '' : ($os == 'windows' ? 'selected' : ''); ?> >Windows</option>
                                                    <option value="linux" <?php echo empty($os) ? '' : ($os == 'linux' ? 'selected' : ''); ?> >Linux</option>
                                                 </select>                              
                                             </td>
                                             <td>
                                                 <input class="form-control form-control-sm text-dark" type="text" name="os_comment" value="<?php echo empty($os_comment) ? '' : $os_comment; ?>" />  
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>
                                                <span class="invisible"></span>
                                            </td>
                                             <td>
                                                <input class="form-control form-control-sm text-dark" type="text" name="txt_os_descript" value="<?php echo empty($txt_os_descript) ? '' : $txt_os_descript; ?>" placeholder="Specify OS Environment (with or w/o GUI:)" >
                                            </td>
                                             <td>
                                                <input class="form-control form-control-sm text-dark" type="text" name="txt_define_parti" value="<?php echo empty($txt_define_parti) ? '' : $txt_define_parti; ?>" placeholder="Please Define Partion:" >
                                            </td>
                                         </tr>
                                         <tr>
                                             <td class="fw-bold">IP Address</td>
                                             <td>
                                                 <input class="form-control form-control-sm text-dark" type="text" name="ip_add_vlan" value="<?php echo empty($ip_add_vlan) ? '' : $ip_add_vlan; ?>" />
                                             </td>
                                             <td>
                                                 <input class="form-control form-control-sm text-dark" type="text" name="ip_comment" value="<?php echo empty($ip_comment) ? '' : $ip_comment; ?>" >
                                             </td>
                                         </tr>
                                         <tr>
                                             <td class="fw-bold">VLAN</td>
                                             <td>
                                                 <input class="form-control form-control-sm text-dark" type="text" name="txt_ip_vlan" value="<?php echo empty($txt_ip_vlan) ? '' : $txt_ip_vlan; ?>" />
                                             </td>
                                             <td>
                                                 <input class="form-control form-control-sm text-dark" type="text" name="vlan_comment"  value="<?php echo empty($vlan_comment) ? '' : $vlan_comment; ?>" >
                                             </td>
                                         </tr>
                                         <tr>
                                             <td class="fw-bold">Users </td>
                                             <td>
                                                 <input class="form-control form-control-sm text-dark" type="text" name="hci_users" value="<?php echo empty($hci_users) ? '' : $hci_users; ?>" />
                                             </td>
                                             <td>
                                                 <input class="form-control form-control-sm text-dark" type="text"  name="txt_hci_users" value="<?php echo empty($txt_hci_users) ? '' : $txt_hci_users; ?>" />
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
                                            <td class="fw-bold">Disk (GB) <?=$num++; ?></td>
                                            <td>
                                                <input type="hidden" name="others_id[]" value="<?=$rows['others_id']; ?>" >
                                                <input class="form-control form-control-sm text-dark uid1" type="text" name='others_1[]' value="<?=$rows['others_1']?>" >
                                            </td>
                                            <td>
                                                <input class="form-control form-control-sm text-dark uname1" type="text" name='others_2[]' value="<?=$rows['others_2']?>">
                                            </td>
                                        </tr>
                                        <?php 
                                                endwhile; 
                                            endif;
                                            
                                        ?>
                                        <!-- Display data of DISK GB -->

                                        <!-- View data in DISK GB -->
                                        <?php if (empty($control_number)): ?>
                                        <tr id='addr1'>
                                            <td class="fw-bold">DISK (GB)</td>
                                            <td>
                                                <div class="d-flex justify-content-end position-relative">
                                                    <input type="hidden" name="others_id[]" >
                                                    <input class="form-control form-control-sm text-dark uid1" type="text" name='others_1[]' >

                                                    <div class="position-absolute me-2 bg-white d-flex align-self-center" style="z-index:4;">
                                                        <div class="d-flex flex-column ">
                                                            <button class="btn btn-sm " type="button" id="add_row"><i class="fa-fw fas fa-plus"></i></button>
                                                        </div>  
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <input class="form-control form-control-sm text-dark uname1" type="text" name='others_2[]' >
                                            </td>
                                        </tr>
                                        <?php endif; ?>
                                        <!-- View data in DISK GB -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <div class="table-responsive">
                                <table class="table table-borderless table-sm text-nowrap border border-secondary">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th class="text-center" colspan="3">Remarks</th>
                                        </tr>
                                    </thead>
                                    <?php if (!empty($control_number)): ?>
                                    <tbody class="text-dark align-top">
                                        <?php

                                            $no_comments = '<td colspan="3">This form has no comments!</td>';
                                            $txt_area = '<td colspan="3"><textarea class="form-control form-control-sm text-dark" name="comments" placeholder="Please leave a comments here..." ></textarea></td>';
                                            $hci_remarks = mysqli_query($conn,"SELECT * FROM tbl_remarks where control_number = '$control_number' and form_type = '$form_type' ORDER BY remarks_date ASC ");
                                            $hci_count = mysqli_num_rows($hci_remarks);
                                            if ($hci_count  == true){

                                                while($hci_remarks_rows = mysqli_fetch_array($hci_remarks)):
                                                    $com_id = $hci_remarks_rows['comment_id'];
                                                    $hci_role = $hci_remarks_rows['role'];
                                                    if (($my_role == 1 && $hci_role >=1 && $hci_role <=6) || ($my_role == 2 && $hci_role >=1 && $hci_role <=2) || ($my_role == 3 && $hci_role >=1 && $hci_role <=3) || ($my_role == 4 && $hci_role >=1 && $hci_role <=4) || ($my_role == 5 && $hci_role >=1 && $hci_role <=5) || ($my_role == 6 && $hci_role >=1 && $hci_role <=6) ):
                                                        echo '<td><input type="hidden" name="comment_id" value="'.$com_id.'"></td>';
                                                        echo '<tr>';
                                                        echo '<td width="25%"><span class="fw-bold">'.ucwords($hci_remarks_rows['fullname']).'</span><br><span class="small">'.$hci_remarks_rows['remarks_date'].'</span></td>';
                                                        echo '<td width="75%" colspan="2">'.$hci_remarks_rows['comments'].'</td>';
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

                                                if ($my_role == 1 && $status == 1 && $approver_id == NULL) {
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
                                                if ($my_role == 1 && $status == 2 && $approver_id == NULL) {
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
                                                 <textarea class="form-control form-control-sm text-dark" name="comments" placeholder="Please leave a comments here..."></textarea>
                                             </td>
                                         </tr>
                                     </tbody>    
                                    <?php endif; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row g-1 d-flex justify-content-lg-center text-nowrap">
                        <div class="col-sm-6 col-md-6 col-lg-5 col-xl-5 offset-xl-0 p-3 border border-secondary">
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
                        <div class="col-sm-6 col-md-6 col-lg-5 col-xl-5 p-3 border border-secondary">
                            <label class="form-label fw-bold d-block mb-3">Performed by</label>
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
                            </div>
                        </div>
                    </div>
                    <div class="row g-1 d-flex justify-content-lg-center text-nowrap">
                        <div class="col-sm-6 col-md-6 col-lg-5 col-xl-5 offset-xl-0 p-3 border border-secondary">
                            <label class="form-label fw-bold d-block mb-3">Approved by</label>
                            <div class="d-flex flex-column justify-content-between flex-sm-row">
                                <div class="d-flex flex-column justify-content-between d-block w-100">
                                    <div class="d-flex flex-column justify-content-start">
                                        <label class="form-label" >
                                            <?php
                                                if (!empty($app_status)) {
                                                    if (!empty((!empty($app_status) && $my_role >= 2 && $my_role <= 6) || $my_role == 1 && $app_status == 1)) {
                                                        echo '<u>'.ucwords($approver).'</u>';
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
                                                if (!empty($app_status)) {
                                                    if (!empty((!empty($app_status) && $my_role >= 2 && $my_role <= 6) || $my_role == 1 && $app_status == 1)) {
                                                        echo '<u>'.date('M d,  Y - h:i:A ',strtotime($appr_date)).'</u>';
                                                    } 
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
                        <div class="col-sm-6 col-md-6 col-lg-5 col-xl-5 p-3 border border-secondary">
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
                            </div>
                        </div>
                    </div>
                    <div class="row g-1 d-flex justify-content-lg-center text-nowrap">
                        <div class="col-sm-6 col-md-6 col-lg-5 col-xl-5 offset-xl-0 p-3 border border-secondary">
                            <label class="form-label fw-bold d-block mb-3">Received by</label>
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
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-5 col-xl-5 p-3 border border-secondary">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>

        <script src="../../assets/js/jquery-3.6.0.js"></script>
        <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="../../assets/js/theme.js"></script>
        <script>
            $(document).ready(function(){
                window.print();  
            });
        </script>
    </body>
</html>
