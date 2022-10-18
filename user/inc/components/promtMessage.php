<div class="modal" id="myModal2<?php echo $formt; echo empty($control_number) ? '' : $control_number; ?>" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" >
        <div class="modal-content">
            <div class="modal-body">
                    <h3 class="text-dark text-center fw-bold text-center mt-3 text-wrap dialogContext" id="dialogContext"></h3>
                    <div class="d-flex justify-content-center fw-bold h5 text-uppercase" style="width: 100%;">
                        <?php echo $formt; echo "/"; echo empty($control_number) ? '' : $control_number; ?>
                    </div>
                    <div class="d-flex justify-content-end gap-3 mt-3"> 
                        <button class="btn btn-outline-success btn-lg btnYes" type="submit"  >
                            <i class="fw-fw fas fa-check me-1"></i>
                            Yes
                        </button>
                        <a class="btn btn-outline-secondary btn-lg" data-bs-toggle="modal" >
                            <i class="fw-fw fas fa-close me-1"></i>No
                        </a>
                </div>
            </div>
        </div>
    </div>
</div>