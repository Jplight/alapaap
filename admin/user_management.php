<?php  
    session_start();
    ob_start();
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

    include 'model/new_user_model.php';
    // include 'model/ureset_acc.php';
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
                        <div class="d-sm-flex justify-content-between align-items-between mb-4">
                            <h3 class="text-dark mb-0 mb-3 mb-sm-0">
                                User Management
                            </h3>
                            <button class="btn btn-primary btn-sm" type="button" data-bs-target="#new_user" data-bs-toggle="modal"><i class="fa-fw fa fa-plus " ></i>New User</button>
                        </div>
                        <div class="card shadow">
                            <div class="card-body">
                            <?php echo (!empty($user_alert)) ? $user_alert : ''; ?>
                                <div class="table-responsive pt-4">
                                    <table class="table table-hover align-middle user-select-none text-nowrap" id="user_datatables">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                                <th>Date Added</th>
                                                <th>Added By</th>
                                                <th>Action</th>
                                              
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            <?php
                                             
                                                $num = 1;
                                                $list_users = mysqli_query($conn,"SELECT * FROM tbl_user ORDER BY date_created DESC");
                                                 
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
                                                        if($rows_users['status'] == 0){
                                                            $action = '<a class="btn btn-outline-primary btn-sm shadow-none" data-bs-target="#view_uacc'.$rows_users['uid'].'" data-bs-toggle="modal" ><i class="fa-fw fas fa-eye me-1"></i>View</a>';
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
                                                            echo '<td>'.ucfirst($rows_users['created_by']).'</td>';
                                                            echo '<td>';
                                                            echo $action;
                                                            // echo '<a class="btn btn-outline-danger btn-sm shadow-none me-2"  data-bs-target="#reset_user'.$rows_users['uid'].'" data-bs-toggle="modal" ><i class="fa-fw fas fa-user-edit me-1"></i>Reset</a>';
                                                                require 'inc/view_uaccount.php';
                                                                require 'inc/ureset_acc.php';
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
            <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i> </a>

            <!-- Modal -->

        </div>
        <?php
            require 'inc/new_user.php';
        ?>
        <script src="assets/js/jquery-3.6.0.js"></script>
        
        <!-- Datatables -->
        <script src="assets/js/jquery.dataTables.min.js"></script>
        <script src="assets/js/dataTables.bootstrap5.min.js"></script>

        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/theme.js"></script>
        <script>
            $(document).ready(function(){
                $('#user_datatables').DataTable({
                   
                    pageLength: 5,
                    lengthMenu: [5, 10, 20, 50, 100, 200, 500],
                    "language": {
                        "emptyTable": "There is no data to be showed!🤗",
                        "zeroRecords": "No data found!🤗"
                    }
                });
                $("button[data-bs-dismiss=modal]").click(function(){
                    $("form").trigger('reset');
                    $('input[rel="gp"]').each(function() {
                        $(this).val(randString($(this)));
                    });
                });
                // $("button[data-bs-toggle='modal']").click(function(){
                //     $("form").trigger('reset');
                // });
                setInterval(function(){
                    $("#alert").slideUp();
                },3000);
                // $("#chk_app, #chk_rec, #chk_per").click(function(){
                //     var chk_app = $("#chk_app").is(":checked");
                //     var chk_rec = $("#chk_rec").is(":checked");
                //     var chk_per = $("#chk_per").is(":checked");
                //     $("#new_role").val('');
                //     if (chk_app) {            
                //         $("#new_role").val('2');
                //     }
                //     if (chk_rec) {            
                //         $("#new_role").val('3');
                //     }
                //     if (chk_per) {            
                //         $("#new_role").val('4');
                //     }
                //     if (chk_app && chk_rec) {
                //         $("#new_role").val('23');
                //     }
                //     if (chk_app && chk_per) {
                //         $("#new_role").val('24');
                //     }
                //     if (chk_rec && chk_per) {
                //         $("#new_role").val('34');
                //     }
                //     if (chk_app && chk_rec && chk_per) {
                //         $("#new_role").val('234');
                //     }
                // });

            // Generate a password string
            function randString(id) {
                var dataSet = $(id).attr('data-character-set').split(',');
                var possible = '';
                if ($.inArray('a-z', dataSet) >= 0) {
                    possible += 'abcdefghijklmnopqrstuvwxyz';
                }
                if ($.inArray('A-Z', dataSet) >= 0) {
                    possible += 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                }
                if ($.inArray('0-9', dataSet) >= 0) {
                    possible += '0123456789';
                }
                if ($.inArray('#', dataSet) >= 0) {
                    possible += '![]{}()%&*$#^<>~@|';
                }
                var text = '';
                for (var i = 0; i < $(id).attr('data-size'); i++) {
                    text += possible.charAt(Math.floor(Math.random() * possible.length));
                }
                return text;
            }
            // Create a new password on page load
            $('input[rel="gp"]').each(function() {
                $(this).val(randString($(this)));
            });
            // Create a new password
            $(".getNewPass").click(function() {
                var field = $(this).closest('div').find('input[rel="gp"]');
                field.val(randString(field));
            });
            // Auto Select Pass On Focus
            $('input[rel="gp"]').on("click", function() {
                $(this).select();
            });


            });
        </script>

    </body>
</html>
<?php ob_end_flush(); ?>