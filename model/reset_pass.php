<?php  
session_start();
ob_start();

use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
date_default_timezone_set('Etc/UTC');
require '../vendor/autoload.php';
include 'connection.php';

if (isset($_REQUEST['email']) && isset($_REQUEST['token']) && isset($_REQUEST['attempt'])) {
    $email = $_REQUEST['email'];
    $token = $_REQUEST['token'];
    $attempt = '0';

    $check_mail = mysqli_query($conn,"SELECT * FROM tbl_user WHERE attempt='".$attempt."' and  email_add = '".$email."'  ");
    $count = mysqli_num_rows($check_mail);
    if ($count > 0) {
            header("location: ../reset_error.php?email=".$_REQUEST['email']."&token=".$_REQUEST['token']."&attempt=".$attempt);
    }
    if ($count < 1) {
        if (isset($_POST['btn_reset_pass'])) {
            $txt_pword = hash_hmac('md5',$_POST['txt_pword'],'@Bsp1234*');
            $sql = mysqli_query($conn,"UPDATE tbl_user SET password = '$txt_pword', token = '0', attempt='0' where email_add = '$email' ");            
            if ($sql) {  
                
                $mail = new PHPMailer(true);

                $message = "Hello Alapaap User,<br><br>".
                "Your password has been changed succesfully.<br><br><br>".
                "<i>This message is intended only for the use of the person requesting.".
                "If you did not request assistance with your password, please notify the administrators by sending an e-mail to bspops@ebizolution.com</i>";

                try {
                              
                    $mail->Host = '10.2.2.21';       
                    $mail->Port       = 25;                               
                    $mail->setFrom('no-reply_bsp_alapaap@bsp.gov.ph', 'BSP Alapaap');
                    $mail->addAddress($email);      
    
                    $mail->isHTML(true);                                  
                    $mail->Subject = "Password Reset";
                    $mail->Body    = $message;
                    $mail->send();       
                    
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }  
                // try {
                //     //Server settings
                //     // $mail->SMTPDebug = 3;               
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
                //     $mail->addAddress($email);         //Add a recipient
        
                //     $mail->isHTML(true);                                  
                //     $mail->Subject = "Password Recovery";
                //     $mail->Body    = $message;
                //     $mail->send();    
                    
                // } catch (Exception $e) {
                //     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                // }  


                header("location: verification.php?token=".$_REQUEST['token']."&attempt=".$attempt);
            }
        }       
    }

}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Alapaap | Reset Password | Sign Up </title>
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat&amp;display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&amp;display=swap">
        <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
        <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="../assets/css/styles.css">
    </head>
    <body class="bg-light">
        <div class="container vh-100 d-grid align-items-center">
            <div class="row">
                <div class="col-sm-1 col-md-2 col-lg-3 col-xl-4 d-none d-md-block"></div>
                <div class="col">
                    <div class="card shadow-sm p-3">
                        <div class="card-body">
                            <div class="mb-2">
                                <img src="../assets/img/ebiz-logo.png" width="200">
                            </div>
                            <form id="frm_forgot_account" method="post">
                                <div class="mb-2">
                                    <label class="form-label fw-bold">Password *</label>
                                    <div class="d-flex justify-content-end">
                                        <input class="form-control" type="password" name="txt_pword" id="txt_pword" required minlength="8" maxlength="30" tabindex="5" style="font-family: 'Open Sans', sans-serif;"> 
                                        <div class="position-absolute me-2 bg-white d-flex align-self-center" style="z-index:4;">
                                            <button class="btn shadow-none btn-sm " type="button" id="btn_showpass" name="btn_showpass" hidden><i class="far fa-eye-slash"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Confirm Password *</label>
                                    <div class="d-flex justify-content-end">
                                        <input class="form-control" type="password" name="txt_confirm_pword" id="txt_confirm_pword" required minlength="8" maxlength="30" tabindex="6" style="font-family: 'Open Sans', sans-serif;"> 
                                        <div class="position-absolute me-2 bg-white d-flex align-self-center" style="z-index:4;">
                                            <button class="btn shadow-none btn-sm" type="button" id="btn_showpass2" name="btn_showpass2" hidden><i class="far fa-eye-slash"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-grid">
                                    <button class="btn btn-success" type="submit" name="btn_reset_pass" id="btn_reset_pass">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-1 col-md-2 col-lg-3 col-xl-4 d-none d-md-block"></div>
            </div>
        </div>
        <script src="../assets/js/jquery-3.6.0.js"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#btn_showpass').click(function(){
                    if('password' == $('#txt_pword').attr('type')){
                         $('#txt_pword').prop('type', 'text');
                         $("#btn_showpass").html('<i class="far fa-eye"></i>');
                    }else{
                         $('#txt_pword').prop('type', 'password');
                         $("#btn_showpass").html('<i class="far fa-eye-slash"></i>');
                    }
                });
                $("#txt_pword").keyup(function(){
                    if ($(this).val().length >= 1) {
                        $("#btn_showpass").removeAttr('hidden');   
                    }else{
                        $("#btn_showpass").attr('hidden',true);
                        $('#txt_pword').prop('type', 'password');
                        $("#btn_showpass").html('<i class="far fa-eye-slash"></i>');
                    }
                });
                $('#btn_showpass2').click(function(){
                    if('password' == $('#txt_confirm_pword').attr('type')){
                         $('#txt_confirm_pword').prop('type', 'text');
                         $("#btn_showpass2").html('<i class="far fa-eye"></i>');
                    }else{
                         $('#txt_confirm_pword').prop('type', 'password');
                         $("#btn_showpass2").html('<i class="far fa-eye-slash"></i>');
                    }
                });
                $("#txt_confirm_pword").keyup(function(){
                    if ($(this).val().length >= 1) {
                        $("#btn_showpass2").removeAttr('hidden');   
                    }else{
                        $("#btn_showpass2").attr('hidden',true);
                        $('#txt_confirm_pword').prop('type', 'password');
                        $("#btn_showpass2").html('<i class="far fa-eye-slash"></i>');
                    }
                });                
            });
        </script>
    </body>
</html>
<?php ob_end_flush(); ?>