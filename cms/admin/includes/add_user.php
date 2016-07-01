<?php 
  if (isset($_POST['create_user'])){
    $user_firstname = mysqli_real_escape_string($connection, $_POST['user_firstname']);
    $user_lastname = mysqli_real_escape_string($connection, $_POST['user_lastname']);
    $user_role = mysqli_real_escape_string($connection, $_POST['user_role']);
    
    //$post_image = $_FILES['post_image']['name'];
    //$post_image_temp = $_FILES['post_image']['tmp_name'];
    
    $username = mysqli_real_escape_string($connection,$_POST['username']);
    $user_email = mysqli_real_escape_string($connection,$_POST['user_email']);
    $user_password = mysqli_real_escape_string($connection,$_POST['user_password']);
    //$post_date = date('d-m-y');
    
    //move_uploaded_file($post_image_temp, "../images/$post_image");
    
    $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));
    $query = "INSERT INTO users(user_firstname,user_lastname,user_role,username,user_email,user_password) ";
    $query .= "VALUES('$user_firstname', '$user_lastname', '$user_role','$username', '$user_email', '$user_password')";
    
    $create_users_query = mysqli_query($connection, $query);
    confirmQuery($create_users_query, $query);
    
    echo "User Created: ". " " . "<a href='users.php'>View Users</a>";
    
  }
?>
<form action="" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label for="user_firstname">Firstname</label>
    <input type="text" class="form-control" name="user_firstname"/>
  </div>
  <div class="form-group">
    <label for="user_lastname">Lastname</label>
    <input type="text" class="form-control" name="user_lastname"/>
  </div>
  <div class="form-group">
    <select name="user_role" id="">
      <option value="subscriber">Select Options</option>
      <option value="admin">Admin</option>
      <option value="subscriber">Subscriber</option>
    </select>
  </div>
  
  <!--<div class="form-group">
    <label for="post_image">Post Image</label>
    <input type="file" name="post_image"/>
  </div> -->
  
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" name="username"/>
  </div>
  <div class="form-group">
    <label for="user_email">Email</label>
    <input type="email" class="form-control" name="user_email"/>
  </div>
  <div class="form-group">
    <label for="user_password">Password</label>
    <input type="password" class="form-control" name="user_password"/>
  </div>
  <div class="form-group">
    <input type="submit" class="btn btn-primary" name="create_user" value="Add User" />
  </div>
</form>
