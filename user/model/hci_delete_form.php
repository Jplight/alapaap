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
	$hci_del_search_txt = $_POST['hci_del_search_txt'];

	$hci_new_control_num = $_POST['hci_new_control_num'];
	$hci_up_control_num = $_POST['hci_up_control_num'];

	$form_type = '1-2'; 
	$comments = $_POST['comments'];
	$role = $_POST['his_role'];
	$comment_id = rand(100000,999999);

	if (isset($_POST['btn_submit_hci_del'])) {
		$status = 2;
		$control_number = $concatnumber;
		$sql = mysqli_query($conn,"INSERT INTO `tbl_hci` (`uid`, `control_number`, `form_type`, `fullname`, `email_add`, `contact_no`, `hostname`, `hci_new_control_num`, `hci_up_control_num`,`status`, `date_requested`) VALUES ('$uid','$control_number', '$form_type','$fullname','$email_add','$contact_no','$hci_del_search_txt', '$hci_new_control_num', '$hci_up_control_num','$status',NOW()) ");

		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`, `uid`, `fullname`, `comments`, `role`,`remarks_date`) VALUES ('$form_type','$control_number','$comment_id','$uid','$fullname','$comments','$role',NOW()) ");
		}
		$_SESSION['message'] = "Successfuly Created!";
		$_SESSION['form_type'] = $form_type;
		$_SESSION['control_number'] = $control_number;

		$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$control_number', 'created','$status') ");
		
		if ($sql) {
			header("location: index.php");
			mysqli_close($conn);
		}

		$form_subject = "HCI Delete";
		require 'mail_message.php';
		require 'mail.php';
		
	}
	
	if (isset($_POST['btn_save_hci_del'])) {
		$status = 1;
		$control_number = $concatnumber;
		$sql = mysqli_query($conn,"INSERT INTO `tbl_hci` (`uid`, `control_number`, `form_type`, `fullname`, `email_add`, `contact_no`, `hostname`, `hci_new_control_num`, `hci_up_control_num`,`status`, `date_requested`) VALUES ('$uid','$control_number', '$form_type','$fullname','$email_add','$contact_no','$hci_del_search_txt', '$hci_new_control_num', '$hci_up_control_num','$status',NOW()) ");

		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`, `uid`, `fullname`, `comments`, `role`,`remarks_date`) VALUES ('$form_type','$control_number','$comment_id','$uid','$fullname','$comments','$role',NOW()) ");
		}

		$_SESSION['message'] = "Successfuly Created!";
		$_SESSION['form_type'] = $form_type;
		$_SESSION['control_number'] = $control_number;
		$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$control_number', 'save as draft','$status') ");
		if ($sql) {
			header("location: index.php");
			mysqli_close($conn);
		}	
	
	}
	if (isset($_POST['btn_hci_del_submit_draft'])) {
		$txt_control_number = $_POST['txt_control_number'];
		$status = 2;
		$sql = mysqli_query($conn,"UPDATE `tbl_hci` SET `form_type`='$form_type',`fullname`='$fullname',`hostname`='$hci_del_search_txt',`status`='$status', date_requested = NOW() WHERE control_number = '$txt_control_number' ");
		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`, `uid`, `fullname`, `comments`, `role`,`remarks_date`) VALUES ('$form_type','$control_number','$comment_id','$uid','$fullname','$comments','$role',NOW()) ");
		}
		$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$txt_control_number', 'resubmitted draft','$status') ");		
		if ($sql) {
			header("location: index.php");
			mysqli_close($conn);
		}	
	}
	if (isset($_POST['btn_hci_del_update'])) {
		$txt_control_number = $_POST['txt_control_number'];
		$status = 1;
		$sql = mysqli_query($conn,"UPDATE `tbl_hci` SET `form_type`='$form_type',`fullname`='$fullname',`hostname`='$hci_del_search_txt',`status`='$status', date_requested = NOW() WHERE control_number = '$txt_control_number' ");
		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`, `uid`, `fullname`, `comments`, `role`,`remarks_date`) VALUES ('$form_type','$txt_control_number','$comment_id','$uid','$fullname','$comments','$role',NOW()) ");
		}	
		$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$txt_control_number', 'updated','$status') ");		
		if ($sql) {
			header("location: draft_form.php");
			mysqli_close($conn);
		}
	}

	if (isset($_POST['btn_hci_del_resubmit'])) {

		$txt_control_number = $_POST['txt_control_number'];
		$status = 2;
		$revised = 0;

		$sql = mysqli_query($conn,"UPDATE `tbl_hci` SET `form_type`='$form_type',`fullname`='$fullname', `hostname`='$hci_del_search_txt',`status`='$status', revised = '$revised',  date_requested = NOW(), approver_id = NULL, approver = NULL, app_status = NULL, appr_date = NULL, reciever_id = NULL, reciever = NULL, rec_status = NULL, rec_date = NULL, performer_id = NULL, performer = NULL, perf_status = NULL, perform_date = NULL WHERE control_number = '$txt_control_number' ");
		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`, `uid`, `fullname`, `comments`, `role`,`remarks_date`) VALUES ('$form_type','$txt_control_number','$comment_id','$uid','$fullname','$comments','$role',NOW()) ");
		}

		$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$txt_control_number', 'returned','$status') ");			
		if ($sql) {
			header("location: index.php");
			mysqli_close($conn);
		}
	}

	if (isset($_POST['btn_hci_del_cancel'])) {
		$txt_control_number = $_POST['txt_control_number'];
		$status = 0;
		$cancelled = 1;
		$sql = mysqli_query($conn,"UPDATE `tbl_hci` SET `status`='$status', cancelled = '$cancelled', date_requested = NOW() WHERE control_number = '$txt_control_number' ");

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
	$sql = mysqli_query($conn,"UPDATE `tbl_hci` SET `status`='$status', cancelled = '$cancelled', date_requested = NOW() WHERE control_number = '$txt_control_number' ");
	
	$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$fullname','$form_type','$txt_control_number', 'canceled','$status') ");		
	if ($sql) {
		header("location: ../pending_request.php");
		mysqli_close($conn);
	}
}


?>