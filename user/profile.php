<?php  
    session_start();
    ob_start();
    date_default_timezone_set('Asia/Manila');

    $uid = $_SESSION['uid'];
    $role = $_SESSION['role'];

    include '../model/connection.php';
    require 'inc/GetTimeAgo.php';

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
            .myimg{
                width:160px;
                height:160px;
                object-fit:cover;
                border-radius:50%;
            }  /* Circle Image  */
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
                                                <img class="myimg mb-3 mt-4" src="<?php echo $my_image != null ? $my_image : 'assets/img/profile.jpg';?>" alt="Image">
                                            </div>
                                                <input type="file" id="customFile" name="image" class="form-control p-5 shadow-none mb-2" style="border-style: dashed; border-color: lightgrey; border-width:3px; font-size: small;">                               
                                            <div class="mb-3">
                                                <button class="btn btn-primary btn-sm" type="submit" name="btn_update_img">Update Photo</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <form method="POST">
                                    
                                    <div class="card user-select-none">
                                        <!-- <div class="card-header d-flex justify-content-between align-items-center">
                                            <p class="text-primary m-0 fw-bold">My Role</p>
                                            <button type="button" class="btn text-danger"  data-bs-toggle="modal" data-bs-target="#clear_role" data-bs-backdrop="modal" data-bs-keyboard="false" title="Reset to default role"><i class="fa-fw fas fa-trash"></i></button>
                                        </div> -->
                                        <div class="card-body">     
                                            <?php echo (!empty($requested_role_message)) ? $requested_role_message : ''; ?>
                                            <div class="mb-2 ">
                                                <!-- backup code -->
                                                <!-- <input class="form-check-input" type="checkbox" name="chk_reciever" id="chk_rec"  value="3" <?php echo strpos($multi_role,"3") !== false ? (strpos($my_role,"3") !== false ? 'checked' :'') : ($default_role == 3 ? 'checked' : 'disabled'); ?> > -->
                                               <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" name="chk_requestor" id="chk_req"  value="1" <?php echo $default_role == 1 ? 'checked' : (strpos($multi_role,"1") !== false ?  (strpos($my_role,"1") !== false ?  'checked' : '') : 'disabled'); ?> >
                                                    <label class="form-check-label" for="chk_req">Requestor</label>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" name="chk_approver" id="chk_app"  value="2" <?php echo $default_role == 2 ? 'checked' : (strpos($multi_role,"2") !== false ?  (strpos($my_role,"2") !== false ?  'checked' : '') : 'disabled'); ?> >
                                                    <label class="form-check-label" for="chk_app">Approver</label>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" name="chk_reciever" id="chk_rec"  value="3" <?php echo $default_role == 3 ? 'checked' : (strpos($multi_role,"3") !== false ?  (strpos($my_role,"3") !== false ?  'checked' : '') : 'disabled'); ?> >
                                                    <label class="form-check-label" for="chk_rec">Reciever</label>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" name="chk_performer" id="chk_per"  value="4" <?php echo $default_role == 4 ? 'checked' : (strpos($multi_role,"4") !== false ?  (strpos($my_role,"4") !== false ?  'checked' : '') : 'disabled'); ?> >
                                                    <label class="form-check-label" for="chk_per">Performer</label>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" name="chk_confirmer" id="chk_con"  value="5" <?php echo $default_role == 5 ? 'checked' : (strpos($multi_role,"5") !== false ?  (strpos($my_role,"5") !== false ?  'checked' : '') : 'disabled'); ?> >
                                                    <label class="form-check-label" for="chk_con">Confirmer</label>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" name="chk_verifier" id="chk_ver"  value="6"<?php echo $default_role == 6 ? 'checked' : (strpos($multi_role,"6") !== false ?  (strpos($my_role,"6") !== false ?  'checked' : '') : 'disabled'); ?> >
                                                    <label class="form-check-label" for="chk_ver">Verifier</label>
                                                </div>

                                                <div class="mt-3 d-flex justify-content-between">
                                                    <button class="btn btn-primary btn-sm" type="submit" name="btn_update_role" id="btn_update_role">Update Role</button>
                                                    <?php  

                                                        $btn_req = mysqli_query($conn,"SELECT * from tbl_req_role where his_id = '$uid' and status = 0 ");
                                                        $validate_req = mysqli_num_rows($btn_req);
                                                        if ($validate_req > 0) {
                                                            echo '<button class="btn btn-outline-secondary btn-sm" type="button" disabled>......</button>';
                                                        }else{
                                                            echo '<button class="btn btn-outline-secondary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#req_role">Request Role</button>';
                                                        }
                                                    ?>
                                                </div>
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

                <!-- Modal Component -->
                <form method="POST">
                    <div class="modal" id="req_role" tabindex="-1" data-bs-backdrop="modal" data-bs-keyboard="false" >
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Role</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="fullname" value="<?=$my_fullname; ?>" readonly="readonly">
                                    <input type="hidden" name="email_add" value="<?=$email_add; ?>" readonly="readonly">
                                    <label class="fw-bold mb-3">Which of these role whould you like to choose?</label>
                                    <div class="mb-2 d-block">
                                        <div class="row">
                                            <div class="col-2">
                                                <label class="fw-bold">Role:</label>
                                            </div>
                                            <div class="col-10">
                                                <div class="d-block">
                                                   <div class="form-check form-check-inline">
                                                        <input class="form-check-input " type="checkbox" name="chk_requestor" id="chk_m_req" title="Requestor" value="1" <?php echo strpos($multi_role,"1") !== false ? 'checked readonly' : ($default_role == 1 ? 'checked' : ''); ?> >
                                                        <label class="form-check-label" for="chk_m_req">Requestor</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="chk_approver" id="chk_m_app" title="Approver" value="2" <?php echo strpos($multi_role,"2") !== false ? 'checked readonly' : ($default_role == 2 ? 'checked' : ''); ?> >
                                                        <label class="form-check-label" for="chk_m_app">Approver</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="chk_reciever" id="chk_m_rec" title="Reciever" value="3" <?php echo strpos($multi_role,"3") !== false ? 'checked readonly' : ($default_role == 3 ? 'checked' : ''); ?> >
                                                        <label class="form-check-label" for="chk_m_rec">Reciever</label>
                                                    </div> 
                                                </div>
                                                <div class="d-block">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="chk_performer" id="chk_m_per" title="Performer" value="4" <?php echo strpos($multi_role,"4") !== false ? 'checked readonly' : ($default_role == 4 ? 'checked' : ''); ?> >
                                                        <label class="form-check-label" for="chk_m_per">Performer</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="chk_confirmer" id="chk_m_con" title="Confirmer" value="5" <?php echo strpos($multi_role,"5") !== false ? 'checked readonly' :($default_role == 5 ? 'checked' : ''); ?> >
                                                        <label class="form-check-label" for="chk_m_con">Confirmer</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="chk_verifier" id="chk_m_ver" title="Verifier" value="6" <?php echo strpos($multi_role,"6") !== false ? 'checked readonly' :($default_role == 6 ? 'checked' : ''); ?> >
                                                        <label class="form-check-label" for="chk_m_ver">Verifier</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>        
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-outline-danger shadow-none btn-sm" type="button"  data-bs-dismiss="modal">Cancel</button>
                                    <button class="btn btn-outline-success btn-sm shadow-none" type="submit" name="btn_request_role" id="btn_request_role">Request</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Modal Component -->

            <!-- Modal Component -->
            <form method="POST">
                <div class="modal" id="clear_role" tabindex="-1" data-bs-backdrop="modal" data-bs-keyboard="false" >
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Clear Role</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label class="mb-5 fw-bold text-wrap">Would you like to clear all your added Role?</label>
                                <label class="mb-1 fw-bold d-block">Note:</label>
                                <label class="mb-3 text-wrap">This process can't be reverse!</label>
                                <div class="mb-2 d-block text-end">
                                    <button class="btn btn-primary shadow-none" type="button" data-bs-dismiss="modal">No</button>       
                                    <button class="btn btn-danger shadow-none" type="submit" name="btn_role_default" id="btn_role_default">Yes</button>       
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Modal Component -->


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
                },3000);

                if ( window.history.replaceState ) {
                    window.history.replaceState( null, null, window.location.href );
                    // // Prevent from Resubmitting Previous Data in the form when using Force Refresh
                }
            });
        </script>
    </body>
</html>
<?php ob_end_flush(); ?>