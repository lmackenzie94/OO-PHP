<?php 

// $_FILES['file_name'] has 5 keys (name, type, size, tmp_name, error)
if (isset($_POST['submitted_yo'])) {
  echo "<pre>";
  print_r($_FILES['the_file']);
  echo "</pre>";

  $upload_errors = array(
    0=>"There is no error, the file uploaded with success",
    1=>"The uploaded file exceeds the upload_max_filesize directive in php.ini",
    2=>"The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form",
    3=>"The uploaded file was only partially uploaded",
    4=>"No file was uploaded",
    6=>"Missing a temporary folder"
  );

  $temp_name = $_FILES['the_file']['tmp_name'];
  $file_name = $_FILES['the_file']['name'];
  $upload_dir = "uploads"; // make sure this folder is writable (i.e. check permissions)

  // returns true if it works
  if (move_uploaded_file($temp_name, $upload_dir . "/" . $file_name)) {
    $the_message = "File uploaded successfully"; 
  } else {
    $the_error = $_FILES['the_file']['error'];
    $the_message = $upload_errors[$the_error];
  }
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <!--
  When you make a POST request, you have to encode the data that forms the body of the request in some way.
  use multipart/form-data when your form includes any <input type="file"> elements 
  -->
  <form action="upload.php" enctype="multipart/form-data" method="post">
    <h2>
      <?php 
        if (!empty($upload_errors)) {
          echo $the_message;
        }
      ?>
    </h2>
    <input type="file" name="the_file">
    <!-- initially, after pressing "Submit" the file gets stored in a temporary location on the server -->
    <!-- then we have to move it to where we want it -->
    <input type="submit" name="submitted_yo">
  </form>
</body>

</html>