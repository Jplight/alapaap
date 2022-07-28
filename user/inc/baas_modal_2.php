<?php  

if (!empty($control_number)):
    $sql = mysqli_query($conn,"SELECT * FROM `tbl_baas` where control_number = '$control_number' ");
    while ($rows = mysqli_fetch_array($sql)) {
            $get_uid                   = $rows['uid'];
            $control_number            = $rows['control_number'];
            $fullname                  = $rows['fullname'];
            $email_add                 = $rows['email_add'];
            $contact_no                = $rows['contact_no'];
            $crrf_department           = $rows['department'];
            $txt_others                = $rows['txt_others'];
            $crrf_form_factor          = $rows['form_factor'];
            $form_type                 = $rows['form_type'];
            $hostname                  = $rows['hostname'];
            $ip_add                    = $rows['ip_add'];

            $crrf_operating_system     = $rows['os'];
            $crrf_os_version           = $rows['os_version'];

            $crrf_db_version           = $rows['db_version'];
            $crrf_action               = $rows['action'];

            $crrf_backup_method        = $rows['backup_method'];
            $crrf_backup_method_desc   = $rows['backup_method_desc'];

            $crrf_backup_sched         = $rows['backup_sched'];
            $crrf_backup_time          = $rows['backup_time'];
            $crrf_backup_day           = $rows['backup_day'];
            $crrf_retention            = $rows['retention'];
            $server_contact            = $rows['server_contact'];

            $revised            = $rows['revised'];
            $num_revised        = $rows['num_revised'];
            $status             = $rows['status'];
            $date_requested     = $rows['date_requested'];

            $approver           = $rows['approver'];
            $app_status         = $rows['app_status'];
            $appr_date          = $rows['appr_date'];

            $reciever           = $rows['reciever'];
            $rec_status         = $rows['rec_status'];
            $rec_date           = $rows['rec_date'];

            $performer          = $rows['performer'];
            $perf_status        = $rows['perf_status'];
            $perform_date       = $rows['perform_date'];

            $verifier           = $rows['verifier'];
            $ver_status         = $rows['ver_status'];
            $ver_date           = $rows['ver_date']; 

            $verifier_2         = $rows['verifier_2'];
            $ver2_status        = $rows['ver2_status'];
            $ver2_date          = $rows['ver2_date'];

    }
endif;
?>


    <form class="text-dark" method="post" id="frm_baas_2"> 
        <div class="modal fade" role="dialog" tabindex="-1" id="view_baas_2<?php echo empty($control_number) ? '' : $control_number; ?>" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-fullscreen-lg-down" role="document">
                <div class="modal-content">                              
                    <div class="modal-header">
                        <div class="row g-0 d-flex flex-column-reverse flex-lg-row w-100 gap-3 gap-lg-0">
                            <div class="col-md-12 col-lg-6 col-xl-6 offset-lg-1 offset-xl-1">
                                <h4 class="modal-title fw-bold">BACKUP-AS-A-SERVICES</h4>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-3 offset-lg-1 offset-xl-2 d-lg-flex justify-content-lg-end">
                                <img class="img-fluid me-lg-5" src="assets/img/ebiz-logo.png" width="230px" />
                            </div>
                        </div>
                        <button class="btn shadow-none" data-bs-toggle="tooltip" data-bs-placement="bottom" type="button" data-bs-dismiss="modal" title="Close">
                            <i class="fas fa-times fa-2x text-danger"></i>
                        </button>
                    </div>
                    <div class="modal-body user-select-none">
                        <div class="row g-0 d-flex flex-column-reverse flex-lg-row w-100 gap-3 gap-lg-0">
                            <div class="col-md-12 col-lg-5 col-xl-4 offset-lg-1 offset-xl-1">
                                <label class="form-label d-block">Date: <span class="fw-bold"><?php echo empty($date_requested) ? date('F d, Y') : date('F d, Y - h:i A',strtotime($date_requested)); ?></span></label>
                                <label class="form-label d-block">Control No:&nbsp; <span class="fw-bold"><?php echo empty($control_number) ? '' : 'BaaS/'.$control_number; ?></span></label>
                                <input type="hidden" name="txt_control_number" value="<?php echo empty($control_number) ? '' : $control_number; ?>" readonly >
                                <input type="hidden" name="form_type" value="<?php echo empty($form_type) ? '' : $form_type; ?>" readonly>
                                <input type="hidden" name="num_revised" value="<?php echo empty($num_revised) ? '' : $num_revised; ?>" readonly placeholder="Total Revised">
                                <input type="hidden" name="his_role" value="<?php echo empty($my_role) ? '' : $my_role; ?>" readonly>
                                <input type="hidden" name="his_uid" value="<?php echo empty($get_uid) ? '' : $get_uid; ?>" readonly>
                                <input type="hidden" name="form_owner_mail" value="<?php echo empty($email_add) ? '' : $email_add; ?>" readonly>
                            </div>
                        </div>                       
                        <h4 class="text-center fw-bold mt-3 mb-5">Client Restore and Retrieve Point</h4>
                        <div class="row d-flex justify-content-center g-0 mb-2">
                            <div class="col-lg-3">
                                <label class="">Requested By:</label>
                            </div>
                            <div class="col-lg-7">
                                <input type="text" class="form-control" name="fullname" value="<?php echo empty($fullname) ? $my_fullname : ucwords($fullname); ?>" readonly >
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center g-0 mb-2">
                            <div class="col-lg-3">
                                <label class="">Email:</label>
                            </div>
                            <div class="col-lg-7">
                                <input type="email" class="form-control" name="email_add"  value="<?php echo empty($email_add) ? $email : $email_add; ?>" readonly >
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center g-0 mb-2">
                            <div class="col-lg-3">
                                <label class="">Contact No.:</label>
                            </div>
                            <div class="col-lg-7">
                                <input type="text" class="form-control" name="contact_no"  value="<?php echo empty($contact_no) ? '' : $contact_no; ?>" readonly >
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center g-0 mb-2">
                            <div class="col-lg-3">
                                <label class="">Group</label>
                            </div>
                            <div class="col-lg-7">
                                <div class="d-flex justify-content-between">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="crrf_department" id="crrf_chk_ssu" value="ssu" <?php echo empty($crrf_department) ? '' : ($crrf_department == 'ssu' ? 'checked' : ''); ?>  required="required">
                                        <label class="form-check-label" for="crrf_chk_ssu">SSU</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="crrf_department" id="crrf_chk_dau" value="dau" <?php echo empty($crrf_department) ? '' : ($crrf_department == 'dau' ? 'checked' : ''); ?> >
                                        <label class="form-check-label" for="crrf_chk_dau">DAU</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="crrf_department" id="crrf_chk_dcou" value="dcou" <?php echo empty($crrf_department) ? '' : ($crrf_department == 'dcou' ? 'checked' : ''); ?> >
                                        <label class="form-check-label" for="crrf_chk_dcou">Others</label>
                                    </div>

                                    <input class="form-control form-control-sm text-dark <?php echo empty($control_number) ? 'invisible' : ($txt_others != null  ? '' : 'invisible'); ?>" type="text" id="crrf_txt_others" name="crrf_txt_others" value="<?php echo empty($txt_others) ? '' : $txt_others; ?>" >
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center g-0 mb-2">
                            <div class="col-lg-3">
                                <label class="">Form Factor:</label>
                            </div>
                            <div class="col-lg-7">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="crrf_form_factor"  value="physical" <?php echo empty($crrf_form_factor) ? '' : ($crrf_form_factor == 'physical' ? 'checked' : ''); ?> required>
                                    <label class="form-check-label" for="physical">Physical</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="crrf_form_factor" value="aix" <?php echo empty($crrf_form_factor) ? '' : ($crrf_form_factor == 'aix' ? 'checked' : ''); ?> >
                                    <label class="form-check-label" for="aix">AIX on PureApps</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="crrf_form_factor"  value="virtual" <?php echo empty($crrf_form_factor) ? '' : ($crrf_form_factor == 'virtual' ? 'checked' : ''); ?> >
                                    <label class="form-check-label" for="virtual">Virtual</label>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center g-0 mb-2">
                            <div class="col-lg-3">
                                <label class="">Host Name:</label>
                            </div>
                            <div class="col-lg-7">
                                <input type="text" class="form-control text-dark" name="hostname"  value="<?php echo empty($hostname) ? '' : $hostname; ?>" required  onkeypress="return /[0-9A-Z.-_]/i.test(event.key)"> 
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center g-0 mb-2">
                            <div class="col-lg-3">
                                <label class="">IP Address:</label>
                            </div>
                            <div class="col-lg-7">
                                <input type="text" class="mb-2 form-control text-dark" name="ip_add"  value="<?php echo empty($ip_add) ? '' : $ip_add; ?>" required onkeypress="return /[0-9.]/i.test(event.key)"> 
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center g-0 mb-2">
                            <div class="col-lg-3 align-top">
                                <label class="">Operating System:</label>
                            </div>
                            <div class="col-lg-7">
                                <div class="d-block mb-2">
                                    <div class="row">
                                        <div class="col-2">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input crrf_operating_system" type="checkbox" name="crrf_operating_system" id="crrf_os_aix" value="aix" <?php echo empty($crrf_operating_system) ? '' : ($crrf_operating_system == 'aix' ? 'checked' : ''); ?> required>
                                                <label class="form-check-label" for="crrf_os_aix">AIX</label>
                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <select class="form-select form-select-sm w-50" name="crrf_aix_ver" id="crrf_aix_ver" >
                                                <option value="" selected>Version</option>
                                                <option value="7.1" <?php echo empty($crrf_os_version) ? '' : ($crrf_os_version == '7.1' && $crrf_operating_system == 'aix' ? 'selected' : ''); ?> >7.1</option>
                                                <option value="7.2" <?php echo empty($crrf_os_version) ? '' : ($crrf_os_version == '7.2' && $crrf_operating_system == 'aix' ? 'selected' : ''); ?> >7.2</option>
                                            </select>
                                        </div>
                                    </div>         
                                </div>
                                <div class="row mb-2">
                                    <div class="col-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input crrf_operating_system" type="checkbox" name="crrf_operating_system" id="crrf_os_rhel" value="rhel" <?php echo empty($crrf_operating_system) ? '' : ($crrf_operating_system == 'rhel' ? 'checked' : ''); ?> >
                                            <label class="form-check-label" for="crrf_os_rhel">RHEL</label>
                                        </div>    
                                    </div>
                                    <div class="col-10">
                                        <input type="text" class="form-control text-dark form-control-sm w-50" name="crrf_rhel_ver" id="crrf_rhel_ver" value="<?php echo empty($crrf_os_version) ? '' : ($crrf_operating_system == 'rhel' ? $crrf_os_version : ''); ?>" placeholder="Version" >  
                                    </div>
                                </div>
                                <div class="d-block mb-2">
                                    <div class="row">
                                        <div class="col-2">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input crrf_operating_system" type="checkbox" name="crrf_operating_system" id="crrf_os_windows" value="windows" <?php echo empty($crrf_operating_system) ? '' : ($crrf_operating_system == 'windows' ? 'checked' : ''); ?> >
                                                <label class="form-check-label" for="crrf_os_windows">Windows</label>
                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <select class="form-select form-select-sm w-50" name="crrf_windows_ver" id="crrf_windows_ver" >
                                                <option value="" selected>Version</option>
                                                <option value="2012" <?php echo empty($crrf_os_version) ? '' : ($crrf_os_version == '2012' && $crrf_operating_system == 'windows' ? 'selected' : ''); ?> >2012</option>
                                                <option value="2016" <?php echo empty($crrf_os_version) ? '' : ($crrf_os_version == '2016' && $crrf_operating_system == 'windows' ? 'selected' : ''); ?> >2016</option>
                                                <option value="2019" <?php echo empty($crrf_os_version) ? '' : ($crrf_os_version == '2019' && $crrf_operating_system == 'windows' ? 'selected' : ''); ?> >2019</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-2">
                                        <div class="form-check">
                                            <input class="form-check-input crrf_operating_system" type="checkbox" name="crrf_operating_system" id="crrf_os_ios" value="ios" <?php echo empty($crrf_operating_system) ? '' : ($crrf_operating_system == 'ios' ? 'checked' : ''); ?> >
                                            <label class="form-check-label" for="crrf_os_ios">IOS</label>
                                        </div>    
                                    </div>
                                    <div class="col-10">
                                        <input type="text" class="form-control text-dark form-control-sm w-50" name="crrf_ios_ver" id="crrf_ios_ver"  value="<?php echo empty($crrf_os_version) ? '' : ($crrf_operating_system == 'ios' ? $crrf_os_version : ''); ?>" placeholder="Version" >  
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-2">
                                        <div class="form-check">
                                            <input class="form-check-input crrf_operating_system" type="checkbox" name="crrf_operating_system" id="crrf_os_oel" value="oel" <?php echo empty($crrf_operating_system) ? '' : ($crrf_operating_system == 'oel' ? 'checked' : ''); ?> >
                                            <label class="form-check-label" for="crrf_ver_oel">OEL</label>
                                        </div>    
                                    </div>
                                    <div class="col-10">
                                        <input type="text" class="form-control text-dark form-control-sm w-50" name="crrf_oel_ver" id="crrf_oel_ver" value="<?php echo empty($crrf_os_version) ? '' : ($crrf_operating_system == 'oel' ? $crrf_os_version : ''); ?>" placeholder="Version" >  
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center g-0 mb-2">
                            <div class="col-lg-3">
                                <label class="">Action:</label>
                            </div>
                            <div class="col-lg-7">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input crrf_db_action" type="checkbox" name="crrf_act_bmr" id="crrf_act_bmr" value="bmr" <?php echo empty($crrf_action) ? '' : (strpos($crrf_action,"bmr") !== false ? 'checked ' :''); ?> >
                                    <label class="form-check-label" for="crrf_act_bmr">BMR</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input crrf_db_action" type="checkbox" name="crrf_act_file_lvl" id="crrf_chk_file_lvl" value="file_lvl" <?php echo empty($crrf_action) ? '' : (strpos($crrf_action,"file_lvl") !== false ? 'checked ' :''); ?> >
                                    <label class="form-check-label" for="crrf_chk_file_lvl">File-Level</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input crrf_db_action" type="checkbox" name="crrf_act_vm_lvl" id="crrf_chk_vm_lvl" value="vm_lvl" <?php echo empty($crrf_action) ? '' : (strpos($crrf_action,"vm_lvl") !== false ? 'checked ' :''); ?> >
                                    <label class="form-check-label" for="crrf_chk_vm_lvl">VM-Level</label>
                                </div>
                            </div>
                        </div>

                        <div class="row d-flex justify-content-center g-0 mb-2">
                            <div class="col-lg-3">
                                <label class="">Objects to Backup/Archive:</label>
                            </div>
                            <div class="col-lg-7">
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input crrf_backup_archive" type="checkbox" name="crrf_backup_method"  value="whole_drive" <?php echo empty($crrf_backup_method) ? '' : ($crrf_backup_method == 'whole_drive' ? 'checked' : ''); ?>  >
                                        <label class="form-check-label flex-nowrap" >Whole Drive?</label>
                                    </div>
                                    <input type="text" class="form-control text-dark form-control-sm w-50 backup_archive_text" name="crrf_txt_drive" id="crrf_txt_drive" value="<?php echo empty($crrf_backup_method_desc) ? '' : ($crrf_backup_method == 'whole_drive' ? $crrf_backup_method_desc : ''); ?>"  >                                            
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input crrf_backup_archive" type="checkbox"  name="crrf_backup_method" id="crrf_specific_direct" value="specific_drive" <?php echo empty($crrf_backup_method) ? '' : ($crrf_backup_method == 'specific_drive' ? 'checked' : ''); ?> >
                                        <label class="form-check-label" for="crrf_specific_direct">Specific Directory/ies</label>
                                    </div>
                                    <input type="text" class="form-control text-dark form-control-sm w-50 backup_archive_text" name="crrf_txt_specific" id="crrf_txt_specific" value="<?php echo empty($crrf_backup_method_desc) ? '' : ($crrf_backup_method == 'specific_drive' ? $crrf_backup_method_desc : ''); ?>" >                                              
                                </div>
                                <div class="mb-2" id="lalabas" <?php echo empty($control_number) ? 'hidden' : ($crrf_backup_method == 'specific_drive' ? '' : 'hidden'); ?> >
                                    <div class="form-check form-check-inline" >
                                        <input class="form-check-input" type="checkbox"  name="specify_selection" id="crrf_chk_orig" value="original" <?php echo empty($control_number) ? '' : ($crrf_backup_sched == 'original' ? 'checked' : ''); ?> >
                                        <label class="form-check-label" for="crrf_chk_orig">Original</label> 
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox"  name="specify_selection" id="crrf_chk_alter" value="alternative" <?php echo empty($control_number) ? '' : ($crrf_backup_sched == 'alternative' ? 'checked' : ''); ?> >
                                        <label class="form-check-label" for="crrf_chk_alter">Alternative</label>
                                    </div>
                                    <p class="text-warning small" id="orig_warn_text" <?php echo empty($control_number) ? 'hidden' : ($crrf_backup_sched != 'original' ? 'hidden' : ''); ?> >This action will replace the existing file</p>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center g-0 mb-2">
                            <div class="row d-flex justify-content-center g-0 mb-2">
                                <div class="col-lg-3">
                                    <label class="d-block mb-3">Retention/Retrieve Point: (Backup Date):</label>
                                </div>
                                <div class="col-lg-7">
                                    <input type="text" class="form-control text-dark" name="crrf_retention" value="<?php echo empty($crrf_retention) ? '' : $crrf_retention; ?>" >
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center g-0 mb-2">
                            <div class="col-lg-3">
                                <label class="d-block">Destination Host/Server (VM-Level):</label>
                            </div>
                            <div class="col-lg-7">
                                <input type="text" class="form-control text-dark" name="crrf_host_vm_lvl" value="<?php echo empty($crrf_backup_time) ? '' : $crrf_backup_time; ?>" >
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center g-0 mb-2">
                            <div class="col-lg-3">
                                <label class="d-block">Destination Path/Folder (File-Level):</label>
                            </div>
                            <div class="col-lg-7">
                                <input type="text" class="form-control text-dark" name="crrf_path_file_lvl" value="<?php echo empty($crrf_backup_day) ? '' : $crrf_backup_day; ?>" >
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center g-0 mb-2">
                            <div class="col-lg-10">
                                <label class="">Retention: <br>Note: Retention for DBs are <br>managed by it's respective <br>native backup and recovery <br>tools. BaaS is just repository <br>of backed up data. <br></label>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center g-0 mb-5">
                            <div class="col-lg-3">
                                <label class="">Server Admin/email/Contact no.</label>
                            </div>
                            <div class="col-lg-7">
                                <input type="text" class="form-control text-dark" name="server_contact" value="<?php echo empty($server_contact) ? '' : $server_contact; ?>" >
                            </div>
                        </div>
                        <?php
                            include 'components/authority.php';
                        ?>
                    </div>                   
                    <?php if (!empty($control_number)): ?>
                    <div class="modal-footer d-flex justify-content-end">
                        
                        <?php if ($status == 1 && $my_role == 1): ?> <!-- // Draft button -->
                        <div>
                            <button class="btn btn-secondary me-2" type="submit" name="btn_up_baas_crrf" id="btn_up_baas_crrf" ><i class="fa-fw fas fa-refresh me-1"></i>Update</button>
                            <button class="btn btn-primary" type="submit" name="btn_sub_draft_crrf" id="btn_sub_draft_crrf" ><i class="fa-fw fas fa-paper-plane me-1"></i>Resubmit</button>
                        </div>
                        <?php endif; ?>
                        <?php if ($my_role == 1 && $revised == 1): ?>
                        <div>
                            <button class="btn btn-primary" type="submit" name="btn_resub_baas_crrf" id="btn_resub_baas_crrf" ><i class="fa-fw fas fa-paper-plane me-1"></i>Resubmit</button>
                        </div>    
                        <?php endif; ?>
                        <?php if ($status == 0 && $my_role == 1): ?> <!-- // Disapproved  -->
                        <!-- <div>
                            <button class="btn btn-secondary me-2" type="submit" name="btn_save" id="btn_save">Edit</button>
                            <button class="btn btn-primary" type="submit" name="btn_resubmit" id="btn_resubmit">Resubmit</button>  
                        </div> -->
                        <?php endif; ?>
                        <?php if ($my_role == 1 && $status == 2): ?>
                        <div>
                            <button class="btn btn-danger" type="submit" name="btn_cancel_crrf" id="btn_cancel_crrf"><i class="fa-fw fas fa-times me-1"></i>Cancel</button>
                        </div>    
                        <?php endif; ?>
                        <?php if ($status == 2 && $my_role == 2): ?> <!-- // button for Approver -->
                        <div>
                            <button class="btn btn-outline-success me-2" type="submit" name="btn_approver" id="btn_approver" ><i class="fw-fw fas fa-check me-1"></i>Approve</button>      
                            <button class="btn btn-outline-danger" type="submit" name="app_disapproved" id="app_disapproved" ><i class="fa-fw fas fa-times me-1"></i>Disapprove</button> 
                            <button class="btn btn-danger" type="submit" name="approver_returned" id="approver_returned" ><i class="fa-fw fas fa-times me-1"></i>Return to Sender</button>
                        </div>
                        <?php endif; ?>
                        <?php if ($status == 3 && $my_role == 3): ?> <!-- // Button for Reciever -->
                        <div>
                            <button class="btn btn-outline-success me-2" type="submit" name="btn_reciever" id="btn_reciever" ><i class="fa-fw fas fa-check me-1"></i>Acknowledge Receipt</button>      
                            <!-- <button class="btn btn-outline-danger" type="submit" name="rec_disapproved" ><i class="fa-fw fas fa-times me-1"></i>Return to Sender</button>  -->
                        </div>
                        <?php endif; ?>
                        <?php if ($status == 4 && $my_role == 4): ?> <!-- // Button for Performer -->
                        <div>
                            <button class="btn btn-outline-success me-2" type="submit" name="btn_performer" id="btn_performer" ><i class="fa-fw fas fa-check me-1"></i>Request Completed</button>      
                            <!-- <button class="btn btn-outline-danger" type="submit" name="performer_disapproved" ><i class="fa-fw fas fa-times me-1"></i>Return to Sender</button>  -->
                        </div>
                        <?php endif; ?>
                        <?php if ($status == 5 && $my_role == 5): ?> <!-- // Button for Confirmer -->
                        <div>
                            <button class="btn btn-outline-success me-2" type="submit" name="btn_confirmer" id="btn_confirmer" ><i class="fa-fw fas fa-check me-1"></i>Confirm</button>
                        </div>
                        <?php endif; ?>
                        <?php if ($status == 6 && $my_role == 6): ?> <!-- // Button for Verifier -->
                        <div>
                            <button class="btn btn-outline-success me-2" type="submit" name="btn_verifier" id="btn_verifier" ><i class="fa-fw fas fa-check me-1"></i>Verify</button>                                      
                        </div>
                        <?php endif; ?>    
                    </div>
                    <?php endif; ?>
                    <?php if (empty($control_number)): ?>
                    <div class="modal-footer d-flex justify-content-end">
                        <div>
                            <button class="btn btn-secondary" type="submit" name="btn_baas_save_crrf" id="btn_baas_save_crrf" ><i class="fa-fw fas fa-file me-1"></i>Draft</button>
                            <button class="btn btn-primary" type="submit" name="btn_baas_crrf_submit" id="btn_baas_crrf_submit" ><i class="fa-fw fas fa-paper-plane me-1"></i>Submit</button>                                
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </form>