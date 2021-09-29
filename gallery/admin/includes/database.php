<?php 

require_once("config.php");

class Database {
  
  public $connection;

  function __construct() {
    $this->open_db_connection();
  }

  // open db connection
  public function open_db_connection() {
    // old way: $this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if($this->connection->connect_errno) {
      die("Database connection failed " . $this->connection->connect_error);
    }

    if($this->connection) {
      echo "db connected";
    }
  }

  // query db
  public function query($sql) {
    $result = $this->connection->query($sql);

    return $result;
  }

  private function confirm_query($result) {
    if (!$result) {
      die("Query failed " . $this->connection->error);
    }
  } 

  public function escape_string($string) {
    return mysqli_real_escape_string($this->connection, $string);
  }
}

$database = new Database();
?>