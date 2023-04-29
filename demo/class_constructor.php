<?php

class Car
{
  // Adding proprieties
  var $wheel;
  var $hood;
  var $engine;
  var $doors;
  function __construct()
  {
    $this->wheel = 4;
    $this->hood = 1;
    $this->engine = 1;
    $this->doors = 4;
  }
}

$car = new Car();

echo $car->doors;

?>
