<?php  

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
include '../vendor/autoload.php';
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

            
    try {
        //Server settings
        $mail->SMTPDebug = 3;               
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'alapaapbsp@gmail.com';                     //SMTP username
        $mail->Password   = 'gzukzgnyuwjpfhwa';      // alapaapbsp@123                            //SMTP password
        $mail->SMTPSecure = 'tls';           
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->SMTPOptions = array (
            'ssl' => array(
                'verify_peer'  => false,
                'verify_peer_name'  => false,
                'allow_self_signed' => true)
        );
        //Recipients
        $mail->setFrom('alapaapbsp@gmail.com', 'Alapaap | eBiZolution');
        $mail->addAddress($email_add);         //Add a recipient

        $mail->isHTML(true);                                  
        $mail->Subject = "Password Recovery";
        $mail->Body    = $message;
        $mail->send();    
        
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }       


?>
