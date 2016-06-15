<?php
  if (isset($_POST['submit'])){
    $name = array("Edwin", "Student","Peter", "Samid", "Mohad", "Maria", "Jane", "Tom");
    $minimum = 5;
    $maximum = 10;
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if (strlen($username) < $minimum){
      echo "Username has to be longer than $minimum";
    }
    
    if (strlen($username) > $maximum){
      echo "Username cannot be longer than $maximum";
    }
    
    if(!in_array($username, $name)){
      echo "Sorry you are not allowed to login";
    } else {
      echo "Welcome"; 
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>TODO supply a title</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <form action="form.php" method="POST">
      <input type="text" name="username" placeholder="Enter Username"/><br>
      <input type="password" name="password" placeholder="Enter Password"/><br>
      <input type="submit" name="submit"/>
    </form>
  </body>
</html>
