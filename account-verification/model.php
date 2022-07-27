<?php
session_start();

date_default_timezone_set('Asia/Manila');
require '../model/connection.php';

$response = array();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$txt_fname = strtolower($_POST['txt_fname']) ;
	$txt_lname = strtolower($_POST['txt_lname']) ;
	$txt_email_add = $_POST['txt_email_add'];
	$txt_contact_no = $_POST['txt_contact_no'];
	$home_add = $_POST['home'];
	$new_pass = hash_hmac('md5',$_POST['new_pass'],'@Bsp1234*');
	$status		= '1';

    $pass_hash = hash_hmac('md5',$_POST['current_pass'],'@Bsp1234*');
    $sql = mysqli_query($conn,"SELECT * FROM tbl_user WHERE email_add = '$txt_email_add' and password = '$pass_hash' ");
    $count = mysqli_num_rows($sql);    

		if ($_POST['new_pass'] !== $_POST['retype_pass']){
			$response['status'] = 'not_match';
			$response['message'] = 'new password and retype password does not match!';	
		}else if($txt_fname == null || $txt_lname == null || $_POST['new_pass'] == null || $_POST['retype_pass'] == null){
			$response['status'] = 'null_fields';
			$response['message'] = 'fill out the fields!';	
        }else if ($count < 1){
			$response['status'] = 'invalid';
			$response['message'] = 'current password is incorrect!';	
        }else{
			$UpdateAccount = mysqli_query($conn,"UPDATE `tbl_user` SET `first_name`='$txt_fname',`last_name`='$txt_lname',`home_address`='$home_add', `password`='$new_pass',`contact_no`='$txt_contact_no',`status`='$status',`date_modified`= NOW() WHERE email_add = '$txt_email_add' ");	
            // $rows = mysqli_fetch_array($sql);
			// $_SESSION['uid'] = $rows['uid'];
			// $_SESSION['role'] = $rows['role'];
			$response['status'] = 'verified';
			$response['message'] = 'Account has been verified!';
            $response['link'] = 'http://'.$_SERVER['SERVER_NAME'];
        }
        unset($_SESSION['email']);
        mysqli_close($conn);
        echo json_encode($response);
}
?>