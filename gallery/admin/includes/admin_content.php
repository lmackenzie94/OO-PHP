<div class="container-fluid">

  <!-- Page Heading -->
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">
        Admin
        <small>Dashboard</small>
      </h1>

      <?php 
      $view_count = $session->count;
      $photo_count = Photo::count_all();
      $user_count = User::count_all();
      $comment_count = Comment::count_all();
      ?>

      <div class="row">
        <div class="col-lg-3 col-md-6">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-3">
                  <i class="fa fa-users fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                  <div class="huge"><?php echo $view_count ?></div>
                  <div>New Views</div>
                </div>
              </div>
            </div>
            <a href="#">
              <div class="panel-footer">
                <span class="pull-left">View Details</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
              </div>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="panel panel-green">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-3">
                  <i class="fa fa-photo fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                  <div class="huge"><?php echo $photo_count; ?></div>
                  <div>Photos</div>
                </div>
              </div>
            </div>
            <a href="photos.php">
              <div class="panel-footer">
                <span class="pull-left">Total Photos in Gallery</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
              </div>
            </a>
          </div>
        </div>


        <div class="col-lg-3 col-md-6">
          <div class="panel panel-yellow">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-3">
                  <i class="fa fa-user fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                  <div class="huge">
                    <?php echo $user_count; ?>
                  </div>

                  <div>Users</div>
                </div>
              </div>
            </div>
            <a href="users.php">
              <div class="panel-footer">
                <span class="pull-left">Total Users</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
              </div>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="panel panel-red">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-3">
                  <i class="fa fa-support fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                  <div class="huge"><?php echo $comment_count; ?></div>
                  <div>Comments</div>
                </div>
              </div>
            </div>
            <a href="comments.php">
              <div class="panel-footer">
                <span class="pull-left">Total Comments</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
              </div>
            </a>
          </div>
        </div>


      </div>
      <!--First Row-->

      <div class="row">

        <!-- google chart -->
        <script type="text/javascript">
        google.charts.load('current', {
          'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

          var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Views', <?php echo $view_count; ?>],
            ['Photos', <?php echo $photo_count; ?>],
            ['Users', <?php echo $user_count; ?>],
            ['Comments', <?php echo $comment_count; ?>]
          ]);

          var options = {
            legend: 'none',
            pieSliceText: 'label',
            backgroundColor: 'transparent',
            title: 'Stats'
          };

          var chart = new google.visualization.PieChart(document.getElementById('piechart'));

          chart.draw(data, options);
        }
        </script>

        <div id="piechart" style="width: 900px; height: 500px;"></div>
      </div>
      <?php 

      // ADD NEW USER (will add on every page refresh)
      // $user = new User();
      // $user->username = "Example_username_5";
      // $user->password = "Example_password_5";
      // $user->first_name = "Example_first_name_5";
      // $user->last_name = "Example_last_name_5";

      // $user->save();

      // UPDATE USER 4
      // $user = User::find_by_id(4);
      // $user->last_name = "BLAHHH";
      // $user->save();

      // $user = User::find_by_id(2);
      // print_r($user);
      // $user->delete();


      // $users = User::find_all();
      // foreach($users as $user) {
      //   echo $user->username . "<br>";
      // }

      // echo INCLUDES_PATH;

      // $photos = Photo::find_all();
      // foreach($photos as $photo) {
      //   echo $photo->title . "<br>";
      // }

      // $found_user = User::find_by_id(2);
      // echo $found_user->username;
        
      ?>


    </div>
  </div>
  <!-- /.row -->

</div>
<!-- /.container-fluid -->