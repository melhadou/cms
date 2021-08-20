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
    $search = $_POST['search'];

    $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";
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
            $post_title = $row['post_title'];
            $post_id = $row['post_id'];
            $post_author = $row['post_author'];
            $post_date = $row['post_date'];
            $post_image = $row['post_image'];
            $post_content = substr($row['post_content'], 0, 100);
            $post_status = $row['post_status'];

            if ($post_status != 'published') {
                echo "<h1>Sorry! No Post Yet!!</h1>";
            } else {

                ?>
      <h1 class="page-header">
        Page Heading
        <small>Secondary Text</small>
      </h1>



      <!-- First Blog Post -->



      <h2>
        <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title; ?></a>
      </h2>
      <p class="lead">
        by <a href="index.php"><?php echo $post_author; ?></a>
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


      <?php }}}

}?>







    </div>

    <!-- Blog Sidebar Widgets Column -->

    <?php include "includes/sidebar.php";?>
  </div>
  <!-- /.row -->

  <hr>

  <?php include "includes/footer.php";?>