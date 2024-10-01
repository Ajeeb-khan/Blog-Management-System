<?php
require_once("./templates_and_forms/templates_2.php");
require_once("./require/database_settings.php");
require_once("./require/database.php");


if (!isset($_SESSION['user'])) {
    header("Location: login.php?message=First you should be logged in to visit the blog page&color=red");
    exit;
}

$database = new Database(HOSTNAME, USERNAME, PASSWORD, DATABASE);
$template = new Template_2();
$template->header();

$blog_id = $_REQUEST['blog_id'] ?? '';

$query = "SELECT blog.blog_id, blog.blog_title, blog.blog_background_image, blog.post_per_page, 
          blog.blog_status, blog.created_at, user.first_name, user.last_name, user.user_image 
          FROM blog 
          INNER JOIN user ON blog.user_id = user.user_id 
          WHERE blog.blog_id = '$blog_id'";
$result = $database->query_excute($query);
$blog = mysqli_fetch_assoc($result);

if (!$blog) {
    echo "Blog not found!";
    exit;
}


$follow_status = 'Unfollowed';
if (isset($_SESSION['user'])) {
    $user_id = $_SESSION['user'];
    $query = "SELECT status FROM following_blog WHERE follower_id = $user_id AND blog_following_id = $blog_id";
    $follow_result = $database->query_excute($query);
    $follow_status = ($follow_result && mysqli_num_rows($follow_result) > 0)
        ? mysqli_fetch_assoc($follow_result)['status']
        : 'Unfollowed';
}



$query = "SELECT COUNT(*) AS total_followers 
          FROM following_blog 
          WHERE blog_following_id = '$blog_id'";
$result = $database->query_excute($query);
$total_followers = mysqli_fetch_assoc($result);
?>

<div class="container-fluid mt-2">
    <div class="row">
        <div class="col-sm-3 mt-5 text-center">
            <img class="border" style="border-radius: 100%;" src="images/<?php echo $blog['blog_background_image']; ?>" alt="" width="200px" height="150px">
        </div>
        <div class="col-sm-8">
            <h1 class="mt-5 mb-5"><?php echo htmlspecialchars($blog['blog_title'] ?? ''); ?>
                <?php if (isset($_SESSION['user'])): ?>
                    <button class="btn btn-danger m-3">
                        <a class="nav-link" href="follow_insertion.php?user_follow_id=<?php echo $_SESSION['user'] ?>&blog_page_id=<?php echo $blog['blog_id']; ?>&action=<?php echo $follow_status == 'Unfollowed' ? 'follow' : 'unfollow'; ?>">
                            <?php echo $follow_status == 'Unfollowed' ? 'Follow' : 'Unfollow'; ?>
                        </a>
                    </button>
                <?php else: ?>
                    <button class="btn btn-danger m-3">
                        <a class="nav-link" href="login.php?message=In Order to Follow the Page, Please login to your account&color=red">Follow</a>
                    </button>
                <?php endif; ?>
                <span class="followers_section">Followers <br /><?= $total_followers['total_followers'] ?></span>
            </h1>


            <div class="card-footer bg-transparent mt-3 mb-3">
                <img class="author_profile" src="images/<?php echo htmlspecialchars($blog['user_image']); ?>" alt="" width="50px">
                <span class="card_footer_text"><?php echo htmlspecialchars($blog['first_name'] . " " . $blog['last_name']); ?></span> &nbsp; &nbsp; &nbsp;
                <span class="card_footer_text"><?php echo date("j F Y h:i:s", strtotime($blog['created_at'])) ?? ''; ?></span>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5 mb-5">
    <div class="row">
        <?php
        $query = "SELECT post.post_id, post.post_title, category.category_title, post.post_description, post.created_at, 
                  post.featured_image, user.first_name, user.last_name, user.user_image
                  FROM post_category
                  INNER JOIN category ON (post_category.category_id = category.category_id)
                  INNER JOIN post ON (post_category.post_id = post.post_id)
                  INNER JOIN blog ON (post.blog_id = blog.blog_id)
                  INNER JOIN user ON (blog.user_id = user.user_id) 
                  WHERE post.blog_id = '$blog_id' 
                  AND post.post_status = 'Active' 
                  ORDER BY post.post_id DESC 
                  LIMIT " . intval($blog['post_per_page']);

        $result = $database->query_excute($query);
        if ($result && $result->num_rows) {
            while ($all_data = mysqli_fetch_assoc($result)) { ?>
                <div class="col-sm-4">
                    <div class="card p-2 w-100" style="width: 18rem;">
                        <a href="post.php?post_id=<?php echo $all_data['post_id']; ?>" class="text-decoration-none text-dark">
                            <img src="images/<?php echo htmlspecialchars($all_data['featured_image']); ?>" class="card-img-top fixed-image" alt="...">
                            <div class="card-body mt-2">
                                <span class="categories_text bg-body-secondary p-2 text-primary"><?php echo htmlspecialchars($all_data['category_title']); ?></span>
                                <h5 class="card-title mt-3 mb-2"><?php echo htmlspecialchars($all_data['post_title']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars(substr($all_data['post_description'], 0, 100)); ?></p>
                            </div>
                            <div class="card-footer bg-transparent">
                                <img class="author_profile" src="images/<?php echo htmlspecialchars($all_data['user_image']); ?>" alt="" width="50px">
                                <span class="card_footer_text"><?php echo htmlspecialchars($all_data['first_name'] . " " . $all_data['last_name']); ?></span>
                                <span class="card_footer_text"><?php echo date("j F Y h:i:s", strtotime($all_data['created_at'])); ?></span>
                            </div>
                        </a>
                    </div>
                </div>
        <?php }
        } else {
            echo "<h4>No Posts Found</h4>";
        }
        ?>
    </div>
</div>


<?php $template->footer(); ?>