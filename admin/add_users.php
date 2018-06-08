<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in())  {redirect("login.php");} ?>

<?php



    $users = new Users();

    if (isset($_POST['create'])) {

        if ($users) {
   
          $users->username = $_POST['username'];
          $users->first_name = $_POST['first_name'];
          $users->last_name =  $_POST['last_name'];
          $users->password =  $_POST['password'];
          


          $users->set_file($_FILES['user_image']);


          if (($users->save_user_and_image()) && ($users->save())) {

            $session->message("the {$users->username} has been created  with id:{$users->id}");

            redirect("users.php");
          } else{

             $session->message("the {$users->username} was not created try again with different picture ");

             redirect("users.php");

          }

          
         /*if ($users->create()){
            
            $message= '<p style="color:green;">successfully created user</p>';

         } else {

            $message='<p style="color:red;">please enter the user details</p>';
         }
*/
         }
}

   

  ?>


        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">SB Admin</a>
            </div>



            <!-- Top Menu Items -->
            <?php include('includes/top_nav.php') ?>





            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <?php include('includes/side_nav.php') ?>







            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12"> 
                        <h1 class="page-header">
                             new users
                            <small>enter the deatils</small>
                            
                        </h1>

                        <p class=""><?php echo $message; ?></p>

                        <form action="" method="post" enctype="multipart/form-data">
                        <div class="col-md-8">
        
                                <input type="file" name="user_image">
                            
                            
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" >
                            </div>

                            <div class="form-group">
                                <label for="firstname">First Name</label>
                                <input type="text" name="first_name" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="lastname">Last Name</label>
                                <input type="text" name="last_name" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>

                            <div class="form-group">
                                <input type="submit" name="create" class="btn btn-primary">
                            </div>

                        </div>

                        <!-- <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol> -->
                        
                </form>
                    </div>


                        

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>


        

        
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>