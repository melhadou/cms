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
if (isset($_GET['p_id'])) {
    $p_id = mysqli_real_escape_string($connection, $_GET['p_id']);

    $query = "UPDATE posts SET post_views_count = post_views_count + 1  WHERE post_id = {$p_id}";
    $update_post_views_querys = mysqli_query($connection, $query);

    $query = "SELECT * FROM posts WHERE post_id = {$p_id} AND post_status = 'published'";
    $select_post_querys = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_post_querys)) {
        $post_title = mysqli_real_escape_string($connection, $row['post_title']);
        $post_author = mysqli_real_escape_string($connection, $row['post_author']);
        $post_date = mysqli_real_escape_string($connection, $row['post_date']);
        $post_image = mysqli_real_escape_string($connection, $row['post_image']);
        $post_content = mysqli_real_escape_string($connection, $row['post_content']);
        $post_views_count = mysqli_real_escape_string($connection, $row['post_views_count']);

        ?>


      <!-- First Blog Post -->



      <h2>
        <a href="post.php?p_id=<?php echo $p_id ?>"><?php echo $post_title ?></a>
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

      <p><span class='glyphicon glyphicon-eye-open'></span> <?php echo $post_views_count ?></p>

      <p><span class="glyphicon glyphicon-time"></span> Posted on
        <?php echo $post_date ?></p>
      <hr>
      <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
      <hr>
      <p><?php echo $post_content ?></p>





      <?php }} else {
    header("Location: index.php");
}?>

      <hr>
      <?php
$query = "SELECT * FROM posts WHERE post_id = $p_id";
$check_query = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($check_query);
$post_status = $row['post_status'];
if ($post_status == 'published') {

    ?>
      <!-- Leave a Comment -->
      <?php

    if (isset($_POST['creat_comment'])) {

        $comment_post_id = mysqli_real_escape_string($connection, $_GET['p_id']);
        $comment_author = mysqli_real_escape_string($connection, $_POST['comment_author']);
        $comment_email = mysqli_real_escape_string($connection, $_POST['comment_email']);
        $comment_content = mysqli_real_escape_string($connection, $_POST['comment_content']);
        $comment_status = mysqli_real_escape_string($connection, 'unapproved');
        $comment_date;

        if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
            $query = "INSERT INTO comments(comment_content,comment_post_id,comment_author,comment_email,comment_status,comment_date) ";

            $query .= "VALUES('{$comment_content}','{$comment_post_id}','{$comment_author}','{$comment_email}','{$comment_status}',now() ) ";

            $creat_comment_query = mysqli_query($connection, $query);

            if (!$creat_comment_query) {
                die('QUERY FAILED' . mysqli_error($connection));
            }
            //old comment increamanting logic
            // $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
            // $query .= "WHERE post_id = $comment_post_id";
            // $update_comment_query = mysqli_query($connection, $query);

        } else {

            echo "<script>
        function notempthy() {
                      const pp = document.querySelector('.error');
                      pp.innerText = 'This Fields Should not be emthy';}
            </script>";
        }}
    ?>



      <div class="well">
        <h4>Leave a Comment:</h4>
        <p class="error" style="color:red">
        </p>
        <script>
        notempthy();
        </script>
        <form role="form" action="" method="POST">
          <div class="form-group">
            <label for="comment_author">Author:</label>
            <input type="text" name="comment_author" id="comment_author" class="form-control">
          </div>
          <div class="form-group">
            <label for="comment_email">Email:</label>
            <input type="email" name="comment_email" id="comment_email" class="form-control">
          </div>
          <div class="form-group">
            <label for="comment_content">Comment:</label>
            <textarea class="form-control" rows="3" name="comment_content" id="comment_content"></textarea>
          </div>
          <button type="submit" class="btn btn-primary" name="creat_comment">Submit</button>
        </form>
      </div>

      <hr>

      <!-- Posted Comments -->

      <!-- Comment -->





      <?php

    $comment_post_id = mysqli_real_escape_string($connection, $_GET['p_id']);

    $query = "SELECT * FROM comments WHERE comment_post_id = $comment_post_id ";
    $query .= "AND comment_status = 'approved' ";
    $query .= "ORDER BY comment_id DESC";
    $show_comment_query = mysqli_query($connection, $query);
    if (!$show_comment_query) {
        die('QUERY FAILED' . mysqli_error($connection));
    }
    while ($row = mysqli_fetch_assoc($show_comment_query)) {
        $comment_content = mysqli_real_escape_string($connection, $row['comment_content']);
        $comment_author = mysqli_real_escape_string($connection, $row['comment_author']);
        $comment_date = mysqli_real_escape_string($connection, $row['comment_date']);

        ?>

      <div class='media'>
        <a class='pull-left'><img class='media-object' src='http://placehold.it/64x64' alt=''></a>
        <div class='media-body'>
          <h4 class='media-heading'><?php echo $comment_author; ?>
            <small> <?php echo $comment_date; ?></small>
          </h4><?php echo $comment_content; ?>
        </div>
      </div>
      <?php }?>
    </div>

    <?php } else {
    header("Location: index.php");

}?>



    <!-- Blog Sidebar Widgets Column -->

    <?php include "includes/sidebar.php";?>
  </div>
  <!-- /.row -->

  <hr>

  <?php include "includes/footer.php";?>