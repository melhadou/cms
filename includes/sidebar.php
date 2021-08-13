<div class="col-md-4">

    <!-- Blog Search Well -->

    <div class="well">
        <h4>Blog Search</h4>

        <form action="search.php" method="POST">
            <div class="input-group">
                <input type="text" name="search" class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" name="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>



    <!-- Blog Categories Well -->
    <?php

$query = "SELECT * FROM categories";
$select_sidbar_cat_querys = mysqli_query($connection, $query);

?>
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php

while ($row = mysqli_fetch_assoc($select_sidbar_cat_querys)) {
    $cat_title = $row['cat_title'];
    $cat_id = $row['cat_id'];

    echo "<li><a href='categories.php?c_id={$cat_id}'>{$cat_title}</a></li>";

}

?>
                </ul>
            </div>

        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include "widget.php";?>

</div>