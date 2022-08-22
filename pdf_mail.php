<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Dompdf\Dompdf;

require 'vendor/autoload.php';
require_once 'vendor/dompdf/autoload.inc.php';

$mail = new PHPMailer(true);
$dompdf = new Dompdf();


$message = '';
$connect = new PDO("mysql:host=localhost;dbname=testing", "root", "");

function fetch_customer_data($connect)
{
	$query = "SELECT * FROM tbl_customer";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '
	<div>
	<button class="btn btn-primary">click</button>
	<div class="table-responsive">
		<table class="table table-light table-striped">
			<tr>
				<th>Name</th>
				<th>Address</th>
				<th>City</th>
				<th>Postal Code</th>
				<th>Country</th>
			</tr>
	';
	foreach($result as $row)
	{
		$output .= '
			<tr>
				<td>'.$row["CustomerName"].'</td>
				<td>'.$row["Address"].'</td>
				<td>'.$row["City"].'</td>
				<td>'.$row["PostalCode"].'</td>
				<td>'.$row["Country"].'</td>
			</tr>
		';
	}
	$output .= '
		</table>
		
	</div>
	</div>
	';
	return $output;
}


	// include('pdf.php');
	$file_name = date("Y-m-d_H-i-s_").round(microtime(true) * 100). '.pdf';
	$html_code = '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">';
	$html_code .= fetch_customer_data($connect);

	$dompdf->load_html($html_code);
	$dompdf->render();
	$file = $dompdf->output();
	file_put_contents($file_name, $file);

	// $mail->isSMTP();                                      // Set mailer to use SMTP
	// $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	// $mail->SMTPAuth = true;                               // Enable SMTP authentication
	// $mail->Username   = 'alapaapbsp@gmail.com';              // SMTP username
	// $mail->Password   = 'lykcjxwaufpwhznx';	                         // SMTP password
	// $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	// $mail->Port = 587;         
	// $mail->SMTPOptions = array (
	// 	'ssl' => array(
	// 		'verify_peer'  => false,
	// 		'verify_peer_name'  => false,
	// 		'allow_self_signed' => true)
	// );            
	
	// // TCP port to connect to
	// $mail->From = 'whyllardermie@gmail.com';
	// $mail->FromName = 'Whyllard Ermie';
	// $mail->addAddress('whyllardermie@gmail.com');     // Add a recipient

	// $mail->addReplyTo('alapaapbsp@gmail.com');
	// $mail->AddAttachment($file_name);

	// $mail->WordWrap = 50;
	// $mail->isHTML(true);                                  // Set email format to HTML

	// $mail->Subject = "BSP Alapaap";
	// $mail->Body    = '<div style="border:2px solid red;">This is the HTML message body <b>in bold!</b></div>';
	// $mail->AltBody = "Good Day!";

	// if(!$mail->send()) {
	// 	echo 'Message could not be sent.';
	// 	echo 'Mailer Error: ' . $mail->ErrorInfo;
	// } else {
	// 	echo 'Message has been sent';
	// }

	// unlink($file_name);
	fetch_customer_data($connect);


?>
<!-- <!DOCTYPE html>
<html>
	<head>
		<title>Create Dynamic PDF Send As Attachment with Email in PHP</title>
		<script src="assets/js/jquery-3.6.0.js"></script>
		<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
		<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	</head>
	<body>
		<br />
		<div class="container">
			<h3 align="center">Create Dynamic PDF Send As Attachment with Email in PHP</h3>
			<br />
			<form method="post">
				<input type="submit" name="action" class="btn btn-danger" value="PDF Send" /><?php echo $message; ?>
			</form>
			<br />
			<?php
			
			?>			
		</div>
		<br />
		<br />
	</body>
	
</html> -->





