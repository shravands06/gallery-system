<?php include("includes/init.php"); ?>
<?php if(!$session->is_signed_in()) 
  redirect("login.php"); ?>


<?php

if (empty($_GET['id'])) {

 redirect('users.php');
}

/* echo $_GET['id'];*/

$users = Users::find_by_id($_GET['id']);

if ($users) {


  $users->delete_photo();

  $session->message("the user {$users->username} has been deleted");

  redirect('users.php');

} else {

 redirect('users.php');
}

?>

