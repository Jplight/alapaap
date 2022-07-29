<?php 

include 'connection.php';

// Save personal info of the user
if (isset($_POST['btn_info'])) {

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $middle_name =$_POST['middle_name'];
    $home_address = $_POST['address'];
    $contact_no = $_POST['contact_no'];

	$sql = mysqli_query($conn,"UPDATE tbl_user set first_name = '$first_name', last_name = '$last_name', middle_name = '$middle_name', home_address = '$home_address', contact_no = '$contact_no'  where uid = '$uid' ");
	if ($sql) {
        $uinfo_error = "<div class='alert alert-success' id='alert'>Personal Info has been Succesfuly updated!</div>";   
	}
}// Save personal info of the user

// It will update role once you selected one of those checkbox
if (isset($_POST['btn_update_role'])) {

    $chk_requestor  = $_POST['chk_requestor'];
    $chk_approver   = $_POST['chk_approver'];
    $chk_reciever   = $_POST['chk_reciever'];
    $chk_performer  = $_POST['chk_performer'];
    $chk_confirmer  = $_POST['chk_confirmer'];
    $chk_verifier   = $_POST['chk_verifier'];
    
    if (empty($chk_requestor) && empty($chk_approver) && empty($chk_reciever) && empty($chk_performer) && empty($chk_confirmer) && empty($chk_verifier)) {
        header("location: profile.php");    
    }else{
        $new_role = $chk_requestor.$chk_approver.$chk_reciever.$chk_performer.$chk_confirmer.$chk_verifier;
        $sql = mysqli_query($conn,"UPDATE tbl_user set sub_role = '$new_role' where uid = '$uid' ");
    }


}// It will update role once you selected one of those checkbox

// This button is for change role that you will in the navbar on the dashboard, once the user has already enabled the Multi Role
if (isset($_POST['btn_c_role'])) {
    $weng_id = $_POST['weng_id'];
    unset($_SESSION['role']);
    $_SESSION['role'] = $weng_id;
    $sql = mysqli_query($conn,"UPDATE tbl_user set role = '$weng_id' where uid = '$uid' ");
}
// This button is for change role that you will in the navbar on the dashboard, once the user has already enabled the Multi Role

if (isset($_POST['btn_request_role'])) {
    $uid_role = rand(10000000,99999999);
    $email_add  = $_POST['email_add'];
    $fullname  = $_POST['fullname'];
    $chk_requestor  = isset($_POST['chk_requestor']) ? $_POST['chk_requestor'] : '';
    $chk_requestor  = isset($_POST['chk_requestor'])? $_POST['chk_requestor'] : '';
    $chk_approver   = isset($_POST['chk_approver']) ? $_POST['chk_approver'] : '';
    $chk_reciever   = isset($_POST['chk_reciever']) ? $_POST['chk_reciever'] : '';
    $chk_performer  = isset($_POST['chk_performer']) ? $_POST['chk_performer'] : '';
    $chk_confirmer  = isset($_POST['chk_confirmer']) ? $_POST['chk_confirmer'] : '';
    $chk_verifier   = isset($_POST['chk_verifier']) ? $_POST['chk_verifier'] : '';

    $new_role = $chk_requestor.$chk_approver.$chk_reciever.$chk_performer.$chk_confirmer.$chk_verifier;
    $sql = mysqli_query($conn,"INSERT INTO tbl_req_role (uid, his_id, fullname, email_add, role, requested_role, status, date_created) values ('$uid_role', '$uid','$fullname', '$email_add', '$role','$new_role','0',NOW()) ");
    
    $status = 'admin';
    $form_subject = "Request Role";
    require 'mail_message.php';
    require 'mail.php';   
    $requested_role_message = "<div class='alert alert-success' id='alert'>Requested role has been sent!</div>";
}

if (isset($_POST['btn_role_default'])) {
    $sql = mysqli_query($conn,"UPDATE tbl_user set role = $default_role, sub_role = null, multi_role = null where uid = '$uid' ");
    
}

if(isset($_POST['btn_u_acc'])){
    $user_error = '';

    $verify_pass = hash_hmac('md5',$_POST['pass'],'@Bsp1234*');
    $verify = mysqli_query($conn,"SELECT * FROM tbl_user where uid = '$uid' and password = '$verify_pass' ");
    $count = mysqli_num_rows($verify);
    if($count > 0){
        if($_POST['new_pass'] == null){
            $user_error = "<div class='alert alert-danger' id='alert'>New Password shoudn't leave blank!</div>";
        }elseif($_POST['retype_pass'] == null){
            $user_error = "<div class='alert alert-danger' id='alert'>Retype Password shoudn't leave blank!</div>";
        }elseif($_POST['new_pass'] <> $_POST['retype_pass']){
            $user_error = "<div class='alert alert-danger' id='alert'>New password and Confirm Password does not match</div>";
        }else{
            $new_pass = hash_hmac('md5',$_POST['new_pass'],'@Bsp1234*');
            $update_pass = mysqli_query($conn,"UPDATE tbl_user set password = '$new_pass' where uid = '$uid' ");
            $user_error = "<div class='alert alert-success' id='alert'>Succesfully Changed</div>";
        }

    }else{
        $user_error = "<div class='alert alert-danger' id='alert'>Incorrect Current Password</div>";
    }

}

if (isset($_POST['btn_update_img'])) {

    $get_img = mysqli_query($conn,"SELECT * from tbl_user where uid = '$uid' ");
    $rows_img = mysqli_fetch_array($get_img);
    $del_img = $rows_img['image'];  

    
    $permited  = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];
    $response = array();
    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext; // new generated File Name for Image
    $uploaded_image = "model/uploads/".$unique_image;    // Directory of Image

    if (empty($file_name)) {   
         $img_error = "<div class='alert alert-danger' id='alert'>Please Select any Image !</div>";
    }elseif ($file_size > 1048567) {
        $img_error = "<div class='alert alert-danger' id='alert'>Image Size should be less then 1MB!</div>";
    } elseif (in_array($file_ext, $permited) === false) {
        $img_error = "<div class='alert alert-danger' id='alert'>You can upload only:-".implode(', ', $permited)."</div>";
    } else{
        if($del_img != null){
            unlink($del_img);
        }
        move_uploaded_file($file_temp, $uploaded_image);
        $query = mysqli_query($conn,"UPDATE tbl_user set image = '$uploaded_image' where uid = '$uid' ");
        if ($query) {
            $img_error = "<div class='alert alert-success' id='alert'>Image Inserted Successfully</div>";
        }else {
            $img_error = "<div class='alert alert-danger' id='alert'>Image Not Inserted</div>";
        }
    }
    
}
 

?>

