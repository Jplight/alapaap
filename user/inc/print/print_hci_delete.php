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
    $tbl_hci_del = mysqli_query($conn,"SELECT * FROM `tbl_hci` where control_number = '$control_number' ");
    while ($rows = mysqli_fetch_array($tbl_hci_del)) {

        $hci_new_control_num        = $rows['hci_new_control_num'];
        $hci_up_control_num         = $rows['hci_up_control_num'];      
        $control_number             = $rows['control_number'];

        $form_type                  = $rows['form_type'];


        $hostname                   = $rows['hostname'];

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

    $tbl_hci = mysqli_query($conn,"SELECT * FROM `tbl_hci` where control_number = '$hci_new_control_num' ");
    while ($rows_2 = mysqli_fetch_array($tbl_hci)) {
        $hci_del_vcpu                = $rows_2['vcpu'];
        $hci_del_ram                 = $rows_2['ram'];
        $hci_del_os_old              = $rows_2['os'];
        $hci_del_os_desc_old         = $rows_2['txt_os_descript'];
        $hci_del_ipaddress           = $rows_2['ip_add_vlan'];
        $hci_del_ip_vlan             = $rows_2['txt_ip_vlan'];
        $hci_del_users               = $rows_2['hci_users'];

        $fullname                   = $rows_2['fullname'];
        $email_add                  = $rows_2['email_add'];
        $contact_no                 = $rows_2['contact_no'];
        $department                 = $rows_2['department'];
        $location                   = $rows_2['location'];
        $cluster                    = $rows_2['cluster'];
    }

    $tbl_hci_up = mysqli_query($conn,"SELECT * FROM `tbl_hci` where control_number = '$hci_up_control_num' ");
    while ($rows_3 = mysqli_fetch_array($tbl_hci_up)) {
        $hci_up_vcpu                = $rows_3['vcpu'];   
        $hci_up_ram                 = $rows_3['ram'];
        $hci_up_os_old              = $rows_3['os'];
        $hci_up_os_desc_old         = $rows_3['txt_os_descript'];
        $hci_up_ipaddress           = $rows_3['ip_add_vlan'];
        $hci_up_ip_vlan             = $rows_3['txt_ip_vlan'];
        $hci_up_users               = $rows_3['hci_users'];


        $hci_del_req_vcpu            = $rows_3['vcpu'];
        $hci_del_vcpu_comment        = $rows_3['vcpu_comment'];
        $hci_del_req_ram             = $rows_3['ram'];
        $hci_del_ram_comment         = $rows_3['ram_comment'];

        $hci_del_req_os_new          = $rows_3['os'];
        $hci_del_os_comment          = $rows_3['os_comment'];

        $hci_del_req_desc            = $rows_3['txt_os_descript'];
        $hci_del_req_parti           = $rows_3['txt_define_parti'];

        $hci_del_ipadd_comment       = $rows_3['ip_comment'];
        $hci_del_vlan_comment        = $rows_3['vlan_comment'];

        $hci_del_req_ipadd           = $rows_3['ip_add_vlan'];
        $hci_del_req_vlan            = $rows_3['txt_ip_vlan'];
        $hci_del_req_users           = $rows_3['hci_users'];
        $hci_del_users_comment       = $rows_3['txt_hci_users'];

    }

endif;

?>

   
       
                    <div class="mt-5 d-flex justify-content-between">
                        <div class="col-md-6 col-lg-5 col-xl-4 offset-lg-1 offset-xl-1">
                        <h4 class="modal-title fw-bold text-nowrap">BSP HCI REQUEST FORM (DELETE)</h4>
                        </div>
                        <div class="col-md-6 col-lg-5 col-xl-5 offset-lg-1 offset-xl-2 d-lg-flex justify-content-lg-end">
                            <img class="img-fluid me-lg-5" src="../../assets/img/ebiz-logo.png" width="230px" />
                        </div>
                    </div>          
                         
                    <div class="row g-0 d-flex flex-column-reverse flex-lg-row w-100 gap-3 gap-lg-0">
                        <div class="col-md-12 col-lg-5 col-xl-4 offset-lg-1 offset-xl-1">
                            <label class="form-label d-block">Date Requested: <span class="fw-bold"><?php echo empty($date_requested) ? date('F d, Y') : date('F d, Y - h:i A',strtotime($date_requested)); ?></span></label>
                            <label class="form-label d-block">Control No:&nbsp; <span class="fw-bold"><?php echo empty($control_number) ? '' : 'HCI/'.$control_number; ?></span></label>
                            <input type="hidden" name="txt_control_number" value="<?php echo empty($control_number) ? '' : $control_number; ?>" readonly >
                            <input type="hidden" name="contact_no" value="<?php echo empty($contact_no) ? '' : $contact_no; ?>" readonly>
                            <input type="hidden" name="email_add" value="<?php echo empty($email) ? '' : $email; ?>" readonly>
                            <input type="hidden" name="form_type" value="<?php echo empty($form_type) ? '' : $form_type; ?>" readonly>
                            <input type="hidden" name="num_revised" value="<?php echo empty($num_revised) ? '' : $num_revised; ?>" readonly placeholder="Total Revised">
                            <input type="hidden" name="his_role" value="<?php echo empty($my_role) ? '' : $my_role; ?>" readonly>
                            <input type="hidden" name="hci_new_control_num" id="hci_new_control_num" value="<?php echo empty($hci_new_control_num) ? '' : $hci_new_control_num; ?>" placeholder="HCI NEw No." >
                            <input type="hidden" name="hci_up_control_num" id="hci_up_control_num" value="<?php echo empty($hci_up_control_num) ? '' : $hci_up_control_num; ?>"  placeholder="HCI Update No." >
                        </div>
                    </div>

                    <h4 class="text-capitalize text-center mt-3 fw-bold">Site information</h4>
                    <div class="row d-flex justify-content-center g-0 mb-3">
                        <div class="col-lg-10">
                            <div class="table-responsive mb-2">
                                <table class="table table-borderless text-nowrap table-sm align-middle">
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
                                                <input class="form-control form-control-sm text-dark" type="text" name="hci_del_department" id="hci_del_department" value="<?php echo empty($department) ? '' : $department; ?>" readonly />
                                            </td>
                                            <td>
                                                <select class="form-select form-select-sm text-dark" name="hci_del_location" id="hci_del_location" required>
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
                                                <select class="form-select form-select-sm text-dark" name="hci_del_cluster" id="hci_del_cluster" required>
                                                    <option value="" selected>Select Cluster</option>
                                                    <option value="general_cluster" <?php echo empty($cluster) ? '' : ($cluster == 'general_cluster' ? 'selected' : ''); ?> >General Cluster</option>
                                                    <option value="sql_cluster"  <?php echo empty($cluster) ? '' : ($cluster == 'sql_cluster' ? 'selected' : ''); ?> >SQL Cluster</option>
                                                    <option value="standalone_node" <?php echo empty($cluster) ? '' : ($cluster == 'standalone_node' ? 'selected' : ''); ?> >DB Standalone Node</option>
                                                 </select>
                                                
                                            </td>
                                            <td colspan="3">
                                            <?php if (empty($control_number)): ?>
                                                <div class="input-group">
                                                    <input class="form-control form-control-sm text-dark shadow-none" type="search" name="hci_del_search_txt" id="hci_del_search_txt" value="<?php echo empty($hostname) ? '' : $hostname; ?>" >
                                                    <button class="btn btn-secondary shadow-none" type="button" id="btn_hci_del_search" name="btn_hci_del_search">Search</button>   
                                                </div>                                                
                                                <div class="position-absolute">
                                                   <ul class="list-group rounded-bottom shadow user-select-none" id="hci_del_search_result"></ul> 
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($control_number)): ?>
                                                    <input class="form-control form-control-sm text-dark shadow-none" type="text" name="hci_del_search_txt" id="hci_del_search_txt" readonly value="<?php echo empty($hostname) ? '' : $hostname; ?>" >
                                            <?php endif; ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <h4 class="text-capitalize text-center fw-bold">Delete Request</h4>
                            <table class="table table-borderless align-middle text-nowrap table-sm text-dark">
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
                                        <td class="fw-bold">vCPU</td>
                                        <td>
                                            <input class="form-control form-control-sm text-dark" type="text"  name="hci_del_vcpu" id="hci_del_vcpu" value="<?php echo empty($hci_del_vcpu) ? '' : $hci_del_vcpu; ?>" readonly />
                                        </td>
                                        <td>
                                            <input class="form-control form-control-sm text-dark" type="text" name="hci_del_req_vcpu" id="hci_del_req_vcpu" value="<?php echo empty($hci_del_req_vcpu) ? '' : $hci_del_req_vcpu; ?>" readonly/>
                                        </td>
                                        <td>
                                            <input class="form-control form-control-sm text-dark" type="text" name="hci_del_vcpu_comment" id="hci_del_vcpu_comment" value="<?php echo empty($hci_del_vcpu_comment) ? '' : $hci_del_vcpu_comment; ?>" readonly />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">RAM (GB)</td>
                                        <td>
                                            <input class="form-control form-control-sm text-dark" type="text" name="hci_del_ram" id="hci_del_ram" value="<?php echo empty($hci_del_ram) ? '' : $hci_del_ram; ?>"  readonly />
                                        </td>
                                        <td>
                                            <input class="form-control form-control-sm text-dark" type="text" name="hci_del_req_ram" id="hci_del_req_ram" value="<?php echo empty($hci_del_req_ram) ? '' : $hci_del_req_ram; ?>"  readonly/>
                                        </td>
                                        <td>
                                            <input class="form-control form-control-sm text-dark" type="text"  name="hci_del_ram_comment" id="hci_del_ram_comment" value="<?php echo empty($hci_del_ram_comment) ? '' : $hci_del_ram_comment; ?>" readonly />
                                        </td>
                                    </tr>
                                    <tr class="align-top">
                                         <td class="fw-bold">OS</td>
                                         <td>
                                            <input class="form-control form-control-sm text-dark" type="text" name="hci_del_os_old" id="hci_del_os_old" value="<?php echo empty($hci_del_os_old) ? '' : $hci_del_os_old; ?>" readonly />                             
                                         </td>
                                         <td>
                                            <input class="form-control form-control-sm text-dark" type="text" name="hci_del_req_os_new" id="hci_del_req_os_new" value="<?php echo empty($hci_del_req_os_new) ? '' : $hci_del_req_os_new; ?>" readonly />
                                        </td>
                                         <td>
                                             <input class="form-control form-control-sm text-dark" type="text" name="hci_del_os_comment" id="hci_del_os_comment" value="<?php echo empty($hci_del_os_comment) ? '' : $hci_del_os_comment; ?>" readonly/>  
                                         </td>
                                     </tr>
                                     <tr>
                                         <td>
                                            <span class="invisible"></span>
                                        </td>
                                         <td>
                                            <input class="form-control form-control-sm text-dark" type="text" name="hci_del_os_desc_old" id="hci_del_os_desc_old" value="<?php echo empty($hci_del_os_desc_old) ? '' : $hci_del_os_desc_old; ?>" placeholder="Specify OS Environment (with or w/o GUI:)" readonly>
                                        </td>
                                        <td>
                                            <input class="form-control form-control-sm text-dark" type="text" name="hci_del_req_desc" id="hci_del_req_desc" value="<?php echo empty($hci_del_req_desc) ? '' : $hci_del_req_desc; ?>" placeholder="Please Define Partion:" readonly/>
                                        </td>
                                         <td>
                                            <input class="form-control form-control-sm text-dark" type="text" name="hci_del_req_parti" id="hci_del_req_parti" value="<?php echo empty($hci_del_req_parti) ? '' : $hci_del_req_parti; ?>" readonly  >
                                        </td>
                                     </tr>
                                     <tr>
                                         <td class="fw-bold">IP Address</td>
                                         <td>
                                             <input class="form-control form-control-sm text-dark" type="text"  name="hci_del_ipaddress" id="hci_del_ipaddress" value="<?php echo empty($hci_del_ipaddress) ? '' : $hci_del_ipaddress; ?>" readonly />
                                         </td>
                                         <td>
                                            <input class="form-control form-control-sm text-dark" type="text" name="hci_del_req_ipadd" id="hci_del_req_ipadd" value="<?php echo empty($hci_del_req_ipadd) ? '' : $hci_del_req_ipadd; ?>" readonly />
                                        </td>
                                         <td>
                                             <input class="form-control form-control-sm text-dark" type="text" name="hci_del_ipadd_comment" id="hci_del_ipadd_comment" value="<?php echo empty($hci_del_ipadd_comment) ? '' : $hci_del_ipadd_comment; ?>" readonly >
                                         </td>
                                     </tr>
                                     <tr>
                                         <td class="fw-bold">VLAN</td>
                                         <td>
                                             <input class="form-control form-control-sm text-dark" type="text" id="hci_del_ip_vlan" name="hci_del_ip_vlan" value="<?php echo empty($hci_del_ip_vlan) ? '' : $hci_del_ip_vlan; ?>"  readonly/>
                                         </td>
                                         <td>
                                            <input class="form-control form-control-sm text-dark" type="text" name="hci_del_req_vlan" id="hci_del_req_vlan" value="<?php echo empty($hci_del_req_vlan) ? '' : $hci_del_req_vlan; ?>"  readonly/>
                                        </td>
                                         <td>
                                             <input class="form-control form-control-sm text-dark" type="text" name="hci_del_vlan_comment" id="hci_del_vlan_comment" value="<?php echo empty($hci_del_vlan_comment) ? '' : $hci_del_vlan_comment; ?>"  readonly>
                                         </td>
                                     </tr>
                                     <tr>
                                         <td class="fw-bold">Users </td>
                                         <td>
                                             <input class="form-control form-control-sm text-dark" type="text" name="hci_del_users" id="hci_del_users" value="<?php echo empty($hci_del_users) ? '' : $hci_del_users; ?>" readonly />
                                         </td>
                                         <td>
                                            <input class="form-control form-control-sm text-dark" type="text" name="hci_del_req_users" id="hci_del_req_users" value="<?php echo empty($hci_del_req_users) ? '' : $hci_del_req_users; ?>"  readonly/>
                                        </td>
                                         <td>
                                             <input class="form-control form-control-sm text-dark" type="text" name="hci_del_users_comment" id="hci_del_users_comment" value="<?php echo empty($hci_del_users_comment) ? '' : $hci_del_users_comment; ?>" readonly />
                                         </td>
                                     </tr>                                     
                                </tbody>
                             
                                <tbody id="del_load_others"></tbody>
                                <?php 
                                    if (!empty($control_number)):
                                        $num = 1;
                                        $sql = mysqli_query($conn,"SELECT * FROM tbl_forms_others where hostname = '$hostname' and form_type = '1' and control_number = '$hci_new_control_num' ");
                                        $count = mysqli_num_rows($sql);

                                        // If hostname is Exist!
                                        if ($count > 0):
                                            $sql_2 = mysqli_query($conn,"SELECT * FROM tbl_forms_others where hostname = '$hostname' and form_type = '1-1' and control_number = '$hci_up_control_num' ");
                                            $count_2 = mysqli_num_rows($sql_2);
                                            if ($count_2 > 0) {
                                                // if there is HCI Update data, It will fetch the HCI Update Data of DISK
                                                while ($rows_2 = mysqli_fetch_assoc($sql_2)) {
                                                    echo '<tr>';
                                                    echo '<td class="text-dark fw-bold">Disk (GB) '.$num++.'</td>';
                                                    echo '<td><input class="form-control form-control-sm text-dark" type="text" id="others_1[]" name="others_1[]" value="'.$rows_2['others_1'].'" readonly></td>';
                                                    echo '<td><input class="form-control form-control-sm text-dark" type="text" id="others_2[]" name="others_2[]" value="'.$rows_2['others_2'].'" readonly></td>';
                                                    echo '<td><input class="form-control form-control-sm text-dark" type="text" id="others_3[]" name="others_3[]" value="'.$rows_2['others_3'].'" readonly ></td>';
                                                    echo '</tr>';
                                                }
                                            }else{
                                                // if there is no HCI Update, The system will get the Data of HCI new and fetch to all textbox!
                                                while ($rows = mysqli_fetch_assoc($sql)) {
                                                    echo '<tr>';
                                                    echo '<td class="text-dark fw-bold">Disk (GB) '.$num++.'</td>';
                                                    echo '<td><input class="form-control form-control-sm text-dark" type="text" id="others_1[]" name="others_1[]" value="'.$rows['others_1'].'" readonly></td>';
                                                    echo '<td><input class="form-control form-control-sm text-dark" type="text" id="others_2[]" name="others_2[]" readonly></td>';
                                                    echo '<td><input class="form-control form-control-sm text-dark" type="text" id="others_3[]" name="others_3[]" readonly ></td>';
                                                    echo '</tr>';
                                                } 

                                            }
                                        endif;
                                    endif;
                                    if (empty($control_number)):
                                            // the purpose of this is to display the blank textfield of DISK GB
                                            echo '<tr id="hci_del_disk">';
                                            echo '<td class="text-dark fw-bold">Disk (GB) </td>';
                                            echo '<td><input class="form-control form-control-sm text-dark" type="text" readonly></td>';
                                            echo '<td><input class="form-control form-control-sm text-dark" type="text" readonly></td>';
                                            echo '<td><input class="form-control form-control-sm text-dark" type="text" readonly ></td>';
                                            echo '</tr>';                                       
                                    endif;
                                ?>                               

                            </table>
                        </div>
                        <div class="col-lg-10">
                            <?php
                                include '../components/comment.php';
                            ?>
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
