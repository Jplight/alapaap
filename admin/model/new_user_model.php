<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include 'connection.php';
require '../vendor/autoload.php';

$mail = new PHPMailer(true);

if(isset($_POST['btn_new_u'])){
    $email_add = $_POST['email_add'];
    $pass = hash_hmac('md5',$_POST['pass'],'@Bsp1234*');
    $u_role = $_POST['u_role'];
    $status = '0';
    $sql = mysqli_query($conn,"INSERT INTO `tbl_user`(`email_add`, `password`,`status`,`role`,`default_role`,`created_by`) VALUES ('$email_add','$pass','$status','$u_role','$u_role','$my_role')");
    $backup = mysqli_query($conn,"INSERT INTO tbl_backup_pass (email_add,role,password,status) values ('$email_add','$u_role','".$_POST['pass']."','$status') ");
    
    $user_alert = "<div class='alert alert-success' id='alert'>Account <span class='fw-bold'> ".$email_add."</span> has been succefuly added.</div>";
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

        $mail->isHTML(true);                                  
        $mail->Subject = "Password Recovery";
        $mail->Body    = "awdawdawdawd";
        $mail->send();    
        
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    header("location: http://".$_SERVER['SERVER_NAME']."/admin/user_management.php");
}

if (isset($_POST['btn_update_role'])) {
    $users_id = $_POST['users_id'];
    $his_id = $_POST['his_id'];

    $chk_requestor 	= $_POST['chk_requestor'];
    $chk_approver 	= $_POST['chk_approver'];
    $chk_reciever 	= $_POST['chk_reciever'];
    $chk_performer 	= $_POST['chk_performer'];
    $chk_confirmer 	= $_POST['chk_confirmer'];
    $chk_verifier 	= $_POST['chk_verifier'];

if (isset($_POST['btn_approve_role'])) {
    $new_role = $chk_requestor.$chk_approver.$chk_reciever.$chk_performer.$chk_confirmer.$chk_verifier;
    $sql_updated_role = mysqli_query($conn,"UPDATE tbl_user set multi_role = '$new_role' where uid = '$his_id' ");
    $sql_role = mysqli_query($conn,"UPDATE tbl_req_role set status = '1' where uid = '$users_id' and his_id = '$his_id' ");
}


if (isset($_POST['btn_reject_role'])) {
    $sql_role = mysqli_query($conn,"UPDATE tbl_req_role set status = '2' where uid = '$users_id' and his_id = '$his_id' ");
}


}

?>