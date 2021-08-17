<?php
include "includes/admin_header.php";
?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_nav.php";?>

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


                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php";?>