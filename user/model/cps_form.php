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

    $fullname           = $_POST['fullname'];
    $email_add          = $_POST['email_add'];
    $contact_no         = $_POST['contact_no'];
    $system_name        = $_POST['system_name'];
    $hostname           = $_POST['hostname'];
    $pattern            = $_POST['pattern'];
    $instance_name      = $_POST['instance_name'];
    $location           = $_POST['location'];
    $env_profile        = $_POST['env_profile'];
    $ip_add             = $_POST['ip_add'];
    $ip_group           = $_POST['ip_group'];
    $vcpu_size          = $_POST['vcpu_size'];
    $vcpu_filesystem    = $_POST['vcpu_filesystem'];
    $vcpu_remarks       = $_POST['vcpu_remarks'];
    $ram_size           = $_POST['ram_size'];
    $ram_filesystem     = $_POST['ram_filesystem'];
    $ram_remarks        = $_POST['ram_remarks'];

    $ue_enroll_size     = $_POST['ue_enroll_size'];
    $ue_filesystem      = $_POST['ue_filesystem'];
    $ue_remarks         = $_POST['ue_remarks'];
	$form_type 			= 3; 
	$role               = $_POST['his_role']; 
	$comments 			= $_POST['comments'];
	$comment_id 		= rand(100000,999999);


	if (isset($_POST['btn_submit_cps'])) {
		$status = 2;
		$control_number = $concatnumber;

		$sql = mysqli_query($conn,"INSERT INTO `tbl_cps`(`uid`,`control_number`, `form_type`, `fullname`, `email_add`, `contact_no`, `system_name`, `hostname`, `pattern`, `instance_name`, `location`, `env_profile`, `ip_add`, `ip_group`, `vcpu_size`, `vcpu_filesystem`, `vcpu_remarks`, `ram_size`, `ram_filesystem`, `ram_remarks`, `ue_enroll_size`, `ue_filesystem`, `ue_remarks`, `status`, `date_requested`) VALUES ('$uid','$control_number','$form_type','$fullname','$email_add','$contact_no', '$system_name','$hostname','$pattern','$instance_name','$location','$env_profile','$ip_add','$ip_group','$vcpu_size','$vcpu_filesystem','$vcpu_remarks','$ram_size','$ram_filesystem','$ram_remarks','$ue_enroll_size','$ue_filesystem','$ue_remarks','$status', NOW() )");

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

	        	if (empty($others_1) || empty($others_2) || empty($others_3) ) {
	        		break;
	        		// this code will break if one of disk GB is no string.
	        	}
	        	$query = "INSERT INTO tbl_forms_others (uid, hostname, form_type, control_number, others_id, others_1, others_2, others_3) values ('$uid', '$hostname','$form_type','$concatnumber','$others_id','$others_1','$others_2','$others_3') ";	        
	        	$insert_query = mysqli_query($conn,$query);
	        }
        }
		
		$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$control_number', 'created','$status') ");	
		$_SESSION['message'] = "Successfuly Created!";
		$_SESSION['form_type'] = $form_type;
		$_SESSION['control_number'] = $control_number;	

		$form_subject = "CPS";
		require 'mail_message.php';
		require 'mail.php';

	}	

	if (isset($_POST['btn_save_cps'])) {
		$status = 1;
		$control_number = $concatnumber;

		$sql = mysqli_query($conn,"INSERT INTO `tbl_cps`(`uid`,`control_number`, `form_type`, `fullname`, `email_add`, `contact_no`, `system_name`, `hostname`, `pattern`, `instance_name`, `location`, `env_profile`, `ip_add`, `ip_group`, `vcpu_size`, `vcpu_filesystem`, `vcpu_remarks`, `ram_size`, `ram_filesystem`, `ram_remarks`, `ue_enroll_size`, `ue_filesystem`, `ue_remarks`, `status`, `date_requested`) VALUES ('$uid','$control_number','$form_type','$fullname','$email_add','$contact_no','$system_name','$hostname','$pattern','$instance_name','$location','$env_profile','$ip_add','$ip_group','$vcpu_size','$vcpu_filesystem','$vcpu_remarks','$ram_size','$ram_filesystem','$ram_remarks','$ue_enroll_size','$ue_filesystem','$ue_remarks','$status', NOW() )");

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

	        	if (empty($others_1) || empty($others_2) || empty($others_3) ) {
	        		break;
	        		// this code will break if one of disk GB is no string.
	        	}
	        	$query = "INSERT INTO tbl_forms_others (uid, hostname, form_type, control_number, others_id, others_1, others_2, others_3) values ('$uid', '$hostname','$form_type','$concatnumber','$others_id','$others_1','$others_2','$others_3') ";	        
	        	$insert_query = mysqli_query($conn,$query);
	        }
        }
		$_SESSION['message'] = "Successfuly Created!";
		$_SESSION['form_type'] = $form_type;
		$_SESSION['control_number'] = $control_number;	
		$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$control_number', 'save as draft','$status') ");	
		
				
	}

	if (isset($_POST['btn_submit_draft_cps'])) {
		$status = 2;
		$txt_control_number = $_POST['txt_control_number'];

		$sql = mysqli_query($conn,"UPDATE `tbl_cps` SET `form_type`='$form_type', `system_name`='$system_name',`hostname`='$hostname',`pattern`='$pattern',`instance_name`='$instance_name',`location`='$location',`env_profile`='$env_profile',`ip_add`='$ip_add',`ip_group`='$ip_group',`vcpu_size`='$vcpu_size',`vcpu_filesystem`='$vcpu_filesystem',`vcpu_remarks`='$vcpu_remarks',`ram_size`='$ram_size',`ram_filesystem`='$ram_filesystem',`ram_remarks`='$ram_remarks',`ue_enroll_size`='$ue_enroll_size',`ue_filesystem`='$ue_filesystem',`ue_remarks`='$ue_remarks',`status`='$status',`date_requested`= NOW() WHERE control_number = '$txt_control_number' ");
	
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

	        	$query = "UPDATE tbl_forms_others set others_1 = '$others_1', others_2 = '$others_2', others_3 = '$others_3' where control_number = '$txt_control_number' and others_id = '$others_id' ";
	        	$insert_query = mysqli_query($conn,$query);
	        }      
        }
		$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$txt_control_number', 'resubmitted draft','$status') ");			

	}

	if (isset($_POST['btn_update_cps'])) {
		$status = 1;
		$txt_control_number = $_POST['txt_control_number'];

		$sql = mysqli_query($conn,"UPDATE `tbl_cps` SET `form_type`='$form_type', `system_name`='$system_name',`hostname`='$hostname',`pattern`='$pattern',`instance_name`='$instance_name',`location`='$location',`env_profile`='$env_profile',`ip_add`='$ip_add',`ip_group`='$ip_group',`vcpu_size`='$vcpu_size',`vcpu_filesystem`='$vcpu_filesystem',`vcpu_remarks`='$vcpu_remarks',`ram_size`='$ram_size',`ram_filesystem`='$ram_filesystem',`ram_remarks`='$ram_remarks',`ue_enroll_size`='$ue_enroll_size',`ue_filesystem`='$ue_filesystem',`ue_remarks`='$ue_remarks',`status`='$status',`date_requested`= NOW() WHERE control_number = '$txt_control_number' ");
	
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

	        	$query = "UPDATE tbl_forms_others set others_1 = '$others_1', others_2 = '$others_2', others_3 = '$others_3' where control_number = '$txt_control_number' and others_id = '$others_id' ";
	        	$insert_query = mysqli_query($conn,$query);
	        }      
        }
		$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$txt_control_number', 'updated','$status') ");			

	}

	if (isset($_POST['btn_resubmit_cps'])) {
		$status = 2;
		$txt_control_number = $_POST['txt_control_number'];
		$revised = 0;
		$sql = mysqli_query($conn,"UPDATE `tbl_cps` SET `form_type`='$form_type', `system_name`='$system_name',`hostname`='$hostname',`pattern`='$pattern',`instance_name`='$instance_name',`location`='$location',`env_profile`='$env_profile',`ip_add`='$ip_add',`ip_group`='$ip_group',`vcpu_size`='$vcpu_size',`vcpu_filesystem`='$vcpu_filesystem',`vcpu_remarks`='$vcpu_remarks',`ram_size`='$ram_size',`ram_filesystem`='$ram_filesystem',`ram_remarks`='$ram_remarks',`ue_enroll_size`='$ue_enroll_size',`ue_filesystem`='$ue_filesystem',`ue_remarks`='$ue_remarks',`status`='$status', `revised` = '$revised', `date_requested` = NOW(), approver_id = NULL, approver = NULL, app_status = NULL, appr_date = NULL, reciever_id = NULL, reciever = NULL, rec_status = NULL, rec_date = NULL, performer_id = NULL, performer = NULL, perf_status = NULL, perform_date = NULL WHERE control_number = '$txt_control_number' ");
	
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

	        	$query = "UPDATE tbl_forms_others set others_1 = '$others_1', others_2 = '$others_2', others_3 = '$others_3' where control_number = '$txt_control_number' and others_id = '$others_id' ";
	        	$insert_query = mysqli_query($conn,$query);
	        }      
        }
		$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$txt_control_number', 'returned','$status') ");			

	}

	if (isset($_POST['btn_cancel_cps'])) {
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