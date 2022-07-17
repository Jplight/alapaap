<?php

use PHPMailer\PHPMailer\PHPMailer;

date_default_timezone_set('Etc/UTC');

require 'vendor/autoload.php';


$mail = new PHPMailer();

$mail->SMTPDebug = 1;

$mail->Host = '10.2.2.21';

$mail->Port = 25;

$mail->setFrom('no-reply_bspops@bsp.gov.ph', 'BSP');

$mail->addReplyTo('no-reply_bspops@bsp.gov.ph', 'No Reply');

$mail->addAddress('whyllardermie@gmail.com', 'Whyllard Ermie');

$mail->Subject = 'PHPMailer SMTP without auth test';

$mail->Body = "This a Test Message";

$mail->AltBody = 'This is a plain-text message body';

if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message sent!';
}
?>