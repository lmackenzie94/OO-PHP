<?php 

class Cars {

  var $wheels = 4;
  function greeting() {
    return 'Hello';
  }
}

class Trucks extends Cars {
  // empty
}

$bmw = new Cars();

$tacoma = new Trucks();
echo $tacoma->wheels; // 4
?>