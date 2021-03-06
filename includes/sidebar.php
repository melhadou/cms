<div class="col-md-4">

  <!-- Blog Search Well -->

  <div class="well">
    <h4>Blog Search</h4>

    <form action="search.php" method="POST">
      <div class="input-group">
        <input type="text" name="search" class="form-control">
        <span class="input-group-btn">
          <button class="btn btn-default" type="submit" name="submit">
            <span class="glyphicon glyphicon-search"></span>
          </button>
        </span>
      </div>
    </form>
    <!-- /.input-group -->
  </div>

  <!-- Login Section -->

  <div class="well">

    <?php
if (isset($_SESSION['user_role'])) {
    echo " <h4>Loged In As " . $_SESSION['firstname'] . " " . $_SESSION['lastname'] . "</h4>";
    ?>
    <a href="includes/logout.php" class="btn btn-primary">Logout</a>

    <?php

} else {
    ?><h4>Login</h4>

    <form action="login.php" method="POST">

      <div class="input-group">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" class="form-control" placeholder="Enter Username">
      </div>
      <br>
      <label for="password">Password</label>
      <div class="input-group">
        <!--  -->

        <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password">
        <span class="input-group-btn">
          <button class="btn btn-primary" name="login" type="submit">Login</button>
        </span>

      </div>
      <div class="input-group">
        <br>
        <a href="forgot.php?forgot=<?php echo uniqid(true); ?>">Forgot Password</a>
      </div>

      <br>
      <?php

    if (!isset($_SESSION['user_role'])) {
        echo "<a  class='btn btn-primary' href='registration.php' role='button' >Sign Up</a>";
    }

    ?>



    </form>

    <?php

}
?>
  </div>

  <!-- end of login section -->



  <!-- Blog Categories Well -->
  <?php

$query = "SELECT * FROM categories";
$select_sidbar_cat_querys = mysqli_query($connection, $query);

?>
  <div class="well">
    <h4>Blog Categories</h4>
    <div class="row">
      <div class="col-lg-12">
        <ul class="list-unstyled">
          <?php

while ($row = mysqli_fetch_assoc($select_sidbar_cat_querys)) {
    $cat_title = mysqli_real_escape_string($connection, $row['cat_title']);
    $cat_id = mysqli_real_escape_string($connection, $row['cat_id']);

    echo "<li><a href='categories.php?c_id={$cat_id}'>{$cat_title}</a></li>";

}

?>
        </ul>
      </div>

    </div>
    <!-- /.row -->
  </div>

  <!-- Side Widget Well -->
  <?php include "widget.php";?>

</div>