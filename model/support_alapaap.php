<?php 
session_start();


$email = $_REQUEST['email'];
$resultmob = substr($email,0,3);
$resultmob .= "************";
$resultmob .= substr($email,strpos($email, "@"));
$email_hash = $resultmob;

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
                
                <div class="col-md-8 col-lg-6 col-xl-6 offset-md-2 offset-lg-3 offset-xl-3">
                    <div class="card shadow-sm" style="font-family: 'Open Sans', sans-serif;">
                        <img class="card-img-top w-100 d-block" src="../assets/img/kisspng-rox-hotel-flat-design-user-interface-content-connected-lines-5b379baa936332.2436380315303709866037.png">
                        <div class="card-body">
                            <h4 class="text-center card-title fw-bold">You're almost done!</h4>
                            <div class="d-flex justify-content-center">
                                <p class="text-start"><br>Hello User!<br><br>You requested to reset the password for your Alapaap account with the email address of <b><?php echo $email_hash; ?></b> confirmation link was sent to this email.</p>
                            </div>
                            <div class="text-center">
                                <a class="btn btn-success text-capitalize rounded" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>"><i class="fa-fw fas fa-arrow-left me-1"></i>Go Back</a>
                            </div>
                        </div>
                    </div>
                </div>
                                
            </div>
        </div>
        <script src="../assets/js/jquery-3.6.0.js"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>