<?php include("includes/init.php"); ?>

<?php 
if(!$session->is_signed_in()) {
  // redirect if not signed in
  redirect("login.php");
}
?>

<?php 

  if (empty($_GET['id'])) {
    redirect('users.php'); 
  }

  $user = User::find_by_id($_GET['id']);

  if ($user) {
    $session->message("The user {$user->username} has been deleted.");
    $user->delete_photo();
  }
  redirect('users.php');

?>