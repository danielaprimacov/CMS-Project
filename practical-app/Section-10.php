<?php

// create class Dog
class Dog {

  var $name = "Bax";
  var $eye_color = "brown";
  var $flur_color = "white, brown, black";  

  // method to show all properties for class
  function ShowAll() {

    echo "Dog called " . $this->name . ".<br>";
    echo "Has " . $this->eye_color . " eyes ";
    echo "and has a " . $this->flur_color . " flur.";

  }

}

// create an object and call it pitbul
$pitbull = new Dog();

// call the method ShowAll
$pitbull->ShowAll();

?>