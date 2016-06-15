<?php 
  if (isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $connection = mysqli_connect('localhost', 'root', 'mysql', 'cms');
    
    if ($connection){
      echo 'we are connected';
    } else {
      die("database connection failed");
    }
    
    $query = "INSERT INTO users(username, password) ";
    $query .= "VALUES ('$username', '$password')";
    
    $result = mysqli_query($connection, $query);
    
    if (!$result){
      echo "Query failed" . mysqli_error($connection);
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>TODO supply a title</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" 
      integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
      <div class="col-sm-6">
        <form action="login_create.php" method="POST">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" />
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" />
          </div>
          
          <input type="submit" class="btn btn-primary" name="submit" value="Submit"/>
        </form>
      </div>
    </div>
  </body>
</html>
