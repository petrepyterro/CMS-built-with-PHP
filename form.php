<?php
  if (isset($_POST['submit'])){
    echo "yes it works";
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
      <input type="text" placeholder="Enter Username"/><br>
      <input type="password" placeholder="Enter Password"/><br>
      <input type="submit" name="submit"/>
    </form>
  </body>
</html>
