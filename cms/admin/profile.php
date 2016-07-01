<?php include "includes/admin_header.php" ?>
  <?php 
    if (isset($_SESSION['username'])){
      $username = $_SESSION['username'];
      $query = "SELECT * FROM users WHERE username='$username'";
      $select_user_profile = mysqli_query($connection, $query);
      
      while ($row = mysqli_fetch_assoc($select_user_profile)){
        $the_user_id_profile = $row['user_id'];
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
            <small>Author</small>
          </h1>
          
          <?php 
            if(isset($_POST['update_profile'])){
              $user_firstname = mysqli_real_escape_string($connection, $_POST['user_firstname']);
              $user_lastname = mysqli_real_escape_string($connection, $_POST['user_lastname']);
              $user_role = mysqli_real_escape_string($connection, $_POST['user_role']);

              //$post_image = $_FILES['post_image']['name'];
              //$post_image_temp = $_FILES['post_image']['tmp_name'];

              $username = mysqli_real_escape_string($connection,$_POST['username']);
              $user_email = mysqli_real_escape_string($connection,$_POST['user_email']);
              $user_password = mysqli_real_escape_string($connection,$_POST['user_password']);


              $query = 'UPDATE users SET ';
              $query .= "user_firstname = '$user_firstname', "; 
              $query .= "user_lastname = '$user_lastname', "; 
              $query .= "user_role = '$user_role', ";
              $query .= "username = '$username', "; 
              $query .= "user_email = '$user_email', "; 
              $query .= "user_password = '$user_password' ";
              $query .= "WHERE username='$username'";
              $update_user = mysqli_query($connection, $query);
              confirmQuery($update_user, $query);
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
                <option value="<?php echo $user_role ?>"><?php echo $user_role ?></option>
                <?php 
                  if ($user_role == 'admin'){
                    echo "<option value='subscriber'>Subscriber</option>";
                  } else {
                    echo "<option value='admin'>Admin</option>";
                  }
                ?>
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
              <input type="submit" class="btn btn-primary" name="update_profile" value="Update Profile" />
            </div>
          </form>
        </div>
      </div>
      <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->
  <?php include "includes/admin_footer.php" ?>