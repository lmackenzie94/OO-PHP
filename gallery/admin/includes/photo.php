<?php 

class Photo extends Db_object {

  protected static $db_table = 'photos';

  // you removed 'id' from this array because it was causing an error
  protected static $db_table_fields = array('title', 'caption', 'description', 'filename', 'alternate_text', 'type', 'size');

  public $id;
  public $title;
  public $caption;
  public $description;
  public $filename;
  public $alternate_text;
  public $type;
  public $size;

  public $tmp_path;
  public $upload_directory = "images";

   // $file = $_FILES['uploaded_file']
  public function set_file($file) {

    if(empty($file) || !$file || !is_array($file)) {

      $this->errors[] = "There was no uploaded file here!";
      return false;

    } elseif ($file['error'] != 0) {

      $this->errors[] = $this->upload_errors_array[$file['error']];
      return false;

    } else {

      $this->filename = basename($file['name']);
      $this->tmp_path = $file['tmp_name'];
      $this->type = $file['type'];
      $this->size = $file['size'];
    }
  }

  public function picture_path() {
    return $this->upload_directory.DS.$this->filename;
  }

  public function save() {
    if($this->id) {
      $this->update();
    } else {

      if (!empty($this->errors)) {
        return false;
      }
      if(empty($this->filename) || empty($this->tmp_path)) {
        $this->errors[] = "The file was not available";
        return false;
      }

      // we defined SITE_ROOT in init.php
      $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->filename;
      
      if(file_exists($target_path)) {
				$this->errors[] = "The file already exists!";
				return false;
			}

			if(move_uploaded_file($this->tmp_path, $target_path)) {

				if($this->create()) {

					unset($this->tmp_path);
					return true;
				}

			} else {

				$this->errors[] = "The file directory probably does not have write permissions";
				return false;
			}

      $this->create();
    }
  }

  public function delete_photo() {
    if ($this->delete()) {
      $target_path = SITE_ROOT . DS . 'admin' . DS . $this->picture_path();
      return unlink($target_path) ? true : false;
    } else {
      return false;
    }
  }

  public static function display_sidebar_data($photo_id) {
    $photo = Photo::find_by_id($photo_id);
    $output = "<a class='thumbnail' href='#'><img width='100' src='{$photo->picture_path()}'></a>";
    $output .= "<p>{$photo->filename}</p>";
    $output .= "<p>{$photo->type}</p>";
    $output .= "<p>{$photo->size}</p>";

    echo $output;
  }
} // end of class

?>