<?php  
session_start();
include '../model/connection.php';
require 'inc/GetTimeAgo.php';

$uid = $_SESSION['uid'];
$role = $_SESSION['role'];
if (!isset($uid)) {
    header("location: ../index.php");
}

$sql = mysqli_query($conn,"SELECT * FROM tbl_user where uid = '$uid' and role = '$role' ");
while ($rows = mysqli_fetch_array($sql)):
    $my_fullname    = $rows['first_name']." ".$rows['last_name'];
    $email          = $rows['email_add'];
    $contact_no     = $rows['contact_no'];
    $my_role        = $rows['role'];
    $sub_role       = $rows['sub_role'];
    $role_count     = $my_role + 1;
endwhile;

if ($my_role == 1) {
    $query_hci     = "SELECT * FROM tbl_hci where uid = '$uid' and status = 7 ";
    $query_tci     = "SELECT * FROM tbl_tci where uid = '$uid' and status = 7 ";
    $query_cps     = "SELECT * FROM tbl_cps where uid = '$uid' and status = 7 ";
    $query_baas    = "SELECT * FROM tbl_baas where uid = '$uid' and status = 7 ";
}

if ($my_role == 2) {
    $query_hci     = "SELECT app_status FROM tbl_hci where approver_id = '$uid' and app_status = '1' ";
    $query_tci     = "SELECT app_status FROM tbl_tci where approver_id = '$uid' and app_status = '1' ";
    $query_cps     = "SELECT app_status FROM tbl_cps where approver_id = '$uid' and app_status = '1' ";
    $query_baas    = "SELECT app_status FROM tbl_baas where approver_id = '$uid' and app_status = '1' ";
}
if ($my_role == 3) {
    $query_hci     = "SELECT rec_status FROM tbl_hci where reciever_id = '$uid' and rec_status = '1' ";
    $query_tci     = "SELECT rec_status FROM tbl_tci where reciever_id = '$uid' and rec_status = '1' ";
    $query_cps     = "SELECT rec_status FROM tbl_cps where reciever_id = '$uid' and rec_status = '1' ";
    $query_baas    = "SELECT rec_status FROM tbl_baas where reciever_id = '$uid' and rec_status = '1' ";
}
if ($my_role == 4) {
    $query_hci     = "SELECT perf_status FROM tbl_hci where performer_id = '$uid' and perf_status = '1' ";
    $query_tci     = "SELECT perf_status FROM tbl_tci where performer_id = '$uid' and perf_status = '1' ";
    $query_cps     = "SELECT perf_status FROM tbl_cps where performer_id = '$uid' and perf_status = '1' ";
    $query_baas    = "SELECT perf_status FROM tbl_baas where performer_id = '$uid' and perf_status = '1'";
}
if ($my_role == 5) {
    $query_hci     = "SELECT ver_status FROM tbl_hci where verifier_id = '$uid' and ver_status = '1' ";
    $query_tci     = "SELECT ver_status FROM tbl_tci where verifier_id = '$uid' and ver_status = '1' ";
    $query_cps     = "SELECT ver_status FROM tbl_cps where verifier_id = '$uid' and ver_status = '1' ";
    $query_baas    = "SELECT ver_status FROM tbl_baas where verifier_id = '$uid' and ver_status = '1'";
}
if ($my_role == 6) {
    $query_hci     = "SELECT ver2_status FROM tbl_hci where verifier_2id = '$uid' and ver2_status = '1' ";
    $query_tci     = "SELECT ver2_status FROM tbl_tci where verifier_2id = '$uid' and ver2_status = '1' ";
    $query_cps     = "SELECT ver2_status FROM tbl_cps where verifier_2id = '$uid' and ver2_status = '1' ";
    $query_baas    = "SELECT ver2_status FROM tbl_baas where verifier_2id = '$uid' and ver2_status = '1'";
}
$sql_hci = mysqli_query($conn,$query_hci);
$completed_count_hci = mysqli_num_rows($sql_hci); // Count the number of Completed Request HCI

$sql_tci = mysqli_query($conn,$query_tci);
$completed_count_tci = mysqli_num_rows($sql_tci); // Count the number of Completed Request TCI

$sql_cps = mysqli_query($conn,$query_cps);
$completed_count_cps = mysqli_num_rows($sql_cps); // Count the number of Completed Request CPS

$sql_baas = mysqli_query($conn,$query_baas);
$completed_count_baas = mysqli_num_rows($sql_baas); // Count the number of Completed Request BAAS

include 'model/authorize_personnel.php';
?>
<?php  



?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Alapaap | Approved Request</title>
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
          height: 10px;
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
        <div id="wrapper">
            <?php include 'inc/sidebar.php'; ?>
            <div class="d-flex flex-column" id="content-wrapper">
                <div id="content">
                    
                    <?php include 'inc/navbar.php'; ?>

                    <div class="container-fluid">
                        <div class="d-sm-flex justify-content-between align-items-center mb-4">
                            <h3 class="text-dark mb-0 mb-3 mb-sm-0">
                                <?php echo $my_role == 1 ? 'Completed Request' : ''; ?>
                                <?php echo $my_role == 2 ? 'Approved' : ''; ?>
                                <?php echo $my_role == 3 ? 'Acknowledged' : ''; ?>
                                <?php echo $my_role == 4 ? 'Provisioned' : ''; ?>
                                <?php echo $my_role == 5 ? 'Confirmed Request' : ''; ?>
                                <?php echo $my_role == 6 ? 'Verified Request' : ''; ?>
                            </h3>
                            <?php if ($my_role == 1): ?>
                            <!-- <div class="dropdown">
                                <button class="btn btn-success dropdown-toggle shadow-none text-white" aria-expanded="false" data-bs-toggle="dropdown" type="button">Select Services</button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">HCI</a>
                                    <a class="dropdown-item" href="#">TCI</a>
                                    <a class="dropdown-item" href="#">CPS</a>
                                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#view_baas">BaaS</a>
                                </div>
                            </div> -->
                            <?php endif; ?>
                        </div>
                        <div class="card shadow">
                            <div class="card-body">
                                <!-- <div class="row mb-3">
                                    <div class="col-md-6 text-nowrap">
                                        <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable">
                                            <label class="form-label">Show&nbsp;</label>
                                            <select class="d-inline-block form-select form-select-sm w-25">
                                                <option value="10" selected="">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-md-end dataTables_filter" id="dataTable_filter">
                                            <label class="form-label">
                                                <input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search">
                                            </label>                                         
                                        </div>
                                    </div>
                                </div> -->
                                <div>
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active position-relative" role="tab" data-bs-toggle="tab" href="#tab-1">HCI                 
                                                <?php 
                                                    if (($my_role >= 1 &&  $my_role <= 6) && $completed_count_hci >= 1){ // if na meet yung condition mag di-display yung badge na may total numbers of approved!
                                                        echo '<span class="position-absolute top-0 start-100 translate-middle badge badge-small rounded-pill bg-success" >'.$completed_count_hci.' +</span>';
                                                    } 
                                                ?>
                                            </a>
                                        </li>
                                        <?php if ($my_role !=2): ?>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link position-relative" role="tab" data-bs-toggle="tab" href="#tab-2">Adhoc                 
                                                <?php 
                                                    if (($my_role >= 1 &&  $my_role <= 6) && $completed_count_tci >= 1){ // if na meet yung condition mag di-display yung badge na may total numbers of approved!
                                                        echo '<span class="position-absolute top-0 start-100 translate-middle badge badge-small rounded-pill bg-success" >'.$completed_count_tci.' +</span>';
                                                    } 
                                                ?>
                                            </a>
                                        </li>
                                        <?php endif; ?>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link position-relative" role="tab" data-bs-toggle="tab" href="#tab-3">CPS
                                                <?php 
                                                    if (($my_role >= 1 &&  $my_role <= 6) && $completed_count_cps >= 1){ // if na meet yung condition mag di-display yung badge na may total numbers of approved!
                                                        echo '<span class="position-absolute top-0 start-100 translate-middle badge badge-small rounded-pill bg-success" >'.$completed_count_cps.' +</span>';
                                                    } 
                                                ?>
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link position-relative" role="tab" data-bs-toggle="tab" href="#tab-4">BaaS                 
                                                <?php 
                                                    if (($my_role >= 1 &&  $my_role <= 6) && $completed_count_baas >= 1){ // if na meet yung condition mag di-display yung badge na may total numbers of approved!
                                                        echo '<span class="position-absolute top-0 start-100 translate-middle badge badge-small rounded-pill bg-success" >'.$completed_count_baas.' +</span>';
                                                    } 
                                                ?>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content pt-4">
                                        <div class="tab-pane active" role="tabpanel" id="tab-1">
                                            <div class="table-responsive">
                                                <table class="table table-hover user-select-none align-middle text-nowrap" id="hci_datatables">
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
                                                                $hci_query = mysqli_query($conn,"SELECT * FROM tbl_hci where uid = '$uid' and status = '7' ORDER BY date_requested DESC ");
                                                            }elseif ($my_role == 2){
                                                                $hci_query = mysqli_query($conn,"SELECT * FROM tbl_hci where approver_id = '$uid' and app_status = '1'  ORDER BY date_requested DESC ");
                                                            }elseif ($my_role == 3){
                                                                $hci_query = mysqli_query($conn,"SELECT * FROM tbl_hci where reciever_id = '$uid' and rec_status = '1'  ORDER BY date_requested DESC ");
                                                            }elseif ($my_role == 4){
                                                                $hci_query = mysqli_query($conn,"SELECT * FROM tbl_hci where performer_id = '$uid' and perf_status = '1'  ORDER BY date_requested DESC ");
                                                            }elseif ($my_role == 5){
                                                                $hci_query = mysqli_query($conn,"SELECT * FROM tbl_hci where verifier_id = '$uid' and ver_status = '1'  ORDER BY date_requested DESC ");
                                                            }elseif ($my_role == 6){
                                                                $hci_query = mysqli_query($conn,"SELECT * FROM tbl_hci where verifier_2id = '$uid' and ver2_status = '1'  ORDER BY date_requested DESC ");
                                                            }
                                                         
                                                                while ($rows_hci = mysqli_fetch_array($hci_query)):                        
                                                                    $control_number = $rows_hci['control_number'];
                                                                    $mydate = strtotime($rows_hci['date_requested']);
                                                                    $new_date = date('F d, Y',$mydate);
                                                                    $mytime = strtotime($rows_hci['date_requested']);
                                                                    $new_time = date('h:i:s A',$mytime);
                                                                    echo '<tr>';
                                                                    echo '<td>'.ucwords($rows_hci['fullname']).'</td>';
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
                                                                    
                                                                    if (($rows_hci['status'] >= '7') && (!empty($rows_hci['num_revised']))) {
                                                                        $revised = '<span class="ms-2 badge rounded-pill bg-secondary">Rev. '.$rows_hci['num_revised'].'</span>';
                                                                    }else{
                                                                        $revised = '';
                                                                    }

                                                                    if ($my_role == 1 && $rows_hci['status'] == 7):
                                                                        echo '<td><span class="badge rounded-pill bg-success">Completed</span>'.$revised.'</td>';                       
                                                                    endif;
                                                                    if ($my_role == 2 && $rows_hci['app_status'] == 1):
                                                                        echo '<td><span class="badge rounded-pill bg-success">Approved</span></td>';
                                                                    endif;
                                                                    if ($my_role == 3 && $rows_hci['rec_status'] == 1):
                                                                        echo '<td><span class="badge rounded-pill bg-success">Acknowledged</span></td>';
                                                                    endif;
                                                                    if ($my_role == 4 && $rows_hci['perf_status'] == 1):
                                                                        echo '<td><span class="badge rounded-pill bg-success">Provisioned</span></td>';
                                                                    endif;
                                                                    if ($my_role == 5 && $rows_hci['ver_status'] == 1):
                                                                        echo '<td><span class="badge rounded-pill bg-success">Confirmed</span></td>';
                                                                    endif;
                                                                    if ($my_role == 6 && $rows_hci['ver2_status'] == 1):
                                                                        echo '<td><span class="badge rounded-pill bg-success">Verified</span></td>';
                                                                    endif;

                                                                    

                                                                    if ($rows_hci['form_type'] == '1-1') {
                                                                        $print = '<a class="btn btn-outline-primary btn-sm shadow-sm" href="inc/print/print_hci_up.php?control_number='.$rows_hci["control_number"].'" target="_blank"  ><i class="fa-fw fas fa-print me-1"></i>Print</a>';
                                                                        echo '<td class="d-flex gap-2"><a class="btn btn-outline-primary btn-sm shadow-sm" href="#view_hci_update'.$rows_hci["control_number"].'" data-bs-toggle="modal" ><i class="fa-fw fas fa-eye me-1"></i>View</a>'.$print.'</td>';
                                                                        echo '<td>';
                                                                            include 'inc/hci_update.php';
                                                                        echo '</td>';
                                                                    }else if ($rows_hci['form_type'] == '1-2') {
                                                                        $print = '<a class="btn btn-outline-primary btn-sm shadow-sm" href="inc/print/print_hci_delete.php?control_number='.$rows_hci["control_number"].'" target="_blank"  ><i class="fa-fw fas fa-print me-1"></i>Print</a>';
                                                                        echo '<td class="d-flex gap-2"><a class="btn btn-outline-primary btn-sm shadow-sm" href="#view_hci_delete'.$rows_hci["control_number"].'" data-bs-toggle="modal" ><i class="fa-fw fas fa-eye me-1"></i>View</a>'.$print.'</td>';
                                                                        echo '<td>';
                                                                            include 'inc/hci_delete.php';
                                                                        echo '</td>';
                                                                    }else{
                                                                        $print = '<a class="btn btn-outline-primary btn-sm shadow-sm" href="inc/print/print_hci.php?control_number='.$rows_hci["control_number"].'" target="_blank"  ><i class="fa-fw fas fa-print me-1"></i>Print</a>';
                                                                        echo '<td class="d-flex gap-2"><a class="btn btn-outline-primary btn-sm shadow-sm" href="#view_hci'.$rows_hci["control_number"].'" data-bs-toggle="modal" ><i class="fa-fw fas fa-eye me-1"></i>View</a>'.$print.'</td>';
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
                                        </div>
                                        <?php if ($my_role !=2): ?>
                                        <div class="tab-pane" role="tabpanel" id="tab-2">
                                            <div class="table-responsive">
                                                <table class="table table-hover user-select-none align-middle text-nowrap" id="tci_datatables">
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
                                                                $tci_query = mysqli_query($conn,"SELECT * FROM tbl_tci where uid = '$uid' and status = '7' ORDER BY date_requested DESC ");
                                                            }elseif ($my_role == 3){
                                                                $tci_query = mysqli_query($conn,"SELECT * FROM tbl_tci where reciever_id = '$uid' and rec_status = '1'  ORDER BY date_requested DESC ");
                                                            }elseif ($my_role == 4){
                                                                $tci_query = mysqli_query($conn,"SELECT * FROM tbl_tci where performer_id = '$uid' and perf_status = '1'  ORDER BY date_requested DESC ");
                                                            }elseif ($my_role == 5){
                                                                $tci_query = mysqli_query($conn,"SELECT * FROM tbl_tci where verifier_id = '$uid' and ver_status = '1'  ORDER BY date_requested DESC ");
                                                            }elseif ($my_role == 6){
                                                                $tci_query = mysqli_query($conn,"SELECT * FROM tbl_tci where verifier_2id = '$uid' and ver2_status = '1'  ORDER BY date_requested DESC ");
                                                            }

                                                             
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
                                                                if ($my_role == 1 && $rows_tci['status'] == 7):
                                                                    echo '<td><span class="badge rounded-pill bg-success">Completed</span></td>';                       
                                                                endif;
                                                                if ($my_role == 3 && $rows_tci['rec_status'] == 1):
                                                                    echo '<td><span class="badge rounded-pill bg-success">Acknowledged</span></td>';
                                                                endif;
                                                                if ($my_role == 4 && $rows_tci['perf_status'] == 1):
                                                                    echo '<td><span class="badge rounded-pill bg-success">Provisioned</span></td>';
                                                                endif;
                                                                if ($my_role == 5 && $rows_tci['ver_status'] == 1):
                                                                    echo '<td><span class="badge rounded-pill bg-success">Confirmed</span></td>';
                                                                endif;
                                                                if ($my_role == 6 && $rows_tci['ver2_status'] == 1):
                                                                    echo '<td><span class="badge rounded-pill bg-success">Verified</span></td>';
                                                                endif;
                                                                if ($rows_tci['status'] >= 3 && $rows_tci['status'] <= 7):
                                                                    $print = '<a class="btn btn-outline-primary btn-sm shadow-sm" href="inc/print/print_tci.php?control_number='.$rows_tci["control_number"].'" target="_blank" ><i class="fa-fw fas fa-print me-1"></i>Print</a>';
                                                                else:
                                                                    $print = '';
                                                                endif;
                                                                echo '<td class="d-flex gap-2"><a class="btn btn-outline-primary btn-sm shadow-sm" href="#view_tci'.$rows_tci["control_number"].'" data-bs-toggle="modal" ><i class="fa-fw fas fa-eye me-1"></i>View</a>'.$print.'</td>';
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
                                        <?php endif; ?>
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
                                                            $num = 1;
                                                            if ($my_role == 1) {
                                                                $cps_query = mysqli_query($conn,"SELECT * FROM tbl_cps where uid = '$uid' and status = '7' ORDER BY date_requested DESC ");
                                                            }elseif ($my_role == 2){
                                                                $cps_query = mysqli_query($conn,"SELECT * FROM tbl_cps where approver_id = '$uid' and app_status = '1'  ORDER BY date_requested DESC ");
                                                            }elseif ($my_role == 3){
                                                                $cps_query = mysqli_query($conn,"SELECT * FROM tbl_cps where reciever_id = '$uid' and rec_status = '1'  ORDER BY date_requested DESC ");
                                                            }elseif ($my_role == 4){
                                                                $cps_query = mysqli_query($conn,"SELECT * FROM tbl_cps where performer_id = '$uid' and perf_status = '1'  ORDER BY date_requested DESC ");
                                                            }elseif ($my_role == 5){
                                                                $cps_query = mysqli_query($conn,"SELECT * FROM tbl_cps where verifier_id = '$uid' and ver_status = '1'  ORDER BY date_requested DESC ");
                                                            }elseif ($my_role == 6){
                                                                $cps_query = mysqli_query($conn,"SELECT * FROM tbl_cps where verifier_2id = '$uid' and ver2_status = '1'  ORDER BY date_requested DESC ");
                                                            }
                                                               
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

                                                                if ($my_role == 1 && $rows_cps['status'] == 7):
                                                                    echo '<td><span class="badge rounded-pill bg-success">Completed</span></td>';                       
                                                                endif;
                                                                if ($my_role == 2 && $rows_cps['app_status'] == 1):
                                                                    echo '<td><span class="badge rounded-pill bg-success">Approved</span></td>';
                                                                endif;
                                                                if ($my_role == 3 && $rows_cps['rec_status'] == 1):
                                                                    echo '<td><span class="badge rounded-pill bg-success">Acknowledged</span></td>';
                                                                endif;
                                                                if ($my_role == 4 && $rows_cps['perf_status'] == 1):
                                                                    echo '<td><span class="badge rounded-pill bg-success">Provisioned</span></td>';
                                                                endif;
                                                                if ($my_role == 5 && $rows_cps['ver_status'] == 1):
                                                                    echo '<td><span class="badge rounded-pill bg-success">Confirmed</span></td>';
                                                                endif;
                                                                if ($my_role == 6 && $rows_cps['ver2_status'] == 1):
                                                                    echo '<td><span class="badge rounded-pill bg-success">Verified</span></td>';
                                                                endif;
                                                                

                                                                if ($rows_cps['form_type'] == '3-1') {
                                                                    $print = '<a class="btn btn-outline-primary btn-sm shadow-sm" href="inc/print/print_cps_up.php?control_number='.$rows_cps["control_number"].'" target="_blank" ><i class="fa-fw fas fa-print me-1"></i>Print</a>';
                                                                    echo '<td class="d-flex gap-2"><a class="btn btn-outline-primary btn-sm shadow-sm" href="#view_cps_update'.$rows_cps["control_number"].'" data-bs-toggle="modal" ><i class="fa-fw fas fa-eye me-1"></i>View</a>'.$print.'</td>';
                                                                    echo '<td>';
                                                                        include 'inc/cps_update.php';
                                                                    echo '</td>';
                                                                }else if ($rows_cps['form_type'] == '3-2') {
                                                                    $print = '<a class="btn btn-outline-primary btn-sm shadow-sm" href="inc/print/print_cps_del.php?control_number='.$rows_cps["control_number"].'" target="_blank" ><i class="fa-fw fas fa-print me-1"></i>Print</a>';
                                                                    echo '<td class="d-flex gap-2"><a class="btn btn-outline-primary btn-sm shadow-sm" href="#view_cps_delete'.$rows_cps["control_number"].'" data-bs-toggle="modal" ><i class="fa-fw fas fa-eye me-1"></i>View</a>'.$print.'</td>';
                                                                    echo '<td>';
                                                                        include 'inc/cps_delete.php';
                                                                    echo '</td>';
                                                                }else{
                                                                    $print = '<a class="btn btn-outline-primary btn-sm shadow-sm" href="inc/print/print_cps.php?control_number='.$rows_cps["control_number"].'" target="_blank" ><i class="fa-fw fas fa-print me-1"></i>Print</a>';
                                                                    echo '<td class="d-flex gap-2"><a class="btn btn-outline-primary btn-sm shadow-sm" href="#view_cps'.$rows_cps["control_number"].'" data-bs-toggle="modal" ><i class="fa-fw fas fa-eye me-1"></i>View</a>'.$print.'</td>';
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
                                                <table class="table table-hover user-select-none align-middle text-nowrap" id="baas_datatables">
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
                                                            $num = 1;
                                                            if ($my_role == 1) {
                                                                $sql_baas = mysqli_query($conn,"SELECT * FROM tbl_baas where uid = '$uid' and status = '7' ORDER BY date_requested DESC ");
                                                            }elseif ($my_role == 2){
                                                                $sql_baas = mysqli_query($conn,"SELECT * FROM tbl_baas where approver_id = '$uid' and app_status = '1'  ORDER BY date_requested DESC ");
                                                            }elseif ($my_role == 3){
                                                                $sql_baas = mysqli_query($conn,"SELECT * FROM tbl_baas where reciever_id = '$uid' and rec_status = '1'  ORDER BY date_requested DESC ");
                                                            }elseif ($my_role == 4){
                                                                $sql_baas = mysqli_query($conn,"SELECT * FROM tbl_baas where performer_id = '$uid' and perf_status = '1'  ORDER BY date_requested DESC ");
                                                            }elseif ($my_role == 5){
                                                                $sql_baas = mysqli_query($conn,"SELECT * FROM tbl_baas where verifier_id = '$uid' and ver_status = '1'  ORDER BY date_requested DESC ");
                                                            }elseif ($my_role == 6){
                                                                $sql_baas = mysqli_query($conn,"SELECT * FROM tbl_baas where verifier_2id = '$uid' and ver2_status = '1'  ORDER BY date_requested DESC ");
                                                            }
                                                        
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
                                                                    echo '<td>BaaS</td>';
                                                                }
                                                                if ($my_role == 1 && $rows_baas['status'] == 7):
                                                                    echo '<td><span class="badge rounded-pill bg-success">Completed</span></td>';                       
                                                                endif;
                                                                if ($my_role == 2 && $rows_baas['app_status'] == 1):
                                                                    echo '<td><span class="badge rounded-pill bg-success">Approved</span></td>';
                                                                endif;
                                                                if ($my_role == 3 && $rows_baas['rec_status'] == 1):
                                                                    echo '<td><span class="badge rounded-pill bg-success">Acknowledged</span></td>';
                                                                endif;
                                                                if ($my_role == 4 && $rows_baas['perf_status'] == 1):
                                                                    echo '<td><span class="badge rounded-pill bg-success">Provisioned</span></td>';
                                                                endif;
                                                                if ($my_role == 5 && $rows_baas['ver_status'] == 1):
                                                                    echo '<td><span class="badge rounded-pill bg-success">Confirmed</span></td>';
                                                                endif;
                                                                if ($my_role == 6 && $rows_baas['ver2_status'] == 1):
                                                                    echo '<td><span class="badge rounded-pill bg-success">Verified</span></td>';
                                                                endif;
                                                                
                                                                    
                                                                if ($rows_baas['form_type'] == '4-2') {
                                                                    $print = '<a class="btn btn-outline-primary btn-sm shadow-sm" href="inc/print/print_baas_crrf.php?control_number='.$rows_baas["control_number"].'" target="_blank" ><i class="fa-fw fas fa-print me-1"></i>Print</a>';
                                                                    echo '<td class="d-flex gap-2"><a class="btn btn-outline-primary btn-sm shadow-sm" href="#view_baas_2'.$rows_baas["control_number"].'" data-bs-toggle="modal" ><i class="fa-fw fas fa-eye me-1"></i>View</a>'.$print.'</td>';
                                                                    echo '<td>';
                                                                        include 'inc/baas_modal_2.php';
                                                                    echo '</td>';                                                                   
                                                                }else{
                                                                    $print = '<a class="btn btn-outline-primary btn-sm shadow-sm" href="inc/print/print_baas_csrf.php?control_number='.$rows_baas["control_number"].'" target="_blank" ><i class="fa-fw fas fa-print me-1"></i>Print</a>';
                                                                    echo '<td class="d-flex gap-2"><a class="btn btn-outline-primary btn-sm shadow-sm" href="#view_baas'.$rows_baas["control_number"].'" data-bs-toggle="modal" ><i class="fa-fw fas fa-eye me-1"></i>View</a>'.$print.'</td>';
                                                                    echo '<td>';
                                                                        include 'inc/baas_modal.php';
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
        <?php
            include 'inc/baas_modal.php';
        ?>
        <script src="assets/js/jquery-3.6.0.js"></script>

        <!-- Data Tables -->
        <script src="assets/js/jquery.dataTables.min.js"></script>
        <script src="assets/js/dataTables.bootstrap5.min.js"></script>

        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/theme.js"></script>
        <script>
            $(document).ready(function(){
                $('#hci_datatables, #tci_datatables, #cps_datatables, #baas_datatables').DataTable({
                    responsive: true,
                    "language": {
                        "emptyTable": "There is no data to be showed!🤗",
                        "zeroRecords": "No data found!🤗"
                    }
                }); // // Datatables


                $("#os").on('change',function(){
                    var os = $(this).val();
                    $("#version").text("");
                    $("#add_textbox").html('');
                    if (os == 'aix') {
                        
                        $("#add_textbox").append('<select name="version" id="version" class="form-select" required><option value="" selected disabled >Select AIX Version</option></select>');
                        var aix_list = ["7.1","7.2"];
                        for (var i=0; i < aix_list.length; i++){
                            var create_option = $('<option value='+aix_list[i]+'>'+aix_list[i]+'</option>');
                            $("#version").append(create_option);
                        }
                    }else if(os == 'rhel'){
                        $("#version").remove(); 
                        $("#add_textbox").append("<input type='text' class='form-control' name='version' id='version' required placeholder='Input the version'>");

                    }else if (os == 'windows'){
                        
                        $("#add_textbox").append('<select name="version" id="version" class="form-select" required><option value="" selected disabled >Select Windows Version</option></select>');
                        var aix_list_three = ["2012","2016","2019"];
                        for (var l=0; l < aix_list_three.length; l++){
                            var create_option_three = $('<option value='+aix_list_three[l]+' >'+aix_list_three[l]+'</option>');
                            $("#version").append(create_option_three);
                        }
                    }
                });

                $('input[name="rad_approver"]').click(function(){
                    $('input[name="rad_approver"]').not(this).prop('checked',false);
                });
                $('.cluster').click(function(){
                    $('.cluster').not(this).prop('checked',false);
                });
                $('.tci_cluster').click(function(){
                    $('.tci_cluster').not(this).prop('checked',false);
                });
                $('.tci_report').click(function(){
                    $('.tci_report').not(this).prop('checked',false);
                });
                $('.tci_location').click(function(){
                    $('.tci_location').not(this).prop('checked',false);
                });                                 
            });            
        </script>
    </body>
</html>