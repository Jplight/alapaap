<?php  

$conn = mysqli_connect('localhost','root','passw0rd','alapaap_db');
if (mysqli_connect_error()) {
	echo "Connection Failed! 😥";
	echo '<h3>'.mysqli_connect_error().'</h3>';
	exit();
}

?>