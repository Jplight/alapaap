<?php
include 'connection.php';
session_start();
$uid = $_SESSION['uid'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = mysqli_query($conn,"UPDATE tbl_notification set isViewed = '1' where uid = '$uid' ");
    mysqli_close($conn);
}

?>