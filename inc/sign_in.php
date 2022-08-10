<form method="post" id="frm_signin" action="../model/signup_model.php">
    <div class="mb-3">
        <label class="form-label fw-bold">Email:</label>
        <input class="form-control form-control" type="email" name="email_add" id="email_add" autocomplete="off" placeholder="Input your email address">
    </div>
    <div class="mb-2">
        <label class="form-label fw-bold">Password:</label>
        <input class="form-control form-control" type="password" name="pass" id="pass"  placeholder="Input your password">
    </div>
    <div class="d-flex justify-content-start">
        <!-- <div class="form-check form-switch form-check-inline small m-2">
            <input class="form-check-input" type="checkbox" name="remember_me" id="chk_remember">
            <label class="form-check-label" for="chk_remember">Remember Me</label>
        </div> -->
        <div class="form-check form-switch form-check-inline small m-2">
            <input class="form-check-input" type="checkbox" id="chk_showpass">
            <label class="form-check-label" for="chk_showpass">Show Password</label>
        </div>
    </div> 
    <div class="d-grid mb-3">
        <button class="btn btn-success rounded-pill" type="submit" name="btn_signin" id="btn_signin" >Sign In <i class="fas fa-sign-in-alt ps-2 fa-fw"></i></button>
    </div>
    <div class="text-start">
        <h6 class="small">Forgot your account? <a class="ms-2 " href="forgot_password.php">Click here</a></h6>
    </div>
    <div class="text-center">
        <h6 class="text-start small">Dont have an account? <a class="text-decoration-none ms-2" href="sign_up.php">Sign up now</a></h6>
    </div>
</form>