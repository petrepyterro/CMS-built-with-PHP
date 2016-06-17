<?php print_r($_GET); ?>

<!DOCTYPE html>
<html>
  <head>
    <title>TODO supply a title</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <?php 
      $id=10; 
      $button = "CLICK HERE";
    ?>
    <a href="get.php?id=<?php echo $id; ?>"><?php echo $button; ?></a>  
  </body>
</html>
