<?php
require_once("../templates_and_forms/genral.php");
require_once("../templates_and_forms/templates.php");
require_once("../require/database_settings.php");
require_once("../require/database.php");


$database = new Database(HOSTNAME, USERNAME, PASSWORD, DATABASE);
$genral = new Genral;
$template = new Template();
$template->navbar();


$query = "SELECT post_comment.post_comment_id, post_comment.comment, user.first_name, user.last_name, post.post_title, post_comment.is_active, post_comment.created_at 
FROM  post_comment
    INNER JOIN post 
        ON (post_comment.post_id = post.post_id)
    INNER JOIN user 
        ON (post_comment.user_id = user.user_id);";
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
                            <h2 class="text-center">All Comments</h2>

                            <p class="text-center mt-3" style="color:<?php echo isset($_REQUEST['success']) ? "green" : "red"; ?>"><?php echo $_REQUEST['message'] ?? ''; ?></p>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-sm-12 table-responsive">
                           <?php 
                             if($result->num_rows){

                             
                           ?>
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                    <th>Sr No</th>
                                    <th>Commented By</th>
                                    <th>Post Title</th>
                                    <th>Comment</th>
                                    <th>Commented at</th>
                                    <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $count  = 1;
                                        while ($comments = mysqli_fetch_assoc($result)) {
                                            // extract($row);
                                        ?>
                                    <tr>
                                    <td><?php echo $count++; ?></td>
                                        <td><?php echo $comments['first_name']." ".$comments['last_name']; ?></td>
                                        <td><?php echo $comments['post_title'] ?></td>
                                        <td><?php echo $comments['comment'] ?></td>
                                        <td><?php echo date("j  F Y h:i:s ",strtotime($comments['created_at']))??'' ?></td>
                                        <td> <a  class="btn btn-<?php echo $comments['is_active']=='Active'?"success":"danger" ;?>" href="updation_process.php?comment_id=<?php echo $comments['post_comment_id']; ?>&is_active=<?php echo $comments['is_active'] ?>"><?php echo $comments['is_active']??'InActive'; ?></a> </td>
                        
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