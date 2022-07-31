<?php  
session_start();
date_default_timezone_set('Asia/Manila');

include '../model/connection.php';
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
endwhile;

require 'model/update_role.php';

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Alapaap | User's Privilage</title>
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
                    <!-- User role table Pending Request -->
                    <div class="container-fluid mb-5">
                        <div class="d-sm-flex justify-content-between align-items-center mb-4">
                            <h3 class="text-dark mb-0 mb-3 mb-sm-0">User's Role</h3>
                        </div>
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover user-select-none align-middle text-nowrap" id="urequest_role">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email Address</th>
                                                <th>Date Requested</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $sql_new_req = mysqli_query($conn,"SELECT * FROM tbl_req_role where status = '0' ORDER BY date_created DESC ");
                                               
                                                    while ($rows_users = mysqli_fetch_array($sql_new_req)):
                                                        $users_id = $rows_users['uid'];
                                                        $his_id = $rows_users['his_id'];

                                                        $mydate = strtotime($rows_users['date_created']);
                                                        $new_date = date('F d, Y',$mydate);
                                                        $mytime = strtotime($rows_users['date_created']);
                                                        $new_time = date('h:i:s A',$mytime);
                                                        $fullname = ucwords($rows_users['fullname']);
                                                        $multi_role = $rows_users['requested_role'];                    
                                                        echo '<tr>';
                                                        echo '<td>'.$fullname.'</td>';
                                                        echo '<td>'.$rows_users['email_add'].'</td>';
                                                        echo '<td>'.$new_date.' - '.$new_time.'</td>';
                                                        if ($rows_users['role'] == 1) {
                                                            echo '<td>Requestor</td>';
                                                        }
                                                        if ($rows_users['role'] == 2) {
                                                            echo '<td>Approver</td>';
                                                        }
                                                        if ($rows_users['role'] == 3) {
                                                            echo '<td>Receiver</td>';
                                                        }
                                                        if ($rows_users['role'] == 4) {
                                                            echo '<td>Performer</td>';
                                                        }
                                                        if ($rows_users['role'] == 5) {
                                                            echo '<td>Confirmer</td>';
                                                        }
                                                        if ($rows_users['role'] == 6) {
                                                            echo '<td>Verifier</td>';
                                                        }

                                                        echo '<td><span class="badge rounded-pill bg-secondary">Pending</span></td>';
                                                        echo '<td>'.
                                                                '<a class="btn btn-primary btn-sm shadow-sm me-2" href="#view_req'.$users_id.'" data-bs-toggle="modal" ><i class="fa-fw fas fa-eye me-1"></i>View</a></td>';
                                                        echo '<td>';
                                                        include 'inc/req_rol_modal.php';
                                                        echo '</td>';
                                                        echo '</tr>';
                                                        
                                                    endwhile;
                                             
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- User role table Pending Request -->

                    <!-- Recent Approved Users table -->
                    <div class="container-fluid">
                        <div class="d-sm-flex justify-content-between align-items-center mb-4">
                            <h3 class="text-dark mb-0 mb-3 mb-sm-0">Recent Activity</h3>
                        </div>
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover user-select-none align-middle text-nowrap" id="urecent_act">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email Address</th>
                                                <th>Date Modified</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $sql_new_req = mysqli_query($conn,"SELECT * FROM tbl_req_role where status = '1' ORDER BY date_created DESC");
                                                  
                                                    while ($rows_users = mysqli_fetch_array($sql_new_req)):  
                                                        $users_id =  $rows_users['uid'];
                                                        $mydate = strtotime($rows_users['date_created']);
                                                        $new_date = date('F d, Y',$mydate);
                                                        $mytime = strtotime($rows_users['date_created']);
                                                        $new_time = date('h:i:s A',$mytime);                    
                                                        echo '<tr>';
                                                        echo '<td>'.ucwords($rows_users['fullname']).'</td>';
                                                        echo '<td>'.$rows_users['email_add'].'</td>';
                                                        echo '<td>'.$new_date.' - '.$new_time.'</td>';
                                                        if ($rows_users['role'] == 1) {
                                                          
                                                            $primary = 'Requestor';
                                                        }
                                                        if ($rows_users['role'] == 2) {
                                                        
                                                            $primary = 'Approver';
                                                        }
                                                        if ($rows_users['role'] == 3) {

                                                            $primary = 'Receiver';
                                                        }
                                                        if ($rows_users['role'] == 4) {

                                                            $primary = 'Performer';
                                                        }
                                                        if ($rows_users['role'] == 5) {
                                                            $primary = 'Confirmer';
                                                        }
                                                        if ($rows_users['role'] == 6) {
                                                            echo '<td>Verifier</td>';
                                                            $primary = 'Verifier';
                                                        }
                                                        echo '<td>'.$primary.'</td>';
                                                        if ($rows_users['status'] == 1) {
                                                            echo '<td><span class="badge rounded-pill bg-success">Approved</span></td>';
                                                        }
                                                        if ($rows_users['status'] == 2) {
                                                            echo '<td><span class="badge rounded-pill bg-danger">Rejected</span></td>';
                                                        }
                                                        echo '<td><a class="btn btn-light btn-sm shadow-sm me-2" data-bs-target="#view_r'.$users_id.'" data-bs-toggle="modal" ><i class="fa-fw fas fa-eye me-1"></i>View</a></td>';
                                                        echo '<td>';
                                                            include 'inc/view_urole.php';
                                                        echo '</td>';
                                                        echo '</tr>';
                                                    endwhile;
                                             
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Recent Approved Users table -->

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

        <!-- Datatables -->
        <script src="assets/js/jquery.dataTables.min.js"></script>
        <script src="assets/js/dataTables.bootstrap5.min.js"></script>        

        <script src="assets/js/theme.js"></script>
        <script>
            $('#urequest_role, #urecent_act').DataTable({
                
                pageLength: 5,
                lengthMenu: [5, 10, 20, 50],
                "language": {
                    "emptyTable": "There is no data to be showed!🤗",
                    "zeroRecords": "No data found!🤗"
                }
            });
        </script>
    </body>
</html>