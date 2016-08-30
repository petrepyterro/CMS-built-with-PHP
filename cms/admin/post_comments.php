<?php include "includes/admin_header.php" ?>

  <div id="wrapper">

  <!-- Navigation -->
  <?php include "includes/admin_navigation.php" ?>
  <div id="page-wrapper">
    <div class="container-fluid">
      <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">
            Welcome to Comments
            <small>Author</small>
          </h1>
<?php 
  if (isset($_POST['checkBoxArray'])){
    foreach($_POST['checkBoxArray'] as $commentValueId){
      $bulkOptions = escape($_POST['bulk_options']);
      $commentValueId = escape($commentValueId);
      switch($bulkOptions){
        case 'approved':
          $query = "UPDATE comments SET comment_status = '$bulkOptions' WHERE comment_id = $commentValueId";
          $updateToApprovedStatus = mysqli_query($connection, $query);
          confirmQuery($updateToApprovedStatus, $query);
          break;
        case 'unapproved':
          $query = "UPDATE comments SET comment_status = '$bulkOptions' WHERE comment_id = $commentValueId";
          $updateToUnapprovedStatus = mysqli_query($connection, $query);
          confirmQuery($updateToUnapprovedStatus, $query);
          break;
        case 'delete':
          $query = "DELETE FROM comments WHERE comment_id = $commentValueId";
          $deleteComments = mysqli_query($connection, $query);
          confirmQuery($deleteComments, $query);
          header("Location: comments.php");
          break;
      }
    }
  }
?>
<form action="" method="post">
  <table class="table table-bordered table-hover">
    <div id="bulkOptionsContainer" class="col-xs-4">
      <select class="form-control" name="bulk_options" id="">
        <option value="">Select Options</option>
        <option value="approved">Approve</option>
        <option value="unapproved">Unapprove</option>
        <option value="delete">Delete</option>       
      </select>
    </div>
    <div class="col-xs-4">
      <input type="submit" name="submit" class="btn btn-success" value="Apply" />
    </div>
    <thead>
      <tr>
        <th><input type="checkbox" id="selectAllBoxes"/></th>
        <th>Id</th>
        <th>Author</th>
        <th>Comment</th>
        <th>Email</th>
        <th>Status</th>
        <th>In Response to</th>
        <th>Date</th>
        <th>Approve</th>
        <th>Unapprove</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        $query = "SELECT * FROM comments WHERE comment_post_id =" . escape( $_GET['id']);
        $select_comments = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_comments)){
          $comment_id = $row['comment_id'];
          $comment_post_id = $row['comment_post_id'];
          $comment_author = $row['comment_author'];
          $comment_content = $row['comment_content'];
          $comment_email = $row['comment_email'];
          $comment_status = $row['comment_status'];
          $comment_date = $row['comment_date'];

          echo "<tr>";
          ?>
           <td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value="<?php echo $comment_id; ?>"/></td> 
          <?php
          echo "<td>$comment_id</td>";
          echo "<td>$comment_author</td>";
          echo "<td>$comment_content</td>";
          echo "<td>$comment_email</td>";
          /*
          $query = "SELECT * FROM categories WHERE cat_id=$post_category_id ";
          $select_categories_id = mysqli_query($connection, $query);
          while($row = mysqli_fetch_assoc($select_categories_id)){
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            echo "<td>$cat_title</td>";
          }
           * 
           */
          echo "<td>$comment_status</td>";
          $query = "SELECT * FROM posts WHERE post_id=$comment_post_id";
          $select_post_relating_comment_query = mysqli_query($connection, $query);
          while($row = mysqli_fetch_assoc($select_post_relating_comment_query)){
            $comment_post_id = $row['post_id'];
            $comment_post_title = $row['post_title'];
          }
          echo "<td><a href='../post.php?p_id=$comment_post_id'>$comment_post_title</a></td>";
          echo "<td>$comment_date</td>";
          echo "<td><a href='post_comments.php?approved=$comment_id&id=" . $_GET['id'] . "'>Approve</a></td>";
          echo "<td><a href='post_comments.php?unapproved=$comment_id&id=" . $_GET['id'] . "'>Unapprove</a></td>";
          echo "<td><a href='post_comments.php?delete=$comment_id&id=" . $_GET['id'] . "'>Delete</a></td>";
          echo "</tr>";
        }
      ?>

    </tbody>
  </table>
</form>  

<?php 
  if (isset($_GET['delete'])){
    $the_comment_id = escape($_GET['delete']);
    $query = "DELETE FROM comments WHERE comment_id=$the_comment_id";
    $delete_query = mysqli_query($connection, $query);
    
    header("Location: post_comments.php?id=" . $_GET['id']);
  }
  
  if (isset($_GET['unapproved'])){
    $the_comment_id = escape($_GET['unapproved']);
    $query = "UPDATE comments ";
    $query .= "SET comment_status='unapproved' ";
    $query .= "WHERE comment_id=$the_comment_id";
    $delete_query = mysqli_query($connection, $query);
    
    header("Location: post_comments.php?id=" . $_GET['id']);
  }
  
  if (isset($_GET['approved'])){
    $the_comment_id = escape($_GET['approved']);
    $query = "UPDATE comments ";
    $query .= "SET comment_status='approved' ";
    $query .= "WHERE comment_id=$the_comment_id";
    $delete_query = mysqli_query($connection, $query);
    
    header("Location: post_comments.php?id=" . $_GET['id']);
  }
?>

        </div>
      </div>
      <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->
  <?php include "includes/admin_footer.php" ?>
