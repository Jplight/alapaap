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
        $role_count     = $my_role + 1;
    endwhile;
    
    
    ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Alapaap | Reports</title>
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
                            <h3 class="text-dark mb-0 mb-3 mb-sm-0">Reports</h3>
                        </div>
                        <div class="card shadow">
                            <div class="card-body">
                                <form method="POST" action="makepdf.php">                          
                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle user-select-none text-nowrap" id="report_datatables">
                                            <thead>
                                                <tr>
                                                    <th width="10%">Form Type</th>
                                                    <th width="15%">Control No.</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $num = 1;
                                                    if ($my_role == 1) {
                                                        $sql_reports = "SELECT * FROM `tbl_report_view` where uid = '$uid' ORDER by date_requested DESC";
                                                        $query = mysqli_query($conn,$sql_reports);
                                                    }
                                                  
                                                        while ($rows_reports = mysqli_fetch_array($query)):                        
                                                            $control_number = $rows_reports['control_number'];
                                                            $mydate = strtotime($rows_reports['date_requested']);
                                                            $new_date = date('F d, Y',$mydate);
                                                            $mytime = strtotime($rows_reports['date_requested']);
                                                            $new_time = date('h:i:s A',$mytime);
                                                            echo '<tr>';
                                                            if ($rows_reports['form_type'] == '1') {
                                                                echo '<td>HCI</td>';
                                                                echo '<td>HCI/'.$control_number.'</td>';
                                                                $inc = "hci_new.php";
                                                                $url = "view_hci";
                                                                $print_form = "print_hci.php";
                                                            }
                                                            if ($rows_reports['form_type'] == '1-1') {
                                                                echo '<td>HCI - UPDATE</td>';
                                                                echo '<td>HCI/'.$control_number.'</td>';
                                                                $inc = "hci_update.php";
                                                                $url = "view_hci_update";
                                                                $print_form = "print_hci_up.php";
                                                            }
                                                            if ($rows_reports['form_type'] == '1-2') {
                                                                echo '<td>HCI DELETE</td>';
                                                                echo '<td>HCI/'.$control_number.'</td>';
                                                                $inc = "hci_delete.php";
                                                                $url = "view_hci_delete";
                                                                $print_form = "print_hci_delete.php";
                                                            }
                                                            if ($rows_reports['form_type'] == '2') {
                                                                echo '<td>Adhoc</td>';
                                                                echo '<td>Adhoc/'.$control_number.'</td>';
                                                                $inc = "tci_modal.php";
                                                                $url = "view_tci";
                                                                $print_form = "print_tci.php";
                                                            }
                                                            if ($rows_reports['form_type'] == '3') {
                                                                echo '<td>CPS</td>';
                                                                echo '<td>CPS/'.$control_number.'</td>';
                                                                $inc = "cps_new.php";
                                                                $url = "view_cps";
                                                                $print_form = "print_cps.php";
                                                            }
                                                            if ($rows_reports['form_type'] == '3-1') {
                                                                echo '<td>CPS UPDATE</td>';
                                                                echo '<td>CPS/'.$control_number.'</td>';
                                                                $inc = "cps_update.php";
                                                                $url = "view_cps_update";
                                                                $print_form = "print_cps_up.php";
                                                            }
                                                            if ($rows_reports['form_type'] == '3-2') {
                                                                echo '<td>CPS DELETE</td>';
                                                                echo '<td>CPS/'.$control_number.'</td>';
                                                                $inc = "cps_delete.php";
                                                                $url = "view_cps_delete";
                                                                $print_form = "print_cps_del.php";
                                                            }
                                                            if ($rows_reports['form_type'] == '4') {
                                                                echo '<td>Baas CSRF</td>';
                                                                echo '<td>BaaS/'.$control_number.'</td>';
                                                                $inc = "baas_modal.php";
                                                                $url = "view_baas";
                                                                $print_form = 'print_baas_csrf.php';
                                                            }
                                                            if ($rows_reports['form_type'] == '4-2') {
                                                                echo '<td>Baas CRRF</td>';
                                                                echo '<td>BaaS/'.$control_number.'</td>';
                                                                $inc = "baas_modal_2.php";
                                                                $url = "view_baas_2";
                                                                $print_form = 'print_baas_crrf.php';
                                                            }
                                                            
                                                            echo '<td class="d-flex gap-2"><a class="btn btn-outline-primary btn-sm shadow-sm" href="#'.$url.$rows_reports["control_number"].'" data-bs-toggle="modal" ><i class="fa-fw fas fa-eye me-1"></i>View</a>'
                                                            .'<a class="btn btn-outline-primary btn-sm shadow-sm" href="inc/print/'.$print_form.'?control_number='.$rows_reports["control_number"].'" ><i class="fa-fw fas fa-print me-1"></i>Print</a></td>';
                                                            echo '<td>';
                                                                include "inc/".$inc;
                                                            echo '</td>';
                                                               
                                                            echo '</tr>';
                                                        endwhile; 
                                                                                                              
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </form>
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

        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        
        <!-- Data Tables -->
        <script src="assets/js/jquery.dataTables.min.js"></script>
        <script src="assets/js/dataTables.bootstrap5.min.js"></script>

        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/theme.js"></script>
        <script>
            $(document).ready(function () {
                $('#report_datatables').DataTable({
                    "language": {
                        "emptyTable": "There is no data to be showed!🤗",
                        "zeroRecords": "No data found!🤗"
                    }
                }); 
            });
        </script>
    </body>
</html>