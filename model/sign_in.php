<?php  
// session_start();
// require_once 'connection.php';

// if (isset($_POST['btn_signin'])) {
// 	$email_add = $_POST['email_add'];
// 	$pass_hash = hash_hmac('md5',$_POST['pass'],'@Bsp1234*');

// 	$sql = mysqli_query($conn,"SELECT * FROM tbl_user WHERE email_add = '$email_add' and password = '$pass_hash' ");
// 	$rows = mysqli_fetch_array($sql);
// 	$count = mysqli_num_rows($sql);
// 	if ($count > 0):
// 		$_SESSION['uid'] = $rows['uid'];
// 		$_SESSION['role'] = $rows['role'];
// 		if ($rows['role'] == 'admin'):
// 			header("location: admin/index.php");
// 		endif;
// 		if ($rows['role'] >= 1):
// 			header("location: user/index.php");
// 		endif;
// 	else:
// 		echo 'Invalid Email or Password!';
// 	endif;	
// 	mysqli_close($conn);
// }


?>


<?php  
session_start();
date_default_timezone_set('Asia/Manila');
include 'connection.php';

$response = array();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$email_add = $_POST['email_add'];
	$pass_hash = hash_hmac('md5',$_POST['pass'],'@Bsp1234*');

	$verify_email = mysqli_query($conn,"SELECT * FROM tbl_user WHERE email_add = '$email_add'");
	$count = mysqli_num_rows($verify_email);
	$rows = mysqli_fetch_array($verify_email);
	if ($count > 0){
		if ($rows['status'] == '1'){
			$sql_2 = mysqli_query($conn,"SELECT * FROM tbl_user WHERE email_add = '$email_add' and password = '$pass_hash' ");
			$count_2 = mysqli_num_rows($sql_2);
			if ($count_2 > 0) {
				$response['status'] = 'Success';			
				$_SESSION['uid'] = $rows['uid'];
				$_SESSION['role'] = $rows['role'];	
				if ($rows['role'] >= 1) {					
					$response['link'] = 'user/index.php';							
				}
				if ($rows['role'] == 'admin') {
					$response['link'] = 'admin/index.php';							
				}	
				$user_logs = "UPDATE tbl_user set is_online = '1' where uid = '".$rows['uid']."' ";
				mysqli_query($conn,$user_logs);

			}else{
				$response['status'] = 'Failed';
				$response['message'] = 'Incorrect email or password!';
			}
		}else if ($rows['status'] == '2'){
			$response['status'] = 'disabled';
			$response['message'] =  "This account has been disabled by the Administrator. Please contact your administrator.";
		}else{
			$response['status'] = 'Unverified';		
			$response['message'] = 'This is account needs to be verified!';	
			$response['link'] = 'account-verification/index.php';
			$_SESSION['email'] = $rows['email_add'];
		}		
	}else{
		$response['status'] = 'not_exist';
		$response['message'] = 'This account does not exist!';		
	}
	mysqli_close($conn);
	echo json_encode($response);
}

?>