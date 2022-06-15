<?php  

include 'connection.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$users_id = $_POST['users_id'];
		$his_id = $_POST['his_id'];

		$chk_requestor 	= $_POST['chk_requestor'];
		$chk_approver 	= $_POST['chk_approver'];
		$chk_reciever 	= $_POST['chk_reciever'];
		$chk_performer 	= $_POST['chk_performer'];
		$chk_confirmer 	= $_POST['chk_confirmer'];
		$chk_verifier 	= $_POST['chk_verifier'];

	if (isset($_POST['btn_approve_role'])) {
		$new_role = $chk_requestor.$chk_approver.$chk_reciever.$chk_performer.$chk_confirmer.$chk_verifier;
		$sql_updated_role = mysqli_query($conn,"UPDATE tbl_user set multi_role = '$new_role' where uid = '$his_id' ");
		$sql_role = mysqli_query($conn,"UPDATE tbl_req_role set status = '1' where uid = '$users_id' and his_id = '$his_id' ");
	}


	if (isset($_POST['btn_reject_role'])) {
		$sql_role = mysqli_query($conn,"UPDATE tbl_req_role set status = '2' where uid = '$users_id' and his_id = '$his_id' ");
	}

	if (isset($_POST['btn_role_default'])) {
		$sql = mysqli_query($conn,"UPDATE tbl_user set role = $default_role, sub_role = null, multi_role = null where uid = '$uid' ");
		if ($sql) {
			header("location: profile.php");    
		}     
	}
	header("location: approved_role.php");	
}




?>


