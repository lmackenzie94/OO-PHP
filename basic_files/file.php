<?php 

// magic constants

echo __FILE__ . "<br>"; // /Applications/XAMPP/xamppfiles/htdocs/php-oop-udemy/basic_files/file.php
echo __DIR__ . "<br>"; // Applications/XAMPP/xamppfiles/htdocs/php-oop-udemy/basic_files
echo __LINE__ . "<br>"; // 7

echo file_exists(__FILE__); // 1 (true)
echo is_file(__FILE__); // 1 (true)
echo is_dir(__DIR__); // 1 (true)

?>