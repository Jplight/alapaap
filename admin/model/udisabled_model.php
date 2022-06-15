<?php

include 'connection.php';
if(isset($_GET['uid']) && isset($_GET['email']) && isset($_GET['stat'])){
    $email = $_GET['email'];

    if($_GET['stat'] == '1'){
        $status = '2';
    }
    if($_GET['stat'] == '2'){
        $status = '1';
    }
    $sql = mysqli_query($conn,"UPDATE tbl_user set status = '$status' where uid = '".$_GET['uid']."' ");

    header("location: ../user_management.php");
}


?>