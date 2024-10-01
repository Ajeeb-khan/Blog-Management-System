
<?php require_once("./templates_and_forms/templates_2.php"); 
	$template = new Template_2();
	$template->header();
	
	?>


	<div class="container-fluid mt-2">


		<div class="container mt-5 mb-5">
			<div class="row">
				<!-- About Us Image -->
				<div class="col-sm-12">
					<img src="images/about (2).jpg" alt="About Us Image" class="img-fluid rounded">
				</div>
			</div>
		</div>

	<div class="container mt-5 mb-5">
    <div class="row">
      <!-- About Us Image -->
      <div class="col-sm-6">
        <img src="images/about.jpg" alt="About Us Image" class="img-fluid rounded">
      </div>

      <!-- About Us Content -->
      <div class="col-md-6 d-flex flex-column justify-content-center">
        <p>Welcome to our blog! We are passionate about sharing knowledge and insights in the world of web development, programming, and technology. Our mission is to provide quality content that can help developers, both beginners and experts, enhance their skills and stay updated with the latest trends in the tech world.</p>
        <p>Through our blog, we aim to create a community where learning is encouraged, discussions are welcomed, and everyone can grow together. Whether you're looking for tutorials, news, or just some inspiration, we hope to be your go-to resource.</p>
        <p>Thank you for being part of our journey!</p>

      </div>
    </div>
  </div>

		<!-- Team Section -->
		<div class="container mb-5">
		<div class="row">
			<div style="background-color:darkblue; color:yellow; width:600px; height: 100px;" class="mb-5 rounded-pill d-flex justify-content-center align-items-center mx-auto">
				<h1>Team Members</h1>
			</div>
		</div>
			<div class="row">
				<!-- Team Member 1 -->
				<div class="col-md-4 text-center">
					<img src="images/office (2).jfif" alt="Team Member 1" class="img-fluid rounded-circle mb-3">
					<h5>John Doe</h5>
					<p>Founder & CEO</p>
				</div>
				<!-- Team Member 2 -->
				<div class="col-md-4 text-center">
					<img src="images/off (2).jpg" alt="Team Member 2" class="img-fluid rounded-circle mb-3">
					<h5>Alexa Rodregis</h5>
					<p>Content Writer</p>
				</div>
				<!-- Team Member 3 -->
				<div class="col-md-4 text-center">
					<img src="images/office (2).jfif" alt="Team Member 3" class="img-fluid rounded-circle mb-3">
					<h5>Mark Wilson</h5>
					<p>Web Developer</p>
				</div>
			</div>
		</div>
	</div>


		<?php $template->footer(); ?>

