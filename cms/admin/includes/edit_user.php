<?php 

  if (isset($_GET['u_id'])){
    $the_user_id = escape($_GET['u_id']);
    $query = "SELECT * FROM users WHERE user_id=$the_user_id";
    $select_user_by_id = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_user_by_id)){
      $db_user_firstname = $row['user_firstname'];
      $db_user_lastname = $row['user_lastname'];
      $db_user_role = $row['user_role'];

      //$post_image = $_FILES['post_image']['name'];
      //$post_image_temp = $_FILES['post_image']['tmp_name'];

      $db_username = $row['username'];
      $db_user_email = $row['user_email'];
    }
    
  
    if(isset($_POST['update_user'])){
      $user_firstname = escape( $_POST['user_firstname']);
      $user_lastname = escape( $_POST['user_lastname']);
      $user_role = escape( $_POST['user_role']);

      //$post_image = $_FILES['post_image']['name'];
      //$post_image_temp = $_FILES['post_image']['tmp_name'];

      $username = escape($_POST['username']);
      $user_email = escape($_POST['user_email']);
      $user_password = escape($_POST['user_password']);

      if(!empty($user_password)){
        $user_password = escape($_POST['user_password']);
        $query_password = "SELECT  user_password FROM users WHERE user_id = $the_user_id";
        $getUserPassword = mysqli_query($connection, $query_password);
        confirmQuery($getUserPassword, $query_password);

        $row = mysqli_fetch_array($getUserPassword);
        $db_user_password = $row['user_password'];
        if(!password_verify($user_password, $db_user_password)){
          $user_hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
        } else {
          $user_hashed_password = $db_user_password;
        }
      }



      $query = 'UPDATE users SET ';
      $query .= "user_firstname = '$user_firstname', "; 
      $query .= "user_lastname = '$user_lastname', "; 
      $query .= "user_role = '$user_role', ";
      $query .= "username = '$username', "; 
      $query .= "user_email = '$user_email', "; 
      $query .= "user_password = '$user_hashed_password' ";
      $query .= "WHERE user_id=$the_user_id";
      $update_user = mysqli_query($connection, $query);
      confirmQuery($update_user, $query);

      echo "User Updated " . "<a href='users.php'>View Users?</a>";
    }
  } else {
    header("Location: index.php");
  }
     
?>
<form action="" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="user_firstname">Firstname</label>
    <input type="text" class="form-control" value="<?php echo $db_user_firstname ?>" name="user_firstname"/>
  </div>
  <div class="form-group">
    <label for="user_lastname">Lastname</label>
    <input type="text" class="form-control" value="<?php echo $db_user_lastname ?>" name="user_lastname"/>
  </div>
  <div class="form-group">
    <select name="user_role" id="">
      <option value="<?php echo $db_user_role ?>"><?php echo $db_user_role ?></option>
      <?php 
        if ($db_user_role == 'admin'){
          echo "<option value='subscriber'>Subscriber</option>";
        } else {
          echo "<option value='admin'>Admin</option>";
        }
      ?>
    </select>
  </div>
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" value="<?php echo $db_username ?>" name="username"/>
  </div>
  <div class="form-group">
    <label for="user_email">Email</label>
    <input type="email" class="form-control" value="<?php echo $db_user_email ?>" name="user_email"/>
  </div>
  <div class="form-group">
    <label for="user_password">Password</label>
    <input type="password" class="form-control" name="user_password"/>
  </div>
  <div class="form-group">
    <input type="submit" class="btn btn-primary" name="update_user" value="Update User" />
  </div>
</form>