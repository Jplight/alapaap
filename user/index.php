<?php  
session_start();
ob_start();
date_default_timezone_set('Asia/Manila');

require 'inc/GetTimeAgo.php';

include '../model/connection.php';
$uid = $_SESSION['uid'];
$role= $_SESSION['role'];

if ($role == 'admin'){
    session_destroy();
    header("location: http://".$_SERVER['SERVER_NAME']."/index.php");
}


$sql = mysqli_query($conn,"SELECT * FROM tbl_user where uid = '$uid' ");
while ($rows = mysqli_fetch_array($sql)):

    $my_fullname    = $rows['first_name']." ".$rows['last_name'];
    $email          = $rows['email_add'];
    $contact_no     = $rows['contact_no'];
    $my_role        = $rows['role'];
    $sub_role       = $rows['sub_role'];
    $role_count     = $my_role + 1;
    
endwhile;
    
if ($my_role == 1) {
    $query      = "SELECT uid,status from tbl_baas where uid = '$uid' and status BETWEEN 2 and 6 UNION ALL SELECT uid,status from tbl_hci where uid = '$uid' and status BETWEEN 2 and 6 UNION ALL SELECT uid,status from tbl_tci where uid = '$uid' and status BETWEEN 2 and 6 UNION ALL SELECT uid,status from tbl_cps where uid = '$uid' and status BETWEEN 2 and 6";
    $query_2    = "SELECT uid,status FROM tbl_baas where uid = '$uid' and status = 7 UNION ALL SELECT uid,status FROM tbl_hci where uid = '$uid' and status = 7 UNION ALL SELECT uid,status FROM tbl_tci where uid = '$uid' and status = 7 UNION ALL SELECT uid,status FROM tbl_cps where uid = '$uid' and status = 7 ";
    $query_3    = "SELECT uid,status FROM tbl_baas where uid = '$uid' and status = 1 UNION ALL SELECT uid,status FROM tbl_hci where uid = '$uid' and status = '1' UNION ALL SELECT uid,status FROM tbl_tci where uid = '$uid' and status = '1' UNION ALL SELECT uid,status FROM tbl_cps where uid = '$uid' and status = '1' ";
    $query_4    = "SELECT uid,status,app_status FROM tbl_hci where uid = '$uid' and status = 0 and revised IS NULL and app_status = 0  UNION ALL SELECT uid,status,app_status FROM tbl_baas where uid = '$uid' and status = 0 and revised IS NULL and app_status = 0 UNION ALL SELECT uid,status,app_status FROM tbl_cps where uid = '$uid' and status = 0 and revised IS NULL and app_status = 0 ";
    $query_5    = "SELECT uid,status,revised FROM tbl_hci where uid = '$uid' and status = '0' and revised = '1' UNION ALL SELECT uid,status,revised FROM tbl_tci where uid = '$uid' and status = '0' and revised = '1' UNION ALL SELECT uid,status,revised FROM tbl_cps where uid = '$uid' and status = '0' and revised = '1' UNION ALL SELECT uid,status,revised FROM tbl_baas where uid = '$uid' and status = '0' and revised = '1'";
    $query_6    = "SELECT uid,status,cancelled from tbl_hci where uid = '$uid' and status = '0' and cancelled = '1' UNION ALL SELECT uid,status,cancelled from tbl_tci where uid = '$uid' and status = '0' and cancelled = '1' UNION ALL SELECT uid,status,cancelled from tbl_cps where uid = '$uid' and status = '0' and cancelled = '1' UNION ALL SELECT uid,status,cancelled from tbl_baas where uid = '$uid' and status = '0' and cancelled = '1' ";
}

if ($my_role == 2) {
    $query      = "SELECT status FROM tbl_baas where status = '$my_role' UNION ALL SELECT status FROM tbl_hci where status = '$my_role' UNION ALL SELECT status FROM tbl_tci where status = '$my_role' UNION ALL SELECT status FROM tbl_cps where status = '$my_role' ";
    $query_2    = "SELECT app_status FROM tbl_baas where approver_id = '$uid' and app_status = '1' UNION ALL SELECT app_status FROM tbl_hci where approver_id = '$uid' and app_status = '1' UNION ALL SELECT app_status FROM tbl_tci where approver_id = '$uid' and app_status = '1' UNION ALL SELECT app_status FROM tbl_cps where approver_id = '$uid' and app_status = '1' ";
    $query_4    = "SELECT approver_id,app_status FROM tbl_baas where approver_id = '$uid' and status = '0' and revised IS NULL and app_status = '0' UNION ALL SELECT approver_id,app_status FROM tbl_hci where approver_id = '$uid' and status = '0' and revised IS NULL and app_status = '0' UNION ALL SELECT approver_id,app_status FROM tbl_cps where approver_id = '$uid' and status = '0' and revised IS NULL and app_status = '0'";
    $query_5     = "SELECT app_status,revised FROM tbl_hci where approver_id = '$uid' and app_status = 0 and revised = '1' UNION ALL SELECT app_status,revised FROM tbl_cps where approver_id = '$uid' and status = '0' and revised = '1' and app_status = '0' UNION ALL SELECT app_status,revised FROM tbl_baas where approver_id = '$uid' and status = '0' and revised = '1' and app_status = '0' ";
}
if ($my_role == 3) {
    $query    = "SELECT status FROM tbl_baas where status = '$my_role' UNION ALL SELECT status FROM tbl_hci where status = '$my_role' UNION ALL SELECT status FROM tbl_tci where status = '$my_role' UNION ALL SELECT status FROM tbl_cps where status = '$my_role' ";
    $query_2    = "SELECT rec_status FROM tbl_baas where reciever_id = '$uid' and rec_status = '1' UNION ALL SELECT rec_status FROM tbl_hci where reciever_id = '$uid' and rec_status = '1' UNION ALL SELECT rec_status FROM tbl_tci where reciever_id = '$uid' and rec_status = '1' UNION ALL SELECT rec_status FROM tbl_cps where reciever_id = '$uid' and rec_status = '1' ";
    $query_5     = "SELECT rec_status,revised FROM tbl_hci where reciever_id = '$uid' and rec_status = 0 and revised = '1' UNION ALL SELECT rec_status,revised FROM tbl_tci where reciever_id = '$uid' and rec_status = 0 and revised = '1' UNION ALL SELECT rec_status,revised FROM tbl_cps where reciever_id = '$uid' and rec_status = 0 and revised = '1' UNION ALL SELECT rec_status,revised FROM tbl_baas where reciever_id = '$uid' and rec_status = 0 and revised = '1' ";
}
if ($my_role == 4) {
    $query    = "SELECT status FROM tbl_baas where status = '$my_role' UNION ALL SELECT status FROM tbl_hci where status = '$my_role' UNION ALL SELECT status FROM tbl_tci where status = '$my_role' UNION ALL SELECT status FROM tbl_cps where status = '$my_role' ";
    $query_2    = "SELECT perf_status FROM tbl_baas where performer_id = '$uid' and perf_status = '1' UNION ALL SELECT perf_status FROM tbl_hci where performer_id = '$uid' and perf_status = '1' UNION ALL SELECT perf_status FROM tbl_tci where performer_id = '$uid' and perf_status = '1' UNION ALL SELECT perf_status FROM tbl_cps where performer_id = '$uid' and perf_status = '1' ";
    $query_5     = "SELECT status,perf_status FROM tbl_hci where performer_id = '$uid' and perf_status = '0' and revised = '1' UNION ALL SELECT perf_status,revised FROM tbl_tci where performer_id = '$uid' and perf_status = 0 and revised = '1' UNION ALL SELECT perf_status,revised FROM tbl_cps where performer_id = '$uid' and perf_status = 0 and revised = '1' UNION ALL SELECT perf_status,revised FROM tbl_baas where performer_id = '$uid' and perf_status = 0 and revised = '1' ";
}
if ($my_role == 5) {
    $query    = "SELECT status FROM tbl_baas where status = '$my_role' UNION ALL SELECT status FROM tbl_hci where status = '$my_role' UNION ALL SELECT status FROM tbl_tci where status = '$my_role' UNION ALL SELECT status FROM tbl_cps where status = '$my_role' ";
    $query_2    = "SELECT ver_status FROM tbl_baas where verifier_id = '$uid' and ver_status = '1' UNION ALL SELECT ver_status FROM tbl_hci where verifier_id = '$uid' and ver_status = '1' UNION ALL SELECT ver_status FROM tbl_tci where verifier_id = '$uid' and ver_status = '1' UNION ALL SELECT ver_status FROM tbl_cps where verifier_id = '$uid' and ver_status = '1' ";
}
if ($my_role == 6) {
    $query    = "SELECT status FROM tbl_baas where status = '$my_role' UNION ALL SELECT status FROM tbl_hci where status = '$my_role' UNION ALL SELECT status FROM tbl_tci where status = '$my_role' UNION ALL SELECT status FROM tbl_cps where status = '$my_role' ";
    $query_2    = "SELECT ver2_status FROM tbl_baas where verifier_2id = '$uid' and ver2_status = '1' UNION ALL SELECT ver2_status FROM tbl_hci where verifier_2id = '$uid' and ver2_status = '1' UNION ALL SELECT ver2_status FROM tbl_tci where verifier_2id = '$uid' and ver2_status = '1' UNION ALL SELECT ver2_status FROM tbl_cps where verifier_2id = '$uid' and ver2_status = '1' ";
}

$sql_count = mysqli_query($conn,$query);
$pending_count = mysqli_num_rows($sql_count); // Count the number of Pending Request

$sql_count_2 = mysqli_query($conn,$query_2);
$completed_count = mysqli_num_rows($sql_count_2); // Count the number of Completed Request

if ($my_role == 1) {
    $sql_count_3 = mysqli_query($conn,$query_3);
    $draft_count = mysqli_num_rows($sql_count_3); // Count the number of Draft Form        
}

if ($my_role == 1) {
    $sql_count_6 = mysqli_query($conn,$query_6);
    $cancelled_count = mysqli_num_rows($sql_count_6);
}

if ($my_role == 1 || $my_role == 2) {
    $sql_count_4 = mysqli_query($conn,$query_4);
    $disapproved_count = mysqli_num_rows($sql_count_4); // Count the number of Disapproved Form 
}     

if ($my_role >= 1 && $my_role <= 4) {
    $sql_count_5 = mysqli_query($conn,$query_5);
    $returned_count = mysqli_num_rows($sql_count_5); // Count the number of Returned Form
}

include 'model/hci_form.php';
include 'model/hci_update_form.php';
include 'model/hci_delete_form.php';

include 'model/tci_form.php';

include 'model/cps_form.php';
include 'model/cps_form_update.php';
include 'model/cps_form_delete.php';

include 'model/baas_form.php';
include 'model/baas_form_2.php';
include 'model/save_profile.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Alapaap | Dashboard</title>
        <link rel="icon" type="image/svg+xml" sizes="30x24" href="assets/img/android-chrome-192x192.png">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
        <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
        <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
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
        .card{
            transition: all 0.3s ease;
        }
        .card:hover{
            transform: scale(1.08);
        }
        .navbar-nav .nav-item .active{
            background: #18a974;
            color: black;
        }
        /* .navbar-nav .nav-item .nav-link_active{
            color: black;
        } */
        .navbar-nav .nav-item .nav-link_active:hover:not(.active){
            background: #1aba80;
        }
        .dropdown .dropdown-menu .dropdown-item .nav:hover{
            display: block;
        }
        </style>
        <style type="text/css">

        /* ============ desktop view ============ */
        @media all and (min-width: 992px) {

            .dropdown-menu li{
                position: relative;
            }
            .dropdown-menu .submenu{ 
                display: none;
                position: absolute;
                left:100%; top:-7px;
            }
            .dropdown-menu .submenu-left{ 
                right:100%; left:auto;
            }

            .dropdown-menu > li:hover{ background-color: #f1f1f1 }
            .dropdown-menu > li:hover > .submenu{
                display: block;
            }
        }   
        /* ============ desktop view .end// ============ */

        /* ============ small devices ============ */
        @media (max-width: 991px) {

        .dropdown-menu .dropdown-menu{
                margin-left:0.7rem; margin-right:0.7rem; margin-bottom: .5rem;
        }

        }   
        /* ============ small devices .end// ============ */

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
                        <div class="d-flex justify-content-between flex-column flex-lg-row mb-4">
                            <h3 class="text-dark">BSP Managed Services Requisition System</h3>
                            <?php if ($my_role == 1): ?>
                            <div class="dropdown">
                                <a class="btn btn-success shadow-none text-white" href="#" data-bs-toggle="dropdown">Select Services<i class="fa-fw fas fa-chevron-down ms-1"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                  <li><a class="dropdown-item user-select-none" style="cursor: pointer;"><span class="">HCI</span><i class="fa-fw fas fa-chevron-down m-auto"></i></a>
                                     <ul class="submenu submenu-left dropdown-menu">
                                        <li><a class="dropdown-item user-select-none" data-bs-toggle="modal" data-bs-target="#view_hci" style="cursor: pointer;">NEW</a></li>
                                        <li><a class="dropdown-item user-select-none" data-bs-toggle="modal" data-bs-target="#view_hci_update" style="cursor: pointer;">UPDATE</a></li>
                                        <li><a class="dropdown-item user-select-none" data-bs-toggle="modal" data-bs-target="#view_hci_delete" style="cursor: pointer;">DELETE</a></li>
                                     </ul>
                                  </li>
                                  <li><a class="dropdown-item user-select-none" data-bs-toggle="modal" data-bs-target="#view_tci" style="cursor: pointer;">Adhoc Request</a></li>                           
                                  <li><a class="dropdown-item user-select-none" style="cursor: pointer;"><span class="">CPS</span><i class="fa-fw fas fa-chevron-down m-auto"></i></a>
                                     <ul class="submenu submenu-left dropdown-menu">
                                        <li><a class="dropdown-item user-select-none" data-bs-toggle="modal" data-bs-target="#view_cps" style="cursor: pointer;">NEW</a></li>
                                        <li><a class="dropdown-item user-select-none" data-bs-toggle="modal" data-bs-target="#view_cps_update" style="cursor: pointer;">UPDATE</a></li>
                                        <li><a class="dropdown-item user-select-none" data-bs-toggle="modal" data-bs-target="#view_cps_delete" style="cursor: pointer;">DELETE</a></li>
                                     </ul>
                                  </li>
                                  <li><a class="dropdown-item user-select-none" style="cursor: pointer;"><span class="">BaaS</span><i class="fa-fw fas fa-chevron-down m-auto"></i></a>
                                     <ul class="submenu submenu-left dropdown-menu">
                                        <li><a class="dropdown-item user-select-none" data-bs-toggle="modal" data-bs-target="#view_baas" style="cursor: pointer;">Client Server Registration Form</a></li>
                                        <li><a class="dropdown-item user-select-none" data-bs-toggle="modal" data-bs-target="#view_baas_2" style="cursor: pointer;">Client Restore and Retrieve Form</a></li>
                                     </ul>
                                  </li>
                                </ul>
                            </div>                            
                            <?php endif; ?>
                        </div>
                        <div class="row gx-3">
                            <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                                <div class="card shadow border-start-primary py-2">
                                    <div class="card-body">
                                        <div class="d-block">
                                            <div class="text-uppercase text-primary fw-bold text-xs">
                                                <span class="text-warning">Pending request</span>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-end">
                                            <div class="text-dark fw-bold h5 mb-0">
                                                <span><?=$pending_count; ?></span>
                                            </div>
                                            <div class="">
                                                <i class="far fa-file-alt fa-2x text-gray-300"></i>
                                            </div>
                                        </div>           
                                        <a class="card-link stretched-link" href="pending_request.php"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                                <div class="card shadow border-start-success py-2">
                                    <div class="card-body">
                                        <div class="d-block">
                                            <div class="text-uppercase text-success fw-bold text-xs">
                                                <?php
                                                    echo $my_role == 1 ? '<span class="text-nowrap">Completed Request</span>' : '';  
                                                    echo $my_role == 2 ? '<span>Approved</span>' : '';
                                                    echo $my_role == 3 ? '<span>Acknowledged</span>' : '';
                                                    echo $my_role == 4 ? '<span>Provisioned</span>' : '';
                                                    echo $my_role == 5 ? '<span>Confirmed</span>' : '';
                                                    echo $my_role == 6 ? '<span>Verified</span>' : '';
                                                ?>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-end">
                                            <div class="text-dark fw-bold h5 mb-0">
                                                <span><?=$completed_count; ?></span>
                                            </div>
                                            <div class="">
                                                <i class="fas fa-file-signature fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                        <a class="card-link stretched-link" href="approved_request.php"></a>
                                    </div>
                                </div>
                            </div>                        
                            <?php if ($my_role == 1): ?>
                            <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                                <div class="card shadow border-start-info py-2">
                                    <div class="card-body">
                                        <div class="d-block">
                                            <div class="text-uppercase text-info fw-bold text-xs">
                                                <span class="text-muted">Draft</span>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-end">
                                            <div class="text-dark fw-bold h5 mb-0">
                                                <span><?=$draft_count; ?></span>
                                            </div>
                                            <div class="">
                                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                            </div>
                                        </div>           
                                        <a class="card-link stretched-link" href="draft_form.php"></a>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php if ($my_role == 1 || $my_role == 2): ?>
                            <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                                <div class="card shadow border-start-info py-2">
                                    <div class="card-body">
                                        <div class="d-block">
                                            <div class="text-uppercase text-danger fw-bold text-xs">
                                                <span>Returned</span>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-end">
                                            <div class="text-dark fw-bold h5 mb-0">
                                                <span><?=$returned_count; ?></span>
                                            </div>
                                            <div class="">
                                                <i class="fas fa-redo-alt fa-2x text-gray-300"></i>
                                            </div>
                                        </div>           
                                        <a class="card-link stretched-link" href="returned_request.php"></a>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php if ($my_role >= 1 && $my_role <=2): ?>
                            <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                                <div class="card shadow border-start-info py-2">
                                    <div class="card-body">
                                        <div class="d-block">
                                            <div class="text-uppercase text-danger fw-bold text-xs">
                                                <span>disapproved</span>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-end">
                                            <div class="text-dark fw-bold h5 mb-0">
                                                <span><?=$disapproved_count; ?></span>
                                            </div>
                                            <div class="">
                                                <i class="fas fa-times fa-2x text-gray-300"></i>
                                            </div>
                                        </div>           
                                        <a class="card-link stretched-link" href="disapproved.php"></a>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php if ($my_role == 1): ?>
                            <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                                <div class="card shadow border-start-info py-2">
                                    <div class="card-body">
                                        <div class="d-block">
                                            <div class="text-uppercase text-danger fw-bold text-xs">
                                                <span>Cancelled</span>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-end">
                                            <div class="text-dark fw-bold h5 mb-0">
                                                <span><?=$cancelled_count; ?></span>
                                            </div>
                                            <div class="">
                                                <i class="fas fa-file-excel fa-2x text-gray-300"></i>
                                            </div>
                                        </div>           
                                        <a class="card-link stretched-link" href="cancelled.php"></a>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <footer class="bg-white sticky-footer">
                    <source src="assets/audio/notification_sound.mp3" id="audio" controls>
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
            include 'inc/hci_new.php';
            include 'inc/hci_update.php'; 
            include 'inc/hci_delete.php';
            include 'inc/tci_modal.php';
            include 'inc/cps_new.php';
            include 'inc/cps_update.php';
            include 'inc/cps_delete.php';
            include 'inc/baas_modal.php';
            include 'inc/baas_modal_2.php';
            include 'inc/change_role_modal.php'; 
        ?>

        <script src="assets/js/jquery-3.6.0.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.validate.js"></script>
        <script src="assets/js/theme.js"></script>
        <script src="controller/hci_script.js"></script>
        <script src="controller/hci_del.js"></script>
        <script src="controller/weng.js"></script>
        <script src="controller/weng2.js"></script>
        <script src="controller/cps_script.js"></script>
        <script src="controller/cps_up_script.js"></script>
        <script src="controller/cps_del_script.js"></script>
        <script src="controller/tci_script.js"></script>
        <script src="assets/js/sweetalert2@11.js"></script>
        <!-- <script src="controller/validation.js"></script> -->
        <script src="controller/global.validation.js"></script>
        
        <script>  
            $(document).ready(function(){                
                $(".os").on('change',function(){
                    var os_name = $(this).val();
                    if (os_name == 'windows') {
                        $("input[name=txt_os_descript], input[name=txt_define_parti]").prop('disabled',false).val('').prop('required',false);    
                        $("input[name=txt_os_descript]").attr('placeholder','Specify OS Environment (with or w/o GUI:)');
                        $("input[name=os_comment]").attr('placeholder','OS Version e.g. Window Server 2019');
                    }else if (os_name == 'linux') {
                        $("input[name=txt_os_descript], input[name=txt_define_parti]").prop('disabled',false).val('').prop('required',true);
                        $("input[name=txt_os_descript]").attr('placeholder','For Linux OS, please specify if w/ or w/o GUI');
                        $("input[name=os_comment]").attr('placeholder','Linux Distribution and version number');
                        
                    }else{
                        $("input[name=txt_os_descript], input[name=txt_define_parti]").prop('disabled',true).val('').prop('required',false);
                        $("input[name=txt_os_descript]").attr('placeholder','Specify OS Environment (with or w/o GUI:)');
                        $("input[name=os_comment]").attr('placeholder','OS version');
                    }        
                });
                
                $(".hci_cluster").click(function(){
                    $(".hci_cluster").not(this).prop("checked",false).prop('required',false);
                });

                var attr_modal = "data-bs-dismiss='modal'";


                // iF this button is click, it will clear of the data inside of the form modal.
                $("button[data-bs-dismiss=modal]").click(function(){
                    location.reload();
                    $("form").trigger('reset');
                    $("#hci_up_disk, #hci_del_disk").remove(); // this code will remove the DISK GB, if theres data tobe fetch
                }); 

                $('#myselect').change(function() {
                    var opval = $(this).val();
                    $("#weng_id").val('');
                    if (opval == 'req'){
                        $("#weng_id").val('1');
                        $("#role_txt").text('Requestor');
                        $('#myModal').modal("show");
                    }
                    if(opval=="appr"){
                        $("#weng_id").val('2');
                        $("#role_txt").text('Approver');
                        $('#myModal').modal("show");
                    }
                    if(opval=="rec"){
                        $("#weng_id").val('3');
                        $("#role_txt").text('Receiver');
                        $('#myModal').modal("show");
                    }
                    if(opval=="perf"){
                        $("#weng_id").val('4');
                        $("#role_txt").text('Performer');
                        $('#myModal').modal("show");
                    }
                    if(opval=="conf"){
                        $("#weng_id").val('5');
                        $("#role_txt").text('Confirmer');
                        $('#myModal').modal("show");
                    }
                    if(opval=="veri"){
                        $("#weng_id").val('6');
                        $("#role_txt").text('Verifier');
                        $('#myModal').modal("show");
                    }
                });           
            });            
        </script>
        <script type="text/javascript">
        //  window.addEventListener("resize", function() {
        //      "use strict"; window.location.reload(); 
        //  });
            document.addEventListener("DOMContentLoaded", function(){
                /////// Prevent closing from click inside dropdown
                document.querySelectorAll('.dropdown-menu').forEach(function(element){
                    element.addEventListener('click', function (e) {
                      e.stopPropagation();
                    });
                })

                // make it as accordion for smaller screens
                if (window.innerWidth < 992) {

                    // close all inner dropdowns when parent is closed
                    document.querySelectorAll('.navbar .dropdown').forEach(function(everydropdown){
                        everydropdown.addEventListener('hidden.bs.dropdown', function () {
                            // after dropdown is hidden, then find all submenus
                              this.querySelectorAll('.submenu').forEach(function(everysubmenu){
                                // hide every submenu as well
                                everysubmenu.style.display = 'none';
                              });
                        })
                    });
                    
                    document.querySelectorAll('.dropdown-menu a').forEach(function(element){
                        element.addEventListener('click', function (e) {
                
                            let nextEl = this.nextElementSibling;
                            if(nextEl && nextEl.classList.contains('submenu')) {    
                                // prevent opening link if link needs to open dropdown
                                e.preventDefault();
                                console.log(nextEl);
                                if(nextEl.style.display == 'block'){
                                    nextEl.style.display = 'none';
                                } else {
                                    nextEl.style.display = 'block';
                                }

                            }
                        });
                    })
                }
                // end if innerWidth
            });
            // DOMContentLoaded  end
        </script>
        <script>
            // For Alerts
            $(document).ready(function () {
                $.ajax({
                    type: "POST",
                    url: "model/alerts.php",
                    dataType: "html",
                    success: function (data) {
                        $("#frm_notification").html(data);
                        $("#success_alert").toast('show');                
                    }
                });
            });
        </script>
        <script>
            // For notifications
            $(document).ready(function(){
                $("#btn_notif").click(function(){
                    setTimeout( function(){  
                        $.ajax({
                            type: "POST",
                            url: "model/notif_icon.php",
                            data: $("#frm_notif").serialize(),
                            success: function (data) {                                         
                                $("#notif_badge").html(data);       
                            }
                        });
                    },100);   
                });

            });
        </script>       
    </body>
</html>
<?php ob_end_flush(); ?>