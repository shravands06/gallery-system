<?php include("includes/header.php"); ?>
<?php require_once('includes/init.php') ?>
<?php if(!$session->is_signed_in())  {redirect("login.php");} ?>

<?php

$comments = Comment::find_all();
$session->message("");

/*$approve_comment = Comment::approve_comment(23);*/

/*$approved = Comment::find_all_unapproved();

foreach ($approved as $approve) {
 
 echo $approve->id ."<br>";   
}

exit();
*/




  ?>
<script src="js/scripts.js" type="text/javascript"></script>
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

                         <div class="row"> 
                            <div class="col-sm-3"> 
                          <h1 class="">
                             comments  
                          </h1>
                      </div>
                      <div class="pannel panel-default">
                            <div class="container col-sm-4">
                                   <h3></h3>
                              <button type="button" class="btn btn-success" data-toggle="collapse" data-target="#demo">Total approved comments</button>
                              <div id="demo" class="collapse">
                                <h1><?php echo count(Comment::find_all_approved()) ?></h1>
                              </div>        
                        </div>
                        </div>
                         <div class="pannel panel-default">
                        <div class="container col-sm-4">
                              <h3></h3>
                              <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#demo2">Total unapproved comments</button>
                              <div id="demo2" class="collapse">
                                <h1><?php echo count(Comment::find_all_unapproved()) ?></h1>
                              </div>        
                        </div>
                    </div>

                    </div>
                    </div>
                    <br><br> <br><br>
                            <p class="bg-success"> <?php echo $message; ?></p>

                        <div class="col-md-12">
                            
                            <table class="table table-hover">
                               
                                <thead>
                                    <tr>
                                        <th><h3>photo</h3></th>
                                        <th><h3>approval status</h3</th>
                                        <th><h3>Id</h3</th>
                                        <th><h3>Author</h3</th>
                                        <th><h3>Body</h3</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>

                                  

                                    <?php foreach ($comments as $comment) : ?>

                                    <tr>

                                        <td> <?php $photo = Photo::find_by_id($comment->photo_id); ?>

                                            <img  class="thumbnail" style="max-width:200px;" src="<?php echo $photo->picture_path();?>">

                                         </td>

                                         <td > <?php if ($comment->approval == 1) {
                                             echo "<p class='btn btn-primary' style='color:white;'> approved </p><br><br>";
                                              echo "<a class='btn btn-danger' href='approve_comment.php?idd={$comment->id}'> un approve</a>";

                                            }  else {
                                                echo "<p class='btn btn-danger'> unapproved </p><br><br>";
                                                echo "<a class='btn btn-success' href='approve_comment.php?id={$comment->id}'> Approve now </a>";
                                            }

                                         ?>
                                         <?php 
                                                if (isset($_GET['idd'])) {

                                                if (Comment::unapprove_comment($_GET['idd'])) {  

                                                   redirect('approve_comment.php');
                                                } 

                                                } 
                                         ?>

                                         <?php 
                                                if (isset($_GET['id'])) {

                                                if (Comment::approve_comment($_GET['id'])) {  

                                                   redirect('approve_comment.php');
                                                } 

                                                } 
                                         ?>
                                             
                                         </td>


                                        <td><?php echo $comment->id;  ?>
                    
                                        <td><?php echo $comment->author; ?>

                                            <div class="action_link">
                                                <a id="comment-id" href="delete_comment.php?id=<?php echo $comment->id; ?>">Delete</a>
                                            </div>
                                        </td>
                                        <td><?php echo $comment->body; ?></td>
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



        </div>

        

        
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>