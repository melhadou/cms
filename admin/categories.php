<?php
include "includes/admin_header.php";
?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_nav.php";?>
    <!-- this is for page wrapper -->
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome
                        <small>Author</small>
                    </h1>
                    <div class="col-xs-6">
                        <?php

if (isset($_POST['submit'])) {
    $cat_title = $_POST[('cat_title')];

    if ($cat_title == "" || empty($cat_title)) {
        echo "You need to Type Somthing";
    } else {
        $query = "INSERT INTO categories(cat_title) VALUE('{$cat_title}') ";

        $creat_cat_query = mysqli_query($connection, $query);
        if (!$creat_cat_query) {
            die("QUERY FAILED" . mysqli_error($connection));
        }
    }
}

?>


                        <form action="" method="POST">

                            <div class="form-group">
                                <label for="cat-title">Add Category</label>
                                <input class="form-control" type="text" name="cat_title" id="cat-title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                            </div>
                        </form>
                    </div>
                    <div class="col-xs-6">

                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category Title</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php // get categories from db
$query = "SELECT * FROM categories";
$select_categories = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($select_categories)) {
    $cat_title = $row['cat_title'];
    $cat_id = $row['cat_id'];
    echo "<tr>";
    echo "<td>{$cat_id}</td>";
    echo "<td>{$cat_title}</td>";
    echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
    echo "</tr>";

}

?>
                                <?php // delete categories from db

if (isset($_GET['delete'])) {

    $the_cat_id = $_GET['delete'];

    $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";

    $delete_query = mysqli_query($connection, $query);

    // refraiche the page , to show data after deleting categories
    header("Location: categories.php");

    if (!$delete_query) {
        die("QUERY FAILED" . mysqli_error($connection));
    }
}

?>
                            </tbody>
                        </table>
                    </div>



                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php";?>