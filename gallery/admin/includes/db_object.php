<?php 

class Db_object {

  public static function find_all() {
    return static::find_by_query("SELECT * FROM " . static::$db_table . " ");
  }
 
  public static function find_by_id($user_id) {
    $the_result_array = static::find_by_query("SELECT * FROM " . static::$db_table . " WHERE id = $user_id LIMIT 1");

    // return first item in non-empty array OR false
    return !empty($the_result_array) ? array_shift($the_result_array) : false;
   }


  public static function find_by_query($sql) {
    // make database global so we can use it here
    global $database;
    $result_set = $database->query($sql);
    $the_object_array = array();

    while($row = mysqli_fetch_array($result_set)) {
      $the_object_array[] = static::instantiation($row);
    }
    return $the_object_array;
  }

  private static function instantiation($the_record) {
    $calling_class = get_called_class();
    $the_object = new $calling_class;

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

  protected function properties() {
    // return get_object_vars($this); // this isn't ideal because it grabs 'id' and 'db_table' which we don't need
    $properties = array();

    foreach (static::$db_table_fields as $db_field) {
      if(property_exists($this, $db_field)) {
        $properties[$db_field] = $this->$db_field;
      }
    }

    // print_r($properties); // Array ( [username] => Example_username_3 [password] => Example_password_3 [first_name] => Example_first_name_3 [last_name] => Example_last_name_3 )

    return $properties;
  } // properties()

  protected function clean_properties() {
    global $database;

    $clean_properties = array();

    foreach ($this->properties() as $key => $value) {
      $clean_properties[$key] = $database->escape_string($value);
    }

    return $clean_properties;
  }

  public function save() {
    return isset($this->id) ? $this->update() : $this->create();
  }

  public function create() {
    global $database;
    $properties = $this->clean_properties();

    // .= is for concatenation 
    $sql = "INSERT INTO " . static::$db_table . " (" . implode(",", array_keys($properties)) . ")"; 
    $sql .= "VALUES ('". implode("','", array_values($properties)) ."')";

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
    $properties = $this->clean_properties();

    $properties_pairs = array();

    foreach ($properties as $key => $value) {
      $properties_pairs[] = "{$key}='{$value}'";
    }


    $sql = "UPDATE " . static::$db_table . " SET "; 
    $sql .= implode(", ", $properties_pairs);
    // is short for ...
      // $sql .= "username= '" . $database->escape_string($this->username) . "', ";
      // $sql .= "password= '" . $database->escape_string($this->password) . "', ";
      // $sql .= "first_name= '" . $database->escape_string($this->first_name) . "', ";
      // $sql .= "last_name= '" . $database->escape_string($this->last_name) . "' ";
    $sql .= " WHERE id= " . $database->escape_string($this->id);

    $database->query($sql);
    // returns true if number of rows affected/updated is 1
    return (mysqli_affected_rows($database->connection) == 1) ? true : false;

  } // update()

  public function delete() {
    global $database;

    $sql = "DELETE FROM " . static::$db_table . " WHERE id=" . $database->escape_string($this->id);
    $sql .= " LIMIT 1";

    $database->query($sql);

    return (mysqli_affected_rows($database->connection) == 1) ? true : false;

  } // delete()
  
}

?>