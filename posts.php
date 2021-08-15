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
$select_all_posts_querys = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_all_posts_querys)) {
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
                <a href="posts.php?p_id=<?php echo $p_id ?>"><?php echo $post_title ?></a>
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
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">Start Bootstrap
                        <small>August 25, 2014 at 9:30 PM</small>
                    </h4>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin
                    commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum
                    nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                </div>
            </div>

            <!-- Comment -->
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">Start Bootstrap
                        <small>August 25, 2014 at 9:30 PM</small>
                    </h4>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin
                    commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum
                    nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    <!-- Nested Comment -->
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">Nested Start Bootstrap
                                <small>August 25, 2014 at 9:30 PM</small>
                            </h4>
                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante
                            sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra
                            turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis
                            in faucibus.
                        </div>
                    </div>
                    <!-- End Nested Comment -->
                </div>
            </div>
        </div>


        <!-- Blog Sidebar Widgets Column -->

        <?php include "includes/sidebar.php";?>
    </div>
    <!-- /.row -->

    <hr>

    <?php include "includes/footer.php";?>