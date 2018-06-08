<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in())  {redirect("login.php");} ?>

<?php
    
    $message = "";

    if (isset($_POST['submit'])) {

        $photo = new Photo();
        $photo->title = $_POST['title'];
        $photo->description = $_POST['description'];
        $photo->caption = $_POST['caption'];
        $photo->alternate_text = $_POST['alternate_text'];
        $photo->set_file($_FILES['file_upload']);


        if ($photo->save()) {
            
            $message = "file uploaded successfully";

        } else{

            $message = join("<br>", $photo->errors);
        }
       
    }


?>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone-amd-module.js">
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
                             Upload
                            <small>upload your files here </small>
                        </h1>

                        <div class="col-md-6">

                        <form method="post" class="dropzone" enctype="multipart/form-data" action="upload.php">

                            <?php echo $message;  ?>

                            

                            <div class="form-group">
                                 <label for="caption">title</label>
                                <input type="text" name="title" class="form-control" placeholder="enter the image title" ><br>
                                <input type="file" name="file_upload">
                            </div>

                            <div class="form-group">
                                <label for="caption">Caption</label>
                                <input type="text" name="caption" class="form-control" placeholder="enter the caption">
                            </div>

                            <div class="form-group">
                                <label for="caption">Alternate text</label>
                                <input type="text" name="alternate_text" class="form-control" placeholder="enter alternate text">
                            </div>

                            <div class="form-group">
                                <label for="caption">Description</label>
                                <textarea class="form-control" name="description" id="" cols="30" rows="5" placeholder="enter brief description on image"></textarea>
                                
                            </div>
                                <input type="submit" name="submit" class="btn btn-primary">

                                
                        </form> 
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