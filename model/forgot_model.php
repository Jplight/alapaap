<?php  
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


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
            $message = "Dear Customer<br>"
            . "Please click the link below to reset your password.<br>"
            . "You will be automatically redirected to a welcome page where you can then change your password in your account.<br><br>"            
            . "<a href='$link'>Click Here!</a>"; 
            
            // $message = file_get_contents("model/template/forms_notification.html");
            
            try {
                
                $mail->SMTPDebug = 1;               
                $mail->Host = '10.2.2.21';       
                $mail->Port       = 25;                               
                $mail->setFrom('no-reply_bspops@bsp.gov.ph', 'BSP');
                $mail->addAddress($email_add);      

                $mail->isHTML(true);                                  
                $mail->Subject = "Password Recovery";
                $mail->Body    = $message;
                $mail->send();    
                
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }       
    }else{
            $not_exist = "The email you entered does not exist!";    
    }
    header("location: http://".$_SERVER['SERVER_NAME']."/model/support_alapaap.php?email=".$email_add."&token=".$token);
    mysqli_close($conn);
}

?>
