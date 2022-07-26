<?php  

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

date_default_timezone_set('Etc/UTC');

include '../vendor/autoload.php';

$mail = new PHPMailer(true);
     
    try {
        //Server settings
        $mail->SMTPDebug = 1;               
        $mail->Host = '10.2.2.21';          
        $mail->Port = 25;                               

        $mail->setFrom('no-reply_bspops@bsp.gov.ph', 'BSP OPS');
        $mail->addAddress($email_add);         //Add a recipient

        $mail->isHTML(true);                                  
        $mail->Subject = $subject;
        $mail->Body    = $message;
        $mail->send();    
        
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }       



    // $mail->Username   = 'alapaapbsp@gmail.com';                     //SMTP username
    // $mail->Password   = 'gzukzgnyuwjpfhwa';      // alapaapbsp@123                            //SMTP password
    // gmail password = alapaap@Bsp123
?>
