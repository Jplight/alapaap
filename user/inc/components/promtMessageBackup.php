<div>edcel</div>


<?php 

    if ($my_role == 1) {                  
        $hci_query = mysqli_query($conn,"SELECT * FROM tbl_hci where uid = '$uid' and status BETWEEN 2 and 6 ORDER BY date_requested DESC ");
    }else{
        $hci_query = mysqli_query($conn,"SELECT * FROM tbl_hci where status = '$my_role'  ORDER BY date_requested DESC ");
    }

    while ($rows_hci = mysqli_fetch_array($hci_query)): 
    $control_number = $rows_hci['control_number'];
    $formt = "hci";
?>

<div class="modal" id="myModal2<?php echo $formt; echo empty($control_number) ? '' : $control_number; ?>" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" >
        <div class="modal-content">
            <div class="modal-body">
                    <h3 class="text-dark text-center fw-bold text-center mt-3 text-wrap dialogContext" id="dialogContext"></h3>
                    <div><?php echo $formt; echo empty($control_number) ? '' : $control_number; ?></div>
                    <div class="d-flex justify-content-center gap-3 mt-3">
                    <a class="btn btn-outline-danger" data-bs-toggle="modal" ><i class="fw-fw fas fa-close me-1"></i>No</a>
                    <button class="btn btn-outline-success btnYes me-2" type="submit"  ><i class="fw-fw fas fa-check me-1"></i>Yes</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php endwhile; ?>




<?php 

    if ($my_role == 1) {
        $tci_query = mysqli_query($conn,"SELECT * FROM tbl_tci where uid = '$uid' and status BETWEEN 2 and 6  ORDER BY date_requested DESC ");
    }else{
        $tci_query = mysqli_query($conn,"SELECT * FROM tbl_tci where status = '$my_role'  ORDER BY date_requested DESC ");
    }

    while ($rows_tci = mysqli_fetch_array($tci_query)):
    $control_number = $rows_tci['control_number'];
    $formt = "Adhoc";
?>

<div class="modal" id="myModal2<?php echo $formt; echo empty($control_number) ? '' : $control_number; ?>" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" >
    <div class="modal-content">
        <div class="modal-body">
                <h3 class="text-dark text-center fw-bold text-center mt-3 text-wrap dialogContext" id="dialogContext"></h3>
                <div><?php echo $formt; echo empty($control_number) ? '' : $control_number; ?></div>
                <div class="d-flex justify-content-center gap-3 mt-3">
                <a class="btn btn-outline-danger" data-bs-toggle="modal" ><i class="fw-fw fas fa-close me-1"></i>No</a>
                <button class="btn btn-outline-success btnYes me-2" type="submit"  ><i class="fw-fw fas fa-check me-1"></i>Yes</button>
            </div>
        </div>
    </div>
    </div>
</div>

<?php endwhile; ?>










<?php 

    if ($my_role == 1) {
        $tci_query = mysqli_query($conn,"SELECT * FROM tbl_tci where uid = '$uid' and status BETWEEN 2 and 6  ORDER BY date_requested DESC ");
    }else{
        $tci_query = mysqli_query($conn,"SELECT * FROM tbl_tci where status = '$my_role'  ORDER BY date_requested DESC ");
    }

    while ($rows_tci = mysqli_fetch_array($tci_query)):
    $control_number = $rows_tci['control_number'];
    $formt = "Adhoc";
?>

<div class="modal" id="myModal2<?php echo $formt; echo empty($control_number) ? '' : $control_number; ?>" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" >
    <div class="modal-content">
        <div class="modal-body">
                <h3 class="text-dark text-center fw-bold text-center mt-3 text-wrap dialogContext" id="dialogContext"></h3>
                <div><?php echo $formt; echo empty($control_number) ? '' : $control_number; ?></div>
                <div class="d-flex justify-content-center gap-3 mt-3">
                <a class="btn btn-outline-danger" data-bs-toggle="modal" ><i class="fw-fw fas fa-close me-1"></i>No</a>
                <button class="btn btn-outline-success btnYes me-2" type="submit"  ><i class="fw-fw fas fa-check me-1"></i>Yes</button>
            </div>
        </div>
    </div>
    </div>
</div>

<?php endwhile; ?>