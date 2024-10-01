<?php

require_once("./templates_and_forms/templates_2.php");
require_once("./templates_and_forms/forms.php");
require_once("./templates_and_forms/genral.php");
require_once("./require/database_settings.php");
require_once("./require/database.php");


$database = new Database(HOSTNAME, USERNAME, PASSWORD, DATABASE);
$genral = new Genral;


$template = new Template_2();
$template->header();
$template->slider();

$limit = 6; // Number of posts per page
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Get the current page number
$offset = ($page - 1) * $limit; // Calculate the offset


$query = "SELECT post.post_id, post.post_title, category.category_title, post.post_description, post.created_at, post.featured_image, user.first_name, user.last_name, user.user_image
FROM
    post_category
    INNER JOIN category ON (post_category.category_id = category.category_id)
    INNER JOIN post ON (post_category.post_id = post.post_id)
    INNER JOIN blog ON (post.blog_id = blog.blog_id)
    INNER JOIN user ON (blog.user_id = user.user_id)
    WHERE post.post_status = 'Active'
    ORDER BY post.post_id DESC
    LIMIT $limit OFFSET $offset";

$result = $database->query_excute($query);

// Get the total number of posts
$total_query = "SELECT COUNT(*) as total_posts FROM post WHERE post.post_status = 'Active'";
$total_result = $database->query_excute($total_query);
$total_row = mysqli_fetch_assoc($total_result);
$total_posts = $total_row['total_posts'];

$total_pages = ceil($total_posts / $limit); // Calculate the total number of pages

?>

<div class="container mt-5 mb-5">
	<div class="row">
		<div class="col-sm-12">
			<h3 class=" display-6 text-center mb-5" id="recent"><span class="text-danger">R</span>ecent <span class="text-danger">P</span>ost</h3>
		</div>
	</div>
	<!-- cards -->
	<div class="row">

		<?php
		while ($post = mysqli_fetch_assoc($result)) {
		?>
			<div class="col-sm-4">
				<div class="card p-2 w-100" style="width: 18rem;">
					<a href="post.php?post_id=<?php echo $post['post_id']; ?>" class="text-decoration-none text-dark">
						<img src="images/<?php echo $post['featured_image']; ?>" class="card-img-top" alt="..." width="100%" height="230px">
						<div class="card-body mt-2">
							<br> <span class="categories_text bg-body-secondary p-2 text-primary">
								<?php echo $post['category_title']; ?></span>
							<h5 class="card-title  mt-2 mb-2"><?php echo $post['post_title']; ?></h5>
							<p class="card-text"><?php echo substr($post['post_description'], 0, 50); ?></p>
						</div>
						<div class="card-footer bg-transparent">
							<img class="author_profile" src="images/<?php echo $post['user_image'] ?>" alt="" width="30px">
							<span class="card_footer_text"><?php echo $post['first_name'] . " " . $post['last_name']; ?></span>
							<span class="card_footer_text_date text-end_date"><?php echo date("j  F Y h:i:s ", strtotime($post['created_at'])) ?? '' ?></span>
						</div>
					</a>
				</div>
			</div>
		<?php
		}

		?>
	</div>
	<!-- cards -->

	<!-- Pagination -->
	<div class="row mt-5 mb-5">
		<div class="col-sm-12">
			<nav aria-label="Page navigation">
				<ul class="pagination justify-content-center">
					<!-- Previous Button -->
					<li class="page-item <?php if ($page <= 1) {
												echo 'disabled';
											} ?>">
						<a class="page-link" href="<?php if ($page > 1) {
														echo "?page=" . ($page - 1);
													} ?>">Previous</a>
					</li>
					<!-- Page Numbers -->
					<?php
					for ($i = 1; $i <= $total_pages; $i++) {
					?>
						<li class="page-item <?php if ($page == $i) {
													echo 'active';
												} ?>">
							<a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
						</li>
					<?php
					}
					?>
					<!-- Next Button -->
					<li class="page-item <?php if ($page >= $total_pages) {
												echo 'disabled';
											} ?>">
						<a class="page-link" href="<?php if ($page < $total_pages) {
														echo "?page=" . ($page + 1);
													} ?>">Next</a>
					</li>
				</ul>
			</nav>
		</div>
	</div>
</div>

<script src="./validations/admin_validations.js"></script>
<?php
$login_form = new Forms();
$login_form->set_method("POST");

$login_form->feedback();
$template->footer();
?>