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
      // $user = new User();
      // $user->username = "Example_username";
      // $user->password = "Example_password";
      // $user->first_name = "Example_first_name";
      // $user->last_name = "Example_last_name";

      // $user->create();

      // UPDATE USER 5
      // $user = User::find_user_by_id(5);
      // $user->last_name = "WILLIAMS";
      // $user->update();

      $user = User::find_user_by_id(5);
      // print_r($user);
      $user->delete();

      $users = User::find_all_users();
      foreach($users as $user) {
        echo $user->username . "<br>";
      }

      $found_user = User::find_user_by_id(2);
      echo $found_user->username;
        
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