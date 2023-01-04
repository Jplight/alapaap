<?php
include '../connection.php';

$response = array();
$sql = "SELECT * FROM tbl_hci where form_type = '1-1' ";
$query = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($query)){
    $change_req = "N/A";
    $infra = "";

    $infra = "HCI_UPDATE";
    // hci_new_control_num
    $sql1 = "SELECT * FROM tbl_hci where control_number = '".$row["hci_new_control_num"]."'";
    $query1 = mysqli_query($conn,$sql1);
    $rows = mysqli_fetch_array($query1);
    $lastdata = $rows;
    

    $change_req = "";
    if ($lastdata["vcpu"] != $row["vcpu"]){
        $changes = intval($row["vcpu"]); 
        $change_req = $change_req."+".$changes." vCPU \n\r <br/>";
    }

    if ($lastdata["ram"] != $row["ram"]){
        $changes = (intval($lastdata["ram"]) - intval($row["ram"])) * -1; 
        $change_req = $change_req."+".$changes." GB vRAM \n\r <br/>";
    }

    if ($lastdata["ip_add_vlan"] != $row["ip_add_vlan"]){
        $change_req = $change_req."+".$row["ram"]." VLAN \n\r <br/>";
    }
    

    $getdisk = "SELECT * from tbl_forms_others where control_number = '".$row['control_number']."' and form_type = '".$row['form_type']."' and uid = '".$row['uid']."' and hostname = '".$row['hostname']."' ";
    $query_disk = mysqli_query($conn,$getdisk);
    $disk1 = "";
    $disk2 = "";
    $changesDisk = "";
    while($disk_rows = mysqli_fetch_array($query_disk)){
        $disk1 = $disk1.$disk_rows['others_3'].": ".$disk_rows['others_1']." GB <br/> \n\r";
        $disk2 = $disk2.$disk_rows['others_3'].": ".$disk_rows['others_2']." GB <br/> \n\r";
        if ($disk_rows['others_1'] != $disk_rows['others_2']){
            $changes = intval($disk_rows['others_2']) - intval($disk_rows['others_1']); 
            $change_req = $change_req.$disk_rows['others_3'].": +".$changes." GB <br/>\n\r ".$disk_rows['others_id'];
            
        }
    };

    $baseline = "".$lastdata["vcpu"]." vCPU <br/>
".$lastdata["ram"]."GB vRAM <br/>
VLAN ".$lastdata["ip_add_vlan"]." <br/>
".$disk1."
    ";

    $validate_vcpu  = intval($lastdata['vcpu']) == intval($row["vcpu"]) ? "" : intval($lastdata["vcpu"]) + intval($row["vcpu"])." vCPU <br/> \n\r";
    $validate_ram   = intval($lastdata['ram']) == intval($row["ram"]) ? "" : $row["ram"]." GB vRAM <br/> \n\r";
    $validate_vlan  = intval($lastdata['ip_add_vlan']) == intval($row["ip_add_vlan"]) ? "" : "VLAN ".$row["ip_add_vlan"]." <br/> \n\r";

    $final = $validate_vcpu.$validate_ram.$validate_vlan.$disk2;


    $post_data = array(
        'infra' => $infra,
        'system' => $row['location'],
        'server' => $row['hostname'],
        'date' => $row['date_requested'],
        'req' => $row['fullname'],
        'baseline' => $baseline,
        'change_req' => $change_req,
        "final"=> $final
    );
    if($change_req != "" ){
        $response[] = $post_data;
    }
}

$sql = "SELECT * FROM tbl_cps";
$query = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($query)){

    $change_req = "N/A";
    $infra = "";

    if ($row['form_type'] === "3") {
        $infra = "CPS_NEW";
        $baseline = "".$row["vcpu_size"]." vCPU <br/>
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
        // $response[] = $post_data;
    }

    if ($row['form_type'] === '3-1'){
        $infra = "CPS_UPDATE";
    }
}



echo '{"data":'.json_encode($response).'}';

?>