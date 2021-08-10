<form action="" method="POST">
    <div class="form-group">
        <label for="cat-title2">Edit Category</label>
        <?php
//editng category name

if (isset($_GET["edit"])) {
    $cat_id = $_GET["edit"];

    $query = "SELECT * FROM categories WHERE cat_id = {$cat_id} ";
    $select_categories_id = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_categories_id)) {
        $cat_title = $row['cat_title'];
        $cat_id = $row['cat_id'];
        ?>
        <input class="form-control" type="text" value="<?php if (isset($cat_title)) {echo $cat_title;}?>"
            name="cat_title" id="cat-title2">

        <?php }
}?><?php
if (isset($_POST['update'])) {
    $the_cat_title = $_POST["cat_title"];

    $query = "UPDATE  categories SET cat_title = '{$the_cat_title}' WHERE cat_id = {$cat_id}";

    $update_cat_title = mysqli_query($connection, $query);
}

?>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update" value="Update Category">
    </div>
</form>