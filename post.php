<?php
require_once("./templates_and_forms/templates_2.php");
require_once("./templates_and_forms/genral.php");
require_once("./require/database_settings.php");
require_once("./require/database.php");

$database = new Database(HOSTNAME, USERNAME, PASSWORD, DATABASE);
$genral = new Genral;

$template = new Template_2();
$template->header();

$post_id = $_REQUEST['post_id'];
$query = "SELECT post.post_id, post.post_title, category.category_title, post.post_description , post.post_summary, post.is_comment_allowed, post.created_at , post.featured_image , user.user_id, user.first_name , user.last_name , user.user_image
FROM
    post_category
    INNER JOIN category 
        ON (post_category.category_id = category.category_id)
    INNER JOIN post 
        ON (post_category.post_id = post.post_id)
    INNER JOIN blog 
        ON (post.blog_id = blog.blog_id)
    INNER JOIN user 
        ON (blog.user_id = user.user_id) WHERE post.post_id = $post_id and  post.post_status = 'Active'  ORDER BY post.post_id DESC ";

$result = $database->query_excute($query);
$post = mysqli_fetch_assoc($result);

?>
<style>
    .fixed-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
    }
    .other-post-image {
        width: 100px;
        height: 70px;
        object-fit: cover;
        transition: none; 
    }
    .nav-link:hover {
        background-color: transparent; 
        text-decoration: none; 
    }
    
</style>

<div class="container">
    <div class="row mt-5 mb-5">
        <div class="col-md-8">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <a class="btn btn-outline-primary mb-3" href="#"><?php echo $post['category_title']??''; ?></a>
                    <h3 class="card-title"><?php echo $post['post_title']??''; ?></h3>
                    <div class="d-flex justify-content-start align-items-center mb-3">
                        <img class="rounded-circle me-3" src="images/<?php echo $post['user_image']??''; ?>" alt="" width="50px">
                        <div>
                            <span class="fw-bold"><?php echo $post['first_name']??'' . " " . $post['last_name']??''; ?></span><br>
                            <small class="text-muted"><?php echo date("j F Y h:i:s", strtotime($post['created_at'])); ?></small>
                        </div>
                    </div>
                    <img src="images/<?php echo $post['featured_image']??''; ?>" class="img-fluid fixed-image rounded mb-4" alt="">
                    <p class="card-text" style="text-align: justify;"><?php echo $post['post_description']??''; ?></p>
                    <h5 class="mt-4">Summary</h5>
                    <p class="card-text" style="text-align: justify;"><?php echo $post['post_summary']??''; ?></p>
                </div>
            </div>
            <?php
            $query = "SELECT * FROM post_atachment WHERE post_id = '".$post_id."'";
            $result = $database->query_excute($query);
            $attachments = mysqli_fetch_assoc($result);

            if ($result->num_rows) {
                ?>
                <div class="card mb-3 shadow-sm">
                    <div class="card-body text-center">
                        <h2 class="text-center text-primary"><?php echo $attachments['post_attachment_title']; ?></h2>
                        <a href="images/<?php echo $attachments['post_attachment_path']; ?>" class="btn btn-danger">Download Attachment</a>
                    </div>
                </div>
                <?php
            }
            ?>
            
            <div class="comment">
                <?php
                if (isset($_SESSION['user'])) {
                    if ($post['is_comment_allowed']) {
                        ?>
                        <div class="card shadow-sm mb-4">
                            <div class="card-body">
                                <form action="insertion_process.php?user_id=<?php echo $_SESSION['user']??'' ?>&post_id=<?php echo $post['post_id']??'' ?>" method="post">
                                    <div class="mb-3">
                                        <label for="comment" class="form-label">Add Comment</label>
                                        <textarea class="form-control" id="comment" name="comment_text" rows="3" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="comment">Comment</button>
                                </form>
                            </div>
                        </div>
                        <?php

                        $query = "SELECT post_comment.comment, post_comment.created_at, user.first_name, user.last_name, user.user_image
                                  FROM post_comment
                                  INNER JOIN post ON post_comment.post_id = post.post_id
                                  INNER JOIN user ON post_comment.user_id = user.user_id
                                  WHERE post_comment.is_active = 'Active' AND post.post_id = '".$_REQUEST['post_id']."'";
                        $result = $database->query_excute($query);

                        if ($result->num_rows) {
                            while ($post_comments = mysqli_fetch_assoc($result)) {
                                ?>
                                <div class="card-footer bg-transparent mt-3 mb-3 border p-3 shadow-sm">
                                    <div class="d-flex justify-content-start align-items-center mb-3">
                                        <img class="rounded-circle me-3" src="images/<?php echo $post_comments['user_image']; ?>" alt="" width="50px">
                                        <div>
                                            <span class="fw-bold"><?php echo $post_comments['first_name']." ".$post_comments['last_name']; ?></span><br>
                                            <small class="text-muted"><?php echo $post_comments['created_at']; ?></small>
                                        </div>
                                    </div>
                                    <p><?php echo $post_comments['comment']; ?></p>
                                </div>
                                <?php
                            }
                        } else {
                            echo "No Comments Available...";
                        }
                    } else {
                        echo "Comments are disabled for this post";
                    }
                } else {
                    echo "<br />If you want to give Comments first you should login <a class='btn btn-primary' href='login.php'>Login</a>";
                }
                ?>
            </div>
        </div>

        <div class="col-md-4">
            <h4 class="display-6 text-center"><span class="text-danger">O</span>ther <span class="text-danger">P</span>osts</h4>
            <?php
            $query = "SELECT post.post_id, post.post_title, category.category_title, post.featured_image, user.first_name, user.last_name
                      FROM post_category
                      INNER JOIN category ON post_category.category_id = category.category_id
                      INNER JOIN post ON post_category.post_id = post.post_id
                      INNER JOIN blog ON post.blog_id = blog.blog_id
                      INNER JOIN user ON blog.user_id = user.user_id
                      WHERE post.post_status = 'Active' ORDER BY post.post_id DESC LIMIT 5";
            $result = $database->query_excute($query);

            while ($all_posts = mysqli_fetch_assoc($result)) {
                ?>
                <a class="nav-link border mb-3 shadow-sm rounded d-flex align-items-center" href="post.php?post_id=<?php echo $all_posts['post_id']; ?>">
                    <img class="rounded other-post-image me-3" src="images/<?php echo $all_posts['featured_image']; ?>" alt="">
                    <div>
                        <span class="fw-bold"><?php echo $all_posts['post_title']; ?></span><br>
                        <small class="text-info"><?php echo $all_posts['first_name']." ". $all_posts['last_name']; ?></small>
                    </div>
                </a>
                <?php
            }
            ?>
        </div>
    </div>
</div>

<?php $template->footer(); ?>
