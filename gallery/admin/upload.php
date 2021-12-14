<?php include("includes/header.php"); ?>

<?php 
if(!$session->is_signed_in()) {
  // redirect if not signed in
  redirect("login.php");
}
?>

<?php 

$message = '';
// 'submit' refers to the 'name' on the <input name="submit" />
if(isset($_POST['submit'])) {
  $photo = new Photo();
  $photo->title = $_POST['title'];
  $photo->set_file($_FILES['file_upload']);

  if($photo->save()) {
    $message = "Photo uploaded successfully";
  } else {
    $message = join("<br>", $photo->errors);
  }
}

?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <?php include('includes/top_nav.php') ?>
  <?php include('includes/side_nav.php') ?>

  <!-- /.navbar-collapse -->
</nav>

<div id="page-wrapper">

  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">
          Upload
        </h1>

        <ol class="breadcrumb">
          <li>
            <i class="fa fa-dashboard"></i> <a href="index.html">Dashboard</a>
          </li>
          <li class="active">
            <i class="fa fa-file"></i> Blank Page
          </li>
        </ol>

        <?php echo $message ?>
        <div class="col-md-6">
          <!-- empty "action" will default to this file - i.e. upload.php -->
          <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <input type="text" name="title" class="form-control">
            </div>
            <div class="form-group">
              <input type="file" name="file_upload">
            </div>

            <input type="submit" name="submit">
          </form>
        </div>

      </div>
    </div>
    <!-- /.row -->

  </div>
  <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>