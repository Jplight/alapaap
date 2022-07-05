<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

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
    //Recipients
    $mail->setFrom('alapaap@ebizolution.com', 'Alapaap | eBiZolution');
    $mail->addAddress('wermie@ebizolution.com');         //Add a recipient

    $mail->isHTML(true);                                  
    $mail->Subject = "Password Recovery";
    $mail->Body    = 'awdawd';
    $mail->send();    
    
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
} 


?>