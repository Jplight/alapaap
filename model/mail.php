<?php
    use PHPMailer\PHPMailer\PHPMailer;
    // use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    date_default_timezone_set('Etc/UTC');
    require 'vendor/autoload.php';

    $mail = new PHPMailer(true);

    // try {
    //     //Server settings  
    //     $mail->Host = 'smglb.bsp.gov.ph';                            //Set the SMTP server to send through
    //     $mail->Port       = 25;     
    //     $mail->setFrom('no-reply_bsp_alapaap@bsp.gov.ph', 'BSP Alapaap');                             
        
    //     //Recipients
    //     $getRecipients = mysqli_query($conn,"select * from tbl_user where role = '2' ");
    //     foreach ($getRecipients as $row) {
    //         try {
    //             $mail->addAddress($row['email_add']);
    //         } catch (Exception $e) {
    //             echo 'Invalid address skipped: ' . htmlspecialchars($row['email_add']) . '<br>';
    //             continue;
    //         }
    //     }
    //     $mail->addCC($email);    // $email_add
          
    //     $mail->isHTML(true);                                  
    //     $mail->Subject = $subject;
    //     $mail->Body    = $message;

    //     try {
    //         $mail->send();
    //     } catch (Exception $e) {
    //         echo 'Mailer Error (' . htmlspecialchars($row['email_add']) . ') ' . $mail->ErrorInfo . '<br>';
    //         //Reset the connection to abort sending this message
    //         //The loop will continue trying to send to the rest of the list
    //         $mail->getSMTPInstance()->reset();
    //     }
    //     //Clear all addresses and attachments for the next iteration
    //     $mail->clearAddresses();
    //     $mail->clearAttachments();
    // } catch (Exception $e) {
    //     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    // }  


    try {
        //Server settings
        // $mail->SMTPDebug = 3;               
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'whyllardermie@gmail.com';                     //SMTP username
        $mail->Password   = 'gtoigwbluxfubmrh';       // alapaap@Bsp123                            //SMTP password
        $mail->SMTPSecure = 'tls';           
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->SMTPOptions = array (
            'ssl' => array(
                'verify_peer'  => false,
                'verify_peer_name'  => false,
                'allow_self_signed' => true)
        );
        $getRecipients = mysqli_query($conn,"select * from tbl_user where role = '2' ");
        //Recipients
        $mail->setFrom('alapaapbsp@gmail.com', 'BSP Alapaap');
        foreach ($getRecipients as $row) {
            try {
                $mail->addAddress($row['email_add']);
            } catch (Exception $e) {
                echo 'Invalid address skipped: ' . htmlspecialchars($row['email_add']) . '<br>';
                continue;
            }
        }
        $mail->addCC($email);    // $email_add
          
        $mail->isHTML(true);                                  
        $mail->Subject = $subject;
        $mail->Body    = $message;

        try {
            $mail->send();
        } catch (Exception $e) {
            echo 'Mailer Error (' . htmlspecialchars($row['email_add']) . ') ' . $mail->ErrorInfo . '<br>';
            //Reset the connection to abort sending this message
            //The loop will continue trying to send to the rest of the list
            $mail->getSMTPInstance()->reset();
        }
        //Clear all addresses and attachments for the next iteration
        $mail->clearAddresses();
        $mail->clearAttachments();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }  

?>