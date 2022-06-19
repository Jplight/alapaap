<?php  

ob_start();
include 'model/forgot_model.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Alapaap | Forgot Password</title>
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
            <div class="col-sm-1 col-md-2 col-lg-3 col-xl-4 d-none d-md-block"></div>
            <div class="col">
                <div class="card shadow-sm p-3">
                    <div class="card-body">
                        <div class="mb-3">
                            <a href="http://<?=$_SERVER['SERVER_NAME'];?>">
                                <img src="assets/img/ebiz-logo.png" width="200">
                            </a>
                        </div>
                        <form id="frm_forgot" method="post">
                            <div class="mb-2"><label class="form-label fw-bold">Email Address *</label>
                                <input class="form-control form-control" type="email" id="email_add" name="email_add" required="">
                            </div>
                            <!-- <div class="mb-2 small">
                                <span>Not a Member? <a class="text-decoration-none" href="sign_up.php">Sign up Now</a></span>
                            </div> -->
                            <div class="d-grid">
                                <button class="btn btn-success" type="submit" name="btn_search" id="btn_search">Submit</button>
                            </div>
                            <span class="small text-danger" id="txt_error"><?php echo (!empty($not_exist)) ? $not_exist : ''; ?></span>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-1 col-md-2 col-lg-3 col-xl-4 d-none d-md-block"></div>
        </div>
    </div>
    <script src="assets/js/jquery-3.6.0.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        $(document).ready(function(){
            $("#email_add").keyup(function(){
                if ($(this).val().length >= 1) {
                    $("#txt_error").prop('hidden',true);   
                }
            });

            $("#frm_forgot").submit(function(){
                $("#btn_search").attr('disabled',true);
            });
        });
    </script>
    <script>
        // $(document).ready(function(){
        //     $("#frm_forgot").submit(function(){
        //         return false;
        //     });
            
        //     // alert("awdawda");

        //     $("#btn_search").click(function(){
        //         var email = $("#email_add").val();
        //         var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
        //         if ($("#email_add").val().length == 0) {
        //             alert("Please fill up the fields!");
        //         }
        //         if(pattern.test(email)) {
        //             $.ajax({
        //                 url: "model/forgot_model.php",
        //                 type: "POST",
        //                 data: $("#frm_forgot").serialize(),
        //                 dataType: 'JSON',
        //                 beforeSend: function(){
        //                     $("#btn_search").prop('disabled', true);
        //                     $("input").attr('disabled',true);
        //                     // $("#didilim").addClass('overlay open');   
        //                 },success: function(data){
        //                     if (data.status === 'Success') {
                                
        //                         window.location.assign(data.link);
        //                         alert(data.message);
        //                     }
        //                     if (data.status === 'not_exist') {
        //                         alert(data.message);
        //                     }
        //                 },complete: function(){
        //                     $("#btn_search").prop('disabled', false);
        //                     $("input").attr('disabled',false);
        //                     // $("#didilim").removeClass('overlay open ');
        //                 },error: function(){
        //                     alert("Error!");
        //                 }
        //             });
        //         }
        //     });
        // });
    </script>
</body>

</html>
<?php 

ob_end_flush(); 

?>