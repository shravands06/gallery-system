<?php

include('db_object.php');
  
class Users extends Db_object {

	protected static $db_table = "users";
	protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name', 'user_image');
	public $id;
	public $username;
	public $password;
	public $first_name;
	public $last_name;
	public $user_image;

	public $upload_directory = "images";                    /*"images/user"  for my defined path for images*/
	public $image_placeholder = "usersplaceholder.jpg";


	public static function verify_user($username, $password){
        
		global $database;

		$username = $database->escape_string($username);
		$password = $database->escape_string($password);

		$sql = "SELECT * FROM " .self::$db_table. " WHERE username= '$username' AND password= '$password'";

		$the_result_array = self::find_by_query($sql);
		return !empty($the_result_array) ? array_shift($the_result_array) :  false;
}

   
    public function image_path_and_placeholder() {

    	return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory.DS.$this->user_image;


    }

	
	public function set_file($file) {


 	if(empty($file) || !$file || !is_array($file)){

 		$this->errors[] = "there was no file uploaded here";
 		return false;

 	} elseif ($file['error'] !=0) {
 		
 		$this->errors[] = $this->upload_errors_array[$file['error']];
 		return false;
 	} else{

 	 $this->user_image = basename($file['name']); 
 	 $this->tmp_path = $file['tmp_name'];
 	 $this->type = $file['type'];
 	 $this->size = self::formatSizeUnits($file['size']);
 	}

 	 

 }


   public function save_user_and_image(){ /*upload_photo in tutorials*/

 	if($this->id){

 		$this->save();

 	} else {

 		if(!empty($this->errors)){

 			return false;
 		}

 		if(empty($this->user_image) || empty($this->tmp_path)){

 			$this->error[] = "the file was not available";
 			return false;
 		}

 		$target_path = SITE_ROOT . DS . 'admin' . DS .$this->upload_directory . DS . $this->user_image;

 		if (file_exists($target_path)) {
 			$this->errors[] = "the file {$this->user_image} already exists";
 			return false; 

 		}

 		if (move_uploaded_file($this->tmp_path, $target_path)) {
 		
 				unset($this->tmp_path);
 				return true;
 		} else{

 			$this->errors[] = "the file directory doesnot have permission ";

 			return false;


 		}

 		
 	/*}
*/
}
 }



     public static function formatSizeUnits($bytes) {

        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2)."MB";
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2)."KB";
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {

            $bytes = '0 bytes';
        }

        return $bytes;
}




    public function ajax_save_user_image($user_image, $user_id){


    global $database;

    $user_image = $database->escape_string($user_image);
    $user_id = $database->escape_string($user_id);

    $this->user_image = $user_image;
    $this->id = $user_id;

    $sql = "UPDATE " . self::$db_table . " SET user_image = '{$this->user_image}' ";
    $sql .= " WHERE id ={$this->id}";
    $update_image = $database->query($sql);

    echo $this->image_path_and_placeholder();
    }


    public static function display_sidebar_data($photo_id){

        $photo = Photo::find_by_id($photo_id);

        $output = "<a class='thumbnail' href='#'><img width='100' src='{$photo->picture_path()}'></a>";
        $output .= "<p>{$photo->filename}</p>";
        $output .= "<p>{$photo->type}</p>";
        $output .= "<p>{$photo->size}</p>";

        echo $output;
    }



    public function delete_photo(){

    if ($this->delete()) {
        
        $target_path = SITE_ROOT . DS . 'admin' . DS .$this->upload_directory . DS . $this->user_image;

        return unlink($target_path) ? true : false;

    } else {

        return false;
    }
 }
	
}
/*$users = new Users();*/

/*end of user class */
?> 