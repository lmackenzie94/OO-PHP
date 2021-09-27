<?php 

class Cars {

  function greeting() {
    echo 'Hello';
  }
}

$my_methods = get_class_methods('Cars');

  foreach ($my_methods as $method) {
    echo $method . "<br>";
  }
?>