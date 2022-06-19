<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = mysqli_query($conn,"UPDATE tbl_notification set isViewed = '1' ");
    mysqli_close($conn);
}

?>