<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Mohamed CMS</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">

        <?php

$query = "SELECT * FROM categories";
$select_all_cat_querys = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_all_cat_querys)) {
    $cat_title = mysqli_real_escape_string($connection, $row['cat_title']);
    $cat_id = mysqli_real_escape_string($connection, $row['cat_id']);

    $cat_class = '';
    if (isset($_GET['c_id']) && $_GET['c_id'] == $cat_id) {
        $cat_class = 'active';
    }
    echo "<li class='$cat_class'><a  href='categories.php?c_id={$cat_id}'>{$cat_title}</a></li>";

}

?>
        <?php

if (isset($_SESSION['user_role'])) {
    if ($_SESSION['user_role'] == 'admin') {

        echo "<li><a href='admin/'>Admin</a></li>";

    }
}

?>
        <?php

if (isset($_SESSION['user_role'])) {
    if ($_SESSION['user_role'] == 'admin') {
        if (isset($_GET['p_id'])) {
            $the_post_id = mysqli_real_escape_string($connection, $_GET['p_id']);
            echo "<li><a href='admin/posts.php?source=edit_post&p_id={$the_post_id}'>Edit Post</a></li>";
        }
    }
}

?>




      </ul>
      <?php if (isset($_SESSION['user_role'])) {?>
      <ul class="nav navbar-right top-nav">
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown">
            <?php
echo $_SESSION['firstname'];
    echo " ";
    echo $_SESSION['lastname'];

    ?>
            <b class="caret"></b>
          </a>
          <ul class="dropdown-menu">
            <li>
              <a href="includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
            </li>
          </ul>
          <?php
}

?>
        </li>
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container -->
</nav>