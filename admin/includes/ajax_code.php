<?php require('init.php');

$photo = new Photo();
$user = new Users();
$comment = new Comment();

if (isset($_POST['image_name'])) {

$user->ajax_save_user_image($_POST['image_name'], $_POST['user_id']);

}

if (isset($_POST['photo_id'])) {


	 Users::display_sidebar_data($_POST['photo_id']);


}


if (isset($_POST['comment_id'])) {


	 Comment::approve_comment($_POST['comment_id']);


}

 

 ?>