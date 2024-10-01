<?php
require_once("./templates_and_forms/templates_2.php");
require_once("./templates_and_forms/genral.php");
require_once("./require/database_settings.php");
require_once("./require/database.php");

$database = new Database(HOSTNAME, USERNAME, PASSWORD, DATABASE);
$genral = new Genral;

$template = new Template_2();
$template->header();

$limit = 6;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$count_query = "SELECT COUNT(*) AS total FROM blog WHERE blog_status = 'Active'";
$count_result = $database->query_excute($count_query);
$totalActiveBlogs = mysqli_fetch_assoc($count_result)['total'];
$total_pages = ceil($totalActiveBlogs / $limit);

$query = "SELECT blog.blog_id, blog.blog_title, blog.blog_background_image, blog.post_per_page, blog.blog_status, blog.created_at, 
user.first_name, user.last_name, user.user_image
FROM blog
INNER JOIN user ON (blog.user_id = user.user_id)
WHERE blog.blog_status = 'Active'
ORDER BY blog.blog_id DESC
LIMIT $limit OFFSET $offset";

$result = $database->query_excute($query);
?>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-sm-12">
            <center>
                <h3 class="display-6 text-center mb-5 rounded-pill" id="blogs" style="background-color:darkblue; width:500px; padding:10px">
                    <span class="text-warning">All Blogs</span>
                </h3>
            </center>
        </div>
    </div>

    <div class="row">
        <?php
        if ($result->num_rows) {
            while ($blogs = mysqli_fetch_assoc($result)) {
                ?>
                <div class="col-sm-4">
                    <div class="card p-2 w-100">
                        <a href="blog_page.php?blog_id=<?php echo $blogs['blog_id']?>" class="text-decoration-none text-dark">
                            <img src="images/<?php echo $blogs['blog_background_image'] ?>" class="card-img-top" alt="Blog Image" width="100%" height="230px">
                            <div class="card-body mt-2">
                                <h5 class="card-title mt-3 mb-2"><?php echo $blogs['blog_title'] ?></h5>
                            </div>
                            <div class="card-footer bg-transparent">
                                <img class="author_profile" src="images/<?php echo $blogs['user_image'] ?>" alt="Author Image" width="50px">
                                <span class="card_footer_text"><?php echo $blogs['first_name'] . " " . $blogs['last_name'] ?></span>
                                <span class="card_footer_text"><?php echo date("j F Y h:i:s", strtotime($blogs['created_at'])) ?></span>
                            </div>
                        </a>
                    </div>
                </div>
                <?php
            }
        } else {
            Genral::record_not_found();
        }
        ?>
    </div>
</div>

<!-- Pagination -->
<div class="row mt-5 mb-5">
    <div class="col-sm-5"></div>
    <div class="col-sm-6">
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                    <a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a>
                </li>
                <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                    <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php } ?>
                <li class="page-item <?php if ($page >= $total_pages) echo 'disabled'; ?>">
                    <a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="col-sm-2"></div>
</div>

<?php $template->footer(); ?>
