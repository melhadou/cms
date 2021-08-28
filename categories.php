<?php include "includes/db.php";?>

<?php include "includes/header.php";?>

<!-- Navigation -->
<?php include "includes/nav.php";?>

<!-- Page Content -->
<div class="container">

  <div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">


      <?php
if (isset($_GET['c_id'])) {
    $c_id = mysqli_real_escape_string($connection, $_GET['c_id']);

    $stmt = mysqli_prepare($connection, "SELECT * FROM categories WHERE cat_id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $c_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    $is_cat_exist = mysqli_stmt_num_rows($stmt);

    if ($is_cat_exist != '0') {

        //show posts in category to admin
        if (isAdmin($_SESSION['username'])) {
            // $query = "SELECT * FROM posts WHERE post_category_id = {$c_id}";
            $stmt1 = mysqli_prepare($connection, "SELECT post_title, post_id , post_author, post_date, post_image ,post_content  FROM posts WHERE post_category_id = ?");
        } else {
            // $query = "SELECT * FROM posts WHERE post_category_id = {$c_id} AND post_status = 'published'";
            $stmt2 = mysqli_prepare($connection, "SELECT post_title, post_id , post_author, post_date, post_image ,post_content FROM posts WHERE post_category_id = ? AND post_status = ?");
            $published = 'published';
        }

        // checking which query we are getting back based on session logedin user
        if (isset($stmt1)) {
            mysqli_stmt_bind_param($stmt1, "i", $c_id);
            mysqli_stmt_execute($stmt1);
            mysqli_stmt_bind_result($stmt1, $post_title, $post_id, $post_author, $post_date, $post_image, $post_content);
            // to get know which stmt has been exectude;
            $stmt = $stmt1;

        } else {
            mysqli_stmt_bind_param($stmt2, "is", $c_id, $published);
            mysqli_stmt_execute($stmt2);
            mysqli_stmt_bind_result($stmt2, $post_title, $post_id, $post_author, $post_date, $post_image, $post_content);
            // to get know which stmt has been exectude;
            $stmt = $stmt2;
        }
        // store returned data to be abel to count rows
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt1) < 1) {

            echo "<h1 class='text-center'>No Posts In This Category Yet</h1>";
        }

        while (mysqli_stmt_fetch($stmt)):

        ?>

      <!-- First Blog Post -->



      <h2>
        <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title; ?></a>
      </h2>
      <p class="lead">
        <?php
//selecting post author from db
        $user_id = $post_author;

        $stmt = mysqli_prepare($connection, "SELECT user_firstname,user_lastname FROM users WHERE user_id = ?");
        mysqli_stmt_bind_param($stmt, 'i', $post_author);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $user_firstname, $user_lastname);
        mysqli_stmt_store_result($stmt);
        while (mysqli_stmt_fetch($stmt)):

            $post_author = $user_firstname . " " . $user_lastname;

        endwhile;
        ?>
        by <a href="author_posts.php?p_author=<?php echo $user_id; ?>"><?php echo $post_author; ?></a>
      </p>
      <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
      <hr>
      <a href="post.php?p_id=<?php echo $post_id;
        ?>">
        <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="<?php echo $post_image; ?>">
      </a>
      <hr>
      <p><?php echo $post_content; ?></p>
      <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More <span
          class="glyphicon glyphicon-chevron-right"></span></a>
      <?php
endwhile;
        mysqli_stmt_close($stmt);
    } else {
        header("Location: index.php");
    }
}
?>




    </div>

    <!-- Blog Sidebar Widgets Column -->

    <?php include "includes/sidebar.php";?>
  </div>
  <!-- /.row -->

  <hr>

  <?php include "includes/footer.php";?>