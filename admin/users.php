<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in())  {redirect("login.php");} ?>

<?php
$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

$items_per_page= 8;

$items_total_count = Users::count_all(); 

$paginate =new paginate($page, $items_per_page, $items_total_count);

$sql= "SELECT * FROM users ";
$sql .="LIMIT {$items_per_page} ";
$sql .="OFFSET {$paginate->offset()}";

$Users = Users::find_by_query($sql);




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
                <a class="navbar-brand" href="index.php">Admin</a>
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
                             Users
                          <small> <a href="add_users.php" class="btn btn-primary">add users</a></small>
                        </h1>
                        <p class="bg-success"><?php echo $message; ?></p>



                        <div class="col-md-12">
                            
                            <table class="table table-hover">
                               
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Photo</th>
                                        <th>username</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                    </tr>
                                </thead>
                                <tbody>

                                  

                                    <?php foreach ($Users as $User) : ?>

                                    <tr>
                                        <td><?php echo $User->id; ?></td>

                                        <td><img class="user_image" src="<?php echo $User->image_path_and_placeholder(); ?>"> </td>
                                         <td><?php echo $User->username; ?>

                                            <div class="action_link">
                                                <a href="delete_Users.php?id=<?php echo $User->id; ?>">Delete</a>
                                                <a href="edit_Users.php?id=<?php echo $User->id; ?>">Edit</a>
                                            </div>
                                        </td>
                                        <td><?php echo $User->first_name; ?></td>
                                        <td><?php echo $User->last_name; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol> -->
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>

      
        <!-- pagination start -->
         <div class="row">
            
        <ul class="pagination">

            <?php

            if ($paginate->page_total() > 1) {

                 if ($paginate->has_previous()) {

                  echo " <li style='margin-left:20px;' class='previous'><a  href='users.php?page={$paginate->previous()}'>previous</a></li>";  
                
                    } 

                

                for ($i=1; $i <= $paginate->page_total(); $i++) { 
                  
                  if ($i == $paginate->current_page) {
                     
                     echo " <li class='active'><a  href='users.php?page={$i}'>{$i}</a></li>";
                  }else
                  {
                     echo " <li class=''><a  href='users.php?page={$i}'>{$i}</a></li>";
                  }
                }

                if ($paginate->has_next()) {

                  echo " <li class='next s'><a href='users.php?page={$paginate->next()}'>next</a></li>";  
                    
                }

                    }

            ?>
  
        </ul>

        </div>
        <!-- pagination end -->



        

        
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>