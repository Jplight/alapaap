
<?php  
session_start();
$uid = $_SESSION['uid'];
// My COnnection
include '../connection.php';
// My COnnection


$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$straas_up_search_txt = $_POST['straas_up_search_txt'];


	// and straas_new_control_num <> control_number and status >=1 and status < 3 
	$sql = mysqli_query($conn,"SELECT * FROM tbl_straas where hostname = '$straas_up_search_txt' order by straas_new_control_num  desc");
	$count = mysqli_num_rows($sql);
	if ($count > 0) {
			$rows = mysqli_fetch_assoc($sql);
			// if (($rows["status"] === "1" || $rows["status"] === "7")) {
			if ($rows["status"] === "7" || $rows['status'] === '0'|| $rows['status'] === '1' ) {
				$response['status'] = '200';
				$response['straas_new_control_num'] = $rows['control_number'];
				$response['department'] = $rows['department'];
				$response['location'] 	= $rows['location'];
				
				$response['host_port'] 	= $rows['host_port'];
				
				$response['date_accomplished'] 	= $rows['date_requested'];
			}else{
				$response['status'] = 'invalid';
				$response['message'] = 'Cannot Update Ongoing Request!';
			}
		    
	}else{
		$response['status'] = 'invalid';
		$response['message'] = 'No Data Found!';
	}

	// WHen hostname is search, it's validate if the hostname in this table is already deleted
	$validate_hostname = mysqli_query($conn,"SELECT * from tbl_hostname where hostname = '$straas_up_search_txt' and action = 'deleted'");
	if (mysqli_num_rows($validate_hostname) > 0):
		$response['status'] = 'failed';
		$response['message'] = 'The Hostname you entered is already revoke!';
	endif;

}
echo json_encode($response);

?>