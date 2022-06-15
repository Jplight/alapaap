<?php  
    session_start();
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
        $role_count     = $my_role + 1;
    endwhile;
    
    
    ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Alapaap | Activity Logs</title>
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
                            <h3 class="text-dark mb-0 mb-3 mb-sm-0">Activity Logs</h3>
                        </div>
                        <div class="card shadow">
                            <div class="card-body">
                                <form method="POST" action="makepdf.php">                          
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
                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle user-select-none text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Form Type</th>
                                                    <th>Control No.</th>
                                                    <th>Status</th>
                                                    <th>Time Stamp</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php            
                                                    $sql_reports = "SELECT * FROM `tbl_activity_logs` where uid = '$uid' ORDER by date_requested DESC";
                                                    $query = mysqli_query($conn,$sql_reports);
                                                    $count = mysqli_num_rows($query);
                                                    if ($count > 0):   
                                                        while ($rows_reports = mysqli_fetch_array($query)):  
                                                            if($rows_reports['status'] >= '2' && $rows_reports['status'] <= '3' ){
                                                                $stat = 'has been inserted';
                                                            } 
                                                            if($rows_reports['status'] == '1' ){
                                                                $stat = 'has been save as draft';
                                                            }
                                                            if($rows_reports['status'] == '0' ){
                                                                $stat = 'has been canceled';
                                                            }
                                                            if($rows_reports['form_type'] == '1'){
                                                                $form_type = 'HCI';
                                                            }
                                                            if($rows_reports['form_type'] == '1-1'){
                                                                $form_type = 'HCI Update';
                                                            }
                                                            if($rows_reports['form_type'] == '1-2'){
                                                                $form_type = 'HCI Delete';
                                                            }
                                                            if($rows_reports['form_type'] == '2'){
                                                                $form_type = 'Adhoc';
                                                            }
                                                            if($rows_reports['form_type'] == '3'){
                                                                $form_type = 'CPS';
                                                            }
                                                            if($rows_reports['form_type'] == '3-1'){
                                                                $form_type = 'CPS Update';
                                                            }
                                                            if($rows_reports['form_type'] == '3-2'){
                                                                $form_type = 'CPS Delete';
                                                            }
                                                            if($rows_reports['form_type'] == '4'){
                                                                $form_type = 'BaaS CSRF';
                                                            }
                                                            if($rows_reports['form_type'] == '4-2'){
                                                                $form_type = 'BaaS CRRF';
                                                            }
                                                            echo '<tr>';
                                                            echo '<td>'.$form_type.'</td>';
                                                            echo '<td>'.$rows_reports['control_number'].'</td>';
                                                            echo '<td>'.$stat.'</td>';  
                                                            echo '<td>'.$rows_reports['date_requested'].'</td>';   
                                                            echo '</tr>';
                                                        endwhile; 
                                                    else:
                                                        echo '<tr>';                                                   
                                                        echo '<td class="text-center" colspan="7">There is no data to be showed!🤗</td>';                                                               
                                                        echo '</tr>';
                                                    endif; 
                                                ?>

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
                                    </div>         -->
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
        <script src="assets/js/jquery-3.6.0.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/theme.js"></script>
    </body>
</html>