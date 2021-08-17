<?php
include "includes/admin_header.php";
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
                                <option value='$user_role'><?php echo $user_role; ?></option>
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


                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php";?>