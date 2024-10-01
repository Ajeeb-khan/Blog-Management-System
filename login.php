<?php
require_once("./templates_and_forms/templates_2.php");
require_once("./templates_and_forms/forms.php");

$template = new Template_2();
$template->header();
?>



<?php 
$login_form = new Forms();
$login_form->set_method("POST");
$login_form->get_action("login_process.php");
?>
<script src="./validations/login_process.js"></script>
<?php
$login_form->login_form();

$template->footer();
?>

 
