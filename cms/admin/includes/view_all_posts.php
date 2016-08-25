<?php 
  if (isset($_POST['checkBoxArray'])){
    foreach($_POST['checkBoxArray'] as $postValueId){
      $bulkOptions = $_POST['bulk_options'];
      switch($bulkOptions){
        case 'published':
          $query = "UPDATE posts SET post_status = '$bulkOptions' WHERE post_id = $postValueId";
          $updateToPublishedStatus = mysqli_query($connection, $query);
          confirmQuery($updateToPublishedStatus, $query);
          break;
        case 'draft':
          $query = "UPDATE posts SET post_status = '$bulkOptions' WHERE post_id = $postValueId";
          $updateToDraftStatus = mysqli_query($connection, $query);
          confirmQuery($updateToDraftStatus, $query);
          break;
        case 'delete':
          $query = "DELETE FROM posts WHERE post_id = $postValueId";
          $deletePosts = mysqli_query($connection, $query);
          confirmQuery($deletePosts, $query);
          header("Location: posts.php");
          break;
        case 'clone':
          $query = "SELECT * FROM posts WHERE post_id=$postValueId";
          $select_post_by_id  = mysqli_query($connection, $query);
          
          if (!$select_post_by_id){
            die("Query failed. " . mysqli_error($connection));
          }
          while($row=  mysqli_fetch_assoc($select_post_by_id)){
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_category_id = $row['post_category_id'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_content = $row['post_content'];
            $post_tags = $row['post_tags'];
            $post_comment_count = 0;
          }
          
          $query = "INSERT INTO posts (post_title, post_author, post_category_id, post_status, post_image, post_content, post_tags, post_comment_count, post_date) ";
          $query .= "VALUES('$post_title', '$post_author', $post_category_id, '$post_status', '$post_image', '$post_content', '$post_tags', $post_comment_count, now())";
          $insert_cloned_post  = mysqli_query($connection, $query);
          if (!$insert_cloned_post){
            die("Query failed. " . mysqli_error($connection));
          }
          break;
        case 'reset_views_count':
          $query = "SELECT post_views_count FROM posts WHERE post_id=$postValueId";
          $select_post_views_count  = mysqli_query($connection, $query);
          
          if (!$select_post_views_count){
            die("Query failed. " . mysqli_error($connection));
          }
          if ($row = mysqli_fetch_array($select_post_views_count)){
            $views_count = $row['post_views_count'];
            if ($views_count !== 0){
              $query = "UPDATE posts SET post_views_count = 0 WHERE post_id=$postValueId";
              $reset_to_0 = mysqli_query($connection, $query);
              if (!$reset_to_0){
                die("Query failed. " . mysqli_error($connection));
              }
            }
            
          };
          
      }
    }
  }
?>
<form action="" method='post'>
  <table class="table table-bordered table-hover">
    <div id="bulkOptionsContainer" class="col-xs-4">
      <select class="form-control" name="bulk_options" id="">
        <option value="">Select Options</option>
        <option value="published">Publish</option>
        <option value="draft">Draft</option>
        <option value="delete">Delete</option>
        <option value="clone">Clone</option>
        <option value="reset_views_count">Reset Views Count</option>
        
      </select>
    </div>
    <div class="col-xs-4">
      <input type="submit" name="submit" class="btn btn-success" value="Apply" />
      <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
    </div>
    <thead>
      <tr>
        <th><input type="checkbox" id="selectAllBoxes"/></th>
        <th>Id</th>
        <th>User</th>
        <th>Title</th>
        <th>Category</th>
        <th>Status</th>
        <th>Image</th>
        <th>Tags</th>
        <th>Comments</th>
        <th>Date</th>
        <th>Views Count</th>
        <th>View Post</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        $query = "SELECT * FROM posts ORDER BY post_id DESC";
        $select_posts = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_posts)){
          $post_id = $row['post_id'];
          $post_title = $row['post_title'];
          $post_author = $row['post_author'];
          $post_user = $row['post_user'];
          $post_category_id = $row['post_category_id'];
          $post_status = $row['post_status'];
          $post_image = $row['post_image'];
          $post_tags = $row['post_tags'];
          $post_comment_count = $row['post_comment_count'];
          $post_date = $row['post_date'];
          $post_views_count = $row['post_views_count'];

          echo "<tr>";
          ?>
            <td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value="<?php echo $post_id; ?>"/></td>
          <?php  
          echo "";
          echo "<td>$post_id</td>";
          
          if(!empty(trim($post_author))){
            echo "<td>$post_author</td>";
          } elseif(!empty(trim($post_user))) {
            echo "<td>$post_user</td>";
          } else {
            echo "<td></td>";
          }
          
          
          echo "<td>$post_title</td>";
          $query = "SELECT * FROM categories WHERE cat_id=$post_category_id ";
          $select_categories_id = mysqli_query($connection, $query);
          while($row = mysqli_fetch_assoc($select_categories_id)){
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            echo "<td>$cat_title</td>";
          }
          echo "<td>$post_status</td>";
          echo "<td><img width='100' src='../images/$post_image' /></td>";
          echo "<td>$post_tags</td>";
          
          $query = "SELECT * FROM comments WHERE comment_post_id= $post_id";
          $send_comment_query = mysqli_query($connection, $query);
          
          $row = mysqli_fetch_array($send_comment_query);
          $comment_id = $row['comment_id'];
          $count_comments = mysqli_num_rows($send_comment_query);
          
          echo "<td><a href='post_comments.php?id=$post_id'>$count_comments</a></td>";
          
          echo "<td>$post_date</td>";
          if ($post_views_count != 0){
            echo "<td><a href='posts.php?reset=$post_id'>$post_views_count</a></td>";
          } else {
            echo "<td>$post_views_count</td>";
          }
          echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
          echo "<td><a href='posts.php?source=edit_post&p_id=$post_id'>Edit</a></td>";
          echo "<td><a onclick=\" javascript: return confirm('Are you sure you want to delete');\" href='posts.php?delete=$post_id'>Delete</a></td>";
          echo "</tr>";
        }
      ?>

    </tbody>
  </table>
</form>

<?php 
  if (isset($_GET['delete'])){
    $the_post_id = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id=$the_post_id";
    $delete_query = mysqli_query($connection, $query);
    
    header("Location: posts.php");
  }
  
  if (isset($_GET['reset'])){
    $the_post_id = $_GET['reset'];
    $query = "UPDATE posts SET post_views_count = 0 WHERE post_id=" . mysqli_real_escape_string($connection, $_GET['reset']) . " ";
    $delete_query = mysqli_query($connection, $query);
    
    header("Location: posts.php");
  }
?>

