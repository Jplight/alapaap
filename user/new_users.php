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

$sql = mysqli_query($conn,"SELECT * FROM tbl_user where uid = '$uid'  ");
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
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Alapaap | New Accounts</title>
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

                    <div class="container-fluid mb-5">
                        <div class="d-sm-flex justify-content-between align-items-center mb-4">
                            <h3 class="text-dark mb-0 mb-3 mb-sm-0">Pending Account</h3>
                        </div>
                        <?php echo (!empty($_SESSION['message'])) ? $alert : ''; ?>
                
                        <div class="card shadow">
                            <div class="card-body">                          
                                <div class="table-responsive pt-4">
                                    <table class="table table-hover align-middle user-select-none text-nowrap" id="user_datatables">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                                <th>Date Added</th>
                                                <th>Action</th>
                                              
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                             
                                                $num = 1;
                                                $list_users = mysqli_query($conn,"SELECT * FROM tbl_user where status = '0' ORDER BY date_created DESC");
                                                 
                                                    while ($rows_users = mysqli_fetch_array($list_users)): 
                                                        $Requestor = (strpos($rows_users['role'],'1') !== false) ? 'Requestor ' : '';
                                                        $Approver = (strpos($rows_users['role'],'2') !== false) ? 'Approver ' : '';
                                                        $Receiver = (strpos($rows_users['role'],'3') !== false) ? 'Receiver ' : '';
                                                        $Performer = (strpos($rows_users['role'],'4') !== false) ? 'Performer ' : '';
                                                        $Confirmer = (strpos($rows_users['role'],'5') !== false) ? 'Confirmer ' : '';
                                                        $Verifier = (strpos($rows_users['role'],'6') !== false) ? 'Verifier' : '';
                                                       
                                                        if($rows_users['image'] != null){
                                                            $image = "../user/".$rows_users['image'];
                                                        }else{
                                                            $image = 'assets/img/profile.jpg';
                                                        }

                                                        $multi_role = $Requestor.$Approver.$Receiver.$Performer.$Confirmer.$Verifier;
                                                        if($rows_users['status'] == 1 ){
                                                            $stat = '<span class="badge rounded-pill bg-success">Active</span>';
                                                        }
                                                        if($rows_users['status'] == 2 ){
                                                            $stat = '<span class="badge rounded-pill bg-secondary">Disabled</span>';
                                                        }
                                                        if($rows_users['status'] == 0 ){
                                                            $stat = '<span class="badge rounded-pill bg-danger">Inactive</span>';
                                                        }

                                                        if($rows_users['status'] == 1){
                                                            $action = '<a class="btn btn-outline-secondary btn-sm shadow-none" href="model/udisabled_model.php?uid='.$rows_users['uid'].'&email='.$rows_users['email_add'].'&stat=1" ><i class="fa-fw fas fa-user-slash me-1"></i>Disable</a>';
                                                        }
                                                        if($rows_users['status'] == 2){
                                                            $action = '<a class="btn btn-outline-success btn-sm shadow-none" href="model/udisabled_model.php?uid='.$rows_users['uid'].'&email='.$rows_users['email_add'].'&stat=2" ><i class="fa-fw fas fa-user-check me-1"></i>Enable</a>';
                                                            
                                                        }
                                                       
                                                        echo '<tr>';
                                                            echo '<td>'; 
                                                                echo '<div class="d-flex justify-content-start align-items-center gap-3">'; 
                                                                    echo '<div><img class="border rounded-circle img-profile"  src="../user/'.$image.'" width="40"  /></div>';
                                                                    echo '<div><span class="d-block fw-bold">'.ucwords($rows_users['first_name']).'&nbsp;'.ucwords($rows_users['last_name']).'</span><span class="d-block">'.$rows_users['email_add'].'</span></div>';
                                                                echo '</div>';
                                                            echo '</td>';                                                          
                                                            echo '<td><span>'.$multi_role.'</span></td>';
                                                            echo '<th>'.$stat.'</th>';
                                                            echo '<td>'.$rows_users['date_created'].'</td>';
                                                           
                                                            echo '<td >';
                                                                echo '<a class="btn btn-outline-success btn-sm shadow-none me-2" data-bs-target="#new_account'.$rows_users['uid'].'" data-bs-toggle="modal" ><i class="fa-fw fas fa-user-check me-1"></i>Approve</a>';
                                                                echo '<a class="btn btn-outline-danger btn-sm shadow-none" data-bs-target="#remove_account'.$rows_users['uid'].'" data-bs-toggle="modal" ><i class="fa-fw fas fa-user-times me-1"></i>Diapprove</a>';
                                                                require 'inc/new_user_account.php';
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
                    <div class="container-fluid">
                        <div class="d-sm-flex justify-content-between align-items-between mb-4">
                            <h3 class="text-dark mb-0 mb-3 mb-sm-0">
                                Disapproved Account
                            </h3>
                            
                        </div>
                        <div class="card shadow">
                            <div class="card-body">                          
                                <div class="table-responsive pt-4">
                                    <table class="table table-hover align-middle user-select-none text-nowrap" id="user_datatables_disapproved">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                                <th>Date Added</th>
                                                <th>Action</th>                                            
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                             
                                                $num = 1;
                                                $list_users = mysqli_query($conn,"SELECT * FROM tbl_user where status = '3' ORDER BY date_created DESC");
                                                 
                                                    while ($rows_users = mysqli_fetch_array($list_users)): 
                                                        $Requestor = (strpos($rows_users['role'],'1') !== false) ? 'Requestor ' : '';
                                                        $Approver = (strpos($rows_users['role'],'2') !== false) ? 'Approver ' : '';
                                                        $Receiver = (strpos($rows_users['role'],'3') !== false) ? 'Receiver ' : '';
                                                        $Performer = (strpos($rows_users['role'],'4') !== false) ? 'Performer ' : '';
                                                        $Confirmer = (strpos($rows_users['role'],'5') !== false) ? 'Confirmer ' : '';
                                                        $Verifier = (strpos($rows_users['role'],'6') !== false) ? 'Verifier' : '';
                                                       
                                                        if($rows_users['image'] != null){
                                                            $image = "../user/".$rows_users['image'];
                                                        }else{
                                                            $image = 'assets/img/profile.jpg';
                                                        }

                                                        $multi_role = $Requestor.$Approver.$Receiver.$Performer.$Confirmer.$Verifier;
                                                        
                                                        if($rows_users['status'] == 3 ){
                                                            $stat = '<span class="badge rounded-pill bg-danger">Disapproved</span>';
                                                        }

                                                        if($rows_users['status'] == 1){
                                                            $action = '<a class="btn btn-outline-secondary btn-sm shadow-none" href="model/udisabled_model.php?uid='.$rows_users['uid'].'&email='.$rows_users['email_add'].'&stat=1" ><i class="fa-fw fas fa-user-slash me-1"></i>Disable</a>';
                                                        }
                                                        if($rows_users['status'] == 2){
                                                            $action = '<a class="btn btn-outline-success btn-sm shadow-none" href="model/udisabled_model.php?uid='.$rows_users['uid'].'&email='.$rows_users['email_add'].'&stat=2" ><i class="fa-fw fas fa-user-check me-1"></i>Enable</a>';
                                                            
                                                        }
                                                       
                                                        echo '<tr>';
                                                            echo '<td>'; 
                                                                echo '<div class="d-flex justify-content-start align-items-center gap-3">'; 
                                                                    echo '<div><img class="border rounded-circle img-profile"  src="../user/'.$image.'" width="40"  /></div>';
                                                                    echo '<div><span class="d-block fw-bold">'.ucwords($rows_users['first_name']).'&nbsp;'.ucwords($rows_users['last_name']).'</span><span class="d-block">'.$rows_users['email_add'].'</span></div>';
                                                                echo '</div>';
                                                            echo '</td>';                                                          
                                                            echo '<td><span>'.$multi_role.'</span></td>';
                                                            echo '<th>'.$stat.'</th>';
                                                            echo '<td>'.$rows_users['date_created'].'</td>';
                                                           
                                                            echo '<td >';
                                                                echo '<a class="btn btn-outline-success btn-sm shadow-none me-2" data-bs-target="#new_account'.$rows_users['uid'].'" data-bs-toggle="modal" ><i class="fa-fw fas fa-user-check me-1"></i>Approve</a>';
                                                                echo '<a class="btn btn-outline-danger btn-sm shadow-none" data-bs-target="#remove_account'.$rows_users['uid'].'" data-bs-toggle="modal" ><i class="fa-fw fas fa-user-times me-1"></i>Diapprove</a>';
                                                                require 'inc/new_user_account.php';
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
        <script>
            $(document).ready(function(){
                $('#user_datatables, #user_datatables_disapproved').DataTable({
                   
                    pageLength: 5,
                    lengthMenu: [5, 10, 20, 50, 100, 200, 500],
                    "language": {
                        "emptyTable": "There is no data to be showed!🤗",
                        "zeroRecords": "No data found!🤗"
                    }
                });
                $("button[data-bs-dismiss=modal]").click(function(){
                    $("form").trigger('reset');
                });
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