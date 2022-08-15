<?php  

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';
require 'connection.php';
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

if (isset($_GET['email']) && isset($_GET['uid'])) {

    $email_add  = $_GET['email'];
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
            
            // $message = file_get_contents("model/weng.html");
            
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
                $mail->addAddress($email_add);         //Add a recipient
                $mail->addAddress('ellen@example.com');               //Name is optional


                $mail->isHTML(true);                                  
                $mail->Subject = "Password Recovery";
                $mail->Body    = $message;
                $mail->send();    
                header("location: http://".$_SERVER['SERVER_NAME']."/model/support_alapaap.php?email=".$email_add."&token=".$token);
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }       
    }else{
            $not_exist = "The email you entered does not exist!";    
    }
    mysqli_close($conn);
}

?>