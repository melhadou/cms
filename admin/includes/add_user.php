<?php
if ($_SESSION['user_role'] == 'admin') {

    ?>
<?php

    if (isset($_POST['creat_user'])) {

        $username = $_POST['username'];
        $user_password = $_POST['user_password'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];
        $user_role = $_POST['user_role'];
        $user_image = $_FILES['user_image']['name'];
        $user_image_temp = $_FILES['user_image']['tmp_name'];

        // encrypting password befor sending it to db
        $user_password = password_hash($user_password, PASSWORD_BCRYPT, array("cost" => 12));

        //uploid image to images folder
        move_uploaded_file($user_image_temp, "../users_images/$user_image");

        $query = "INSERT INTO users(username,user_password,user_firstname,user_lastname,user_email,user_role,user_image) ";
        $query .= "VALUES('{$username}' , '{$user_password}' , '{$user_firstname}' , '{$user_lastname}' , '{$user_email}' , '{$user_role}' ,'{$user_image}') ";

        $creat_user_query = mysqli_query($connection, $query);
        confirm($creat_user_query);
        echo "User Created: " . " " . "<a href='users.php'>{$username}</a>";

    }

    ?>








<form action="" method="POST" enctype="multipart/form-data">

  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" name="username" id="username">
  </div>
  <div class="form-group">
    <label for="user_password">Password</label>
    <input type="password" name="user_password" id="user_password" class="form-control">

  </div>

  <div class="form-group">

    <label for="user_firstname">First Name</label>
    <input type="text" class="form-control" name="user_firstname" id="user_firstname">
  </div>
  <div class="form-group">


    <label for="user_lastname">Last Name</label>
    <input type="text" class="form-control" name="user_lastname" id="user_lastname">
  </div>

  <div class="form-group">

    <label for="user_email">Email</label>
    <input type="email" class="form-control" name="user_email" id="user_email">
  </div>
  <div class="form-group">
    <label for="user_role">Role</label>
    <select name="user_role" id="user_role" class="form-control">
      <option selected hidden style="display:none">Select One</option>
      <option value="admin">Admin</option>
      <option value="subscriber">Subscriber</option>
    </select>
  </div>
  <div class="form-group">
    <label for="image">User Image</label>
    <input type="file" class="form-control" name="user_image" id="image">
  </div>


  <div class="form-group">

    <input type="submit" class="btn btn-primary" name="creat_user" value="Creat User">
  </div>

</form>
<?php
} else {
    echo "You cant See This Page";
}
?>