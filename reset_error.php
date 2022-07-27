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
        <title>Alapaap</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Footer-Dark.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="assets/css/Map-Clean.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    </head>
    <body class="bg-light">

        <div class="container vh-100 d-grid align-items-center">
            <div class="row">
                <div class="col-md-8 col-lg-6 col-xl-6 offset-md-2 offset-lg-3 offset-xl-3">
                    <div class="card shadow-sm" style="font-family: 'Open Sans', sans-serif;">
                        <img class="card-img-top w-100 d-block" src="assets/img/kisspng-rox-hotel-flat-design-user-interface-content-connected-lines-5b379baa936332.2436380315303709866037.png">
                        <div class="card-body">
                            <div class="py-4">
                                <h4 class="text-center card-title fw-bold"><span>This link has already been used or expired!</span></h4>
                            </div>
                            <div class="text-center">
                                <a class="btn btn-success text-capitalize rounded" href="index.php"><i class="fa-fw fas fa-home me-1"></i>Home</a>
                            </div>
                        </div>
                    </div>
                </div>            
            </div>
        </div>
        <script src="assets/js/jquery-3.6.0.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script>
            // Disable  browser Refresh
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