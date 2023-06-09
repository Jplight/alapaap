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
<form method="post" autocomplete="off" id="form_new" name="form_new" action="" enctype="multipart/form-data">
    <div id="view_hci<?php echo empty($control_number) ? '' : $control_number; ?>" class="modal myModal" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-xl modal-fullscreen-xl-down" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row g-0 d-flex flex-column-reverse flex-lg-row w-100 gap-3 gap-lg-0">
                        <div class="col-md-12 col-lg-5 col-xl-4 offset-lg-1 offset-xl-1">
                            <h4 class="modal-title fw-bold">BSP HCI REQUEST FORM</h4>
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
                                            <th>Department</th>
                                            <th>Location</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-dark">
                                        <tr>
                                            <td>
                                                <input class="form-control text-dark" type="text" name="fullname" value="<?php echo empty($fullname) ? $my_fullname : ucwords($fullname); ?>" readonly="readonly" />
                                            </td>
                                            <td>
                                                <input class="form-control text-dark" type="text" name="department" value="<?php echo empty($department) ? '' : $department; ?>" required/>
                                            </td>
                                            <td>
                                                <select class="form-select text-dark"  name="location" required>
                                                    <option value="" selected="">Select your Location</option>
                                                    <option value="HO"  <?php echo empty($location) ? '' : ($location == 'HO' ? 'selected' : ''); ?> >HO - Head Office</option>
                                                    <option value="LFC" <?php echo empty($location) ? '' : ($location == 'LFC' ? 'selected' : ''); ?> >LFC - Local Fallback Center</option>
                                                    <option value="SPC" <?php echo empty($location) ? '' : ($location == 'SPC' ? 'selected' : ''); ?> >SPC - Security Plant Complex</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr class="bg-dark text-white fw-bold">
                                            <td>Cluster</td>
                                            <td colspan="3">Host Name</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <select class="form-select text-dark" name="cluster" required>
                                                    <option value="" selected>Select Cluster</option>
                                                    <option value="general_cluster" <?php echo empty($cluster) ? '' : ($cluster == 'general_cluster' ? 'selected' : ''); ?> >General Cluster</option>
                                                    <option value="sql_cluster"  <?php echo empty($cluster) ? '' : ($cluster == 'sql_cluster' ? 'selected' : ''); ?> >SQL Cluster</option>
                                                    <option value="standalone_node" <?php echo empty($cluster) ? '' : ($cluster == 'standalone_node' ? 'selected' : ''); ?> >DB Standalone Node</option>
                                                 </select>
                                            </td>
                                            <td class="align-top" colspan="3">
                                                <input class="form-control text-dark" type="text" id="hostname" name="hostname" value="<?php echo empty($hostname) ? '' : $hostname; ?>" placeholder="Input your Host Name" required onkeypress="return /[0-9A-Z.-_]/i.test(event.key)" />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <h4 class="text-capitalize text-center fw-bold">Request Information</h4>
                            <div class="table-responsive">
                                <table class="table table-borderless align-middle text-nowrap text-dark table-sm border border-secondary" id="hci_tab_logic">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th>Description</th>
                                            <th>Requested</th>
                                            <th>Comment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         
                                        <tr>
                                            <td class="fw-bold">vCPU</td>
                                            <td>
                                                <input class="form-control text-dark" type="text" name="vcpu" value="<?php echo empty($vcpu) ? '' : $vcpu; ?>"  required maxlength="2" onkeypress="return /[0-9]/i.test(event.key)" >
                                            </td>
                                            <td>
                                                <input class="form-control text-dark" type="text" name="vcpu_comment" value="<?php echo empty($vcpu_comment) ? '' : $vcpu_comment; ?>" placeholder="Optional" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">RAM (GB)</td>
                                            <td>
                                                <input class="form-control text-dark" type="text" name="ram" value="<?php echo empty($ram) ? '' : $ram; ?>" required maxlength="4" onkeypress="return /[0-9]/i.test(event.key)"/>
                                            </td>
                                            <td>
                                                <input class="form-control text-dark" type="text"  name="ram_comment" value="<?php echo empty($ram_comment) ? '' : $ram_comment; ?>" placeholder="Optional" />
                                            </td>
                                        </tr>
                                        <tr class="align-top">
                                             <td class="fw-bold">OS</td>
                                             <td>
                                                 <select class="form-select text-dark os" name="os" required>
                                                    <option value="" selected>Select OS</option>
                                                    <option value="windows" <?php echo empty($os) ? '' : ($os == 'windows' ? 'selected' : ''); ?> >Windows</option>
                                                    <option value="linux" <?php echo empty($os) ? '' : ($os == 'linux' ? 'selected' : ''); ?> >Linux</option>
                                                 </select>                              
                                             </td>
                                             <td>
                                                 <input class="form-control text-dark" type="text" name="os_comment" value="<?php echo empty($os_comment) ? '' : $os_comment; ?>" placeholder="OS version" required onkeypress="return /[A-Z0-9. ]/i.test(event.key)"/>  
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>
                                                <span class="invisible"></span>
                                            </td>
                                             <td>
                                                <input class="form-control text-dark" type="text" name="txt_os_descript" value="<?php echo empty($txt_os_descript) ? '' : $txt_os_descript; ?>" placeholder="Specify OS Environment (with or w/o GUI:)"  >
                                            </td>
                                             <td>
                                                <input class="form-control text-dark" type="text" name="txt_define_parti" value="<?php echo empty($txt_define_parti) ? '' : $txt_define_parti; ?>" placeholder="Please Define Partition:" >
                                            </td>
                                         </tr>
                                         <tr>
                                             <td class="fw-bold">IP Address</td>
                                             <td>
                                                 <input class="form-control text-dark" type="text" name="ip_add_vlan" value="<?php echo empty($ip_add_vlan) ? '' : $ip_add_vlan; ?>" maxlength="15" required  onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57) || event.charCode == 46)" placeholder="e.g: 19.22.23.1" />
                                             </td>
                                             <td>
                                                 <input class="form-control text-dark" type="text" name="ip_comment" value="<?php echo empty($ip_comment) ? '' : $ip_comment; ?>" required placeholder="Please input Subnet and Gateway" >
                                             </td>
                                         </tr>
                                         <tr>
                                             <td class="fw-bold">VLAN</td>
                                             <td>
                                                 <input class="form-control text-dark " type="text" name="txt_ip_vlan" value="<?php echo empty($txt_ip_vlan) ? '' : $txt_ip_vlan; ?>" required maxlength="4" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" />
                                             </td>
                                             <td>
                                                 <input class="form-control text-dark" type="text" name="vlan_comment"  value="<?php echo empty($vlan_comment) ? '' : $vlan_comment; ?>" placeholder="Optional" >
                                             </td>
                                         </tr>
                                         <tr>
                                             <td class="fw-bold">Users </td>
                                             <td>
                                                 <input class="form-control text-dark" type="text" name="hci_users" value="<?php echo empty($hci_users) ? '' : $hci_users; ?>" required/>
                                             </td>
                                             <td>
                                                 <!-- <input class="form-control text-dark" type="text"  name="txt_hci_users" value="<?php echo empty($txt_hci_users) ? '' : $txt_hci_users; ?>" placeholder="Optional"/> -->
                                                 <select class="form-select" name="txt_hci_users" id="txt_hci_users">
                                                    <option value="" selected>Select Role</option>
                                                    <option value="vm_power_user" <?php echo empty($txt_hci_users) ? '' : ($txt_hci_users == 'vm_power_user' ? 'selected' : ''); ?>>VM Power User</option>
                                                    <option value="vm_power_sample" <?php echo empty($txt_hci_users) ? '' : ($txt_hci_users == 'vm_power_sample' ? 'selected' : ''); ?>>VM User Sample</option>
                                                 </select>
                                             </td>
                                         </tr>
                                         <tr>
                                            <td class="fw-bold">VM Deployment</td>
                                            <td>
                                                <input class="form-control" type="date" name="vm_deployment" id="vm_deployment" value="<?php echo empty($vm_deployment) ? '' : $vm_deployment; ?>" required>
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" placeholder="Optional" name="vm_deployment_comment" id="vm_deployment_comment" value="<?php echo empty($vm_deployment_comment) ? '' : $vm_deployment_comment; ?>" >
                                            </td>
                                         </tr>
                                         <tr>
                                            <td class="fw-bold">Communication</td>
                                            <td>
                                                <input class="form-control" type="text" name="comm" id="comm" value="<?php echo empty($comm) ? '' : $comm; ?>" required onkeypress="return /[0-9A-Z ]/i.test(event.key)">
                                            </td>
                                            <td>
                                                <input class="form-control" type="text" placeholder="Optional" name="comm_comment" id="comm_comment" value="<?php echo empty($comm_comment) ? '' : $comm_comment; ?>" >
                                            </td>
                                         </tr>

                                         
                                         <tr>
                                            <td class="fw-bold">Attachment</td>
                                            <td colspan="2">
                                                <input name="file" class="form-control" type="file" id="file">
                                            </td>
                                         </tr>
                                         
                                        <!-- Display data of DISK GB -->
                                        <?php
                                            if (!empty($control_number)):
                                                $num = 1;
                                                $display = mysqli_query($conn,"SELECT * FROM tbl_forms_others where form_type = '$form_type' and control_number = '$control_number' ");
                                                while ($rows = mysqli_fetch_array($display)):     
                                        ?>
                                        <tr>
                                            <td class="fw-bold">Disk (GB) <?=$num++; ?></td>
                                            <td>
                                                <input type="hidden" name="others_id[]" value="<?=$rows['others_id']; ?>" >
                                                <input class="form-control text-dark uid1" type="text" name='others_1[]' value="<?=$rows['others_1']?>" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" >
                                            </td>
                                            <td>
                                                <input class="form-control text-dark uname1" type="text" name='others_2[]' value="<?=$rows['others_2']?>" placeholder="Optional">
                                            </td>
                                        </tr>
                                        <?php 
                                                endwhile; 
                                            endif;
                                            
                                        ?>
                                        <!-- Display data of DISK GB -->

                                        <!-- View data in DISK GB -->
                                        <?php if (empty($control_number)): ?>
                                        <tr id='addr1'>
                                            <td class="fw-bold">DISK (GB)</td>
                                            <td>
                                                <div class="d-flex justify-content-end position-relative">
                                                    <input type="hidden" name="others_id[]" >
                                                    <input class="form-control text-dark uid1" type="text" name='others_1[]' required onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" >

                                                    <div class="position-absolute me-2 bg-white d-flex align-self-center" style="z-index:4;">
                                                        <div class="d-flex flex-column ">
                                                            <button class="btn btn-sm " type="button" id="add_row"><i class="fa-fw fas fa-plus"></i></button>
                                                        </div>  
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <input class="form-control text-dark uname1" type="text" name='others_2[]' placeholder="Optional">
                                            </td>
                                        </tr>
                                        <?php endif; ?>
                                        <!-- View data in DISK GB -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <?php include 'components/comment.php'; ?>
                        </div>
                    </div>
                    <?php include 'components/authority.php'; ?>
                </div>
                <?php include 'components/buttonGroup.php';?>
            </div>
        </div>
    </div>
    <?php include 'components/prompMessage.php';?>
</form>




