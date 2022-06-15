<?php

$conn = mysqli_connect("localhost","root","","alapaap_db") or die("Connection Error!");

$query = mysqli_query($conn,"select * from tbl_pending_request");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <title>Data Tables</title>
</head>
<body>


    <table id="example" class="table table-striped table-hover display responsive nowrap" style="width:100%">
        <thead class="table-dark">
            <tr>
                <th>Requestor</th>
                <th>Control No.</th>
                <th>Time Stamp</th>
                <th>Form Type</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($query as $data){
                    echo '<tr>';
                    echo '<td>'.$data['fullname'].'</td>';
                    echo '<td>'.$data['control_number'].'</td>';
                    echo '<td>'.$data['date_requested'].'</td>';
                    echo '<td>'.$data['form_type'].'</td>';
                    echo '</tr>';
                }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Requestor</th>
                <th>Control No.</th>
                <th>Time Stamp</th>
                <th>Form Type</th>
            </tr>
        </tfoot>
    </table>


<script>
    $(document).ready(function () {
        $('#example').DataTable({
            responsive: true
        });
        
    });
</script>
</body>
</html>