<?php
include '../connection.php';

$response = array();
$sql = "SELECT * FROM bsp_report";
$query = mysqli_query($conn,$sql);

while($row = mysqli_fetch_array($query)){
    // if ($row['INFRASTRUCTURE'] != 'HCI_DELETE'):
    //     $response[] = $row;
    // endif;
    $response[] = $row;
}


echo '{"data":'.json_encode($response).'}';

?>