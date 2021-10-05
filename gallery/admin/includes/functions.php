<?php 

// OLD (__autoload is deprecated)
// function __autoload($class) {
//   // scans our application and finds any undeclared objects
//   $class = strtolower($class);
//   $the_path = "includes/{$class}.php";

//   if (file_exists($the_path)) {
//     require_once($the_path);
//   } else {
//     die("This file named {$class}.php was not found...");
//   }
// }

// NEW, using spl_autoload_register
function classAutoLoader($class) { // can be named anything
    // scans our application and finds any undeclared objects
    $class = strtolower($class);
    $the_path = "includes/{$class}.php";
  
    if (is_file($the_path) && !class_exists($class)) {
      include $the_path;
    }
}

spl_autoload_register('classAutoLoader');
?>