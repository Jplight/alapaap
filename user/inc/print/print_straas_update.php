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
                margin: 0;
            }
            @print {
                @page :footer {
                    display: none
                }
            
                @page :header {
                    display: none
                }
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
            <div class="">
                <div class="">
                    <div class="mt-5 d-flex justify-content-between">
                        <div class="col-md-6 col-lg-5 col-xl-4 offset-lg-1 offset-xl-1">
                            <h4 class="modal-title fw-bold text-nowrap">BSP STRAAS REQUEST FORM (UPDATE)</h4>
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
                            <label class="form-label d-block">Control No:&nbsp; <span class="fw-bold"><?php echo empty($control_number) ? '' : 'STRAAS/'.$control_number; ?></span></label>
                        </div>
                    </div>

                    <h4 class="text-capitalize text-center mt-3 fw-bold">Site information</h4>
                    <div class="row d-flex justify-content-center g-0 mb-5">
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
                            <h4 class="text-capitalize text-center fw-bold">Request Information</h4>
                            <div class="table-responsive">
                                <table class="table table-borderless align-middle text-nowrap text-dark table-sm border border-secondary" id="straas_tab_logic">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th>Description</th>
                                            <th colspan="3">Requested</th>   
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="fw-bold">Host Port<span class="text-danger ms-2">*</span></td>
                                            <td>
                                                <input class="form-control form-control-sm text-dark" type="text" name="host_port" value="<?php echo empty($host_port) ? '' : $host_port; ?>"  required maxlength="30" onkeypress="return /[a-zA-Z0-9]/i.test(event.key)" >
                                            </td>
                                            <td>
                                                <input class="form-control form-control-sm text-dark" type="text" name="host_port_comment" value="<?php echo empty($host_port_comment) ? '' : $host_port_comment; ?>" placeholder="Optional" />
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
