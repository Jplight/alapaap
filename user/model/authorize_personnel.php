<?php  

// app_status = 1 means True;
// app_status = 0 means false;

include 'connection.php';

 // ====== For Approver ======
if (isset($_POST['btn_approver'])) {
	$approver_name = $_POST['approver_name'];
	$approver_id = $_POST['approver_id'];
	$txt_control_number = $_POST['txt_control_number'];
	$comments = $_POST['comments'];
	$role = $_POST['his_role'];
	$form_type = $_POST['form_type'];
	$status = 3;
	$app_status = 1;
	$comment_id = rand(100000,999999);
	$his_uid = $_POST['his_uid'];

	if ($_POST['form_type'] == 1 || $_POST['form_type'] == '1-1' || $_POST['form_type'] == '1-2') {
		$sql = mysqli_query($conn,"UPDATE tbl_hci set status = '$status', approver_id = '$approver_id', approver = '$approver_name', app_status = '$app_status', appr_date = NOW() where control_number = '$txt_control_number' ");
		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`,`uid`, `fullname`, `comments`, `role`,`remarks_date`) VALUES ('$form_type','$txt_control_number','$comment_id','$uid','$approver_name','$comments', '$role', NOW()) ");
		}
		$form_subject = "HCI ";	
	}
	if ($_POST['form_type'] == 3 || $_POST['form_type'] == '3-1' || $_POST['form_type'] == '3-2' ) {
		$sql = mysqli_query($conn,"UPDATE tbl_cps set status = '$status', approver_id = '$approver_id', approver = '$approver_name', app_status = '$app_status', appr_date = NOW() where control_number = '$txt_control_number' ");
		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`,`uid`, `fullname`, `comments`, `role`,`remarks_date`) VALUES ('$form_type','$txt_control_number','$comment_id','$uid','$approver_name','$comments', '$role', NOW()) ");
		}
		$form_subject = "CPS";	
	}

	if ($_POST['form_type'] == 4 || $_POST['form_type'] == '4-2') {
		$sql = mysqli_query($conn,"UPDATE tbl_baas set status = '$status', approver_id = '$approver_id', approver = '$approver_name', app_status = '$app_status', appr_date = NOW() where control_number = '$txt_control_number' ");	
		$form_subject = "BaaS";
	}
	
	$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$uid', '$my_fullname','$form_type','$txt_control_number', 'approved','$status') ");

	// $alert = '<div class="alert alert-success alert-dismissible fade show" id="alert" role="alert">'.
	// '<i class="fa-fw fas fa-check-circle me-2"></i><strong>Succesfully Approved!</strong>'.
	// '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'.
	// '</div>';

	// $_SESSION['message'] = $alert;

	require 'mail_message.php';
	require 'mail.php';

	header("location: http://".$_SERVER['SERVER_NAME']."/user/pending_request.php");

}

if (isset($_POST['app_disapproved'])) {
	$approver_name = $_POST['approver_name'];
	$approver_id = $_POST['approver_id'];
	$txt_control_number = $_POST['txt_control_number'];
	$comments = $_POST['comments'];
	$role = $_POST['his_role'];
	$form_type = $_POST['form_type'];
	$status = 0;
	$app_status = 0;
	$revised = null;
	$num_revised = null;
	$comment_id = rand(100000,999999);
	if ($_POST['form_type'] == 1 || $_POST['form_type'] == '1-1' || $_POST['form_type'] == '1-2') {
		$sql = mysqli_query($conn,"UPDATE tbl_hci set status = '$status', revised = null, num_revised = null, approver_id = '$approver_id', approver = '$approver_name', app_status = '$app_status', appr_date = NOW() where control_number = '$txt_control_number' ");
		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`,`uid`, `fullname`, `comments`, `role`, `remarks_date`) VALUES ('$form_type','$txt_control_number','$comment_id','$uid','$approver_name','$comments', '$role', NOW()) ");
		}		
		$form_subject = "HCI";	
	}
	if ($_POST['form_type'] == 3 || $_POST['form_type'] == '3-1' || $_POST['form_type'] == '3-2' ) {
		$sql = mysqli_query($conn,"UPDATE tbl_cps set status = '$status', revised = null, num_revised = null, approver_id = '$approver_id', approver = '$approver_name', app_status = '$app_status', appr_date = NOW() where control_number = '$txt_control_number' ");
		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`,`uid`, `fullname`, `comments`, `role`, `remarks_date`) VALUES ('$form_type','$txt_control_number','$comment_id','$uid','$approver_name','$comments', '$role', NOW()) ");
		}		
		$form_subject = "CPS";	
	}
	if ($_POST['form_type'] == 4 || $_POST['form_type'] == '4-2') {
		$sql = mysqli_query($conn,"UPDATE tbl_baas set status = '$status', revised = null, num_revised = null, approver_id = '$approver_id', approver = '$approver_name', app_status = '$app_status', appr_date = NOW() where control_number = '$txt_control_number' ");	
		$form_subject = "BaaS";	
	}

	$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$approver_id', '$my_fullname','$form_type','$txt_control_number', 'disapproved','$status') ");

}

if (isset($_POST['approver_returned'])) {
	$his_uid = $_POST['his_uid'];
	$recipient = $_POST['form_owner_mail'];
	$approver_name = $_POST['approver_name'];
	$approver_id = $_POST['approver_id'];
	$txt_control_number = $_POST['txt_control_number'];
	$num_revised	= intval($_POST['num_revised']) + 1;
	$comments = $_POST['comments'];
	$role = $_POST['his_role'];
	$form_type = $_POST['form_type'];
	$status = 0;
	$app_status = 0;
	$revised = 1;
	$comment_id = rand(100000,999999);
	if ($_POST['form_type'] == 1 || $_POST['form_type'] == '1-1' || $_POST['form_type'] == '1-2') {
		$sql = mysqli_query($conn,"UPDATE tbl_hci set status = '$status', revised = '$revised', num_revised = '$num_revised' ,approver_id = '$approver_id', approver = '$approver_name', app_status = '$app_status', appr_date = NOW() where control_number = '$txt_control_number' ");
		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`,`uid`, `fullname`, `comments`, `role`,`remarks_date`) VALUES ('$form_type','$txt_control_number','$comment_id','$uid','$approver_name','$comments', '$role', NOW()) ");
		}
		$fType = "HCI";		
	}
	if ($_POST['form_type'] == 3 || $_POST['form_type'] == '3-1' || $_POST['form_type'] == '3-2' ) {
		$sql = mysqli_query($conn,"UPDATE tbl_cps set status = '$status', revised = '$revised', num_revised = '$num_revised' ,approver_id = '$approver_id', approver = '$approver_name', app_status = '$app_status', appr_date = NOW() where control_number = '$txt_control_number' ");
		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`,`uid`, `fullname`, `comments`, `role`,`remarks_date`) VALUES ('$form_type','$txt_control_number','$comment_id','$uid','$approver_name','$comments', '$role', NOW()) ");
		}	
		$fType = "CPS";	
	}
	if ($_POST['form_type'] == 4 || $_POST['form_type'] == '4-2') {
		$sql = mysqli_query($conn,"UPDATE tbl_baas set status = '$status', revised = '$revised', num_revised = '$num_revised' ,approver_id = '$approver_id', approver = '$approver_name', app_status = '$app_status', appr_date = NOW() where control_number = '$txt_control_number' ");	
		$fType = "BaaS";
	}

	$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$approver_id', '$my_fullname','$form_type','$txt_control_number', 'returned','$status') ");
	$notification = mysqli_query($conn, "INSERT INTO tbl_notification (uid,fullname,form_type,control_number, activity,status,isViewed) values ('$his_uid', '$my_fullname','$form_type','$txt_control_number', 'returned','$status','0') ");
	
	$message = "Hi <b>".ucwords($fullname)."</b>,<br><br>".
	"<b>".ucwords($approver_name). "</b> has returned your request with control number <b>".$fType."/".$txt_control_number."</b><br><br>".
	"Thank you"."<br><br><br><i>This message is autogenerated. Please do not respond.</i>";
	$subject = "Returned Form"; 
	
	require 'mail.php';	

}
 // ====== For Approver ======


 // ====== For Reciever ======
if (isset($_POST['btn_reciever'])) {
	$reciever_name = $_POST['reciever_name'];
	$reciever_id = $_POST['reciever_id'];
	$txt_control_number = $_POST['txt_control_number'];
	$comments = $_POST['comments'];
	$role = $_POST['his_role'];
	$form_type = $_POST['form_type'];
	$status = 4;
	$rec_status = 1;
	$comment_id = rand(100000,999999);
	$his_uid = $_POST['his_uid'];

	if ($_POST['form_type'] == 1 || $_POST['form_type'] == '1-1' || $_POST['form_type'] == '1-2') { 
		$sql = mysqli_query($conn,"UPDATE tbl_hci set status = '$status', reciever_id = '$reciever_id', reciever = '$reciever_name', rec_status = '$rec_status', rec_date = NOW() where control_number = '$txt_control_number' ");
		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`,`uid`, `fullname`, `comments`, `role`,`remarks_date`) VALUES ('$form_type','$txt_control_number','$comment_id','$uid','$reciever_name','$comments','$role' ,NOW()) ");
		}	
		$form_subject = "HCI";
	}
	if ($_POST['form_type'] == 2) {
		$sql = mysqli_query($conn,"UPDATE tbl_tci set status = '$status', reciever_id = '$reciever_id', reciever = '$reciever_name', rec_status = '$rec_status', rec_date = NOW() where control_number = '$txt_control_number' ");	
		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`,`uid`, `fullname`, `comments`, `role`,`remarks_date`) VALUES ('$form_type','$txt_control_number','$comment_id','$uid','$reciever_name','$comments','$role' ,NOW()) ");
		}
		$form_subject = "Adhoc";
	}
	if ($_POST['form_type'] == 3 || $_POST['form_type'] == '3-1' || $_POST['form_type'] == '3-2' ) {
		$sql = mysqli_query($conn,"UPDATE tbl_cps set status = '$status', reciever_id = '$reciever_id', reciever = '$reciever_name', rec_status = '$rec_status', rec_date = NOW() where control_number = '$txt_control_number' ");
		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`,`uid`, `fullname`, `comments`, `role`,`remarks_date`) VALUES ('$form_type','$txt_control_number','$comment_id','$uid','$reciever_name','$comments','$role' ,NOW()) ");
		}	
		$form_subject = "CPS";
	}
	if ($_POST['form_type'] == 4 || $_POST['form_type'] == '4-2') {
		$sql = mysqli_query($conn,"UPDATE tbl_baas set status = '$status', reciever_id = '$reciever_id', reciever = '$reciever_name', rec_status = '$rec_status', rec_date = NOW() where control_number = '$txt_control_number' ");	
		$form_subject = "BaaS";
	}
	

	$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$reciever_id', '$my_fullname','$form_type','$txt_control_number', 'approved','$status') ");
	$notification = mysqli_query($conn, "INSERT INTO tbl_notification (uid,fullname,form_type,control_number, activity,status,isViewed) values ('$his_uid', '$my_fullname','$form_type','$control_number', 'received','$status','0') ");

	require 'mail_message.php';
	require 'mail.php';	

}

if (isset($_POST['rec_disapproved'])) {
	$reciever_name = $_POST['reciever_name'];
	$reciever_id = $_POST['reciever_id'];
	$num_revised	= intval($_POST['num_revised']) + 1;
	$txt_control_number = $_POST['txt_control_number'];
	$comments = $_POST['comments'];
	$role = $_POST['his_role'];
	$form_type = $_POST['form_type'];
	$status = 0;
	$revised = 1;
	$rec_status = 0;
	$comment_id = rand(100000,999999);
	if ($_POST['form_type'] == 1 || $_POST['form_type'] == '1-1' || $_POST['form_type'] == '1-2') {
		$sql = mysqli_query($conn,"UPDATE tbl_hci set status = '$status', revised = '$revised', num_revised = '$num_revised', reciever_id = '$reciever_id', reciever = '$reciever_name', rec_status = '$rec_status', rec_date = NOW() where control_number = '$txt_control_number' ");
		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`,`uid`, `fullname`, `comments`, `role`,`remarks_date`) VALUES ('$form_type','$txt_control_number','$comment_id','$uid','$reciever_name','$comments', '$role',NOW()) ");
		}	
	}
	if ($_POST['form_type'] == 2) {
		$sql = mysqli_query($conn,"UPDATE tbl_tci set status = '$status', revised = '$revised', num_revised = '$num_revised' ,reciever_id = '$reciever_id', reciever = '$reciever_name', rec_status = '$rec_status', rec_date = NOW() where control_number = '$txt_control_number' ");	
		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`,`uid`, `fullname`, `comments`, `role`,`remarks_date`) VALUES ('$form_type','$txt_control_number','$comment_id','$uid','$reciever_name','$comments','$role' ,NOW()) ");
		}
	}
	if ($_POST['form_type'] == 3 || $_POST['form_type'] == '3-1' || $_POST['form_type'] == '3-2' ) {
		$sql = mysqli_query($conn,"UPDATE tbl_cps set status = '$status', revised = '$revised', num_revised = '$num_revised', reciever_id = '$reciever_id', reciever = '$reciever_name', rec_status = '$rec_status', rec_date = NOW() where control_number = '$txt_control_number' ");
		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`,`uid`, `fullname`, `comments`, `role`,`remarks_date`) VALUES ('$form_type','$txt_control_number','$comment_id','$uid','$reciever_name','$comments', '$role',NOW()) ");
		}	
	}
	if ($_POST['form_type'] == 4 || $_POST['form_type'] == '4-2') {
		$sql = mysqli_query($conn,"UPDATE tbl_baas set status = '$status', revised = '$revised', num_revised = '$num_revised' ,reciever_id = '$reciever_id', reciever = '$reciever_name', rec_status = '$rec_status', rec_date = NOW() where control_number = '$txt_control_number' ");	
	}	


	$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$reciever_id', '$my_fullname','$form_type','$txt_control_number', 'disapproved','$status') ");
}
 // ====== For Reciever ======

 // ====== For Performer ======
if (isset($_POST['btn_performer'])) {
	$performer_name = $_POST['performer_name'];
	$performer_id = $_POST['performer_id'];
	$txt_control_number = $_POST['txt_control_number'];
	$comments = $_POST['comments'];
	$role = $_POST['his_role'];
	$form_type = $_POST['form_type'];
	$status = 5;
	$perf_status = 1;
	$comment_id = rand(100000,999999);
	$his_uid = $_POST['his_uid'];

	if ($_POST['form_type'] == 1 || $_POST['form_type'] == '1-1' || $_POST['form_type'] == '1-2') {
		$sql = mysqli_query($conn,"UPDATE tbl_hci set status = '$status', performer_id = '$performer_id', performer = '$performer_name', perf_status = '$perf_status', perform_date = NOW() where control_number = '$txt_control_number' ");
		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`,`uid`, `fullname`, `comments`, `role`,`remarks_date`) VALUES ('$form_type','$txt_control_number','$comment_id','$uid','$performer_name','$comments','$role' ,NOW()) ");
		}	
		$form_subject = "HCI";
	}
	if ($_POST['form_type'] == 2) {
		$sql = mysqli_query($conn,"UPDATE tbl_tci set status = '$status', performer_id = '$performer_id', performer = '$performer_name', perf_status = '$perf_status', perform_date = NOW() where control_number = '$txt_control_number' ");	
		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`,`uid`, `fullname`, `comments`, `role`,`remarks_date`) VALUES ('$form_type','$txt_control_number','$comment_id','$uid','$performer_name','$comments','$role' ,NOW()) ");
		}
		$form_subject = "Adhoc";
	}
	if ($_POST['form_type'] == 3 || $_POST['form_type'] == '3-1' || $_POST['form_type'] == '3-2' ) {
		$sql = mysqli_query($conn,"UPDATE tbl_cps set status = '$status', performer_id = '$performer_id', performer = '$performer_name', perf_status = '$perf_status', perform_date = NOW() where control_number = '$txt_control_number' ");
		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`,`uid`, `fullname`, `comments`, `role`,`remarks_date`) VALUES ('$form_type','$txt_control_number','$comment_id','$uid','$performer_name','$comments','$role' ,NOW()) ");
		}
		$form_subject = "CPS";	
	}
	if ($_POST['form_type'] == 4 || $_POST['form_type'] == '4-2') {
		$sql = mysqli_query($conn,"UPDATE tbl_baas set status = '$status', performer_id = '$performer_id', performer = '$performer_name', perf_status = '$perf_status', perform_date = NOW() where control_number = '$txt_control_number' ");	
		$form_subject = "BaaS";
	}	

	$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$performer_id', '$my_fullname','$form_type','$txt_control_number', 'performed','$status') ");
	$notification = mysqli_query($conn, "INSERT INTO tbl_notification (uid,fullname,form_type,control_number, activity,status,isViewed) values ('$his_uid', '$my_fullname','$form_type','$control_number', 'performed','$status','0') ");

	require 'mail_message.php';
	require 'mail.php';	

}
if (isset($_POST['performer_disapproved'])) {
	$performer_name = $_POST['performer_name'];
	$performer_id = $_POST['performer_id'];
	$num_revised	= intval($_POST['num_revised']) + 1;
	$txt_control_number = $_POST['txt_control_number'];
	$comments = $_POST['comments'];
	$role = $_POST['his_role'];
	$form_type = $_POST['form_type'];
	$status = 0;
	$revised = 1;
	$perf_status = 0;
	$comment_id = rand(100000,999999);
	if ($_POST['form_type'] == 1 || $_POST['form_type'] == '1-1' || $_POST['form_type'] == '1-2') {
		$sql = mysqli_query($conn,"UPDATE tbl_hci set status = '$status', revised = '$revised', num_revised = '$num_revised', performer_id = '$performer_id', performer = '$performer_name', perf_status = '$perf_status', perform_date = NOW() where control_number = '$txt_control_number' ");
		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`,`uid`, `fullname`, `comments`, `role`,`remarks_date`) VALUES ('$form_type','$txt_control_number','$comment_id','$uid','$performer_name','$comments', '$role',NOW()) ");
		}
		$form_subject = "HCI";	
	}
	if ($_POST['form_type'] == 2) {
		$sql = mysqli_query($conn,"UPDATE tbl_tci set status = '$status', revised = '$revised', num_revised = '$num_revised' ,performer_id = '$performer_id', performer = '$performer_name', perf_status = '$perf_status', perform_date = NOW() where control_number = '$txt_control_number' ");	
		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`,`uid`, `fullname`, `comments`, `role`,`remarks_date`) VALUES ('$form_type','$txt_control_number','$comment_id','$uid','$performer_name','$comments','$role' ,NOW()) ");
		}
		$form_subject = "Adhoc";
	}
	if ($_POST['form_type'] == 3 || $_POST['form_type'] == '3-1' || $_POST['form_type'] == '3-2' ) {
		$sql = mysqli_query($conn,"UPDATE tbl_cps set status = '$status', revised = '$revised', num_revised = '$num_revised', performer_id = '$performer_id', performer = '$performer_name', perf_status = '$perf_status', perform_date = NOW() where control_number = '$txt_control_number' ");
		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`,`uid`, `fullname`, `comments`, `role`,`remarks_date`) VALUES ('$form_type','$txt_control_number','$comment_id','$uid','$performer_name','$comments', '$role',NOW()) ");
		}	
		$form_subject = "CPS";
	}
	if ($_POST['form_type'] == 4 || $_POST['form_type'] == '4-2') {
		$sql = mysqli_query($conn,"UPDATE tbl_baas set status = '$status', revised = '$revised', performer_id = '$performer_id', performer = '$performer_name', perf_status = '$perf_status', perform_date = NOW() where control_number = '$txt_control_number' ");	
		$form_subject = "BaaS";
	}

	$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$performer_id', '$my_fullname','$form_type','$txt_control_number', 'disapproved','$status') ");
	$notification = mysqli_query($conn, "INSERT INTO tbl_notification (uid,fullname,form_type,control_number, activity,status,isViewed) values ('$his_uid', '$my_fullname','$form_type','$txt_control_number', 'confirmed','$status','0') ");

	require 'mail_message.php';
	require 'mail.php';	
}
 // ====== For Performer ======


// ====== For Confirmer ======
if (isset($_POST['btn_confirmer'])) {
	$verifier_name = $_POST['verifier_name'];
	$verifier_id = $_POST['verifier_id'];
	$txt_control_number = $_POST['txt_control_number'];
	$comments = $_POST['comments'];
	$role = $_POST['his_role'];
	$form_type = $_POST['form_type'];
	$status = 6;
	$ver_status = 1;
	$comment_id = rand(100000,999999);
	$his_uid = $_POST['his_uid'];

	if ($_POST['form_type'] == 1 || $_POST['form_type'] == '1-1' || $_POST['form_type'] == '1-2') {
		$sql = mysqli_query($conn,"UPDATE tbl_hci set status = '$status', verifier_id = '$verifier_id', verifier = '$verifier_name', ver_status = '$ver_status', ver_date = NOW() where control_number = '$txt_control_number' ");
		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`,`uid`, `fullname`, `comments`, `role`,`remarks_date`) VALUES ('$form_type','$txt_control_number','$comment_id','$uid','$verifier_name','$comments', '$role',NOW()) ");
		}
		$form_subject = "HCI";		
	}
	if ($_POST['form_type'] == 2) {
		$sql = mysqli_query($conn,"UPDATE tbl_tci set status = '$status', verifier_id = '$verifier_id', verifier = '$verifier_name', ver_status = '$ver_status', ver_date = NOW() where control_number = '$txt_control_number' ");	
		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`,`uid`, `fullname`, `comments`, `role`,`remarks_date`) VALUES ('$form_type','$txt_control_number','$comment_id','$uid','$verifier_name','$comments','$role' ,NOW()) ");
		}
		$form_subject = "Adhoc";
	}
	if ($_POST['form_type'] == 3 || $_POST['form_type'] == '3-1' || $_POST['form_type'] == '3-2' ) {
		$sql = mysqli_query($conn,"UPDATE tbl_cps set status = '$status', verifier_id = '$verifier_id', verifier = '$verifier_name', ver_status = '$ver_status', ver_date = NOW() where control_number = '$txt_control_number' ");
		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`,`uid`, `fullname`, `comments`, `role`,`remarks_date`) VALUES ('$form_type','$txt_control_number','$comment_id','$uid','$verifier_name','$comments', '$role',NOW()) ");
		}		
		$form_subject = "CPS";
	}
	if ($_POST['form_type'] == 4 || $_POST['form_type'] == '4-2') {
		$sql = mysqli_query($conn,"UPDATE tbl_baas set status = '$status', verifier_id = '$verifier_id', verifier = '$verifier_name', ver_status = '$ver_status', ver_date = NOW() where control_number = '$txt_control_number' ");	
		$form_subject = "BaaS";
	}	

	$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$verifier_id', '$my_fullname','$form_type','$txt_control_number', 'confirmed','$status') ");
	$notification = mysqli_query($conn, "INSERT INTO tbl_notification (uid,fullname,form_type,control_number, activity,status,isViewed) values ('$his_uid', '$my_fullname','$form_type','$txt_control_number', 'confirmed','$status','0') ");

	require 'mail_message.php';
	require 'mail.php';	

}
// ====== For Confirmer ======

// ====== For Verifier ======
if (isset($_POST['btn_verifier'])) {
	$form_owner_mail = $_POST['form_owner_mail'];
	$verifier_2_name = $_POST['verifier_2_name'];
	$verifier_2id = $_POST['verifier_2id'];
	$txt_control_number = $_POST['txt_control_number'];
	$hci_del_search_txt = $_POST['hci_del_search_txt'];
	$cps_del_search_txt = $_POST['cps_del_search_txt'];

	$comments = $_POST['comments'];
	$role = $_POST['his_role'];
	$form_type = $_POST['form_type'];
	$status = 7;
	$ver2_status = 1;
	$comment_id = rand(100000,999999);
	$his_uid = $_POST['his_uid'];

	if ($_POST['form_type'] == 1 || $_POST['form_type'] == '1-1' || $_POST['form_type'] == '1-2') {
		$sql = mysqli_query($conn,"UPDATE tbl_hci set status = '$status', verifier_2id = '$verifier_2id', verifier_2 = '$verifier_2_name', ver2_status = '$ver2_status', ver2_date = NOW() where control_number = '$txt_control_number' ");
		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`,`uid`, `fullname`, `comments`, `role`,`remarks_date`) VALUES ('$form_type','$txt_control_number','$comment_id','$uid','$verifier_2_name','$comments', '$role' ,NOW()) ");
		}
		// this query is activated when forms is HCI Deleted forms
		$sql_hostname = mysqli_query($conn,"UPDATE tbl_hostname set action = 'deleted' where hostname = '$hci_del_search_txt' ");		

        if (!empty($_POST['others_1'])) {
        	$disk = count($_POST['others_1']);
	        for ($i = 0; $i < $disk ; $i++) {
	        	$query = "UPDATE tbl_forms_others set status = '1' where control_number = '$txt_control_number'  ";
	        	$insert_query = mysqli_query($conn,$query);
	        }      
        }// with the table form others, it will update the status into 1, after fully verified by the verifier
		$form_subject = "HCI";

	}
	if ($_POST['form_type'] == 2) {
		$sql = mysqli_query($conn,"UPDATE tbl_tci set status = '$status', verifier_2id = '$verifier_2id', verifier_2 = '$verifier_2_name', ver2_status = '$ver2_status', ver2_date = NOW() where control_number = '$txt_control_number' ");
		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`,`uid`, `fullname`, `comments`, `role`,`remarks_date`) VALUES ('$form_type','$txt_control_number','$comment_id','$uid','$verifier_2_name','$comments','$role' ,NOW()) ");
		}
		$form_subject = "Adhoc";
	}
	if ($_POST['form_type'] == 3 || $_POST['form_type'] == '3-1' || $_POST['form_type'] == '3-2' ) {
		$sql = mysqli_query($conn,"UPDATE tbl_cps set status = '$status', verifier_2id = '$verifier_2id', verifier_2 = '$verifier_2_name', ver2_status = '$ver2_status', ver2_date = NOW() where control_number = '$txt_control_number' ");
		if (!empty($comments)) {
			$sql_remarks = mysqli_query($conn,"INSERT INTO `tbl_remarks`(`form_type`, `control_number`, `comment_id`,`uid`, `fullname`, `comments`, `role`,`remarks_date`) VALUES ('$form_type','$txt_control_number','$comment_id','$uid','$verifier_2_name','$comments', '$role' ,NOW()) ");
		}
		// this query is activated when forms is HCI Deleted forms
		$sql_hostname = mysqli_query($conn,"UPDATE tbl_hostname set action = 'deleted' where hostname = '$cps_del_search_txt' ");		

        if (!empty($_POST['others_1'])) {
        	$disk = count($_POST['others_1']);
	        for ($i = 0; $i < $disk ; $i++) {
	        	$query = "UPDATE tbl_forms_others set status = '1' where control_number = '$txt_control_number'  ";
	        	$insert_query = mysqli_query($conn,$query);
	        }      
        }// with the table form others, it will update the status into 1, after fully verified by the verifier	

		$form_subject = "CPS";

	}
	if ($_POST['form_type'] == 4 || $_POST['form_type'] == '4-2') {
		$sql = mysqli_query($conn,"UPDATE tbl_baas set status = '$status', verifier_2id = '$verifier_2id', verifier_2 = '$verifier_2_name', ver2_status = '$ver2_status', ver2_date = NOW() where control_number = '$txt_control_number' ");
		$form_subject = "BaaS";
	}	

	$activity_logs = mysqli_query($conn, "INSERT INTO tbl_activity_logs (uid,fullname,form_type,control_number, activity,status) values ('$verifier_2id', '$my_fullname','$form_type','$txt_control_number', 'verified','$status') ");
	$notification = mysqli_query($conn, "INSERT INTO tbl_notification (uid,fullname,form_type,control_number, activity,status,isViewed) values ('$his_uid', '$my_fullname','$form_type','$txt_control_number', 'verified','$status','0') ");

	$control_number = $txt_control_number;
	require 'mail_message.php';
	require 'mail.php';
}


// ====== For Verifier ======

	

?>