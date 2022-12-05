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
        <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.2.0/css/dataTables.dateTime.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
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
                            <h3 class="text-dark mb-0 mb-3 mb-sm-0" id="sp_r">Reports</h3>
                            <div class="d-inline-flex gap-2 mb-3">
                                    <div class="d-block">
                                        <span class="fw-bold">Date From:</span>
                                        <input type="text" class="form-control form-control-sm" id="min" name="min">
                                    </div>
                                    <div class="d-block">
                                        <span class="fw-bold">Date To:</span>
                                        <input type="text"  class="form-control form-control-sm" id="max" name="max">
                                    </div>   
                                </div>
                        </div>
                        <div class="card shadow">
                            <div class="card-body">
                                <div>
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active position-relative" role="tab" data-bs-toggle="tab" href="#tab-1">HCI</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link position-relative" role="tab" data-bs-toggle="tab" href="#tab-2">ADHOC</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link position-relative" role="tab" data-bs-toggle="tab" href="#tab-3">CPS</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link position-relative" role="tab" data-bs-toggle="tab" href="#tab-4">BAAS</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content pt-4">
                                        <div class="tab-pane active" role="tabpanel" id="tab-1">
                                            <div class="table-responsive">
                                                <table class="table table-hover align-middle user-select-none text-nowrap" id="hci_report_datatables">
                                                <thead>
                                                    <tr>
                                                        <th>REQUESTOR_NAME</th>
                                                        <th>DEPARTMENT</th>
                                                        <th>FORM_TYPE</th>
                                                        <th>CONTROL_NUMBER</th>
                                                        <th>HOSTNAME</th>
                                                        <th>CLUSTER</th>
                                                        <th>VCPU</th>
                                                        <th>RAM</th>
                                                        <th>OPERATING_SYSTEM</th>
                                                        <th>OS_VERSION</th>
                                                        <th>OS_ENVIRONMENT</th>
                                                        <th>PARTITION</th>
                                                        <th>IP_ADDRESS</th>
                                                        <th>VLAN</th>
                                                        <th>USERS</th>
                                                        <th>USERS_ROLE</th>
                                                        <th>VM_DEPLOYMENT</th>
                                                        <th>COMMUNICATION</th>
                                                        <th>DISK_GB</th>
                                                        <th>STATUS</th>
                                                        <th>DATE_CREATED</th>
                                                        <th>DATE_VERIFIED</th>      
                                                    </tr>
                                                </thead> 
                                                <tfoot>
                                                        <th>REQUESTOR_NAME</th>
                                                        <th>DEPARTMENT</th>
                                                        <th>FORM_TYPE</th>
                                                </tfoot>      
                                                </table>
                                            </div> 
                                        </div>
                                        <div class="tab-pane" role="tabpanel" id="tab-2">
                                            <div class="table-responsive">
                                                <table class="table table-hover align-middle user-select-none text-nowrap" id="tci_report_datatables">
                                                <thead>
                                                    <tr>
                                                        <th>REQUESTOR_NAME</th>
                                                        <th>DEPARTMENT</th>
                                                        <th>FORM_TYPE</th>
                                                        <th>CONTROL_NUMBER</th>
                                                        <th>HOSTNAME</th>
                                                        <th>LOCATION</th>
                                                        <th>CLUSTER</th>
                                                        <th>SERVICE_REQUEST</th>
                                                        <th>ACTION_TAKEN</th>
                                                        <th>SERVICE_REQUEST_STATUS</th>
                                                        <th>REMARKS</th>
                                                        <th>STATUS</th>
                                                        <th>DATE_CREATED</th>
                                                        <th>DATE_VERIFIED</th>      
                                                    </tr>
                                                </thead> 
                                                <tfoot>
                                                        <th>REQUESTOR_NAME</th>
                                                        <th>DEPARTMENT</th>
                                                        <th>FORM_TYPE</th>
                                                </tfoot>      
                                                </table>
                                            </div> 
                                        </div>
                                        <div class="tab-pane" role="tabpanel" id="tab-3">
                                            <div class="table-responsive">
                                                <table class="table table-hover align-middle user-select-none text-nowrap" id="cps_report_datatables">
                                                <thead>
                                                    <tr>
                                                        <th>REQUESTOR_NAME</th>
                                                        <th>DEPARTMENT</th>
                                                        <th>FORM_TYPE</th>
                                                        <th>CONTROL_NUMBER</th>
                                                        <th>HOSTNAME</th>
                                                        <th>LOCATION</th>
                                                        <th>SYSTEM_NAME</th>
                                                        <th>INSTANCE_NAME</th>
                                                        <th>ENVI_PROFILE</th>        
                                                        <th>PATTERN</th>        
                                                        <th>IP_ADDRESS</th>        
                                                        <th>IP_GROUP</th>        
                                                        <th>VCPU_SIZE</th>        
                                                        <th>RAM</th>        
                                                        <th>USER_REGISTRATION</th>        
                                                        <th>DISK_GB</th>        
                                                        <th>STATUS</th>        
                                                        <th>DATE_CREATED</th>        
                                                        <th>DATE_VERIFIED</th>      
                                                    </tr>
                                                </thead> 
                                                <tfoot>
                                                        <th>REQUESTOR_NAME</th>
                                                        <th>DEPARTMENT</th>
                                                        <th>FORM_TYPE</th>
                                                </tfoot>      
                                                </table>
                                            </div> 
                                        </div>
                                        <div class="tab-pane" role="tabpanel" id="tab-4">
                                            <div class="table-responsive">
                                                <table class="table table-hover align-middle user-select-none text-nowrap" id="baas_report_datatables">
                                                <thead>
                                                    <tr>
                                                        <th>REQUESTOR_NAME</th>
                                                        <th>DEPARTMENT</th>
                                                        <th>FORM_TYPE</th>
                                                        <th>CONTROL_NUMBER</th>
                                                        <th>HOSTNAME</th>
                                                        <th>FORM_FACTOR</th>
                                                        <th>IP_ADDRESS</th>
                                                        <th>OPERATING_SYSTEM</th>
                                                        <th>OS_VERSION</th>        
                                                        <th>DATABASE_TYPE</th>        
                                                        <th>DATABASE_VERSION</th>        
                                                        <th>ACTION_LEVEL</th>        
                                                        <th>NODE_NAME</th>        
                                                        <th>BACKUP_METHOD</th>        
                                                        <th>BACKUP_DIRECTORY</th>        
                                                        <th>SCHEDULE_BACKUP</th>        
                                                        <th>BACKUP_TIME</th>        
                                                        <th>SCHEDULE_ARCHIVED</th>        
                                                        <th>ARCHIVED_TIME</th>      
                                                        <th>RETENTION</th>      
                                                        <th>SCHEDULE_RETENTION</th>      
                                                        <th>SERVER_CONTACT_DETAILS</th>      
                                                        <th>STATUS</th>      
                                                        <th>DATE_CREATED</th>      
                                                        <th>DATE_VERIFIED</th>      
                                                    </tr>
                                                </thead> 
                                                <tfoot>
                                                        <th>REQUESTOR_NAME</th>
                                                        <th>DEPARTMENT</th>
                                                        <th>FORM_TYPE</th>
                                                </tfoot>      
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
                            <span>Copyright © Alapaap | eBizolution 2022 v1.10.11 - DEV</span>
                        </div>
                    </div>
                </footer>
            </div>

        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        
        <!-- Data Tables -->
        <script src="assets/js/jquery.dataTables.min.js"></script>
        <script src="assets/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.colVis.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
        <script src="https://cdn.datatables.net/datetime/1.2.0/js/dataTables.dateTime.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/theme.js"></script>
        <script src="controller/reports/hci-data-tables.js"></script>
        <script src="controller/reports/tci-data-tables.js"></script>
        <script src="controller/reports/cps-data-tables.js"></script>
        <script src="controller/reports/baas-data-tables.js"></script>
    </body>
</html>