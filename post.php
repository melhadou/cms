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
    $p_id = $_GET['p_id'];
}

$query = "SELECT * FROM posts WHERE post_id = {$p_id}";
$select_all_post_querys = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_all_post_querys)) {
    $post_title = $row['post_title'];
    $post_author = $row['post_author'];
    $post_date = $row['post_date'];
    $post_image = $row['post_image'];
    $post_content = $row['post_content'];

    ?>
            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>



            <!-- First Blog Post -->



            <h2>
                <a href="post.php?p_id=<?php echo $p_id ?>"><?php echo $post_title ?></a>
            </h2>
            <p class="lead">
                by <a href="index.php"><?php echo $post_author ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
            <hr>
            <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
            <hr>
            <p><?php echo $post_content ?></p>




            <?php }?>
            <hr>

            <!-- Leave a Comment -->
            <?php

if (isset($_POST['creat_comment'])) {

    $comment_post_id = $_GET['p_id'];
    $comment_author = $_POST['comment_author'];
    $comment_email = $_POST['comment_email'];
    $comment_content = $_POST['comment_content'];
    $comment_status = 'unapproved';
    $comment_date;

    $query = "INSERT INTO comments(comment_content,comment_post_id,comment_author,comment_email,comment_status,comment_date) ";
    $query .= "VALUES('{$comment_content}','{$comment_post_id}','{$comment_author}','{$comment_email}','{$comment_status}',now() ) ";

    $creat_comment_query = mysqli_query($connection, $query);

    if (!$creat_comment_query) {
        die('QUERY FAILED' . mysqli_error($connection));
    }

    $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
    $query .= "WHERE post_id = $comment_post_id";
    $update_comment_query = mysqli_query($connection, $query);
}
?>



            <div class="well">
                <h4>Leave a Comment:</h4>
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
$comment_post_id = $_GET['p_id'];

$query = "SELECT * FROM comments WHERE comment_post_id = $comment_post_id ";
$query .= "AND comment_status = 'approved' ";
$query .= "ORDER BY comment_id DESC";
$show_comment_query = mysqli_query($connection, $query);
if (!$show_comment_query) {
    die('QUERY FAILED' . mysqli_error($connection));
}
while ($row = mysqli_fetch_assoc($show_comment_query)) {
    $comment_content = $row['comment_content'];
    $comment_author = $row['comment_author'];
    $comment_date = $row['comment_date'];

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





        <!-- Blog Sidebar Widgets Column -->

        <?php include "includes/sidebar.php";?>
    </div>
    <!-- /.row -->

    <hr>

    <?php include "includes/footer.php";?>