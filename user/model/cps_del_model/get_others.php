<?php  
session_start();
$uid = $_SESSION['uid'];

// My COnnection
include '../connection.php';
// My COnnection
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$num = 1;
	$cps_del_search_txt = $_POST['cps_del_search_txt'];

	// WHen hostname is search, it's validate if the hostname in this table is already deleted, this query is place below to executed last

	try {
	$validate_hostname = mysqli_query($conn,"SELECT * from tbl_hostname where hostname = '$cps_del_search_txt' and action = 'deleted' ");
	if (mysqli_num_rows($validate_hostname) < 1):

		$sql = mysqli_query($conn,"SELECT * FROM tbl_forms_others where hostname = '$cps_del_search_txt' and form_type = '3' and uid = '$uid' and status = '1' ");
		$count = mysqli_num_rows($sql);

		// If hostname is Exist!
		if ($count > 0) {
			$sql_2 = mysqli_query($conn,"SELECT * FROM tbl_forms_others where hostname = '$cps_del_search_txt' and form_type = '3-1' and uid = '$uid' and status = '1' ");
			$count_2 = mysqli_num_rows($sql_2);
			if ($count_2 > 0) {
				// if there is HCI Update data, It will fetch the HCI Update Data of DISK
				while ($rows_2 = mysqli_fetch_assoc($sql_2)) {
					echo '<tr>';
					echo '<td class="text-dark fw-bold">Disk (GB) '.$num++.'</td>';
					echo '<td><input class="form-control text-dark" type="text" name="others_1[]" value="'.$rows_2['others_1'].'" readonly></td>';
					echo '<td><input class="form-control text-dark" type="text" name="others_2[]" value="'.$rows_2['others_2'].'" readonly></td>';
					echo '<td><input class="form-control text-dark" type="text" name="others_3[]" value="'.$rows_2['others_3'].'" readonly ></td>';
					echo '<td><input class="form-control text-dark" type="text" name="others_4[]" value="'.$rows_2['others_4'].'" readonly ></td>';
					echo '</tr>';
				}
			}else{
				// if there is no HCI Update, The system will get the Data of HCI new and fetch to all textbox!
				while ($rows = mysqli_fetch_assoc($sql)) {
					echo '<tr>';
					echo '<td class="text-dark fw-bold">Disk (GB) '.$num++.'</td>';
					echo '<td><input class="form-control text-dark" type="text" name="others_1[]" value="'.$rows['others_1'].'" readonly></td>';
					echo '<td><input class="form-control text-dark" type="text" name="others_2[]" readonly></td>';
					echo '<td><input class="form-control text-dark" type="text" name="others_3[]" readonly ></td>';
					echo '<td><input class="form-control text-dark" type="text" name="others_4[]" readonly ></td>';
					echo '</tr>';
				}		
			}
		}

		// If hostname is not exist! it will display the blank textbox.
		if ($count < 1) {
			// echo '<tr>';
			// echo '<td class="text-dark fw-bold">Disk (GB)</td>';
			// echo '<td><input class="form-control text-dark" type="text" readonly></td>';
			// echo '<td><input class="form-control text-dark" type="text" readonly></td>';
			// echo '<td><input class="form-control text-dark" type="text" readonly></td>';
			// echo '<td><input class="form-control text-dark" type="text" readonly ></td>';
			// echo '</tr>';	
		}
	endif;		
	} catch (Exception $e) {
		return true;
	}
}

?>