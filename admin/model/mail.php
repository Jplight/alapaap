<?php  

use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

date_default_timezone_set('Etc/UTC');

include '../vendor/autoload.php';

$mail = new PHPMailer(true);
     
    try {
        //Server settings             
        $mail->Host = '10.2.2.21';          
        $mail->Port = 25;                               

        $mail->setFrom('no-reply_bsp_alapaap@bsp.gov.ph', 'BSP Alapaap');
        $mail->addAddress($email_add);         //Add a recipient

        $mail->isHTML(true);                                  
        $mail->Subject = $subject;
        $mail->Body    = $message;
        $mail->send();    
        
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }       

    // try {              
    //     $mail->isSMTP();                                            //Send using SMTP
    //     $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    //     $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    //     $mail->Username   = 'alapaapbsp@gmail.com';                     //SMTP username
    //     $mail->Password   = 'mnhrfxiykqmwtnzo';      // alapaap@Bsp123                            //SMTP password
    //     $mail->SMTPSecure = 'tls';           
    //     $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    //     $mail->SMTPOptions = array (
    //         'ssl' => array(
    //             'verify_peer'  => false,
    //             'verify_peer_name'  => false,
    //             'allow_self_signed' => true)
    //     );
    //     //Recipients
    //     $mail->setFrom('alapaapbsp@gmail.com', 'Alapaap | eBiZolution');
    //     $mail->addAddress($email_add);         //Add a recipient

    //     $mail->isHTML(true);                                  
    //     $mail->Subject = "Password Recovery";
    //     $mail->Body    = $message;
    //     $mail->send();    
        
    // } catch (Exception $e) {
    //     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    // }   
?>
