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

            <small>
              <?php

    if (empty($_SESSION['username'])) {
        echo "Author";
    } else {
        echo $_SESSION['username'];
    }

    ?>
            </small>

          </h1>


        </div>
      </div>
      <!-- /.row -->

      <!-- admin widget-->

      <div class="row">
        <div class="col-lg-3 col-md-6">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-3">
                  <i class="fa fa-file-text fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                  <div class='huge'>

                    <?php echo $post_count = counter('posts'); ?>

                  </div>
                  <div>Posts</div>
                </div>
              </div>
            </div>
            <a href="posts.php">
              <div class="panel-footer">
                <span class="pull-left">View Details</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
              </div>
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="panel panel-green">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-3">
                  <i class="fa fa-comments fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                  <div class='huge'><?php echo $comment_count = counter('comments'); ?></div>
                  <div>Comments</div>
                </div>
              </div>
            </div>
            <a href="comments.php">
              <div class="panel-footer">
                <span class="pull-left">View Details</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
              </div>
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="panel panel-yellow">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-3">
                  <i class="fa fa-user fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                  <div class='huge'><?php echo $users_count = counter('users'); ?></div>
                  <div> Users</div>
                </div>
              </div>
            </div>
            <a href="users.php">
              <div class="panel-footer">
                <span class="pull-left">View Details</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
              </div>
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="panel panel-red">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-3">
                  <i class="fa fa-list fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                  <div class='huge'><?php echo $categories_count = counter('categories'); ?></div>
                  <div>Categories</div>
                </div>
              </div>
            </div>
            <a href="categories.php">
              <div class="panel-footer">
                <span class="pull-left">View Details</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
              </div>
            </a>
          </div>
        </div>
      </div>
      <!-- end admin widget-->
      <?php
// draft posts counter
    $qeury = "SELECT * FROM posts WHERE post_status = 'draft'";
    $draft_posts_query = mysqli_query($connection, $qeury);
    $draft_posts_count = mysqli_num_rows($draft_posts_query);
// published posts counter
    $qeury = "SELECT * FROM posts WHERE post_status = 'published'";
    $published_posts_query = mysqli_query($connection, $qeury);
    $published_posts_count = mysqli_num_rows($published_posts_query);

//unnaproved comments counter
    $qeury = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
    $unapproved_comment_query = mysqli_query($connection, $qeury);
    $unapproved_comment_count = mysqli_num_rows($unapproved_comment_query);

// upproved comments
    $query = "SELECT * FROM comments WHERE comment_status = 'approved' ";
    $approved_comment_query = mysqli_query($connection, $query);
    $approved_comment_count = mysqli_num_rows($approved_comment_query);

//subscribers count
    $qeury = "SELECT * FROM users WHERE user_role = 'subscriber'";
    $subscriber_users_query = mysqli_query($connection, $qeury);
    $subscriber_users_count = mysqli_num_rows($subscriber_users_query);
    ?>

      <div class="row">


        <script type="text/javascript">
        google.charts.load('current', {
          'packages': ['bar']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ['Data', 'Count'],

            <?php

    $element_text = ['All Posts', 'Active Posts', 'Draft Posts', 'Comments', 'Approved Comments', 'Pending Comments', 'Categories'];
    $element_count = [$post_count, $published_posts_count, $draft_posts_count, $comment_count, $approved_comment_count, $unapproved_comment_count, $categories_count];
    for ($i = 0; $i < 7; $i++) {
        echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
    }

    ?>


          ]);

          var options = {
            chart: {
              title: '',
              subtitle: '',
            }
          };

          var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

          chart.draw(data, google.charts.Bar.convertOptions(options));
        }
        </script>
        <div id="columnchart_material" style="width: 'auto'; height: 500px;"> </div>
      </div>



    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->

  <?php include "includes/admin_footer.php";}?>