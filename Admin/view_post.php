<?php
require_once("../templates_and_forms/templates.php");
require_once("../templates_and_forms/genral.php");
require_once("../require/database_settings.php");
require_once("../require/database.php");

$database = new Database(HOSTNAME, USERNAME, PASSWORD, DATABASE);
$template = new Template();
$genral = new Genral;
$template->navbar();



$query = "SELECT post.post_id, post.post_title, post.post_description, post.post_summary, blog.blog_title, category.category_title, user.first_name, user.last_name
, post.created_at
, post.featured_image
 , post.is_comment_allowed
, post.post_status
FROM
post_category
INNER JOIN post
     ON (post_category.post_id = post.post_id)
 INNER JOIN category
     ON (post_category.category_id = category.category_id)
INNER JOIN blog 
    ON (post.blog_id = blog.blog_id)
INNER JOIN USER 
    ON (blog.user_id = user.user_id) ORDER BY post.post_id DESC";



$result = $database->query_excute($query);
?>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 d-md-block sidebar collapse" id="sidebarMenu">
            <?php $template->sidebar(); ?>
        </div>

        <!-- Main content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="container mt-5 mb-5">
                <div class="row">
                    <div class="col-sm-12 text-end">
                        <h2 class="text-center">All Posts</h2>

                        <p class="text-center mt-3 f-w-bold" style="color:<?php echo isset($_REQUEST['success']) ? "green" : "red"; ?>"><?php echo $_REQUEST['message'] ?? ''; ?></p>

                        <a href="add_post.php" class="btn btn-primary">Add Post</a>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-sm-12 table-responsive">
                        <?php
                        if ($result->num_rows) {


                        ?>
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sr No</th>
                                        <th>Post Title</th>
                                        <th>Blog Page</th>
                                        <th>Category Title</th>
                                        
                                        <th>Added By</th>
                                        <!-- <th>Post Description</th>
                                        <th>Post Summary</th> -->
                                        <th>Added on</th>
                                        <th>Featured Image</th>
                                        <th>Allow Comments</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                     $count  = 1;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        // extract($row);
                                    ?>
                                        <tr>
                                            <td><?php echo $count++ ?></td>
                                            <td><?php echo $row['post_title']; ?> </td>
                                            <td><?php echo $row['blog_title']; ?></td>
                                            <td><?php echo $row['category_title']; ?></td>
                                            <td><?php echo $row['first_name'] . " " . $row['last_name']; ?></td>
                                            <!-- <td><?php echo $row['post_description']; ?> </td>
                                            <th><?= $row['post_summary'] ?></th> -->
                                            <td><?php echo date("j  F Y h:i:s ", strtotime($row['created_at'])) ?? '' ?></td>
                                            <td><img src="../images/<?php echo $row['featured_image']; ?>" width="50px" height="50px" alt=""></td>
                                            <td>
                                                <a class=" btn btn-<?php echo $row['is_comment_allowed'] == '1' ? "success" : "danger" ?>" href="updation_process.php?post_allow_id=<?php echo $row['post_id'] ?>&is_comment_allowed=<?php echo $row['is_comment_allowed'] ?>"><?php echo isset($row['is_comment_allowed']) ? "Yes" : "No" ?></a>
                                            </td>
                                            <td>
                                                <a class=" btn btn-<?php echo $row['post_status'] == 'Active' ? "success" : "danger" ?>" href="updation_process.php?post_id=<?php echo $row['post_id'] ?>&post_status=<?php echo $row['post_status'] ?>"><?php echo $row['post_status'] ?? 'InActie' ?></a>
                                                
                                                <a class="btn btn-warning text-light " href="add_post.php?post_id=<?= $row['post_id'] ?>">Edit</a>

                                            </td>
                                        <?php
                                    }
                                        ?>
                                        </tr>

                                </tbody>
                            </table>
                        <?php
                        } else {
                            Genral::record_not_found();
                        }
                        ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>


<?php $template->admin_footer(); ?>