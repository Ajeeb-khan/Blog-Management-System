<?php
require_once("require/database_settings.php");
require_once("require/database.php");
require_once("./templates_and_forms/templates_2.php");
require_once("./templates_and_forms/genral.php");


$database = new Database(HOSTNAME, USERNAME, PASSWORD, DATABASE);
$genral = new Genral();
$template = new Template_2();
$template->header();

$query = "SELECT category_title FROM category WHERE category_id = '" . $_REQUEST['category_id'] . "' ";

$result = $database->query_excute($query);

$category_title = mysqli_fetch_assoc($result);


$query = "SELECT post.post_id, post.post_title, category.category_title, post.post_description , post.created_at , post.featured_image , user.first_name , user.last_name , user.user_image
FROM
    post_category
    INNER JOIN category 
        ON (post_category.category_id = category.category_id)
    INNER JOIN post 
        ON (post_category.post_id = post.post_id)
    INNER JOIN blog 
        ON (post.blog_id = blog.blog_id)
    INNER JOIN user 
        ON (blog.user_id = user.user_id) WHERE  post.post_status = 'Active' and category.category_id ='" . $_REQUEST['category_id'] . "' ORDER BY post.post_id DESC ";
$result = $database->query_excute($query);

?>


<div class="container-fluid mt-5 mb-5">
    <div class="container">

        <div class="row">
            <div class="col-sm-12">
                <center>
                    <h3 style="background-color:darkblue; width:500px; padding:10px" class=" display-6 text-center mb-5 rounded-pill" id="recent"><span class="text-warning"><?php echo $category_title['category_title'] ?></span></h3>
                </center>
            </div>
        </div>
        <!-- cards -->
        <div class="row">
            <?php

            if ($result->num_rows) {
                while ($categories_post = mysqli_fetch_assoc($result)) {


            ?>
                    <div class="col-sm-4">
                        <div class="card p-2 w-100" style="width: 18rem;">
                            <a href="post.php?post_id=<?php echo $categories_post['post_id'] ?>" class="text-decoration-none text-dark">
                                <img src="images/<?php echo $categories_post['featured_image'] ?>" class="card-img-top" alt="..." width="100%" height="230px">
                                <div class="card-body mt-2">
                                    <br> <span class="categories_text bg-body-secondary p-2 text-primary"><?php echo $categories_post['category_title'] ?></span>
                                    <h5 class="card-title  mt-2 mb-2">
                                        <h5 class="card-title  mt-3 mb-2"><?php echo $categories_post['post_title']; ?></h5>
                                    </h5>
                                    <p class="card-text"><?php echo substr($categories_post['post_description'], 0, 40) ?></p>

                                </div>
                                <div class="card-footer bg-transparent">
                                    <img class="author_profile" src="images/<?php echo $categories_post['user_image'] ?>" alt="" width="30px">
                                    <span class="card_footer_text"><?php echo $categories_post['first_name'] . " " . $categories_post['last_name'] ?></span>
                                    <span class="card_footer_text_date text-end_date"><?php echo $categories_post['created_at'] ?></span>
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
</div>


<?php $template->footer(); ?>