<?php 
session_start();

require_once 'function.php';

if (isset($_REQUEST['email'])) {
    $resultmob = substr($_REQUEST['email'],0,3);
    $resultmob .= "************";
    $resultmob .= substr($_REQUEST['email'],strpos($_REQUEST['email'], "@"));
    $email_hash = $resultmob;    
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>BSP | Alapaap</title>
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat&amp;display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&amp;display=swap">
        <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
        <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="../assets/fonts/ionicons.min.css">
        <link rel="stylesheet" href="../assets/css/Footer-Dark.css">
        <link rel="stylesheet" href="../assets/css/Map-Clean.css">
        <link rel="stylesheet" href="../assets/css/styles.css">
    </head>
    <body class="bg-light">

        <div class="container vh-100 d-grid align-items-center">
            <div class="row">
                <?php
                    if(isset($_REQUEST['display_name']) && isset($_REQUEST['email'])):
                ?>                
                <div class="col-md-8 col-lg-6 col-xl-6 offset-md-2 offset-lg-3 offset-xl-3">
                    <div class="card shadow-sm" style="font-family: 'Open Sans', sans-serif;">
                        <img class="card-img-top w-100 d-block" src="../assets/img/kisspng-rox-hotel-flat-design-user-interface-content-connected-lines-5b379baa936332.2436380315303709866037.png">
                        <div class="card-body ">
                            <h4 class="text-center card-title fw-bold">You're almost done!</h4>
                            <div class="d-flex justify-content-center">
                                <p><br>Hi, <?php  echo ucfirst(convert_string('decrypt', $_REQUEST['display_name'])); ?><br>Thank you for registering in our Website!<br>Our team will review your application.<br>Once your application is approved We will sent you a confirmation link through this email <b><?php echo $email_hash; ?></b><br>so, Please stay tuned!.<br><br>Thank You!<br><br></p>
                            </div>
                            <div class="text-center">
                                <a class="btn btn-success text-capitalize rounded" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>" ><i class="fa fa-home me-2"></i>Home</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if(isset($_REQUEST['email']) && isset($_REQUEST['token'])): ?>
                <div class="col-md-8 col-lg-6 col-xl-6 offset-md-2 offset-lg-3 offset-xl-3">
                    <div class="card shadow-sm" style="font-family: 'Open Sans', sans-serif;">
                        <img class="card-img-top w-100 d-block" src="../assets/img/kisspng-rox-hotel-flat-design-user-interface-content-connected-lines-5b379baa936332.2436380315303709866037.png">
                        <div class="card-body">
                            <h4 class="text-center card-title fw-bold">You're almost done!</h4>
                            <div class="d-flex justify-content-center">
                                <p class="text-start"><br>Hello User!<br><br>We sent you a confirmation link in this email <b><?php echo $email_hash; ?></b>. Please check your email account to reset your password.<br><br>Thank You!<br><br></p>
                            </div>
                            <div class="text-center">
                                <a class="btn btn-success text-capitalize rounded" href="http://<?php echo $_REQUEST['email']; ?>"><i class="fa fa-envelope me-2"></i>Go to Email</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if (isset($_REQUEST['token']) && isset($_REQUEST['attempt'])): ?>
                <div class="col-md-8 col-lg-6 col-xl-6 offset-md-2 offset-lg-3 offset-xl-3">
                    <div class="card shadow-sm" style="font-family: 'Open Sans', sans-serif;">
                        <img class="card-img-top w-100 d-block" src="../assets/img/kisspng-rox-hotel-flat-design-user-interface-content-connected-lines-5b379baa936332.2436380315303709866037.png">
                        <div class="card-body">
                            <div class="py-4">
                                <h4 class="text-center card-title fw-bold">Reset Password Completed!</h4>
                            </div>
                            <div class="text-center">
                                <a class="btn btn-success text-capitalize rounded" href="http://<?php echo $_SERVER['SERVER_NAME'].'/index.php'; ?>"><i class="fa-fw fas fa-home me-1"></i>Home</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>                
            </div>
        </div>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>