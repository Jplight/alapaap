<?php
include '../connection.php';

$response = array();
$sql = "SELECT * FROM tbl_hci_raw";
$query = mysqli_query($conn,$sql);

while($row = mysqli_fetch_array($query)){
    if ($row['INFRASTRUCTURE'] != 'HCI_DELETE'):
        $response[] = $row;
    endif;
}


echo '{"data":'.json_encode($response).'}';

?>