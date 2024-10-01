    function validateForm() {
      var flag = true;

      // Validation for first name
      var first_name = document.querySelector("#first_name").value;
      var first_name_msg = document.querySelector("#first_name_msg");

      if (first_name == "") {
        flag = false;
        first_name_msg.innerHTML = "First name is required.";
      } else if (!/^[A-Za-z]{3,}$/.test(first_name)) {
        flag = false;
        first_name_msg.innerHTML = "First name must be at least 3 characters and contain only letters.";
      } else {
        first_name_msg.innerHTML = "";
      }

      // Validation for last name
      var last_name = document.querySelector("#last_name").value;
      var last_name_msg = document.querySelector("#last_name_msg");

      if (last_name == "") {
        flag = false;
        last_name_msg.innerHTML = "Last name is required.";
      } else if (!/^[A-Za-z]{3,}$/.test(last_name)) {
        flag = false;
        last_name_msg.innerHTML = "Last name must be at least 3 characters and contain only letters.";
      } else {
        last_name_msg.innerHTML = "";
      }

    
      var email = document.querySelector("#email").value;
      var email_msg = document.querySelector("#email_msg");

      if (email == "") {
        flag = false;
        email_msg.innerHTML = "Email is required.";
      } else if (!/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/.test(email)) {
        flag = false;
        email_msg.innerHTML = "Invalid email address.";
      } else {
        email_msg.innerHTML = "";
      }

      // Validation for password
      var password = document.querySelector("#password").value;
      var password_msg = document.querySelector("#password_msg");

      if (password == "") {
        flag = false;
        password_msg.innerHTML = "Password is required.";
      } else if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/.test(password)) {
        flag = false;
        password_msg.innerHTML = "Password Must be Ahmed123 | Ali12345 | Shahid12";
      } else {
        password_msg.innerHTML = "";
      }

      // Validation for gender
      var gender = document.querySelector("input[name='gender']:checked");
      var gender_msg = document.querySelector("#gender_msg");

      if (!gender) {
        flag = false;
        gender_msg.innerHTML = "Gender is required.";
      } else {
        gender_msg.innerHTML = "";
      }

      // Validation for date of birth
      var dob = document.querySelector("#dob").value;
      var dob_msg = document.querySelector("#dob_msg");

      if (dob == "") {
        flag = false;
        dob_msg.innerHTML = "Date of Birth is required.";
      } else {
        dob_msg.innerHTML = "";
        var today = new Date();
        var birthDate = new Date(dob);
        var age = today.getFullYear() - birthDate.getFullYear();
        var m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
          age--;
        }
        if (age < 15) {
          flag = false;
          dob_msg.innerHTML = "You must be at least 15 years old to sign up.";
        }
      }

      // Validation for address
      var address = document.querySelector("#address").value;
      var address_msg = document.querySelector("#address_msg");

      if (address == "") {
        flag = false;
        address_msg.innerHTML = "Address is required.";
      } else {
        address_msg.innerHTML = "";
      }

      // Validation for image
      var image = document.querySelector("#image").files[0];
      var image_msg = document.querySelector("#image_msg");

      if (!image) {
        flag = false;
        image_msg.innerHTML = "Image is required.";
      } else {
        image_msg.innerHTML = "";
        if (image.size > 2000000) {
          flag = false;
          image_msg.innerHTML = "Image size must be less than 2MB.";
        }
        var allowed_extensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        if (!allowed_extensions.test(image.name)) {
          flag = false;
          image_msg.innerHTML = "Invalid file type. Only .jpg, .jpeg, .png, and .gif are allowed.";
        }
      }

      return flag;
    }
  