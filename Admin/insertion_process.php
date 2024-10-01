<?php
session_start();
require_once("../require/database_settings.php");
require_once("../require/database.php");

$database = new Database(HOSTNAME, USERNAME, PASSWORD, DATABASE);

// if(isset($_POST['plus_button'])){
//     echo "Working";
//     header("location:add_post.php?message=working");
// }



if (isset($_REQUEST['add_category'])) {
    extract($_REQUEST);
    $query = "INSERT INTO category (category_title, category_description) VALUES ('" . $category_title . "','" .htmlspecialchars($category_description, true). "')";
    $result = $database->query_excute($query);
    $last_id = mysqli_insert_id($database->connection);
    header("Location: categori.php?message=Category Id ".$last_id." Added Successfully&success=1");

} 


else if (isset($_REQUEST['add_blog'])) {
    extract($_REQUEST);

    if ($post_per_page <= 0) {
        header("Location: add_blog.php?message=Posts per page must be greater than zero&danger=0");
        exit;
    }        

    if ($_FILES['blog_background_image']['error'] == 0) {
        $file_path = '../images/';
        $file_name = rand() . $_FILES['blog_background_image']['name'];
        $text = pathinfo($file_name, PATHINFO_EXTENSION);
        $temp = $_FILES['blog_background_image']['tmp_name'];

        if ($text == "jpg" or $text == "png" or $text == "jpeg" or $text == "webp") {
            move_uploaded_file($temp, $file_path . $file_name);

            

            $query = "INSERT INTO blog (user_id, blog_title, post_per_page, blog_background_image) 
                      VALUES ('" . $_SESSION['user'] . "', '" . $blog_title . "', '" . $post_per_page . "', '" . $file_name . "')";

            $result = $database->query_excute($query);


            

            
            $last_id = mysqli_insert_id($database->connection);


            header("Location: add_blog.php?message=Blog Id ".$last_id."  Has been created Successfully&success=1");
        } else {
            header("Location: create_blog.php?error_message=File should be (PNG, JPG, JPEG, WEBP)&success=0");
        }
    }
} else if (isset($_REQUEST['add_post'])) {
    if ($_FILES['featured_image']['error'] == 0) {
        extract($_REQUEST);


        $blog_id = $blog;
        $category_id = $category;

        $file_path = '../images/';
        $file_name = rand() . $_FILES['featured_image']['name'];
        $text = pathinfo($file_name, PATHINFO_EXTENSION);
        $temp = $_FILES['featured_image']['tmp_name'];
        move_uploaded_file($temp, $file_path . $file_name);

        if ($text == "jpg" or $text == "png" or $text == "jpeg" or $text == "webp") {
            $allow_comments = intval($allow_comments);

            $query = "INSERT INTO post (blog_id, post_title, post_summary, post_description, featured_image, is_comment_allowed) 
                      VALUES ($blog_id, '" . htmlspecialchars($post_title) . "', '" . htmlspecialchars($post_summary, true) . "', '" . htmlspecialchars($post_description, true) . "', '" . $file_name . "', '" . $allow_comments . "')";

            $result = $database->query_excute($query);
            $last_id = mysqli_insert_id($database->connection);

            // Insert into post_category table
            $query = "INSERT INTO post_category (post_id, category_id) VALUES ($last_id, $category_id)";
            $result = $database->query_excute($query);

            // Handling attachment
            if ($_FILES['post_attachment_path']['error'] == 0) {
                $attachment_path = '../images/';
                $attachment_name = rand() . $_FILES['post_attachment_path']['name'];
                $temp_attach = $_FILES['post_attachment_path']['tmp_name'];
                move_uploaded_file($temp_attach, $attachment_path . $attachment_name);

                // Insert into post_attachment table
                $query = "INSERT INTO post_atachment (post_id, post_attachment_title, post_attachment_path) 
                          VALUES ('$last_id', '" . htmlspecialchars($post_attachment_title) . "', '" . $attachment_name . "')";
                $result = $database->query_excute($query);
                $last_id = mysqli_insert_id($database->connection);
            }

            header("Location: add_post.php?message=Post ID ".$last_id." Has been added Successfully &success=1");
        }
         else {
            header("Location: add_post.php?error_message=File should be (PNG, JPG, JPEG, WEBP)&success=0");
        }
    }
}  

  

else if (isset($_REQUEST['add_user'])) {
    extract($_REQUEST);

   
    $role_id = isset($_REQUEST['role_type']) ? $_REQUEST['role_type'] : 2; 

    if ($_FILES['user_image']['error'] == 0) {
        $file_path = '../images/';
        $file_name = rand() . $_FILES['user_image']['name'];
        $text = pathinfo($file_name, PATHINFO_EXTENSION);
        $temp = $_FILES['user_image']['tmp_name'];

   
        if ($text == "jpg" || $text == "png" || $text == "jpeg" || $text == "webp") {
            move_uploaded_file($temp, $file_path . $file_name);

           
            $query = "INSERT INTO user (role_id, first_name, last_name, email, password, gender, date_of_birth, address, user_image) 
                      VALUES ('$role_id', '$first_name', '$last_name', '$email', '$password', '$gender', '$date_of_birth', '$address', '$file_name')";

            $result = $database->query_excute($query);
            $last_id = mysqli_insert_id($database->connection); 

           
            header("Location: add_user.php?message=User ID " . $last_id . " added successfully&success=1");
        } else {
            header("Location: add_user.php?error_message=File should be (PNG, JPG, JPEG, WEBP)&success=0");
        }
    }
}

?>