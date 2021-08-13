    <?php
//pull data from db , => show it on , so we can edit it

if (isset($_GET['p_id'])) {

    $the_post_id = $_GET['p_id'];
}

$query = "SELECT * FROM posts WHERE post_id = {$the_post_id}";
$edit_post_query = mysqli_query($connection, $query);
confirm($edit_post_query);
while ($row = mysqli_fetch_assoc($edit_post_query)) {
    $post_title = $row['post_title'];
    $post_author = $row['post_author'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_content = $row['post_content'];
}
?>
    <?php
// edit the data , & send it back to db

if (isset($_POST['edit_post'])) {

    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];
    $post_category_id = $_POST['post_category_id'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
    $post_comment_count = 4;

    //uploid image to images folder

    move_uploaded_file($post_image_temp, "../images/$post_image");

    //check if there is no image
    if (empty($post_image)) {

        $query = "SELECT * FROM posts WHERE post_id = {$the_post_id}";
        $select_img = mysqli_query($connection, $query);

        confirm($select_img);
        while ($row = mysqli_fetch_assoc($select_img)) {
            $post_image = $row['post_image'];
        }

    }

    $query = "UPDATE posts SET ";

    $query .= "post_category_id = '{$post_category_id}' ";
    $query .= ", post_title = '{$post_title}' ";
    $query .= ", post_author = '{$post_author}' ";
    $query .= ", post_date = now() ";
    $query .= ", post_image = '{$post_image}' ";
    $query .= ", post_content = '{$post_content}' ";
    $query .= ", post_tags = '{$post_tags}' ";
    $query .= ", post_comment_count = '{$post_comment_count}' ";
    $query .= ", post_status = '{$post_status}' ";

    $query .= "WHERE post_id = $the_post_id ";

    $edit_post_query = mysqli_query($connection, $query);
    confirm($edit_post_query);

}

?>
    <form action="" method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label for="title">Post Title</label>
            <input type="text" class="form-control" name="post_title" id="title" value="<?php echo $post_title; ?>">
        </div>

        <div class="form-group">
            <label for="post_category_id">Post Category</label>
            <select name="post_category_id" id="post_category_id" class="form-control">
                <?php
//show categories
showCategories();
?>
            </select>

        </div>
        <div class="form-group">
            <label for="author">Post author</label>
            <input type="text" class="form-control" name="post_author" id="author" value="<?php echo $post_author; ?>">
        </div>
        <div class="form-group">
            <label for="status">Post status</label>
            <input type="text" class="form-control" name="post_status" id="status" value="<?php echo $post_status; ?>">
        </div>
        <div class="form-group">
            <label for="image">Post Image</label>

            <img src="../images/<?php echo $post_image; ?>" class="img-responsive" width="100"
                alt="<?php echo $post_image; ?>">
            <br>
            <input type="file" class="form-control" name="post_image" id="image">
        </div>
        <div class="form-group">
            <label for="tags">Post tags</label>
            <input type="text" class="form-control" name="post_tags" id="tags" value="<?php echo $post_tags; ?>">
        </div>
        <div class="form-group">
            <label for="content">Post Content</label>
            <textarea class="form-control" name="post_content" id="content"
                rows="10"><?php echo $post_content; ?></textarea>
        </div>
        <div class="form-group">

            <input type="submit" class="btn btn-primary" name="edit_post" value="Update Post">
        </div>

    </form>