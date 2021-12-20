<?php 

class User extends Db_object {

  protected static $db_table = 'users';
  protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name', 'user_image');

  public $id;
  public $username;
  public $password;
  public $first_name;
  public $last_name;
  public $user_image;
  public $image_placeholder = "http://placehold.it/200x200&text=image";

  public $tmp_path;
  public $upload_directory = "images";

  public function upload_photo() {

      if (!empty($this->errors)) {
        return false;
      }
      if(empty($this->user_image) || empty($this->tmp_path)) {
        $this->errors[] = "The file was not available";
        return false;
      }

      // we defined SITE_ROOT in init.php
      $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->user_image;
      
      if(file_exists($target_path)) {
				$this->errors[] = "The file already exists!";
				return false;
			}

			if(move_uploaded_file($this->tmp_path, $target_path)) {
        unset($this->tmp_path);
        return true;	

			} else {

				$this->errors[] = "The file directory probably does not have write permissions";
				return false;
			}

      $this->create();
  }

  public function image_path_and_placeholder() {
    return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory.DS.$this->user_image;
  }
  
  public static function verify_user($username, $password) {
    global $database;

    // sanitize 
    $username = $database->escape_string($username);
    $password = $database->escape_string($password);

    $sql = "SELECT * FROM " . self::$db_table . " WHERE ";
    $sql .= "username = '{$username}' ";
    $sql .= "AND password = '{$password}' ";
    $sql .= "LIMIT 1";

    $the_result_array = self::find_by_query($sql);
    return !empty($the_result_array) ? array_shift($the_result_array) : false;

  }

  public function ajax_save_user_image($user_image, $user_id) {
    global $database;

    $user_image = $database->escape_string($user_image);
    $user_id = $database->escape_string($user_id);

    $this->user_image = $user_image;
    $this->id = $user_id;

    $sql = "UPDATE " . self::$db_table . " SET user_image = '{$this->user_image}' ";  // no need to escape the user_image because it is already escaped
    $sql .= "WHERE id = {$this->id}";
    $update_image = $database->query($sql);

    echo $this->image_path_and_placeholder();
  }

  public function delete_photo() {
    if ($this->delete()) {
      $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->user_image;
      return unlink($target_path) ? true : false;
    } else {
      return false;
    }
  }

}
?>