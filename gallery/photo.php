<?php include("includes/header.php"); ?>

<?php 

// not sure why I have to include these separately...
require_once(INCLUDES_PATH . DS ."photo.php");
require_once(INCLUDES_PATH . DS ."comment.php");

if(empty($_GET['id'])) {
    redirect("index.php");
}

$photo = Photo::find_by_id($_GET['id']);

if(isset($_POST['submit'])) {
    $author = trim($_POST['author']);
    $body = trim($_POST['body']);

    $new_comment = Comment::create_comment($photo->id, $author, $body);

    if ($new_comment && $new_comment->save()) {
        redirect("photo.php?id={$photo->id}");
    } else {
        $message = "There was a problem saving";
    }
} else {
    $author = "";
    $body = "";
}

$comments = Comment::find_the_comments($photo->id);

?>


<!-- Blog Post Content Column -->
<div class="col-lg-12">

  <!-- Blog Post -->

  <!-- Title -->
  <h1><?php echo $photo->title; ?></h1>

  <!-- Author -->
  <p class="lead">
    by <a href="#">Luke</a>
  </p>

  <hr>

  <!-- Date/Time -->
  <p><span class="glyphicon glyphicon-time"></span> Posted on August 24, 2013 at 9:00 PM</p>

  <hr>

  <!-- Preview Image -->
  <img class="img-responsive" src="admin/<?php echo $photo->picture_path(); ?>" alt="">

  <hr>

  <!-- Post Content -->
  <p class="lead"><?php echo $photo->caption; ?></p>
  <p><?php echo $photo->description; ?></p>

  <hr>

  <!-- Blog Comments -->

  <!-- Comments Form -->
  <div class="well">
    <h4>Leave a Comment:</h4>
    <form role="form" method="post">
      <div class="form-group">
        <label for="author"></label>
        <input type="text" id="author" name="author" class="form-control">
      </div>
      <div class="form-group">
        <textarea name="body" class="form-control" rows="3"></textarea>
      </div>
      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>

  <hr>

  <!-- Posted Comments -->

  <!-- Comment -->
  <?php foreach ($comments as $comment): ?>
  <div class="media">
    <a class="pull-left" href="#">
      <img class="media-object" src="http://placehold.it/64x64" alt="">
    </a>
    <div class="media-body">
      <h4 class="media-heading">
        <?php echo $comment->author; ?>
      </h4>
      <p><?php echo $comment->body; ?></p>
    </div>
  </div>
  <?php endforeach ?>
</div>




<?php include("includes/footer.php"); ?>