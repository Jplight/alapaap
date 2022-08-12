<?php  
use PHPMailer\PHPMailer\PHPMailer;

// use PHPMailer\PHPMailer\SMTP;

use PHPMailer\PHPMailer\Exception;
date_default_timezone_set('Etc/UTC');

require '../../vendor/autoload.php';

$mail = new PHPMailer(true);


require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$uid_account	= $_POST['uid_account'];
    $recipient = $_POST['email_add'];
    $email_add = $_POST['approver_mail'];

	$sql = mysqli_query($conn,"UPDATE tbl_user set status = '1' where uid = '$uid_account' ");
    $department_name = "BSP";
    $subject = "Alapaap Account has been Verified";
	$message = "Good Day ".ucfirst($rows_users['first_name'])." ".ucfirst($rows_users['last_name']).",<br><br>"
    . "Your account has been verified by our Approver.<br>"
    . "Please click <a href='http://localhost/revision_alapaap/index.php'>Here</a> the click below to proceed in out Login Page!<br><br>"               
    . "Thank you<br>";

    try {

        $mail->Host = '10.2.2.21';
        $mail->Port       = 25; 
        //Recipients
        $mail->setFrom('no-reply_bsp_alapaap@bsp.gov.ph', $department_name." Alapaap");
        $mail->addAddress($recipient);         //Add a recipient
        $mail->addCC($email_add);

        $mail->isHTML(true);                                  
        $mail->Subject = $subject;
        $mail->Body    = $message;
        $mail->send();    
        
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }       


    // try {
    //     //Server settings              
    //     $mail->isSMTP();                                            //Send using SMTP
    //     $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    //     $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    //     $mail->Username   = 'alapaapbsp@gmail.com';                     //SMTP username
    //     $mail->Password   = 'lykcjxwaufpwhznx';      // alapaap@Bsp123                            //SMTP password
    //     $mail->SMTPSecure = 'tls';           
    //     $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    //     $mail->SMTPOptions = array (
    //         'ssl' => array(
    //             'verify_peer'  => false,
    //             'verify_peer_name'  => false,
    //             'allow_self_signed' => true)
    //     );
    //     //Recipients
    //     $mail->setFrom('alapaapbsp@gmail.com', 'BSP Alapaap');
    //     $mail->addAddress($recipient);         //Add a recipient
    //     $mail->addCC($email_add);
        
    //     $mail->isHTML(true);                                  
    //     $mail->Subject = "Alapaap Account has been Verified";
    //     $mail->Body    = $message;
    //     $mail->send();    
        
    // } catch (Exception $e) {
    //     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    // }  

    header("location: http://".$_SERVER['SERVER_NAME']."/user/new_users.php");
}

?>