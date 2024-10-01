<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require('../PHPMailer/src/Exception.php');
require('../PHPMailer/src/PHPMailer.php');
require('../PHPMailer/src/SMTP.php');

require_once("../require/database_settings.php");
require_once("../require/database.php");

$database = new Database(HOSTNAME, USERNAME, PASSWORD, DATABASE);
$mail = new PHPMailer();
$mail->isSMTP();

// $mail->SMTPDebug = SMTP::DEBUG_SERVER;

// Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// Uncomment if your network does not support SMTP over IPv6
// $mail->Host = gethostbyname('smtp.gmail.com');

// Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
// Set the encryption mechanism to use - STARTTLS or SMTPS
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
// Whether to use SMTP authentication
$mail->SMTPAuth = true;
// Username to use for SMTP authentication - use full email address for Gmail
$mail->Username = 'dummy3424958@gmail.com';
// Password to use for SMTP authentication
$mail->Password = 'hjnxpxtldraicsnr';

// Handle user approval or rejection process
if (isset($_REQUEST['user_approve_id'])) {
    $user_id = $_REQUEST['user_approve_id'];
    $query = "UPDATE user SET is_approved = 'Approved', is_active = 'Active' WHERE user_id = '" . $_REQUEST['user_approve_id'] . "'";
    $result = $database->query_excute($query);

    // Configure mail settings
    $mail->setFrom('dummy3424958@gmail.com', "Ajeeb");
    $mail->addReplyTo($_REQUEST['email'], substr($_REQUEST['email'], 0, 8));
    $mail->addAddress($_REQUEST['email'], substr($_REQUEST['email'], 0, 8));
    $mail->Subject = 'Account Activation Notification';
    $mail->msgHTML("<b>Congratulations</b> Your Account Has Been Activated By Admin. Now you can log in to your account.");

    // Send mail and check for errors
    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }

    header("location: user_requiest.php?message=User Account ID " .$user_id. " Approved Successfully&success=1");
} elseif (isset($_REQUEST['user_reject_id'])) {
    $user_id = $_REQUEST['user_reject_id'];
    $query = "DELETE FROM user WHERE user_id = '" . $_REQUEST['user_reject_id'] . "'";
    $result = $database->query_excute($query);

    // Configure mail settings
    $mail->setFrom('dummy3424958@gmail.com', "Ajeeb");
    $mail->addReplyTo($_REQUEST['email'], substr($_REQUEST['email'], 0, 8));
    $mail->addAddress($_REQUEST['email'], substr($_REQUEST['email'], 0, 8));
    $mail->Subject = 'Account Activation Request Rejected';
    $mail->msgHTML("<b>Dear User</b> Your Account Activation Request has been rejected by Admin.");

    // Send mail and check for errors
    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }

    header("location: user_requiest.php?message=User Account ID " .$user_id. " Rejected Successfully&danger=0");
}

if (isset($_REQUEST["update_admin_profile"])) {
    extract($_REQUEST);

    
    if ($_FILES['user_image']['error'] == 0) {
        $file_path = '../images/';
        $file_name = rand() . $_FILES['user_image']['name'];
        $temp = $_FILES['user_image']['tmp_name'];

        
        $file_info = pathinfo($file_name);
        $file_extension = $file_info['extension']; 

        
        if ($file_extension == 'jpg' || $file_extension == 'png' || $file_extension == 'jpeg' || $file_extension == 'webp') {
            
            move_uploaded_file($temp, $file_path . $file_name);

            
            $update_query = "UPDATE user SET user_image = '" . $file_name . "' WHERE user_id = '" . $_SESSION['user'] . "'";
            // $this->database->query_excute($update_query);
            $result = $database->query_excute($update_query);

           
            header("Location:user_profile.php?message=Admin Profile Updated Successfully&success=1");
        } else {
            
            header("Location:user_profile.php?error_message=File should be (PNG, JPG, JPEG, WEBP)&success=0");
        }
    } else {
        
        header("Location:user_profile.php?error_message=No image uploaded&success=0");
    }
}



// post active and Inactive Start
elseif (isset($_REQUEST['post_id']) && isset($_REQUEST['post_status'])) {
    $post_id = $_REQUEST['post_id'];

    if ($_REQUEST['post_status'] == "Active") {
        $query = "UPDATE post SET post_status = 'InActive' WHERE post_id='" . $post_id . "'";
        $result = $database->query_excute($query);
        header("location: view_post.php?message=Post ID " . $post_id . " has been deactivated successfully&danger=1");
    } else {
        $query = "UPDATE post SET post_status = 'Active' WHERE post_id='" . $post_id . "'";
        $result = $database->query_excute($query);
        header("location: view_post.php?message=Post ID " . $post_id . " has been activated successfully&success=1");
    }
}
// post active and Inactive End



// Category active and Inactive Start
else if (isset($_REQUEST['category_id']) & isset($_REQUEST['category_status'])) {
    $category_id = $_REQUEST['category_id'];

    if ($_REQUEST['category_status'] == "Active") {
        $query = "UPDATE category SET category_status = 'InActive' WHERE category_id='" . $_REQUEST['category_id'] . "'";
        $result = $database->query_excute($query);
        header("location: view_category.php?message=Category " . $category_id . " Has been Deactivate Successfully&danger=1");
    } else {
        $query = "UPDATE category SET category_status = 'Active' WHERE category_id='" . $_REQUEST['category_id'] . "'";
        $result = $database->query_excute($query);
        header("location: view_category.php?message=Category ID " . $category_id . " Has been Activated Successfully&success=1");
    }
}
// Category active and Inactive End


// Blog active and Inactive Start
else if (isset($_REQUEST['blog_id']) & isset($_REQUEST['blog_status'])) {
    $blog_id = $_REQUEST['blog_id'];
    if ($_REQUEST['blog_status'] == "Active") {

        $query = "UPDATE blog SET blog_status = 'InActive' WHERE blog_id='" . $_REQUEST['blog_id'] . "'";
        $result = $database->query_excute($query);
        header("location: view_blog.php?message=Blog  ID " . $blog_id . " Has been Deactivate Successfully&danger=1");
    } else {
        $query = "UPDATE blog SET blog_status = 'Active' WHERE blog_id='" . $_REQUEST['blog_id'] . "'";
        $result = $database->query_excute($query);
        header("location: view_blog.php?message=Blog ID " . $blog_id . "  Has been Activated Successfully&success=1");
    }
}
// Blog active and Inactive End



// User active and Inactive Start
else if (isset($_REQUEST['user_id']) & isset($_REQUEST['is_active'])) {
    $user_id = $_REQUEST['user_id'];

    if ($_REQUEST['is_active'] == "Active") {

        $query = "UPDATE user SET is_active = 'InActive' WHERE user_id='" . $_REQUEST['user_id'] . "'";
        $result = $database->query_excute($query);
        header("location: view_users.php?message=User ID ". $user_id ." Has been Deactivate Successfully&danger=1");
    } else {
        $query = "UPDATE user SET is_active = 'Active' WHERE user_id='" . $_REQUEST['user_id'] . "'";
        $result = $database->query_excute($query);
        header("location: view_users.php?message=User ID ". $user_id ." Has been Activated Successfully&success=1");
    }
}
// User active and Inactive End

else if(isset($_REQUEST['feedback_id'])){

    $query = "DELETE FROM user_feedback WHERE feedback_id='" . $_REQUEST['feedback_id'] . "'";
     $result = $database->query_excute($query);
     header("location: feedback.php?message=Feedback Has been Removed Successfully&success=1");

}
// Update Category Record
else if (isset($_REQUEST['add_category'])) {
    extract($_REQUEST);
    $category_id = $_REQUEST['category_update_id'];

    $query = "UPDATE category SET category_title = '" . $category_title . "' , category_description = '" . $category_description . "' WHERE category_id = " . $category_id;
    $result = $database->query_excute($query);
    header("location: categori.php?category_id=" . $category_id . "&message=Category ID " . $category_id . " updated successfully&success=1");
}


else if (isset($_REQUEST['post_update_id'])) {
    extract($_REQUEST);
    $post_id = $_REQUEST['post_update_id'];
    if ($_FILES['featured_image']['error'] == 0) {
        $file_path = '../images/';
        $file_name = time() . $_FILES['featured_image']['name'];
        $text = pathinfo($file_name, PATHINFO_EXTENSION);
        $temp = $_FILES['featured_image']['tmp_name'];

        if ($text == "jpg" or $text == "png" or $text == "jpeg" or $text == "webp") {

            $date = date("l F Y h:i:s");
            $query = "UPDATE post SET blog_id = '" . $blog . "' , post_title = '" . $post_title . "', post_summary = '" . htmlspecialchars($post_summary) . "' , post_description = '" . htmlspecialchars($post_description) . "' , featured_image = '" . $file_name . "' , updated_at = '" . $date . "' WHERE post_id = " . $_REQUEST['post_update_id'] . " ";
            $result = $database->query_excute($query);
            move_uploaded_file($temp, $file_path . $file_name);

            header("location: add_post.php?message=Post ID ".$post_id." Updated Succefully&success=1");
        } else {

            header("location: add_post.php?message=File shoud be (PNG,JPG,JPEG ,WEBP)&success=0");
        }
    
    }

}


else if(isset($_REQUEST['add_user'])){
    extract($_REQUEST);
    $user_id = $_REQUEST['user_update_id'];

    $role_id = isset($_REQUEST['role_type']) ? $_REQUEST['role_type'] : 2;

     if ($_FILES['user_image']['error'] == 0) {
    $file_path = '../images/';
    $file_name = time() . $_FILES['user_image']['name'];
    $text = pathinfo($file_name, PATHINFO_EXTENSION);
    $temp = $_FILES['user_image']['tmp_name'];

    if ($text == "jpg" or $text == "png" or $text == "jpeg" or $text == "webp") {
        move_uploaded_file($temp, $file_path . $file_name);


        $query = "UPDATE user SET role_id = '".$role_id."', first_name = '".$first_name."' , last_name = '".$last_name."' , email = '".$email."' , date_of_birth = '".$date_of_birth."'   , user_image = '".$file_name."'  WHERE user_id = ".$_REQUEST['user_update_id']." ";
        $result = $database->query_excute($query);

        header("location: view_users.php?message=User ID ".$user_id." Updated Succefully&success=1");
    } else {

        header("location: add_user.php?error_message=File shoud be (PNG,JPG,JPEG ,WEBP)&success=0");

    }
}
}
 
elseif (isset($_REQUEST['add_blog'])) {
    extract($_REQUEST);

    if ($post_per_page <= 0) {
        header("location: add_blog.php?blog_id=" . $_REQUEST['blog_update_id'] . "&message=Posts per page must be greater than zero&danger=0");
        exit;
    }
   
    $blog_id = $_REQUEST['blog_update_id'];
    
    // If a new image is uploaded
    if ($_FILES['blog_background_image']['error'] == 0) {
        $file_path = '../images/';
        $file_name = rand() . $_FILES['blog_background_image']['name'];
        $text = pathinfo($file_name, PATHINFO_EXTENSION);
        $temp = $_FILES['blog_background_image']['tmp_name'];

        // Check the file type (only allow specific extensions)
        if ($text == "jpg" or $text == "png" or $text == "jpeg" or $text == "webp") {
            move_uploaded_file($temp, $file_path . $file_name);
        } else {
            header("location: view_blog.php?error_message=File should be (PNG, JPG, JPEG, WEBP)&success=0");
            exit;
        }
    } else {
        // No new image was uploaded, use the old one
        $file_name = $_REQUEST['old_image'];
    }

    // Update the blog with new data
    $query = "UPDATE blog SET blog_title = '" . $blog_title . "' , post_per_page = '" . $post_per_page . "' , blog_background_image = '" . $file_name . "' , updated_at = '" . $date . "' WHERE blog_id = " . $_REQUEST['blog_update_id'];
    $result = $database->query_excute($query);

    // Redirect after update with a success message
    header("location: add_blog.php?blog_id=" . $_REQUEST['blog_update_id'] . "&message=Blog ID " . $blog_id . " Updated Successfully&success=1");
}

?>