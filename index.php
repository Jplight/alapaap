<?php  
session_start();
ob_start();

if (isset($_SESSION['uid'])) {
    if ($_SESSION['role'] == 'admin') {
        header("location: admin/index.php");
    }
    if ($_SESSION['role'] >=1 ) {
        header("location: user/index.php");
    }
}

?>
<!DOCTYPE html>
<html class="m-0 h-100" lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Alapaap | eBizolution </title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat&amp;display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&amp;display=swap">
        <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
        <link rel="stylesheet" href="assets/css/Footer-Dark.css">
        <link rel="icon" type="image/svg+xml" sizes="30x24" href="assets/img/android-chrome-192x192.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
        <link rel="stylesheet" href="assets/css/Map-Clean.css">
        <link rel="stylesheet" href="assets/css/styles.css">
        <style type="text/css">
            ::-webkit-scrollbar {
              width: 10px;
              height: 10px;
                cursor: pointer;
            }

            /* Track */
            ::-webkit-scrollbar-track {
              background: #f1f1f1;
              cursor: pointer;
            }
             
            /* Handle */
            ::-webkit-scrollbar-thumb {
              background: #888; 
              border-radius: 10px;
              cursor: pointer;
            }

            /* Handle on hover */
            ::-webkit-scrollbar-thumb:hover {
              background: #555; 
              cursor: pointer; 
            }
            .navbar-nav .nav-item .nav-link{
                transition: all ease 0.5s;
                color: black;
            }
            .navbar-nav .nav-item .nav-link:hover{
                color: green;
            }
            .img_responsive{
                width: 120px;
            }
            @media (min-width: 576px) {
                .img_responsive{
                   width: 120px;
                }
            }
            @media (min-width: 768px){
                .img_responsive{
                    width: 200px;
                }
            }
            @media (min-width: 992px){
                .img_responsive{
                    width: 270px;
                }
            }
            @media (min-width: 1200px) {
                .img_responsive{
                    width: 500px;
                }
            }
        </style>
    </head>
    <body class="m-0 h-100" style="font-family: Montserrat, sans-serif; oveflow-y:hidden;">

        <nav class="navbar navbar-light navbar-expand-md fixed-top bg-white shadow-sm py-0 px-md-5">
            <div class="container-fluid">
                <a class="navbar-brand " href="http://www.ebizolution.com/" >
                    <img class="img-fluid" src="assets/img/viber_image_2022-02-10_13-50-23-414.png" width="120">
                </a>
                <div class="collapse navbar-collapse">
                     <ul class="navbar-nav ms-auto text-uppercase text-capitalize">
                        <li class="nav-item dropdown" >
                            <a class="nav-link dropdown-toggle" aria-expanded="false" href="#" data-bs-toggle="dropdown">Our solutions</a>
                            <div class="dropdown-menu dropdown-menu-end rounded-0 rounded-bottom border-top-0">
                                <a class="dropdown-item px-3 py-2" href="http://www.ebizolution.com/solutions/security-management/">security management</a>
                                <a class="dropdown-item px-3 py-2" href="http://www.ebizolution.com/solutions/asset-management/">Asset management</a>
                                <a class="dropdown-item px-3 py-2" href="http://www.ebizolution.com/solutions/systems-management/">System management</a>
                                <a class="dropdown-item px-3 py-2" href="http://www.ebizolution.com/solutions/resiliency-management/">resiliency management</a>
                                <a class="dropdown-item px-3 py-2" href="http://www.ebizolution.com/solutions/wellness-management/">wellness management</a>
                                <a class="dropdown-item px-3 py-2" href="http://www.ebizolution.com/solutions/knowledge-management/">knowledge management</a>
                                <a class="dropdown-item px-3 py-2" href="http://www.ebizolution.com/solutions/governance-management/">governance management</a>
                            </div>
                        </li>                                    
                        <li class="nav-item">
                            <a class="nav-link active" href="http://www.ebizolution.com/about/">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="http://www.ebizolution.com/contact/">Contact</a>
                        </li>
                    </ul>               
                </div>
                <button class="btn navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_mobile">
                    <span class="visually-hidden">Toggle navigation</span>
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
        <section class="box d-none d-md-block " style="background: url(&quot;assets/img/ebizbg_2-1.png&quot;) center / cover no-repeat;">
            <div class="container-fluid gx-4 d-md-flex align-items-md-end h-100 py-md-5 ">
                <div class="row g-0 w-100">
                    <div class="col-md-6 col-lg-7 col-xl-8 ">
                        <div class="text-start text-white d-md-flex d-lg-flex d-xl-flex align-items-md-center align-items-lg-center align-items-xl-start h-100 mx-3 " style="z-index:9;">
                            <h2 class="display-5 text-uppercase mt-xl-5" style="font-family: 'Open Sans', sans-serif;font-weight: bold;">BSP Managed Services <br>Requisition System</h2>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-5 col-xl-4 ">
                        <div class="card text-white border-0" style="background: transparent;">
                            <div class="card-body">
                                <h4 class="card-title fw-bold mb-5" style="text-align: center;">Welcome to Alapaap!</h4>
                                <?php require 'inc/sign_in.php'; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex justify-content-end align-items-center ">
                            <span class="fw-bold text-white me-1">Powered by</span>
                            <img class="img-fluid" src="assets/img/android-chrome-192x192.png" width="25">
                            <span class="fw-bold text-white">BiZolution</span>
                            <!-- <img class="img-fluid" src="assets/img/viber_image_2022-02-14_10-21-51-173.png" width="150"> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvas_mobile">
            <div class="container">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title">Quick Links</h5>
                    <button type="button" class="btn-close text-reset shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
            </div>
            <div class="offcanvas-body d-flex flex-column justify-content-between">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active link-secondary" data-bs-toggle="modal" data-bs-target="#modal_signin" href="#">Sign In</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="modal" href="sign_up.php">Register</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" aria-expanded="false" href="#" data-bs-toggle="dropdown" >Our solutions</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item px-3 py-2" href="http://www.ebizolution.com/solutions/security-management/">security management</a>
                            <a class="dropdown-item px-3 py-2" href="http://www.ebizolution.com/solutions/asset-management/">Asset management</a>
                            <a class="dropdown-item px-3 py-2" href="http://www.ebizolution.com/solutions/systems-management/">System management</a>
                            <a class="dropdown-item px-3 py-2" href="http://www.ebizolution.com/solutions/resiliency-management/">resiliency management</a>
                            <a class="dropdown-item px-3 py-2" href="http://www.ebizolution.com/solutions/wellness-management/">wellness management</a>
                            <a class="dropdown-item px-3 py-2" href="http://www.ebizolution.com/solutions/knowledge-management/">knowledge management</a>
                            <a class="dropdown-item px-3 py-2" href="http://www.ebizolution.com/solutions/governance-management/">governance management</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://www.ebizolution.com/about/">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://www.ebizolution.com/contact/">Contact</a>
                    </li>
                </ul>
                <div class="d-grid">
                    <button class="btn btn-outline-success shadow-none" type="button" data-bs-dismiss="offcanvas">Close</button>
                </div>
            </div>
        </div>
        <div class="modal fade" role="dialog" tabindex="-1" id="modal_signin" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-fullscreen-md-down" role="document">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0">
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex justify-content-center align-items-center">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title fw-bold" style="text-align: center;">Welcome to eBizolution!</h4>
                                <h6 class="card-text text-muted" style="text-align: center;">We are Solutions Provider and Systems Integrator. <br>
                                </h6>
                                <?php require 'inc/sign_in.php'; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <header class="d-block d-md-none">
            <div class="d-flex align-items-center" style="overflow:hidden;">
                <div class="text-start text-white position-absolute m-5" data-aos="fade-down" data-aos-duration="800" data-aos-once="true" style="z-index:9;">
                    <div class="w-100">
                        <img class="img_responsive" src="assets/img/viber_image_2021-12-17_10-11-05-872.png" width="150">
                    </div>
                    <h1 class="display-4 text-uppercase h1_custom" style="font-family: 'Open Sans', sans-serif;font-weight: bold;">infra services <br>requisition system </h1>
                </div>
                <img class="img-fluid" style="filter: brightness(63%);" src="assets/img/ebizbg_2.png">
            </div>
        </header>
        <section id="access" class="bg-light pt-5 pb-5 d-block d-md-none" style="background: url(&quot;assets/img/header-d47d673672_2.svg&quot;) center / cover;">
            <div class="container">
                <h1 class="text-center text-white mb-3 mb-md-0" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400" data-aos-once="true" style="font-weight: bold;">Access</h1>
                <div class="row mt-md-5">
                    <div class="col-md-1 col-lg-6 col-xl-6 d-lg-flex d-xl-flex align-items-lg-center align-items-xl-center d-none d-lg-block">
                        <img class="img-fluid" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="650" data-aos-once="true" src="assets/img/pngegg.png">
                    </div>
                    <div class="col-md-10 col-lg-6 offset-md-1 offset-lg-0">
                        <div class="card shadow-sm pt-3 pb-3" data-aos="fade-up" data-aos-duration="800" data-aos-delay="850" data-aos-once="true" style="border-radius: 15px;">
                            <div class="card-body p-md-5">
                                <h5 class="card-title fw-bold" style="text-align: center;">Welcome to eBizolution!</h5>
                                <h6 class="card-text text-muted" style="text-align: center;">We are Solutions Provider and Systems Integrator. <br>
                                </h6>
                                <?php require 'inc/sign_in.php'; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/bs-init.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
        <script>            
            $(document).ready(function(){


                $("#frm_signin").submit(function(){
                    return false;
                });

                $("#btn_signin").click(function(){
                    var email = $("#email_add").val();
                    var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
                    if ($("#email_add").val().length == 0 && $("#pass").val().length == 0 ) {
                        alert("Please fill up the fields!");
                    }
                    if(pattern.test(email)) {
                        $.ajax({
                            url: "model/sign_in.php",
                            type: "POST",
                            data: $("#frm_signin").serialize(),
                            dataType: 'JSON',
                            beforeSend: function(){
                                $("#btn_signin").prop('disabled', true);
                                $("input").attr('disabled',true);
                                $("#didilim").addClass('overlay open');   
                            },
                            success: function(data){
                                if (data.status ==='Success') {
                                    window.location = data.link;
                                    $("#frm_signin").trigger('reset');
                                }
                                if (data.status === 'Unverified') {
                                    alert(data.message);
                                    window.location = data.link;
                                }
                                if (data.status === 'Failed') {
                                    alert(data.message);
                                }
                                if (data.status === 'not_exist') {
                                    alert(data.message);
                                }
                                if (data.status === 'disabled') {
                                    alert(data.message);
                                }
                                
                            },complete: function(){
                                $("#btn_signin").prop('disabled', false);
                                $("input").attr('disabled',false);
                                $("#didilim").removeClass('overlay open ');
                            },error: function(data){
                                alert("Error!");
                            }
                        });
                    }
                });

                $("#chk_showpass").click(function(){
                    var chk_showpass = $(this).is(":checked"); 
                    if (chk_showpass){
                        $("#pass").prop('type','text');
                    }else{
                        $("#pass").prop('type','password');
                    }
                }); 
  
              //  $('#chk_showpass').on('click', function(){
              //     var passInput=$("#pass");
              //     if(passInput.attr('type')==='password')
              //       {
              //         passInput.attr('type','text');
              //     }else{
              //        passInput.attr('type','password');
              //     }
              // });

            });
        </script>
    </body>
</html>
<?php ob_end_flush(); ?>