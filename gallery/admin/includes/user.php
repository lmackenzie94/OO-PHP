<?php 

class User {

  public $id;
  public $username;
  public $password;
  public $first_name;
  public $last_name;

  public static function find_all_users() {
   return self::find_this_query("SELECT * FROM users");
  }

  public static function find_user_by_id($user_id) {
    $the_result_array = self::find_this_query("SELECT * FROM users WHERE id = $user_id LIMIT 1");

    // return first item in non-empty array OR false
    return !empty($the_result_array) ? array_shift($the_result_array) : false;
  }

  public static function find_this_query($sql) {
    // make database global so we can use it here
    global $database;
    $result_set = $database->query($sql);
    $the_object_array = array();

    while($row = mysqli_fetch_array($result_set)) {
      $the_object_array[] = self::instantiation($row);
    }
    return $the_object_array;
  }

  public static function verify_user($username, $password) {
    global $database;

    // sanitize 
    $username = $database->escape_string($username);
    $password = $database->escape_string($password);

    $sql = "SELECT * FROM users WHERE ";
    $sql .= "username = '{$username}' ";
    $sql .= "AND password = '{$password}' ";
    $sql .= "LIMIT 1";

    $the_result_array = self::find_this_query($sql);
    return !empty($the_result_array) ? array_shift($the_result_array) : false;

  }

  private static function instantiation($the_record) {
    $the_object = new self;

    foreach($the_record as $the_attribute => $value) {
      if($the_object->has_the_attribute($the_attribute)) {
        $the_object->$the_attribute = $value;
      }
    }

    return $the_object;
  }

  private function has_the_attribute($attribute){
    $object_properties = get_object_vars($this);
    return array_key_exists($attribute, $object_properties);
  }

  public function create() {
    global $database;

    // .= is for concatenation 
    $sql = "INSERT INTO users (username, password, first_name, last_name)"; 
    $sql .= "VALUES ('";
    $sql .= $database->escape_string($this->username) . "', '";
    $sql .= $database->escape_string($this->password) . "', '";
    $sql .= $database->escape_string($this->first_name) . "', '";
    $sql .= $database->escape_string($this->last_name) . "')";

    if ($database->query($sql)) {
      $this->id = $database->the_insert_id(); // gets the automatically generated "id"
      print_r($database->the_insert_id());
      return true;
    } else {
      return false;
    }
  }  // create()

  public function update() {
    global $database;

    $sql = "UPDATE users SET "; 
    $sql .= "username= '" . $database->escape_string($this->username) . "', ";
    $sql .= "password= '" . $database->escape_string($this->password) . "', ";
    $sql .= "first_name= '" . $database->escape_string($this->first_name) . "', ";
    $sql .= "last_name= '" . $database->escape_string($this->last_name) . "' ";
    $sql .= " WHERE id= " . $database->escape_string($this->id);

    $database->query($sql);
    // returns true if number of rows affected/updated is 1
    return (mysqli_affected_rows($database->connection) == 1) ? true : false;

  } // update()

  public function delete() {
    global $database;

    $sql = "DELETE FROM users WHERE id=" . $database->escape_string($this->id);
    $sql .= " LIMIT 1";

    $database->query($sql);

    return (mysqli_affected_rows($database->connection) == 1) ? true : false;

  } // delete()
}
?>