<?php include "includes/db.php";?>
<?php include "includes/header.php";?>
<?php include "includes/nav.php";?>
<?php
if (!isset($_SESSION['username'])) {

    ?>
<?php
// salt = N9NHuW5V2XsbUA8kYPFwPx

    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $user_email = $_POST['email'];
        $user_password = $_POST['password'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        if (!empty($username) && !empty($user_password) && !empty($user_firstname) && !empty($user_lastname)) {

//Escapes special characters in a string for use in an SQL statement

            $username = mysqli_real_escape_string($connection, $_POST['username']);
            $user_email = mysqli_real_escape_string($connection, $_POST['email']);
            $user_password = mysqli_real_escape_string($connection, $_POST['password']);
            $user_firstname = mysqli_real_escape_string($connection, $_POST['user_firstname']);
            $user_lastname = mysqli_real_escape_string($connection, $_POST['user_lastname']);

            $user_password = password_hash($user_password, PASSWORD_BCRYPT, array("cost" => 12));

//get randsalt from db;

            // $query = "SELECT randSalt FROM users";
            // $select_randsalt_query = mysqli_query($connection, $query);
            // if (!$select_randsalt_query) {
            //     die("QUERY FAILD" . mysqli_error($connection));
            // }

            // $row = mysqli_fetch_array($select_randsalt_query);
            // $salt = $row['randSalt'];

            // // encrypting password befor sending it to db
            // $user_password = crypt($user_password, $salt);

            $query = "INSERT INTO users (username,user_password,user_email,user_role,user_firstname,user_lastname,user_image) ";
            $query .= "VALUES('{$username}' , '{$user_password}' , '{$user_email}' ,'subscriber', '{$user_firstname}', '{$user_lastname}', 'user_default_image.png') ";

            $register_user_query = mysqli_query($connection, $query);
            if (!$register_user_query) {
                die("QUERY FAILD" . mysqli_error($connection));
            }
            $meassage = "you successfully registered wait for admin approval";
        } else {

            echo "<script>
    function notempthy() {
                  const pp = document.querySelector('#error');
                  pp.innerText = 'This Fields Should not be emthy';}
                  function clearFeilds(){
                const username =  document.querySelector('#username');
                const pp = document.querySelector('#error');
                 username.addEventListener('keydown',()=>{
                    pp.innerText = '';
                  })}

        </script>";
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
                <label for="username" class="sr-only">username</label>
                <input type="text" name="username" id="username" class="form-control"
                  placeholder="Enter Desired Username">
              </div>
              <script>
              clearFeilds()
              </script>
              <div class="form-group">
                <input type="text" class="form-control" name="user_firstname" placeholder="Enter Your First Name">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="user_lastname" placeholder="Enter Your Last Name">
              </div>
              <div class="form-group">
                <label for="email" class="sr-only">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
              </div>
              <div class="form-group">
                <label for="password" class="sr-only">Password</label>
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
    echo "<h1 class='text-center' > You Need To Log Out First</h1>";
}
?>


  <?php include "includes/footer.php";?>