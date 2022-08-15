<?php  
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include 'connection.php';
require '../../vendor/autoload.php';

$mail = new PHPMailer(true);

if (isset($_GET['userid'])) {
	$userid	= $_GET['userid'];
	$query = mysqli_query($conn,"SELECT * from tbl_user where uid = '$userid' ");
	$rows = mysqli_fetch_array($query);
	$status = '1';
	$sql = mysqli_query($conn,"UPDATE tbl_user set status = '$status' where uid = '$userid' ");

	$message = "Good Day ".ucfirst($rows['first_name'])." ".ucfirst($rows['last_name']).",<br><br>"
    . "Your account has been verified by our System Administrator.<br>"
    . "Please click <a href='http://".$_SERVER['SERVER_NAME']."/index.php'>Here</a> the click below to proceed in out Login Page!<br><br>"               
    . "Thank you<br>";
	
	try {
		//Server settings
	    $mail->SMTPDebug = 3;               
	    $mail->isSMTP();                                            //Send using SMTP
	    $mail->Host       = 'mail.laangkawalpilipinas.org';                     //Set the SMTP server to send through
	    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	    $mail->Username   = 'info@laangkawalpilipinas.org';                     //SMTP username
	    $mail->Password   = '3B1Zp@ss7028';                               //SMTP password
	    $mail->SMTPSecure = 'tls';           
	    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
	    $mail->SMTPOptions = array (
	        'ssl' => array(
	            'verify_peer'  => false,
	            'verify_peer_name'  => false,
	            'allow_self_signed' => true)
	    );
		//Send Email
		$mail->setFrom('alapaap@ebizolution.com', 'Alapaap | eBiZolution');
		
		//Attachments
		// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		//Recipients
		$mail->addAddress($rows['email_add']);              
						
		//Content
		$mail->isHTML(true);                                  
		$mail->Subject = "Alapaap Account has been Verified";
		$mail->Body    = $message;

		$mail->send();
        // $new_url = "https://".$_SERVER['SERVER_NAME']."/model/verification.php?dname=".convert_string('encrypt', $txt_fname)."&email=".$txt_email_add;
        // $new_url = "model/verification.php?display_name=".convert_string('encrypt',$txt_fname)."&email=".$txt_email_add;				
	} catch (Exception $e) {
		$_SESSION['result'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
		$_SESSION['status'] = 'error';
	}
	header("location: ../new_req.php");
}



?>