<?php include "includes/db.php";?>
<?php include "includes/header.php";?>
<?php include "includes/nav.php";?>
<?php

?>
<?php

if (isset($_POST['send'])) {
    $subject = mysqli_real_escape_string($connection, $_POST['subject']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $message = mysqli_real_escape_string($connection, $_POST['message']);

    $msg = $message;

    // use wordwrap() if lines are longer than 70 characters
    $msg = wordwrap($msg, 70);

    // send email
    mail("test@email.com", $subject, $msg);
    if (!empty($subject) && !empty($meassage) && !empty($email)) {

        // the message

    }}

?>
<!-- Navigation -->




<!-- Page Content -->
<div class="container">

  <section id="login">
    <div class="container">
      <div class="row">
        <div class="col-xs-6 col-xs-offset-3">
          <div class="form-wrap">
            <h1>Contact Us</h1>


            <form role="form" action="" method="post" id="login-form" autocomplete="off">
              <div class="form-group">
                <label for="subject" class="sr-only">Subject</label>
                <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter Your Subject">
              </div>
              <div class="form-group">
                <label for="email" class="sr-only">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
              </div>
              <div class="form-group">
                <textarea name="message" id="message" class="form-control" rows="10"
                  placeholder="Your Message"></textarea>
              </div>
              <input type="submit" name="send" id="btn-login" class="btn btn-custom btn-lg btn-block"
                value="Send Message">
            </form>

          </div>
        </div> <!-- /.col-xs-12 -->
      </div> <!-- /.row -->
    </div> <!-- /.container -->
  </section>


  <hr>
  <?php

?>


  <?php include "includes/footer.php";?>