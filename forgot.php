<?php include "includes/db.php";?>
<?php include "includes/header.php";?>
<?php include "includes/nav.php";?>
<?php

if (ifItIsMethod('get') && !$_GET['forgot']) {
    redirect('index.php');
}
if (isset($_POST['recover-submit'])) {

    $email = $_POST['email'];
    $length = 50;
    $token = bin2hex(openssl_random_pseudo_bytes($length));

    if (isEmailExist($email)) {

        $query = "UPDATE users SET token = ? WHERE user_email = ?";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, 'ss', $token, $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo error_type('Enter A valid email');
    } else {
        echo error_type('Email Not Found');
    }

}
?>


<!-- Page Content -->
<div class="container">

  <div class="form-gap"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
          <div class="panel-body">
            <div class="text-center">

              <h3><i class="fa fa-lock fa-4x"></i></h3>
              <h2 class="text-center">Forgot Password?</h2>
              <p>You can reset your password here.</p>
              <div class="panel-body">



                <p id="error" class="text-center" style="color:red"></p>
                <script>
                notempthy()
                </script>

                <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                      <input id="email" name="email" placeholder="email address" class="form-control" type="email">
                    </div>
                  </div>
                  <div class="form-group">
                    <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password"
                      type="submit">
                  </div>

                  <input type="hidden" class="hide" name="token" id="token" value="">
                </form>

              </div><!-- Body-->

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <hr>

  <?php include "includes/footer.php";?>

</div> <!-- /.container -->
</div> <!-- /.container -->