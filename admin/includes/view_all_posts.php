<form action="" method="POST">
  <table class="table table-bordered table-hover">
    <div id="bulkOptionContainer" class="col-xs-4">
      <select class="form-control" name="" id="">
        <option value="">Select Option</option>
        <option value="">Publish</option>
        <option value="">Draft</option>
        <option value="">Delete</option>
      </select>
    </div>

    <div class="col-xs-4-">
      <input type="submit" name="submit" class="btn btn-success" value="Apply">
      <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
    </div>
    <br>

    <thead>
      <tr>
        <th><input type="checkbox" id="selectAllBoxes"></th>
        <th>Id</th>
        <th>Author</th>
        <th>Title</th>
        <th>Category</th>
        <th>Status</th>
        <th>Image</th>
        <th>Tags</th>
        <th>Comments</th>
        <th>Date</th>
        <th>Delete</th>
        <th>Edit</th>
      </tr>
    </thead>
    <tbody>

      <?php

$query = "SELECT * FROM posts";
$select_posts = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($select_posts)) {
    $post_id = $row['post_id'];
    $post_title = $row['post_title'];
    $post_author = $row['post_author'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_comment_count = $row['post_comment_count'];
    $post_date = $row['post_date'];

    echo "<tr>";
    ?>
      <th><input type="checkbox" class="checkBoxes" name="checkBoxArray[]" value="<?php echo $post_id; ?>"></th>
      <?php
echo "<td> $post_id</td>";
    echo "<td> $post_author</td>";
    echo "<td> $post_title</td>";

    $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
    $select_categories = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_categories)) {
        $cat_title = $row['cat_title'];
        $cat_id = $row['cat_id'];
        echo "<td> $cat_title</td>";
    }

    echo "<td> $post_status</td>";
    echo "<td><img src='../images/$post_image' width='100' </td>";
    echo "<td> $post_tags</td>";
    echo "<td> $post_comment_count</td>";
    echo "<td> $post_date</td>";
    echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";
    echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
    echo "</tr>";
}
?>
      <?php
// delete categories from db
delete_post();
?>
    </tbody>
  </table>
</form>