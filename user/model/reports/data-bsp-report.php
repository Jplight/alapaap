<?php
include '../connection.php';

$response = array();
$sql = "SELECT * FROM tbl_hci";
$query = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($query)){
    $change_req = "N/A";
    $infra = "";

    if ($row['form_type'] === "1-1") {
        $infra = "HCI_UPDATE";
        // hci_new_control_num
        $sql1 = "SELECT * FROM tbl_hci where control_number = '".$row["hci_new_control_num"]."'";
        $query1 = mysqli_query($conn,$sql1);
        $rows = mysqli_fetch_array($query1);
        $lastdata = $rows;
        $getdisk1 = "SELECT * from tbl_forms_others where control_number = '".$lastdata['control_number']."' and form_type = '".$lastdata['form_type']."' and uid = '".$lastdata['uid']."' ";
        $query_disk = mysqli_query($conn,$getdisk1);
        // echo json_encode($lastdata);
        $disk2 = "";
        while($disk_rows = mysqli_fetch_array($query_disk)){
            $disk2 = $disk2.$disk_rows['others_1']." GB <br>";
        };
        $change_req = "
            ".$lastdata["vcpu"]." vCPU <br>
            ".$lastdata["ram"]."GB RAM <br>
            VLAN ".$lastdata["ip_add_vlan"]."<br>
            ".$disk2."
        ";
    }


    if ($row['form_type'] === "1") {
        $infra = "HCI_NEW";
    }

    if ($row['form_type'] === "1-2") {
        continue;
    }

    if ($row['form_type'] === "1-3") {
        continue;
    }
    

    $getdisk = "SELECT * from tbl_forms_others where control_number = '".$row['control_number']."' and form_type = '".$row['form_type']."' and uid = '".$row['uid']."' and hostname = '".$row['hostname']."' ";
    $query_disk = mysqli_query($conn,$getdisk);
    $disk = "";
    while($disk_rows = mysqli_fetch_array($query_disk)){
        $disk = $disk.$disk_rows['others_1']." GB <br>";
    };

    $baseline = "
        ".$row["vcpu"]." vCPU <br>
        ".$row["ram"]."GB RAM <br>
        VLAN ".$row["ip_add_vlan"]." <br>
        ".$disk."
    ";


    $post_data = array(
        'infra' => $infra,
        'system' => $row['location'],
        'server' => $row['hostname'],
        'date' => $row['date_requested'],
        'req' => $row['fullname'],
        'baseline' => $baseline,
        'change_req' => $change_req,
        "final"=> $baseline
    );
    $response[] = $post_data;
}

$sql = "SELECT * FROM tbl_cps";
$query = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($query)){

    $change_req = "N/A";
    $infra = "";

    if ($row['form_type'] === "3") {
        $infra = "CPS_NEW";
        $baseline = "
            ".$row["vcpu_size"]." vCPU <br>
            ".$row["ram_size"]."GB RAM
        ";

        $post_data = array(
            'infra' => $infra,
            'system' => $row['location'],
            'server' => $row['hostname'],
            'date' => $row['date_requested'],
            'req' => $row['fullname'],
            'baseline' => $baseline,
            'change_req' => $change_req,
            'final' =>$baseline
        );
        $response[] = $post_data;
    }

    if ($row['form_type'] === '3-1'){
        $infra = "CPS_UPDATE";
    }
}



echo '{"data":'.json_encode($response).'}';

?>