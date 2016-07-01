<?php include "includes/admin_header.php" ?>
<?php 
  $session = session_id();
  $time = time();
  $time_out_in_seconds = 30;
  $timeout = $time - $time_out_in_seconds;
  
  $query = "SELECT * FROM users_online WHERE session = '$session'";
  $send_query = mysqli_query($connection, $query);
  $count = mysqli_num_rows($send_query);
  
  if ($count == NULL){
    mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session', '$time')");
  } else {
    mysqli_query($connection, "UPDATE users_online SET time='$time' WHERE session='$session'");
  }
  
  $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$timeout'");
  $count_user = mysqli_num_rows($users_online_query);
  
?>
  <div id="wrapper">

  <!-- Navigation -->
  <?php include "includes/admin_navigation.php" ?>
  <div id="page-wrapper">
    
    <div class="container-fluid">
      <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">
            Welcome to admin
            
            <small><?php echo $_SESSION['username']; ?></small>
          </h1>
          <h1><?php echo $count_user; ?></h1>
        </div>
      </div>
      <!-- /.row -->
                
      <div class="row">
        <div class="col-lg-3 col-md-6">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-3">
                  <i class="fa fa-file-text fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                  <?php 
                    $query = "SELECT * FROM posts";
                    $select_all_posts = mysqli_query($connection, $query);
                    $count_posts = mysqli_num_rows($select_all_posts);
                  ?>
                  
                  <div class='huge'><?php echo $count_posts; ?></div>
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
                  <?php
                    $query = "SELECT * FROM comments";
                    $select_all_comments = mysqli_query($connection, $query);
                    $count_comments = mysqli_num_rows($select_all_comments);
                  ?>
                  <div class='huge'><?php echo $count_comments ?></div>
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
                  <?php
                    $query = "SELECT * FROM users";
                    $select_all_users = mysqli_query($connection, $query);
                    $count_users = mysqli_num_rows($select_all_users);
                  ?>
                  <div class='huge'><?php echo $count_users ?></div>
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
                  <?php
                    $query = "SELECT * FROM categories";
                    $select_all_categories = mysqli_query($connection, $query);
                    $count_categories = mysqli_num_rows($select_all_categories);
                  ?>
                  <div class='huge'><?php echo $count_categories ?></div>
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
      </div><!-- /.row -->
      <?php 
        $query = "SELECT * FROM posts WHERE post_status = 'draft'";
        $select_all_draft_posts = mysqli_query($connection, $query); 
        $count_draft_posts = mysqli_num_rows($select_all_draft_posts);
        
        $query = "SELECT * FROM posts WHERE post_status = 'published'";
        $select_all_published_posts = mysqli_query($connection, $query); 
        $count_published_posts = mysqli_num_rows($select_all_published_posts);
        
        $query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
        $select_all_unapproved_comments = mysqli_query($connection, $query); 
        $count_unapproved_comments = mysqli_num_rows($select_all_unapproved_comments);
        
        $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
        $select_all_subscriber_users = mysqli_query($connection, $query); 
        $count_subscriber_users = mysqli_num_rows($select_all_subscriber_users);
      ?>
      <div class="row">
        <script type="text/javascript">
          google.charts.load('current', {'packages':['bar']});
          google.charts.setOnLoadCallback(drawChart);
          function drawChart() {
            var data = google.visualization.arrayToDataTable([
              ['Data', 'Count'],
              <?php 
                $element_text = ['All Posts','Active Posts', 'Draft Posts', 'Comments', 'Pending Comments', 'Users', 'Subscribers Count', 'Categories'];
                $element_count = [$count_posts, $count_published_posts, $count_draft_posts, $count_comments, $count_unapproved_comments, $count_users, $count_subscriber_users, $count_categories];
                
                for($i=0;$i<8;$i++){
                  echo "['$element_text[$i]'" . "," . "$element_count[$i]],";
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

            chart.draw(data, options);
          }
        </script>
        <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
      </div>
    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->
  <?php include "includes/admin_footer.php" ?>
    
