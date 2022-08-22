<?php  
session_start();

require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email  = $_POST['email_add'];
    $attempt = '1';
    $token = md5(rand(10000,99999));

    $sql = mysqli_query($conn,"SELECT * FROM tbl_user WHERE email_add = '$email'");
    $count = mysqli_num_rows($sql);
    $rows = mysqli_fetch_array($sql);
    if ($count > 0){ 
            $sql_2 = mysqli_query($conn,"UPDATE tbl_user SET token='$token', attempt='$attempt' WHERE email_add = '$email' ");
            
            $link = "http://".$_SERVER['SERVER_NAME']."/reset_pass.php?email=".$email."&token=".$token."&attempt=".$attempt;
            
            $subject = "Password Recovery";
            $message = "Hello Alapaap User,<br><br>".
            "Please click the link to reset your password. <a href='$link'>Click Here!</a><br><br><br>".
            "<i>This message is intended only for the use of the person requesting.".
            "If you did not request assistance with your password, please notify the administrators by sending an e-mail to bspops@ebizolution.com</i>";
             
            // $message = file_get_contents("model/template/forms_notification.html");
            
            require 'mail.php';
    }else{
        $not_exist = "The email you entered does not exist!";    
    }
    header("location: http://".$_SERVER['SERVER_NAME']."/model/support_alapaap.php?email=".$email."&token=".$token);
    mysqli_close($conn);
}

?>
