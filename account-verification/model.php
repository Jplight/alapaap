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
			$response['message'] = 'Your New Password and Retype password does not Match!';	
		}else if($txt_fname == null || $txt_lname == null || $txt_contact_no == null || $new_pass == null){
			$response['status'] = 'null_fields';
			$response['message'] = 'Some of the fields must be fill up first!';	
        }else if ($count < 1){
			$response['status'] = 'invalid';
			$response['message'] = 'Current Password is incorrect!';	
        }else{
			$sql2 = mysqli_query($conn,"UPDATE `tbl_user` SET `first_name`='$txt_fname',`last_name`='$txt_lname',`home_address`='$home_add', `password`='$new_pass',`contact_no`='$txt_contact_no',`status`='$status',`date_modified`= NOW() WHERE email_add = '$txt_email_add' ");	
            $response['status'] = 'verified';
			$response['message'] = 'Your Account has been verified! You may Login your account';
            $response['link'] = '../user/index.php';
        }
        unset($_SESSION['email']);
        mysqli_close($conn);
        echo json_encode($response);
}
?>