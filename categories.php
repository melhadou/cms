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

    $query = "SELECT * FROM categories WHERE cat_id = $c_id";
    $check_cat_query = mysqli_query($connection, $query);
    $is_cat_exist = mysqli_num_rows($check_cat_query);
    if ($is_cat_exist != '0') {

        //show posts in category to admin
        if (isAdmin($_SESSION['username'])) {
            // $query = "SELECT * FROM posts WHERE post_category_id = {$c_id}";
            $stmt1 = mysqli_prepare($connection, "SELECT * FROM posts WHERE post_category_id = ?");
        } else {
            // $query = "SELECT * FROM posts WHERE post_category_id = {$c_id} AND post_status = 'published'";
            $stmt2 = mysqli_prepare($connection, "SELECT post_title, post_id , post_author, post_date, post_image ,post_content FROM posts WHERE post_category_id = ? AND post_status = ?");
        }

        $select_all_posts_querys = mysqli_query($connection, $query);
        if (mysqli_num_rows($select_all_posts_querys) < 1) {
            echo "<h1 class='text-center'>No Posts In This Category Yet</h1>";
        } else {

            while ($row = mysqli_fetch_assoc($select_all_posts_querys)) {
                $post_title = mysqli_real_escape_string($connection, $row['post_title']);
                $post_id = mysqli_real_escape_string($connection, $row['post_id']);
                $post_author = mysqli_real_escape_string($connection, $row['post_author']);
                $post_date = mysqli_real_escape_string($connection, $row['post_date']);
                $post_image = mysqli_real_escape_string($connection, $row['post_image']);
                $post_content = mysqli_real_escape_string($connection, substr($row['post_content'], 0, 400));

                ?>

      <!-- First Blog Post -->



      <h2>
        <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title; ?></a>
      </h2>
      <p class="lead">
        <?php
//selecting post author from db
                $user_id = $post_author;

                $query = "SELECT * FROM users WHERE user_id = $post_author";
                $select_user_query = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($select_user_query)) {

                    $post_author = mysqli_real_escape_string($connection, $row['user_firstname'] . " " . $row['user_lastname']);

                }
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
      <?php }
        }
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