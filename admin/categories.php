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
                        <form action="">

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

                                <?php

$query = "SELECT * FROM categories";
$select_sidbar_cat_querys = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_sidbar_cat_querys)) {
    $cat_title = $row['cat_title'];
    $cat_id = $row['cat_id'];
    ?>
                                <tr>
                                    <td><?php echo $cat_id; ?></td>
                                    <td><?php echo $cat_title; ?></td>
                                </tr>
                                <?php }?>


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