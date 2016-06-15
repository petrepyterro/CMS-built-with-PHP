<!DOCTYPE html>
<html>
  <head>
    <title>TODO supply a title</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <?php 
      function init(){
        say_Something();
        echo "<br>";
        calculate();
      }
      function calculate(){
        echo 456 + 789;
      }
      function say_Something(){
        echo "Hello student";
      }
      
      init();
    ?>
  </body>
</html>