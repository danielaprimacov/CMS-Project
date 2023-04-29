<?php

class Car
{
  // Adding proprieties
  var $wheel = 4;
  var $hood = 1;
  var $engine = 1;
  var $doors = 4;
  function moveWheels()
  {
    $this->wheel = 4; // this is used for refering to class inside it
  }

  function createDoors() {
    $this->doors = 6;
  }
}

$car = new Car(); // create an object -- instance of class Car
$truck = new Car();

$car->moveWheels();
echo "This car has " . $car->wheel ." wheels" . "<br>";

echo "Truck has " . $truck->wheel = 10 . " wheels" . "<br>";

$truck->createDoors();

echo "Truck has " . $truck->doors . " doors";

?>
