<?php  

include 'connection.php';

	$generate_key = date('Y').date('m').date('d')."00001"; 

	$sql_uid = mysqli_query($conn,"SELECT * FROM tbl_hci ORDER BY id DESC LIMIT 1 ");

	if ($count_uid = mysqli_num_rows($sql_uid) > 0) {
		while ($rows_id = mysqli_fetch_assoc($sql_uid)):
			$i = $rows_id['id'];
			$concatnumber = $generate_key + $i;			
		endwhile;
			
	}else{
			$concatnumber = $generate_key; 
	}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$fullname = $_POST['fullname'];
	$email_add = $_POST['email_add'];
	$contact_no = $_POST['contact_no'];
	$hci_clon_department =$_POST['hci_clon_department'];
	$hci_clon_location = $_POST['hci_clon_location'];
	
	$hci_clon_cluster = $_POST['hci_clon_cluster'];

	$hci_clon_hostname = $_POST['hci_clon_hostname'];
	$hci_clon_vcpu = $_POST['hci_clon_vcpu'];
	$hci_clon_vcpu_comment = $_POST['hci_clon_vcpu_comment'];
	$hci_clon_ram = $_POST['hci_clon_ram'];
	$hci_clon_ram_comment = $_POST['hci_clon_ram_comment'];


	$hci_clon_os = $_POST['hci_clon_os'];
	$hci_clon_os_comment = $_POST['hci_clon_os_comment'];

	$hci_clon_txt_os_descript = $_POST['hci_clon_txt_os_descript'];
	$hci_clon_txt_define_parti = $_POST['hci_clon_txt_define_parti'];

	$hci_clon_ip_comment = $_POST['hci_clon_ip_comment'];
	$hci_clon_vlan_comment = $_POST['hci_clon_vlan_comment'];

	$hci_clon_ip_add_vlan = $_POST['hci_clon_ip_add_vlan'];
	$hci_clon_txt_ip_vlan = $_POST['hci_clon_txt_ip_vlan'];
	$hci_clon_users = $_POST['hci_clon_users'];
	$hci_clon_txt_users = $_POST['hci_clon_txt_users'];

	$hci_clon_vm_deployment    = $_POST['hci_clon_vm_deployment'];
	$hci_clon_vm_deployment_comment = $_POST['hci_clon_vm_deployment_comment'];
	$hci_clon_comm                  = $_POST['hci_clon_comm'];
	$hci_clon_comm_comment          = $_POST['hci_clon_comm_comment'];
	$attachment = $_POST['file[]'];

	$form_type = '1-3'; 
	$comments = $_POST['comments'];
	$role = $_POST['his_role'];
	$comment_id = rand(100000,999999);
	$requested_by = $_POST['requested_by'];

// // // create temp files
	if(!empty($_FILES['file']['name'])){
		$file_name = $_FILES['file']['name'];
		$file_size = $_FILES['file']['size'];
		$file_temp = $_FILES['file']['tmp_name'];
		$response = array();
		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext; // new generated File Name for Image
		$uploaded_file = "model/uploads/".$unique_image;    // Directory of Image
	}else{
		$uploaded_file = null;
	}
// // // create temp files


	if (isset($_POST['btn_hci_clon_submit_hci']) || isset($_POST['gog'])) {
		$status = 2;
		$control_number = $concatnumber;
		// move_uploaded_file($file_temp, $uploaded_file);
		$sql = mysqli_query($conn,"INSERT INTO `tbl_hci` (`uid`, `control_number`, `form_type`, `fullname`, `email_add`, `contact_no`, `department`, `location`, `cluster`, `hostname`, `vcpu`, `vcpu_comment`, `ram`, `ram_comment`, `os`, `os_comment`, `txt_os_descript`, `txt_define_parti`, `ip_add_vlan`, `ip_comment` , `txt_ip_vlan`, `vlan_comment`,`hci_users`, `txt_hci_users`, `vm_deployment`, `vm_deployment_comment`, `comm`, `comm_comment`, `attachment`,`status`, `date_requested`, `ex_requested_by`) VALUES ('$uid','$control_number', '$form_type','$fullname','$email_add','$contact_no','$hci_clon_department','$hci_clon_location','$hci_clon_cluster','$hci_clon_hostname','$hci_clon_vcpu','$hci_clon_vcpu_comment','$hci_clon_ram','$hci_clon_ram_comment','$hci_clon_os','$hci_clon_os_comment', '$hci_clon_txt_os_descript', '$hci_clon_txt_define_parti', '$hci_clon_ip_add_vlan', '$hci_clon_ip_comment', '$hci_clon_txt_ip_vlan', '$hci_clon_vlan_comment', '$hci_clon_users', '$hci_clon_txt_users', '$hci_clon_vm_deployment', '$hci_clon_vm_deployment_comment','$hci_clon_comm', '$hci_clon_comm_comment', '$uploaded_file','$status',NOW(), '$requested_by') ");

		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`, `uid`, `fullname`, `comments`, `role`,`remarks_date`) VALUES ('$form_type','$control_number','$comment_id','$uid','$fullname','$comments','$role',NOW()) ");
		}

        if (!empty($_POST['hci_clon_others_1'])) {
        	$disk = count($_POST['hci_clon_others_1']);
    
	        for ($i = 0; $i < $disk ; $i++) {
	        	$others_id = rand(100000,999999);
	        	$others_1 = $_POST['hci_clon_others_1'][$i];
	        	$others_2 = $_POST['hci_clon_others_2'][$i];

	        	if (empty($others_1) || empty($others_2)) {
	        		break;
	        		// this code will break if one of disk GB is no string.
	        	}
	        	$query = "INSERT INTO tbl_forms_others (uid, hostname, form_type, control_number, others_id, others_1, others_2) values ('$uid', '$hci_clon_hostname','$form_type','$concatnumber','$others_id','$others_1','$others_2') ";	        
	        	$insert_query = mysqli_query($conn,$query);
	        }
        }


		$_SESSION['message'] = "Successfuly Created!";
		$_SESSION['form_type'] = $form_type;
		$_SESSION['control_number'] = $control_number;
		$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid, role, fullname,form_type,control_number, activity,status) values ('$uid',  '$role', '$fullname','$form_type','$control_number', 'created','$status') ");

		
		$form_subject = "HCI";
		$form_ft = "an HCI Clone";
		require 'mail_message.php';
		require 'mail.php';
		
	}

	if (isset($_POST['btn_hci_clon_savehci'])) {
		$status = 1;
		$control_number = $concatnumber;
		$sql = mysqli_query($conn,"INSERT INTO `tbl_hci` (`uid`, `control_number`, `form_type`, `fullname`, `email_add`, `contact_no`, `department`, `location`, `cluster`, `hostname`, `vcpu`, `vcpu_comment`, `ram`, `ram_comment`, `os`, `os_comment`, `txt_os_descript`, `txt_define_parti`, `ip_add_vlan`, `ip_comment` , `txt_ip_vlan`, `vlan_comment`,`hci_users`, `txt_hci_users`, `vm_deployment`, `vm_deployment_comment`, `comm`, `comm_comment`,`status`, `date_requested`, `ex_requested_by`) VALUES ('$uid','$control_number', '$form_type','$fullname','$email_add','$contact_no','$hci_clon_department','$hci_clon_location','$hci_clon_cluster','$hci_clon_hostname','$hci_clon_vcpu','$hci_clon_vcpu_comment','$hci_clon_ram','$hci_clon_ram_comment','$hci_clon_os','$hci_clon_os_comment', '$hci_clon_txt_os_descript', '$hci_clon_txt_define_parti', '$hci_clon_ip_add_vlan', '$hci_clon_ip_comment', '$hci_clon_txt_ip_vlan', '$hci_clon_vlan_comment', '$hci_clon_users', '$hci_clon_txt_users', '$hci_clon_vm_deployment', '$hci_clon_vm_deployment_comment','$hci_clon_comm', '$hci_clon_comm_comment','$status',NOW(), '$requested_by') ");

		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`, `uid`, `fullname`, `comments`, `role`,`remarks_date`) VALUES ('$form_type','$control_number','$comment_id','$uid','$fullname','$comments','$role',NOW()) ");
		}

        if (!empty($_POST['hci_clon_others_1'])) {
        	$disk = count($_POST['hci_clon_others_1']);
    
	        for ($i = 0; $i < $disk ; $i++) {
	        	$others_id = rand(100000,999999);
	        	$others_1 = $_POST['hci_clon_others_1'][$i];
	        	$others_2 = $_POST['hci_clon_others_2'][$i];

	        	if (empty($others_1) || empty($others_2)) {
	        		break;
	        		// this code will break if one of disk GB is no string.
	        	}
	        	$query = "INSERT INTO tbl_forms_others (uid, hostname, form_type, control_number, others_id, others_1, others_2) values ('$uid', '$hci_clon_hostname','$form_type','$concatnumber','$others_id','$others_1','$others_2') ";	        
	        	$insert_query = mysqli_query($conn,$query);
	        }
        }


		$_SESSION['message'] = "Save as Draft!";
		$_SESSION['form_type'] = $form_type;
		$_SESSION['control_number'] = $control_number;
		$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid, role, fullname,form_type,control_number, activity,status) values ('$uid',  '$role', '$fullname','$form_type','$control_number', 'save as draft','$status') ");

	}
	if (isset($_POST['btn_hci_clon_submit_draft'])) {
		$txt_control_number = $_POST['txt_control_number'];
		$status = 2;
		$sql = mysqli_query($conn,"UPDATE `tbl_hci` SET `form_type`='$form_type',`fullname`='$fullname',`department`='$hci_clon_department',`location`='$hci_clon_location',`cluster` = '$hci_clon_cluster' ,`hostname`='$hci_clon_hostname',`vcpu`='$hci_clon_vcpu',`vcpu_comment`='$hci_clon_vcpu_comment',`ram`='$hci_clon_ram',`ram_comment`='$hci_clon_ram_comment', `os`='$hci_clon_os',`os_comment`='$hci_clon_os_comment', `txt_os_descript` = '$hci_clon_txt_os_descript', `txt_define_parti` = '$hci_clon_txt_define_parti',`ip_add_vlan` = '$hci_clon_ip_add_vlan', `ip_comment` = '$hci_clon_ip_comment', `vlan_comment` = '$hci_clon_vlan_comment' , `txt_ip_vlan`= '$hci_clon_txt_ip_vlan', `hci_users` = '$hci_clon_users', `txt_hci_users` = '$hci_clon_txt_users', `vm_deployment` = '$hci_clon_vm_deployment', `vm_deployment_comment` = '$hci_clon_vm_deployment_comment', `comm` = '$hci_clon_comm',`comm_comment`= '$hci_clon_comm_comment',`status`='$status', date_requested = NOW(), ex_requested_by = '$requested_by' WHERE control_number = '$txt_control_number' ");
		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`, `uid`, `fullname`, `comments`, `role`,`remarks_date`) VALUES ('$form_type','$control_number','$comment_id','$uid','$fullname','$comments','$role',NOW()) ");
		}

        if (!empty($_POST['hci_clon_others_1'])) {

        	$disk = count($_POST['hci_clon_others_1']);

	        for ($i = 0; $i < $disk ; $i++) {

	        	$others_id = $_POST['others_id'][$i];
	        	$others_1 = $_POST['hci_clon_others_1'][$i];
	        	$others_2 = $_POST['hci_clon_others_2'][$i];

	        	$query = "UPDATE tbl_forms_others set others_1 = '$others_1', others_2 = '$others_2' where control_number = '$txt_control_number' and others_id = '$others_id' ";
	        	$insert_query = mysqli_query($conn,$query);
	        }      
        }

		$_SESSION['message'] = "Resubmit!";
		$_SESSION['form_type'] = $form_type;
		$_SESSION['control_number'] = $control_number;
		$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid, role, fullname,form_type,control_number, activity,status) values ('$uid',  '$role', '$fullname','$form_type','$txt_control_number', 'resubmitted draft','$status') ");

	}
	if (isset($_POST['btn_hci_clon_update'])) {
		$txt_control_number = $_POST['txt_control_number'];
		$status = 1;
		$sql = mysqli_query($conn,"UPDATE `tbl_hci` SET `form_type`='$form_type',`fullname`='$fullname',`department`='$hci_clon_department',`location`='$hci_clon_location',`cluster` = '$hci_clon_cluster' ,`hostname`='$hci_clon_hostname',`vcpu`='$hci_clon_vcpu',`vcpu_comment`='$hci_clon_vcpu_comment',`ram`='$hci_clon_ram',`ram_comment`='$hci_clon_ram_comment',`os`='$hci_clon_os',`os_comment`='$hci_clon_os_comment', `txt_os_descript` = '$hci_clon_txt_os_descript', `txt_define_parti` = '$hci_clon_txt_define_parti',`ip_add_vlan` = '$hci_clon_ip_add_vlan', `ip_comment` = '$hci_clon_ip_comment', `vlan_comment` = '$hci_clon_vlan_comment' , `txt_ip_vlan`= '$hci_clon_txt_ip_vlan', `hci_users` = '$hci_clon_users', `txt_hci_users` = '$hci_clon_txt_users', `vm_deployment` = '$hci_clon_vm_deployment', `vm_deployment_comment` = '$hci_clon_vm_deployment_comment', `comm` = '$hci_clon_comm', `comm_comment`= '$hci_clon_comm_comment',`status`='$status', date_requested = NOW(), ex_requested_by = '$requested_by' WHERE control_number = '$txt_control_number' ");
		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`, `uid`, `fullname`, `comments`, `role`,`remarks_date`) VALUES ('$form_type','$txt_control_number','$comment_id','$uid','$fullname','$comments','$role',NOW()) ");
		}

        if (!empty($_POST['hci_clon_others_1'])) {

        	$disk = count($_POST['hci_clon_others_1']);

	        for ($i = 0; $i < $disk ; $i++) {

	        	$others_id = $_POST['others_id'][$i];
	        	$others_1 = $_POST['hci_clon_others_1'][$i];
	        	$others_2 = $_POST['hci_clon_others_2'][$i];

	        	$query = "UPDATE tbl_forms_others set others_1 = '$others_1', others_2 = '$others_2' where control_number = '$txt_control_number' and others_id = '$others_id' ";
	        	$insert_query = mysqli_query($conn,$query);
	        }      
        }

		$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid, role, fullname,form_type,control_number, activity,status) values ('$uid',  '$role', '$fullname','$form_type','$txt_control_number', 'updated','$status') ");
	
	}

	if (isset($_POST['btn_hci_clon_resubmit'])) {
		$txt_control_number = $_POST['txt_control_number'];
		$status = 2;
		$revised = 0;

		$sql = mysqli_query($conn,"UPDATE `tbl_hci` SET `form_type`='$form_type',`fullname`='$fullname',`department`='$hci_clon_department',`location`='$hci_clon_location',`cluster` = '$hci_clon_cluster' ,`hostname`='$hci_clon_hostname',`vcpu`='$hci_clon_vcpu',`vcpu_comment`='$hci_clon_vcpu_comment',`ram`='$hci_clon_ram',`ram_comment`='$hci_clon_ram_comment',`os`='$hci_clon_os',`os_comment`='$hci_clon_os_comment', `txt_os_descript` = '$hci_clon_txt_os_descript', `txt_define_parti` = '$hci_clon_txt_define_parti' ,`ip_add_vlan` = '$hci_clon_ip_add_vlan', `txt_ip_vlan`= '$hci_clon_txt_ip_vlan',  `ip_comment` = '$hci_clon_ip_comment', `vlan_comment` = '$hci_clon_vlan_comment' , `hci_users` = '$hci_clon_users', `txt_hci_users` = '$hci_clon_txt_users', `vm_deployment` = '$hci_clon_vm_deployment', `vm_deployment_comment` = '$hci_clon_vm_deployment_comment', `comm` = '$hci_clon_comm', `comm_comment`= '$hci_clon_comm_comment',`status`='$status', revised = '$revised',  date_requested = NOW(), ex_requested_by = '$requested_by', approver_id = NULL, approver = NULL, app_status = NULL, appr_date = NULL, reciever_id = NULL, reciever = NULL, rec_status = NULL, rec_date = NULL, performer_id = NULL, performer = NULL, perf_status = NULL, perform_date = NULL WHERE control_number = '$txt_control_number' ");
		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`, `uid`, `fullname`, `comments`, `role`,`remarks_date`) VALUES ('$form_type','$txt_control_number','$comment_id','$uid','$fullname','$comments','$role',NOW()) ");
		}

        if (!empty($_POST['hci_clon_others_1'])) {

        	$disk = count($_POST['hci_clon_others_1']);

	        for ($i = 0; $i < $disk ; $i++) {

	        	$others_id = $_POST['others_id'][$i];
	        	$others_1 = $_POST['hci_clon_others_1'][$i];
	        	$others_2 = $_POST['hci_clon_others_2'][$i];

	        	$query = "UPDATE tbl_forms_others set others_1 = '$others_1', others_2 = '$others_2' where control_number = '$txt_control_number' and others_id = '$others_id' ";
	        	$insert_query = mysqli_query($conn,$query);
	        }      
        }

		$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid, role, fullname,form_type,control_number, activity,status) values ('$uid',  '$role', '$fullname','$form_type','$txt_control_number', 'returned','$status') ");				
		
		$subject = "HCI Returned Form";
		$message = "Hello <b>Approver</b>,<br><br>".
		"<b>".ucwords($fullname). "</b> has returned the form with control number <b>HCI/".$txt_control_number."</b><br><br>".
		"Thank you"."<br><br><br><i>This message is autogenerated. Please do not respond.</i>";	
		
		require 'mail.php';

	}

	if (isset($_POST['btn_hci_clon_cancel'])) {
		$txt_control_number = $_POST['txt_control_number'];
		$form_type = "1-3"; 
		$status = 0;
		$cancelled = 1;
		$sql = mysqli_query($conn,"UPDATE `tbl_hci` SET `status`='$status', cancelled = '$cancelled', date_requested = NOW() WHERE control_number = '$txt_control_number' ");

		$_SESSION['message'] = "Successfuly Canceled!";
		$_SESSION['form_type'] = $form_type;
		$_SESSION['control_number'] = $txt_control_number;
		$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid, role, fullname,form_type,control_number, activity,status) values ('$uid',  '$role', '$fullname','$form_type','$txt_control_number', 'canceled','$status') ");				
	
	}
 // this session will used to save the control number and form type and get the data and display to alert notification		
		mysqli_close($conn);


}

if (isset($_REQUEST['control_number']) && isset($_REQUEST['f_type']) && isset($_REQUEST['uid'])) {
	$form_type = "1-3"; 
	$txt_control_number = $_REQUEST['control_number'];
	$status = 0;
	$cancelled = 1;
	$uid = $_REQUEST['uid'];
	$form_type = $_REQUEST['f_type'];
	$sql = mysqli_query($conn,"UPDATE `tbl_hci` SET `status`='$status', cancelled = '$cancelled', date_requested = NOW() WHERE control_number = '$txt_control_number' ");

	$_SESSION['message'] = "Successfuly Canceled!";
	$_SESSION['form_type'] = $form_type;
	$_SESSION['control_number'] = $txt_control_number;
	$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid, role, fullname,form_type,control_number, activity,status) values ('$uid',  '$role', '$fullname','$form_type','$txt_control_number', 'canceled','$status') ");					
	header("location: ../pending_request.php");
}





?>