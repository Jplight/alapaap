<?php

require_once 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Email configuration
$to = 'kpaular@ebizolution.com';
$subject = 'Test email';
$message = 'Hello, this is a test email.';
$headers = 'From: sender@example.com';

// SMTP configuration
$smtp_host = '192.168.227.7';
$smtp_port = 25;

// Create the PHPMailer object
$mail = new PHPMailer(true);

try {
  // Configure the SMTP settings
  $mail->isSMTP();
  $mail->Host = $smtp_host;
  $mail->SMTPAuth = false;
//   $mail->Username = $smtp_username;
//   $mail->Password = $smtp_password;
//   $mail->SMTPSecure = 'tls';
  $mail->Port = $smtp_port;

  // Configure the email
  $mail->setFrom('no-reply_bsp_alapaap@ebizolution.com', 'BSP Alapaap Test');
  $mail->addAddress($to);
  $mail->Subject = $subject;
  $mail->Body = $message;

  // Send the email
  $mail->send();
  echo 'Email sent successfully!';
} catch (Exception $e) {
  echo "Email could not be sent. Error: {$mail->ErrorInfo}";
}

?>
