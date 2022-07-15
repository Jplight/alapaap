<?php  
session_start();
ob_start();
date_default_timezone_set('Asia/Manila');

include '../model/connection.php';
$uid = $_SESSION['uid'];
$role= $_SESSION['role'];

if (!isset($uid)) {
    header("location: http://".$_SERVER['SERVER_NAME']."/index.php");
}

if ($role != 'admin'){
    session_destroy();
    header("location: http://".$_SERVER['SERVER_NAME']."/index.php");
}

$sql = mysqli_query($conn,"SELECT * FROM tbl_user where uid = '$uid' ");
while ($rows = mysqli_fetch_array($sql)):

    $my_fullname    = $rows['first_name']." ".$rows['last_name'];
    $email          = $rows['email_add'];
    $contact_no     = $rows['contact_no'];

endwhile;

// $sql_new_req = mysqli_query($conn,"SELECT * FROM tbl_user where status = 0");
// $count_new_req = mysqli_num_rows($sql_new_req);

$sql_users_priv = mysqli_query($conn,"SELECT * FROM tbl_req_role where status = 0 ");
$count_users_priv = mysqli_num_rows($sql_users_priv);

$total_users = mysqli_query($conn,"SELECT * FROM total_user");
$rows_total = mysqli_fetch_array($total_users);

$online_users = mysqli_query($conn,"SELECT * FROM active_user ");
$rows_online = mysqli_fetch_array($online_users);

$offline_users = mysqli_query($conn,"SELECT * FROM offline_user ");
$rows_offline = mysqli_fetch_array($offline_users);

$disabled_users = mysqli_query($conn,"SELECT * from disabled_user");
$rows_disabled = mysqli_fetch_array($disabled_users);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Alapaap | Admin Dashboard</title>
        <link rel="icon" type="image/svg+xml" sizes="30x24" href="assets/img/android-chrome-192x192.png">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
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
        .navbar-nav .nav-item .active{
            background: #18a974;
            color: black;
        }
        .navbar-nav .nav-item .nav-link_active{
            /* color: black; */
        }
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
        
        <div id="wrapper">
            <?php include 'inc/sidebar.php'; ?>
            <div class="d-flex flex-column" id="content-wrapper">
                <div id="content">
                    <?php include 'inc/navbar.php'; ?>

                    <div class="container-fluid">
                        <div class="d-sm-flex justify-content-between align-items-center mb-4">
                            <h3 class="text-dark mb-0 mb-3 mb-sm-0">Dashboard</h3>
                        </div>
                        <div class="row gx-3 mb-3">
                            <!-- <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                                <div class="card shadow border-start-primary py-2">
                                    <div class="card-body">
                                        <div class="d-block">
                                            <div class="text-uppercase text-primary fw-bold text-xs">
                                                <span class="text-warning">New Request</span>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-end">
                                            <div class="text-dark fw-bold h5 mb-0">
                                                <span><?=$count_new_req; ?></span> 
                                            </div>
                                            <div class="">
                                                <i class="fas fa-user-plus fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                        <a class="stretched-link" href="new_req.php"></a>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                                <div class="card shadow border-start-primary py-2">
                                    <div class="card-body">
                                        <div class="d-block">
                                            <div class="text-uppercase text-primary fw-bold text-xs">
                                                <span class="text-secondary">User's Privilege</span>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-end">
                                            <div class="text-dark fw-bold h5 mb-0">
                                                <span><?=$count_users_priv; ?></span>
                                            </div>
                                            <div class="">
                                                <i class="fas fa-user-friends fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                        <a class="stretched-link" href="approved_role.php"></a>           
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                                <div class="card shadow border-start-primary py-2">
                                    <div class="card-body">
                                        <div class="d-block">
                                            <div class="text-uppercase text-primary fw-bold text-xs">
                                                <span class="text-primary">Total Users</span>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-end">
                                            <div class="text-dark fw-bold h5 mb-0">
                                                <span><?=$rows_total['total']; ?></span>
                                            </div>
                                            <div class="">
                                                <i class="fas fa-users fa-2x text-gray-300"></i>
                                            </div>
                                        </div>           
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                                <div class="card shadow border-start-primary py-2">
                                    <div class="card-body">
                                        <div class="d-block">
                                            <div class="text-uppercase text-primary fw-bold text-xs">
                                                <span class="text-success">Online Users</span>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-end">
                                            <div class="text-dark fw-bold h5 mb-0">
                                                <span><?=$rows_online['isOnline'];?></span>
                                            </div>
                                            <div class="">
                                                <i class="fas fa-user-check fa-2x text-gray-300"></i>
                                            </div>
                                        </div>           
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                                <div class="card shadow border-start-primary py-2">
                                    <div class="card-body">
                                        <div class="d-block">
                                            <div class="text-uppercase text-primary fw-bold text-xs">
                                                <span class="text-secondary">Offline Users</span>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-end">
                                            <div class="text-dark fw-bold h5 mb-0">
                                                <span><?=$rows_offline['isOffline']; ?></span>
                                            </div>
                                            <div class="">
                                                <i class="fas fa-user-minus fa-2x text-gray-300"></i>
                                            </div>
                                        </div>           
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                                <div class="card shadow border-start-primary py-2">
                                    <div class="card-body">
                                        <div class="d-block">
                                            <div class="text-uppercase text-primary fw-bold text-xs">
                                                <span class="text-secondary">Disabled Accounts</span>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-end">
                                            <div class="text-dark fw-bold h5 mb-0">
                                                <span><?=$rows_disabled['isDisabled']; ?></span>
                                            </div>
                                            <div class="">
                                                <i class="fas fa-user-slash fa-2x text-gray-300"></i>
                                            </div>
                                        </div>           
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-sm-flex justify-content-between align-items-center mb-4">
                            <h3 class="text-dark mb-0 mb-3 mb-sm-0">User Logs</h3>
                        </div> 
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <!-- <div class="col-md-6 text-nowrap">
                                        <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable">
                                            <label class="form-label">Show&nbsp;</label>
                                            <select class="d-inline-block form-select form-select-sm w-25">
                                                <option value="10" selected="">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>
                                        </div>
                                    </div> -->
                                    <div class="col-md-6">
                                        <div class="text-md-end dataTables_filter" id="dataTable_filter">
                                            <label class="form-label">
                                                <!-- <input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"> -->
                                            </label>                                         
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover table-sm  align-middle user-select-none text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $list_users = mysqli_query($conn,"SELECT * FROM tbl_user where status = 1 ORDER BY is_online DESC");
                                                $rows_count = mysqli_num_rows($list_users);
                                                if ($rows_count > 0):   
                                                    while ($rows_users = mysqli_fetch_array($list_users)):
                                                        if ($rows_users['role'] == 1) {
                                                            $user_role = 'Requestor';
                                                        }
                                                        if ($rows_users['role'] == 2) {
                                                            $user_role = 'Approver';
                                                        }
                                                        if ($rows_users['role'] == 3) {
                                                            $user_role = 'Receiver';
                                                        }
                                                        if ($rows_users['role'] == 4) {
                                                            $user_role = 'Performer';
                                                        }
                                                        if ($rows_users['role'] == 5) {
                                                            $user_role = 'Confirmer';
                                                        }
                                                        if ($rows_users['role'] == 6) {
                                                            $user_role = 'Verifier';
                                                        }
                                                        if ($rows_users['role'] == 'admin') {
                                                            $user_role = 'Administrator';
                                                        }
                                                        if ($rows_users['is_online'] == 1) {
                                                            $user_stat = '<span class="badge roun-pill bg-success">Online</span>';
                                                        }
                                                        if ($rows_users['is_online'] == 0) {
                                                            $user_stat = '<span class="badge roun-pill bg-secondary">Offline</span>';
                                                        }
                                                        
                                            ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex justify-content-start align-items-center gap-3">
                                                        <div><img class="border rounded-circle img-profile" src="assets/img/profile.jpg" width="40" /></div>
                                                        <div><span class="d-block fw-bold"><?=ucwords($rows_users['first_name']); ?>&nbsp;<?=ucwords($rows_users['last_name']); ?></span><span class="d-block"><?=$rows_users['email_add']; ?></span></div>
                                                    </div>
                                                </td>
                                                
                                                <td><span><?=$user_role; ?></span></td>
                                                <td><?=$user_stat; ?></td>
                                                
                                            </tr>        
                                            <?php endwhile; ?>
                                            <?php else: ?>    
                                            <tr>                                                  
                                                <td class="text-center" colspan="9">There is no request  to be showed!🤗</td>';                                                               
                                            </tr>   
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- <div class="row">
                                    <div class="col-md-6 align-self-center">
                                        <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing 1 to 10 of 27</p>
                                    </div>
                                    <div class="col-md-6">
                                        <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                            <ul class="pagination">
                                                <li class="page-item disabled">
                                                    <a class="page-link" href="#" aria-label="Previous">
                                                    <span aria-hidden="true">«</span>
                                                    </a>
                                                </li>
                                                <li class="page-item active">
                                                    <a class="page-link" href="#">1</a>
                                                </li>
                                                <li class="page-item">
                                                    <a class="page-link" href="#">2</a>
                                                </li>
                                                <li class="page-item">
                                                    <a class="page-link" href="#">3</a>
                                                </li>
                                                <li class="page-item">
                                                    <a class="page-link" href="#" aria-label="Next">
                                                    <span aria-hidden="true">»</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div> -->
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
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/theme.js"></script>
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
    </body>
</html>
<?php ob_end_flush(); ?>