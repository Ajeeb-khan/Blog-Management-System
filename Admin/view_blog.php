<?php
require_once("../templates_and_forms/genral.php");
require_once("../templates_and_forms/templates.php");
require_once("../require/database_settings.php");
require_once("../require/database.php");


$database = new Database(HOSTNAME, USERNAME, PASSWORD, DATABASE);
$genral = new Genral;
$template = new Template();
$template->navbar();

$query = "SELECT blog.blog_id, blog.blog_title,  blog.blog_background_image, blog.blog_status, blog.post_per_page, blog.created_at, user.first_name, user.last_name
FROM blog INNER JOIN user
ON (blog.user_id = user.user_id) ORDER BY blog.blog_id DESC";



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
                        <h2 class="text-center">All Blogs</h2>

                        <p class="text-center mt-3" style="color:<?php echo isset($_REQUEST['success']) ? "green" : "red"; ?>"><?php echo $_REQUEST['message'] ?? ''; ?></p>

                        <a href="add_blog.php" class="btn btn-primary">Add blog</a>
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
                                        <th>S NO</th>
                                        <th>Added BY</th>
                                        <th>Blog Title</th>
                                        <th>Posts Per Page</th>
                                        <th>Background Image</th>

                                        <th>Created AT</th>
                                        <th>ACTION</th>
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
                                            <th><?php echo $row["first_name"] . " " . $row["last_name"] ?></th>
                                            <th><?php echo $row["blog_title"] ?></th>
                                            <th><?php echo  $row["post_per_page"] ?></th>
                                            <td><img src="../images/<?php echo $row["blog_background_image"] ?>" alt="" width="50px" height="50px"></td>

                                            <td><?php echo date("j  F Y h:i:s ", strtotime($row['created_at'])) ?? '' ?></td>
                                            <td>
                                                <a class=" btn btn-<?php echo $row['blog_status'] == 'Active' ? "success" : "danger" ?>" href="updation_process.php?blog_id=<?php echo $row['blog_id'] ?>&blog_status=<?php echo $row['blog_status'] ?>"><?php echo $row['blog_status'] ?? 'InActie' ?></a>

                                                <a href="add_blog.php?blog_id=<?php echo $row['blog_id'] ?>" class="btn btn-warning">Edit</a>
                                            </td>

                                        </tr>
                                    <?php
                                    }
                                    ?>
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