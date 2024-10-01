
<?php require_once("./templates_and_forms/templates_2.php"); 
	$template = new Template_2();
	$template->header();
	
	?>


	<div class="container-fluid mt-5 mb-5">
		<div class="container">

			<div class="row">
				<div class="col-sm-12">
					<center>
						<h3 style="background-color:darkblue; width:500px; padding:10px" class=" display-6 text-center mb-5 rounded-pill" id="recent"><span class="text-warning">Contact Page </span></h3>
					</center>
				</div>
			</div>

			<div class="row">
		<div class="col-sm-12 mb-3">
			<img src="images/contactadmission.webp" alt="" width="100%" height="300px">
		</div>
	</div>




			<div class="row">

				<div class="col-lg-8">
					<div class="text-center">

						<h1 class="text-uppercase fw-bold mt-4 mt-0 text-primary"> CONTACT US</h1>
						<hr class=" mt-0 m-auto " style="width: 255px; background-color: red; height: 5px; text-align: center;" />
					</div>
					<fieldset>
						<div class="mb-3">
							<label for="exampleFormControlInput1" class="form-label">Name</label>
							<input type="text" class="form-control" id="name" name="name" placeholder="Enter Your Name" required>
						</div>
						<div class="mb-3">
							<label for="exampleFormControlInput1" class="form-label">Email Address</label>
							<input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
						</div>
						<div class="mb-3">
							<label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
							<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
						</div>
						<div class="btn_box text-center">
							<button class="btn btn-primary">Send Us</button>
						</div>
					</fieldset>

				</div>


				<div class="col-lg-4">
					<div class="card mb-5">

						<img src="images/images (3).jfif" class="card-img-top" alt="Sample Image">

						<div class="card-body">
							<h5 class="card-title display-4 text-primary text-center">help center</h5>
							<p class="card-text text-primary">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
							<p class="card-text text-primary">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
							<p class="card-text text-primary">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
							<a href="#" class="btn btn-primary">Read More</a>
						</div>
						<div class="card-footer text-muted">
							<p class="card-text">Help Line Team: Manage user</p>
						</div>
					</div>

				</div>

			</div>

		</div>
	</div>


	<?php $template->footer(); ?>
