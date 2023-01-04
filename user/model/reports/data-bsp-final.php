<?php
//include '../connection.php';

$server = 'localhost';
$username = 'root';
$password = '';
$db = 'alapaap_db_backup-12-21-2022';
$conn = mysqli_connect($server,$username,$password,$db);


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