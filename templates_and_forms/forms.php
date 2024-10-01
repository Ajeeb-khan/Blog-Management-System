<?php


class Forms
{
  public $action = NULL;
  public $method = NULL;

  public function set_action($action)
  {
    $this->action = $action;
  }

  public function set_method($method)
  {
    $this->method = $method;
  }

  public function get_action()
  {
    return $this->action;
  }

  public function get_method()
  {
    return $this->method;
  }

  public function login_form()
  {
?>
    <div class="container">


      <div style="max-width: 500px; margin: 0 auto; margin-top: 100px; padding: 20px; background-color: #fff; border-radius: 10px; box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2)" class="login-container mb-3">

        <p class="text-center mt-3" style="color:<?php echo isset($_REQUEST['success']) ? "green" : "red"; ?>"><?php echo $_REQUEST['message'] ?? ''; ?></p>
        <?php
        if (isset($_REQUEST['pdf'])) {
        ?>
          <a href="pdf.php?user_name=<?php echo $_REQUEST['user_name'] ?? '' ?>" class="btn btn-info justify-content-center text-light m-auto">Downlaod Pdf</a>

        <?php
        }


        ?>
        <h1 class="text-center text-primary display-1">Login</h1>
        <form action="login_process.php" method="POST" onsubmit="return validateLoginForm()">

          <div class="form-group mt-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email">
            <div id="email_error" class="text-danger"></div>
          </div>

          <div class="form-group ">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password">
            <div id="password_error" class="text-danger"></div>
          </div>

          <div class="text-center">
            <button type="submit" name="submit" class="btn btn-primary mt-3 w-25">Login</button>
            <p>Signup Here <a href="signup.php" class="mt-3">Signup</a></p>
          </div>

          <div class="text-center">
            <p>Forgot your password? <a href="#" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal" class="mt-3">Reset it</a></p>
          </div>

        </form>
      </div>
    </div>

  <?php
  }
  public function register()
  {

  ?>
    <div class="container">
      <div style="max-width: 500px; margin: 0 auto; margin-top: 100px; padding: 20px; background-color: #fff; border-radius: 10px; box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2)" class="register-container mb-3">
        <h1 class="text-center text-primary display-1">Signup</h1>

        <form action="signup_process.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
          <div class="form-group mt-3">
            <label for="first_name">First name</label>
            <input type="text" class="form-control" id="first_name" name="first_name">
            <span id="first_name_msg" class="text-danger"><?= $_REQUEST['first_name_message'] ?? ""; ?></span>
          </div>

          <div class="form-group">
            <label for="last_name">Last name</label>
            <input type="text" class="form-control" id="last_name" name="last_name">
            <span id="last_name_msg" class="text-danger"><?= $_REQUEST['last_name_msg'] ?? ""; ?></span>
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email">
            <span id="email_msg" class="text-danger"><?= $_REQUEST['email_msg'] ?? ""; ?></span>
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password">
            <span id="password_msg" class="text-danger"><?= $_REQUEST['password_msg'] ?? ""; ?></span>
          </div>

          <div class="form-group">
            <legend class="mb-1">Gender *</legend>
            <input type="radio" id="male" name="gender" value="male"> <label for="male">Male</label>
            <input type="radio" id="female" name="gender" value="female"> <label for="female">Female</label>
            <span id="gender_msg" class="text-danger"><?= $_REQUEST['gender_msg'] ?? ""; ?></span>
          </div>

          <div class="form-group mt-3">
            <label for="dob">Date of Birth</label>
            <input type="date" class="form-control" id="dob" name="date_of_birth">
            <span id="dob_msg" class="text-danger"></span>
          </div>

          <div class="form-group">
            <label for="address">Address</label>
            <textarea class="form-control" id="address" name="address" rows="3"></textarea>
            <span id="address_msg" class="text-danger"></span>
          </div>

          <div class="form-group ">
            <label for="image">Upload</label>
            <input type="file" class="form-control" name="image" id="image">
            <span id="image_msg" class="text-danger"><?= $_REQUEST['image_msg'] ?? ""; ?></span>
          </div>

          <div class="text-center">
            <button type="submit" class="btn btn-primary mt-3 w-100" name="signup">Signup</button>
          </div>

          <div class="text-center">
            <p>Login Here <a href="login.php" class="mt-3">Login</a></p>
          </div>
        </form>
      </div>
    </div>
  <?php
  }

  public function feedback()
  {
  ?>

    <div class="container">
      <div class="row">
        <div class="col-sm-3"></div>
        <div style="max-width: 500px; margin: 0 auto; margin-top: 100px; padding: 20px; background-color: #fff; border-radius: 10px; box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2)" class="col-sm-6 border rounded p-5">
          <h3 class="text-center text-primary display-3">Feedback</h3>
          <div class="feedback_form">
            <p class="text-center text-success"><?php echo $_REQUEST['message'] ?? '' ?></p>
            <!-- feedback form -->
            <?php

            if (isset($_SESSION['user'])) {
            ?>
              <form action="insertion_process.php?user_feedback_id=<?php echo $_SESSION['user'] ?? '' ?>" method="post" enctype="multipart/form-data" onsubmit="return validationFeedback()">
                <div class="mb-3">
                  <label for="exampleFormControlTextarea1" class="form-label">Message</label>
                  <textarea class="form-control" name="feedback_text" id="feedback_text" rows="3" required></textarea>
                  <span id="feedback_text_msg" class="text-danger"></span>
                </div>
                <div class="text-center">
                  <button class="btn btn-primary" name="feedback_btn">Send Feedback</button>
                </div>
              </form>
            <?php
            } else {
            ?>
              <form action="insertion_process.php?user_id=<?php echo $_SESSION['user'] ?? '' ?>" method="post">
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Name</label>
                  <input type="text" class="form-control" id="name" name="name" required>
                  <span id="name_msg" class="text-danger"></span>
                </div>
                <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" name="email" required>
                  <span id="email_msg" class="text-danger"></span>
                </div>
                <div class="mb-3">
                  <label for="exampleFormControlTextarea1" class="form-label">Message</label>
                  <textarea class="form-control" id="feedback_text" name="feedback_text" rows="3" required></textarea>
                  <span id="feedback_text_msg" class="text-danger"></span>
                </div>
                <div class="text-center">
                  <button class="btn btn-primary" name="feedback_btn">Send Feedback</button>
                </div>
              </form>
            <?php
            }

            ?>

            <!-- feedback form -->
          </div>
        </div>
        <div class="col-sm-3"></div>
      </div>
    </div>
    <!-- Feedback portion -->


<?php
  }
}
?>