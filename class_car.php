<?php

class Car {

    function MoveWheels(){
      echo "Wheels Move";
    }
}

/*
if (method_exists("Car", "MoveWheels")){
  echo "Ya";
}
 */

$bmw = new Car();
$mercedes_benz = new Car();

$bmw->MoveWheels();
