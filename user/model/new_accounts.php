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

    if (isset($_POST['btn_approved_yes'])){
        $sql = mysqli_query($conn,"UPDATE tbl_user set status = '1' where uid = '$uid_account' ");

        $subject = "Alapaap Account Verified";
        $message = "Hello ".ucfirst($_POST['first_name'])." ".ucfirst($_POST['last_name']).",<br><br>"
        . "Your account has verified by our Approver.<br>"
        . "To login your account please <a href='http://".$_SERVER['SERVER_NAME']."/index.php'>click Here</a>.<br><br>"                    
        . "Thank you<br><br><br><br><i>This message is autogenerated Please do not respond.</i>"; 
    }

    if (isset($_POST['btn_disapproved_yes'])){
        $sql = mysqli_query($conn,"UPDATE tbl_user set status = '3' where uid = '$uid_account' ");
        $subject = "Alapaap Account Rejected";
        $message = "Hello ".ucfirst($_POST['first_name'])." ".ucfirst($_POST['last_name']).",<br><br>"
        . "Your account has rejected by our Approver.<br>"
        . "Thank you<br><br><br><br><i>This message is autogenerated Please do not respond.</i>"; 
    }

    if (isset($_POST['btn_delete_account'])){
        $sql = mysqli_query($conn,"DELETE FROM tbl_user where uid = '$uid_account' ");
        // $subject = "Alapaap Deleted Account";
        // $message = "Hello ".ucfirst($_POST['first_name'])." ".ucfirst($_POST['last_name']).",<br><br>"
        // . "Your account has deleted by our Approver.<br>"
        // . "Thank you<br><br><br><br><i>This message is autogenerated Please do not respond.</i>"; 
    }


    try {

        $mail->Host = '10.2.2.21';
        $mail->Port       = 25; 
        //Recipients
        $mail->setFrom('no-reply_bsp_alapaap@bsp.gov.ph', "BSP Alapaap");
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
    //     $mail->Username   = 'whyllardermie@gmail.com';                     //SMTP username
    //     $mail->Password   = 'gtoigwbluxfubmrh';     // alapaap@Bsp123                            //SMTP password
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
    //     $mail->Subject = $subject;
    //     $mail->Body    = $message;
    //     $mail->send();    
        
    // } catch (Exception $e) {
    //     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    // }  

    header("location: http://".$_SERVER['SERVER_NAME']."/user/new_users.php");
}

?>