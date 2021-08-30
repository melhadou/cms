<?php include "includes/db.php";?>
<?php include "includes/header.php";?>
<?php include "includes/nav.php";?>
<?php
if (!isset($_SESSION['username'])) {

    ?>
<?php

    if (isset($_POST['submit'])) {
        $username = trim($_POST['username']);
        $user_email = trim($_POST['email']);
        $user_password = trim($_POST['password']);
        $user_firstname = trim($_POST['user_firstname']);
        $user_lastname = trim($_POST['user_lastname']);

        if (!empty($username) && !empty($user_password) && !empty($user_firstname) && !empty($user_lastname)) {
            if (strlen($username) < 4) {
                echo error_type('username must be longer then 4 charcters');
            }if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
                echo error_type('Enter A valid email');
            }if (checkPassword($user_password)) {
                echo checkPassword($user_password);
            } else {
                signup($username, $user_password, $user_firstname, $user_lastname, $user_email);
                login_user($username, $user_password);
            }

        } else {
            echo error_type('This Fields Should not be emthy');
        }
    }
    ?>
<!-- Navigation -->




<!-- Page Content -->
<div class="container">

  <section id="login">
    <div class="container">
      <div class="row">
        <div class="col-xs-6 col-xs-offset-3">
          <div class="form-wrap">
            <h1>Register</h1>
            <p id="error" class="text-center" style="color:red">
            <p class="text-center" style="color:green">
              <?php echo $meassage; ?>
            </p>
            <script>
            notempthy()
            </script>
            <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
              <div class="form-group">

                <input type="text" name="username" id="username" class="form-control"
                  placeholder="Enter Desired Username" autocomplete="on"
                  value="<?php echo isset($username) ? $username : ''; ?>">
              </div>
              <script>
              clearFeilds()
              </script>
              <div class="form-group">
                <input type="text" class="form-control" name="user_firstname" placeholder="Enter Your First Name"
                  autocomplete="on" value="<?php echo isset($user_firstname) ? $user_firstname : ''; ?>">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="user_lastname" placeholder="Enter Your Last Name"
                  autocomplete="on" value="<?php echo isset($user_lastname) ? $user_lastname : ''; ?>">
              </div>
              <div class="form-group">
                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com"
                  autocomplete="on" value="<?php echo isset($user_email) ? $user_email : ''; ?>">
              </div>
              <div class="form-group">
                <input type="password" name="password" id="key" class="form-control" placeholder="Password">
              </div>

              <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block"
                value="Register">
            </form>

          </div>
        </div> <!-- /.col-xs-12 -->
      </div> <!-- /.row -->
    </div> <!-- /.container -->
  </section>


  <hr>
  <?php
} else {
    header("Location: index.php");
}
include "includes/footer.php";?>