<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require('PHPMailer/src/Exception.php');
require('PHPMailer/src/PHPMailer.php');
require('PHPMailer/src/SMTP.php');
require_once ("require/database_settings.php");
require_once ("require/database.php");

// creating object of database here

$database = new Database(HOSTNAME, USERNAME, PASSWORD, DATABASE);
$mail = new PHPMailer();
$mail->isSMTP();
// $mail->SMTPDebug = SMTP::DEBUG_SERVER;
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption mechanism to use - STARTTLS or SMTPS
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = 'dummy3424958@gmail.com';
//Password to use for SMTP authentication
$mail->Password = 'hjnxpxtldraicsnr';

if (isset($_REQUEST['signup'])) {
    extract($_REQUEST);
    $flag = true;
    /*patterns :start*/
		$alpha_pattern = "/^[A-Z]{1}[a-z]{2,}$/";
		$email_pattern = "/^[a-z]+\d*[@]{1}[a-z]+[.]{1}(com|net){1}$/";
		// $phone_number_pattern = "/^(92){1}\d{3}-{1}\d{7}$/";
		// $cnic_pattern = "/^[0-9]{5}-{1}\d{7}-{1}\d{1}$/";
	/*patterns :end*/

	/*target error message span :start*/	
		$first_name_msg 	= null;
		$last_name_msg 		= null;
		$email_msg 			= null;
		$gender_msg 		= null;
		$profile_image_message 		= null;

	/*target error message span :end*/
		
	/*------------------------------*/
			if(!(preg_match($alpha_pattern, $first_name))){
				$flag = false;
				$first_name_msg = "First Name must be like Ali|Ajeeb|Ahmed etc..!";
                header("location: signup.php?first_name_message=$first_name_msg");

			} else if(!(preg_match($alpha_pattern, $last_name))){
				$flag = false;
				$last_name_msg = "Last Name must be like Khan|Junejo etc..!";
                header("location: signup.php?last_name_msg=$last_name_msg");

			} else if(!(preg_match($email_pattern, $email))){
				$flag = false;
				$email_msg = "Email must be like ali@example.com|net ali12@example.com|net etc..!";
                header("location: signup.php?email_msg=$email_msg");
	
			} else if($flag === true){
                // echo "<h1>Form OK</h1>";
                if ($_FILES['image']['error'] == 0) {
                    extract($_REQUEST);
                    // image uplaoding code Start here
            
                    $file_path = 'images/';
                    $file_name = rand() . $_FILES['image']['name'];
                    $text = pathinfo($file_name, PATHINFO_EXTENSION);
                    $temp = $_FILES['image']['tmp_name'];
            
            
                    if (($text == "jpg" or $text == "png" or $text == "jpeg" or $text == "webp")) {
                        move_uploaded_file($temp, $file_path . $file_name);
            
                        // image uplaoding code End here 
            
                        // Inserting Data into user code Start Here
                        $query = "INSERT INTO user(role_id,first_name,last_name,email,password,gender,date_of_birth,user_image,address) VALUES(2,'" . $first_name . "','" . $last_name . "','" . $email . "','" . $password . "','" . $gender . "','" . $date_of_birth . "','" . $file_name . "','" . $address . "')";
            
                        $result = $database->query_excute($query);
            
                        // $query = "INSERT INTO role";
            
                        // Inserting Data into user code End Here
                        // Email Code Start Here
                        $mail->setFrom($email, $first_name);
                        //Set an alternative reply-to address
                        $mail->addReplyTo("dummy3424958@gmail.com", "Ajeeb khan");
                        //Set who the message is to be sent to
                        $mail->addAddress("dummy3424958@gmail.com", "Ajeeb khan");
                        //Set the subject line
                        $mail->Subject = 'Account Activation Request from user';
                        //Read an HTML message body
                        $mail->msgHTML("Name: $first_name $last_name<p><b>Email: $email</b></p> <p><b>Password: $password</b></p>");
                        //Attach an image file (optional)
                        //send the message, check for errors
                        if (!$mail->send()) {
                            echo 'Mailer Error: ' . $mail->ErrorInfo;
                        } 
                        // Email Code End Here
            
                        header("location: login.php?pdf=set&message=Your Account Has been created Successfully&success=1 &user_name=".$first_name."");
            
            
                    } else {
            
                        $profile_image_message = "File shoud be (PNG,JPG,JPEG ,WEBP)";
                        header("location: signup.php?image=$profile_image_message");
                    }
                }
            }	
}
?>