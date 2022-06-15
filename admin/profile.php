<?php  
    session_start();
    ob_start();
    date_default_timezone_set('Asia/Manila');

    $uid = $_SESSION['uid'];
    $role = $_SESSION['role'];

    include '../model/connection.php';


    if (!isset($uid)) { header("location: ../index.php"); }
    
    $sql = mysqli_query($conn,"SELECT * FROM tbl_user where uid = '$uid' ");
    while ($rows = mysqli_fetch_array($sql)):
        $first_name = $rows['first_name'];
        $last_name = $rows['last_name'];
        $middle_name =$rows['middle_name'];
        $my_fullname = $first_name." ".$last_name;
        $home_address = $rows['home_address'];
        $contact_no = $rows['contact_no'];
        $email_add = $rows['email_add'];
        $my_role = $rows['sub_role'];
        $multi_role = $rows['multi_role'];
        $default_role = $rows['default_role'];
    endwhile;
    // echo $role." Current role"; // this will be guide
    // echo '<br>'.$my_role." Sub ROle"; // this will be guide
    // echo '<br>'.$multi_role." Multi ROle"; // this will be guide
    // echo $default_role;
    include 'model/save_profile.php';

    // Query For Getting Image
    $get_img = mysqli_query($conn,"SELECT * FROM tbl_user where uid = '$uid' ");
    $s_img = mysqli_fetch_array($get_img);
    $my_image = $s_img['image'];  // Get User Image
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Profile - eBiZolution</title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
        <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
        <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
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
        </style>
    </head>
    <body id="page-top">
        <div id="wrapper">
            <?php include 'inc/sidebar.php'; ?>
            <div class="d-flex flex-column" id="content-wrapper">
                <div id="content">
                    <?php include 'inc/navbar.php'; ?>
                    <div class="container-fluid">
                        <h3 class="text-dark mb-4">Profile</h3>
                        <div class="row mb-3">
                            <div class="col-lg-4">
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="card mb-3">
                                        <div class="card-body shadow">
                                        <?php echo (!empty($img_error)) ? $img_error : ''; ?>
                                            <div class="text-center ">
                                                <img class="rounded-circle mb-3 mt-4" src="<?php echo $my_image != null ? $my_image : 'assets/img/profile.jpg';?>" width="160" height="160" alt="Image">
                                            </div>
                                                <input type="file" id="customFile" name="image" class="form-control p-5 shadow-none mb-2" style="border-style: dashed; border-color: lightgrey; border-width:3px; font-size: small;">                               
                                            <div class="mb-3">
                                                <button class="btn btn-primary btn-sm" type="submit" name="btn_update_img">Update Photo</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-8">
                                <div class="row">
                                    <div class="col">
                                        <div class="card shadow mb-3">
                                            <div class="card-header py-3">
                                                <p class="text-primary m-0 fw-bold">Personal Info</p>
                                            </div>
                                            <div class="card-body">
                                                <?php echo (!empty($uinfo_error)) ? $uinfo_error : ''; ?>
                                                <form method="POST">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="first_name"><strong>First Name</strong></label>
                                                                <input class="form-control" type="text" id="first_name" name="first_name" value="<?=$first_name; ?>" >
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="middle_name"><strong>Middle Name</strong></label>
                                                                <input class="form-control" type="text" id="middle_name" name="middle_name" value="<?=$middle_name; ?>" placeholder="Optional" >
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="last_name"><strong>Last Name</strong></label>
                                                                <input class="form-control" type="text" id="last_name" name="last_name" value="<?=$last_name; ?>" >
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="address"><strong>Address</strong></label>
                                                                <input class="form-control" type="text" id="address" name="address" value="<?=$home_address; ?>" placeholder="Please Input your Address." >
                                                            </div>    
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="contact_no"><strong>Contact No.</strong></label>
                                                                <input class="form-control" type="text" id="contact_no" name="contact_no" value="<?=$contact_no; ?>" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-primary btn-sm" type="submit" id="btn_info" name="btn_info">Save</button>
                                                </form> 
                                            </div>
                                        </div>
                                        <div class="card shadow">
                                            <div class="card-header py-3">
                                                <p class="text-primary m-0 fw-bold">Account Settings</p>
                                            </div>
                                            <div class="card-body">
                                                <form method="POST">
                                                    <?php echo (!empty($user_error)) ? $user_error : ''; ?>
                                                    <div class="row">
                                                        <div class="col col-lg-12">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="email_add"><strong>Email Address</strong></label>
                                                                <input class="form-control account_set" type="email" id="email_add" name="email_add" value="<?=$email_add; ?>" disabled >
                                                            </div>
                                                        </div>
                                                        <div class="col col-lg-12">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="pass"><strong>Current Password</strong></label>
                                                                <input class="form-control account_set" type="password" id="pass" name="pass" >
                                                            </div>
                                                        </div>
                                                        <div class="col col-lg-12">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="new_pass"><strong>New Password</strong></label>
                                                                <input class="form-control account_set" type="password" id="new_pass" name="new_pass" >
                                                            </div>
                                                        </div>
                                                        <div class="col col-lg-12">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="retype_pass"><strong>Retype Password</strong></label>
                                                                <input class="form-control account_set" type="password" id="retype_pass" name="retype_pass" >
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="mb-3" id="awaw">
                                                        <button class="btn btn-primary btn-sm" type="submit" name="btn_u_acc" id="btn_u_acc">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <footer class="bg-white sticky-footer">
                    <div class="container my-auto">
                        <div class="text-center my-auto copyright"><span>Copyright © Alapaap | eBizolution 2022</span></div>
                    </div>
                </footer>
                <!-- Footer -->

            </div>
            <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
        </div>
        <script src="assets/js/jquery-3.6.0.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/theme.js"></script>
        <script>
            $(document).ready(function(){
                $("#btn_u_acc").click(function(){
                    var btn_u_acc = $(this).
                    $(".account_set").removeAttr('');

                    $(this).html('Save');
                });
                $("button[data-bs-dismiss=modal]").click(function(){
                    $("form").trigger('reset');
                });
                setInterval(function(){
                    $("#alert").slideUp();
                },2000);
            });
        </script>
    </body>
</html>
<?php ob_end_flush(); ?>