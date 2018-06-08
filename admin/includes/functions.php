<?php
/*to find the class are included*/

function __autoload($class){

$class = strtolower($class);

$the_path = "includes/{$class}.php";

if (file_exists($the_path)) {

	require_once($the_path);
	
} else {

	die("this file named {$class}.php was not found");
}

}


function redirect($location){
	header("Location: {$location}");
}

?>