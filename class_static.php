<?php

class Car {

  static $wheels = 4;
  var $hood = 1;
  var $engine = 1;
  var $doors = 4;
  
  static function MoveWheels(){
    Car::$wheels = 10;
  }
  
}

Car::MoveWheels();
echo Car::$wheels;
