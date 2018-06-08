<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in())  {redirect("login.php");} ?>

<?php

$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

$items_per_page= 5;

$items_total_count = Photo::count_all(); 

$paginate =new paginate($page, $items_per_page, $items_total_count);

$sql= "SELECT * FROM photos ";
$sql .="LIMIT {$items_per_page} ";
$sql .="OFFSET {$paginate->offset()}";

$photos = Photo::find_by_query($sql);



  ?>
        <link rel="stylesheet" type="text/css" href="css/styles.css">
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
                <a class="navbar-brand" href="index.php"> Admin</a>
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
                             PHOTOS
                            <small>uploaded photos</small>

                            <p class="bg-success"><?php echo $message; ?></p>
                        </h1>

                        <div class="col-md-12">
                            
                            <table class="table table-hover">
                               
                                <thead>
                                    <tr>
                                        <th>photo</th>
                                        <th>id</th>
                                        <th>filename</th>
                                        <th>title</th>
                                        <th>size</th>
                                        <th>comments</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($photos as $photo) : ?>

                                    <tr>
                                        <td><img style="width: 200px; border-radius: 5px;" src="<?php echo $photo->picture_path(); ?>">

                                            <div class="action_link">

                                                <a href="delete_photo.php?id=<?php echo $photo->id; ?>">Delete</a>
                                                <a href="edit_photo.php?id=<?php echo $photo->id; ?>">Edit</a>
                                                <a href="../photo.php?id=<?php echo $photo->id; ?>">view</a>
                                                

                                            </div>


                                        </td>
                                        <td><?php echo $photo->id; ?></td>
                                        <td><?php echo $photo->filename; ?></td>
                                        <td><?php echo $photo->title; ?></td>
                                        <td><?php echo $photo->size; ?></td>
                                        <td>
                               
                                        <a class="btn btn-info" href="photo_comment.php?id=<?php echo $photo->id; ?>">view comments:<?php $comments = Comment::find_comment($photo->id); 
                                                echo count($comments); ?></a>

                                        </td>
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
    
            <!-- pagination start -->
         <div class="row">
            
        <ul  class="pagination">

            <?php

            if ($paginate->page_total() > 1) {

                 if ($paginate->has_previous()) {

                  echo " <li style='margin-left: 20px;' class='previous'><a  href='photos.php?page={$paginate->previous()}'>previous</a></li>";  
                
                    } 

                

                for ($i=1; $i <= $paginate->page_total(); $i++) { 
                  
                  if ($i == $paginate->current_page) {
                     
                     echo " <li class='active'><a  href='photos.php?page={$i}'>{$i}</a></li>";
                  }else
                  {
                     echo " <li class=''><a  href='photos.php?page={$i}'>{$i}</a></li>";
                  }
                }

                if ($paginate->has_next()) {

                  echo " <li class='next s'><a href='photos.php?page={$paginate->next()}'>next</a></li>";  
                    
                }

                    }

            ?>
  
        </ul>

        
        <!-- pagination end -->


        </div>


        

        
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>