<?php  

include 'connection.php';

	$generate_key = date('Y').date('m').date('d')."00001"; 

	$sql_uid = mysqli_query($conn,"SELECT * FROM tbl_cps ORDER BY id DESC LIMIT 1 ");

	if ($count_uid = mysqli_num_rows($sql_uid) > 0) {
		while ($rows_id = mysqli_fetch_assoc($sql_uid)):
			$i = $rows_id['id'];
			$concatnumber = $generate_key + $i;			
		endwhile;
			
	}else{
			$concatnumber = $generate_key; 
	}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$cps_new_control_num = $_POST['cps_new_control_num'];
	$cps_up_control_num = $_POST['cps_up_control_num'];

    $fullname           		= $_POST['fullname'];
    $email_add         			 = $_POST['email_add'];
    $contact_no         		= $_POST['contact_no'];
    $cps_del_system_name        		= $_POST['cps_del_system_name'];
    $cps_del_search_txt  		= $_POST['cps_del_search_txt'];
    $cps_del_pattern     		= $_POST['cps_del_pattern'];
    $cps_del_instance_name      = $_POST['cps_del_instance_name'];
    $cps_del_location           = $_POST['cps_del_location'];
    $cps_del_env_profile        = $_POST['cps_del_env_profile'];
    $cps_del_ip_add             = $_POST['cps_del_ip_add'];
    $cps_del_ip_group           = $_POST['cps_del_ip_group'];
    $cps_del_vcpu_size_req          = $_POST['cps_del_vcpu_size_req'];
    $cps_del_vcpu_filesystem    = $_POST['cps_del_vcpu_filesystem'];
    $cps_del_vcpu_remarks       = $_POST['cps_del_vcpu_remarks'];
    $cps_del_ram_size_req           = $_POST['cps_del_ram_size_req'];

    $cps_del_ram_filesystem     = $_POST['cps_del_ram_filesystem'];
    $cps_del_ram_remarks        = $_POST['cps_del_ram_remarks'];


    $cps_del_ue_enroll_size_req     = $_POST['cps_del_ue_enroll_size_req'];
    $cps_del_ue_filesystem      = $_POST['cps_del_ue_filesystem'];
    $cps_del_ue_remarks         = $_POST['cps_del_ue_remarks'];
	$form_type 			= '3-2'; 
	$role               = $_POST['his_role']; 
	$comments 			= $_POST['comments'];
	$comment_id 		= rand(100000,999999);


	if (isset($_POST['btn_submit_cps_del'])) {
		$status = 2;
		$control_number = $concatnumber;

		$sql = mysqli_query($conn,"INSERT INTO `tbl_cps`(`uid`,`control_number`, `cps_new_control_num`, `cps_up_control_num`,`form_type`, `fullname`, `email_add`, `contact_no`, `system_name`, `hostname`, `pattern`, `instance_name`, `location`, `env_profile`, `ip_add`, `ip_group`, `vcpu_size`, `vcpu_filesystem`, `vcpu_remarks`, `ram_size`, `ram_filesystem`, `ram_remarks`, `ue_enroll_size`, `ue_filesystem`, `ue_remarks`, `status`, `date_requested`) VALUES ('$uid','$control_number', '$cps_new_control_num', '$cps_up_control_num','$form_type','$fullname','$email_add','$contact_no', '$cps_del_system_name','$cps_del_search_txt','$cps_del_pattern','$cps_del_instance_name','$cps_del_location','$cps_del_env_profile','$cps_del_ip_add','$cps_del_ip_group','$cps_del_vcpu_size_req','$cps_del_vcpu_filesystem','$cps_del_vcpu_remarks','$cps_del_ram_size_req','$cps_del_ram_filesystem','$cps_del_ram_remarks','$cps_del_ue_enroll_size_req','$cps_del_ue_filesystem','$cps_del_ue_remarks','$status', NOW() )");

		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`, `uid`, `fullname`, `comments`, `role`, `remarks_date`) VALUES ('$form_type','$control_number','$comment_id','$uid','$fullname','$comments', '$role', NOW()) ");
		}

		$_SESSION['message'] = "Successfuly Created!";
		$_SESSION['form_type'] = $form_type;
		$_SESSION['control_number'] = $control_number;
		$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$control_number', 'created','$status') ");			
	
		$form_subject = "CPS Delete";
		require 'mail_message.php';
		require 'mail.php';
	
	}	

	if (isset($_POST['btn_save_cps_del'])) {
		$status = 1;
		$control_number = $concatnumber;

		$sql = mysqli_query($conn,"INSERT INTO `tbl_cps`(`uid`,`control_number`, `cps_new_control_num`, `cps_up_control_num`,`form_type`, `fullname`, `email_add`, `contact_no`, `system_name`, `hostname`, `pattern`, `instance_name`, `location`, `env_profile`, `ip_add`, `ip_group`, `vcpu_size`, `vcpu_filesystem`, `vcpu_remarks`, `ram_size`, `ram_filesystem`, `ram_remarks`, `ue_enroll_size`, `ue_filesystem`, `ue_remarks`, `status`, `date_requested`) VALUES ('$uid','$control_number', '$cps_new_control_num', '$cps_up_control_num','$form_type','$fullname','$email_add','$contact_no', '$cps_del_system_name','$cps_del_search_txt','$cps_del_pattern','$cps_del_instance_name','$cps_del_location','$cps_del_env_profile','$cps_del_ip_add','$cps_del_ip_group','$cps_del_vcpu_size_req','$cps_del_vcpu_filesystem','$cps_del_vcpu_remarks','$cps_del_ram_size_req','$cps_del_ram_filesystem','$cps_del_ram_remarks','$cps_del_ue_enroll_size_req','$cps_del_ue_filesystem','$cps_del_ue_remarks','$status', NOW() )");

		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`, `uid`, `fullname`, `comments`, `role`, `remarks_date`) VALUES ('$form_type','$control_number','$comment_id','$uid','$fullname','$comments', '$role', NOW()) ");
		}

		$_SESSION['message'] = "Successfuly Created!";
		$_SESSION['form_type'] = $form_type;
		$_SESSION['control_number'] = $control_number;
		$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$control_number', 'save as draft','$status') ");
				
	}

	if (isset($_POST['btn_submit_draft_cps_del'])) {
		$status = 2;
		$txt_control_number = $_POST['txt_control_number'];

		$sql = mysqli_query($conn,"UPDATE `tbl_cps` SET `form_type`='$form_type', `system_name`='$cps_del_system_name',`hostname`='$cps_del_search_txt',`pattern`='$cps_del_pattern',`instance_name`='$cps_del_instance_name',`location`='$cps_del_location',`env_profile`='$cps_del_env_profile',`ip_add`='$cps_del_ip_add',`ip_group`='$cps_del_ip_group',`vcpu_size`='$cps_del_vcpu_size_req',`vcpu_filesystem`='$cps_del_vcpu_filesystem',`vcpu_remarks`='$cps_del_vcpu_remarks',`ram_size`='$cps_del_ram_size_req',`ram_filesystem`='$cps_del_ram_filesystem',`ram_remarks`='$cps_del_ram_remarks',`ue_enroll_size`='$cps_del_ue_enroll_size_req',`ue_filesystem`='$cps_del_ue_filesystem',`ue_remarks`='$cps_del_ue_remarks',`status`='$status',`date_requested`= NOW() WHERE control_number = '$txt_control_number' ");
	
		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`, `uid`, `fullname`, `comments`, `role`, `remarks_date`) VALUES ('$form_type','$txt_control_number','$comment_id','$uid','$fullname','$comments', '$role', NOW()) ");
		}

		$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$txt_control_number', 'resubmitted draft','$status') ");
	}

	if (isset($_POST['btn_update_cps_del'])) {
		$status = 1;
		$txt_control_number = $_POST['txt_control_number'];

		$sql = mysqli_query($conn,"UPDATE `tbl_cps` SET `form_type`='$form_type', `system_name`='$cps_del_system_name',`hostname`='$cps_del_search_txt',`pattern`='$cps_del_pattern',`instance_name`='$cps_del_instance_name',`location`='$cps_del_location',`env_profile`='$cps_del_env_profile',`ip_add`='$cps_del_ip_add',`ip_group`='$cps_del_ip_group',`vcpu_size`='$cps_del_vcpu_size_req',`vcpu_filesystem`='$cps_del_vcpu_filesystem',`vcpu_remarks`='$cps_del_vcpu_remarks',`ram_size`='$cps_del_ram_size_req',`ram_filesystem`='$cps_del_ram_filesystem',`ram_remarks`='$cps_del_ram_remarks',`ue_enroll_size`='$cps_del_ue_enroll_size_req',`ue_filesystem`='$cps_del_ue_filesystem',`ue_remarks`='$cps_del_ue_remarks',`status`='$status',`date_requested`= NOW() WHERE control_number = '$txt_control_number' ");
	
		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`, `uid`, `fullname`, `comments`, `role`, `remarks_date`) VALUES ('$form_type','$txt_control_number','$comment_id','$uid','$fullname','$comments', '$role', NOW()) ");
		}

		$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$txt_control_number', 'updated','$status') ");
	}

	if (isset($_POST['btn_resubmit_cps_del'])) {
		$status = 2;
		$txt_control_number = $_POST['txt_control_number'];
		$revised = 0;
		$sql = mysqli_query($conn,"UPDATE `tbl_cps` SET `form_type`='$form_type', `system_name`='$cps_del_system_name',`hostname`='$cps_del_search_txt',`pattern`='$cps_del_pattern',`instance_name`='$cps_del_instance_name',`location`='$cps_del_location',`env_profile`='$cps_del_env_profile',`ip_add`='$cps_del_ip_add',`ip_group`='$cps_del_ip_group',`vcpu_size`='$cps_del_vcpu_size_req',`vcpu_filesystem`='$cps_del_vcpu_filesystem',`vcpu_remarks`='$cps_del_vcpu_remarks',`ram_size`='$cps_del_ram_size_req',`ram_filesystem`='$cps_del_ram_filesystem',`ram_remarks`='$cps_del_ram_remarks',`ue_enroll_size`='$cps_del_ue_enroll_size_req',`ue_filesystem`='$cps_del_ue_filesystem',`ue_remarks`='$cps_del_ue_remarks',`status`='$status', `revised` = '$revised', `date_requested` = NOW(), approver_id = NULL, approver = NULL, app_status = NULL, appr_date = NULL, reciever_id = NULL, reciever = NULL, rec_status = NULL, rec_date = NULL, performer_id = NULL, performer = NULL, perf_status = NULL, perform_date = NULL WHERE control_number = '$txt_control_number' ");
	
		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`, `uid`, `fullname`, `comments`, `role`, `remarks_date`) VALUES ('$form_type','$txt_control_number','$comment_id','$uid','$fullname','$comments', '$role', NOW()) ");
		}

		$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$txt_control_number', 'returned','$status') ");
	}

	if (isset($_POST['btn_cancel_cps_del'])) {
		$txt_control_number = $_POST['txt_control_number'];
		$status = 0;
		$cancelled = 1;
		$sql = mysqli_query($conn,"UPDATE `tbl_cps` SET `status`='$status', cancelled = '$cancelled', date_requested = NOW() WHERE control_number = '$txt_control_number' ");
		$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$txt_control_number', 'canceled','$status') ");		
	}
}

if (isset($_REQUEST['control_number']) && isset($_REQUEST['f_type']) && isset($_REQUEST['uid'])) {

	$txt_control_number = $_REQUEST['control_number'];
	$status = 0;
	$cancelled = 1;
	$uid = $_REQUEST['uid'];
	$form_type = $_REQUEST['f_type'];
	$sql = mysqli_query($conn,"UPDATE `tbl_cps` SET `status`='$status', cancelled = '$cancelled', date_requested = NOW() WHERE control_number = '$txt_control_number' ");
	$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$txt_control_number', 'canceled','$status') ");
	if ($sql) {
		header("location: ../pending_request.php");
		mysqli_close($conn);
	}		
	
}

?>