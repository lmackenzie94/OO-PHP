<?php include("includes/init.php"); ?>

<?php 
if(!$session->is_signed_in()) {
  // redirect if not signed in
  redirect("login.php");
}
?>

<?php 

  if (empty($_GET['id'])) {
    // redirect('photos.php'); // doesn't work
    redirect('../photos.php'); // doesn't work

  }

  $photo = Photo::find_by_id($_GET['id']);

  if ($photo) {
    $photo->delete_photo();
  }
  redirect('../photos.php');

?>