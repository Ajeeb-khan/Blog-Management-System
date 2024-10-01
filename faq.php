
    <!-- Header -->
    <?php require_once("./templates_and_forms/templates_2.php"); 
	$template = new Template_2();
	$template->header();
	
	?>


    <div class="container-fluid mt-5 mb-5">
        <div class="container">

            <!-- FAQ Heading -->
            <div style="background-color:darkblue; color:yellow; width:600px; height: 100px;" class="mb-5 rounded-pill d-flex justify-content-center align-items-center mx-auto">
                <h1 class="text-center">Frequently Asked Questions</h1>
            </div>


            <!-- FAQ Section -->
            <div class="row faq-section">
                <!-- FAQ Image -->
                <div class="col-md-6">
                    <img src="./images/faq1.jpg" alt="FAQ Image" class="img-fluid rounded">
                </div>

                <!-- FAQ Content -->
                <div class="col-md-6">
                    <div class="accordion" id="faqAccordion">
                        <!-- FAQ Item 1 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse1" aria-expanded="true" aria-controls="faqCollapse1">
                                    What is this blog about?
                                </button>
                            </h2>
                            <div id="faqCollapse1" class="accordion-collapse collapse show" aria-labelledby="faq1" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    This blog is a platform where you can find content related to web development, programming tutorials, and tech insights.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 2 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse2" aria-expanded="false" aria-controls="faqCollapse2">
                                    How can I subscribe to the blog?
                                </button>
                            </h2>
                            <div id="faqCollapse2" class="accordion-collapse collapse" aria-labelledby="faq2" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    If you want to Subscribe Our Blog you Should be first Register Your Account after that you will be able to Subscribe our blog.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 3 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse3" aria-expanded="false" aria-controls="faqCollapse3">
                                    Can I contribute to the blog?
                                </button>
                            </h2>
                            <div id="faqCollapse3" class="accordion-collapse collapse" aria-labelledby="faq3" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes, we welcome guest posts! Please visit the 'Contribute' page to learn more about how you can submit your articles.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 4 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq4">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse4" aria-expanded="false" aria-controls="faqCollapse4">
                                    How can I contact you?
                                </button>
                            </h2>
                            <div id="faqCollapse4" class="accordion-collapse collapse" aria-labelledby="faq4" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    You can reach out to us via the contact form on our 'Contact Us' page, and we'll respond as soon as possible.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 5 -->
                        <!-- FAQ Item 5 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq5">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse5" aria-expanded="false" aria-controls="faqCollapse5">
                                    How can I give feedback?
                                </button>
                            </h2>
                            <div id="faqCollapse5" class="accordion-collapse collapse" aria-labelledby="faq5" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    In the Home page below have form you can give your first name, last name and email address and and write your thoughts about this website.
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer -->
    <?php $template->footer(); ?>

 