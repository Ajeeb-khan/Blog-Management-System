<?php
require_once("../templates_and_forms/templates.php");
require_once("../templates_and_forms/admin_forms.php");

$template = new Template();
$template->navbar();
$template->sidebar();

$admin_form = new admin_forms();
    

    $admin_form->change();


$template->admin_footer();
?>
