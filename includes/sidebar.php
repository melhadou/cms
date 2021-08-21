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
  <?php
if (!isset($_SESSION['username'])) {

    ?>
  <div class="well">
    <h4>Login</h4>

    <form action="includes/login.php" method="POST">

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
      <br>
      <?php

    if (!isset($_SESSION['user_role'])) {
        echo "<a  class='btn btn-primary' href='registration.php' role='button' >Sign Up</a>";
    }

    ?>



    </form>

  </div>
  <?php
}

?>
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
    $cat_title = $row['cat_title'];
    $cat_id = $row['cat_id'];

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