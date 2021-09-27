<?php 

class Cars {
  
  public $wheel_count; 
  static $door_count = 4;
 
  // gets called automatically on instantiation
  function __construct($wheels = 4)
  {
    $this->wheel_count = $wheels;
    echo self::$door_count++; // will increment for every instance
  }

  // very rarely used
  // will be called as soon as there are no other references to a particular object, 
  // or in any order during the shutdown sequence.
  function __destruct()
  {
    
  }
}

// if no parameters, don't need parentheses
$bmw = new Cars; // door_count = 4
$audi = new Cars(2); // door_count = 5

echo $bmw->wheel_count; // 4
echo $audi->wheel_count; // 2



?>