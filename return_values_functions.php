<!DOCTYPE html>
<html>
  <head>
    <title>TODO supply a title</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <?php 
      function addNumbers($number1, $number2){
        $sum = $number1 + $number2;
        return $sum;
      }
      
      $result = addNumbers(34, 64);
      echo $result . "<br>";
      $result = addNumbers(100, $result);
      echo $result;
    ?>
  </body>
</html>