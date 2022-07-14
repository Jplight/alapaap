<?php  
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
require 'connection.php';
//Create an instance; passing `true` enables exceptions
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
    }else{
            $not_exist = "The email you entered does not exist!";    
    }
    header("location: http://".$_SERVER['SERVER_NAME']."/model/support_alapaap.php?email=".$email_add."&token=".$token);
    mysqli_close($conn);
}

?>
