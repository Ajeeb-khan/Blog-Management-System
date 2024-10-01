<?php

class admin_forms
{
    public $action = NULL;
    public $method = NULL;
    public $database;

    // Constructor  database connection
    public function __construct()
    {
        require_once("../require/database_settings.php");
        require_once("../require/database.php");
        $this->database = new Database(HOSTNAME, USERNAME, PASSWORD, DATABASE);
    }

    public function set_action($action)
    {
        $this->action = $action;
    }

    public function set_method($method)
    {
        $this->method = $method;
    }

    public function get_action()
    {
        return $this->action;
    }

    public function get_method()
    {
        return $this->method;
    }



    public function blog()
    {
        $blog_id = $_REQUEST['blog_id'] ?? '';
        $query = "SELECT * FROM blog WHERE blog_id='" . $blog_id . "'";
        $result = $this->database->query_excute($query);
        $blog = mysqli_fetch_assoc($result);
?>

        <div class="container">
            <div class="row justify-content-center mt-5 mb-5">
                <div class="col-md-8 col-lg-6 shadow">
                    <div class="text-center mb-4">
                        <p class="text-center text-success mt-3"><?= $_GET['message'] ?? '' ?></p>
                        <h3 class="rounded-pill shadow bg-primary text-warning py-3">
                            <?= isset($_REQUEST['blog_id']) ? "Update" : "Add" ?> Blog
                        </h3>
                    </div>
                    <div class="custom-form-container">
                        <!-- Form -->
                        <form action="<?= isset($_REQUEST['blog_id']) ? "updation_process.php?blog_update_id=" . $blog['blog_id'] : "insertion_process.php" ?>" method="POST" enctype="multipart/form-data" onsubmit="return validationBlog()">
                            <div class="mb-3">
                                <label for="blog_title" class="form-label">Blog Title</label>
                                <input type="text" class="form-control" id="blog_title" name="blog_title" value="<?= $blog['blog_title'] ?? '' ?>">
                                <span id="blog_title_msg" class="text-danger"></span>
                            </div>
                            <div class="mb-3">
                                <label for="post_per_page" class="form-label">Posts Per Page</label>
                                <input type="number" class="form-control" id="post_per_page" name="post_per_page" value="<?= $blog['post_per_page'] ?? '' ?>">
                                <span id="post_per_page_msg" class="text-danger"></span>
                            </div>

                            <div class="mb-3">
                                <label for="blog_background_image" class="form-label">Blog Background Image</label>
                                <input type="file" class="form-control" name="blog_background_image" id="blog_background_image">
                                <!-- Store the old image in a hidden input -->
                                <input type="hidden" id="old_image" name="old_image" value="<?= $blog['blog_background_image'] ?? '' ?>">

                                <!-- Show the current image only if it's an update -->
                                <?php if (isset($_REQUEST['blog_id']) && !empty($blog['blog_background_image'])): ?>
                                    <span><img src="../images/<?= $blog['blog_background_image'] ?>" alt="" width="50px" height="50px"></span>
                                <?php endif; ?>

                                <span id="blog_background_image_msg" class="text-danger"></span>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary custom-btn w-40 mb-3 py-1" name="add_blog">
                                    <?= isset($_REQUEST['blog_id']) ? "Update" : "Add" ?> Blog
                                </button>
                            </div>
                        </form>
                        <!-- Form -->
                    </div>
                </div>
            </div>
        </div>

    <?php
    }





    public function category()
    {
        $category_id = $_REQUEST['category_id'] ?? '';
        $query = "SELECT * FROM category WHERE category_id='" . $category_id . "'";
        $result = $this->database->query_excute($query);
        $category = mysqli_fetch_assoc($result);
    ?>
        <div class="container">
            <div class="row justify-content-center mt-5 mb-5">
                <div class="col-md-8 col-lg-6 shadow">
                    <div class="text-center mb-4">
                        <p class="text-center text-success mt-3"><?php echo $_GET['message'] ?? ''; ?></p>
                        <h3 class="rounded-pill shadow bg-primary text-warning py-3"><?php echo isset($_REQUEST['category_id']) ? "Update" : "Add" ?> Category</h3>
                    </div>
                    <div class="custom-form-container">
                        <!-- Form -->
                        <form method="post" action="<?php echo isset($_REQUEST['category_id']) ? "updation_process.php?category_update_id=" . $_REQUEST['category_id'] . "" : "insertion_process.php" ?>" enctype="multipart/form-data" onsubmit="return validationCategory()">
                            <div class="mb-4">
                                <label for="category_title" class="form-label">Category Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="category_title" id="category_title" value="<?php echo $category['category_title'] ?? '' ?>">
                                <span id="category_title_msg" class="text-danger"></span>

                            </div>
                            <div class="mb-4">
                                <label for="category_description" class="form-label">Category Description <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="category_description" id="category_description" value="<?php echo $category['category_description'] ?? '' ?>">
                                <span id="category_description_msg" class="text-danger"></span>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary custom-btn w-40 mb-3 py-1" name="add_category"><?php echo isset($_REQUEST['category_id']) ? "Update" : "Add" ?> Category</button>
                            </div>
                        </form>
                        <!-- Form -->
                    </div>
                </div>
            </div>
        </div>
    <?php


    }



     public function post()
    {
        $post_id = $_REQUEST['post_id'] ?? '';
        $query = "SELECT * FROM post WHERE post_id='" . $post_id . "'";
        $result = $this->database->query_excute($query);
        $post = mysqli_fetch_assoc($result);


        $post_atachment_id = $_REQUEST['post_atachment_id'] ?? '';
        $query = "SELECT * FROM post_atachment WHERE post_id='" . $post_id . "'";
        $result = $this->database->query_excute($query);
        $post_atachment = mysqli_fetch_assoc($result);


    ?>
        <div class="container">
            <div class="row justify-content-center mt-5 mb-5">
                <div class="col-md-8 col-lg-6 shadow">
                    <div class="text-center mb-4">
                        <p class="text-center text-success mt-3"><?= $_GET['message'] ?? '' ?></p>
                        <h3 class="rounded-pill shadow bg-primary text-warning py-3"><?= isset($_REQUEST['post_id']) ? "Update" : "Add" ?> Post</h3>
                    </div>
                    <div class="custom-form-container">
                        <!-- Form -->
                        <form action="<?= isset($_REQUEST['post_id']) ? "updation_process.php?post_update_id=" . $post['post_id'] : "insertion_process.php" ?>" method="POST" enctype="multipart/form-data" onsubmit="return validationPost()">
                            <div class="mb-3">
                                <label for="blog" class="form-label">Blogs</label>
                                <select name="blog" class="form-select" id="blog">
                            <?php
                            $query = "SELECT * FROM blog";
                            $result = $this->database->query_excute($query);
                            while ($blogs = mysqli_fetch_assoc($result)) {
                            ?>
                                <option value="<?= $blogs['blog_id'] ?>" <?= (isset($post['blog_id']) && $post['blog_id'] == $blogs['blog_id']) ? 'selected' : '' ?>>
                                    <?= $blogs['blog_title'] ?>
                                </option>
                            <?php } ?>
                              </select>

                                <span id="blog_msg" class="text-danger"></span>
                            </div>

                            <div class="mb-3">
                                <label for="post_title" class="form-label">Post Title</label>
                                <input type="text" class="form-control" id="post_title" name="post_title" value="<?php echo $post['post_title'] ?? '' ?>">
                                <span id="post_title_msg" class="text-danger"></span>
                            </div>
                            <div class="mb-3">
                                <label for="post_summary" class="form-label">Post Summary</label>
                                <textarea class="form-control" id="post_summary" name="post_summary" rows="3"><?php echo $post['post_summary'] ?? '' ?></textarea>
                                <span id="post_summary_msg" class="text-danger"></span>
                            </div>
                            <div class="mb-3">
                                <label for="post_description" class="form-label">Post Description</label>
                                <textarea class="form-control" id="post_description" name="post_description" rows="5"><?php echo $post['post_summary'] ?? '' ?></textarea>
                                <span id="post_description_msg" class="text-danger"></span>
                            </div>
                            <div class="mb-3">
                                <label for="post_title" class="form-label">Select Categories</label>
                                <select class="form-select" aria-label="Default select example" name="category" multiple  >
                                    <?php 
                                    // $query = "SELECT * FROM category ";
                                    // $result = $this->database->query_excute($query);
                                    // while ($categories = mysqli_fetch_assoc($result)){
                                    ?>
                                    <option >
                                        <!--  <?= ($post['category_id']== $categories['category_id'] )? 'selected':''; ?> --> 
                                    </option>
                                <?php
                                 // }

                                ?>
                                    <?php
                                    $query = "SELECT * FROM category";
                                    $result = $this->database->query_excute($query);
                                    while ($categories = mysqli_fetch_assoc($result)) {
                                        
                                    ?>
                                        <option value="<?= $categories['category_id'] ?>" selected ><?= $category['category_title'] ?? '' ?><?php echo $categories['category_title']; ?> 

                                        </option>

                                        <?php
                                    }

                                        ?>
                                </select>
                                <span id="category_msg" class="text-danger"></span>
                            </div>
                            <div class="mb-3">
                                <label for="featured_image" class="form-label">Featured Image</label>
                                <input type="file" class="form-control" id="featured_image" name="featured_image">
                                <input type="hidden" id="old_image" name="old_image" value="<?= $post['featured_image'] ?? '' ?>">
                            
                            <!-- Show the current image only if it's an update -->
                            <?php if(isset($_REQUEST['post_id']) && !empty($post['featured_image'])): ?>
                                <span><img src="../images/<?= $post['featured_image'] ?>" alt="" width="50px" height="50px"></span>
                            <?php endif; ?>
                                <span id="featured_image_msg" class="text-danger"></span>
                            </div>
                            <div class="mb-3">
                                <span class="mt-2">Allow Comments?</span>
                                <div class="form-check form-check-inline">
                                    <input <?= isset($post['is_comment_allowed']) && $post['is_comment_allowed'] ? "checked" : '' ?> class="form-check-input" type="radio" name="allow_comments" id="inlineRadio1" value="1">
                                    <label class="form-check-label" for="inlineRadio1">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input <?= isset($post['is_comment_allowed']) && !$post['is_comment_allowed'] ? "checked" : '' ?> class="form-check-input" type="radio" name="allow_comments" id="inlineRadio2" value="0">
                                    <label class="form-check-label" for="inlineRadio2">No</label>
                                </div>
                                <span id="is_comment_allowed_msg" class="text-danger"></span>
                            </div>
                            <div class="mb-3">
                                <label for="post_attachment_title" class="form-label">Attachment Title</label>
                                <input type="text" class="form-control" id="post_attachment_title" name="post_attachment_title" value="<?= $post_atachment['post_attachment_title']?? '' ?>">
                                <span id="post_attachment_title_msg" class="text-danger"></span>
                            </div>

                            <div class="mb-3">
                                <label for="post_attachment_path" class="form-label">Attachment</label>
                                <input type="file" class="form-control" id="post_attachment_path" name="post_attachment_path">
                                <input type="hidden" id="old_image" name="old_image" value="<?= $post_atachment['post_attachment_path'] ?? '' ?>">
                            
                            <!-- Show the current image only if it's an update -->
                            <?php if(isset($_REQUEST['post_id']) && !empty($post_atachment['post_attachment_path'])): ?>
                                <span><img src="../images/<?= $post_atachment['post_attachment_path'] ?>" alt="" width="50px" height="50px"></span>
                            <?php endif; ?>
                                <span id="post_attachment_path_msg" class="text-danger"></span><button>Add Attachment +</button>
                            </div>
                            <!-- <div class="mb-3">
                               <label for="post_attachment_path" class="form-label">Attachments</label>
                               <input type="file" class="form-control" id="post_attachment_path" name="post_attachment_path[]" multiple>
                               <span id="post_attachment_path_msg" class="text-danger"></span>
                            </div> -->

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary custom-btn w-40 mb-3 py-1" name="add_post">
                                    <?= isset($_REQUEST["post_id"]) ? "Update" : "Add" ?> Post
                                </button>
                            </div>
                        </form>
                        <!-- Form -->
                    </div>
                </div>
            </div>
        </div>
    <?php
    }




    function user()
    {


        $user_id = $_REQUEST['user_id'] ?? '';
        $query = "SELECT * FROM user WHERE user_id='" . $user_id . "'";
        $result = $this->database->query_excute($query);
        $user = mysqli_fetch_assoc($result);

    ?>



        <div class="container">
            <div class="row justify-content-center mt-5 mb-5">
                <div class="col-md-8 col-lg-6 shadow">
                    <div class="text-center mb-3">
                        <p class="text-center text-success mt-3"><?php echo $_GET['message'] ?? ''; ?></p>
                        <h3 class="rounded-pill shadow bg-primary text-warning py-3"><?= isset($_REQUEST['user_id']) ? "Update" : "Add" ?> User</h3>
                    </div>
                    <div class="custom-form-container">
                        <!-- Form -->
                        <form method="post" action="<?= isset($_REQUEST['user_id']) ? "updation_process.php?user_update_id=" . $user['user_id'] : "insertion_process.php" ?>" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="first_name" id="first_name" required value="<?php echo $user['first_name'] ?? '' ?>">
                                <span id="first_name_msg" class="text-danger"></span>
                            </div>
                            <div class="mb-3">
                                <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="last_name" id="last_name" required value="<?php echo $user['last_name'] ?? '' ?>">
                                <span id="last_name_msg" class="text-danger"></span>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="email" id="email" required value="<?php echo $user['email'] ?? '' ?>">
                                <span id="email_msg" class="text-danger"></span>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">User Role <span class="text-danger">*</span></label>
                                <select class="form-select" name="role_type" aria-label="Default select example" id="role_type">
                                    <option value="2" selected>User</option>
                                    <option value="1">Admin</option>
                                </select>
                                <span id="role_type_msg" class="text-danger"></span>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label"> Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password" id="password" required value="<?php echo $user['password'] ?? '' ?>">
                                <span id="password_msg" class="text-danger"></span>
                            </div>
                            <span class="mt-4">Gender<span class="text-danger">*</span></span> &nbsp; &nbsp; &nbsp;
                            <div class="form-check form-check-inline">
                                Male<input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="Male" checked>
                                <label class="form-check-label" for="inlineRadio1"><?php echo $user['gender'] ?? '' ?></label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="Female">
                                <label class="form-check-label" for="inlineRadio2">Female</label>
                            </div>
                            <div class="mb-3">
                                <label for="dob" class="form-label"> Date_of_birth <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" required value="<?php echo $user['date_of_birth'] ?? '' ?>">
                                <span id="date_of_birth_msg" class="text-danger"></span>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label"> Address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="address" id="address" value="<?php echo $user['address'] ?? '' ?>">
                                <span id="address_msg" class="text-danger"></span>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">User Image</label>
                                <input type="file" class="form-control" id="user_image" name="user_image">
                                <input type="hidden" id="old_image" name="old_image" value="<?= $user['user_image'] ?? '' ?>">


                                <?php if (isset($_REQUEST['user_id']) && !empty($user['user_image'])): ?>
                                    <span><img src="../images/<?= $user['user_image'] ?>" alt="" width="50px" height="50px"></span>
                                <?php endif; ?>
                                <span id="user_image_msg" class="text-danger"></span>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary custom-btn w-40 mb-3 py-1" name="add_user"><?php echo isset($_REQUEST['user_id']) ? "Update" : "Add" ?> User</button>
                            </div>
                        </form>
                        <!-- Form -->
                    </div>
                </div>
            </div>
        </div>
    <?php
    }



    public function change()
    {

        // $user_id = $_REQUEST['update_admin_profile'] ?? '';
        // $query = "SELECT * FROM user WHERE user_id ='" . $user_id . "'";
        // $result = $this->database->query_excute($query);
        // $user = mysqli_fetch_assoc($result);

        $user_id = $_SESSION['user'] ?? '';
        // print_r($_SESSION['user']);
        // die();
        $query = "SELECT * FROM user WHERE user_id = '" . $user_id . "'";

        $result = $this->database->query_excute($query);

        $user_data = mysqli_fetch_assoc($result);

        // echo "<pre>";
        // print_r($user_data);
        // die();
        // if (isset($_SESSION['user']) and $_SESSION['user'] == 1) {

        // }


    ?>

        <div class="container">
            <div class="row justify-content-center mt-5 mb-5">
                <div class="col-md-8 col-lg-6 shadow p-4">
                    <p class="text-center text-success mt-3"><?php echo $_GET['message'] ?? ''; ?></p>
                    <h3 class="text-center">User Profile</h3>

                    <!-- Displaying User Image on Top -->
                    <div class="text-center mb-4">
                        <img class="border p-2" src="../images/<?php echo $user_data['user_image']; ?>" height="100px" width="120px" alt="Profile Image" width="100px" height="120px">
                    </div>

                    <div class="custom-form-container">
                        <!-- Form -->
                        <form method="post" action="<?= isset($_REQUEST['user_id']) ? "updation_process.php?update_admin_profile=" . $user_data['user_id'] : " " ?>" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="user_image" class="form-label">Change Profile Image <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" name="user_image" id="user_image" required>
                                <div id="fileHelp" class="form-text text-center text-<?php  ?>">
                                    <?php echo $_REQUEST['error_message'] ?? ''; ?>
                                </div>
                            </div>

                    </div>
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="first_name" id="first_name" required value="<?php echo htmlspecialchars($user_data['first_name']); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="last_name" id="last_name" required value="<?php echo htmlspecialchars($user_data['last_name']); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" id="email" required value="<?php echo htmlspecialchars($user_data['email']); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="password" id="password" required value="<?php echo htmlspecialchars($user_data['password']); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="role_id" class="form-label">User Role <span class="text-danger">*</span></label>
                        <select class="form-select" name="role_id" id="role_id">
                            <option value="1" <?php echo $user_data['role_id'] == 1 ? 'selected' : ''; ?>>Admin</option>
                            <option value="2" <?php echo $user_data['role_id'] == 2 ? 'selected' : ''; ?>>User</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <span>Gender <span class="text-danger">*</span></span> <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="gender_male" value="Male" <?php echo $user_data['gender'] == 'Male' ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="gender_male">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="gender_female" value="Female" <?php echo $user_data['gender'] == 'Female' ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="gender_female">Female</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="date_of_birth" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" required value="<?php echo htmlspecialchars($user_data['date_of_birth']); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="3"><?php echo htmlspecialchars($user_data['address']); ?></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mt-4" name="update_admin_profile"><?php echo isset($_REQUEST['user_id']) ? "Update" : "Add" ?> Profile</button>
                    </div>
                    </form>
                    <!-- Form -->
                </div>
            </div>
        </div>
        </div>
    <?php
    }



    public function setting()
    {
    ?>
        <div class="container">
            <div class="row justify-content-center mt-5 mb-5">
                <div class="col-md-8 col-lg-6">
                    <div class="text-center mb-4">
                        <h3> Settings</h3>
                    </div>
                    <div class="custom-form-container">
                        <!-- Form -->
                        <form action="blog_process.php" method="POST" enctype="multipart/form-data" onsubmit="return validationSetting()">
                            <div class="mb-3">
                                <label for="user_id" class="form-label">User Id</label>
                                <input type="text" class="form-control" id="user_id" name="user_id">
                                <span id="user_id_msg" class="text-danger"></span>
                            </div>
                            <div class="mb-3">
                                <label for="setting_key" class="form-label">Setting Key</label>
                                <input type="text" class="form-control" id="setting_key" name="setting_key">
                                <span id="setting_key_msg" class="text-danger"></span>
                            </div>
                            <div class="mb-3">
                                <label for="setting_value" class="form-label">Setting Value</label>
                                <input type="text" class="form-control" id="setting_value" name="setting_value">
                                <span id="setting_value_msg" class="text-danger"></span>
                            </div>
                            <div class="mb-3">
                                <label for="setting_status" class="form-label">Setting Status</label>
                                <select class="form-control" id="setting_status" name="setting_status">
                                    <option value="Active">Active</option>
                                    <option value="InActive">InActive</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                        <!-- Form -->
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}
?>