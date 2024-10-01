<?php
require_once("../templates_and_forms/templates.php");
require_once("../templates_and_forms/genral.php");
require_once("../require/database_settings.php");
require_once("../require/database.php");

$database = new Database(HOSTNAME, USERNAME, PASSWORD, DATABASE);
$template = new Template();
$genral = new Genral;
$template->navbar();


$query = "SELECT * FROM category ORDER BY Category.category_id DESC";

$result = $database->query_excute($query);

?>

<div class="container-fluid">
    <div class="container">
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
                            <h2 class="text-center">All Categories</h2>
                            <p class="text-center mt-3" style="color:<?php echo isset($_REQUEST['success']) ? "green" : "red"; ?>"><?php echo $_REQUEST['message'] ?? ''; ?></p>
                            <a href="categori.php" class="btn btn-primary">Add Categories</a>
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
                                            <th>Category Title</th>
                                            <th>Category Description</th>
                                            <th>Added On</th>
                                           
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $count++; ?></td>
                                                <td><?php echo $row['category_title']; ?> </td>
                                                <td><?php echo $row['category_description']; ?></td>
                                                <td><?php echo date("j  F Y h:i:s ", strtotime($row['created_at'])) ?? '' ?></td>
                                                <td>
                                                    <a class="btn btn-<?php echo $row['category_status'] == 'Active' ? "success" : "danger" ?>" href="updation_process.php?category_id=<?php echo $row['category_id']; ?>&category_status=<?php echo $row['category_status']; ?>"><?php echo $row['category_status'] ?? 'InActive'; ?></a>
                                                    <a href="categori.php?category_id=<?php echo $row['category_id'] ?>" class="btn btn-warning">Edit</a>
                                                    <!-- <a href="delete_category.php?category_id=<?php echo $row['category_id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?');">Delete</a> -->
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
</div>

<?php $template->admin_footer(); ?>