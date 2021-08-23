<?php
if ($_SESSION['user_role'] == 'admin') {

    ?>
<?php

    if (isset($_POST['checkBoxArray'])) {
        foreach ($_POST['checkBoxArray'] as $checkBoxValue) {
            $bulk_option = $_POST['bulk_option'];

            switch ($bulk_option) {
                case 'published':
                    $query = "UPDATE posts SET post_status = '{$bulk_option}' WHERE post_id = $checkBoxValue";
                    $select_post_query = mysqli_query($connection, $query);
                    confirm($select_post_query);
                    break;
                case 'draft':
                    $query = "UPDATE posts SET post_status = '{$bulk_option}' WHERE post_id = $checkBoxValue";
                    $select_post_query = mysqli_query($connection, $query);
                    confirm($select_post_query);
                    break;
                case 'delete':
                    $query = "DELETE FROM posts WHERE post_id = $checkBoxValue";
                    $delete_post_query = mysqli_query($connection, $query);
                    confirm($delete_post_query);
                    header("Location: posts.php");
                    break;
                case 'clone':

                    $query = "SELECT * FROM posts WHERE post_id = $checkBoxValue";
                    $select_clone_posts = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_assoc($select_clone_posts)) {
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_category_id = $row['post_category_id'];
                        $post_status = $row['post_status'];
                        $post_image = $row['post_image'];
                        $post_tags = $row['post_tags'];
                        $post_comment_count = $row['post_comment_count'];
                        $post_date = $row['post_date'];
                        $post_views_count = $row['post_views_count'];
                    }

                    $query = "INSERT INTO posts(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_status,post_comment_count,post_views_count) ";
                    $query .= "VALUES('{$post_category_id}' , '{$post_title}' , '{$post_author}' , now() , '{$post_image}' , '{$post_content}' ,'{$post_tags}' ,  '{$post_status}' ,'{$post_comment_count}','{$post_views_count}')";

                    $clone_post_query = mysqli_query($connection, $query);
                    confirm($clone_post_query);
                    // header("Location: posts.php");
                    break;
                case 'reset_views':
                    $query = "UPDATE posts SET post_views_count = 0 WHERE post_id = $checkBoxValue";
                    $reset_post_views_query = mysqli_query($connection, $query);
                    confirm($reset_post_views_query);
                    header("Location: posts.php");
                    break;
            }

        }

    }

    ?>

<form action="" method="POST">
  <table class="table table-bordered table-hover">
    <div id="bulkOptionContainer" style="padding-left: 0px;" class="col-xs-4">
      <select class="form-control" name="bulk_option" id="">
        <option value="">Select Option</option>
        <option value="published">Publish</option>
        <option value="draft">Draft</option>
        <option value="delete">Delete</option>
        <option value="clone">Clone</option>
        <option value="reset_views">Reset Views Count</option>
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
        <th>View Post</th>
        <th>Edit</th>
        <th>Delete</th>
        <th>Views Count</th>

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
        $post_views_count = $row['post_views_count'];

        echo "<tr>";
        ?>
      <th><input type="checkbox" class="checkBoxes" name="checkBoxArray[]" value="<?php echo $post_id; ?>"></th>
      <?php
echo "<td> $post_id</td>";
        echo "<td> $post_author</td>";
        echo "<td>$post_title</td>";

        $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
        $select_categories = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($select_categories)) {
            $cat_title = $row['cat_title'];
            $cat_id = $row['cat_id'];
            echo "<td> $cat_title</td>";
        }
        echo "<td> $post_status</td>";
        echo "<td><img src='../images/$post_image' width='100' </td>";
        echo "
      <td> $post_tags</td>";
        echo "<td  class='text-center'> $post_comment_count</td>";
        echo "<td> $post_date</td>";

        echo "<td> <a href='../post.php?p_id={$post_id}' target='_blank'>View Post</a></td>";
        echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
        echo "<td><a onClick=\"javascript: return confirm('Are You Sur You Want To Delete');
          \"href='posts.php?delete={$post_id}'>Delete</a></td>";
        echo "<td class='text-center'>$post_views_count</td>";
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
<?php
} else {
    echo "You cant See This Page";
}
?>