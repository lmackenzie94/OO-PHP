<?php 

class Cars {

  private $door_count = 4; 

  function get_values() {
    echo $this->door_count;
  }

  function set_values() {
    $this->door_count = 10;
  }
}

$bmw = new Cars();

// echo $bmw->door_count; // Error 

$bmw->get_values(); // 4

$bmw->set_values(); 

$bmw->get_values(); // 10


?>