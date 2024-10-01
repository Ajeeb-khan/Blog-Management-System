<?php
require_once("../require/database_settings.php");
require_once("../require/database.php");
require_once("../templates_and_forms/templates.php");
$database = new Database(HOSTNAME, USERNAME, PASSWORD, DATABASE);
$template = new Template();
$template->navbar();
$template->sidebar();


// Total users
$query = "SELECT COUNT(*) AS 'total_users' FROM user";
$result = $database->query_excute($query);
$total_users = mysqli_fetch_assoc($result);

//Total Blogs
$query = "SELECT COUNT(*) AS 'total_blogs' FROM blog";
$result = $database->query_excute($query);
$total_blogs = mysqli_fetch_assoc($result);

//Total posts
$query = "SELECT COUNT(*) AS 'posts' FROM post";
$result = $database->query_excute($query);
$posts = mysqli_fetch_assoc($result);

// Total categories
$query = "SELECT COUNT(*) AS 'category' FROM category";
$result = $database->query_excute($query);
$category = mysqli_fetch_assoc($result);

// Total feedbacks
$query = " SELECT COUNT(*) AS 'feedbacks' FROM user_feedback ";
$result = $database->query_excute($query);
$feedbacks = mysqli_fetch_assoc($result);


// Total comments
$query = " SELECT COUNT(*) AS comments FROM post_comment ";
$result = $database->query_excute($query);
$comments = mysqli_fetch_assoc($result);


// Active users
$query = "SELECT COUNT(is_active) AS active FROM user WHERE is_active = 'Active'";
$result = $database->query_excute($query);
$active = mysqli_fetch_assoc($result);


// Inactive users
$query = "SELECT COUNT(is_active) AS in_active FROM user WHERE is_active = 'InActive'";
$result = $database->query_excute($query);
$in_active = mysqli_fetch_assoc($result);

// Panding users
$query = " SELECT COUNT(is_approved) AS pendding FROM user WHERE is_approved = 'Pending'";
$result = $database->query_excute($query);
$pendding = mysqli_fetch_assoc($result);
?>


<div class="container-xxl position-relative bg-white d-flex p-0">
    <div class="container-fluid content">
        <div class="row m-2">

            <h2 class="my-3">Admin (Ajeeb khan)</h2>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> Total Active User</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800 text-warning">
                                    <h4><?= $active['active'] ?></h4>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-check fa-2x text-primary"></i>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Blogs</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_blogs['total_blogs'] ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-book fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Feedback</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $feedbacks['feedbacks'] ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comment-dots fa-2x text-primary"></i>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pending Users</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pendding['pendding'] ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-clock fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row m-2">

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Register users</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">

                                    <h4><?= $total_users['total_users'] ?></h4>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-plus fa-2x text-primary"></i>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Categories</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $category['category'] ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-tags fa-2x text-primary"></i>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Posts</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $posts['posts'] ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-edit fa-2x text-primary"></i>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Comments</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $comments['comments'] ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> Total InActive User</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800 text-warning">
                                    <h4><?= $in_active['in_active'] ?></h4>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-times fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php $template->admin_footer(); ?>