$(document).ready(function(){

var user_href;
var user_href_splitted;
var user_id;
var image_src;
var image_href_splitted;
var image_name;
var photo_id;
var comment_href;
var comment_href_splitted;
var comment_id;

$(".modal_thumbnails").click(function(){

$("#set_user_image").prop('disabled',false);

/*$(this).addclass('selected');*/
user_href = $("#user-id").prop('href');
user_href_splitted = user_href.split("=");
user_id = user_href_splitted[user_href_splitted.length -1]; 

image_src = $(this).prop("src");
image_href_splitted = image_src.split("/");
image_name = image_href_splitted[image_href_splitted.length -1]; 

photo_id = $(this).attr("data");

$.ajax({
 		url:"includes/ajax_code.php",
 		method:"POST",
 		data:{photo_id:photo_id},
 		success:function(data){

 			if(!data.error) {

 			$("#modal_sidebar").html(data);

 			}
}

});

});

$("#set_user_image").click(function(){

 $.ajax({
 		url:"includes/ajax_code.php",
 		method:"POST",
 		data:{image_name:image_name , user_id:user_id},
 		success:function(data){

 			if(!data.error) {

 				$(".user_image_box").prop('src', data);

 				location.reload(true);
 			}

	}

 });

});



$(".approve_comment").click(function(){

comment_href = $("#comment-id").prop('href');
comment_href_splitted = comment_href.split("=");
comment_id = comment_href_splitted[comment_href_splitted.length -1]; 


 $.ajax({
 		url:"includes/ajax_code.php",
 		method:"POST",
 		data:{comment_id:comment_id},
 		success:function(data){

 					 {

 				alert(comment_id);
 			}

 				/*location.reload(true);*/
 			}

	});

 });

tinymce.init({ selector:'textarea' });


});