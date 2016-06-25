<?php 

  if (isset($_GET['u_id'])){
    $the_user_id = $_GET['u_id'];
    $query = "SELECT * FROM users WHERE user_id=$the_user_id";
    $select_user_by_id = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_user_by_id)){
      $user_firstname = $row['user_firstname'];
      $user_lastname = $row['user_lastname'];
      $user_role = $row['user_role'];

      //$post_image = $_FILES['post_image']['name'];
      //$post_image_temp = $_FILES['post_image']['tmp_name'];

      $username = $row['username'];
      $user_email = $row['user_email'];
      $user_password = $row['user_password'];
    }
    
  }
  if(isset($_POST['update_user'])){
    $user_firstname = mysqli_real_escape_string($connection, $_POST['user_firstname']);
    $user_lastname = mysqli_real_escape_string($connection, $_POST['user_lastname']);
    $user_role = mysqli_real_escape_string($connection, $_POST['user_role']);
    
    //$post_image = $_FILES['post_image']['name'];
    //$post_image_temp = $_FILES['post_image']['tmp_name'];
    
    $username = mysqli_real_escape_string($connection,$_POST['username']);
    $user_email = mysqli_real_escape_string($connection,$_POST['user_email']);
    $user_password = mysqli_real_escape_string($connection,$_POST['user_password']);
    
    /*
    $query = 'UPDATE posts SET ';
    $query .= "post_title = '$post_title', "; 
    $query .= "post_category_id = $post_category_id, "; 
    $query .= "post_date = now(), ";
    $query .= "post_author = '$post_author', "; 
    $query .= "post_status = '$post_status', "; 
    $query .= "post_tags = '$post_tags', "; 
    $query .= "post_content = '$post_content', "; 
    $query .= "post_image = '$post_image' "; 
    $query .= "WHERE post_id = $the_post_id";
    
    $update_post = mysqli_query($connection, $query);
    confirmQuery($update_post, $query);
     * 
     */
  }
     
?>
<form action="" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="user_firstname">Firstname</label>
    <input type="text" class="form-control" value="<?php echo $user_firstname ?>" name="user_firstname"/>
  </div>
  <div class="form-group">
    <label for="user_lastname">Lastname</label>
    <input type="text" class="form-control" value="<?php echo $user_lastname ?>" name="user_lastname"/>
  </div>
  <div class="form-group">
    <select name="user_role" id="">
      <option value="subscriber"><?php echo $user_role ?></option>
      <option value="admin">Admin</option>
      <option value="subscriber">Subscriber</option>
    </select>
  </div>
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" value="<?php echo $username ?>" name="username"/>
  </div>
  <div class="form-group">
    <label for="user_email">Email</label>
    <input type="email" class="form-control" value="<?php echo $user_email ?>" name="user_email"/>
  </div>
  <div class="form-group">
    <label for="user_password">Password</label>
    <input type="password" class="form-control" name="user_password"/>
  </div>
  <div class="form-group">
    <input type="submit" class="btn btn-primary" name="update_user" value="Update User" />
  </div>
</form>