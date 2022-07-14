<?php 

include 'connection.php';

	$generate_key = date('Y').date('m').date('d')."00001"; 

	$sql_uid = mysqli_query($conn,"SELECT * FROM tbl_baas ORDER BY id DESC LIMIT 1 ");

	if ($count_uid = mysqli_num_rows($sql_uid) > 0) {
		while ($rows_id = mysqli_fetch_assoc($sql_uid)):
			$i = $rows_id['id'];
			$concatnumber = $generate_key + $i;			
		endwhile;
			
	}else{
			$concatnumber = $generate_key; 
	}

if ($_SERVER['REQUEST_METHOD']=='POST') {

		$control_number 			= $concatnumber;
		$fullname 					= $_POST['fullname'];
		$email_add 					= $_POST['email_add'];
		$contact_no 				= $_POST['contact_no'];
		$crrf_department 			= $_POST['crrf_department'];
		$crrf_txt_others 			= $_POST['crrf_txt_others'];
		$crrf_form_factor 			= $_POST['crrf_form_factor'];
		$hostname 					= $_POST['hostname'];
		$ip_add 					= $_POST['ip_add'];
        $crrf_operating_system     	= $_POST['crrf_operating_system'];
        $crrf_os_version           	= $_POST['crrf_aix_ver'].$_POST['crrf_rhel_ver'].$_POST['crrf_windows_ver'].$_POST['crrf_ios_ver'].$_POST['crrf_oel_ver'];

        $crrf_action              	= $_POST['crrf_act_bmr']." ".$_POST['crrf_act_file_lvl']." ".$_POST['crrf_act_vm_lvl'];

        $crrf_backup_method        	= $_POST['crrf_backup_method'];
        $crrf_backup_method_desc   	= $_POST['crrf_txt_drive'].$_POST['crrf_txt_specific'];

        $specify_selection 			= $_POST['specify_selection'];

        $crrf_host_vm_lvl 			= $_POST['crrf_host_vm_lvl'];
        $crrf_path_file_lvl 		= $_POST['crrf_path_file_lvl'];
        $crrf_retention 			= $_POST['crrf_retention'];
		$server_contact 			= $_POST['server_contact'];

		$form_type = '4-2';

		if (isset($_POST['btn_baas_crrf_submit'])) {
			$status = 2; // Send from Approver
			$sql = mysqli_query($conn,"INSERT INTO `tbl_baas`(`uid`, `control_number`, `form_type`, `fullname`, `email_add`, `contact_no`, `department`, `txt_others`, `form_factor`, `hostname`, `ip_add`, `os` ,`os_version`,`action`,`backup_method`,`backup_method_desc`,`backup_sched`,`backup_time`,`backup_day`,`retention`,`server_contact`,`status`,`date_requested`) VALUES ('$uid','$control_number', '$form_type', '$fullname','$email_add','$contact_no','$crrf_department', '$crrf_txt_others','$crrf_form_factor','$hostname','$ip_add','$crrf_operating_system','$crrf_os_version','$crrf_action','$crrf_backup_method','$crrf_backup_method_desc','$specify_selection','$crrf_host_vm_lvl','$crrf_path_file_lvl','$crrf_retention','$server_contact','$status',NOW()) ");
			$_SESSION['message'] = "Successfuly Created!";
			$_SESSION['form_type'] = $form_type;
			$_SESSION['control_number'] = $control_number;
			$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$control_number', 'created','$status') ");		
		
			$form_subject = "Baas CRRF";
			require 'mail_message.php';
			require 'mail.php';
		
		}

		if (isset($_POST['btn_baas_save_crrf'])) {
			$status = 1; // Send from Approver
			$sql = mysqli_query($conn,"INSERT INTO `tbl_baas`(`uid`, `control_number`, `form_type`, `fullname`, `email_add`, `contact_no`, `department`, `txt_others`, `form_factor`, `hostname`, `ip_add`, `os` ,`os_version`,`action`,`backup_method`,`backup_method_desc`,`backup_sched`,`backup_time`,`backup_day`,`retention`,`server_contact`,`status`,`date_requested`) VALUES ('$uid','$control_number', '$form_type', '$fullname','$email_add','$contact_no','$crrf_department', '$crrf_txt_others','$crrf_form_factor','$hostname','$ip_add','$crrf_operating_system','$crrf_os_version','$crrf_action','$crrf_backup_method','$crrf_backup_method_desc','$specify_selection','$crrf_host_vm_lvl','$crrf_path_file_lvl','$crrf_retention','$server_contact','$status',NOW()) ");
			$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$control_number', 'save as draft','$status') ");
		}

		if (isset($_POST['btn_resub_baas_crrf'])) {
			$txt_control_number = $_POST['txt_control_number'];
			$status = 2;
			$revised = 0;
			$sql = mysqli_query($conn,"UPDATE tbl_baas set department = '$crrf_department', txt_others = '$crrf_txt_others', form_factor = '$crrf_form_factor', hostname = '$hostname', ip_add = '$ip_add', os = '$crrf_operating_system', os_version = '$crrf_os_version', action = '$crrf_action', backup_method = '$crrf_backup_method', backup_method_desc = '$crrf_backup_method_desc', backup_sched = '$specify_selection', backup_time = '$crrf_host_vm_lvl', backup_day = '$crrf_path_file_lvl', retention = '$crrf_retention', server_contact = '$server_contact', status = '$status', date_requested = NOW(), approver_id = NULL, approver = NULL, app_status = NULL, appr_date = NULL, reciever_id = NULL, reciever = NULL, rec_status = NULL, rec_date = NULL, performer_id = NULL, performer = NULL, perf_status = NULL, perform_date = NULL WHERE control_number = '$txt_control_number' ");
			$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$txt_control_number', 'returned','$status') ");
		}

		if (isset($_POST['btn_up_baas_crrf'])) {
			$txt_control_number = $_POST['txt_control_number'];
			$sql = mysqli_query($conn,"UPDATE tbl_baas set department = '$crrf_department', txt_others = '$crrf_txt_others', form_factor = '$crrf_form_factor', hostname = '$hostname', ip_add = '$ip_add', os = '$crrf_operating_system', os_version = '$crrf_os_version', action = '$crrf_action', backup_method = '$crrf_backup_method', backup_method_desc = '$crrf_backup_method_desc', backup_sched = '$specify_selection', backup_time = '$crrf_host_vm_lvl', backup_day = '$crrf_path_file_lvl', retention = '$crrf_retention', server_contact = '$server_contact', date_requested = NOW() WHERE control_number = '$txt_control_number' ");
			$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$txt_control_number', 'updated','$status') ");
		}

		if (isset($_POST['btn_sub_draft_crrf'])) {
			$txt_control_number = $_POST['txt_control_number'];
			$status = 2;
			$sql = mysqli_query($conn,"UPDATE tbl_baas set department = '$crrf_department', txt_others = '$crrf_txt_others', form_factor = '$crrf_form_factor', hostname = '$hostname', ip_add = '$ip_add', os = '$crrf_operating_system', os_version = '$crrf_os_version', action = '$crrf_action', backup_method = '$crrf_backup_method', backup_method_desc = '$crrf_backup_method_desc', backup_sched = '$specify_selection', backup_time = '$crrf_host_vm_lvl', backup_day = '$crrf_path_file_lvl', retention = '$crrf_retention', server_contact = '$server_contact', status = '$status' ,date_requested = NOW() WHERE control_number = '$txt_control_number' ");
			$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$txt_control_number', 'resubmitted draft','$status') ");
		}
		if (isset($_POST['btn_cancel_crrf'])) {
			$txt_control_number = $_POST['txt_control_number'];
			$status = 0;
			$cancelled = 1;
			$sql = mysqli_query($conn,"UPDATE `tbl_baas` SET `status`='$status', cancelled = '$cancelled', date_requested = NOW() WHERE control_number = '$txt_control_number' ");		
			$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$txt_control_number', 'canceled','$status') ");		
		}

		if (isset($_REQUEST['control_number']) && isset($_REQUEST['f_type']) && isset($_REQUEST['uid'])) {

			$txt_control_number = $_REQUEST['control_number'];
			$status = 0;
			$cancelled = 1;
			$uid = $_REQUEST['uid'];
			$form_type = $_REQUEST['f_type'];
			$sql = mysqli_query($conn,"UPDATE `tbl_baas` SET `status`='$status', cancelled = '$cancelled', date_requested = NOW() WHERE control_number = '$txt_control_number' ");
				
			$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$txt_control_number', 'canceled','$status') ");
			if ($sql) {
				header("location: ../pending_request.php");
				mysqli_close($conn);
			}
		}

		if ($sql) {
			header("location: index.php");
			mysqli_close($conn);
		}	
}








?>