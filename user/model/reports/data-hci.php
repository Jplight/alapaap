<?php
include '../connection.php';

$response = array();
$sql = "SELECT * FROM tbl_hci_raw";
$query = mysqli_query($conn,$sql);
while($rows = mysqli_fetch_array($query)){
    $response[] =  $rows;
}

echo '{"data":'.json_encode($response).'}';

?>