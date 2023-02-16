<?php  

include 'connection.php';

	$generate_key = date('Y').date('m').date('d')."00001"; 

	$sql_uid = mysqli_query($conn,"SELECT * FROM tbl_straas ORDER BY id DESC LIMIT 1 ");

	if ($count_uid = mysqli_num_rows($sql_uid) > 0) {
		while ($rows_id = mysqli_fetch_assoc($sql_uid)):
			$i = $rows_id['id'];
			$concatnumber = $generate_key + $i;			
		endwhile;
			
	}else{
			$concatnumber = $generate_key; 
	}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$straas_new_control_num = $_POST['straas_new_control_num'];
	$fullname = $_POST['fullname'];
	$email_add = $_POST['email_add'];
	$contact_no = $_POST['contact_no'];
	$straas_up_department =$_POST['straas_up_department'];
	$straas_up_location = $_POST['straas_up_location'];
	

	$straas_up_search_txt = $_POST['straas_up_search_txt'];
	$straas_up_req_host_port = $_POST['straas_up_req_host_port'];
	$straas_up_host_port_comment = $_POST['straas_up_host_port_comment'];


	$form_type = "5-2"; 
	$comments = $_POST['comments'];
	$role = $_POST['his_role'];
	$comment_id = rand(100000,999999);

	if (isset($_POST['btn_submit_straas_up'])) {
		$status = 2;
		$control_number = $concatnumber;
		$sql = mysqli_query($conn,"INSERT INTO `tbl_straas` (`uid`, `control_number`, `straas_new_control_num`, `form_type`, `fullname`, `email_add`, `contact_no`, `department`, `location`, `hostname`, `host_port`, `host_port_comment`,`status`, `date_requested`) VALUES ('$uid','$control_number', '$straas_new_control_num','$form_type','$fullname','$email_add','$contact_no','$straas_up_department','$straas_up_location','$straas_up_search_txt','$straas_up_req_host_port','$straas_up_host_port_comment','$status',NOW()) ");

		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`, `uid`, `fullname`, `comments`, `role`,`remarks_date`) VALUES ('$form_type','$control_number','$comment_id','$uid','$fullname','$comments','$role',NOW()) ");
		}

        if (!empty($_POST['others_1'])) {
        	$disk = count($_POST['others_1']);
    
	        for ($i = 0; $i < $disk ; $i++) {
	        	$others_id = rand(100000,999999);
	        	$others_1 = $_POST['others_1'][$i];
	        	$others_2 = $_POST['others_2'][$i];
	        	$others_3 = $_POST['others_3'][$i];

	        	if (empty($others_1) || empty($others_2) ) {
	        		break;
	        		// this code will break if one of disk GB is no string.
	        	}
	        	$query = "INSERT INTO tbl_forms_others (uid, hostname, form_type, control_number, others_id, others_1, others_2, others_3) values ('$uid', '$straas_up_search_txt','$form_type','$concatnumber','$others_id','$others_1','$others_2','$others_3') ";	        
	        	$insert_query = mysqli_query($conn,$query);
	        }
        }

		$_SESSION['message'] = "Successfuly Created!";
		$_SESSION['form_type'] = $form_type;
		$_SESSION['control_number'] = $control_number;

		$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid, role, fullname,form_type,control_number, activity,status) values ('$uid',  '$role', '$fullname','$form_type','$control_number', 'requested','$status') ");					

		$form_subject = "straas";
		$form_ft = "an Update straas";
		require 'mail_message.php';
		require 'mail.php';
	
	}
	if (isset($_POST['btn_save_straas_up'])) {
		$status = 1;
		$control_number = $concatnumber;
		$sql = mysqli_query($conn,"INSERT INTO `tbl_straas` (`uid`, `control_number`, `straas_new_control_num`, `form_type`, `fullname`, `email_add`, `contact_no`, `department`, `location`,`hostname`, `host_port`, `host_port_comment`, `status`, `date_requested`) VALUES ('$uid','$control_number', '$straas_new_control_num','$form_type','$fullname','$email_add','$contact_no','$straas_up_department','$straas_up_location','$straas_up_search_txt','$straas_up_req_host_port','$straas_up_host_port_comment','$status',NOW()) ");


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
	        	$query = "INSERT INTO tbl_forms_others (uid, hostname, form_type, control_number, others_id, others_1, others_2, others_3) values ('$uid', '$straas_up_search_txt','$form_type','$concatnumber','$others_id','$others_1','$others_2','$others_3') ";	        
	        	$insert_query = mysqli_query($conn,$query);
	        }
        }

		$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid, role, fullname,form_type,control_number, activity,status) values ('$uid',  '$role', '$fullname','$form_type','$control_number', 'save as draft','$status') ");
		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`, `uid`, `fullname`, `comments`, `role`,`remarks_date`) VALUES ('$form_type','$control_number','$comment_id','$uid','$fullname','$comments','$role',NOW()) ");
		}

	}
	if (isset($_POST['btn_straas_up_submit_draft'])) {
		$txt_control_number = $_POST['txt_control_number'];
		$status = 2;
		$sql = mysqli_query($conn,"UPDATE `tbl_straas` SET `form_type`='$form_type',`fullname`='$fullname',`department`='$straas_up_department',`location`='$straas_up_location', `hostname`='$straas_up_search_txt',`host_port`='$straas_up_req_host_port',`host_port_comment`='$straas_up_host_port_comment',`status`='$status', date_requested = NOW() WHERE control_number = '$txt_control_number' ");
		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`, `uid`, `fullname`, `comments`, `role`,`remarks_date`) VALUES ('$form_type','$control_number','$comment_id','$uid','$fullname','$comments','$role',NOW()) ");
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
		$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid, role, fullname,form_type,control_number, activity,status) values ('$uid',  '$role', '$fullname','$form_type','$txt_control_number', 'resubmitted draft','$status') ");
		
	}
	if (isset($_POST['btn_straas_up_update'])) {
		$txt_control_number = $_POST['txt_control_number'];
		$status = 1;
		$sql = mysqli_query($conn,"UPDATE `tbl_straas` SET `form_type`='$form_type',`fullname`='$fullname',`department`='$straas_up_department',`location`='$straas_up_location', `hostname`='$straas_up_search_txt',`host_port`='$straas_up_req_host_port',`host_port_comment`='$straas_up_host_port_comment',`status`='$status', date_requested = NOW() WHERE control_number = '$txt_control_number' ");
		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`, `uid`, `fullname`, `comments`, `role`,`remarks_date`) VALUES ('$form_type','$txt_control_number','$comment_id','$uid','$fullname','$comments','$role',NOW()) ");
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
		$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid, role, fullname,form_type,control_number, activity,status) values ('$uid',  '$role', '$fullname','$form_type','$txt_control_number', 'updated','$status') ");


	}

	if (isset($_POST['btn_straas_up_resubmit'])) {
		$txt_control_number = $_POST['txt_control_number'];

		$status = 2;
		$revised = 0;
		$sql = mysqli_query($conn,"UPDATE `tbl_straas` SET `form_type`='$form_type',`fullname`='$fullname',`department`='$straas_up_department',`location`='$straas_up_location', `hostname`='$straas_up_search_txt',`host_port`='$straas_up_req_host_port',`host_port_comment`='$straas_up_host_port_comment',`status`='$status', revised = '$revised', date_requested = NOW(), approver_id = NULL, approver = NULL, app_status = NULL, appr_date = NULL, reciever_id = NULL, reciever = NULL, rec_status = NULL, rec_date = NULL, performer_id = NULL, performer = NULL, perf_status = NULL, perform_date = NULL WHERE control_number = '$txt_control_number' ");
		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`, `uid`, `fullname`, `comments`, `role`,`remarks_date`) VALUES ('$form_type','$txt_control_number','$comment_id','$uid','$fullname','$comments','$role',NOW()) ");
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

		$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid, role, fullname,form_type,control_number, activity,status) values ('$uid',  '$role', '$fullname','$form_type','$txt_control_number', 'returned','$status') ");
		$subject = "straas Returned Form";
		$message = "Hello <b>Approver</b>,<br><br>".
		"<b>".ucwords($fullname). "</b> has returned the form with control number <b>straas/".$txt_control_number."</b><br><br>".
		"Thank you"."<br><br><br><i>This message is autogenerated. Please do not respond.</i>";	
		
		require 'mail.php';
		
	}

	if (isset($_POST['btn_straas_up_cancel'])) {
		$txt_control_number = $_POST['txt_control_number'];
		$status = 0;
		$cancelled = 1;
		$sql = mysqli_query($conn,"UPDATE `tbl_straas` SET `status`='$status', cancelled = '$cancelled', date_requested = NOW() WHERE control_number = '$txt_control_number' ");	
		$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid, role, fullname,form_type,control_number, activity,status) values ('$uid',  '$role', '$fullname','$form_type','$txt_control_number', 'canceled','$status') ");
	}

}

if (isset($_REQUEST['control_number']) && isset($_REQUEST['f_type']) && isset($_REQUEST['uid'])) {

	$txt_control_number = $_REQUEST['control_number'];
	$status = 0;
	$cancelled = 1;
	$uid = $_REQUEST['uid'];
	$form_type = $_REQUEST['f_type'];
	$sql = mysqli_query($conn,"UPDATE `tbl_straas` SET `status`='$status', cancelled = '$cancelled', date_requested = NOW() WHERE control_number = '$txt_control_number' ");
	$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid, role, fullname,form_type,control_number, activity,status) values ('$uid',  '$role', '$fullname','$form_type','$txt_control_number', 'canceled','$status') ");
	if ($sql) {
		header("location: ../pending_request.php");
		mysqli_close($conn);
	}		
	
}


?>