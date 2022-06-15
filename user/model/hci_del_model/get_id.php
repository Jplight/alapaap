<?php  
session_start();
$uid = $_SESSION['uid'];

// My COnnection
include '../connection.php';
// My COnnection

$response = array();


	$validate_hostname = mysqli_query($conn,"SELECT * from tbl_hostname where action = 'deleted'");
	if (mysqli_num_rows($validate_hostname) < 1):
		$sql = mysqli_query($conn,"SELECT * FROM tbl_hci where status = '7' and form_type = '1' and uid = '$uid' limit 5");
		$count = mysqli_num_rows($sql);
		if ($count > 0) {
			while ($rows = mysqli_fetch_assoc($sql)) {
			    $response[] = $rows;
			}
		}else{
			$sql_2 = mysqli_query($conn,"SELECT * FROM tbl_hci where status = '7' and form_type = '1-1' and uid = '$uid' limit 5");
			$count_2 = mysqli_num_rows($sql_2);
			if ($count_2 > 0) {
				while ($rows_2 = mysqli_fetch_assoc($sql_2)) {
				    $response[] = $rows_2;
				}
			}	
		}
	endif;

	

echo json_encode($response);
?>