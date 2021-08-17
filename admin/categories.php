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
                        <small><?php

if (empty($_SESSION['username'])) {
    echo "Author";
} else {
    echo $_SESSION['username'];
}

?></small>
                    </h1>
                    <div class="col-xs-6">
                        <?php insert_categories();
//adding categories to ?>

                        <form action="" method="POST">

                            <div class="form-group">
                                <label for="cat-title1">Add Category</label>
                                <input class="form-control" type="text" name="cat_title" id="cat-title1">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                            </div>
                        </form>

                        <!-- Update Categories -->
                        <?php
if (isset($_GET['edit'])) {
    $cat_id = $_GET['edit'];
    include "includes/update_categories.php";
}

?>
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
                                <?php
// get categories from db
FindAllCategories();
?>
                                <?php
// delete categories from db
delete_cat();
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