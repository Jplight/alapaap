<?php 

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
                
                $subject = "Password Reset";
                $message = "Hello Alapaap User,<br><br>".
                "Your password has been changed succesfully.<br><br><br>".
                "<i>This message is intended only for the use of the person requesting.".
                "If you did not request assistance with your password, please notify the administrators by sending an e-mail to bspops@ebizolution.com</i>";

                require 'mail.php';

                header("location: /model/verification.php?token=".$_REQUEST['token']."&attempt=".$attempt);
            }
        }       
    }

}


?>