<?php
require_once("../templates_and_forms/templates.php");
require_once("../require/database_settings.php");
require_once("../templates_and_forms/genral.php");
require_once("../require/database.php");

$database = new Database(HOSTNAME, USERNAME, PASSWORD, DATABASE);
$template = new Template();
$genral = new Genral;
$template->navbar();

$query = "SELECT user.user_id,  user.first_name, user.last_name, user.email, user.gender, user.address, user.user_image, user.user_image, user.created_at, user.date_of_birth, user.is_active
    FROM user
        INNER JOIN role 
            ON (user.role_id = role.role_id) WHERE user.role_id != 1 ORDER BY user.user_id DESC";
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
                        <h2 class="text-center">View All Users</h2>
                        <p class="text-center mt-3" style="color:<?php echo isset($_REQUEST['success']) ? "green" : "red"; ?>"><?php echo $_REQUEST['message'] ?? ''; ?></p>
                        <a href="add_user.php" class="btn btn-primary">Add User</a>

                       
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
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Address</th>
                                        <th>Date of Birth</th>
                                        <th>Profile</th>
                                        
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    while ($user_data = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $user_data['first_name'] . " " . $user_data['last_name']; ?> </td>
                                            <td><?php echo $user_data['email']; ?></td>
                                            <td><?php echo $user_data['gender']; ?> </td>
                                            <td><?php echo $user_data['address'] ?></td>
                                            <td><?php echo $user_data['date_of_birth'] ?></td>
                                            <td><img src="../images/<?php echo $user_data['user_image']; ?>" height="50px" width="50px" alt=""></td>
                                            <td>
                                                 <a href="updation_process.php?user_id=<?php echo $user_data['user_id']; ?>&is_active=<?php echo $user_data['is_active'] ?>" class="btn btn-<?php echo $user_data['is_active'] == 'Active' ? "success" : "danger" ?>"><?php echo $user_data['is_active'] ?? 'InActive'; ?></a>
                                                 <a class="btn btn-warning" href="add_user.php?user_id=<?= $user_data['user_id'] ?>">Edit</a>
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