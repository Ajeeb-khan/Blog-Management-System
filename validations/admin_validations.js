// Category Validation Start
function validationCategory() {
  var flag = true;

  var category_title = document.querySelector("#category_title").value;
  var category_title_msg = document.querySelector("#category_title_msg");

  if (category_title == "") {
    flag = false;
    category_title_msg.innerHTML = "Category title is required.";
  } else {
    category_title_msg.innerHTML = "";
  }

  var category_description = document.querySelector(
    "#category_description"
  ).value;
  var category_description_msg = document.querySelector(
    "#category_description_msg"
  );

  if (category_description == "") {
    flag = false;
    category_description_msg.innerHTML = "Category Description is required.";
  } else {
    category_description_msg.innerHTML = "";
  }

  return flag;
}

// Category Validation end

// blog validation
function validationBlog() {
  var flag = true;

  var blog_title = document.querySelector("#blog_title").value;
  var blog_title_msg = document.querySelector("#blog_title_msg");

  if (blog_title == "") {
    flag = false;
    blog_title_msg.innerHTML = "Blog title  is required.";
  } else {
    blog_title_msg.innerHTML = "";
  }

  var post_per_page = document.querySelector("#post_per_page").value;
  var post_per_page_msg = document.querySelector("#post_per_page_msg");

  if (post_per_page == "") {
    flag = false;
    post_per_page_msg.innerHTML = "post per page  is required.";
  } else {
    post_per_page_msg.innerHTML = "";
  }

  var blog_background_image = document.querySelector(
    "#blog_background_image"
  ).value;
  var blog_background_image_msg = document.querySelector(
    "#blog_background_image_msg"
  );

  if (blog_background_image == "") {
    flag = false;
    blog_background_image_msg.innerHTML = "background image  is required.";
  } else {
    blog_background_image_msg.innerHTML = "";
  }


  return flag;
}

// blog validation end

function validationBlog() {
    var blogImageInput = document.getElementById('blog_background_image');
    var oldImageInput = document.getElementById('old_image');

    
    if (blogImageInput.files.length === 0) {
        blogImageInput.value = oldImageInput.value; 
    }
    return true; 
}



function validationPost() {
  var flag = true;

  var post_title = document.querySelector("#post_title").value;
  var post_title_msg = document.querySelector("#post_title_msg");

  if (post_title == "") {
    flag = false;
    post_title_msg.innerHTML = "Post title  is required.";
  } else {
    post_title_msg.innerHTML = "";
  }

  var post_title = document.querySelector("#post_title").value;
  var post_title_msg = document.querySelector("#post_title_msg");

  if (post_title == "") {
    flag = false;
    post_title_msg.innerHTML = "Post title  is required.";
  } else {
    post_title_msg.innerHTML = "";
  }

  var post_summary = document.querySelector("#post_summary").value;
  var post_summary_msg = document.querySelector("#post_summary_msg");

  if (post_summary == "") {
    flag = false;
    post_summary_msg.innerHTML = "Post Summary   is required.";
  } else {
    post_summary_msg.innerHTML = "";
  }

  var post_description = document.querySelector("#post_description").value;
  var post_description_msg = document.querySelector("#post_description_msg");

  if (post_description == "") {
    flag = false;
    post_description_msg.innerHTML = "Post Description  is required.";
  } else {
    post_description_msg.innerHTML = "";
  }

  var featured_image = document.querySelector("#featured_image").value;
  var featured_image_msg = document.querySelector("#featured_image_msg");

  if (featured_image == "") {
    flag = false;
    featured_image_msg.innerHTML = "Post Feature image  is required.";
  } else {
    featured_image_msg.innerHTML = "";
  }

  var post_attachment_title = document.querySelector(
    "#post_attachment_title"
  ).value;
  var post_attachment_title_msg = document.querySelector(
    "#post_attachment_title_msg"
  );

  if (post_attachment_title == "") {
    flag = false;
    post_attachment_title_msg.innerHTML = "Post attachment title is required.";
  } else {
    post_attachment_title_msg.innerHTML = "";
  }

  var post_attachment_path = document.querySelector(
    "#post_attachment_path"
  ).value;
  var post_attachment_path_msg = document.querySelector(
    "#post_attachment_path_msg"
  );

  if (post_attachment_path == "") {
    flag = false;
    post_attachment_path_msg.innerHTML = "Post attachment is required.";
  } else {
    post_attachment_path_msg.innerHTML = "";
  }

  return flag;
}




function validationFeedback() {
  var flag = true;

  var name = document.querySelector("#name").value;
  var name_msg = document.querySelector("#name_msg");

  if (name == "") {
    flag = false;
    name_msg.innerHTML = "Name is required.";
  } else {
    name_msg.innerHTML = "";
  }

  //  var email = document.querySelector("#email").value;
  //  var email_msg = document.querySelector("#email_msg");

  //     if (email == ""){
  //       flag = false;
  //       email_msg.innerHTML = "Email is required.";
  //     }
  //     else {
  //       email_msg.innerHTML = "";
  //     }

  //     var feedback_text = document.querySelector("#feedback_text").value;
  //     var feedback_text_msg = document.querySelector("#feedback_text_msg");

  //     if (feedback_text == ""){
  //       flag = false;
  //       feedback_text_msg.innerHTML = "Feedback text is required.";
  //     }
  //     else {
  //       feedback_text_msg.innerHTML = "";
  //     }

  return flag;
}
