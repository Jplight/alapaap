
<?php  
session_start();
$uid = $_SESSION['uid'];
// My COnnection
include '../connection.php';
// My COnnection


$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$cps_up_search_txt = $_POST['cps_up_search_txt'];

	$sql = mysqli_query($conn,"SELECT * FROM tbl_cps where hostname = '$cps_up_search_txt' and uid = '$uid' and form_type = '3' ");
	$count = mysqli_num_rows($sql);
	if ($count > 0) {
			$rows = mysqli_fetch_assoc($sql);
		    $response['status'] = '200';
		    $response['cps_new_control_num'] = $rows['control_number'];
		    $response['system_name'] = $rows['system_name'];
		    $response['instance_name'] 	= $rows['instance_name'];
		    $response['location'] 	= $rows['location'];
		    $response['env_profile'] 	= $rows['env_profile'];
		    $response['pattern'] 	= $rows['pattern'];
		    $response['ip_add'] 	= $rows['ip_add'];
		    $response['ip_group'] 	= $rows['ip_group'];
		    $response['vcpu_size'] 	= $rows['vcpu_size'];
		    $response['ram_size'] 	= $rows['ram_size'];
		    $response['ue_enroll_size'] 	= $rows['ue_enroll_size'];

	}else{
		$response['status'] = 'invalid';
		$response['message'] = 'No data found!';
	}

	// WHen hostname is search, it's validate if the hostname in this table is already deleted
	$validate_hostname = mysqli_query($conn,"SELECT * from tbl_hostname where hostname = '$cps_up_search_txt' and form_type = '3'  and action = 'deleted'");
	if (mysqli_num_rows($validate_hostname) > 0):
		$response['status'] = 'failed';
		$response['message'] = 'The Hostname you entered is already revoke!';
	endif;

}
echo json_encode($response);

?>