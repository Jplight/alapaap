<?php
// include "../connection.php";

$response = array();
$sql = "SELECT * FROM bsp_report_page ";
$query = mysqli_query($conn,$sql);

while($row = mysqli_fetch_array($query)){

    switch ($row["form_type"]) {
        case "1":
            $forms = "HCI_NEW";
            break;
        case "1-1":
            $forms = "HCI_UPDATE";
            break;
        case "1-2":
            $forms = "HCI_DELETE";
            break;
        case "1-3":
            $forms = "HCI_CLONING";
            break;  
        case "3":
            $forms = "CPS_NEW";
            break; 
        case "3-1":
            $forms = "CPS_UPDATE";
            break;
        case "3-2":
            $forms = "CPS_DELETE";
            break;
        case "4":
            $forms = "BAAS_CSRF";
            break;
        case "4-2":
            $forms = "BAAS_CRRF";
            break;
        default:
            $forms = $row["form_type"];
            break;
        
    }
    
    $vcpu = empty($row["base_vcpu"]) ? '' : $row["base_vcpu"]." vCPU";  // data will return false
    $ram = empty($row["base_ram"]) ? '' : $row["base_ram"]." vRAM";
    $vlan = empty($row["base_vlan"]) ? '' : $row["base_vlan"]." VLAN";

    $cvcpu = empty($row["changed_vcpu"]) ? '' : $row["changed_vcpu"]." vCPU";
    $cram = empty($row["changed_ram"]) ? '' : $row["changed_ram"]." vRAM";
    $cvlan = empty($row["changed_vlan"]) ? '' : $row["changed_vlan"]." VLAN";

    $fvcpu = empty($row["final_vcpu"]) ? '' : $row["final_vcpu"]." vCPU";
    $fram = empty($row["final_ram"]) ? '' : $row["final_ram"]." vRAM";
    $fvlan = empty($row["final_vlan"]) ? '' : $row["final_vlan"]." VLAN";
        echo "<tr>";
            echo  "<td>".$forms."</td>";
            echo  "<td>".$row["location"]."</td>";
            echo  "<td>".$row["hostname"]."</td>";
            echo  "<td>".
                        
                        $vcpu."<br>\n".
                        $ram."<br>\n".
                        $vlan."<br>\n".
                        $row["base_disk_gb"]."<br>\n".
                    "</td>";
            echo  "<td>".$row["date_requested"]."</td>";
            echo  "<td>".$row["fullname"]."</td>";
            echo  "<td>".
                        $cvcpu."<br>\n".
                        $cram."<br>\n".
                        $cvlan."<br>\n".
                        $row["changed_disk_gb"]."<br>\n".
                    "</td>";
            echo  "<td>".
                        $fvcpu."<br>\n".
                        $fram."<br>\n".
                        $fvlan."<br>\n".
                        $row["final_disk_gb"]."<br>\n".
                    "</td>";
                    echo  "<td>".$row["APPROVED_BY"]."</td>";
                    echo  "<td>".$row["DATE_APPROVED"]."</td>";
                    echo  "<td>".$row["DATE_VERIFIED"]."</td>";
        echo "</tr>";

}

?>