<?php

/**
 * This example shows making an SMTP connection without using authentication.
 */

//Import the PHPMailer class into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

require 'vendor/autoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer();
//Tell PHPMailer to use SMTP

//Enable SMTP debugging
//SMTP::DEBUG_OFF = off (for production use)
//SMTP::DEBUG_CLIENT = client messages
//SMTP::DEBUG_SERVER = client and server messages
$mail->SMTPDebug = 3;
//Set the hostname of the mail server
$mail->Host = 'smglb.bsp.gov.ph';
//Set the SMTP port number - likely to be 25, 465 or 587
$mail->Port = 25;
//We don't need to set this as it's the default value
//$mail->SMTPAuth = false;
//Set who the message is to be sent from
$mail->setFrom('no-reply_bsp_alapaap@bsp.gov.ph', 'BSP Alapaap'); 
//Set an alternative reply-to address
$mail->addReplyTo('replyto@example.com', 'First Last');
//Set who the message is to be sent to
$mail->addAddress('ermiewhyllard@gmail.com', 'John Doe');

$mail->isHTML(true); 
//Set the subject line
$mail->Subject = 'PHPMailer SMTP without auth test';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->Body = "Hello World";
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';

//send the message, check for errors
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message sent!';
}
?>