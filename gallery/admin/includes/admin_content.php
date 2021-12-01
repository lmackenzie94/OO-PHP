<div class="container-fluid">

  <!-- Page Heading -->
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">
        Admin
        <small>Subheading</small>
      </h1>

      <?php 

      // ADD NEW USER (will add on every page refresh)
      $user = new User();
      $user->username = "Example_username_5";
      $user->password = "Example_password_5";
      $user->first_name = "Example_first_name_5";
      $user->last_name = "Example_last_name_5";

      // $user->save();

      // UPDATE USER 4
      // $user = User::find_by_id(4);
      // $user->last_name = "BLAHHH";
      // $user->save();

      // $user = User::find_by_id(2);
      // print_r($user);
      // $user->delete();

      $users = User::find_all();
      foreach($users as $user) {
        echo $user->username . "<br>";
      }

      echo INCLUDES_PATH;

      $photos = Photo::find_all();
      foreach($photos as $photo) {
        echo $photo->title . "<br>";
      }

      // $found_user = User::find_by_id(2);
      // echo $found_user->username;
        
      ?>
      <ol class="breadcrumb">
        <li>
          <i class="fa fa-dashboard"></i> <a href="index.html">Dashboard</a>
        </li>
        <li class="active">
          <i class="fa fa-file"></i> Blank Page
        </li>
      </ol>
    </div>
  </div>
  <!-- /.row -->

</div>
<!-- /.container-fluid -->