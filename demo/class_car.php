<?php

class Car
{
  function moveWheels()
  {
    echo "Wheels move!";
  }
}

if (method_exists("Car", "moveWheels")) {
  echo "Yes!";
}

$car = new Car(); // create an object -- instance of class Car

$car->moveWheels();


?>
