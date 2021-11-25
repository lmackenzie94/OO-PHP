<?php include("includes/header.php"); ?>

<?php   if(!$session->is_signed_in())
{
    redirect("login.php");
}?>

<?php
    $photos = Photo::find_all();
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
          Photos
          <small>Subheading</small>
        </h1>

        <div class="col-md-12">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Title</th>
                <th>Description</th>
                <th>Size</th>
                <!-- <th>Comments</th> -->
              </tr>
            </thead>
            <tbody>

              <?php
              foreach ($photos as $photo): 
                  // $photo_comments = Comment::find_the_comments($photo->id);
                  // $number_of_comments = count($photo_comments);
              ?>

              <tr>
                <td>
                  <img class="admin-photo-thumbnail" src="<?php echo $photo->picture_path(); ?>" alt="">
                  <div class="pictures_link">

                    <!-- sends a GET request and passes the photo ID as a param -->
                    <a href="delete_photo.php?id=<?php echo $photo->id ?>">Delete</a>
                    <a href="edit_photo.php?id=<?php echo $photo->id ?>">Edit</a>
                    <a href="">View</a>
                  </div>
                </td>
                <td><?php echo $photo->id;  ?></td>
                <td><?php echo $photo->filename;  ?> </td>
                <td><?php echo $photo->title;     ?> </td>
                <td><?php echo $photo->description; ?> </td>
                <td><?php echo $photo->size;      ?> </td>
                <!-- <td><a href='comment_photo.php?id=<?php echo $photo->id; ?>'><?php echo $number_of_comments; ?></a> </td> -->
              </tr>

              <?php endforeach ?>

            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- /.row -->

  </div>
  <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>