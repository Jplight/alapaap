<?php  
session_start();
use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'connection.php';
require 'function.php';

//Load Composer's autoloader
require 'vendor/autoload.php';


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);


if (isset($_POST['btn_submit'])) {

	$txt_fname = strtolower($_POST['txt_fname']) ;
	$txt_lname = strtolower($_POST['txt_lname']) ;
	$txt_email_add = $_POST['txt_email_add'];
	$txt_contact_no = $_POST['txt_contact_no'];
	$txt_pword = hash_hmac('md5',$_POST['txt_pword'],'@Bsp1234*');
	$status		= '0';
	$token 			= '0';
	$role = '1'; // Role for requestor is always 1
		

		if ($_POST['txt_pword'] !== $_POST['txt_confirm_pword']){
			$user_error = 'Your Password and Confirm password does not Match!';
		}else{
			$sql = mysqli_query($conn,"SELECT * from tbl_user where email_add = '".$txt_email_add."' ");
			$count = mysqli_num_rows($sql);
			if ($count > 0) {
				$user_error = 'Email is already exist!';
			}
			if ($count < 1){
				$sql_2 = mysqli_query($conn,"INSERT into tbl_user (first_name,last_name,email_add,contact_no,password,status,token,role, default_role) values ('$txt_fname','$txt_lname','$txt_email_add','$txt_contact_no','$txt_pword','$status','$token','$role', '$role') ");
				if ($sql_2 > 0) {

							// $link = "https://".$_SERVER['SERVER_NAME']."/model/verified_account.php?email=".$txt_email_add."&dname=".convert_string('encrypt', $txt_fname);
							// $link = "http://localhost/revision_alapaap/model/verified_account.php?email=".$txt_email_add."&display_name=".convert_string('encrypt',$txt_fname);
							// $message = "Good Day ".ucfirst($_POST['txt_fname'])." ".ucfirst($_POST['txt_lname'])."<br>"
					  //       . "Please click the link below to confirm your email and complete the registration process.<br>"
					  //       . "You will be automatically redirected to a welcome page where you can sign in.<br><br>"            
					  //       . "Please click below to activate your account:<br>"
					  //       . "<a href='$link'>Click Here!</a>";

					$message = "Good Day ".ucfirst($_POST['txt_fname'])." ".ucfirst($_POST['txt_lname']).",<br><br>"
			        . "Thank you for Registering for Alapaap Website.<br>"
			        . "Our System Administrator is reviewing your registration for approval.<br>"
			        . "You will received an e-mail confirmation once your registration is approved.<br>"
			        . "If you need any assistance please, feel free to e-mail us at <a href=''>alapaapsupport@gmail.com</a><br><br>"            
			        . "Thank you<br>";
					
					try {
						//Server settings
					    $mail->SMTPDebug = 3;               
					    $mail->isSMTP();                                            //Send using SMTP
					    $mail->Host       = 'mail.laangkawalpilipinas.org';                     //Set the SMTP server to send through
					    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
					    $mail->Username   = 'info@laangkawalpilipinas.org';                     //SMTP username
					    $mail->Password   = '3B1Zp@ss7028';                               //SMTP password
					    $mail->SMTPSecure = 'tls';           
					    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
					    $mail->SMTPOptions = array (
					        'ssl' => array(
					            'verify_peer'  => false,
					            'verify_peer_name'  => false,
					            'allow_self_signed' => true)
					    );
						//Send Email
						$mail->setFrom('alapaap@ebizolution.com', 'Alapaap | eBiZolution');
						
						//Attachments
						// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
						// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

						//Recipients
						$mail->addAddress($txt_email_add);              
						$mail->addReplyTo('alapaapsupport@gmail.com', 'Alapaap Customer Support');
						
						//Content
						$mail->isHTML(true);                                  
						$mail->Subject = "Account Registration";
						$mail->Body    = $message;
				
						$mail->send();
				        // $new_url = "https://".$_SERVER['SERVER_NAME']."/model/verification.php?dname=".convert_string('encrypt', $txt_fname)."&email=".$txt_email_add;
				        $new_url = "model/verification.php?display_name=".convert_string('encrypt',$txt_fname)."&email=".$txt_email_add;				
					} catch (Exception $e) {
						$_SESSION['result'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
						$_SESSION['status'] = 'error';
					}
					header("location: ".$new_url);
				}
			}			
		}


}
?>