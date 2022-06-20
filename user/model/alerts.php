<?php
    
session_start();
include 'connection.php';

if (isset($_SESSION['control_number']) && isset($_SESSION['form_type']) ):
    $control_number = $_SESSION['control_number'];
    $form_type = $_SESSION['form_type'];

    if ($form_type == '1'){
        $form_type = "HCI NEW";
    }
    if ($form_type == '1-1'){
        $form_type = "HCI UPDATE";
    }
    if ($form_type == '1-2'){
        $form_type = "HCI DELETE";
    }

    if ($form_type == '2'){
        $form_type = "Adhoc";
    }
    if ($form_type == '3'){
        $form_type = "CPS NEW";
    }
    if ($form_type == '3-1'){
        $form_type = "CPS UPDATE";
    }
    if ($form_type == '3-2'){
        $form_type = "CPS DELETE";
    }    
    if ($form_type == '4') {
        $form_type = "BaaS CSRF";
    }
    if ($form_type == '4-2') {
        $form_type = "BaaS CRRF";
    }
    $sql = "SELECT control_number from tbl_hci where control_number = '$control_number'"
            ."UNION ALL SELECT control_number from tbl_tci where control_number = '$control_number'"
            . "UNION ALL SELECT control_number from tbl_cps where control_number = '$control_number'"
            ."UNION ALL SELECT control_number from tbl_baas where control_number = '$control_number' ";

    $sql_notif = mysqli_query($conn,$sql);
    $count_notif = mysqli_num_rows($sql_notif);
    if ($count_notif > 0 ) {
        
        echo '<div class="position-relative">
        <div class="toast-container position-absolute top-0 end-0 p-3 " style="z-index:1500;">
            <div class="toast shadow-lg" role="alert" id="success_alert">
                <div class="toast-header bg-success text-white">
                    <span class="text-uppercase">Success</span>
                    <button type="button" class="btn btn-close ms-auto" data-bs-dismiss="toast"></button>
                </div>
                <div class="toast-body bg-white rounded-bottom d-flex justify-content-between">
                    <span><i class="fa-fw fas fa-check fa-lg text-success"></i></span>
                    <span>The <b>'.$form_type.' Form</b> with <b>Control No. '.$control_number.'</b> has been '.$_SESSION['message'].'</span>
                </div>
            </div>
        </div>
    </div>';

    }
    unset($_SESSION['message']);
    unset($_SESSION['form_type']);
    unset($_SESSION['control_number']);
endif;

        
    
?>