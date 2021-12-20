<?php include("includes/header.php"); ?>

<?php   if(!$session->is_signed_in())
{
    redirect("login.php");
}?>

<?php

  if (empty($_GET['id'])) {
    redirect("users.php");
  } 

  $user = User::find_by_id($_GET['id']);


  if (isset($_POST['update'])) {

    if ($user) {
      $user->username = $_POST['username'];
      $user->first_name = $_POST['first_name'];
      $user->last_name = $_POST['last_name'];

      if (!empty($_POST['password'])) {
        $user->password = $_POST['password'];
      }

      if (empty($_FILES['user_image'])) {
        $user->save();
        redirect("users.php");
        $session->message("The user has been updated");


      } else {
        $user->set_file($_FILES['user_image']);
        $user->upload_photo();
        $user->save();
        $session->message("The user has been updated");
        // redirect("edit_user.php?id={$user->id}");
        redirect("users.php");
      }
    }
  }
?>

<?php include('includes/photo_modal.php') ?>

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
          Edit User
        </h1>

        <div class="col-md-6 user_image_box">
          <a href="" data-toggle="modal" data-target="#photo-modal">
            <img class="img-responsive" src="<?php echo $user->image_path_and_placeholder() ?>" alt="" />
          </a>
        </div>

        <!-- empty action will submit to this page -->
        <form action="" method="post" enctype="multipart/form-data">

          <div class="col-md-6">
            <div class="form-group">
              <input type="file" name="user_image">
            </div>


            <div class="form-group">
              <label for="username">Username</label>
              <input id="username" type="text" name="username" class="form-control" value="<?php echo $user->username ?>">
            </div>

            <div class="form-group">
              <label for="first_name">First Name</label>
              <input id="first_name" type="text" name="first_name" class="form-control" value="<?php echo $user->first_name ?>">
            </div>

            <div class="form-group">
              <label for="last_name">Last Name</label>
              <input id="last_name" type="text" name="last_name" class="form-control" value="<?php echo $user->last_name ?>">
            </div>

            <div class="form-group">
              <label for="password">Password</label>
              <input id="password" type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
              <a id="user-id" class="btn btn-danger" href="delete_user.php?id=<?php echo $user->id ?>">Delete</a>
              <input type="submit" name="update" class="btn btn-primary pull-right" value="Update">
            </div>
          </div>
      </div>
    </div>
    <!-- /.row -->

  </div>
  <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>