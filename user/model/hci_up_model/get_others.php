<?php  
session_start();
$uid = $_SESSION['uid'];
// My COnnection
include '../connection.php';
// My COnnection
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$num = 1;
	$hci_up_search_txt = $_POST['hci_up_search_txt'];


	// WHen hostname is search, it's validate if the hostname in this table is already deleted, this query is place below to executed last
	$validate_hostname = mysqli_query($conn,"SELECT * from tbl_hostname where hostname = '$hci_up_search_txt' and action = 'deleted' ");
	if (mysqli_num_rows($validate_hostname) < 1):

		$sql_2 = mysqli_query($conn,"SELECT * FROM tbl_forms_others where hostname = '$hci_up_search_txt' and form_type = '1' and uid = '$uid' ");
		$count_2 = mysqli_num_rows($sql_2);
		if ($count_2 > 0) {
			while ($rows_2 = mysqli_fetch_assoc($sql_2)) {
				echo '<tr>';
				echo '<td class="text-dark fw-bold">Disk (GB) '.$num++.'</td>';
				echo '<td><input class="form-control text-dark" type="text" name="others_1[]" value="'.$rows_2['others_1'].'" readonly></td>';
				echo '<td><input class="form-control text-dark" type="text" name="others_2[]" ></td>';
				echo '<td><input class="form-control text-dark" type="text" name="others_3[]" ></td>';
				echo '</tr>';
			}
		}else{
			echo '<tr>';
			echo '<td class="text-dark fw-bold">Disk (GB)</td>';
			echo '<td><input class="form-control text-dark" type="text" name="others_1[]" readonly></td>';
			echo '<td><input class="form-control text-dark" type="text" name="others_2[]" ></td>';
			echo '<td><input class="form-control text-dark" type="text" name="others_3[]" ></td>';
			echo '</tr>';
			
		}
	endif;
}

?>