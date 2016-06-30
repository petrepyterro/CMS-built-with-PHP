<?php 
  include "includes/db.php";
  include "includes/header.php";
  include "admin/functions.php";
?>

    <!-- Navigation -->
    <?php include "includes/navigation.php" ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
          <div class="col-md-8">
            
            <?php 
              if (isset($_GET['author'])){
                $the_post_author = $_GET['author'];
              }
              
              $query = "SELECT * FROM posts WHERE post_author = '$the_post_author'";
              
              $select_all_posts_query_by_author = mysqli_query($connection, $query);
          
              while($row = mysqli_fetch_assoc($select_all_posts_query_by_author)){
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
                
            ?>
            
                <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    All posts by <?php echo $post_author ?>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="http://localhost/images/<?php echo $post_image ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <hr>
            
            <?php } ?>
            
          </div>
          <!-- Blog Sidebar Widgets Column -->
          <?php include "includes/sidebar.php" ?>
        </div><!-- /.row --> 
        <!-- Blog Comments -->
        
        <?php 
          if (isset($_POST['create_comment'])){
            $the_post_id = $_GET['p_id'];
            $comment_author = mysqli_real_escape_string($connection, $_POST['comment_author']);
            $comment_email = mysqli_real_escape_string($connection, $_POST['comment_email']);
            $comment_content = mysqli_real_escape_string($connection, $_POST['comment_content']);
            
            if (!empty($comment_author) && !empty($comment_content) && !empty($comment_email)){
              $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
              $query .= "VALUES($the_post_id, '$comment_author', '$comment_email', '$comment_content', 'Unapproved', now())";

              $insert_comment_query = mysqli_query($connection, $query);
              confirmQuery($insert_comment_query, $query);

              $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $the_post_id";
              $increment_post_comment_count_query = mysqli_query($connection, $query);
              confirmQuery($increment_post_comment_count_query, $query);
            } else {
              echo "<script>alert('Fields cannot be empty')</script>";
            }         
          }
        ?>

      <?php include "includes/footer.php" ?>
