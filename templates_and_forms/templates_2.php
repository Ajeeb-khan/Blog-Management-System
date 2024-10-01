<?php
session_start();
class Template_2
{
    public function header()
    {
        require_once("require/database_settings.php");
        require_once("require/database.php");
        require_once("./templates_and_forms/genral.php");

        $database = new Database(HOSTNAME, USERNAME, PASSWORD, DATABASE);
        $genral = new Genral();
        $query = "SELECT * FROM category WHERE category_status = 'Active'";

        $result = $database->query_excute($query);
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php Genral::site_title(); ?></title>
            <!-- Bootstrap and CSS links -->
            <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
            <link rel="stylesheet" href="bootstrap/css/style.css">
            <!-- Google Fonts -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
            <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
        </head>

        <body>
            <nav style="background-color: #5B99C2; padding: 10px;" class="navbar navbar-expand-lg navbar-dark primary-text-emphasis">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#" style="font-size: 25px; color:darkslategray; font-weight:bold">Blog Website</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item">
                                <a class="nav-link" style="font-size: 18px; color:darkslategray" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="font-size: 18px; color:darkslategray" href="#recent">Latest</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" style="font-size: 18px; color:darkslategray" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categories</a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <?php while ($categories = mysqli_fetch_assoc($result)) { ?>
                                        <li><a class="dropdown-item" href="category.php?category_id=<?= $categories['category_id'] ?>"><?= $categories['category_title'] ?></a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="font-size: 18px; color:darkslategray" href="blog.php">Blogs</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="font-size: 18px; color:darkslategray" href="about.php">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="font-size: 18px; color:darkslategray" href="contact.php">Contact Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="font-size: 18px; color:darkslategray" href="faq.php">FAQ</a>
                            </li>
                        </ul>

                        <ul class="navbar-nav">
                            <?php if (isset($_SESSION['user'])) { 
                                // Fetch user info if logged in
                                $query = "SELECT * FROM user WHERE user_id = '" . $_SESSION['user'] . "'";
                                $result = $database->query_excute($query);
                                $user_data = mysqli_fetch_assoc($result);
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" style="margin-top:10px; text-decoration:none; color:darkslategray" href="./admin/dashboard.php" class="nav-link">
                             Admin Dahboard
                        </a>
                            </li>
                                <li style="list-style:none; margin: 5px; margin-left: 20px;">

                                    <!-- Button trigger modal -->
                                    <button type="button" class="border border-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <img src="images/<?php echo $user_data['user_image'] ?>" alt="User Image" width="50px" height="50px" class="rounded-pill" style="border: 2px solid white;">
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <ul style="list-style: none;" class="bg-info">
                                                        <li><a href="require/logout.php" class="nav-link" style="color: black;">Logout</a></li>
                                                    </ul>
                                                    
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php } else { ?>
                                <!-- Show Login and Signup if not logged in -->
                                <li class="nav-item me-2">
                                    <a class="nav-link" href="login.php"><button type="button" class="btn btn-danger">Login</button></a>
                                </li>
                                <li class="nav-item me-2">
                                    <a class="nav-link" href="signup.php"><button type="button" class="btn btn-danger">Signup</button></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </nav>
<?php
    }

   
    public function slider()
    {

        ?>
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="images/slider (2).webp" class="d-block w-100" alt="..." height="400px">
                    </div>
                    <div class="carousel-item">
                        <img src="images/slider (1).webp" class="d-block w-100" alt="..." height="400px">
                    </div>
                    <div class="carousel-item">
                        <img src="images/slider (1).jpg" class="d-block w-100" alt="..." height="400px">
                    </div>
                </div>
            </div>


        <?php
    }

    public function footer()
    {

        ?>
            <div style="background-color:oldlace;" class="container-fluid  mt-5">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4">
                            <h3 class="mb-3 text-info">Blog Website</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing, elit. Commodi temporibus dignissimos quas aliquam voluptatem deserunt, repudiandae, enim magnam totam. Officiis earum perspiciatis repellendus, impedit tenetur ab iste rerum alias voluptatum.</p>
                        </div>
                        <div class="col-sm-3">
                            <h3 class="mt-4 m-3"><span class="text-info">|</span>Links</h3>
                            <ul class="quick_links">
                                <li><a href="">Home</a></li>
                                <li><a href="">Blogs</a></li>
                                <li><a href="">Categories</a></li>
                                <li><a href="">About us</a></li>
                                <li><a href="">Contact us</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-2">
                            <h3 class="mt-4 m-3"><span class="text-info">|</span></h3>
                            <ul class="quick_links">
                                <li><a href="">Terms & Conditions</a></li>
                                <li><a href="">Privacy Policy</a></li>
                                <li><a href="">Something here</a></li>
                                <li><a href="">Project</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-3">
                            <h3 class=" mt-4"><span class="text-info">|</span> Follow Us</h3>
                            <p> Follow us on Social Media</p>
                            <a href="#"><span class="m-2"><img src="images/facebook.webp" alt="" width="30px" height="20px"></span></a>
                            <a href="#"><span class="m-2"><img src="images/insta.webp" alt="" width="30px" height="20px"></span></a>
                            <a href="#"><span class="m-2"><img src="images/linkdin.webp" alt="" width="30px" height="20px"></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid bg-dark text-info">
                <div class="row">
                    <div class="col-sm-12 text-center mt-3">
                        <p>© 2020 Copyright: Ajeeb khan</p>
                        <a class="text-info" style="text-decoration: none;" href="https://histpk.com/">histpk.com</a>
                    </div>
                </div>
            </div>

            <script type="text/javascript" src="bootstrap/js/bootstrap.bundle.js"></script>

        </body>

        </html>

<?php
    }
}
?>