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
                                <form method="POST">  
    
                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle user-select-none text-nowrap" id="report_datatables">
                                            <thead>
                                                <tr>
                                                    <th>Form Type</th>
                                                    <th>Control No.</th>
                                                    <th>HostName</th>
                                                    <th>Department</th>
                                                    <th>Date Created</th>
                                                    <th>Date Accomplished</th>
                                                    <th>Status</th>
                                                    <th>Action</th>  
                                                    <th hidden></th>
                                                    <th hidden></th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Form Type</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                               
                                                <?php
                                                    $num = 1;
                                                    if ($my_role == 1) {
                                                        $sql_reports = "SELECT * FROM `tbl_report_raw_verified` where uid = '$uid' ORDER by DATE_VERIFIED DESC";
                                                        $query = mysqli_query($conn,$sql_reports);
                                                    }
                                                        while ($rows_reports = mysqli_fetch_array($query)):                        
                                                            $control_number = $rows_reports['CONTROL_NUMBER'];
                                                           
                                                            $new_date = date('F d, Y',strtotime($rows_reports['DATE_VERIFIED']));
                                                           
                                                            $new_time = date('h:i:s A',strtotime($rows_reports['DATE_VERIFIED']));
                                                            echo '<tr>';
                                                            echo "<td>".$rows_reports['FORM_TYPE']."</td>";
                                                            if ($rows_reports['FORM_TYPE'] == 'HCI_NEW') {
                                                                echo '<td>HCI/'.$control_number.'</td>';
                                                                $inc = "hci_new.php";
                                                                $url = "view_hci";
                                                                $print_form = "print_hci.php";
                                                            }
                                                            if ($rows_reports['FORM_TYPE'] == 'HCI_UPDATE') {
                                                                
                                                                echo '<td>HCI/'.$control_number.'</td>';
                                                                $inc = "hci_update.php";
                                                                $url = "view_hci_update";
                                                                $print_form = "print_hci_up.php";
                                                            }
                                                            if ($rows_reports['FORM_TYPE'] == 'HCI_DELETE') {
                                                         
                                                                echo '<td>HCI/'.$control_number.'</td>';
                                                                $inc = "hci_delete.php";
                                                                $url = "view_hci_delete";
                                                                $print_form = "print_hci_delete.php";
                                                            }
                                                            if ($rows_reports['FORM_TYPE'] == 'HCI_CLONE') {
                                                                
                                                                echo '<td>HCI/'.$control_number.'</td>';
                                                                $inc = "hci_cloning.php";
                                                                $url = "view_hci_clone";
                                                                $print_form = "print_hci_clone.php";
                                                            }
                                                            if ($rows_reports['FORM_TYPE'] == 'ADHOC') {
                                                                echo '<td>ADHOC/'.$control_number.'</td>';
                                                            
                                                                $inc = "tci_modal.php";
                                                                $url = "view_tci";
                                                                $print_form = "print_tci.php";
                                                            }
                                                            if ($rows_reports['FORM_TYPE'] == 'CPS_NEW') {
                                                                echo '<td>CPS/'.$control_number.'</td>';
                                                                $inc = "cps_new.php";
                                                                $url = "view_cps";
                                                                $print_form = "print_cps.php";
                                                            }
                                                            if ($rows_reports['FORM_TYPE'] == 'CPS_UPDATE') {
                                                                
                                                                echo '<td>CPS/'.$control_number.'</td>';
                                                                $inc = "cps_update.php";
                                                                $url = "view_cps_update";
                                                                $print_form = "print_cps_up.php";
                                                            }
                                                            if ($rows_reports['FORM_TYPE'] == 'CPS_DELETE') {
                                                               
                                                                echo '<td>CPS/'.$control_number.'</td>';
                                                                $inc = "cps_delete.php";
                                                                $url = "view_cps_delete";
                                                                $print_form = "print_cps_del.php";
                                                            }
                                                            if ($rows_reports['FORM_TYPE'] == 'BAAS_CSRF') {
                                                                echo '<td>BAAS/'.$control_number.'</td>';
                                                                $inc = "baas_modal.php";
                                                                $url = "view_baas";
                                                                $print_form = 'print_baas_csrf.php';
                                                            }
                                                            if ($rows_reports['FORM_TYPE'] == 'BAAS_CRRF') {
                                                               
                                                                echo '<td>BAAS-'.$control_number.'</td>';
                                                                $inc = "baas_modal_2.php";
                                                                $url = "view_baas_2";
                                                                $print_form = 'print_baas_crrf.php';
                                                            }
                                                            
                                                            if (empty($rows_reports['HOSTNAME'])){
                                                                echo "<td>-------------</td>";
                                                            }else{
                                                                echo "<td>".$rows_reports['HOSTNAME']."</td>";
                                                            }
                                                            echo "<td>".$rows_reports['DEPARTMENT']."</td>";
                                                            
                                                            
                                                            echo '<td>'.$rows_reports['DATE_CREATED'].'</td>';
                                                            
                                                            echo '<td>'.$rows_reports['DATE_VERIFIED'].'</td>';
                                                            echo "<td>".$rows_reports['STATUS']."</td>";
                                                            echo '<td class="d-flex gap-2"><a class="btn btn-outline-primary btn-sm shadow-sm" href="#'.$url.$rows_reports["CONTROL_NUMBER"].'" data-bs-toggle="modal" ><i class="fa-fw fas fa-eye me-1"></i>View</a>'
                                                            .'<a class="btn btn-outline-primary btn-sm shadow-sm" href="inc/print/'.$print_form.'?control_number='.$rows_reports["CONTROL_NUMBER"].'" ><i class="fa-fw fas fa-print me-1"></i>Print</a></td>';
                                                            echo '<td>';
                                                                include "inc/".$inc;
                                                            echo '</td>';
                                                            echo "<td hidden>".date('Y-m-d',strtotime($rows_reports['DATE_CREATED']))."</td>"; // HIDDEN, THIS WILL USED TO SEARCH DATA BY DATA RANGE
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
                            <span>Copyright © Alapaap | eBizolution 2022 v1.11.9 - BSP</span>
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
        <script>
            $(document).ready(function () {
                let today = new Date().toLocaleString().bold()

                let minDate, maxDate;
 
                // Custom filtering function which will search data in column four between two values
                $.fn.dataTable.ext.search.push(
                    function( settings, data, dataIndex ) {
                        let min = minDate.val();
                        let max = maxDate.val();
                        let date = new Date( data[9] );
                
                        if (
                            ( min === null && max === null ) ||
                            ( min === null && date <= max ) ||
                            ( min <= date   && max === null ) ||
                            ( min <= date   && date <= max )
                        ) {
                            return true;
                        }
                        return false;
                    }
                );
                // Create date inputs
                minDate = new DateTime($('#min'), {
                    format: 'YYYY-MM-DD'
                });
                maxDate = new DateTime($('#max'), {
                    format: 'YYYY-MM-DD'
                });


                let table =  $('#report_datatables').DataTable({
                    "language": {
                        "emptyTable": "There is no data to be showed!🤗",
                        "zeroRecords": "No data found!🤗"
                    },
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            extend: 'excelHtml5',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4,5,6,8 ]
                            },
                            messageTop: 'Reported By: '+ $("#my_fullname").html() + "<br> Date Printed: " + today
                        },
                        {
                            extend: 'pdfHtml5',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4,5,6 ]
                            },
                            messageTop: 'Reported By: '+ $("#my_fullname").html().bold() + "<br> Date Printed: " + today
                        },
                        {
                            extend: 'print',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4,5,6,8 ]
                            },
                            messageTop: 'Reported By: '+ $("#my_fullname").html().bold() + "<br> Date Printed: " + today
                            
                        },
                        {
                            extend: "colvis",
                            text: "Filter By"
                        }                     
                    ],
                    initComplete: function () {          
                        this.api()
                            .columns(0) // remove number 2 to display all dropdown
                            .every(function () {
                                var column = this;
                                var select = $('<select class="form-select form-select-sm"><option value="">All</option></select>')
                                    .appendTo($(column.footer()).empty())
                                    .on('change', function () {
                                        var val = $.fn.dataTable.util.escapeRegex($(this).val());
            
                                        column.search(val ? '^' + val + '$' : '', true, false).draw();
                                    });
            
                                column
                                    .data()
                                    .unique()
                                    .sort()
                                    .each(function (d, j) {
                                        select.append('<option value="' + d + '">' + d + '</option>');
                                    });
                            });
                    }
                }); 

                $('#min, #max').on('change', function () {
                    table.draw();
                });

            });
        </script>
    </body>
</html>