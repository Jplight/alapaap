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
                    <form id="frm_signup" method="post" autocomplete="off" action="model/signup_model.php">
                        <div class="row g-2">
                            <div class="col-12 col-md-6">
                                <div class="mb-2">
                                    <label class="form-label fw-bold">First Name *</label>
                                    <input class="form-control form-control" type="text" id="fname" autocomplete="nope" required="" name="fname" maxlength="30" minlength="2" tabindex="1" onkeypress="return /[a-zA-Z ]/i.test(event.key)" >
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="mb-2">
                                    <label class="form-label fw-bold">Last Name *</label>
                                    <input class="form-control form-control" type="text" id="lname" autocomplete="nope" required="" name="lname" minlength="2" maxlength="30" tabindex="2" onkeypress="return /[a-zA-Z ]/i.test(event.key)" >
                                </div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <label class="form-label fw-bold">Email Address *</label>
                            <input class="form-control form-control" type="email" name="email_add" id="email_add" required=""  tabindex="3" autocomplete="off">
                        </div>
                        <div class="mb-2">
                            <label class="form-label fw-bold">Contact No.</label>
                            <input class="form-control form-control" type="text" id="contact_no"  name="contact_no" minlength="11" maxlength="11" tabindex="4" onkeypress="return /[0-9]/i.test(event.key)">
                        </div>
                        <div class="mb-2">
                            <label class="form-label fw-bold">Password *</label>
                            <div class="d-flex justify-content-end">
                                <input class="form-control" type="password" name="pword" id="pword" required minlength="8" maxlength="30" tabindex="5" style="font-family: 'Open Sans', sans-serif;"> 
                                <div class="position-absolute me-2 bg-white d-flex align-self-center" style="z-index:4;">
                                    <button class="btn shadow-none btn-sm " type="button" id="btn_showpass" name="btn_showpass" hidden style="background-color: transparent;"><i class="far fa-eye-slash"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Confirm Password *</label>
                            <div class="d-flex justify-content-end">
                                <input class="form-control" type="password" name="confirm_pword" id="confirm_pword" required minlength="8" maxlength="30" tabindex="6" style="font-family: 'Open Sans', sans-serif;"> 
                                <div class="position-absolute me-2 bg-white d-flex align-self-center" style="z-index:4;">
                                    <button class="btn shadow-none btn-sm" type="button" id="btn_showpass2" name="btn_showpass2" hidden><i class="far fa-eye-slash"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-success" id="btn_submit" name="btn_submit" type="submit" >Submit</button>
                        </div>
                        <span class="small text-danger"><?php echo (!empty($user_error)) ? $user_error : ''; ?></span>
                    </form>
                </div>
            </div>
        </div>
        <script src="assets/js/jquery-3.6.0.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/bs-init.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#btn_showpass').click(function(){
                    if('password' == $('#pword').attr('type')){
                         $('#pword').prop('type', 'text');
                         $("#btn_showpass").html('<i class="far fa-eye"></i>');
                    }else{
                         $('#pword').prop('type', 'password');
                         $("#btn_showpass").html('<i class="far fa-eye-slash"></i>');
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
                $("#pword, #confirm_pword").keyup(function(){
                    if ($("#pword").val().length !== $("#confirm_pword").val().length){
                    $("#btn_submit").attr('disabled',false);
                    }
                });
                $("#confirm_pword").keyup(function(){
                    if ($(this).val().length >= 1) {
                        $("#btn_showpass2").removeAttr('hidden');   
                    }else{
                        $("#btn_showpass2").attr('hidden',true);
                        $('#confirm_pword').prop('type', 'password');
                        $("#btn_showpass2").html('<i class="far fa-eye-slash"></i>');
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