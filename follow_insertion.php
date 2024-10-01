<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files
require('./PHPMailer/src/Exception.php'); 
require('./PHPMailer/src/PHPMailer.php'); 
require('./PHPMailer/src/SMTP.php');

require_once("./templates_and_forms/genral.php");
require_once("./require/database_settings.php");
require_once("./require/database.php");
 

$database = new Database(HOSTNAME, USERNAME, PASSWORD, DATABASE);
$genral = new Genral;

if (isset($_REQUEST['user_follow_id']) && isset($_REQUEST['blog_page_id']) && isset($_REQUEST['action'])) {
    $user_id = $_REQUEST['user_follow_id'];
    $blog_id = $_REQUEST['blog_page_id'];
    $action = $_REQUEST['action'];

    // Fetch user information
    $query = "SELECT first_name, last_name FROM user WHERE user_id = '$user_id'";
    $result = $database->query_excute($query);
    $user = mysqli_fetch_assoc($result);

    // Fetch blog information
    $query = "SELECT blog_title FROM blog WHERE blog_id = '$blog_id'";
    $result = $database->query_excute($query);
    $blog = mysqli_fetch_assoc($result);

    if ($action === 'follow') {
        // Check if already following
        $query = "SELECT * FROM following_blog WHERE follower_id = '$user_id' AND blog_following_id = '$blog_id'";
        $result = $database->query_excute($query);

        if (mysqli_num_rows($result) > 0) {
            // Update follow status to 'Followed'
            $query = "UPDATE following_blog SET status = 'Followed', updated_at = NOW() WHERE follower_id = '$user_id' AND blog_following_id = '$blog_id'";
        } else {
            // Insert a new follow record
            $query = "INSERT INTO following_blog (follower_id, blog_following_id, status, created_at) VALUES ('$user_id', '$blog_id', 'Followed', NOW())";
        }
        $database->query_excute($query);
        
        // Email content for follow
        $subject = "New Follow Alert";
        $body = "User " . $user['first_name'] . " " . $user['last_name'] . " has followed the blog titled: " . $blog['blog_title'];
    } elseif ($action === 'unfollow') {
        // Delete the follow record
        $query = "DELETE FROM following_blog WHERE follower_id = '$user_id' AND blog_following_id = '$blog_id'";
        $database->query_excute($query);

        // Email content for unfollow
        $subject = "Unfollow Alert";
        $body = "User " . $user['first_name'] . " " . $user['last_name'] . " has unfollowed the blog titled: " . $blog['blog_title'];
    }

    // Send email to admin
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->SMTPAuth = true;
    $mail->Username = 'dummy3424958@gmail.com';  // Admin's email
    $mail->Password = 'hjnxpxtldraicsnr';        // SMTP password
    $mail->setFrom('dummy3424958@gmail.com', 'Blog Admin');  // From address
    $mail->addAddress('dummy3424958@gmail.com');  // Admin's email

    $mail->Subject = $subject;
    $mail->Body = $body;

    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }

    header("Location: blog_page.php?blog_id=" . $blog_id);
    exit;
} else {
    header("Location: login.php?message=You must login to follow/unfollow blogs&color=red");
    exit;
}
?>
