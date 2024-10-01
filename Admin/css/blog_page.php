<?php
require("header.php");


// $query = "SELECT * FROM blog WHERE blog_id = '".$_REQUEST['blog_id']."'";
// $result = $database->query_excute($query);

// $blog = mysqli_fetch_assoc($result);

$query = "SELECT blog.blog_id, blog.blog_title, blog.blog_decription, blog.blog_background_image , blog.blog_decription, blog.post_per_page, blog.blog_status
, blog.created_at, post.featured_image, post.post_id, post.post_title, post.post_description, post.post_status, post.created_at
, user.first_name, user.last_name, user.user_image
FROM 21429_sajid_ali.post
INNER JOIN 21429_sajid_ali.blog 
	ON (post.blog_id = blog.blog_id)
INNER JOIN 21429_sajid_ali.user 
	ON (blog.user_id = user.user_id) WHERE blog.blog_id = '".$_REQUEST['blog_id']."'";

$result = $database->query_excute($query);
$blog = mysqli_fetch_assoc($result);


?>
<div class="container-fluid mt-2 ">
    <div class="row">
        <div class="col-sm-12">
	        <div class="banner">
	        <img src="images/slider (1).jpg" alt="" width="100%" height="250px">
	    	</div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3 mt-5 text-center">
                <img class="border" style="border-radius: 100%;" src="images/Blog_images/<?php echo $blog['blog_background_image']; ?>" alt="" width="200px" height="150px">
        </div>
        <div class="col-sm-8">
        	
            <h1 class="mt-5 mb-5"><?php echo $blog['blog_title']??''; ?>
            <?php 
            	$query = "SELECT following_blog.follow_id, following_blog.status, following_blog.created_at, blog.blog_title
				, user.first_name, user.last_name
			FROM
				21429_sajid_ali.following_blog
				INNER JOIN 21429_sajid_ali.blog 
					ON (following_blog.blog_following_id = blog.blog_id)
				INNER JOIN 21429_sajid_ali.user 
					ON (blog.user_id = user.user_id) AND (following_blog.follower_id = user.user_id) WHERE blog.blog_id='".$blog['blog_id']."'";
				$result = $database->query_excute($query);
				$follow = mysqli_fetch_assoc($result);
            	if(isset($_SESSION['user'])){


            		?>
					<button class="btn btn-danger m-3"><a class="nav-link" href="insertion_user_process.php?user_follow_id=<?php echo $_SESSION['user']?>&blog_page_id=<?php echo $blog['blog_id']; ?>"><?php echo $follow['status']=='Unfollowed'?'Follow':"Followed" ?></a></button>
            		<?php
            	}
            	else
            	{
            		?>
            			<button class="btn btn-danger m-3"><a class="nav-link" href="login.php?message=In Order to Follow the Page Please login into your account&color=red">Follow</a></button>

            		<?php
            	}

            ?>
              <span class="followers_section">Followers <br /> &nbsp;&nbsp;&nbsp; 100k</span> </h1>
            <p class="lead"><?php echo $blog['blog_decription']; ?></p>
            <div class="card-footer bg-transparent mt-3 mb-3">
                   <img class="author_profile" src="images/users_profile/<?php echo $blog['user_image']?>" alt="" width="50px">
                    <span class="card_footer_text"><?php echo $blog['first_name']." ".$blog['last_name'] ?></span> &nbsp; &nbsp; &nbsp;
                    <span class="card_footer_text"><?php echo date("j  F Y h:i:s ",strtotime($blog['created_at']))??'' ?></span>
                </div>
        </div>
    </div>
</div>
<div class="container mt-5 mb-5">
		<div class="row">
			<?php $query = "SELECT COUNT(*) AS 'total_post' FROM post WHERE blog_id = '".$blog['blog_id']."'";
				$result = $database->query_excute($query);
				$total_post = mysqli_fetch_assoc($result);
			?>
			<h6 class="text-end  p-2">Total Post in Blog: <?php 	echo $total_post['total_post']; ?></h6>
			<?php 

$query = "SELECT post.post_id, post.post_title, category.category_title, post.post_description , post.created_at , post.featured_image , user.first_name , user.last_name , user.user_image
FROM
    21429_sajid_ali.post_category
    INNER JOIN 21429_sajid_ali.category 
        ON (post_category.category_id = category.category_id)
    INNER JOIN 21429_sajid_ali.post 
        ON (post_category.post_id = post.post_id)
    INNER JOIN 21429_sajid_ali.blog 
        ON (post.blog_id = blog.blog_id)
    INNER JOIN 21429_sajid_ali.user 
        ON (blog.user_id = user.user_id) WHERE post.blog_id = '".$_REQUEST['blog_id']."' and  post.post_status = 'Active'  ORDER BY post.post_id DESC LIMIT ".$blog['post_per_page']."";

       			 $result = $database->query_excute($query);
       			 if($result->num_rows)
       			 {
       			 	while($all_data = mysqli_fetch_assoc($result))
					{
						?>
						<div class="col-sm-4">
						<div class="card p-2 w-100" style="width: 18rem;">
							<a href="post.php?post_id=<?php echo $all_data['post_id']; ?>" class="text-decoration-none text-dark">
								<img src="images/post_images/<?php echo $all_data['featured_image']; ?>" class="card-img-top" alt="..." width="100%" height="230px">
								<div class="card-body mt-2">
									<span class="categories_text bg-body-secondary p-2 text-primary"><?php echo $all_data['category_title'] ?></span>
									<h5 class="card-title  mt-3 mb-2"><?php echo $all_data['post_title'] ?></h5>
									<p class="card-text"><?php echo substr($all_data['post_description'],0,100) ?></p>
								</div>
								<div class="card-footer bg-transparent ">
									<img class="author_profile" src="images/users_profile/<?php echo $all_data['user_image'] ?>" alt="" width="50px">
									<span class="card_footer_text"><?php echo $all_data['first_name']." ".$all_data['last_name'] ?></span>
									<span class="card_footer_text"><?php echo $all_data['created_at'];  ?></span>
								</div>
							</a>
						</div>
						
					</div>
						<?php
					}

	
		
       			 } else{
       			 	Genral::record_not_found();
       			 }

       			?>
				
	
	</div>
</div>
<?php
require("footer.php");
?>