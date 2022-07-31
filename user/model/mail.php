<?php  

use PHPMailer\PHPMailer\PHPMailer;

// use PHPMailer\PHPMailer\SMTP;

use PHPMailer\PHPMailer\Exception;
date_default_timezone_set('Etc/UTC');

include '../vendor/autoload.php';

$mail = new PHPMailer(true);

$GetSender = mysqli_query($conn,"select * from tbl_user where role='$status' ");
$rowsSender = mysqli_fetch_array($GetSender);
       
if($status >=2 && $status <=6){
    $recipient = $rowsSender['email_add'];    // To Approver, Receiver,Performer,Confirmer and Verifier
}else if($status == 'admin'){
    $recipient = $rowsSender['email_add'];  
}else{
    $recipient = $_POST['form_owner_mail'];
}

    try {
        //Server settings
        // $mail->SMTPDebug = 1;               

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
//     $mail->SMTPDebug = 3;               
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
//     $mail->Subject = $subject;
//     $mail->Body    = $message;
//     $mail->send();    
    
// } catch (Exception $e) {
//     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
// }   

?>
