
<?php  
session_start();
$uid = $_SESSION['uid'];
// My COnnection
include '../connection.php';
// My COnnection


$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$hci_up_search_txt = $_POST['hci_up_search_txt'];



	$sql = mysqli_query($conn,"SELECT * FROM tbl_hci where hostname = '$hci_up_search_txt' and uid = '$uid' ");
	$count = mysqli_num_rows($sql);
	if ($count > 0) {
			$rows = mysqli_fetch_assoc($sql);
		    $response['status'] = '200';
		    $response['hci_new_control_num'] = $rows['control_number'];
		    $response['department'] = $rows['department'];
		    $response['location'] 	= $rows['location'];
		    $response['cluster'] 	= $rows['cluster'];
		    $response['vcpu'] 	= $rows['vcpu'];
		    $response['ram'] 	= $rows['ram'];
		    $response['os'] 	= $rows['os'];
		    $response['txt_os_descript'] = $rows['txt_os_descript'];
		    $response['os'] 	= $rows['os'];
		    $response['ip_add_vlan'] 	= $rows['ip_add_vlan'];
		    $response['txt_ip_vlan'] 	= $rows['txt_ip_vlan'];
		    $response['hci_users'] 	= $rows['hci_users'];
	}else{
		$response['status'] = 'invalid';
		$response['message'] = 'No data found!';
	}

	// WHen hostname is search, it's validate if the hostname in this table is already deleted
	$validate_hostname = mysqli_query($conn,"SELECT * from tbl_hostname where hostname = '$hci_up_search_txt' and action = 'deleted'");
	if (mysqli_num_rows($validate_hostname) > 0):
		$response['status'] = 'failed';
		$response['message'] = 'The Hostname you entered is already revoke!';
	endif;

}
echo json_encode($response);

?>