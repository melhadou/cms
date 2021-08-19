<?php
include "includes/admin_header.php";
?>
<?php

if (isset($_SESSION['username'])) {

    $the_username = $_SESSION['username'];

    $query = "SELECT * FROM users WHERE username = '{$the_username}'";

    $select_user_query = mysqli_query($connection, $query);
    confirm($select_user_query);
    while ($row = mysqli_fetch_assoc($select_user_query)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];
        $user_image = $row['user_image'];}
}

?>
<?php
// edit the data , & send it back to db

if (isset($_POST['edit_profile'])) {

    $username = $_POST['username'];
    $user_password = $_POST['user_password'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    $user_role = $_POST['user_role'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];

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
            $user_image = $row['user_image'];
        }

    }

    $query = "UPDATE users SET";
    $query .= " username = '{$username}' ";
    $query .= ", user_password = '{$user_password}' ";
    $query .= ", user_firstname = '{$user_firstname}' ";
    $query .= ", user_lastname = '{$user_lastname}' ";
    $query .= ", user_email = '{$user_email}' ";
    $query .= ", user_role = '{$user_role}' ";
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
                            <input type="text" class="form-control" name="username" id="username"
                                value="<?php echo $username; ?>">
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

    <?php include "includes/admin_footer.php";?>