<?php
include "includes/admin_header.php";
if ($_SESSION['user_role'] == 'admin') {
    ?>
<?php

    if (isset($_SESSION['username'])) {

        $the_username = escape($_SESSION['username']);

        $query = "SELECT * FROM users WHERE username = '{$the_username}'";

        $select_user_query = mysqli_query($connection, $query);
        confirm($select_user_query);
        while ($row = mysqli_fetch_assoc($select_user_query)) {
            $user_id = escape($row['user_id']);
            $username = escape($row['username']);
            $user_firstname = escape($row['user_firstname']);
            $user_password = escape($row['user_password']);
            $user_lastname = escape($row['user_lastname']);
            $user_email = escape($row['user_email']);
            $user_image = escape($row['user_image']);
        }
    }

    ?>
<?php
// edit the data , & send it back to db

    if (isset($_POST['edit_profile'])) {

        $username = escape($_POST['username']);
        $user_password = escape($_POST['user_password']);
        $user_firstname = escape($_POST['user_firstname']);
        $user_lastname = escape($_POST['user_lastname']);
        $user_email = escape($_POST['user_email']);
        $user_image = escape($_FILES['user_image']['name']);
        $user_image_temp = escape($_FILES['user_image']['tmp_name']);

        //uploid image to user images folder
        move_uploaded_file($user_image_temp, "../users_images/$user_image");

        //check if there is no image
        if (empty($user_image)) {

            $query = "SELECT * FROM users WHERE username = '{$the_username}'";
            $select_img = mysqli_query($connection, $query);
            if (!$select_img) {
                die("QUERY FAILED" . mysqli_error($connection));
            }
            while ($row = mysqli_fetch_assoc($select_img)) {
                $user_image = escape($row['user_image']);
            }

        }
        //check if there is no password
        if (empty($user_password)) {

            $query = "SELECT * FROM users WHERE username = '{$the_username}'";
            $select_user_password = mysqli_query($connection, $query);
            if (!$select_user_password) {
                die("QUERY FAILED" . mysqli_error($connection));
            }
            while ($row = mysqli_fetch_assoc($select_user_password)) {
                $user_password = escape($row['user_password']);
            }

        } else {
            // encrypting password befor sending it to db
            $user_password = password_hash($user_password, PASSWORD_BCRYPT, array("cost" => 12));
        }

        $query = "UPDATE users SET";
        $query .= " username = '{$username}' ";
        $query .= ", user_password = '{$user_password}' ";
        $query .= ", user_firstname = '{$user_firstname}' ";
        $query .= ", user_lastname = '{$user_lastname}' ";
        $query .= ", user_email = '{$user_email}' ";
        $query .= ", user_image =  '{$user_image}' ";
        $query .= "WHERE username = '{$the_username}' ";

        $edit_profile_query = mysqli_query($connection, $query);
        confirm($edit_profile_query);

    }

    ?>

<div id="wrapper">

  <!-- Navigation -->
  <?php include "includes/admin_nav.php";?>

  <div id="page-wrapper">

    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">
            Welcome
            <small><?php

    if (empty($_SESSION['username'])) {
        echo "Author";
    } else {
        echo $_SESSION['username'];
    }

    ?></small>
          </h1>

          <form action="" method="POST" enctype="multipart/form-data">

            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" class="form-control" name="username" id="username" value="<?php echo $username; ?>">
            </div>
            <div class="form-group">
              <label for="user_password">Password</label>
              <input type="password" name="user_password" id="user_password" class="form-control">

            </div>
            <div class="form-group">
              <label for="user_firstname">First Name</label>
              <input type="text" class="form-control" name="user_firstname" id="user_firstname"
                value="<?php echo $user_firstname; ?>">
            </div>
            <div class="form-group">
              <label for="user_lastname">Last Name</label>
              <input type="text" class="form-control" name="user_lastname" id="user_lastname"
                value="<?php echo $user_lastname; ?>">
            </div>

            <div class="form-group">
              <label for="user_email">Email</label>
              <input type="email" class="form-control" name="user_email" id="user_email"
                value="<?php echo $user_email; ?>">
            </div>
            <div class="form-group">
              <label>Old User Image</label>

              <img src="../users_images/<?php echo $user_image; ?>" class="img-responsive" width="50"
                alt="<?php echo $user_image; ?>">
              <br>
              <label for="image">New User Image</label>
              <input type="file" class="form-control" name="user_image" id="image">
            </div>


            <div class="form-group">

              <input type="submit" class="btn btn-primary" name="edit_profile" value="Update Profile">
            </div>

          </form>


        </div>
      </div>
      <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->

  <?php include "includes/admin_footer.php";}?>