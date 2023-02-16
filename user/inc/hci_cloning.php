<?php  
if (!empty($control_number)):
    $tbl_hci = mysqli_query($conn,"SELECT * FROM `tbl_hci` where control_number = '$control_number' ");
    while ($rows = mysqli_fetch_array($tbl_hci)) {
        $get_uid            = $rows['uid'];
        $control_number     = $rows['control_number'];
        $form_type          = $rows['form_type'];
        $fullname           = $rows['fullname'];
        $email_add          = $rows['email_add'];
        $contact_no         = $rows['contact_no'];
        $department         = $rows['department'];
        $location           = $rows['location'];
        $cluster            = $rows['cluster'];

        $hostname           = $rows['hostname'];
        $vcpu               = $rows['vcpu'];
        $vcpu_comment       = $rows['vcpu_comment'];
        $ram                = $rows['ram'];
        $ram_comment        = $rows['ram_comment'];
        
        $os                 = $rows['os'];
        $os_comment         = $rows['os_comment'];

        $txt_os_descript    = $rows['txt_os_descript'];
        $txt_define_parti   = $rows['txt_define_parti'];

        $ip_comment         = $rows['ip_comment'];
        $vlan_comment       = $rows['vlan_comment'];

        $ip_add_vlan        = $rows['ip_add_vlan'];
        $txt_ip_vlan        = $rows['txt_ip_vlan'];
        $hci_users          = $rows['hci_users'];
        $txt_hci_users      = $rows['txt_hci_users'];
        $vm_deployment      = $rows['vm_deployment'];
        $vm_deployment_comment = $rows['vm_deployment_comment'];
        $comm                  = $rows['comm'];
        $comm_comment          = $rows['comm_comment'];
        

        $status             = $rows['status'];
        $date_requested     = $rows['date_requested'];
        $revised            = $rows['revised'];
        $num_revised        = $rows['num_revised'];

        $approver_id        = $rows['approver_id'];
        $approver           = $rows['approver'];
        $app_status         = $rows['app_status'];
        $appr_date          = $rows['appr_date'];

        $reciever_id        = $rows['reciever_id'];
        $reciever           = $rows['reciever'];
        $rec_status         = $rows['rec_status'];
        $rec_date           = $rows['rec_date'];

        $performer_id       = $rows['performer_id'];
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
<form method="post" autocomplete="off" id="form_clone" name="form_clone" action="" enctype="multipart/form-data">
    <div id="view_hci_clone<?php echo empty($control_number) ? '' : $control_number; ?>" class="modal myModal" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-xl modal-fullscreen-xl-down" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row g-0 d-flex flex-column-reverse flex-lg-row w-100 gap-3 gap-lg-0">
                        <div class="col-md-12 col-lg-5 col-xl-4 offset-lg-1 offset-xl-1">
                            <h4 class="modal-title fw-bold text-nowrap">BSP HCI REQUEST FORM (CLONE)</h4>
                        </div>
                        <div class="col-md-12 col-lg-5 col-xl-5 offset-lg-1 offset-xl-2 d-lg-flex justify-content-lg-end">
                            <img class="img-fluid me-lg-5" src="assets/img/ebiz-logo.png" width="230px" />
                        </div>
                    </div>
                    <button class="btn shadow-none" data-bs-toggle="tooltip" data-bs-placement="bottom" type="button" data-bs-dismiss="modal" title="Close">
                        <i class="fas fa-times fa-2x text-danger"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row g-0 d-flex flex-column-reverse flex-lg-row w-100 gap-3 gap-lg-0">
                        <div class="col-md-12 col-lg-5 col-xl-4 offset-lg-1 offset-xl-1">
                            <label class="form-label d-block">Date Requested: <span class="fw-bold"><?php echo empty($date_requested) ? date('F d, Y') : date('F d, Y - h:i A',strtotime($date_requested)); ?></span></label>
                            <label class="form-label d-block">Control No:&nbsp; <span class="fw-bold"><?php echo empty($control_number) ? '' : 'HCI/'.$control_number; ?></span></label>
                            <input type="hidden" name="txt_control_number" value="<?php echo empty($control_number) ? '' : $control_number; ?>" readonly >
                            <input type="hidden" name="contact_no" value="<?php echo empty($contact_no) ? '' : $contact_no; ?>" readonly>
                            <input type="hidden" name="email_add" value="<?php echo empty($email) ? '' : $email; ?>" readonly>
                            <input type="hidden" name="form_owner_mail" value="<?php echo empty($email_add) ? '' : $email_add; ?>" readonly>
                            <input type="hidden" name="form_type" value="<?php echo empty($form_type) ? '' : $form_type; ?>" readonly>
                            <input type="hidden" name="num_revised" value="<?php echo empty($num_revised) ? '' : $num_revised; ?>" readonly placeholder="Total Revised">
                            <input type="hidden" name="his_role" value="<?php echo empty($my_role) ? '' : $my_role; ?>" readonly>
                            <input type="hidden" name="his_uid" value="<?php echo empty($get_uid) ? '' : $get_uid; ?>" readonly>

                        </div>
                    </div>
                    
                    <h4 class="text-capitalize text-center mt-3 fw-bold">Site information</h4>
                    <div class="row d-flex justify-content-center g-0 mb-5">
                        <div class="col-lg-10">
                            <div class="table-responsive mb-2">
                                <table class="table table-borderless text-nowrap align-middle table-sm border border-secondary">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th>Name</th>
                                            <th>Department<span class="text-danger ms-2">*</span></th>
                                            <th>Location<span class="text-danger ms-2">*</span></th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-dark">
                                        <tr>
                                            <td>
                                                <input class="form-control text-dark" type="text" name="fullname" value="<?php echo empty($fullname) ? $my_fullname : ucwords($fullname); ?>" readonly="readonly" />
                                            </td>
                                            <td>
                                                <input class="form-control text-dark" type="text" id="hci_clon_department" name="hci_clon_department" value="<?php echo empty($department) ? '' : $department; ?>" required/>
                                            </td>
                                            <td>
                                                <select class="form-select text-dark"  name="hci_clon_location" id="hci_clon_location" required>
                                                    <option value="" selected="">Select your Location</option>
                                                    <option value="HO"  <?php echo empty($location) ? '' : ($location == 'HO' ? 'selected' : ''); ?> >HO - Head Office</option>
                                                    <option value="LFC" <?php echo empty($location) ? '' : ($location == 'LFC' ? 'selected' : ''); ?> >LFC - Local Fallback Center</option>
                                                    <option value="SPC" <?php echo empty($location) ? '' : ($location == 'SPC' ? 'selected' : ''); ?> >SPC - Security Plant Complex</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr class="bg-dark text-white fw-bold">
                                            <td>Cluster<span class="text-danger ms-2">*</span></td>
                                            <td colspan="3">HostName<span class="text-danger ms-2">*</span></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <select class="form-select text-dark" id="hci_clon_cluster" name="hci_clon_cluster" required>
                                                    <option value="" selected>Select Cluster</option>
                                                    <option value="general_cluster" <?php echo empty($cluster) ? '' : ($cluster == 'general_cluster' ? 'selected' : ''); ?> >General Cluster</option>
                                                    <option value="sql_cluster"  <?php echo empty($cluster) ? '' : ($cluster == 'sql_cluster' ? 'selected' : ''); ?> >SQL Cluster</option>
                                                    <option value="standalone_node" <?php echo empty($cluster) ? '' : ($cluster == 'standalone_node' ? 'selected' : ''); ?> >DB Standalone Node</option>
                                                 </select>
                                            </td>
                                            <td class="align-top" colspan="3">
                                                <?php if (empty($control_number)): ?>
                                                    <div class="input-group">
                                                        <input class="form-control text-dark shadow-none" type="search" name="hci_clon_hostname" id="hci_clon_hostname" value="<?php echo empty($hostname) ? '' : $hostname; ?>" onkeypress="return /[0-9A-Z.-_]/i.test(event.key)" >
                                                        <button class="btn btn-secondary shadow-none" type="button" id="btn_cloni_up_search" name="btn_cloni_up_search">Clone</button>   
                                                    </div>                                                
                                                    <div class="position-absolute">
                                                    <ul class="list-group rounded-bottom shadow user-select-none" id="hci_clon_search_result"></ul> 
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (!empty($control_number)): ?>
                                                        <input class="form-control text-dark shadow-none" type="text" name="hci_clon_hostname" id="hci_clon_hostname" readonly value="<?php echo empty($hostname) ? '' : $hostname; ?>" onkeypress="return /[0-9A-Z.-_]/i.test(event.key)" >
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <h4 class="text-capitalize text-center fw-bold">Clone Information</h4>
                            <div class="table-responsive">
                                <table class="table table-borderless align-middle text-nowrap text-dark table-sm border border-secondary" id="hci_clon_tab_logic">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th>Description</th>
                                            <th>Requested</th>
                                            <th>Comment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         
                                        <tr>
                                            <td class="fw-bold">vCPU<span class="text-danger ms-2">*</span></td>
                                            <td>
                                                <input class="form-control text-dark" type="text" id="hci_clon_vcpu" name="hci_clon_vcpu" value="<?php echo empty($vcpu) ? '' : $vcpu; ?>"  required maxlength="2" onkeypress="return /[0-9]/i.test(event.key)" >
                                            </td>
                                            <td>
                                                <input class="form-control text-dark" type="text" id="hci_clon_vcpu_comment" name="hci_clon_vcpu_comment" value="<?php echo empty($vcpu_comment) ? '' : $vcpu_comment; ?>" placeholder="Optional" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">RAM (GB)<span class="text-danger ms-2">*</span></td>
                                            <td>
                                                <input class="form-control text-dark" type="text" id="hci_clon_ram" name="hci_clon_ram" value="<?php echo empty($ram) ? '' : $ram; ?>" required maxlength="4" onkeypress="return /[0-9]/i.test(event.key)"/>
                                            </td>
                                            <td>
                                                <input class="form-control text-dark" type="text" id="hci_clon_ram_comment" name="hci_clon_ram_comment" value="<?php echo empty($ram_comment) ? '' : $ram_comment; ?>" placeholder="Optional" />
                                            </td>
                                        </tr>
                                        <tr class="align-top">
                                             <td class="fw-bold">OS<span class="text-danger ms-2">*</span></td>
                                             <td>
                                                 <select class="form-select text-dark os" name="hci_clon_os" id="hci_clon_os" required>
                                                    <option value="" selected>Select OS</option>
                                                    <option value="windows" <?php echo empty($os) ? '' : ($os == 'windows' ? 'selected' : ''); ?> >Windows</option>
                                                    <option value="linux" <?php echo empty($os) ? '' : ($os == 'linux' ? 'selected' : ''); ?> >Linux</option>
                                                 </select>                              
                                             </td>
                                             <td>
                                                 <input class="form-control text-dark" type="text" id="hci_clon_os_comment" name="hci_clon_os_comment" value="<?php echo empty($os_comment) ? '' : $os_comment; ?>" placeholder="OS version" required onkeypress="return /[A-Z0-9. ]/i.test(event.key)"/>  
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>
                                                <span class="invisible"></span>
                                            </td>
                                             <td>
                                                <input class="form-control text-dark" type="text" name="hci_clon_txt_os_descript" id="hci_clon_txt_os_descript" value="<?php echo empty($txt_os_descript) ? '' : $txt_os_descript; ?>" placeholder="Specify OS Environment (with or w/o GUI:)"  >
                                            </td>
                                             <td>
                                                <input class="form-control text-dark" type="text" id="hci_clon_txt_define_parti" name="hci_clon_txt_define_parti" value="<?php echo empty($txt_define_parti) ? '' : $txt_define_parti; ?>" placeholder="Please Define Partition:" >
                                            </td>
                                         </tr>
                                         <tr>
                                             <td class="fw-bold">IP Address<span class="text-danger ms-2">*</span></td>
                                             <td>
                                                 <input class="form-control text-dark" type="text" name="hci_clon_ip_add_vlan" id="hci_clon_ip_add_vlan" value="<?php echo empty($ip_add_vlan) ? '' : $ip_add_vlan; ?>" maxlength="15" required  onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 46)" placeholder="e.g: 19.22.23.1" />
                                             </td>
                                             <td>
                                                 <input class="form-control text-dark" type="text" name="hci_clon_ip_comment" id="hci_clon_ip_comment" value="<?php echo empty($ip_comment) ? '' : $ip_comment; ?>" required placeholder="Please input Subnet and Gateway" >
                                             </td>
                                         </tr>
                                         <tr>
                                             <td class="fw-bold">VLAN<span class="text-danger ms-2">*</span></td>
                                             <td>
                                                 <input class="form-control text-dark " type="text" name="hci_clon_txt_ip_vlan" id="hci_clon_txt_ip_vlan" value="<?php echo empty($txt_ip_vlan) ? '' : $txt_ip_vlan; ?>" required maxlength="4" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" />
                                             </td>
                                             <td>
                                                 <input class="form-control text-dark" type="text" name="hci_clon_vlan_comment" id="hci_clon_vlan_comment" value="<?php echo empty($vlan_comment) ? '' : $vlan_comment; ?>" placeholder="Optional" >
                                             </td>
                                         </tr>
                                         <tr>
                                             <td class="fw-bold">Users<span class="text-danger ms-2">*</span></td>
                                             <td>
                                                 <input class="form-control text-dark" type="text" name="hci_clon_users" id="hci_clon_users" value="<?php echo empty($hci_users) ? '' : $hci_users; ?>" required/>
                                             </td>
                                             <td>
                                                 <!-- <input class="form-control text-dark" type="text"  name="txt_hci_users" value="<?php echo empty($txt_hci_users) ? '' : $txt_hci_users; ?>" placeholder="Optional"/> -->
                                                 <select class="form-select text-dark" name="hci_clon_txt_users" id="hci_clon_txt_users">
                                                    <option value="" selected>Select Role</option>
                                                    <option value="vm_power_user" <?php echo empty($txt_hci_users) ? '' : ($txt_hci_users == 'vm_power_user' ? 'selected' : ''); ?>>VM Power User</option>
                                                    <option value="vm_power_sample" <?php echo empty($txt_hci_users) ? '' : ($txt_hci_users == 'vm_power_sample' ? 'selected' : ''); ?>>VM User Sample</option>
                                                 </select>
                                             </td>
                                         </tr>
                                         <tr>
                                            <td class="fw-bold">VM Deployment<span class="text-danger ms-2">*</span></td>
                                            <td>
                                                <input class="form-control text-dark" type="date" name="hci_clon_vm_deployment" id="hci_clon_vm_deployment" value="<?php echo empty($vm_deployment) ? '' : $vm_deployment; ?>" required>
                                            </td>
                                            <td>
                                                <input class="form-control text-dark" type="text" placeholder="Optional" name="hci_clon_vm_deployment_comment" id="hci_clon_vm_deployment_comment" value="<?php echo empty($vm_deployment_comment) ? '' : $vm_deployment_comment; ?>" >
                                            </td>
                                         </tr>
                                         <tr>
                                            <td class="fw-bold">Communication<span class="text-danger ms-2">*</span></td>
                                            <td>
                                                <input class="form-control text-dark" type="text" name="hci_clon_comm" id="hci_clon_comm" value="<?php echo empty($comm) ? '' : $comm; ?>" required onkeypress="return /[0-9A-Z ]/i.test(event.key)">
                                            </td>
                                            <td>
                                                <input class="form-control text-dark" type="text" placeholder="Optional" name="hci_clon_comm_comment" id="hci_clon_comm_comment" value="<?php echo empty($comm_comment) ? '' : $comm_comment; ?>" >
                                            </td>
                                         </tr>

                                         
                                         <tr>
                                            <td class="fw-bold">Attachment</td>
                                            <td colspan="2">
                                                <input name="file" class="form-control text-dark" type="file" id="file">
                                            </td>
                                         </tr>
                                    </tbody>
                                    <tbody id="load_others_hci_clon"></tbody>
                                    <?php 
                                        if (!empty($control_number)):
                                            $num = 1;
                                            $sql_2 = mysqli_query($conn,"SELECT * FROM tbl_forms_others where hostname = '$hostname' and form_type = '$form_type' and control_number = '$control_number' ");
                                            $count_2 = mysqli_num_rows($sql_2);
                                            if ($count_2 > 0) {
                                                while ($rows_2 = mysqli_fetch_assoc($sql_2)) {
                                                    echo '<tr>';
                                                    echo '<td class="text-dark fw-bold">Disk (GB) '.$num++.' </td>';
                                                    echo '<td><input type="hidden" name="others_id[]" value="'.$rows_2['others_id'].'" placeholder="">
                                                                <input class="form-control text-dark" type="text" id="hci_clon_others_1[]" name="hci_clon_others_1[]" value="'.$rows_2['others_1'].'" readonly></td>';
                                                    echo '<td><input class="form-control text-dark" type="text" id="hci_clon_others_2[]" name="hci_clon_others_2[]" value="'.$rows_2['others_2'].'" onkeypress="return /[0-9]/i.test(event.key)" ></td>';
                                                    echo '</tr>';
                                                }
                                            }else{
                                                echo '<tr>';
                                                echo '<td class="text-dark fw-bold">Disk (GB)</td>';
                                                echo '<td><input type="hidden" name="others_id[]" value="" placeholder=""><input class="form-control text-dark" type="text" id="hci_clon_others_1" name="hci_clon_others_1[]" value="" readonly onkeypress="return /[0-9]/i.test(event.key)"></td>';
                                                echo '<td><input class="form-control text-dark" type="text" id="hci_clon_others_2" name="hci_clon_others_2[]" ></td>';
                                                echo '</tr>';     
                                            }
                                        endif;
                                        if (empty($control_number)):
                                                // the purpose of this is to display the blank textfield of DISK GB
                                                echo '<tr id="hci_clon_disk" >';
                                                echo '<td class="text-dark fw-bold">Disk (GB)</td>';
                                                echo '<td><input class="form-control text-dark" type="text"></td>';
                                                echo '<td><input class="form-control text-dark" type="text" ></td>';
                                                echo '</tr>';                                      
                                        endif;
                                    ?> 
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <?php include 'components/comment.php'; ?>
                        </div>
                    </div>
                    <?php include 'components/authority.php'; ?>
                </div>

                <?php if (!empty($control_number)): ?>
                    <div class="modal-footer d-flex justify-content-end">       
                        <?php if ($status == 1 && $my_role == 1): ?> <!-- // Draft button -->
                        <div>
                            <button class="btn btn-secondary me-2" type="submit" name="btn_hci_clon_update" id="btn_hci_clon_update" ><i class="fa-fw fas fa-refresh me-1"></i>Update</button>
                            <button class="btn btn-primary" type="submit" name="btn_hci_clon_submit_draft" id="btn_hci_clon_submit_draft" ><i class="fa-fw fas fa-paper-plane me-1"></i>Resubmit</button>
                        </div>
                        <?php endif; ?>
                        <?php if ($my_role == 1 && $revised == 1): ?>
                        <div>
                            <button class="btn btn-primary" type="submit" name="btn_hci_clon_resubmit" id="btn_hci_clon_resubmit" ><i class="fa-fw fas fa-paper-plane me-1"></i>Resubmit</button>
                        </div>    
                        <?php endif; ?>
                        <?php if ($status == 0 && $my_role == 1): ?> <!-- // Disapproved  -->
                        <!-- <div>
                            <button class="btn btn-primary" type="submit" name="btn_resubmit" id="btn_resubmit">Resubmit</button>  
                        </div> -->
                        <?php endif; ?>
                        <?php if ($my_role == 1 && $status == 2): ?>
                        <div>
                            <button class="btn btn-danger launchModal" type="button" id="btn_hci_clon_cancel" data-bs-toggle="modal" data-bs-target="#myModal2<?php echo $formt; echo empty($control_number) ? '' : $control_number; ?>" value="Do you want to cancel this request?"><i class="fa-fw fas fa-times me-1"></i>Cancel</button>

                            <!-- <div class="btn btn-danger" id="hci_cancel_1" ><i class="fa-fw fas fa-times me-1"></i>Cancel</div>
                            <button type="submit" name="btn_hci_clon_cancel" hidden></button> -->
                        </div>    
                        <?php endif; ?>
                        
                        <?php include 'components/buttonGroup.php';?>
                    </div>
                <?php endif; ?>
                <?php if (empty($control_number)): ?>
                    <div class="modal-footer d-flex justify-content-end">
                        <div>
                            <!-- <button type="submit" name="btn_savehci" hidden></button>
                            <button type="submit" name="btn_submit_hci" hidden></button> -->
                            <button class="btn btn-secondary" name="btn_hci_clon_savehci" type="submit" id="btn_hci_clon_savehci"><i class="fa-fw fas fa-file me-1"></i>Draft</button>
                            <button class="btn btn-primary" name="btn_hci_clon_submit_hci" type="submit" id="btn_hci_clon_submit_hci"><i class="fa-fw fas fa-paper-plane me-1"></i>Submit</button>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php include 'components/promtMessage.php';?>
</form>




