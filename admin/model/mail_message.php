<?php 
    // Mail Message
    $message = "Welcome to Alapaap Portal. <br><br>".
    "Please use this credential for your access to this link http://".$_SERVER['SERVER_NAME']."<br><br>".
    "Email: <b>".$email_add."</b><br>".
    "Temporary Password: <b>".$_POST['pass']."</b><br><br><br><br>".
    "<i>THIS IS AN AUTOMATICALLY GENERATED MESSAGE, DO NOT REPLY TO THIS EMAIL..</i>"; 
?>