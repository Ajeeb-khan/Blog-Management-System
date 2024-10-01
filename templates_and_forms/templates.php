<?php
class Template
{
    public function navbar()
    {
        session_start();
        require_once("../require/database_settings.php");
        require_once("../require/database.php");
        require_once("../templates_and_forms/genral.php");

        $database = new Database(HOSTNAME, USERNAME, PASSWORD, DATABASE);
        $genral = new Genral;
        $user_id = $_SESSION['user'] ?? '';

        
        if (!$user_id) {
            header("location: ../require/logout.php?message=Please login to your account.");
            exit;
        }

        $query = "SELECT * FROM user WHERE user_id = '" . $user_id . "'";
        $result = $database->query_excute($query);


        $user_data = mysqli_fetch_assoc($result);


        if ($user_data['role_id'] != 1 || $user_data['is_active'] != "Active" || $user_data['is_approved'] != "Approved") {

            header("location: ../index.php?messa=Only admins can access the admin panel.");
            exit;
        }
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="utf-8">
            <title>Admin Dashboard</title>
            <meta content="width=device-width, initial-scale=1.0" name="viewport">
            <meta content="" name="keywords">
            <meta content="" name="description">

            <!-- Favicon -->
            <link href="img/favicon.ico" rel="icon">
            <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
            <link href="css/style.css" rel="stylesheet">
        </head>

        <body>
            <!-- Admin Navbar Start -->
            <nav style="background-color: #7AA2E3;" class="navbar navbar-expand-lg navbar-light sticky-top">
                <div class="container-fluid">
                    <a href="#" class="navbar-brand d-flex d-lg-none me-4">
                        <h2 class="text-primary mb-0"></h2>
                    </a>
                    <a href="#" class="sidebar-toggler flex-shrink-0">
                        <i class="fa fa-bars"></i>
                    </a>
                    <!-- Home button -->
                    <div class="navbar-nav ms-auto navbar-light">
                        <a style="margin-top:7px; text-decoration: none;" href="../index.php" class="nav-link">
                            <i class="fa fa-home"></i> Home
                        </a>
                        <div class="navbar-nav ms-auto">
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                    <source srcset="../images/<?php echo $user_data['user_image']; ?>"><img src="../images/<?php echo $user_data['user_image']; ?>" alt="User name" width="40" height="40" class="rounded-pill">
                                    <span class="d-none d-lg-inline-flex"><?php echo $user_data["first_name"] . " " . $user_data["last_name"]; ?></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end bg-light border-0 m-0">
                                    <a href="user_profile.php?user_id=<?= $user_data['user_id'] ?>" class="dropdown-item">My Profile</a>
                                    <a href="#" class="dropdown-item">Settings</a>
                                    <a href="../require/logout.php" class="dropdown-item">Log Out</a>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
            </nav>
        <?php
    }


    public function sidebar()
    {
        ?>
            <!-- Admin Sidebar Start -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-2 sidebar" style="background-color: #7AA2E3;">
                        <nav class="navbar navbar-light">
                            <a href="index.php" class="navbar-brand mx-4 mb-3">
                                <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>ADMIN</h3>
                            </a>
                            <!-- <div class="d-flex align-items-center ms-4 mb-4">
                                <div class="position-relative">
                                    <img class="rounded-circle" src="../images/ajeeb khan.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-0">Ajeeb Khan</h6>
                                    <span>Admin</span>
                                </div>
                            </div> -->
                            <div class="navbar-nav w-100">
                                <a href="Dashboard.php" class="nav-item nav-link active">
                                    <i class="fa fa-tachometer-alt me-2"></i>Dashboard
                                </a>
                                <!-- Manage Categories -->
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class="fas fa-tags me-2"></i>Manage Categories
                                    </a>
                                    <div class="dropdown-menu bg-transparent border-0">
                                        <a href="categori.php" class="dropdown-item">Create Category</a>
                                        <a href="view_category.php" class="dropdown-item">View Category</a>
                                    </div>
                                </div>
                                <!-- Manage Blog -->
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class="fas fa-book me-2"></i>Manage Blog
                                    </a>
                                    <div class="dropdown-menu bg-transparent border-0">
                                        <a href="add_blog.php" class="dropdown-item">Add Blog</a>
                                        <a href="view_blog.php" class="dropdown-item">View Blog</a>
                                    </div>
                                </div>
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class="fas fa-edit me-2"></i>Manage Post
                                    </a>
                                    <div class="dropdown-menu bg-transparent border-0">
                                        <a href="add_post.php" class="dropdown-item">Add Post</a>
                                        <a href="view_post.php" class="dropdown-item">View Post</a>
                                    </div>
                                </div>
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class="fas fa-users me-2"></i>Manage Users
                                    </a>
                                    <div class="dropdown-menu bg-transparent border-0">
                                        <a href="add_user.php" class="dropdown-item">Add User</a>
                                        <a href="view_users.php" class="dropdown-item">View Users</a>
                                    </div>
                                </div>
                                <!-- Feedback -->
                                <a href="feedback.php" class="nav-item nav-link">
                                    <i class="fas fa-comment-dots me-2"></i>Feedback
                                </a>
                                <a href="user_requiest.php" class="nav-item nav-link">
                                    <i class="fas fa-user-clock me-2"></i>User Requests
                                </a>
                                <!-- Comments -->
                                <a href="comments.php" class="nav-item nav-link">
                                    <i class="fas fa-comments me-2"></i>Comments
                                </a>
                                <!-- Blog Settings -->
                                <a href="blog_settings.php" class="nav-item nav-link">
                                    <i class="fas fa-cog me-2"></i>Blog Settings
                                </a>
                                <!-- Settings -->
                                <a href="settings.php" class="nav-item nav-link">
                                    <i class="fas fa-cog me-2"></i>Settings
                                </a>
                                <!-- Manage Users -->

                            </div>
                        </nav>
                    </div>
                    <!-- <div class="col-lg-10">
                </div> -->
                </div>
            </div>
        <?php
    }




    public function admin_footer()
    {
        ?>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
            <script src="js/main.js"></script>

            <!-- DataTables Initialization -->
            <script>
                $(document).ready(function() {
                    $('#example').DataTable();
                });
            </script>
        </body>

        </html>
<?php
    }
}
?>