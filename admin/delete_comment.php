<?php include("includes/init.php"); ?>
<?php if(!$session->is_signed_in()) 
  redirect("login.php"); ?>


<?php

if (empty($_GET['id'])) {

 redirect('comments.php');
}

/* echo $_GET['id'];*/

$comment = Comment::find_by_id($_GET['id']);

if ($comment) {


  $comment->delete();
   $session->message("the {$comment->body} comment has been deleted ");


  redirect('comments.php');

} else {

 redirect('comments.php');
}

?>

