<?php
if (isset($_SESSION['user_role'])) {

    ?>
<form action="" method="POST">
  <div class="form-group">
    <label for="cat-title2">Edit Category</label>
    <?php
//editng category name

    if (isset($_GET["edit"])) {
        $cat_id = escape($_GET["edit"]);

        $stmt = mysqli_prepare($connection, "SELECT cat_title,cat_id FROM categories WHERE cat_id = ?");
        mysqli_stmt_bind_param($stmt, 'i', $cat_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $cat_title, $cat_id);
        while (mysqli_stmt_fetch($stmt)):
        ?>
    <input class="form-control" type="text" value="<?php if (isset($cat_title)) {echo $cat_title;}?>" name="cat_title"
      id="cat-title2">

    <?php
endwhile;

    }
    ?><?php
if (isset($_POST['update'])) {
        $the_cat_title = escape($_POST["cat_title"]);

        //preparing stmt
        $stmt = mysqli_prepare($connection, "UPDATE  categories SET cat_title = ? WHERE cat_id = ?");

        mysqli_stmt_bind_param($stmt, 'si', $the_cat_title, $cat_id);
        mysqli_stmt_execute($stmt);
        redirect('categories.php');
        //closing stmt
        mysqli_stmt_close($stmt);
    }

    ?>
  </div>
  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="update" value="Update Category">
  </div>
</form>
<?php
} else {
    header("Location: ../index.php");
}
?>