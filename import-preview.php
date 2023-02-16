<?php
require 'vendor/autoload.php';
use \PhpOffice\PhpSpreadsheet\IOFactory;
use \PhpOffice\PhpSpreadsheet\Shared\Date;

// Check if the 'Preview' button is clicked
if (isset($_FILES['file'])) {
    // Get the temporary file name  
    $file = $_FILES['file']['tmp_name'];

    // Get the file extension
    $file_extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

    // Create a reader for the file type
    $reader = IOFactory::createReader(ucfirst($file_extension));

    // Load the file using the reader
    $spreadsheet = $reader->load($file);

    // Get the active sheet from the spreadsheet
    $sheet = $spreadsheet->getActiveSheet();

    // Get the highest row number in the sheet
    $highestRow = $sheet->getHighestRow();

    // Get the highest column letter in the sheet
    $highestColumn = $sheet->getHighestColumn();

    $columns = [
        'Infrastructure' => '',
        'System' => '',
        'Server Name' => '',
        'Request' => '',
        'Date Requested' => '',
        'Time Requested' => '',
        'Requested by' => '',
        'Approved By' => '',
        'Date Approved' => '',
        'Date Verified' => ''
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



    // Start the table
    echo '<table class="table table-bordered">';

    // Start the table header row
    echo '<tr>';
    echo '<thead class="table-dark sticky-top">';
    // Loop through each column in the first row to get the column headers
    for ($col = 'A'; $col <= $highestColumn; $col++) {
        $columnName = $sheet->getCell($col . '1')->getValue();

        // If the column name exists in the $columns array, display the header
        if (array_key_exists($columnName, $columns)) {
            echo '<th class="">' . $columnName . '</th>';
        }
    }

    // End the table header row
    echo '</thead>';
    echo '</tr>';

    // Loop through each row starting from row 2 (skipping the header row)
    for ($row = 2; $row <= $highestRow; $row++) {
        // Start a new table row
        echo '<tr>';

         // Loop through each column in the current row
         for ($col = 'A'; $col <= $highestColumn; $col++) {
            $columnName = $sheet->getCell($col . '1')->getValue();

            // If the column name exists in the $columns array, display the value
            if (array_key_exists($columnName, $columns)) {
                $cellValue = $sheet->getCell($col . $row)->getValue();

                if ($columnName === 'Date Requested' || $columnName === 'Date Approved' || $columnName === 'Date Verified') {
                    $cellValue = Date::excelToDateTimeObject($cellValue)->format('Y-m-d');
                } elseif ($columnName === 'Time Requested') {
                    $cellValue = date('H:i:s', strtotime($cellValue));
                }

                echo '<td>' . $cellValue . '</td>';
            }
        }

        // End the table row
        echo '</tr>';
    }

    // End the table
    echo '</table>';
}
?>






