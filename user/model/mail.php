<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../../vendor/autoload.php';
require 'connection.php';
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);


try {
    //Server settings
    $mail->SMTPDebug = 3;               
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = '10.2.2.21';                     //Set the SMTP server to send through
    // $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    // $mail->Username   = 'info@laangkawalpilipinas.org';                     //SMTP username
    // $mail->Password   = '3B1Zp@ss7028';                               //SMTP password
    // $mail->SMTPSecure = 'tls';           
    // $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    // $mail->SMTPOptions = array (
    //     'ssl' => array(
    //         'verify_peer'  => false,
    //         'verify_peer_name'  => false,
    //         'allow_self_signed' => true)
    // );
    //Recipients
    $mail->setFrom('alapaap@ebizolution.com', 'Alapaap | eBiZolution');
    $mail->addAddress('ermiewhyllard@gmail.com');         //Add a recipient

    $mail->isHTML(true);                                  
    $mail->Subject = "Password Recovery";
    $mail->Body    = "dawdawdawdawd";
    $mail->send();    
    
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>


<?php
// // Multiple recipients
// $to = 'wermie@ebizolution.com'; // note the comma

// // Subject
// $subject = 'Birthday Reminders for August';

// // Message
// $message = '
// <html>
// <head>
//   <title>Birthday Reminders for August</title>
// </head>
// <body>
//   <p>Here are the birthdays upcoming in August!</p>
//   <table>
//     <tr>
//       <th>Person</th><th>Day</th><th>Month</th><th>Year</th>
//     </tr>
//     <tr>
//       <td>Johny</td><td>10th</td><td>August</td><td>1970</td>
//     </tr>
//     <tr>
//       <td>Sally</td><td>17th</td><td>August</td><td>1973</td>
//     </tr>
//   </table>
// </body>
// </html>
// ';

// // To send HTML mail, the Content-type header must be set
// $headers[] = 'MIME-Version: 1.0';
// $headers[] = 'Content-type: text/html; charset=iso-8859-1';

// // Additional headers
// $headers[] = 'To: <wermie@ebizolution.com>';
// $headers[] = 'From: <bspops@ebizolution.com>';
// $headers[] = 'Cc: birthdayarchive@example.com';
// $headers[] = 'Bcc: birthdaycheck@example.com';

// // Mail it
// mail($to, $subject, $message, implode("\r\n", $headers));
?>