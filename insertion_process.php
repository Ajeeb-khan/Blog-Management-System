<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once("./templates_and_forms/genral.php");
require_once("./require/database_settings.php");
require_once("./require/database.php");

require('./PHPMailer/src/Exception.php');
require('./PHPMailer/src/PHPMailer.php');
require('./PHPMailer/src/SMTP.php');

$database = new Database(HOSTNAME, USERNAME, PASSWORD, DATABASE);
$genral = new Genral;





if (isset($_REQUEST['feedback_btn'])) {
  extract($_REQUEST);

  // Feedback from registered users
  if (isset($_REQUEST['user_feedback_id']) && $_REQUEST['user_feedback_id'] != "") {
    $query = "SELECT * FROM user WHERE user_id = '" . $_REQUEST['user_feedback_id'] . "'";
    $result = $database->query_excute($query);
    $user = mysqli_fetch_assoc($result);
    $user_name = $user['first_name'] . " " . $user['last_name'];

    $query = "INSERT INTO user_feedback(user_id, user_name, user_email, feedback) 
                  VALUES('" . $user['user_id'] . "', '" . $user_name . "', '" . $user['email'] . "', '" . $feedback_text . "')";
    $result = $database->query_excute($query);

    // Send email to admin
    if (!empty($user_name) && !empty($user['email'])) {
      sendFeedbackMail($user_name, $user['email'], $feedback_text);
    }

    header("location: index.php?message=Feedback has been submitted&success=1");
  }
  // Feedback from guest users
  else {
    $query = "INSERT INTO user_feedback(user_id, user_name, user_email, feedback) 
                  VALUES(NULL, '" . $name . "', '" . $email . "', '" . $feedback_text . "')";
    $result = $database->query_excute($query);

    // Send email to admin
    if (!empty($name) && !empty($email)) {
      sendFeedbackMail($name, $email, $feedback_text);
    }

    header("location: index.php?message=Feedback has been submitted&success=1");
  }
}


function sendFeedbackMail($userName, $userEmail, $feedbackText)
{
  $mail = new PHPMailer();


  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = 'dummy3424958@gmail.com';
  $mail->Password = 'hjnxpxtldraicsnr';
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  $mail->Port = 587;


  $mail->setFrom($userEmail, $userName);
  $mail->addAddress('dummy3424958@gmail.com', 'Ajeeb khan');


  $mail->isHTML(true);
  $mail->Subject = 'New Feedback Submission';
  $mail->Body = "<h4>Feedback from: $userName ($userEmail)</h4>
                   <p>$feedbackText</p>";


  if (!$mail->send()) {

    echo "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
  }
}



if (isset($_REQUEST['comment_text'])) {
  extract($_REQUEST);

  $query = " INSERT INTO post_comment (post_id, user_id, comment, is_active) VALUES ('" . $post_id . "', '" . $user_id . "', '" . $comment_text . "', 'Active') ";

  $result = $database->query_excute($query);
  header("location: post.php?post_id=$post_id");
}
