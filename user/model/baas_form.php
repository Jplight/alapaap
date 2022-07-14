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
		$csrf_department 			= $_POST['csrf_department'];
		$txt_others 				= $_POST['txt_others'];
		$csrf_form_factor 			= $_POST['csrf_form_factor'];
		$hostname 					= $_POST['hostname'];
		$ip_add 					= $_POST['ip_add'];
        $csrf_operating_system     	= $_POST['csrf_operating_system'];
        $csrf_os_version           	= $_POST['csrf_aix_ver'].$_POST['csrf_rhel_ver'].$_POST['csrf_windows_ver'].$_POST['csrf_ios_ver'].$_POST['csrf_oel_ver'];
        $csrf_db_type              	= $_POST['csrf_db_type'];
        $csrf_db_version          	= $_POST['csrf_db2_ver'].$_POST['csrf_oracle_ver'].$_POST['csrf_mssql_ver'].$_POST['csrf_others_ver'];
        $csrf_action              	= $_POST['csrf_act_backup']." ".$_POST['csrf_act_archive']." ".$_POST['csrf_act_bmr']." ".$_POST['csrf_act_file_lvl']." ".$_POST['csrf_act_vm_lvl'];
        $csrf_node_name           	= $_POST['csrf_node_name'];
        $csrf_backup_method        	= $_POST['csrf_backup_method'];
        $csrf_backup_method_desc   	= $_POST['csrf_txt_drive'].$_POST['csrf_txt_specific'];
        $csrf_backup_sched         	= $_POST['csrf_backup_sched'];
        $csrf_backup_time          	= $_POST['csrf_txt_daily'].$_POST['csrf_weekly_time'].$_POST['csrf_monthly_time'];
        $csrf_backup_day           	= $_POST['csrf_txt_weekly'].$_POST['csrf_month_of'];
        $csrf_archive_sched        	= $_POST['csrf_archive_sched'];
        $csrf_archive_time         	= $_POST['csrf_archive_time'];
        $csrf_archive_day          	= $_POST['csrf_archive_day'];
        $csrf_retention            	= $_POST['csrf_retention'];
        $csrf_retention_sched      	= $_POST['csrf_retent_days'].$_POST['csrf_retent_years'];
		$server_contact 			= $_POST['server_contact'];
		$form_type = 4;

		if (isset($_POST['btn_baas_csrf_submit'])) {

			$status = 2; // Send from Approver

			$sql = mysqli_query($conn,"INSERT INTO `tbl_baas`(`uid`, `control_number`, `form_type`, `fullname`, `email_add`, `contact_no`, `department`, `txt_others`, `form_factor`, `hostname`, `ip_add`, `os`, `os_version`, `db_type`, `db_version`, `action`, `node_name`, `backup_method`, `backup_method_desc`, `backup_sched`, `backup_time`, `backup_day`, `archive_sched`, `archive_time`, `archive_day`, `retention`, `retention_sched`, `server_contact`, `status`, `date_requested`) VALUES ('$uid','$control_number', '$form_type', '$fullname','$email_add','$contact_no','$csrf_department', '$txt_others','$csrf_form_factor','$hostname','$ip_add','$csrf_operating_system','$csrf_os_version','$csrf_db_type','$csrf_db_version','$csrf_action','$csrf_node_name','$csrf_backup_method','$csrf_backup_method_desc','$csrf_backup_sched','$csrf_backup_time','$csrf_backup_day','$csrf_archive_sched','$csrf_archive_time','$csrf_archive_day','$csrf_retention','$csrf_retention_sched','$server_contact','$status',NOW()) ");
			$_SESSION['message'] = "Successfuly Created!";
			$_SESSION['form_type'] = $form_type;
			$_SESSION['control_number'] = $control_number;
			$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$control_number', 'created','$status') ");
		
			$form_subject = "Baas CSRF";
			require 'mail_message.php';
			require 'mail.php';
		
		}


		if (isset($_POST['btn_baas_save_csrf'])) {

			$status = 1; // Send from Approver

			$sql = mysqli_query($conn,"INSERT INTO `tbl_baas`(`uid`, `control_number`, `form_type`, `fullname`, `email_add`, `contact_no`, `department`, `txt_others`, `form_factor`, `hostname`, `ip_add`, `os`, `os_version`, `db_type`, `db_version`, `action`, `node_name`, `backup_method`, `backup_method_desc`, `backup_sched`, `backup_time`, `backup_day`, `archive_sched`, `archive_time`, `archive_day`, `retention`, `retention_sched`, `server_contact`, `status`, `date_requested`) VALUES ('$uid','$control_number', '$form_type', '$fullname','$email_add','$contact_no','$csrf_department', '$txt_others','$csrf_form_factor','$hostname','$ip_add','$csrf_operating_system','$csrf_os_version','$csrf_db_type','$csrf_db_version','$csrf_action','$csrf_node_name','$csrf_backup_method','$csrf_backup_method_desc','$csrf_backup_sched','$csrf_backup_time','$csrf_backup_day','$csrf_archive_sched','$csrf_archive_time','$csrf_archive_day','$csrf_retention','$csrf_retention_sched','$server_contact','$status',NOW()) ");;
			$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$control_number', 'save as draft','$status') ");
		}


		if (isset($_POST['btn_resub_baas_csrf'])) {
			$txt_control_number = $_POST['txt_control_number'];
			$status = 2;
			$revised = 0;

			$sql = mysqli_query($conn,"UPDATE `tbl_baas` SET `department`='$csrf_department',`txt_others`='$txt_others',`form_factor`='$csrf_form_factor',`hostname`='$hostname',`ip_add`='$ip_add',`os`='$csrf_operating_system',`os_version`='$csrf_os_version',`db_type`='$csrf_db_type',`db_version`='$csrf_db_version',`action`='$csrf_action',`node_name`='$csrf_node_name',`backup_method`='$csrf_backup_method',`backup_method_desc`='$csrf_backup_method',`backup_sched`='$csrf_backup_sched',`backup_time`='$csrf_backup_time',`backup_day`='$csrf_backup_day',`archive_sched`='$csrf_archive_sched',`archive_time`='$csrf_archive_time',`archive_day`='$csrf_archive_day',`retention`='$csrf_retention',`retention_sched`='$csrf_retention_sched',`server_contact`='$server_contact',`status`='$status',`revised`='$revised', date_requested = NOW(), approver_id = NULL, approver = NULL, app_status = NULL, appr_date = NULL, reciever_id = NULL, reciever = NULL, rec_status = NULL, rec_date = NULL, performer_id = NULL, performer = NULL, perf_status = NULL, perform_date = NULL WHERE control_number = '$txt_control_number' ");
			$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$txt_control_number', 'resubmitted','$status') ");
			if ($sql) {
				header("location: index.php");
				mysqli_close($conn);
			}		
		
		}


		if (isset($_POST['btn_up_baas_csrf'])) {
			$txt_control_number = $_POST['txt_control_number'];

			$sql = mysqli_query($conn,"UPDATE `tbl_baas` SET `department`='$csrf_department',`txt_others`='$txt_others',`form_factor`='$csrf_form_factor',`hostname`='$hostname',`ip_add`='$ip_add',`os`='$csrf_operating_system',`os_version`='$csrf_os_version',`db_type`='$csrf_db_type',`db_version`='$csrf_db_version',`action`='$csrf_action',`node_name`='$csrf_node_name',`backup_method`='$csrf_backup_method',`backup_method_desc`='$csrf_backup_method',`backup_sched`='$csrf_backup_sched',`backup_time`='$csrf_backup_time',`backup_day`='$csrf_backup_day',`archive_sched`='$csrf_archive_sched',`archive_time`='$csrf_archive_time',`archive_day`='$csrf_archive_day',`retention`='$csrf_retention',`retention_sched`='$csrf_retention_sched',`server_contact`='$server_contact', date_requested = NOW() WHERE control_number = '$txt_control_number' ");
			
			$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$txt_control_number', 'updated','$status') ");
			if ($sql) {
				header("location: index.php");
				mysqli_close($conn);
			}		
		
		}

		if (isset($_POST['btn_sub_draft_csrf'])) {
			$txt_control_number = $_POST['txt_control_number'];
			$status = 2;
			$sql = mysqli_query($conn,"UPDATE `tbl_baas` SET `department`='$csrf_department',`txt_others`='$txt_others',`form_factor`='$csrf_form_factor',`hostname`='$hostname',`ip_add`='$ip_add',`os`='$csrf_operating_system',`os_version`='$csrf_os_version',`db_type`='$csrf_db_type',`db_version`='$csrf_db_version',`action`='$csrf_action',`node_name`='$csrf_node_name',`backup_method`='$csrf_backup_method',`backup_method_desc`='$csrf_backup_method',`backup_sched`='$csrf_backup_sched',`backup_time`='$csrf_backup_time',`backup_day`='$csrf_backup_day',`archive_sched`='$csrf_archive_sched',`archive_time`='$csrf_archive_time',`archive_day`='$csrf_archive_day',`retention`='$csrf_retention',`retention_sched`='$csrf_retention_sched',`server_contact`='$server_contact', status = '$status' ,date_requested = NOW() WHERE control_number = '$txt_control_number' ");
		
			$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$txt_control_number', 'submmitted draft','$status') ");
			if ($sql) {
				header("location: index.php");
				mysqli_close($conn);
			}		
		
		}
		
		if (isset($_POST['btn_cancel_csrf'])) {
			$txt_control_number = $_POST['txt_control_number'];
			$status = 0;
			$cancelled = 1;
			$sql = mysqli_query($conn,"UPDATE `tbl_baas` SET `status`='$status', cancelled = '$cancelled', date_requested = NOW() WHERE control_number = '$txt_control_number' ");		
			$_SESSION['message'] = "Successfuly Canceled!";
			$_SESSION['form_type'] = $form_type;
			$_SESSION['control_number'] = $control_number;
			$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$txt_control_number', 'canceled','$status') ");		
		}

		if ($sql) {
			header("location: index.php");
			mysqli_close($conn);
		}	
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

?>