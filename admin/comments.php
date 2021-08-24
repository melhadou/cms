<?php
include "includes/admin_header.php";
if ($_SESSION['user_role'] == 'admin') {
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

          <?php

    if (isset($_GET['source'])) {

        $source = escape($_GET['source']);
    } else {
        $source = '';
    }
    switch ($source) {
        // case 'add_post';
        //     include "includes/add_post.php";
        //     break;
        // case 'edit_post';
        //     include "includes/edit_post.php";
        //     break;
        // case '200';
        //     echo 'nice 200';
        //     break;
        default:
            include "includes/view_all_comments.php";
            break;

    }

    ?>


        </div>
      </div>
      <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->

  <?php include "includes/admin_footer.php";}?>