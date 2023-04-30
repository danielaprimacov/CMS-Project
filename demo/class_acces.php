<?php

class Car
{
  // Adding proprieties
  public $wheel = 4; // same as var
  protected $hood = 1; // avaible to this class or any subclasses
  private $engine = 1; // avaible to this class (extends no avaible)
  var $doors = 4;
  function showProperty()
  {
    echo $this->engine; // 'this' is used for refering to class inside it
  }

}

$car = new Car(); // create an object -- instance of class Car

echo $car->showProperty() . "<br>";

$semi = new Semi();

class Semi extends Car {
  function showProperty()
  {
    echo $this->hood;
  }
}

echo $semi->showProperty();

?>