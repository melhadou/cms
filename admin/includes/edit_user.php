<?php
if ($_SESSION['user_role'] == 'admin') {

    ?>
<?php
//pull data from db , => show it on , so we can edit it

    if (isset($_GET['edit_user'])) {

        $u_id = $_GET['edit_user'];

        $query = "SELECT * FROM users WHERE user_id = {$u_id}";
        $edit_user_query = mysqli_query($connection, $query);
        confirm($edit_user_query);
        while ($row = mysqli_fetch_assoc($edit_user_query)) {
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];
            $user_image = $row['user_image'];

        }
        ?>
<?php
// edit the data , & send it back to db

        if (isset($_POST['edit_user'])) {

            $username = $_POST['username'];
            $user_password = $_POST['user_password'];
            $user_firstname = $_POST['user_firstname'];
            $user_lastname = $_POST['user_lastname'];
            $user_email = $_POST['user_email'];
            $user_role = $_POST['user_role'];
            $user_image = $_FILES['user_image']['name'];
            $user_image_temp = $_FILES['user_image']['tmp_name'];

            //check if there is no password
            if (empty($user_password)) {

                $query = "SELECT * FROM users WHERE username = '{$the_username}'";
                $select_user_password = mysqli_query($connection, $query);
                if (!$select_user_password) {
                    die("QUERY FAILED" . mysqli_error($connection));
                }
                while ($row = mysqli_fetch_assoc($select_user_password)) {
                    $user_password = $row['user_password'];
                }

            } else {
                // encrypting password befor sending it to db
                $user_password = password_hash($user_password, PASSWORD_BCRYPT, array("cost" => 12));
            }

            //uploid image to user images folder
            move_uploaded_file($user_image_temp, "../users_images/$user_image");

            //check if there is no image
            if (empty($user_image)) {

                $query = "SELECT * FROM users WHERE user_id = {$u_id}";
                $select_img = mysqli_query($connection, $query);

                confirm($select_img);
                while ($row = mysqli_fetch_assoc($select_img)) {
                    $user_image = $row['user_image'];
                }

            }
            // if (!empty($user_password)) {
            //     $query_password = "SELECT user_password FROM users WHERE user_id = $user_id";
            //     $send_password_query = mysqli_query($connection, $query_password);
            //     $row = mysqli_fetch_assoc($send_password_query);
            //     $db_user_password = $row['user_password'];
            // }

            $query = "UPDATE users SET";
            $query .= " username = '{$username}' ";
            $query .= ", user_password = '{$hashed_password}' ";
            $query .= ", user_firstname = '{$user_firstname}' ";
            $query .= ", user_lastname = '{$user_lastname}' ";
            $query .= ", user_email = '{$user_email}' ";
            $query .= ", user_role = '{$user_role}' ";
            $query .= ", user_image =  '{$user_image}'";
            $query .= " WHERE user_id = {$u_id}";

            $edit_user_query = mysqli_query($connection, $query);
            confirm($edit_user_query);
            echo "User Updated: Check" . " " . "<a href='users.php'>{$username}</a>";

        }
    } else {
        header("Location: index.php");
    }
    ?>







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
    <input type="email" class="form-control" name="user_email" id="user_email" value="<?php echo $user_email; ?>">
  </div>
  <div class="form-group">
    <label for="user_role">Role</label>
    <select name="user_role" id="user_role" class="form-control">
      <option value='<?php echo $user_role; ?>'><?php echo $user_role; ?></option>
      <?php
if ($user_role == 'admin') {
        echo "<option value='subscriber'>Subscriber</option>";

    } else {
        echo "<option value='admin'>admin</option>";
    }

    ?>
    </select>
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

    <input type="submit" class="btn btn-primary" name="edit_user" value="Update User">
  </div>

</form>
<?php
} else {
    echo "You cant See This Page";
}
?>