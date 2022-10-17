<?php

/**
 * This example shows how to send a message to a whole list of recipients efficiently.
 */

//Import the PHPMailer class into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

error_reporting(E_STRICT | E_ALL);

date_default_timezone_set('Etc/UTC');

require 'vendor/autoload.php';

//Passing `true` enables PHPMailer exceptions
$mail = new PHPMailer(true);

$body = "Helo World";

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->SMTPKeepAlive = true; //SMTP connection will not close after each email_add sent, reduces SMTP overhead
$mail->Port     = 587; 
$mail->SMTPSecure = 'tls';  
$mail->Username = 'alapaapbsp@gmail.com'; 
$mail->Password = 'lykcjxwaufpwhznx';
$mail->setFrom('alapaapbsp@gmail.com', 'Alapaap | eBiZolution');
$mail->addReplyTo('alapaapbsp@gmail.com', 'Alapaap | eBiZolution');

$mail->Subject = 'PHPMailer Simple database mailing list test';

//Same body for all messages, so set this before the sending loop
//If you generate a different body for each recipient (e.g. you're using a templating system),
//set it inside the loop
$mail->msgHTML($body);
//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';

//Connect to the database and select the recipients from your mailing list that have not yet been sent to
//You'll need to alter this to match your database
$mysql = mysqli_connect('localhost', 'root', '');
mysqli_select_db($mysql, 'alapaap_db');
$result = mysqli_query($mysql, 'SELECT * FROM tbl_user WHERE role = "2" ');

$emails = array("akosiejhayc@gmail.com", "edcelmanuel9@gmail.com", "themonggicorp@gmail.com","alapaapbsp@gmail.com","jocelynhanopay03@gmail.com","ermiewhyllard@gmail.com");


foreach ($emails as $email) {
    try {
        $mail->addAddress($email);
    } catch (Exception $e) {
        echo 'Invalid address skipped: ' . htmlspecialchars($email) . '<br>';
        continue;
    }
    // if (!empty($row['photo'])) {
    //     //Assumes the image data is stored in the DB
    //     $mail->addStringAttachment($row['photo'], 'YourPhoto.jpg');
    // }

    try {
        $mail->send();
        echo 'Message sent to :' . htmlspecialchars($email) . ' (' .
            htmlspecialchars($email) . ')<br>';
        // // Mark it as sent in the DB
        // mysqli_query(
        //     $mysql,
        //     "UPDATE mailinglist SET sent = TRUE WHERE email_add = '" .
        //     mysqli_real_escape_string($mysql, $row['email_add']) . "'"
        // );
    } catch (Exception $e) {
        echo 'Mailer Error (' . htmlspecialchars($email) . ') ' . $mail->ErrorInfo . '<br>';
        //Reset the connection to abort sending this message
        //The loop will continue trying to send to the rest of the list
        $mail->getSMTPInstance()->reset();
    }
    //Clear all addresses and attachments for the next iteration
    $mail->clearAddresses();
    $mail->clearAttachments();
}


?>