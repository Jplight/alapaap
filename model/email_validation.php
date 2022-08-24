<?php
# create database connection
require 'connection.php';

if(!empty($_POST["email"])) {
  $query = "SELECT * FROM tbl_user WHERE email_add='" . $_POST["email"] . "'";
  $result = mysqli_query($conn,$query);
  $count = mysqli_num_rows($result);
  if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    if($count>0) {
      echo "<span class='text-danger' id='check-email' class='pb-3'>This email already exists.</span>";
      echo '<script>$("#modal_submit").attr("disabled",true)</script>';
    }else{
      echo "<span class='text-success' id='check-email' class='pb-3'>Email is available.</span>";
    }   
  }else{
    echo "<span class='text-danger'>Invalid email address.</span>";
    echo '<script> $("#modal_submit").attr("disabled",true)</script>';
    
  }
  
}
?>