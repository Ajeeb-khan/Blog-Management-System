
<?php
 require_once("../templates_and_forms/templates.php");
 require_once("../templates_and_forms/admin_forms.php");
    $template = new Template();
    $template->navbar();
    $template->sidebar();
?>
<script src="../validations/admin_validations.js">
  
    
   
        function validationBlog() {
            var blogImageInput = document.getElementById('blog_background_image');
            var oldImageInput = document.getElementById('old_image');
            
            
            if (blogImageInput.files.length === 0) {
                blogImageInput.value = oldImageInput.value; 
            }
            return true; 
        }
    
</script>
<?php

$admin_form = new admin_forms();

    $admin_form->blog();


    $template->admin_footer();
    
?>
