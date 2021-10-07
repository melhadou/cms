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

if (isset($_POST['submit'])) {
    $search = mysqli_real_escape_string($connection, $_POST['search']);

    if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
        $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
    } else {
        $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' AND post_status = 'published'";
    }

    $search_query = mysqli_query($connection, $query);

    // if search query return false ==>
    if (!$search_query) {
        die("QUERY FAILED" . mysqli_error($connection));
    }
    $count = mysqli_num_rows($search_query);

    if ($count == 0) {
        echo "<h3> No Results Found for: {$search}</h3>";
    } else {
        while ($row = mysqli_fetch_assoc($search_query)) {
            $post_title = mysqli_real_escape_string($connection, $row['post_title']);
            $post_id = mysqli_real_escape_string($connection, $row['post_id']);
            $post_author = mysqli_real_escape_string($connection, $row['post_author']);
            $post_date = mysqli_real_escape_string($connection, $row['post_date']);
            $post_image = mysqli_real_escape_string($connection, $row['post_image']);
            $post_content = mysqli_real_escape_string($connection, substr($row['post_content'], 0, 400));
            $post_status = mysqli_real_escape_string($connection, $row['post_status']);

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


      <?php }}

}?>







    </div>

    <!-- Blog Sidebar Widgets Column -->

    <?php include "includes/sidebar.php";?>
  </div>
  <!-- /.row -->

  <hr>

  <?php include "includes/footer.php";?>