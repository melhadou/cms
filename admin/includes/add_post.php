<?php
if ($_SESSION['user_role'] == 'admin') {

    ?>
<?php

    if (isset($_POST['creat_post'])) {

        $post_title = $_POST['post_title'];
        $post_author = $_POST['post_author'];
        $post_category_id = $_POST['post_category_id'];
        $post_status = $_POST['post_status'];

        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['tmp_name'];

        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');
        $post_comment_count = '';

        //uploid image to images folder

        move_uploaded_file($post_image_temp, "../images/$post_image");

        $query = "INSERT INTO posts(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_status,post_comment_count) ";
        $query .= "VALUES('{$post_category_id}' , '{$post_title}' , '{$post_author}' , now() , '{$post_image}' , '{$post_content}' ,'{$post_tags}' ,  '{$post_status}' ,'{$post_comment_count}')";

        $creat_post_query = mysqli_query($connection, $query);
        confirm($creat_post_query);
        $the_post_id = mysqli_insert_id($connection);
        echo "<p class='bg-success'>Post Created: View <a href='../post.php?p_id={$the_post_id}'>{$post_title}</a><p>";
    }

    ?>








<form action="" method="POST" enctype="multipart/form-data">

  <div class="form-group">
    <label for="title">Post Title</label>
    <input type="text" class="form-control" name="post_title" id="title">
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
    <input type="text" class="form-control" name="post_author" id="author">
  </div>
  <div class="form-group">
    <label for="status">Post status</label>
    <select name="post_status" id="status" class="form-control">
      <option value='published'>Publish</option>
      <option value='draft'>Darft</option>
    </select>
  </div>
  <div class="form-group">
    <label for="image">Post Image</label>
    <input type="file" class="form-control" name="post_image" id="image">
  </div>
  <div class="form-group">
    <label for="tags">Post tags</label>
    <input type="text" class="form-control" name="post_tags" id="tags">
  </div>
  <div class="form-group">

    <label for="body">Post Content</label>

    <textarea class="form-control" name="post_content" id="body">

    </textarea>

  </div>
  <div class="form-group">

    <input type="submit" class="btn btn-primary" name="creat_post" value="Publish Post">
  </div>

</form>
<?php
} else {
    echo "You cant See This Page";
}
?>