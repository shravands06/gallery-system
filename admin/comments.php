<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in())  {redirect("login.php");} ?>

<?php

/*$approved = Comment::find_all_unapproved();

foreach ($approved as $approve) {
 
 echo $approve->id ."<br>";   
}

exit();
*/
$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

$items_per_page= 4;

$items_total_count = Comment::count_all(); 

$paginate =new paginate($page, $items_per_page, $items_total_count);

$sql= "SELECT * FROM comments ";
$sql .="LIMIT {$items_per_page} ";
$sql .="OFFSET {$paginate->offset()}";

$comments = Comment::find_by_query($sql);

/*$comments = Comment::find_all();*/

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
                             comments
                          <a class="btn btn-primary" href="approve_comment.php">validate comments </a>
                        </h1>

                        <p class="bg-success"><?php echo $message; ?></p>



                        <div class="col-md-12">
                            
                            <table class="table table-hover">
                               
                                <thead>
                                    <tr>
                                        <th>photo</th>
                                        <th>Id</th>
                                        <th>Author</th>
                                        <th>Body</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>

                                  

                                    <?php foreach ($comments as $comment) : ?>

                                    <tr>

                                        <td> <?php $photo = Photo::find_by_id($comment->photo_id); ?>

                                            <img  class="thumbnail" style="max-width:200px;" src="<?php echo $photo->picture_path();?>">

                                         </td>


                                        <td><?php echo $comment->id;  ?>
                    
                                        <td><?php echo $comment->author; ?>

                                            <div class="action_link">
                                                <a href="delete_comment.php?id=<?php echo $comment->id; ?>">Delete</a>
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
               <!-- pagination start -->
         <div class="row">
            
        <ul  class="pagination">

            <?php

            if ($paginate->page_total() > 1) {

                 if ($paginate->has_previous()) {

                  echo " <li style='margin-left: 20px;' class='previous'><a  href='comments.php?page={$paginate->previous()}'>previous</a></li>";  
                
                    } 

                

                for ($i=1; $i <= $paginate->page_total(); $i++) { 
                  
                  if ($i == $paginate->current_page) {
                     
                     echo " <li class='active'><a  href='comments.php?page={$i}'>{$i}</a></li>";
                  }else
                  {
                     echo " <li class=''><a  href='comments.php?page={$i}'>{$i}</a></li>";
                  }
                }

                if ($paginate->has_next()) {

                  echo " <li class='next s'><a href='comments.php?page={$paginate->next()}'>next</a></li>";  
                    
                }

                    }

            ?>
  
        </ul>

        
        <!-- pagination end -->


        </div>



        </div>


        

        
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>