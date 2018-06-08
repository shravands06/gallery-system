<?php include("includes/header.php"); ?>
<?php include("includes/photo_library_modal.php"); ?>
<?php if(!$session->is_signed_in())  {redirect("login.php");} ?>

<?php

if (empty($_GET['id'])) {

redirect('users.php');
 
} else{

$user = Users::find_by_id($_GET['id']);

    if (isset($_POST['update'])) {

        if ($user) {
   
          $user->username = $_POST['username'];
          $user->first_name = $_POST['first_name'];
          $user->last_name =  $_POST['last_name'];

          if (empty($_FILES['user_image'])) {
              
              $user->save();
              redirect("users.php");
              $session->message("the user has been updated");

          } else{

            $user->set_file($_FILES['user_image']);

            $user->save_user_and_image();
            $user->save();
            $session->message("the user has been updated");

            /*redirect("edit_users.php?id={$user->id}");*/
            redirect("users.php");

          }

          

         


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
                    <form action="" method="post" enctype="multipart/form-data">
                    <div class="col-lg-12"> 
                        <h1 class="page-header">
                             Edit Users
                            <small>edit details</small>
                        </h1>

                        <div class="col-md-12">

                         <div class="col-md-3">
                          <div  class="photo-info-box">
                                <div class="info-box-header">
                                   <h4 class="data" style="text-align: center">Username:<?php echo $user->username; ?> <span id="toggle" class=""></span></h4>
                                </div>
                            <div class="inside">
                              <div class="box-inner">



                                <div class="form-group user_image_box">
                                <a data-toggle="modal" data-target="#photo-library" class="" href="#"><img  class="img-thumbnail" src="<?php echo $user->image_path_and_placeholder();?>"></a>
                            </div>

                   
                                  <p class="data">
                                    First Name: <span ><?php echo $user->first_name; ?></span>
                                  </p>
                                  <p class="data">
                                    Last Name: <span><?php echo $user->last_name; ?></span>
                                  </p>
                              </div>
                              <div class="info-box-footer clearfix">
                                <div class="info-box-delete pull-left">
                                    <a id="user-id" href="delete_users.php?id=<?php echo $user->id; ?>" class="btn btn-danger btn-md ">Delete</a>   
                                </div>
                                <div class="info-box-update pull-right ">
                                    <input type="submit" name="update" value="Update" class="btn btn-primary btn-md ">
                                </div>   
                              </div>
                            </div>          
                        </div>


                        </div>

                          

                        <div class="col-md-6">
        
                            <input type="file" name="user_image"><br>
                            
                            
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" value="<?php echo $user->username; ?>" >
                            </div>

                            <div class="form-group">
                                <label for="firstname">First Name</label>
                                <input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name; ?>">
                            </div>

                            <div class="form-group">
                                <label for="lastname">Last Name</label>
                                <input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name; ?>">
                            </div>


                        </div>

                    </form>


                   
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