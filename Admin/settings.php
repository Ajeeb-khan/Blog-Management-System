
<?php
require_once("../templates_and_forms/templates.php"); 
require_once("../templates_and_forms/admin_forms.php");
	$template = new Template();
	$template->navbar();
    $template->sidebar();


?>
<!-- <script src="../validations/admin_validations.js"></script> -->
<?php

    $admin_form = new admin_forms();
    $admin_form->set_method("POST");
    $admin_form->get_action("user_process.php");

    $admin_form->setting();


   $template->admin_footer();
	
	?>

