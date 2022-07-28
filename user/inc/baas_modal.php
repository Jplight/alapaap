<?php  

if (!empty($control_number)):
    $sql = mysqli_query($conn,"SELECT * FROM `tbl_baas` where control_number = '$control_number' ");
    while ($rows = mysqli_fetch_array($sql)) {
            $get_uid                   = $rows['uid'];
            $control_number            = $rows['control_number'];
            $fullname                  = $rows['fullname'];
            $email_add                 = $rows['email_add'];
            $contact_no                = $rows['contact_no'];
            $csrf_department           = $rows['department'];
            $txt_others                = $rows['txt_others'];
            $csrf_form_factor          = $rows['form_factor'];
            $form_type                 = $rows['form_type'];
            $hostname                  = $rows['hostname'];
            $ip_add                    = $rows['ip_add'];

            $csrf_operating_system     = $rows['os'];
            $csrf_os_version           = $rows['os_version'];
            $csrf_db_type              = $rows['db_type'];
            $csrf_db_version           = $rows['db_version'];
            $csrf_action               = $rows['action'];
            $csrf_node_name            = $rows['node_name'];
            $csrf_backup_method        = $rows['backup_method'];
            $csrf_backup_method_desc   = $rows['backup_method_desc'];
            $csrf_backup_sched         = $rows['backup_sched'];
            $csrf_backup_time          = $rows['backup_time'];
            $csrf_backup_day           = $rows['backup_day'];
            $csrf_archive_sched        = $rows['archive_sched'];
            $csrf_archive_time         = $rows['archive_time'];
            $csrf_archive_day          = $rows['archive_day'];
            $csrf_retention            = $rows['retention'];
            $csrf_retention_sched      = $rows['retention_sched'];

            $server_contact     = $rows['server_contact'];

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


    <form class="text-dark" method="post" id="frm_baas_1"> 
        <div class="modal fade" role="dialog" tabindex="-1" id="view_baas<?php echo empty($control_number) ? '' : $control_number; ?>" data-bs-backdrop="static" data-bs-keyboard="false">
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
                        <h4 class="text-center fw-bold mt-3 mb-5">Client Server Registration Form</h4>
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
                                        <input class="form-check-input" type="checkbox" name="csrf_department" value="ssu" <?php echo empty($csrf_department) ? '' : ($csrf_department == 'ssu' ? 'checked' : ''); ?>  required="required">
                                        <label class="form-check-label" for="chk_ssu">SSU</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="csrf_department" value="dau" <?php echo empty($csrf_department) ? '' : ($csrf_department == 'dau' ? 'checked' : ''); ?> >
                                        <label class="form-check-label" for="chk_dau">DAU</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="csrf_department" id="csrf_chk_dcou" value="dcou" <?php echo empty($csrf_department) ? '' : ($csrf_department == 'dcou' ? 'checked' : ''); ?> >
                                        <label class="form-check-label" for="csrf_chk_dcou">Others</label>
                                    </div>

                                    <input class="form-control form-control-sm text-dark <?php echo empty($control_number) ? 'invisible' : ($txt_others != null  ? '' : 'invisible'); ?>" type="text" id="csrf_txt_others" name="txt_others" value="<?php echo empty($txt_others) ? '' : $txt_others; ?>" >
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center g-0 mb-2">
                            <div class="col-lg-3">
                                <label class="">Form Factor:</label>
                            </div>
                            <div class="col-lg-7">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="csrf_form_factor"  value="physical" <?php echo empty($csrf_form_factor) ? '' : ($csrf_form_factor == 'physical' ? 'checked' : ''); ?> required>
                                    <label class="form-check-label" for="physical">Physical</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="csrf_form_factor" value="aix" <?php echo empty($csrf_form_factor) ? '' : ($csrf_form_factor == 'aix' ? 'checked' : ''); ?> >
                                    <label class="form-check-label" for="aix">AIX on PureApps</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="csrf_form_factor"  value="virtual" <?php echo empty($csrf_form_factor) ? '' : ($csrf_form_factor == 'virtual' ? 'checked' : ''); ?> >
                                    <label class="form-check-label" for="virtual">Virtual</label>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center g-0 mb-2">
                            <div class="col-lg-3">
                                <label class="">Host Name:</label>
                            </div>
                            <div class="col-lg-7">
                                <input type="text" class="form-control text-dark" name="hostname"  value="<?php echo empty($hostname) ? '' : $hostname; ?>" required onkeypress="return /[0-9A-Z.-_]/i.test(event.key)" > 
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center g-0 mb-2">
                            <div class="col-lg-3">
                                <label class="">IP Address:</label>
                            </div>
                            <div class="col-lg-7">
                                <input type="text" class="mb-2 form-control text-dark" name="ip_add"  value="<?php echo empty($ip_add) ? '' : $ip_add; ?>" maxlength="15" required onkeypress="return /[0-9.]/i.test(event.key)"> 
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
                                                <input class="form-check-input csrf_operating_system" type="checkbox" name="csrf_operating_system" id="csrf_os_aix" value="aix" <?php echo empty($csrf_operating_system) ? '' : ($csrf_operating_system == 'aix' ? 'checked' : ''); ?> required>
                                                <label class="form-check-label" for="csrf_os_aix">AIX</label>
                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <select class="form-select form-select-sm w-50" name="csrf_aix_ver" id="csrf_aix_ver" disabled>
                                                <option value="" selected>Version</option>
                                                <option value="7.1" <?php echo empty($csrf_os_version) ? '' : ($csrf_os_version == '7.1' && $csrf_operating_system == 'aix' ? 'selected' : ''); ?> >7.1</option>
                                                <option value="7.2" <?php echo empty($csrf_os_version) ? '' : ($csrf_os_version == '7.2' && $csrf_operating_system == 'aix' ? 'selected' : ''); ?> >7.2</option>
                                            </select>
                                        </div>
                                    </div>         
                                </div>
                                <div class="row mb-2">
                                    <div class="col-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input csrf_operating_system" type="checkbox" name="csrf_operating_system" id="csrf_os_rhel" value="rhel" <?php echo empty($csrf_operating_system) ? '' : ($csrf_operating_system == 'rhel' ? 'checked' : ''); ?> >
                                            <label class="form-check-label" for="csrf_os_rhel">RHEL</label>
                                        </div>    
                                    </div>
                                    <div class="col-10">
                                        <input type="text" class="form-control text-dark form-control-sm w-50" name="csrf_rhel_ver" id="csrf_ver_rhel" value="<?php echo empty($csrf_os_version) ? '' : ($csrf_operating_system == 'rhel' ? $csrf_os_version : ''); ?>" placeholder="Version" disabled >  
                                    </div>
                                </div>
                                <div class="d-block mb-2">
                                    <div class="row">
                                        <div class="col-2">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input csrf_operating_system" type="checkbox" name="csrf_operating_system" id="csrf_os_windows" value="windows" <?php echo empty($csrf_operating_system) ? '' : ($csrf_operating_system == 'windows' ? 'checked' : ''); ?> >
                                                <label class="form-check-label" for="csrf_os_windows">Windows</label>
                                            </div>
                                        </div>
                                        <div class="col-10">
                                            <select class="form-select form-select-sm w-50" name="csrf_windows_ver" id="csrf_windows_ver" disabled>
                                                <option value="" selected>Version</option>
                                                <option value="2012" <?php echo empty($csrf_os_version) ? '' : ($csrf_os_version == '2012' && $csrf_operating_system == 'windows' ? 'selected' : ''); ?> >2012</option>
                                                <option value="2016" <?php echo empty($csrf_os_version) ? '' : ($csrf_os_version == '2016' && $csrf_operating_system == 'windows' ? 'selected' : ''); ?> >2016</option>
                                                <option value="2019" <?php echo empty($csrf_os_version) ? '' : ($csrf_os_version == '2019' && $csrf_operating_system == 'windows' ? 'selected' : ''); ?> >2019</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-2">
                                        <div class="form-check">
                                            <input class="form-check-input csrf_operating_system" type="checkbox" name="csrf_operating_system" id="csrf_os_ios" value="ios" <?php echo empty($csrf_operating_system) ? '' : ($csrf_operating_system == 'ios' ? 'checked' : ''); ?> >
                                            <label class="form-check-label" for="csrf_os_ios">IOS</label>
                                        </div>    
                                    </div>
                                    <div class="col-10">
                                        <input type="text" class="form-control text-dark form-control-sm w-50" name="csrf_ios_ver" id="csrf_ios_ver"  value="<?php echo empty($csrf_os_version) ? '' : ($csrf_operating_system == 'ios' ? $csrf_os_version : ''); ?>" placeholder="Version" disabled >  
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-2">
                                        <div class="form-check">
                                            <input class="form-check-input csrf_operating_system" type="checkbox" name="csrf_operating_system" id="csrf_os_oel" value="oel" <?php echo empty($csrf_operating_system) ? '' : ($csrf_operating_system == 'oel' ? 'checked' : ''); ?> >
                                            <label class="form-check-label" for="csrf_os_oel">OEL</label>
                                        </div>    
                                    </div>
                                    <div class="col-10">
                                        <input type="text" class="form-control text-dark form-control-sm w-50" name="csrf_oel_ver" id="csrf_ver_oel" value="<?php echo empty($csrf_os_version) ? '' : ($csrf_operating_system == 'oel' ? $csrf_os_version : ''); ?>" placeholder="Version" disabled >  
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center g-0 mb-2">
                            <div class="col-lg-3">
                                <label class="">Application (fill up if applicable):</label>
                            </div>
                            <div class="col-lg-7">
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input csrf_db_type" type="checkbox" name="csrf_db_type" id="csrf_db_db2" value="db2" <?php echo empty($csrf_db_type) ? '' : ($csrf_db_type == 'db2' ? 'checked' : ''); ?> >
                                        <label class="form-check-label" for="csrf_db_db2">DB2 UDB version&nbsp;</label>
                                    </div>
                                    <input type="text" class="form-control text-dark form-control-sm w-50 csrf_db_version" name="csrf_db2_ver" id="csrf_db2_ver" value="<?php echo empty($csrf_db_version) ? '' : ($csrf_db_type == 'db2' ? $csrf_db_version : ''); ?>" disabled >
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input csrf_db_type" type="checkbox" name="csrf_db_type" id="csrf_db_oracle" value="oracle" <?php echo empty($csrf_db_type) ? '' : ($csrf_db_type == 'oracle' ? 'checked' : ''); ?> >
                                        <label class="form-check-label" for="csrf_db_oracle">Oracle version</label>
                                    </div>
                                    <input type="text" class="form-control text-dark form-control-sm w-50 csrf_db_version" name="csrf_oracle_ver" id="csrf_oracle_ver" value="<?php echo empty($csrf_db_version) ? '' : ($csrf_db_type == 'oracle' ? $csrf_db_version : ''); ?>" disabled >
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input csrf_db_type" type="checkbox" name="csrf_db_type" id="csrf_db_mssql" value="ms_sql" <?php echo empty($csrf_db_type) ? '' : ($csrf_db_type == 'ms_sql' ? 'checked' : ''); ?> >
                                        <label class="form-check-label" for="csrf_db_mssql">MS SQL Server version</label>
                                    </div>
                                    <input type="text" class="form-control text-dark form-control-sm w-50 csrf_db_version" name="csrf_mssql_ver" id="csrf_mssql_ver" value="<?php echo empty($csrf_db_version) ? '' : ($csrf_db_type == 'ms_sql' ? $csrf_db_version : ''); ?>" disabled >
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input csrf_db_type" type="checkbox" name="csrf_db_type" id="csrf_db_others" value="others" <?php echo empty($csrf_db_type) ? '' : ($csrf_db_type == 'others' ? 'checked' : ''); ?> >
                                        <label class="form-check-label" for="csrf_db_others">Others</label>
                                    </div>
                                    <input type="text" class="form-control text-dark form-control-sm w-50 csrf_db_version" name="csrf_others_ver" id="csrf_others_ver" value="<?php echo empty($csrf_db_version) ? '' : ($csrf_db_type == 'others' ? $csrf_db_version : ''); ?>" disabled >
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center g-0 mb-2">
                            <div class="col-lg-3">
                                <label class="">Action:</label>
                            </div>
                            <div class="col-lg-7">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input db_action b_a" type="checkbox" name="csrf_act_backup" id="formCheck-4" value="backup" <?php echo empty($csrf_action) ? '' : (strpos($csrf_action,"backup") !== false ? 'checked ' :''); ?>  >
                                    <label class="form-check-label" for="formCheck-4">Backup</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input db_action b_a" type="checkbox" name="csrf_act_archive" id="formCheck-5" value="archive" <?php echo empty($csrf_action) ? '' : (strpos($csrf_action,"archive") !== false ? 'checked ' :''); ?>  >
                                    <label class="form-check-label" for="formCheck-5">Archive</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input db_action" type="checkbox" name="csrf_act_bmr" id="formCheck-6" value="bmr" <?php echo empty($csrf_action) ? '' : (strpos($csrf_action,"bmr") !== false ? 'checked ' :''); ?>  >
                                    <label class="form-check-label" for="formCheck-6">BMR</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input action_lvl" type="checkbox" name="csrf_act_file_lvl" id="csrf_chk_file_lvl" value="file_lvl" <?php echo empty($csrf_action) ? '' : (strpos($csrf_action,"file_lvl") !== false ? 'checked ' :''); ?>  >
                                    <label class="form-check-label" for="csrf_chk_file_lvl">File-Level</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input action_lvl" type="checkbox" name="csrf_act_vm_lvl" id="csrf_chk_vm_lvl" value="vm_lvl" <?php echo empty($csrf_action) ? '' : (strpos($csrf_action,"vm_lvl") !== false ? 'checked ' :''); ?>  >
                                    <label class="form-check-label" for="csrf_chk_vm_lvl">VM-Level</label>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center g-0 mb-2">
                            <div class="col-lg-3">
                                <!-- <label class="">File-Level Backup Purpose:</label> -->
                            </div>
                            <div class="col-lg-7">
                                <div class="d-block my-2">
                                    <div class="row">
                                        <div class="col-4">Node Name:</div>
                                        <div class="col-8">
                                            <input type="text" class="form-control text-dark form-control-sm" name="csrf_node_name" value="<?php echo empty($csrf_node_name) ? '' : $csrf_node_name; ?>" >
                                        </div>
                                    </div>
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
                                        <input class="form-check-input csrf_backup_archive" type="checkbox" name="csrf_backup_method"  value="directory" <?php echo empty($csrf_backup_method) ? '' : ($csrf_backup_method == 'directory' ? 'checked' : ''); ?>   >
                                        <label class="form-check-label flex-nowrap" >Directory</label>
                                    </div>
                                    <input type="text" class="form-control text-dark form-control-sm w-50 backup_archive_text" name="csrf_txt_directory" id="csrf_txt_directory" value="<?php echo empty($csrf_backup_method_desc) ? '' : ($csrf_backup_method == 'directory' ? $csrf_backup_method_desc : ''); ?>"  >                                            
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input csrf_backup_archive" type="checkbox" name="csrf_backup_method"  value="whole_drive" <?php echo empty($csrf_backup_method) ? '' : ($csrf_backup_method == 'whole_drive' ? 'checked' : ''); ?>   >
                                        <label class="form-check-label flex-nowrap" >File Name</label>
                                    </div>
                                    <input type="text" class="form-control text-dark form-control-sm w-50 backup_archive_text" name="csrf_txt_drive" id="csrf_txt_drive" value="<?php echo empty($csrf_backup_method_desc) ? '' : ($csrf_backup_method == 'whole_drive' ? $csrf_backup_method_desc : ''); ?>"  >                                            
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input csrf_backup_archive" type="checkbox"  name="csrf_backup_method" id="rad_arc_2" value="specific_drive" <?php echo empty($csrf_backup_method) ? '' : ($csrf_backup_method == 'specific_drive' ? 'checked' : ''); ?>  >
                                        <label class="form-check-label" for="rad_arc_2">Drive</label>
                                    </div>
                                    <input type="text" class="form-control text-dark form-control-sm w-50 backup_archive_text" name="csrf_txt_specific" id="csrf_txt_specific" value="<?php echo empty($csrf_backup_method_desc) ? '' : ($csrf_backup_method == 'specific_drive' ? $csrf_backup_method_desc : ''); ?>"  >                                              
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center align-items-start g-0 mb-2">
                            <div class="col-lg-3">
                                <label class="">Schedule:</label>
                            </div>
                            <div class="col-lg-7">
                                <label class="">Backup:</label>
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input csrf_sched_backup" type="checkbox" name="csrf_backup_sched" id="rad_daily" value="daily" <?php echo empty($csrf_backup_sched) ? '' : ($csrf_backup_sched == 'daily' ? 'checked' : ''); ?> >
                                        <label class="form-check-label" for="rad_daily">Daily</label>
                                    </div>
                                    <input type="text" class="form-control text-dark form-control-sm w-50" name="csrf_txt_daily" id="csrf_txt_daily" value="<?php echo empty($csrf_backup_time) ? '' : ($csrf_backup_sched == 'daily' ? $csrf_backup_time : ''); ?>" placeholder="Time: 00:00HH"  >                                        
                                </div>
                                <div class="d-flex justify-content-between mb-4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input csrf_sched_backup" type="checkbox" name="csrf_backup_sched" id="rad_weekly" value="weekly" <?php echo empty($csrf_backup_sched) ? '' : ($csrf_backup_sched == 'weekly' ? 'checked' : ''); ?> >
                                        <label class="form-check-label" for="rad_weekly">Weekly</label>
                                    </div>
                                    <div class="input-group w-50">
                                        <input type="text" class="form-control text-dark form-control-sm " name="csrf_txt_weekly" id="csrf_txt_weekly" placeholder="Day of the week" value="<?php echo empty($csrf_backup_day) ? '' : ($csrf_backup_sched == 'weekly' ? $csrf_backup_day : ''); ?>"  >
                                        <input type="text" class="form-control text-dark form-control-sm " name="csrf_weekly_time" id="csrf_weekly_time" value="<?php echo empty($csrf_backup_time) ? '' : ($csrf_backup_sched == 'weekly' ? $csrf_backup_time : ''); ?>" placeholder="Time"  >
                                    </div>                                        
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input csrf_sched_backup" type="checkbox" name="csrf_backup_sched" id="csrf_backup_monthly" value="monthly" <?php echo empty($csrf_backup_sched) ? '' : ($csrf_backup_sched == 'monthly' ? 'checked' : ''); ?> >
                                        <label class="form-check-label" for="csrf_backup_monthly">Monthly</label>
                                    </div>
                                    <div class="input-group w-50">
                                        <input type="text" class="form-control text-dark form-control-sm" name="csrf_month_of" id="csrf_month_of" value="<?php echo empty($csrf_backup_day) ? '' : ($csrf_backup_sched == 'monthly' ? $csrf_backup_day : ''); ?>" placeholder="Month of:"  >
                                        <input type="text" class="form-control text-dark form-control-sm" name="csrf_monthly_time" id="csrf_monthly_time" value="<?php echo empty($csrf_backup_time) ? '' : ($csrf_backup_sched == 'monthly' ? $csrf_backup_time : ''); ?>" placeholder="Time" >  
                                    </div>                                        
                                </div>
                                <label class="">Archive:</label>
                                <div class="d-flex justify-content-between mb-4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input " type="checkbox" name="csrf_archive_sched" id="chk_archive" value="monthly_archive" <?php echo empty($csrf_archive_sched) ? '' : ($csrf_archive_sched == 'monthly_archive' ? 'checked' : ''); ?> >
                                        <label class="form-check-label" for="chk_archive">Frequency</label>
                                    </div>
                                    <div class="input-group w-50">
                                        <input type="text" class="form-control text-dark form-control-sm" name="csrf_archive_day" id="csrf_archive_day" value="<?php echo empty($csrf_archive_day) ? '' : ($csrf_archive_sched == 'monthly_archive' ? $csrf_archive_day : ''); ?>" placeholder="Every 1st of the month:"   >
                                        <input type="text" class="form-control text-dark form-control-sm" name="csrf_archive_time" id="csrf_archive_time"  value="<?php echo empty($csrf_archive_time) ? '' : ($csrf_archive_sched == 'monthly_archive' ? $csrf_archive_time : ''); ?>" placeholder="Time"  >
                                    </div>                                                        
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center g-0 mb-2">
                            <div class="col-lg-3">
                                <label class="">Retention: <br>Note: Retention for DBs are <br>managed by it's respective <br>native backup and recovery <br>tools. BaaS is just repository <br>of backed up data. <br></label>
                            </div>
                            <div class="col-lg-7">
                                <div class="d-flex justify-content-between mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input csrf_retention" type="checkbox" name="csrf_retention" id="rad_retention" value="backup_days" <?php echo empty($csrf_retention) ? '' : ($csrf_retention == 'backup_days' ? 'checked' : ''); ?> >
                                        <label class="form-check-label" for="rad_retention">Backup (In Days)</label>
                                    </div>
                                    <input type="text" class="form-control text-dark form-control-sm w-50" name="csrf_retent_days" id="csrf_retent_days" value="<?php echo empty($csrf_retention_sched) ? '' : ($csrf_retention == 'backup_days' ? $csrf_retention_sched : ''); ?>" placeholder="No. of days"  >
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="form-check">    
                                        <input class="form-check-input csrf_retention" type="checkbox" name="csrf_retention" id="rad_retention_2" value="backup_years" <?php echo empty($csrf_retention) ? '' : ($csrf_retention == 'backup_years' ? 'checked' : ''); ?> >
                                        <label class="form-check-label" for="rad_retention_2">Archived (In Years)</label>
                                    </div>
                                    <input type="text" class="form-control text-dark form-control-sm w-50" name="csrf_retent_years" id="csrf_retent_years" value="<?php echo empty($csrf_retention_sched) ? '' : ($csrf_retention == 'backup_years' ? $csrf_retention_sched : ''); ?>" placeholder="No. of years" >
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center g-0 mb-5">
                            <div class="col-lg-3">
                                <label class="">Server Admin/email/Contact no.</label>
                            </div>
                            <div class="col-lg-7">
                                <input type="text" class="form-control text-dark" name="server_contact"  value="<?php echo empty($server_contact) ? '' : $server_contact; ?>" >
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
                            <button class="btn btn-secondary me-2" type="submit" name="btn_up_baas_csrf" id="btn_up_baas_csrf" ><i class="fa-fw fas fa-refresh me-1"></i>Update</button>
                            <button class="btn btn-primary" type="submit" name="btn_sub_draft_csrf" id="btn_sub_draft_csrf" ><i class="fa-fw fas fa-paper-plane me-1"></i>Resubmit</button>
                        </div>
                        <?php endif; ?>
                        <?php if ($my_role == 1 && $revised == 1): ?>
                        <div>
                            <button class="btn btn-primary" type="submit" name="btn_resub_baas_csrf" id="btn_resub_baas_csrf" ><i class="fa-fw fas fa-paper-plane me-1"></i>Resubmit</button>
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
                            <button class="btn btn-danger" type="submit" name="btn_cancel_csrf" id="btn_cancel_csrf"><i class="fa-fw fas fa-times me-1"></i>Cancel</button>
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
                            <button class="btn btn-secondary" type="submit" name="btn_baas_save_csrf" id="btn_baas_save_csrf" ><i class="fa-fw fas fa-file me-1"></i>Draft</button>
                            <button class="btn btn-primary" type="submit" name="btn_baas_csrf_submit" id="btn_baas_csrf_submit" ><i class="fa-fw fas fa-paper-plane me-1"></i>Submit</button>                                
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </form>