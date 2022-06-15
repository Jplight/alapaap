
<?php  
session_start();
$uid = $_SESSION['uid'];

// My COnnection
include '../connection.php';
// My COnnection

// array will hold the data
$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$hci_del_search_txt = $_POST['hci_del_search_txt'];


	// WHen hostname is search, it's validate if the hostname in this table is already deleted
	$validate_hostname = mysqli_query($conn,"SELECT * from tbl_hostname where hostname = '$hci_del_search_txt' and action = 'deleted'");
	if (mysqli_num_rows($validate_hostname) > 0):
		$response['status'] = 'failed';
		$response['message'] = 'The Hostname you entered is already revoke!';
	endif;

	// When Hostname is not in the deleted list, it will redirect to next quest where, the data will fetch in the textbox
	if (mysqli_num_rows($validate_hostname) < 1):
		$sql = mysqli_query($conn,"SELECT * FROM tbl_hci where hostname = '$hci_del_search_txt' and form_type = '1' and uid = '$uid' and status = '7' ");
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
			    $response['ip_add_vlan'] 	= $rows['ip_add_vlan'];
			    $response['txt_ip_vlan'] 	= $rows['txt_ip_vlan'];
			    $response['hci_users'] 	= $rows['hci_users'];

		}else{
			$response['status'] = 'invalid';
			$response['message'] = 'No data found!';
		}
		// If there is HCI Update in database, It will automatically fetch all the data in textfield
		$sql_2 = mysqli_query($conn,"SELECT * FROM tbl_hci where hostname = '$hci_del_search_txt' and form_type = '1-1' and uid = '$uid' and status = '7' ");
		$count_2 = mysqli_num_rows($sql_2);
		if ($count_2 > 0) {
				$rows_2 = mysqli_fetch_assoc($sql_2);

				$response['hci_up_control_num'] 	= $rows_2['control_number'];
				
			    $response['hci_del_req_vcpu'] 	= $rows_2['vcpu'];
			    $response['hci_del_req_ram'] 	= $rows_2['ram'];
			    $response['hci_del_req_os_new'] 	= $rows_2['os'];
			    $response['hci_del_req_desc'] = $rows_2['txt_os_descript'];
			    $response['hci_del_req_ipadd'] 	= $rows_2['ip_add_vlan'];
			    $response['hci_del_req_vlan'] 	= $rows_2['txt_ip_vlan'];
			    $response['hci_del_req_users'] 	= $rows_2['hci_users'];

				$response['hci_del_vcpu_comment'] 	= $rows_2['vcpu_comment'];
				$response['hci_del_ram_comment'] 	= $rows_2['ram_comment'];
				$response['hci_del_os_comment'] 	= $rows_2['os_comment'];
				$response['hci_del_req_parti'] 	= $rows_2['txt_define_parti'];
				$response['hci_del_ipadd_comment'] 	= $rows_2['ip_comment'];
				$response['hci_del_vlan_comment'] 	= $rows_2['vlan_comment'];
				$response['hci_del_users_comment'] 	= $rows_2['txt_hci_users'];
		}		
	endif;

}

// Json Encode, this code will convert the SQL data into JSON Format
echo json_encode($response);

?>