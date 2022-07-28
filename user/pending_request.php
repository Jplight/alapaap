<?php  
session_start();
ob_start();
date_default_timezone_set('Asia/Manila');
include '../model/connection.php';
require 'inc/GetTimeAgo.php';

$uid = $_SESSION['uid'];
$role = $_SESSION['role'];
$alert = isset($_SESSION['message']) ? $_SESSION['message']: '';
$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
if (!isset($uid)) {
    header("location: ../index.php");
}

if (strpos($role,"1" !== false)){
    $my_role = "1";
}
if (strpos($role,"2" !== false)){
    $my_role = "2";
}
$sql = mysqli_query($conn,"SELECT * FROM tbl_user where uid = '$uid'  ");
while ($rows = mysqli_fetch_array($sql)):
    $my_fullname    = $rows['first_name']." ".$rows['last_name'];
    $email          = $rows['email_add'];
    $contact_no     = $rows['contact_no'];
    $my_role        = $rows['role'];
    $sub_role       = $rows['sub_role'];
    $role_count     = $my_role + 1;
endwhile;

if ($my_role == 1) {
    $query_hci     = "SELECT uid,status FROM tbl_hci where uid = '$uid' and status BETWEEN 2 and 6";
    $query_tci     = "SELECT * FROM tbl_tci where uid = '$uid' and status BETWEEN 2 and 6";
    $query_cps     = "SELECT * FROM tbl_cps where uid = '$uid' and status BETWEEN 2 and 6";
    $query_baas    = "SELECT * FROM tbl_baas where uid = '$uid' and status BETWEEN 2 and 6";
}else{
    $query_hci     = "SELECT * FROM tbl_hci where status = '$my_role' ";
    $query_tci     = "SELECT * FROM tbl_tci where status = ".$my_role;
    $query_cps     = "SELECT * FROM tbl_cps where status = ".$my_role;
    $query_baas    = "SELECT * FROM tbl_baas where status = ".$my_role;
}

$sql_hci = mysqli_query($conn,$query_hci);
$count_hci = mysqli_num_rows($sql_hci); // Count the number of Pending Request for HCI

$sql_tci = mysqli_query($conn,$query_tci);
$count_tci = mysqli_num_rows($sql_tci); // Count the number of Pending Request for TCI

$sql_cps = mysqli_query($conn,$query_cps);
$count_cps = mysqli_num_rows($sql_cps); // Count the number of Pending Request for TCI

$sql_baas = mysqli_query($conn,$query_baas);
$count_bass = mysqli_num_rows($sql_baas); // Count the number of Pending Request for BaaS

include 'model/hci_form.php';
include 'model/hci_update_form.php';
include 'model/tci_form.php';

include 'model/cps_form.php';
include 'model/cps_form_update.php';
include 'model/cps_form_delete.php';

include 'model/baas_form.php';
include 'model/baas_form_2.php';
include 'model/authorize_personnel.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Alapaap | Pending Request</title>
        <link rel="icon" type="image/svg+xml" sizes="30x24" href="assets/img/android-chrome-192x192.png">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
        <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
        <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
        <style>
        /* width */
        ::-webkit-scrollbar {
          width: 10px;
          height: 5px;
           cursor: pointer;
        }

        /* Track */
        ::-webkit-scrollbar-track {
          background: #f1f1f1;
          cursor: pointer;
        }
         
        /* Handle */
        ::-webkit-scrollbar-thumb {
          background: #888; 
          border-radius: 10px;
          cursor: pointer;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
          background: #555; 
          cursor: pointer; 
        }
        .btn-outline-success:hover{
            color: white;
        }
        .badge-small{
            font-size: 10px;
        }
        </style>
    </head>
    <body id="page-top">

    <div id="frm_notification"></div>

        <div id="wrapper">
            <?php include 'inc/sidebar.php'; ?>
            <div class="d-flex flex-column" id="content-wrapper">
                <div id="content">
                    
                    <?php include 'inc/navbar.php'; ?>

                    <div class="container-fluid">
                        <div class="d-sm-flex justify-content-between align-items-center mb-4">
                            <h3 class="text-dark mb-0 mb-3 mb-sm-0">Pending Request</h3>
                        </div>
                        <?php echo (!empty($_SESSION['message'])) ? $alert : ''; ?>
                
                        <div class="card shadow">
                            <div class="card-body">
                                <div>
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active position-relative" role="tab" data-bs-toggle="tab" href="#tab-1">HCI
                                                <?php if($count_hci >= 1): ?>
                                                <span class="position-absolute top-0 start-100 translate-middle badge badge-small rounded-pill <?php echo $count_hci == 1 ? 'bg-warning' : 'bg-danger'; ?> " ><?=$count_hci; ?> +</span>
                                                <?php endif; ?>
                                            </a>
                                        </li>
                                        <?php if ($my_role != 2): ?>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link position-relative" role="tab" data-bs-toggle="tab" href="#tab-2">Adhoc
                                                <?php if($count_tci >= 1): ?>
                                                <span class="position-absolute top-0 start-100 translate-middle badge badge-small rounded-pill <?php echo $count_tci == 1 ? 'bg-warning' : 'bg-danger'; ?> " ><?=$count_tci; ?> +</span>
                                                <?php endif; ?>
                                            </a>
                                        </li>
                                        <?php endif; ?>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link position-relative" role="tab" data-bs-toggle="tab" href="#tab-3">CPS
                                                <?php if($count_cps >= 1): ?>
                                                <span class="position-absolute top-0 start-100 translate-middle badge badge-small rounded-pill <?php echo $count_cps == 1 ? 'bg-warning' : 'bg-danger'; ?> " ><?=$count_cps; ?> +</span>
                                                <?php endif; ?>
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link position-relative" role="tab" data-bs-toggle="tab" href="#tab-4">BaaS
                                                <?php if($count_bass >= 1): ?>
                                                <span class="position-absolute top-0 start-100 translate-middle badge badge-small rounded-pill <?php echo $count_bass == 1 ? 'bg-warning' : 'bg-danger'; ?> " ><?=$count_bass; ?> +</span>
                                                <?php endif; ?>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content pt-4">
                                        <div class="tab-pane active" role="tabpanel" id="tab-1">
                                            <table id="hci_datatables" class="table table-striped table-hover display responsive nowrap" style="width:100%">
                                                <thead class="">
                                                    <tr>
                                                        <th>Requestor</th>
                                                        <th>Control No.</th>
                                                        <th>Date</th>
                                                        <th>Time</th>
                                                        <th>Form Type</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                        <th></th>
                                                   
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        if ($my_role == 1) {
                                                            
                                                            $hci_query = mysqli_query($conn,"SELECT * FROM tbl_hci where uid = '$uid' and status BETWEEN 2 and 6 ORDER BY date_requested DESC ");
                                                        }else{
                                                            
                                                            $hci_query = mysqli_query($conn,"SELECT * FROM tbl_hci where status = '$my_role'  ORDER BY date_requested DESC ");
                                                        }
                                                        
                                                        while ($rows_hci = mysqli_fetch_array($hci_query)):
                                                            $control_number = $rows_hci['control_number'];
                                                            $new_date = date('F d, Y',strtotime($rows_hci['date_requested']));
                                                            $new_time = date('h:i:s A',strtotime($rows_hci['date_requested']));
                                                            echo '<tr>';
                                                            echo '<td>'.$rows_hci['fullname'].'</td>';
                                                            echo '<td>HCI/'.$control_number.'</td>';
                                                            echo '<td>'.$new_date.'</td>';
                                                            echo '<td>'.$new_time.'</td>';
                                                            if ($rows_hci['form_type'] == '1-1') {
                                                                echo '<td>HCI - UPDATE</td>';
                                                            }else if ($rows_hci['form_type'] == '1-2') {
                                                                echo '<td>HCI - DELETE</td>';
                                                            }else{
                                                                echo '<td>HCI</td>';
                                                            } 
                                                            if (($rows_hci['status'] >= '2' && $rows_hci['status'] <= '6') && (!empty($rows_hci['num_revised'])) ) {
                                                                $revised = '<span class="ms-2 badge rounded-pill bg-danger">Rev. '.$rows_hci['num_revised'].'</span>';
                                                            }else{
                                                                $revised = '';
                                                            }
                                                            if ($my_role == 1 && $rows_hci['status'] == 2 && $rows_hci['form_type'] == '1') {
                                                                // $cancel_btn_dummy = '<div class="btn btn-outline-danger btn-sm shadow-sm" id="hci_cancel_2">Cancel</div>';
                                                                $cancel_btn = '<a class="btn btn-outline-danger btn-sm shadow-sm" href="model/hci_form.php?uid='.$uid.'&control_number='.$rows_hci["control_number"].'&f_type='.$rows_hci['form_type'].'" id="hci_r_cancel" ><i class="fa-fw fas fa-times me-1"></i>Cancel</a>';
                                                            }else if ($my_role == 1 && $rows_hci['status'] == 2 && $rows_hci['form_type'] == '1-1') {
                                                                $cancel_btn = '<a class="btn btn-outline-danger btn-sm shadow-sm" href="model/hci_update_form.php?uid='.$uid.'&control_number='.$rows_hci["control_number"].'&f_type='.$rows_hci['form_type'].'" ><i class="fa-fw fas fa-times me-1"></i>Cancel</a>';
                                                            }else{
                                                                // $cancel_btn_dummy = "";
                                                                $cancel_btn = "";
                                                            }
                                                            if ($rows_hci['status'] == '2') {
                                                                echo '<td><span class="badge rounded-pill bg-warning">For Approval</span>'.$revised.'</td>';
                                                            }elseif ($rows_hci['status'] == '3') {
                                                                echo '<td><span class="badge rounded-pill bg-warning">For Assessment</span>'.$revised.'</td>';
                                                            }elseif ($rows_hci['status'] == '4') {
                                                                echo '<td><span class="badge rounded-pill bg-warning">For Provisioning</span>'.$revised.'</td>';
                                                            }elseif ($rows_hci['status'] == '5') {
                                                                echo '<td><span class="badge rounded-pill bg-warning">For Confirmation</span>'.$revised.'</td>';
                                                            }elseif ($rows_hci['status'] == '6') {
                                                                echo '<td><span class="badge rounded-pill bg-warning">For Verification</span>'.$revised.'</td>';
                                                            }
                                                            if ($rows_hci['form_type'] == '1-1') {
                                                                
                                                                echo '<td class="d-flex gap-2">'.
                                                                        '<a class="btn btn-outline-primary btn-sm shadow-sm" href="inc/print/print_hci_up.php?control_number='.$rows_hci["control_number"].'" target="_blank"  ><i class="fa-fw fas fa-print"></i>Print</a>'.
                                                                        '<a class="btn btn-outline-primary btn-sm shadow-sm" href="#view_hci_update'.$rows_hci["control_number"].'" data-bs-toggle="modal" ><i class="fa-fw fas fa-eye me-1"></i>View</a>'.$cancel_btn.'</td>';                                                              
                                                                echo '<td>';
                                                                    include 'inc/hci_update.php';
                                                                echo '</td>';
                                                            }else if ($rows_hci['form_type'] == '1-2') {
                                                                echo '<td class="d-flex gap-2">'.
                                                                        '<a class="btn btn-outline-primary btn-sm shadow-sm" href="inc/print/print_hci_delete.php?control_number='.$rows_hci["control_number"].'" target="_blank"  ><i class="fa-fw fas fa-print"></i>Print</a>'.
                                                                        '<a class="btn btn-outline-primary btn-sm shadow-sm" href="#view_hci_delete'.$rows_hci["control_number"].'" data-bs-toggle="modal" ><i class="fa-fw fas fa-eye me-1"></i>View</a>'.$cancel_btn.'</td>';                                                              
                                                                echo '<td>';
                                                                    include 'inc/hci_delete.php';
                                                                echo '</td>';
                                                            }else{
                                                                echo '<td class="d-flex gap-2">'.
                                                                        '<a class="btn btn-outline-primary btn-sm shadow-sm" href="inc/print/print_hci.php?control_number='.$rows_hci["control_number"].'" target="_blank"  ><i class="fa-fw fas fa-print"></i>Print</a>'.
                                                                        '<a class="btn btn-outline-primary btn-sm shadow-sm" href="#view_hci'.$rows_hci["control_number"].'" data-bs-toggle="modal" ><i class="fa-fw fas fa-eye me-1"></i>View</a>'.$cancel_btn.
                                                                    '</td>';                                                              
                                                                echo '<td>';
                                                                    include 'inc/hci_new.php';
                                                                echo '</td>';
                                                                
                                                            }                                                            
                                                            echo '</tr>';
                                                        endwhile;
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane" role="tabpanel" id="tab-2">
                                            <div class="table-responsive ">
                                                <table class="table table-hover align-middle text-nowrap user-select-none" style="height:10px;" id="tci_datatables">
                                                    <thead>
                                                        <tr>
                                                            <th>Requestor</th>
                                                            <th>Control No.</th>
                                                            <th>Date</th>
                                                            <th>Time</th>
                                                            <th>Form Type</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php  
                                                            $num = 1;
                                                            if ($my_role == 1) {
                                                                $tci_query = mysqli_query($conn,"SELECT * FROM tbl_tci where uid = '$uid' and status BETWEEN 2 and 6  ORDER BY date_requested DESC ");
                                                            }else{
                                                                 $tci_query = mysqli_query($conn,"SELECT * FROM tbl_tci where status = '$my_role'  ORDER BY date_requested DESC ");
                                                            }

                                                            $tci_count = mysqli_num_rows($tci_query);
                                                                while ($rows_tci = mysqli_fetch_array($tci_query)):
                                                                    $control_number = $rows_tci['control_number'];
                                                                    $mydate = strtotime($rows_tci['date_requested']);
                                                                    $new_date = date('F d, Y',$mydate);
                                                                    $mytime = strtotime($rows_tci['date_requested']);
                                                                    $new_time = date('h:i:s A',$mytime);
                                                                    echo '<tr>';
                                                                   
                                                                    echo '<td>'.ucwords($rows_tci['fullname']).'</td>';
                                                                    echo '<td>Adhoc/'.$control_number.'</td>';
                                                                    
                                                                    echo '<td>'.$new_date.'</td>';
                                                                    echo '<td>'.$new_time.'</td>';
                                                                    echo '<td>Adhoc</td>';
                                                                    
                                                                    if (($rows_tci['status'] >= '2' && $rows_tci['status'] <= '6') && (!empty($rows_tci['num_revised'])) ) {
                                                                        $revised = '<span class="ms-2 badge rounded-pill bg-danger">Rev. '.$rows_tci['num_revised'].'</span>';
                                                                    }else{
                                                                        $revised = '';
                                                                    }

                                                                    if ($my_role == 1 && $rows_tci['status'] == 3) {
                                                                        $cancel_btn = '<a class="btn btn-outline-danger btn-sm shadow-sm" href="model/tci_form.php?uid='.$uid.'&control_number='.$rows_tci["control_number"].'&f_type='.$rows_tci['form_type'].'" ><i class="fa-fw fas fa-times me-1"></i>Cancel</a>';
                                                                    }else{
                                                                        $cancel_btn = '';
                                                                    }

                                                                    if ($rows_tci['status'] == '3') {
                                                                        echo '<td><span class="badge rounded-pill bg-warning">For Assessment</span>'.$revised.'</td>';
                                                                    }elseif ($rows_tci['status'] == '4') {
                                                                        echo '<td><span class="badge rounded-pill bg-warning">For Provisioning</span>'.$revised.'</td>';
                                                                    }elseif ($rows_tci['status'] == '5') {
                                                                        echo '<td><span class="badge rounded-pill bg-warning">For Confirmation</span>'.$revised.'</td>';
                                                                    }elseif ($rows_tci['status'] == '6') {
                                                                        echo '<td><span class="badge rounded-pill bg-warning">For Verification</span>'.$revised.'</td>';
                                                                    }
                                                                    echo '<td class="d-flex gap-2">'.
                                                                            '<a class="btn btn-outline-primary btn-sm shadow-sm" href="inc/print/print_tci.php?control_number='.$rows_tci["control_number"].'" target="_blank"  ><i class="fa-fw fas fa-print"></i>Print</a>'.
                                                                            '<a class="btn btn-outline-primary btn-sm shadow-sm" href="#view_tci'.$rows_tci["control_number"].'" data-bs-toggle="modal" ><i class="fa-fw fas fa-eye me-1"></i>View</a>'.$cancel_btn.    
                                                                        '</td>';
                                                                    echo '<td>';
                                                                        include 'inc/tci_modal.php';
                                                                    echo '</td>';
                                                                    echo '</tr>';
                                                                endwhile;
                                                                
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div> 
                                        </div>
                                        <div class="tab-pane" role="tabpanel" id="tab-3">
                                            <div class="table-responsive">
                                                <table class="table table-hover user-select-none align-middle text-nowrap" id="cps_datatables">
                                                    <thead>
                                                        <tr>
                                                            <th>Requestor</th>
                                                            <th>Control No.</th>
                                                            <th>Date</th>
                                                            <th>Time</th>
                                                            <th>Form Type</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php  
                                                           
                                                            if ($my_role == 1) {
                                                                $cps_query = mysqli_query($conn,"SELECT * FROM tbl_cps where uid = '$uid' and status BETWEEN 2 and 6  ORDER BY date_requested DESC ");
                                                            }else{
                                                                 $cps_query = mysqli_query($conn,"SELECT * FROM tbl_cps where status = '$my_role'  ORDER BY date_requested DESC ");
                                                            }

                                                            $cps_count = mysqli_num_rows($cps_query);
           
                                                                while ($rows_cps = mysqli_fetch_array($cps_query)):
                                                                    $control_number = $rows_cps['control_number'];
                                                                    $mydate = strtotime($rows_cps['date_requested']);
                                                                    $new_date = date('F d, Y',$mydate);
                                                                    $mytime = strtotime($rows_cps['date_requested']);
                                                                    $new_time = date('h:i:s A',$mytime);
                                                                    echo '<tr>';
                                                                    echo '<td>'.ucwords($rows_cps['fullname']).'</td>';
                                                                    echo '<td>CPS/'.$control_number.'</td>';
                                                                    echo '<td>'.$new_date.'</td>';
                                                                    echo '<td>'.$new_time.'</td>';
                                                                    

                                                                    if ($rows_cps['form_type'] == '3-1') {
                                                                        echo '<td>CPS - UPDATE</td>';
                                                                    }else if ($rows_cps['form_type'] == '3-2') {
                                                                        echo '<td>CPS - DELETE</td>';
                                                                    }else{
                                                                        echo '<td>CPS</td>';
                                                                    }

                                                                    if (($rows_cps['status'] >= '2' && $rows_cps['status'] <= '6') && (!empty($rows_cps['num_revised']))) {
                                                                        $revised = '<span class="ms-2 badge rounded-pill bg-danger">Rev. '.$rows_cps['num_revised'].'</span>';
                                                                    }else{
                                                                        $revised = '';
                                                                    }

                                                                    if ($my_role == 1 && $rows_cps['status'] == 2) {
                                                                        $cancel_btn = '<a class="btn btn-outline-danger btn-sm shadow-sm" href="model/cps_form.php?uid='.$uid.'&control_number='.$rows_cps["control_number"].'&f_type='.$rows_cps['form_type'].'" ><i class="fa-fw fas fa-times me-1"></i>Cancel</a>';
                                                                    }else{
                                                                        $cancel_btn = '';
                                                                    }

                                                                    if ($rows_cps['status'] == '2') {
                                                                        echo '<td><span class="badge rounded-pill bg-warning">For Approval</span>'.$revised.'</td>';
                                                                    }elseif ($rows_cps['status'] == '3') {
                                                                        echo '<td><span class="badge rounded-pill bg-warning">For Assessment</span>'.$revised.'</td>';
                                                                    }elseif ($rows_cps['status'] == '4') {
                                                                        echo '<td><span class="badge rounded-pill bg-warning">For Provisioning</span>'.$revised.'</td>';
                                                                    }elseif ($rows_cps['status'] == '5') {
                                                                        echo '<td><span class="badge rounded-pill bg-warning">For Confirmation</span>'.$revised.'</td>';
                                                                    }elseif ($rows_cps['status'] == '6') {
                                                                        echo '<td><span class="badge rounded-pill bg-warning">For Verification</span>'.$revised.'</td>';
                                                                    }
                                                                    if ($rows_cps['form_type'] == '3-1') {
                                                                        echo '<td class="d-flex gap-2">'.
                                                                                '<a class="btn btn-outline-primary btn-sm shadow-sm" href="inc/print/print_cps_up.php?control_number='.$rows_cps["control_number"].'" target="_blank"  ><i class="fa-fw fas fa-print"></i>Print</a>'.
                                                                                '<a class="btn btn-outline-primary btn-sm shadow-sm" href="#view_cps_update'.$rows_cps["control_number"].'" data-bs-toggle="modal" ><i class="fa-fw fas fa-eye me-1"></i>View</a>'.$cancel_btn.'</td>';                                                              
                                                                        echo '<td>';
                                                                            include 'inc/cps_update.php';
                                                                        echo '</td>';
                                                                    }else if ($rows_cps['form_type'] == '3-2') {
                                                                        echo '<td class="d-flex gap-2">'.
                                                                                '<a class="btn btn-outline-primary btn-sm shadow-sm" href="inc/print/print_cps_del.php?control_number='.$rows_cps["control_number"].'" target="_blank"  ><i class="fa-fw fas fa-print"></i>Print</a>'.
                                                                                '<a class="btn btn-outline-primary btn-sm shadow-sm" href="#view_cps_delete'.$rows_cps["control_number"].'" data-bs-toggle="modal" ><i class="fa-fw fas fa-eye me-1"></i>View</a>'.$cancel_btn.'</td>';                                                              
                                                                        echo '<td>';
                                                                            include 'inc/cps_delete.php';
                                                                        echo '</td>';
                                                                    }else{
                                                                        echo '<td class="d-flex gap-2">'.
                                                                                '<a class="btn btn-outline-primary btn-sm shadow-sm" href="inc/print/print_cps.php?control_number='.$rows_cps["control_number"].'" target="_blank"  ><i class="fa-fw fas fa-print"></i>Print</a>'.
                                                                                '<a class="btn btn-outline-primary btn-sm shadow-sm" href="#view_cps'.$rows_cps["control_number"].'" data-bs-toggle="modal" ><i class="fa-fw fas fa-eye me-1"></i>View</a>'.$cancel_btn.
                                                                            '</td>';                                                              
                                                                        echo '<td>';
                                                                            include 'inc/cps_new.php';
                                                                        echo '</td>';
                                                                    }
                                                                        
                                                                    echo '</tr>';
                                                                endwhile;
                                                           
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" role="tabpanel" id="tab-4">
                                            <div class="table-responsive">
                                                <table class="table table-hover align-middle text-nowrap user-select-none" id="baas_datatables">
                                                    <thead >
                                                        <tr>
                                                           
                                                            <th>Requestor</th>
                                                            <th>Control No.</th>
                                                            <th>Date</th>
                                                            <th>Time</th>
                                                            <th>Form Type</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php

                                                            $num = 1;
                                                            if ($my_role == 1) {
                                                                $sql_baas = mysqli_query($conn,"SELECT * FROM tbl_baas where uid = '$uid' and status BETWEEN 2 and 6  ORDER BY date_requested DESC ");
                                                            }else{
                                                                 $sql_baas = mysqli_query($conn,"SELECT * FROM tbl_baas where status = '$my_role'  ORDER BY date_requested DESC ");
                                                            }

                                                            $count_baas = mysqli_num_rows($sql_baas);
                                                
                                                                while ($rows_baas = mysqli_fetch_array($sql_baas)):
                                                                    $control_number = $rows_baas['control_number'];
                                                                    $mydate = strtotime($rows_baas['date_requested']);
                                                                    $new_date = date('F d, Y',$mydate);
                                                                    $mytime = strtotime($rows_baas['date_requested']);
                                                                    $new_time = date('h:i:s A',$mytime);
                                                                    echo '<tr>';
                                                                    
                                                                    echo '<td>'.ucwords($rows_baas['fullname']).'</td>';
                                                                    echo '<td>BaaS/'.$control_number.'</td>';
                                                                    
                                                                    echo '<td>'.$new_date.'</td>';
                                                                    echo '<td>'.$new_time.'</td>';
                                                                    if ($rows_baas['form_type'] == '4-2') {
                                                                        echo '<td>BaaS-CRRF</td>';
                                                                    }else{
                                                                        echo '<td>BaaS-CSRF</td>';
                                                                    }
                                                                    if ($my_role == 1 && $rows_baas['status'] == 2) {
                                                                        $cancel_btn = '<a class="btn btn-outline-danger btn-sm shadow-sm" href="model/baas_form.php?uid='.$uid.'&control_number='.$rows_baas["control_number"].'&f_type='.$rows_baas['form_type'].'" ><i class="fa-fw fas fa-times me-1"></i>Cancel</a>';
                                                                    }else{
                                                                        $cancel_btn = '';
                                                                    }
                                                                    
                                                                    if (($rows_baas['status'] >= '2' && $rows_baas['status'] <= '6') && (!empty($rows_baas['num_revised']))) {
                                                                        $revised = '<span class="ms-2 badge rounded-pill bg-danger">Rev. '.$rows_baas['num_revised'].'</span>';
                                                                    }else{
                                                                        $revised = '';
                                                                    }

                                                                    if ($rows_baas['status'] == '2') {
                                                                        echo '<td><span class="badge rounded-pill bg-warning">For Approval</span>'.$revised.'</td>';
                                                                    }elseif ($rows_baas['status'] == '3') {
                                                                        echo '<td><span class="badge rounded-pill bg-warning">For Assessment</span>'.$revised.'</td>';
                                                                    }elseif ($rows_baas['status'] == '4') {
                                                                        echo '<td><span class="badge rounded-pill bg-warning">For Provisioning</span>'.$revised.'</td>';
                                                                    }elseif ($rows_baas['status'] == '5') {
                                                                        echo '<td><span class="badge rounded-pill bg-warning">For Confirmation</span>'.$revised.'</td>';
                                                                    }elseif ($rows_baas['status'] == '6') {
                                                                        echo '<td><span class="badge rounded-pill bg-warning">For Verification</span>'.$revised.'</td>';
                                                                    }
                                                                    if ($rows_baas['form_type'] == '4') {
                                                                        echo '<td class="d-flex gap-2">'.
                                                                                    '<a class="btn btn-outline-primary btn-sm shadow-sm" href="inc/print/print_baas_csrf.php?control_number='.$rows_baas["control_number"].'" target="_blank"  ><i class="fa-fw fas fa-print"></i>Print</a>'.
                                                                                    '<a class="btn btn-outline-primary btn-sm shadow-sm" href="#view_baas'.$rows_baas["control_number"].'" data-bs-toggle="modal" ><i class="fa-fw fas fa-eye me-1"></i>View</a>'.$cancel_btn.'</td>';
                                                                        echo '<td>';
                                                                            include 'inc/baas_modal.php';
                                                                        echo '</td>'; 
                                                                    }
                                                                    if ($rows_baas['form_type'] == '4-2') {
                                                                        echo '<td class="d-flex gap-2">'.
                                                                                    '<a class="btn btn-outline-primary btn-sm shadow-sm" href="inc/print/print_baas_crrf.php?control_number='.$rows_baas["control_number"].'" target="_blank"  ><i class="fa-fw fas fa-print"></i>Print</a>'.
                                                                                    '<a class="btn btn-outline-primary btn-sm shadow-sm" href="#view_baas_2'.$rows_baas["control_number"].'" data-bs-toggle="modal" ><i class="fa-fw fas fa-eye me-1"></i>View</a>'.$cancel_btn.'</td>';
                                                                        echo '<td>';
                                                                            // include 'model/baas_view_2.php';
                                                                            include 'inc/baas_modal_2.php';
                                                                        echo '</td>'; 
                                                                    }         
                                                                    echo '</tr>';
                                                                endwhile;
                                                        
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="bg-white sticky-footer">
                    <div class="container my-auto">
                        <div class="text-center my-auto copyright">
                            <span>Copyright © Alapaap | eBizolution 2022</span>
                        </div>
                    </div>
                </footer>
            </div>
            <a class="border rounded d-inline scroll-to-top" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>
        </div>
        <script src="assets/js/jquery-3.6.0.js"></script>
        <script src="assets/bootstrap/js/popper.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>

        <!-- Data Tables -->
        <script src="assets/js/jquery.dataTables.min.js"></script>
        <script src="assets/js/dataTables.bootstrap5.min.js"></script>


        <script src="assets/js/theme.js"></script>
        <script src="controller/hci_script.js"></script>
        <script src="controller/weng.js"></script>
        <script src="controller/weng2.js"></script>
        <script src="controller/tci_script.js"></script>
        <script src="controller/cps_script.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="controller/global.validation.js"></script>

        <!-- <script>
            // Canceled HCI Prompt Message
            $(document).ready(function(){
                $("#hci_cancel_1, #hci_cancel_2").click(function(){
  
                        Swal.fire({
                            title: 'Do you want to cancel?',
                            showDenyButton: true,
                            confirmButtonText: 'Submit',
                            denyButtonText: `Cancel`,
                            }).then((result) => {
                            
                            console.log(result)
                            if (result.isConfirmed) {
                                
                                $("button[name=btn_cancel], #hci_r_cancel").click();
                
                            }
                        })
                    
                });         
            });
        </script>
        <script>
            // Canceled HCI Prompt Message
            $(document).ready(function(){
                $("#btn_approver_app").click(function(){
  
                        Swal.fire({
                            title: 'Do you want to approved?',
                            showDenyButton: true,
                            confirmButtonText: 'Yes',
                            denyButtonText: `No`,
                            }).then((result) => {
                            console.log(result)
                            if (result.isConfirmed) {                             
                                $("button[name=btn_approver]").click();
                            }
                        })
                    
                });         
            });
        </script> -->


        <script>
            $(document).ready(function(){
                $('#hci_datatables, #tci_datatables, #cps_datatables, #baas_datatables').DataTable({
                    responsive: true,
                    "language": {
                        "emptyTable": "There is no data to be showed!🤗",
                        "zeroRecords": "No data found!🤗"
                    }
                }); 

                $(".btn-close").click(function(){
                    window.location.reload();
                }); 

                $("button[name=approver_returned], button[name=rec_disapproved], button[name=performer_disapproved]").hover(function(){
                    $("textarea[name=comments]").prop('required',true);
                },function(){
                    $("textarea[name=comments]").removeAttr('required');
                });// WHen the cursor is hover on the Button Disapproved, the textarea ramarks will required to input text, otherwise if the text have text inside the required will automaticakkly bypass

            });            
        </script>
        <!-- <script>
            // For Notifcation
            $(document).ready(function () { 
                $.ajax({
                    type: "POST",
                    url: "model/notifications.php",
                    dataType: "html",
                    success: function (data) {
                        $("#frm_notification").html(data);
                        $("#success_alert").toast('show');                
                    }
                });
            });
        </script> -->
        <script>
            $(document).ready(function(){    
                setInterval(function(){
                    $("#alert").slideUp();
                },3000);
            });
        </script> 
    </body>
</html>
<?php 
mysqli_close($conn);
ob_end_flush(); 
?>