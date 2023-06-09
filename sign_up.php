<?php
require 'model/signup_model.php';

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Alapaap | Sign Up </title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat&amp;display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&amp;display=swap">
        <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
        <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
        <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
        <link rel="stylesheet" href="assets/css/Footer-Dark.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
        <link rel="stylesheet" href="assets/css/Map-Clean.css">
        <link rel="stylesheet" href="assets/css/styles.css">
    </head>
    <body class="bg-light">
        <div class="d-flex justify-content-center align-items-center vh-100">
            <div class="card shadow-sm p-3">
                <div class="card-body">
                    <div class="mb-3">
                        <a href="index.php" title=""><img src="assets/img/ebiz-logo.png" width="200"></a>
                    </div>
                    <?php echo !empty($error_alert) ? $error_alert : '';?>
                    <form id="frm_signup" method="post" autocomplete="off" >
                        <div class="row g-2">
                            <div class="col-12 col-md-6">
                                <div class="mb-2">
                                    <label class="form-label fw-bold">First Name <span class="text-danger">*</span></label>
                                    <input class="form-control form-control" type="text" id="fname" autocomplete="nope" required="" name="fname" maxlength="30" minlength="2" tabindex="1" onkeypress="return /[a-zA-Z ]/i.test(event.key)" >
                                    
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-2">
                                    <label class="form-label fw-bold">Last Name <span class="text-danger">*</span></label>
                                    <input class="form-control form-control" type="text" id="lname" autocomplete="nope" required="" name="lname" minlength="2" maxlength="30" tabindex="2" onkeypress="return /[a-zA-Z ]/i.test(event.key)" >
                                </div>
                            </div>
                        </div>
                        <div class="mb-2 ">
                            <label class="form-label fw-bold">Email Address <span class="text-danger">*</span></label>
                            <input class="form-control form-control" type="email" name="email" id="email" required="" tabindex="3" autocomplete="false">
                            <span id="check-email" ></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Password <span class="text-danger">*</span></label>
                            <div class="d-flex justify-content-end">
                                <input class="form-control" type="password" name="pword" id="pword" required minlength="8" maxlength="30" tabindex="5" style="font-family: 'Open Sans', sans-serif;" autocomplete="nope" > 
                                <div class="position-absolute me-2 bg-white d-flex align-self-center" style="z-index:4;">
                                    <button class="btn shadow-none btn-sm " type="button" id="btn_showpass" name="btn_showpass" hidden style="background-color: transparent;"><i class="far fa-eye-slash"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-success" id="modal_submit" name="modal_submit" type="submit" disabled>Submit</button>
                        </div>
                        <!-- Modal -->
                        <div class="modal" id="new_account" data-bs-backdrop="modal" data-bs-keyboard="false" >
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body text-wrap text-center">
                                        <h3 class="modal-title mb-3">Register this account?</h3>
                                        <button class="btn btn-outline-danger shadow-none" type="button" data-bs-dismiss="modal">No</button>
                                        <button class="btn btn-outline-success shadow-none" type="submit" name="btn_submit" id="btn_submit">Yes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                    </form>
                </div>
            </div>
        </div>
        <script src="assets/js/jquery-3.6.0.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function(){

                $("#email").keyup(function(){
                    if ($("#email").val().length == 0){
                        $("#check-email").html("");   
                    }
                })

                $("input").keyup(function(){
                    var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
                    
                    const first_name = $("#fname").val()
                    const last_name = $("#lname").val()
                    const email = $("#email").val()
                    const password = $("#pword").val()
                    if(first_name.length >= 2 && last_name.length >= 2 && (pattern.test(email)) && password.length >= 8 ){
                        $("#modal_submit").attr("type","button")
                        $("#modal_submit").attr("data-bs-toggle","modal")
                        $("#modal_submit").attr("data-bs-target","#new_account")
                        $("#modal_submit").removeAttr("disabled")                   
                        $.ajax({
                            url: "model/email_validation.php",
                            data:'email='+$("#email").val(),
                            type: "POST",
                            success:function(data){
                                $("#check-email").html(data); 
                            }
                        });
                    }else{
                        $("#modal_submit").attr("type","submit").removeAttr("data-bs-toggle").removeAttr("data-bs-target")
                        $("#modal_submit").attr("disabled",true)
                    }      
                });

                $("#pword").keyup(function(){
                    if ($(this).val().length >= 1) {
                        $("#btn_showpass").removeAttr('hidden');   
                    }else{
                        $("#btn_showpass").attr('hidden',true);
                        $('#pword').prop('type', 'password');
                        $("#btn_showpass").html('<i class="far fa-eye-slash"></i>');
                    }
                });
                $('#btn_showpass').click(function(){
                    if('password' == $('#pword').attr('type')){
                         $('#pword').prop('type', 'text');
                         $("#btn_showpass").html('<i class="far fa-eye"></i>');
                    }else{
                         $('#pword').prop('type', 'password');
                         $("#btn_showpass").html('<i class="far fa-eye-slash"></i>');
                    }
                });
                    
            });
        </script>
        <script>
            $(function(){
                // $("#frm_signup").submit(function(){
                //     return false;
                // });
               
                // $("#btn_submit").click(function(){

                //     const fname = $("#fname").val()
                //     const lname = $("#lname").val()
                //     const email_add = $("#email_add").val()
                //     const pword = $("#pword").val()
                //     const confirm_pword = $("#confirm_pword").val()
                //     const pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);

                //     if (fname === '' || fname === '' || email_add === '' || pword === '' || confirm_pword === ''){
                //         alert("Fill out the fields")
                //     }else if(!pattern.test(email_add)) { 
                //         alert("Please enter valid email address");
                //     }else{
                //         Swal.fire({
                //         title: 'Do you want to save the changes?',
                //         showDenyButton: true,
                //         confirmButtonText: 'Yes',
                //         denyButtonText: `No`,
                //         }).then((result) => {
                //             if (result.isConfirmed) {
                //                 $.ajax({
                //                     method: "POST",
                //                     url: "model/signup_model.php",
                //                     data: $("#frm_signup").serialize(),
                //                     dataType: "html",
                //                     success: function (data) {
                //                         if (data) {
                //                             $("#btn_submit").attr('disabled',true);
                //                             console.log("sample")
                //                             // Swal.fire(data.message, '', 'success')
                //                             setTimeout(function(){
                //                                 // window.location.href = data.link;
                //                             },3000)
                //                         }
                //                     }
                //                 });
                                
                //             }
                //         })

                //     }
                // });
            });
        </script>
    </body>
</html>