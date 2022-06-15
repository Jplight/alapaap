<?php  
session_start();

use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;

require_once 'connection.php';
require_once 'function.php';

if (isset($_REQUEST['email']) && isset($_REQUEST['display_name'])) {
    $email = $_REQUEST['email'];
    $status = convert_string('encrypt', 'verified');
    $_SESSION['email'] = $email; 
    $sql = mysqli_query($conn,"select * from tbl_user where email_add = '".$email."'and status = '".$status."' ");

    $count = mysqli_num_rows($sql);
    if ($count > 0) {
        $message = "Oops link is already used!";
        $message_2 = "It seems the link is already used by someone!";
        $error = '<a class="btn btn-primary rounded text-capitalize" type="submit" href="../index.php"><i class="fa-fw fa fa-sign-in"></i>Sign in</a>';
    }else{
        $sql_2 = mysqli_query($conn,"update tbl_user set status = '".$status."' where email_add = '".$email."' ") or die(mysql_error());
        $message_3 = "Congratulation's you're done!";
        $message_4 = "The email that you provided is now verified by our system.";
        
        $url1= "../user/index.php";
        $login = '<a class="btn btn-primary rounded text-capitalize" type="submit" href="'.$url1.'"><i class="fa-fw fa fa-sign-in"></i>Login Now</a>';
        
        $sql_2 = mysqli_query($conn,"select * from tbl_user where email_add = '".$email."' ");
        $rows = mysqli_fetch_array($sql_2);
        $_SESSION['uid'] = $rows['uid'];
        $_SESSION['role'] = $rows['role'];
        header("Refresh: 3; URL=$url1");
    }
        
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Revision-Avizto</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
    <link rel="stylesheet" href="../assets/css/mycss.css">
</head>

<body style="font-family: 'Open Sans', sans-serif;">
    <section class="pb-0" style="padding-top: 7rem !important;">
        <div class="container">
            <?php
                if(ISSET($_REQUEST['email']) && isset($_REQUEST['display_name'])){
                    $email = $_REQUEST['email'];
                    $_SESSION['email'] = $email;
            ?>
            <div class="row">
                <div class="col-md-8 col-lg-6 col-xl-6 offset-md-2 offset-lg-3 offset-xl-3">
                    <div class="card shadow-sm" style="font-family: 'Open Sans', sans-serif;">
                        <img class="card-img-top w-100 d-block" src="../assets/img/kisspng-rox-hotel-flat-design-user-interface-content-connected-lines-5b379baa936332.2436380315303709866037.png">
                        <div class="card-body pl-5 pr-5">
                            <h4 class="text-center card-title font-weight-bold">
                                <?php  
                                    if ($count > 0) {
                                        echo "<span>".$message."</span>";
                                    }else{
                                         echo "<span>".$message_3."</span>";
                                    }
                                ?>
                            </h4>
                            <p class="text-start"><br>Hi, <?php echo ucfirst(convert_string('decrypt',$_REQUEST['display_name'])); ?></p>
                                 <?php  
                                    if ($count > 0) {
                                        echo "<span>".$message_2."</span>";
                                    }else{
                                         echo "<span>".$message_4."</span>";
                                    }
                                ?>

                            <p>Please let me know if you have any questions or would like further information, otherwise, no response is needed.<br>You may now login to your account<p>
                            <div class="text-center">
                                <?php  
                                    if ($count > 0) {
                                        echo $error;
                                    }else{
                                        echo $login;
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script src="../assets/js/creative.js"></script>
    <script src="../assets/js/myscript.js"></script>
    <script>
        document.onkeydown = function(){
          switch (event.keyCode){
                case 116 : //F5 button
                    event.returnValue = false;
                    event.keyCode = 0;
                    return false;
                case 82 : //R button
                    if (event.ctrlKey){ 
                        event.returnValue = false;
                        event.keyCode = 0;
                        return false;
                    }
            }
        }
    </script>
</body>

</html>