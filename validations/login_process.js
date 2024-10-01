function validateLoginForm() {
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
  
    var email_error = document.getElementById("email_error");
    var password_error = document.getElementById("password_error");
  
    
    if (email == "") {
      email_error.innerHTML = "Email is required";
      
      if (password == "") {
        password_error.innerHTML = "Password is required";
      }
      return false;
    }
    var email_regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!email_regex.test(email)) {
      email_error.innerHTML = "please enter valid email like ajeeb@gmail.com !.";
      return false;
    }
    email_error.innerHTML = "";
  
    
    if (password.length < 6) {
      password_error.innerHTML = "Password must be at least 6 characters long";
      return false;
    }
    password_error.innerHTML = "";
  
    // If all validations pass, return true to submit the form
    return true;
  }
  

  