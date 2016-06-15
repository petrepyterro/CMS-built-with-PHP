<?php 

  $connection = mysqli_connect('localhost', 'root', 'mysql', 'cms');

  if ($connection){
    echo 'we are connected';
  } else {
    die("database connection failed");
  }

  $query = "SELECT * FROM users";

  $result = mysqli_query($connection, $query);

  if (!$result){
    echo "Query failed" . mysqli_error($connection);
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
        <?php 
          while($row = mysqli_fetch_assoc($result)){ 
          ?>
            <pre>
              <?php print_r($row); ?>
            </pre>
          <?php
          }
        ?>
      </div>
    </div>
  </body>
</html>