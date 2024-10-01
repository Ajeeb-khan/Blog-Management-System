

<?php
require_once("./templates_and_forms/templates_2.php");
require_once("./templates_and_forms/forms.php");

$template = new Template_2();
$template->header();
?>
<script src="./validations/signup_js_process.js"></script>
<?php 
$login_form = new Forms();
$login_form->set_method("POST");



$login_form->set_action('signup_process.php');
$login_form->register();

$template->footer();
?>

