<!-- 
Static Modifier / Static Property:

- do NOT require an instance to be called (i.e. do not attach to the instance like regular properties do)

-->
<?php 

class Cars {
  
  static $wheel_count = 4; 
  static $door_count = 4; 

  static function car_detail() {
    // instead of $this-> use Cars::$
    // because $this refers to the instance which no longer exists
    // all these properties must also be set to "static"
    echo Cars::$wheel_count;
    echo Cars::$door_count;
  }

}

echo Cars::$door_count; // 4
Cars::car_detail();

$bmw = new Cars();
echo $bmw->door_count; // Error (undefined property)
?>