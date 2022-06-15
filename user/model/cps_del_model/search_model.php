
<?php  
session_start();
$uid = $_SESSION['uid'];
// My COnnection
include '../connection.php';
// My COnnection


$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$cps_del_search_txt = $_POST['cps_del_search_txt'];


	// WHen hostname is search, it's validate if the hostname in this table is already deleted
	$validate_hostname = mysqli_query($conn,"SELECT * from tbl_hostname where hostname = '$cps_del_search_txt'  and action = 'deleted'");
	if (mysqli_num_rows($validate_hostname) > 0):
		$response['status'] = 'failed';
		$response['message'] = 'The Hostname you entered is already revoke!';
	endif;

	if (mysqli_num_rows($validate_hostname) < 1):
		$sql = mysqli_query($conn,"SELECT * FROM tbl_cps where hostname = '$cps_del_search_txt' and uid = '$uid' and form_type = '3' and status = '7' ");
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

		$sql_2 = mysqli_query($conn,"SELECT * FROM tbl_cps where hostname = '$cps_del_search_txt' and uid = '$uid' and form_type = '3-1' and status = '7' ");
		$count_2 = mysqli_num_rows($sql_2);
		if ($count_2 > 0) {
				$rows_2 = mysqli_fetch_assoc($sql_2);

			    $response['cps_up_control_num'] = $rows_2['control_number'];

			    $response['cps_del_vcpu_size_req'] 	= $rows_2['vcpu_size'];
			    $response['cps_del_vcpu_filesystem'] = $rows_2['vcpu_filesystem'];
			    $response['cps_del_vcpu_remarks'] = $rows_2['vcpu_remarks'];
			   
			    $response['cps_del_ram_size_req'] 	= $rows_2['ram_size'];
			    $response['cps_del_ram_filesystem'] 	= $rows_2['ram_filesystem'];
			    $response['cps_del_ram_remarks'] 	= $rows_2['ram_remarks'];

			    $response['cps_del_ue_enroll_size_req'] 	= $rows_2['ue_enroll_size'];
			    $response['cps_del_ue_filesystem'] 	= $rows_2['ue_filesystem'];
			    $response['cps_del_ue_remarks'] 	= $rows_2['ue_remarks'];	    	    
		}
	endif;
}
echo json_encode($response);

?>