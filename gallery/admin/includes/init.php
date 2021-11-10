<?php 

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
define('SITE_ROOT', DS . 'Applications' . DS . 'XAMPP' . DS . 'xamppfiles' . DS . 'htdocs' . DS . 'php-oop-udemy' . DS . 'gallery' );

define('INCLUDES_PATH', SITE_ROOT . DS . 'admin' . DS . 'includes' );


// could use include but require_once is better (more secure)
require_once('functions.php'); // safety net in case we forget to require_once below
require_once("config.php");
require_once("database.php");
require_once("db_object.php");
require_once("user.php");
require_once("photo.php");
require_once("session.php")

?>