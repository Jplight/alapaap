<?php
session_start();
$uid = $_SESSION['uid'];
require '../../connection.php';
require '../../../../vendor/autoload.php';
$response = array();
if (isset($_FILES['file_changes'])) {

  $excel = $_FILES['file_changes']['tmp_name'];
  $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($excel);
  $worksheet = $spreadsheet->getActiveSheet();
  $rows = $worksheet->toArray();


  // $columns = [
  //   'Infrastructure' => 'criteria',
  //   'System' => 'location',
  //   'Server Name' => 'hostname',
  //   'Request' => 'prob_descript',
  //   'Date Requested' => 'date_requested',
  //   'Time Requested' => 'time_requested',
  //   'Requested by' => 'fullname',
  //   'Approved By' => 'reciever',
  //   'Date Approved' => 'rec_date',
  //   'Date Verified' => 'ver2_date'
  // ];



  $columns = [
    'Infrastructure' => 'INFRASTRUCTURE',
    'System' => 'SYSTEM',
    'Server Name' => 'hostname',
    'Baseline configuration' => 'BASELINE_CONFIGURATION',
    'Date' => 'DATE',
    'Request by' => 'REQUESTED_BY',
    'Change request' => 'CHANGED_REQUESTED',
    'Final Configuration' => 'FINAL_CONFIGURATION',
    'Approved By' => 'APPROVED_BY',
    'Date Approved' => 'DATE_APPROVED',
    'Date Verified' => 'DATE_VERIFIED',
];


    // ============================================================================================================================
    // This will used to validate if the columns in excel is matched with the $columns[] Array 
    // Read the first row of the excel file
    $firstRow = $spreadsheet->getActiveSheet()->rangeToArray('A1:'.$spreadsheet->getActiveSheet()->getHighestColumn().'1')[0];
    // Check if each required column header exists in the first row of the excel file
    $missingColumns = [];
    foreach($columns as $excelColumn => $tableColumn) {
    if(!in_array($excelColumn, $firstRow)) {
        $missingColumns[] = $excelColumn;
    }
    }

    // If any required column headers are missing, display an error message
    if(count($missingColumns) > 0) {
    die("The following required column headers are missing from the excel file: " . implode(", ", $missingColumns));
    }
    // ============================================================================================================================

  $header = array_shift($rows);
  foreach ($header as $key => $value) {
    if (array_key_exists($value, $columns)) {
      $header[$key] = $columns[$value];
    }
  }

  $data = [];
  foreach ($rows as $row) {
    $data[] = array_combine($header, $row);
  }


  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  foreach ($data as $item) {
    $INFRASTRUCTURE = $item['INFRASTRUCTURE'];
    $SYSTEM = $item['SYSTEM'];
    $hostname = $item['hostname'];
    $BASELINE_CONFIGURATION = $item['BASELINE_CONFIGURATION'];
    $DATE = $item['DATE'];
    $REQUESTED_BY = $item['REQUESTED_BY'];
    $CHANGED_REQUESTED = $item['CHANGED_REQUESTED'];
    $FINAL_CONFIGURATION = $item['FINAL_CONFIGURATION'];
    $APPROVED_BY = $item['APPROVED_BY'];
    $DATE_APPROVED = $item['DATE_APPROVED'];
    $DATE_VERIFIED = $item['DATE_VERIFIED'];

    $datetime = new DateTime("$DATE");
    $DATE_CONVERTED = $datetime->format('Y-m-d');

    $sql = "INSERT INTO `tbl_recent_data`(uid, `INFRASTRUCTURE`, `SYSTEM`, `hostname`, `BASELINE_CONFIGURATION`, `DATE`, `REQUESTED_BY`, `CHANGED_REQUESTED`, `FINAL_CONFIGURATION`, `APPROVED_BY`, `DATE_APPROVED`, `DATE_VERIFIED`) VALUES ('$uid','$INFRASTRUCTURE','$SYSTEM','$hostname','$BASELINE_CONFIGURATION','$DATE_CONVERTED','$REQUESTED_BY','$CHANGED_REQUESTED','$FINAL_CONFIGURATION','$APPROVED_BY','$DATE_APPROVED','$DATE_VERIFIED')";
    $query = mysqli_query($conn, $sql);

  }
  if ($query) {
    // echo "New record created successfully";
    $response['status'] = 'created';
    $response['message'] = 'New record created successfully';
  } else {
    $response['status'] = 'error';
    $response['message'] = 'Error: '.$sql.mysqli_error($conn);
    // echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
  echo json_encode($response);
  mysqli_close($conn);
}
?>