<!-- "self" and "parent" keywords -->

<?php 

class Cars {
  
  static $wheel_count = 4; 

  static function car_detail() {
    
    return Cars::$wheel_count; // works, but...
    return self::$wheel_count; // ... is better
  }

}

class Trucks extends Cars {
  static function display() {
    echo parent::car_detail();
  }
}

echo Cars::car_detail(); // 4
echo Trucks::display(); // 4

?>