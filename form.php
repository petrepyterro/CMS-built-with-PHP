<?php
  if (isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    echo "Hello " . $username;
    echo "Your password is " . $password;
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
