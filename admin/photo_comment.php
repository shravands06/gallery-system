<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in())  {redirect("login.php");} ?>

<?php

if (empty($_GET['id'])) {
   
   redirect('photos.php');
}

$comments = Comment::find_comment($_GET['id']);

$count = count($comments);

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

                    <?php  $photo = Photo::find_by_id($_GET['id']); ?>
                    <div class="col-lg-12"> 
                        <h1 class="page-header">
                             comments
                          <small> <a href="../photo.php?id=<?php echo $photo->id; ?>" class="btn btn-primary">add comments</a></small>
                        </h1>

                       

                        <div class="col-md-12">

                            <div class="col-md-3">
                                
                        
                        <img class="thumbnail" style="width: 250px;" src="<?php echo $photo->picture_path(); ?>">
                            

                        <div>
                            
                            <p class="btn-lg btn-info" style="font-style:15px;">No of comments:<?Php echo $count; ?></p>
                        </div>
                            </div>

                       

                            <div class="col-md-9">
                            <table class="table table-hover">
                               
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Author</th>
                                        <th>Body</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>

                                  

                                              <?php foreach ($comments as $comment) : ?>

                                    <tr>
                                        <td><?php echo $comment->id; ?></td>

                    
                                        <td><?php echo $comment->author; ?>

                                            <div class="action_link">
                                                <a href="delete_comment_photo.php?id=<?php echo $comment->id; ?>">Delete</a>
                                            </div>
                                        </td>
                                        <td><?php echo $comment->body; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
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
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>


        

        
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>