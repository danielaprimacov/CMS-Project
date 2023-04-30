<?php

class Car
{
  // Adding proprieties
  static $wheel = 4;
  static $hood = 1;
  public static function showHood()
  {
    echo Car::$hood = 1; // this is used for refering to class inside it
  }
}

$car = new Car(); // create an object -- instance of class Car

echo Car::$wheel . "<br>"; // refer to a static variable

Car::showHood();

?>