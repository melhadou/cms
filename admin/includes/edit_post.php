<?php
// if ($_SESSION['user_role'] == 'admin') {

?>
<?php
//pull data from db , => show it on , so we can edit it

if (isset($_GET['p_id'])) {

    $the_post_id = escape($_GET['p_id']);
}

$query = "SELECT * FROM posts WHERE post_id = {$the_post_id}";
$edit_post_query = mysqli_query($connection, $query);
confirm($edit_post_query);
while ($row = mysqli_fetch_assoc($edit_post_query)) {
    $post_title = escape($row['post_title']);
    $post_author = escape($row['post_author']);
    $post_category_id = escape($row['post_category_id']);
    $post_status = escape($row['post_status']);
    $post_image = escape($row['post_image']);
    $post_tags = escape($row['post_tags']);
    $post_content = escape($row['post_content']);
}
?>
<?php
// edit the data , & send it back to db

if (isset($_POST['edit_post'])) {

    $post_title = escape($_POST['post_title']);
    $post_author = escape($_POST['post_author']);
    $post_category_id = escape($_POST['post_category_id']);
    $post_status = escape($_POST['post_status']);

    $post_image = escape($_FILES['post_image']['name']);
    $post_image_temp = escape($_FILES['post_image']['tmp_name']);

    $post_tags = escape($_POST['post_tags']);
    $post_content = escape($_POST['post_content']);
    $post_date = date('d-m-y');
    // $post_comment_count = '';
    // $post_views_count = '';

    //uploid image to images folder

    move_uploaded_file($post_image_temp, "../images/$post_image");

    //check if there is no image
    if (empty($post_image)) {

        $query = "SELECT * FROM posts WHERE post_id = {$the_post_id}";
        $select_img = mysqli_query($connection, $query);

        confirm($select_img);
        while ($row = mysqli_fetch_assoc($select_img)) {
            $post_image = escape($row['post_image']);
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
    $query .= ", post_status = '{$post_status}' ";
    // $query .= ", post_views_count = '{$post_views_count}' ";

    $query .= "WHERE post_id = $the_post_id ";

    $edit_post_query = mysqli_query($connection, $query);
    confirm($edit_post_query);

    echo "<p class='bg-success'>Post Updated: View <a href='../post.php?p_id={$the_post_id}'>{$post_title}</a><p>";
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
$query = "SELECT * FROM categories";
$select_categories = mysqli_query($connection, $query);
confirm($select_categories);
while ($row = mysqli_fetch_assoc($select_categories)) {
    $cat_title = escape($row['cat_title']);
    $cat_id = escape($row['cat_id']);
    if ($post_category_id == $cat_id) {
        echo "<option selected value='{$cat_id}'>{$cat_title}</option>";
    } else {
        echo "<option value='{$cat_id}'>{$cat_title}</option>";
    }
}
?>
    </select>

  </div>
  <div class="form-group">
    <label for="author">Post author</label>
    <select name="post_author" id="author" class="form-control">
      <?php
//show categories
$query = "SELECT * FROM users WHERE user_id = $post_author ";
$select_user_query = mysqli_query($connection, $query);
confirm($select_user_query);
while ($row = mysqli_fetch_assoc($select_user_query)) {
    $post_username = escape($row['username']);
    $user_id = escape($row['user_id']);
}
?>
      <option value="<?php echo $user_id; ?>"><?php echo $post_username; ?></option>
      <?php
//show categories
$query = "SELECT * FROM users ";
$select_user_query = mysqli_query($connection, $query);
confirm($select_user_query);
while ($row = mysqli_fetch_assoc($select_user_query)) {
    $username = escape($row['username']);
    $user_id = escape($row['user_id']);
    if ($post_username != $username) {
        echo "<option value='{$user_id}'>{$username}</option>";
    }

}
?>
    </select>
  </div>
  <div class="form-group">
    <label for="status">Post status</label>
    <select name="post_status" id="status" class="form-control">
      <option value="<?php echo $post_status ?>"><?php echo $post_status ?></option>
      <?php

if ($post_status == 'draft') {
    echo "<option value='published'>Publish</option>";
} else {
    echo "<option value='draft'>Darft</option>";
}

?>
    </select>
  </div>
  <div class="form-group">
    <label for="image">Post Image</label>

    <img src="../images/<?php echo $post_image; ?>" class="img-responsive" width="100" alt="<?php echo $post_image; ?>">
    <br>
    <input type="file" class="form-control" name="post_image" id="image">
  </div>
  <div class="form-group">
    <label for="tags">Post tags</label>
    <input type="text" class="form-control" name="post_tags" id="tags" value="<?php echo $post_tags; ?>">
  </div>
  <div class="form-group">
    <label for="editor">Post Content</label>
    <textarea name="post_content" id="editor" rows="15"><?php echo $post_content; ?></textarea>
  </div>
  <div class="form-group">

    <input type="submit" class="btn btn-primary" name="edit_post" value="Update Post">
  </div>

</form>
<?php
// } else {
//     echo "You cant See This Page";
// }
?>