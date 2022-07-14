<?php  

include 'connection.php';

	$generate_key = date('Y').date('m').date('d')."00001"; 

	$sql_uid = mysqli_query($conn,"SELECT * FROM tbl_tci ORDER BY id DESC LIMIT 1 ");

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
	$department =$_POST['department'];
	$cluster = $_POST['cluster'];
	$location = $_POST['location'];

	$prob_descript = $_POST['prob_descript'];
	$act_taken = $_POST['act_taken'];
	$act_status = $_POST['act_status'];
	$remarks = $_POST['remarks'];
	$comments = $_POST['comments'];
	$role = $_POST['his_role'];
	$comment_id = rand(100000,999999);
	$form_type = 2;

	if (isset($_POST['btn_submit_tci'])) {
		$control_number = $concatnumber;
		$status = 3;
		$sql = mysqli_query($conn,"INSERT INTO `tbl_tci`(`uid`, `control_number`, `form_type`, `fullname`, `email_add`, `contact_no`, `department`, `cluster`, `location`, `prob_descript`, `act_taken`, `act_status`, `remarks`, `status`, `date_requested`) VALUES ('$uid','$control_number','$form_type','$fullname','$email_add','$contact_no','$department','$cluster','$location','$prob_descript','$act_taken','$act_status','$remarks','$status',NOW()) ");
		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`, `uid`, `fullname`, `comments`, `role`,`remarks_date`) VALUES ('$form_type','$control_number','$comment_id','$uid','$fullname','$comments','$role',NOW()) ");
		}	

		$_SESSION['form_type'] = $form_type;
		$_SESSION['control_number'] = $control_number;
		$_SESSION['message'] = "Successfuly Created!";	
		$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$control_number', 'created','$status') ");

		$form_subject = "Adhoc";
		require 'mail_message.php';
		require 'mail.php';

	}
	if (isset($_POST['btn_save_tci'])) {
		$control_number = $concatnumber;
		$status = 1;
		$sql = mysqli_query($conn,"INSERT INTO `tbl_tci`(`uid`, `control_number`, `form_type`, `fullname`, `email_add`, `contact_no`, `department`, `cluster`, `location`, `prob_descript`, `act_taken`, `act_status`, `remarks`, `status`, `date_requested`) VALUES ('$uid','$control_number','$form_type','$fullname','$email_add','$contact_no','$department','$cluster','$location','$prob_descript','$act_taken','$act_status','$remarks','$status',NOW()) ");
		if (!empty($comments)) {
				$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`, `uid`, `fullname`, `comments`, `role`,`remarks_date`) VALUES ('$form_type','$control_number','$comment_id','$uid','$fullname','$comments','$role',NOW()) ");
		}
		$_SESSION['form_type'] = $form_type;
		$_SESSION['control_number'] = $control_number;
		$_SESSION['message'] = "Successfuly Created!";
		$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$control_number', 'save as draft','$status') ");	
	}
	if (isset($_POST['btn_update_tci'])) {
		$txt_control_number = $_POST['txt_control_number'];
		$status = 1;
		$sql = mysqli_query($conn,"UPDATE `tbl_tci` SET `department`='$department',`cluster`='$cluster',`location`='$location',`prob_descript`='$prob_descript',`act_taken`='$act_taken',`act_status`='$act_status',`remarks`='$remarks',`status`='$status',`date_requested`= NOW() WHERE `control_number`='$txt_control_number'");
		if (!empty($comments)) {
				$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`, `uid`, `fullname`, `comments`, `role`,`remarks_date`) VALUES ('$form_type','$txt_control_number','$comment_id','$uid','$fullname','$comments','$role',NOW()) ");
		}
		if ($sql) {
			header("location: draft_form.php");
		}
		$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$txt_control_number', 'updated','$status') ");		
	}
	if (isset($_POST['btn_resubmit_tci_draft'])) {
		$txt_control_number = $_POST['txt_control_number'];
		$status = 3;
		$sql = mysqli_query($conn,"UPDATE `tbl_tci` SET `department`='$department',`cluster`='$cluster',`location`='$location',`prob_descript`='$prob_descript',`act_taken`='$act_taken',`act_status`='$act_status',`remarks`='$remarks',`status`='$status',`date_requested`= NOW() WHERE `control_number`='$txt_control_number'");
		if (!empty($comments)) {
				$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`, `uid`, `fullname`, `comments`, `role`,`remarks_date`) VALUES ('$form_type','$txt_control_number','$comment_id','$uid','$fullname','$comments','$role',NOW()) ");
		}
		if ($sql) {
			header("location: draft_form.php");
		}
		$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$txt_control_number', 'resubmitted','$status') ");	
	}

	if (isset($_POST['btn_resubmit_tci'])) {
		$txt_control_number = $_POST['txt_control_number'];

		$status = 3;
		$revised = 0;
		$sql = mysqli_query($conn,"UPDATE `tbl_tci` SET `department`='$department',`cluster`='$cluster',`location`='$location',`prob_descript`='$prob_descript',`act_taken`='$act_taken',`act_status`='$act_status',`remarks`='$remarks',`status`='$status', `revised` = '$revised', `date_requested`= NOW(), reciever_id = NULL, reciever = NULL, rec_status = NULL, rec_date = NULL, performer_id = NULL, performer = NULL, perf_status = NULL, perform_date = NULL WHERE `control_number`='$txt_control_number'");
		if (!empty($comments)) {
				$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`, `uid`, `fullname`, `comments`, `role`,`remarks_date`) VALUES ('$form_type','$txt_control_number','$comment_id','$uid','$fullname','$comments','$role',NOW()) ");
		}
		$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$txt_control_number', 'returned','$status') ");	
	}

	if (isset($_POST['btn_cancel'])) {
		$txt_control_number = $_POST['txt_control_number'];
		$status = 0;
		$cancelled = 1;
		$sql = mysqli_query($conn,"UPDATE `tbl_tci` SET `status`='$status', cancelled = '$cancelled', date_requested = NOW() WHERE control_number = '$txt_control_number' ");
		$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$txt_control_number', 'canceled','$status') ");	
	}
	mysqli_close($conn);
}

if (isset($_REQUEST['control_number']) && isset($_REQUEST['f_type']) && isset($_REQUEST['uid'])) {

	$txt_control_number = $_REQUEST['control_number'];
	$status = 0;
	$cancelled = 1;
	$uid = $_REQUEST['uid'];
	$form_type = $_REQUEST['f_type'];
	$sql = mysqli_query($conn,"UPDATE `tbl_tci` SET `status`='$status', cancelled = '$cancelled', date_requested = NOW() WHERE control_number = '$txt_control_number' ");
	$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$txt_control_number', 'canceled','$status') ");	
	if ($sql) {
		header("location: ../pending_request.php");
		mysqli_close($conn);
	}		
	
}












?>