
<?php
session_start();
    ob_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Alapaap | Account Verification</title>
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat&amp;display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&amp;display=swap">
        <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
        <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="../assets/fonts/ionicons.min.css">
        <link rel="stylesheet" href="../assets/fonts/fontawesome5-overrides.min.css">
        <link rel="stylesheet" href="../assets/css/Footer-Dark.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
        <link rel="stylesheet" href="../assets/css/Map-Clean.css">
        <link rel="stylesheet" href="../assets/css/styles.css">
    </head>
    <body class="bg-light">
        <div class="col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3 vh-100 d-grid align-items-center">
            <div class="card shadow-lg p-3 rounded">
                <div class="card-body">
                    <div class="mb-3">
                        <a href="../index.php" title=""><img src="../assets/img/ebiz-logo.png" width="200"></a>
                    </div>
                    <form id="frm_signup" method="post" autocomplete="false">
                        <div class="row">
                            <div class="col-lg-6">
                                <label class="form-label fw-bold h5 mt-3">
                                    Personal Details
                                </label>
                                <div class="dropdown-divider"></div>
                                <div class="mb-2">
                                    <label class="form-label fw-bold">First Name *</label>
                                    <input class="form-control form-control" type="text" id="txt_fname" autocomplete="nope" required="" name="txt_fname" maxlength="30" minlength="2" tabindex="1">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label fw-bold">Last Name *</label>
                                    <input class="form-control form-control" type="text" id="txt_lname" autocomplete="nope" required="" name="txt_lname" minlength="2" maxlength="30" tabindex="2">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label fw-bold">Home Address </label>
                                    <textarea class="form-control" name="home" id="home" placeholder="Optional" tabindex="3" rows="4"></textarea>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label fw-bold">Contact No. </label>
                                    <input class="form-control form-control" type="text" id="txt_contact_no" name="txt_contact_no" minlength="11" maxlength="11" tabindex="4" placeholder="Optional">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-label fw-bold h5 mt-3">
                                    Account Details
                                </label>
                                <div class="dropdown-divider"></div>
                                <div class="mb-2">
                                    <label class="form-label fw-bold">Email Address *</label>
                                    <input class="form-control form-control" type="email" name="txt_email_add" id="txt_email_add" autocomplete="false" required="" readonly value="<?php echo $_SESSION['email']; ?>"  tabindex="5">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label fw-bold">Current Password *</label>
                                    <div class="d-flex justify-content-end">
                                        <input class="form-control" type="password" name="current_pass" id="current_pass" required minlength="8" maxlength="30" tabindex="6" style="font-family: 'Open Sans', sans-serif;"> 
                                        <div class="position-absolute me-2 bg-white d-flex align-self-center" style="z-index:4;">
                                            <button class="btn shadow-none btn-sm " type="button" id="btn_showpass" name="btn_showpass" hidden style="background-color: transparent;"><i class="far fa-eye-slash"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label fw-bold">New Password *</label>
                                    <div class="d-flex justify-content-end">
                                        <input class="form-control" type="password" name="new_pass" id="new_pass" required minlength="8" maxlength="30" tabindex="7" style="font-family: 'Open Sans', sans-serif;"> 
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Retype Password *</label>
                                    <div class="d-flex justify-content-end">
                                        <input class="form-control" type="password" name="retype_pass" id="retype_pass" required minlength="8" maxlength="30" tabindex="8" style="font-family: 'Open Sans', sans-serif;"> 
                                        <div class="position-absolute me-2 bg-white d-flex align-self-center" style="z-index:4;">
                                            <button class="btn shadow-none btn-sm" type="button" id="btn_showpass2" name="btn_showpass2" hidden><i class="far fa-eye-slash"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button class="btn btn-success" id="btn_submit" name="btn_submit" type="submit" tabindex="9">Verify</button>
                        </div>
                        <span class="small text-danger"><?php echo (!empty($user_error)) ? $user_error : ''; ?></span>
                    </form>
                </div>
            </div>
        </div>
        <script src="../assets/js/jquery-3.6.0.js"></script>
        <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/js/bs-init.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#btn_showpass').click(function(){
                    if('password' == $('#current_pass').attr('type')){
                         $('#current_pass').prop('type', 'text');
                         $("#btn_showpass").html('<i class="far fa-eye"></i>');
                    }else{
                         $('#current_pass').prop('type', 'password');
                         $("#btn_showpass").html('<i class="far fa-eye-slash"></i>');
                    }
                });
                $("#current_pass").keyup(function(){
                    if ($(this).val().length >= 1) {
                        $("#btn_showpass").removeAttr('hidden');   
                    }else{
                        $("#btn_showpass").attr('hidden',true);
                        $('#current_pass').prop('type', 'password');
                        $("#btn_showpass").html('<i class="far fa-eye-slash"></i>');
                    }
                });
                $('#btn_showpass2').click(function(){
                    if('password' == $('#txt_confirm_pword').attr('type')){
                         $('#txt_confirm_pword').prop('type', 'text');
                         $("#btn_showpass2").html('<i class="far fa-eye"></i>');
                    }else{
                         $('#txt_confirm_pword').prop('type', 'password');
                         $("#btn_showpass2").html('<i class="far fa-eye-slash"></i>');
                    }
                });
                $("#txt_confirm_pword").keyup(function(){
                    if ($(this).val().length >= 1) {
                        $("#btn_showpass2").removeAttr('hidden');   
                    }else{
                        $("#btn_showpass2").attr('hidden',true);
                        $('#txt_confirm_pword').prop('type', 'password');
                        $("#btn_showpass2").html('<i class="far fa-eye-slash"></i>');
                    }
                });                
            });
        </script>
        <script>
            $(document).ready(function(){
                $("#frm_signup").submit(function(){
                    return false;
                });

                $("#btn_submit").click(function(){
                    var email = $("#txt_email_add").val();
                    var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
                    if ($("#txt_email_add").val().length == 0 && $("#current_pass").val().length == 0 ) {
                        alert("Please fill up the fields!");
                    }
                    if(pattern.test(email)) {
                        $.ajax({
                            url: "model.php",
                            type: "POST",
                            data: $("#frm_signup").serialize(),
                            dataType: 'JSON',
                            beforeSend: function(){
                                $("#btn_submit").prop('disabled', true);
                                $("input, textarea").attr('disabled',true);
                            },
                            success: function(data){
                                if (data.status ==='verified') {
                                    alert(data.message);
                                    window.location = data.link;                                   
                                    $("#frm_signup").trigger('reset');
                                }

                                if (data.status === 'not_match') {
                                    alert(data.message);
                                }
                                if (data.status === 'null_fields') {
                                    alert(data.message);
                                }
                                if (data.status === 'invalid') {
                                    alert(data.message);
                                }
                                
                            },complete: function(){
                                $("#btn_submit").prop('disabled', false);
                                $("input, textarea").attr('disabled',false);
                            },error: function(data){
                                alert("Oops something went wrong!");
                            }
                        });
                    }
                });

            });
        </script>
    </body>
</html>
<?php ob_end_flush(); ?>