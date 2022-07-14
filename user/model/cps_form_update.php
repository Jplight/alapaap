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
    $fullname           		= $_POST['fullname'];
    $email_add         			 = $_POST['email_add'];
    $contact_no         		= $_POST['contact_no'];
    $cps_up_system_name        		= $_POST['cps_up_system_name'];
    $cps_up_search_txt  		= $_POST['cps_up_search_txt'];
    $cps_up_pattern     		= $_POST['cps_up_pattern'];
    $cps_up_instance_name      = $_POST['cps_up_instance_name'];
    $cps_up_location           = $_POST['cps_up_location'];
    $cps_up_env_profile        = $_POST['cps_up_env_profile'];
    $cps_up_ip_add             = $_POST['cps_up_ip_add'];
    $cps_up_ip_group           = $_POST['cps_up_ip_group'];
    $cps_up_vcpu_size_req          = $_POST['cps_up_vcpu_size_req'];
    $cps_up_vcpu_filesystem    = $_POST['cps_up_vcpu_filesystem'];
    $cps_up_vcpu_remarks       = $_POST['cps_up_vcpu_remarks'];
    $cps_up_ram_size_req           = $_POST['cps_up_ram_size_req'];

    $cps_up_ram_filesystem     = $_POST['cps_up_ram_filesystem'];
    $cps_up_ram_remarks        = $_POST['cps_up_ram_remarks'];




    $cps_up_ue_enroll_size_req     = $_POST['cps_up_ue_enroll_size_req'];
    $cps_up_ue_filesystem      = $_POST['cps_up_ue_filesystem'];
    $cps_up_ue_remarks         = $_POST['cps_up_ue_remarks'];
	$form_type 			= '3-1'; 
	$role               = $_POST['his_role']; 
	$comments 			= $_POST['comments'];
	$comment_id 		= rand(100000,999999);


	if (isset($_POST['btn_submit_cps_up'])) {
		$status = 2;
		$control_number = $concatnumber;

		$sql = mysqli_query($conn,"INSERT INTO `tbl_cps`(`uid`,`control_number`, `cps_new_control_num`,`form_type`, `fullname`, `email_add`, `contact_no`, `system_name`, `hostname`, `pattern`, `instance_name`, `location`, `env_profile`, `ip_add`, `ip_group`, `vcpu_size`, `vcpu_filesystem`, `vcpu_remarks`, `ram_size`, `ram_filesystem`, `ram_remarks`, `ue_enroll_size`, `ue_filesystem`, `ue_remarks`, `status`, `date_requested`) VALUES ('$uid','$control_number', '$cps_new_control_num', '$form_type','$fullname','$email_add','$contact_no', '$cps_up_system_name','$cps_up_search_txt','$cps_up_pattern','$cps_up_instance_name','$cps_up_location','$cps_up_env_profile','$cps_up_ip_add','$cps_up_ip_group','$cps_up_vcpu_size_req','$cps_up_vcpu_filesystem','$cps_up_vcpu_remarks','$cps_up_ram_size_req','$cps_up_ram_filesystem','$cps_up_ram_remarks','$cps_up_ue_enroll_size_req','$cps_up_ue_filesystem','$cps_up_ue_remarks','$status', NOW() )");

		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`, `uid`, `fullname`, `comments`, `role`, `remarks_date`) VALUES ('$form_type','$control_number','$comment_id','$uid','$fullname','$comments', '$role', NOW()) ");
		}

        if (!empty($_POST['others_1'])) {
        	$disk = count($_POST['others_1']);
    
	        for ($i = 0; $i < $disk ; $i++) {
	        	$others_id = rand(100000,999999);
	        	$others_1 = $_POST['others_1'][$i];
	        	$others_2 = $_POST['others_2'][$i];
	        	$others_3 = $_POST['others_3'][$i];
	        	$others_4 = $_POST['others_4'][$i];

	        	if (empty($others_1) || empty($others_2) || empty($others_3) || empty($others_4) ) {
	        		break;
	        		// this code will break if one of disk GB is no string.
	        	}
	        	$query = "INSERT INTO tbl_forms_others (uid, hostname, form_type, control_number, others_id, others_1, others_2, others_3, others_4) values ('$uid', '$cps_up_search_txt','$form_type','$control_number','$others_id','$others_1','$others_2','$others_3', '$others_4') ";	        
	        	$insert_query = mysqli_query($conn,$query);
	        }
        }
		$_SESSION['message'] = "Successfuly Created!";
		$_SESSION['form_type'] = $form_type;
		$_SESSION['control_number'] = $control_number;
		$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$control_number', 'created','$status') ");	
		
		$form_subject = "CPS Update";
		require 'mail_message.php';
		require 'mail.php';

	}	

	if (isset($_POST['btn_save_cps_up'])) {
		$status = 1;
		$control_number = $concatnumber;

		$sql = mysqli_query($conn,"INSERT INTO `tbl_cps`(`uid`,`control_number`, `cps_new_control_num`,`form_type`, `fullname`, `email_add`, `contact_no`, `system_name`, `hostname`, `pattern`, `instance_name`, `location`, `env_profile`, `ip_add`, `ip_group`, `vcpu_size`, `vcpu_filesystem`, `vcpu_remarks`, `ram_size`, `ram_filesystem`, `ram_remarks`, `ue_enroll_size`, `ue_filesystem`, `ue_remarks`, `status`, `date_requested`) VALUES ('$uid','$control_number', '$cps_new_control_num', '$form_type','$fullname','$email_add','$contact_no', '$cps_up_system_name','$cps_up_search_txt','$cps_up_pattern','$cps_up_instance_name','$cps_up_location','$cps_up_env_profile','$cps_up_ip_add','$cps_up_ip_group','$cps_up_vcpu_size_req','$cps_up_vcpu_filesystem','$cps_up_vcpu_remarks','$cps_up_ram_size_req','$cps_up_ram_filesystem','$cps_up_ram_remarks','$cps_up_ue_enroll_size_req','$cps_up_ue_filesystem','$cps_up_ue_remarks','$status', NOW() )");

		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`, `uid`, `fullname`, `comments`, `role`, `remarks_date`) VALUES ('$form_type','$control_number','$comment_id','$uid','$fullname','$comments', '$role', NOW()) ");
		}

        if (!empty($_POST['others_1'])) {
        	$disk = count($_POST['others_1']);
    
	        for ($i = 0; $i < $disk ; $i++) {
	        	$others_id = rand(100000,999999);
	        	$others_1 = $_POST['others_1'][$i];
	        	$others_2 = $_POST['others_2'][$i];
	        	$others_3 = $_POST['others_3'][$i];
	        	$others_4 = $_POST['others_4'][$i];

	        	if (empty($others_1) || empty($others_2) || empty($others_3) || empty($others_4) ) {
	        		break;
	        		// this code will break if one of disk GB is no string.
	        	}
	        	$query = "INSERT INTO tbl_forms_others (uid, hostname, form_type, control_number, others_id, others_1, others_2, others_3, others_4) values ('$uid', '$cps_up_search_txt','$form_type','$concatnumber','$others_id','$others_1','$others_2','$others_3', '$others_4') ";	        
	        	$insert_query = mysqli_query($conn,$query);
	        }
        }
		$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$control_number', 'save as draft','$status') ");

				
	}

	if (isset($_POST['btn_submit_draft_cps_up'])) {
		$status = 2;
		$txt_control_number = $_POST['txt_control_number'];

		$sql = mysqli_query($conn,"UPDATE `tbl_cps` SET `form_type`='$form_type', `system_name`='$cps_up_system_name',`hostname`='$cps_up_search_txt',`pattern`='$cps_up_pattern',`instance_name`='$cps_up_instance_name',`location`='$cps_up_location',`env_profile`='$cps_up_env_profile',`ip_add`='$cps_up_ip_add',`ip_group`='$cps_up_ip_group',`vcpu_size`='$cps_up_vcpu_size_req',`vcpu_filesystem`='$cps_up_vcpu_filesystem',`vcpu_remarks`='$cps_up_vcpu_remarks',`ram_size`='$cps_up_ram_size_req',`ram_filesystem`='$cps_up_ram_filesystem',`ram_remarks`='$cps_up_ram_remarks',`ue_enroll_size`='$cps_up_ue_enroll_size_req',`ue_filesystem`='$cps_up_ue_filesystem',`ue_remarks`='$cps_up_ue_remarks',`status`='$status',`date_requested`= NOW() WHERE control_number = '$txt_control_number' ");
	
		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`, `uid`, `fullname`, `comments`, `role`, `remarks_date`) VALUES ('$form_type','$txt_control_number','$comment_id','$uid','$fullname','$comments', '$role', NOW()) ");
		}

        if (!empty($_POST['others_1'])) {

        	$disk = count($_POST['others_1']);

	        for ($i = 0; $i < $disk ; $i++) {

	        	$others_id = $_POST['others_id'][$i];
	        	$others_1 = $_POST['others_1'][$i];
	        	$others_2 = $_POST['others_2'][$i];
	        	$others_3 = $_POST['others_3'][$i];
	        	$others_4 = $_POST['others_4'][$i];

	        	$query = "UPDATE tbl_forms_others set others_1 = '$others_1', others_2 = '$others_2', others_3 = '$others_3', others_4 = '$others_4' where control_number = '$txt_control_number' and others_id = '$others_id' ";
	        	$insert_query = mysqli_query($conn,$query);
	        }      
        }
		$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$txt_control_number', 'resubmitted draft','$status') ");

	}

	if (isset($_POST['btn_update_cps_up'])) {
		$status = 1;
		$txt_control_number = $_POST['txt_control_number'];

		$sql = mysqli_query($conn,"UPDATE `tbl_cps` SET `form_type`='$form_type', `system_name`='$cps_up_system_name',`hostname`='$cps_up_search_txt',`pattern`='$cps_up_pattern',`instance_name`='$cps_up_instance_name',`location`='$cps_up_location',`env_profile`='$cps_up_env_profile',`ip_add`='$cps_up_ip_add',`ip_group`='$cps_up_ip_group',`vcpu_size`='$cps_up_vcpu_size_req',`vcpu_filesystem`='$cps_up_vcpu_filesystem',`vcpu_remarks`='$cps_up_vcpu_remarks',`ram_size`='$cps_up_ram_size_req',`ram_filesystem`='$cps_up_ram_filesystem',`ram_remarks`='$cps_up_ram_remarks',`ue_enroll_size`='$cps_up_ue_enroll_size_req',`ue_filesystem`='$cps_up_ue_filesystem',`ue_remarks`='$cps_up_ue_remarks',`status`='$status',`date_requested`= NOW() WHERE control_number = '$txt_control_number' ");
	
		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`, `uid`, `fullname`, `comments`, `role`, `remarks_date`) VALUES ('$form_type','$txt_control_number','$comment_id','$uid','$fullname','$comments', '$role', NOW()) ");
		}
        if (!empty($_POST['others_1'])) {

        	$disk = count($_POST['others_1']);

	        for ($i = 0; $i < $disk ; $i++) {

	        	$others_id = $_POST['others_id'][$i];
	        	$others_1 = $_POST['others_1'][$i];
	        	$others_2 = $_POST['others_2'][$i];
	        	$others_3 = $_POST['others_3'][$i];
	        	$others_4 = $_POST['others_4'][$i];

	        	$query = "UPDATE tbl_forms_others set others_1 = '$others_1', others_2 = '$others_2', others_3 = '$others_3', others_4 = '$others_4' where control_number = '$txt_control_number' and others_id = '$others_id' ";
	        	$insert_query = mysqli_query($conn,$query);
	        }      
        }
		$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$txt_control_number', 'updated','$status') ");

	}

	if (isset($_POST['btn_resubmit_cps_up'])) {
		$status = 2;
		$txt_control_number = $_POST['txt_control_number'];
		$revised = 0;
		$sql = mysqli_query($conn,"UPDATE `tbl_cps` SET `form_type`='$form_type', `system_name`='$cps_up_system_name',`hostname`='$cps_up_search_txt',`pattern`='$cps_up_pattern',`instance_name`='$cps_up_instance_name',`location`='$cps_up_location',`env_profile`='$cps_up_env_profile',`ip_add`='$cps_up_ip_add',`ip_group`='$cps_up_ip_group',`vcpu_size`='$cps_up_vcpu_size_req',`vcpu_filesystem`='$cps_up_vcpu_filesystem',`vcpu_remarks`='$cps_up_vcpu_remarks',`ram_size`='$cps_up_ram_size_req',`ram_filesystem`='$cps_up_ram_filesystem',`ram_remarks`='$cps_up_ram_remarks',`ue_enroll_size`='$cps_up_ue_enroll_size_req',`ue_filesystem`='$cps_up_ue_filesystem',`ue_remarks`='$cps_up_ue_remarks',`status`='$status', `revised` = '$revised', `date_requested` = NOW(), approver_id = NULL, approver = NULL, app_status = NULL, appr_date = NULL, reciever_id = NULL, reciever = NULL, rec_status = NULL, rec_date = NULL, performer_id = NULL, performer = NULL, perf_status = NULL, perform_date = NULL WHERE control_number = '$txt_control_number' ");
	
		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`, `uid`, `fullname`, `comments`, `role`, `remarks_date`) VALUES ('$form_type','$txt_control_number','$comment_id','$uid','$fullname','$comments', '$role', NOW()) ");
		}
        if (!empty($_POST['others_1'])) {

        	$disk = count($_POST['others_1']);

	        for ($i = 0; $i < $disk ; $i++) {

	        	$others_id = $_POST['others_id'][$i];
	        	$others_1 = $_POST['others_1'][$i];
	        	$others_2 = $_POST['others_2'][$i];
	        	$others_3 = $_POST['others_3'][$i];
	        	$others_4 = $_POST['others_4'][$i];

	        	$query = "UPDATE tbl_forms_others set others_1 = '$others_1', others_2 = '$others_2', others_3 = '$others_3', others_4 = '$others_4' where control_number = '$txt_control_number' and others_id = '$others_id' ";
	        	$insert_query = mysqli_query($conn,$query);
	        }      
        }
		$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$txt_control_number', 'returned','$status') ");

	}

	if (isset($_POST['btn_cancel_cps_up'])) {
		$txt_control_number = $_POST['txt_control_number'];
		$status = 0;
		$cancelled = 1;
		$sql = mysqli_query($conn,"UPDATE `tbl_cps` SET `status`='$status', cancelled = '$cancelled', date_requested = NOW() WHERE control_number = '$txt_control_number' ");
		$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$txt_control_number', 'canceled','$status') ");
		if ($sql) {
			header("location: index.php");
			mysqli_close($conn);
		}		
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