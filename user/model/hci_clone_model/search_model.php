
<?php  
session_start();
$uid = $_SESSION['uid'];
// My COnnection
include '../connection.php';
// My COnnection


$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$hci_clon_hostname = $_POST['hci_clon_hostname'];


	// and hci_new_control_num <> control_number and status >=1 and status < 3 
	$sql = mysqli_query($conn,"SELECT * FROM tbl_hci where hostname = '$hci_clon_hostname' order by control_number desc");
	$count = mysqli_num_rows($sql);
	if ($count > 0) {
			$rows = mysqli_fetch_assoc($sql);
			if (($rows["status"] === "1" || $rows["status"] === "7")) {
				$response['status'] = '200';

				// // site information
				$response['hci_clon_department'] = $rows['department'];
				$response['hci_clon_location'] 	= $rows['location'];
				$response['hci_clon_cluster'] 	= $rows['cluster'];

				// request information
				// requested
				$response['hci_clon_vcpu'] 	= $rows['vcpu'];
				$response['hci_clon_ram'] 	= $rows['ram'];
				$response['hci_clon_os'] 	= $rows['os'];
				$response['hci_clon_txt_os_descript'] = $rows['txt_os_descript'];
				$response['hci_clon_ip_add_vlan'] 	= $rows['ip_add_vlan'];
				$response['hci_clon_txt_ip_vlan'] 	= $rows['txt_ip_vlan'];
				$response['hci_clon_users'] 	= $rows['hci_users'];
				$response['hci_clon_txt_users'] 	= $rows['txt_hci_users'];
				$response['hci_clon_vm_deployment'] 	= $rows['vm_deployment'];
				$response['hci_clon_comm'] 	= $rows['comm'];		

				// comment
				
				$response['hci_clon_vcpu_comment'] 	= $rows['vlan_comment'];
				$response['hci_clon_ram_comment'] 	= $rows['ram_comment'];
				$response['hci_clon_os_comment'] 	= $rows['os_comment'];
				$response['hci_clon_txt_define_parti'] 	= $rows['txt_define_parti'];
				$response['hci_clon_ip_comment'] 	= $rows['ip_comment'];
				$response['hci_clon_vlan_comment'] 	= $rows['vlan_comment'];
				$response['hci_clon_txt_users'] 	= $rows['txt_hci_users'];
				$response['hci_clon_vm_deployment_comment'] 	= $rows['vm_deployment_comment'];
				$response['hci_clon_comm_comment'] 	= $rows['comm_comment'];
				
				
						
				$response['date_accomplished'] 	= $rows['date_requested'];
			}else{
				$response['status'] = 'invalid';
				$response['message'] = 'Cannot Clone Ongoing Request!';
			}
		    
	}else{
		$response['status'] = 'invalid';
		$response['message'] = 'No Data Found!';
	}

	// WHen hostname is search, it's validate if the hostname in this table is already deleted
	$validate_hostname = mysqli_query($conn,"SELECT * from tbl_hostname where hostname = '$hci_clon_hostname' and action = 'deleted'");
	if (mysqli_num_rows($validate_hostname) > 0):
		$response['status'] = 'failed';
		$response['message'] = 'The Hostname you entered is already revoke!';
	endif;

}
echo json_encode($response);

?>