<?php 
  include "db.php";
  include "functions.php";
  
  if (isset($_POST['submit'])){
    UpdateTable();
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
        <form action="login_update.php" method="POST">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" />
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" />
          </div>
          
          <div class="form-group">
            <select name="id" id="">
              <?php 
                showAllData();
              ?>
            </select>
          </div>
          <input type="submit" class="btn btn-primary" name="submit" value="Update"/>
        </form>
      </div>
    </div>
  </body>
</html>