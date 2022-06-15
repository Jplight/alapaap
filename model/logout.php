<?php  

session_start();

require 'connection.php';
$uid = $_SESSION['uid'];

$user_logs = "UPDATE tbl_user set is_online = '0' where uid = '$uid' ";
mysqli_query($conn,$user_logs);

session_destroy(); 
header("location: ../index.php");


?>