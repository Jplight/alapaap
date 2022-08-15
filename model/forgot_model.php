<?php  
session_start();
use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
date_default_timezone_set('Etc/UTC');
require 'vendor/autoload.php';
require 'connection.php';

$mail = new PHPMailer(true);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email_add  = $_POST['email_add'];
    $attempt = '1';
    $token = md5(rand(10000,99999));

    $sql = mysqli_query($conn,"SELECT * FROM tbl_user WHERE email_add = '$email_add'");
    $count = mysqli_num_rows($sql);
    $rows = mysqli_fetch_array($sql);
    if ($count > 0){ 
            $sql_2 = mysqli_query($conn,"UPDATE tbl_user SET token='$token', attempt='$attempt' WHERE email_add = '$email_add' ");
            
            $link = "http://".$_SERVER['SERVER_NAME']."/model/reset_pass.php?email=".$email_add."&token=".$token."&attempt=".$attempt;
            $message = "Hello Alapaap User,<br><br>".
            "Please click the link to reset your password. <a href='$link'>Click Here!</a><br><br><br>".
            "<i>This message is intended only for the use of the person requesting.".
            "If you did not request assistance with your password, please notify the administrators by sending an e-mail to bspops@ebizolution.com</i>";
             
            // $message = file_get_contents("model/template/forms_notification.html");
            
            try {
                              
                $mail->Host = '10.2.2.21';       
                $mail->Port       = 25;                               
                $mail->setFrom('no-reply_bsp_alapaap@bsp.gov.ph', 'BSP Alapaap');
                $mail->addAddress($email_add);      

                $mail->isHTML(true);                                  
                $mail->Subject = "Password Recovery";
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
        //     $mail->setFrom('alapaapbsp@gmail.com', 'Alapaap | eBiZolution');
        //     $mail->addAddress($email_add);         //Add a recipient

        //     $mail->isHTML(true);                                  
        //     $mail->Subject = "Password Recovery";
        //     $mail->Body    = $message;
        //     $mail->send();    
            
        // } catch (Exception $e) {
        //     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        // }             

    }else{
        $not_exist = "The email you entered does not exist!";    
    }
    header("location: http://".$_SERVER['SERVER_NAME']."/model/support_alapaap.php?email=".$email_add."&token=".$token);
    mysqli_close($conn);
}

?>
