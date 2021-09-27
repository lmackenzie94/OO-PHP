<!-- 
Access Control Modifiers:

public - the property or method can be accessed from everywhere. (default)
protected - the property or method can be accessed within the class and by classes derived from that class
private - the property or method can ONLY be accessed within the class
-->
<?php 

class Cars {

  // when inside a class, we need to explicity tell PHP that we're creating a variable (hence, var)
  // var $wheel_count = 4;
  
  public $wheel_count = 4; // everywhere
  private $door_count = 4; // only inside this class
  protected $seat_count = 2; // only inside this class + any subclasses

  function car_detail() {
    echo $this->wheel_count;
    echo $this->door_count;
    echo $this->seat_count;
  }
}

$bmw = new Cars();

echo $bmw->wheel_count; // 4
echo $bmw->door_count; // Error 
echo $bmw->seat_count; // Error

$bmw->car_detail(); // 4 4 2

?>