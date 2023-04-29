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

?>