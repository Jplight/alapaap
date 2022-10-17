<div class="modal" id="myModal2<?php echo empty($control_number) ? '' : $control_number; ?>" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" >
    <div class="modal-content">
        <div class="modal-body">
                <h3 class="text-dark text-center fw-bold text-center mt-3 text-wrap" id="dialogContext"></h3>
                <div class="d-flex justify-content-center gap-3 mt-3">
                <a class="btn btn-outline-danger" data-bs-toggle="modal" ><i class="fw-fw fas fa-close me-1"></i>No</a>
                <button class="btn btn-outline-success btnYes me-2" type="submit"  ><i class="fw-fw fas fa-check me-1"></i>Yes</button>
            </div>
        </div>
    </div>
    </div>
</div>