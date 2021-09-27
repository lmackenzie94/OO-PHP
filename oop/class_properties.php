<?php 

class Cars {

  // when inside a class, we need to explicity tell PHP that we're creating a variable (hence, var)
  var $wheel_count = 4;
  var $door_count = 4;

  function car_detail() {
    return "This car has " . $this->wheel_count . " wheels and " . $this->door_count . " doors.";
  }
}

$bmw = new Cars();

echo $bmw->wheel_count; // 4
echo "<br>";
echo $bmw->door_count = 2; // 2
echo "<br>";
echo $bmw->car_detail(); 

?>