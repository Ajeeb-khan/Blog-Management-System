
<?php
require_once("../templates_and_forms/genral.php");
require_once("../templates_and_forms/templates.php");
require_once("../require/database_settings.php");
require_once("../require/database.php");


$database = new Database(HOSTNAME, USERNAME, PASSWORD, DATABASE);
$genral = new Genral;
$template = new Template();
$template->navbar();

$query = "SELECT * FROM user WHERE is_approved = 'Pending'";

$result = $database->query_excute($query);
?>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <?php $template->sidebar(); ?>

        <!-- Main content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="container mt-5 mb-5">
                <div class="row">
                    <div class="col-sm-12 text-end">
                        <h2 class="text-center">User Requests</h2>
                        <p class="text-center mt-3" style="color:<?php echo isset($_REQUEST['success']) ? "green" : "red"; ?>">
                            <?php echo $_REQUEST['message'] ?? ''; ?>
                        </p>
                        
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-sm-12 table-responsive">
                        <?php
                        if ($result->num_rows) {
                        ?>
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sr No</th>
                                        <th>User Name</th>
                                        <th>User Email</th>
                                        <th>Profile Image</th>
                                        <th>Created On</th>
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
                                            <td><?php echo $row['first_name'] . " " . $row['last_name']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><img src="../images/<?php echo $row['user_image']; ?>" alt="" width="50" height="50"></td>
                                            <td><?php echo date("j F Y h:i:s", strtotime($row['created_at'])) ?? ''; ?></td>
                                            <td>
                                                <a class="btn btn-success" href="updation_process.php?user_approve_id=<?php echo $row['user_id']; ?>&email=<?php echo $row['email']; ?>">Approve</a>
                                                <a class="btn btn-danger" href="updation_process.php?user_reject_id=<?php echo $row['user_id']; ?>&email=<?php echo $row['email']; ?>">Reject</a>
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
