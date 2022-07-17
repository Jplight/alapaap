<?php  

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;
date_default_timezone_set('Etc/UTC');

include '../vendor/autoload.php';

$mail = new PHPMailer(true);


$GetSender = mysqli_query($conn,"select * from tbl_user where role='$status' ");
$rowsSender = mysqli_fetch_array($GetSender);
       
if($status >=2 && $status <=6){
    $sender_email = $rowsSender['email_add'];
}else if($status == 'admin'){
    $sender_email = $rowsSender['email_add'];
}else{
    $sender_email = $form_owner_mail;
}

    try {
        //Server settings
        $mail->SMTPDebug = 1;               

        $mail->Host = '10.2.2.21';
 
        $mail->Port       = 25; 

        //Recipients
        $mail->setFrom('no-reply_bspops@bsp.gov.ph', $department_name." Alapaap");
        $mail->addAddress($sender_email);         //Add a recipient
        $mail->addReplyTo('no-reply_bspops@bsp.gov.ph', 'No Reply');
        $mail->addCC($email_add);

        $mail->isHTML(true);                                  
        $mail->Subject = $form_subject." Request Form";
        $mail->Body    = $message;
        $mail->send();    
        
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }       


?>
