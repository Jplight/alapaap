<?php  

	$conn = mysqli_connect('localhost','root','','alapaap_db_backup-12-21-2022');
	if (mysqli_connect_error()) {
		echo "Connection Failed! 😥";
		echo '<h3>'.mysqli_connect_error().'</h3>';
		exit();
	}

?>