<?php include("admin/includes/init.php"); ?>
<?php include("admin/includes/header.php"); ?>


<?php 

if (empty($_GET['id'])) {
   
   redirect('index.php');
}

$photo = Photo::find_by_id($_GET['id']);

if (isset($_POST['submit'])) {

    $author = trim($_POST['author']);
    $body = trim($_POST['body']);

    $session->message("thank you {$_POST['author']} for submiting the comment your comment will appear once approved");

    $comment = Comment::create_comment($photo->id, $author, $body);

    if ($comment && $comment->save()) {

        redirect("photo.php?id={$photo->id}");
    }
       
    else {

        $message ="there was some error";

    } 
  
}

  $comments = Comment::find_approved_comment($photo->id);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>cars</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-post.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Home</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="admin/index.php">admin</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-12">

                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo $photo->title; ?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">Admin</a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span>Posted on:<?php echo $photo->time; ?></p>

                <hr>

                <!-- Preview Image -->
                <!-- http://placehold.it/900x300 -->
                <img class="img-responsive" src="admin/<?php echo $photo->picture_path();?>" alt="">


                <!-- Post Content -->
                <p class="lead" style="font-weight: bold;"><?php echo $photo->caption;?></p>
                <p><?php echo $photo->description; ?></p>
                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    
                    <form role="form" method="post">
                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" name="author" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="author">comment:</label>
                            <textarea name="body" class="form-control" rows="3"></textarea>
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>



                <hr>

                <!-- Posted Comments -->


                <?php foreach ($comments as $comment) : ?>

                <!-- Comment -->
                
                <div class="media ">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment->author; ?>
                            <small><?php echo $comment->time;?></small>
                        </h4>
                        <?php echo $comment->body; ?>
                    </div>
                </div>
                </div>
                
                <?php endforeach;?>
                <br>
                <p  style="font-size:large; color:#1a658b;" ><?php echo $message; ?></p>
                <!-- Comment -->
                <div class="media">
                
                </div>


            <!-- Blog Sidebar Widgets Column -->
            <!-- <div class="col-md-4"> -->

            
                 <!-- <?php /*include("includes/sidebar.php")*/; ?> -->



       <!--  </div> -->
        </div>

            <!-- Blog Sidebar Widgets Column -->
           
                <!-- Blog Categories Well -->
                
                       
                    <!-- /.row -->
                

                <!-- Side Widget Well -->
                
        <!-- /.row -->

        <hr>

        <!-- Footer -->

        <?php include('includes/footer.php') ?>
        <!-- <footer>
            <div class="row">
                <div class="col-lg-8">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
            /.row
        </footer> -->

    </div>
    
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
