<?php


class Photo extends Db_object {

	protected static $db_table = "photos";
	protected static $db_table_fields = array('id', 'title', 'caption', 'description', 'filename', 'alternate_text', 'type', 'size');

	public $id;
	public $title;
    public $caption;
	public $description;
	public $filename;
    public $alternate_text;
	public $type;
	public $size;
    public $time;

    public $target_path;
	public $tmp_path;
	public $upload_directory = "images";
	public $errors = array();
	public $upload_errors_array = array(

	UPLOAD_ERR_OK		  => "there is no error",
	UPLOAD_ERR_INI_SIZE	  => "the uploaded file exceeds maximum file size",
	UPLOAD_ERR_FORM_SIZE  => "the file exceeds max form size",
	UPLOAD_ERR_PARTIAL    => "the file was partially uplaoded",
	UPLOAD_ERR_NO_FILE    => "no file was uploaded",
	UPLOAD_ERR_NO_TMP_DIR => "missing temporary folder",
	UPLOAD_ERR_CANT_WRITE => "failed to write file to disk",
	UPLOAD_ERR_EXTENSION  => "php extension stopped the file from uploading",
);

	/*this is passing $_FILES['uploaded_file'] as an argument*/
 public function set_file($file) {


 	if(empty($file) || !$file || !is_array($file)){

 		$this->errors[] = "there was no file uploaded here";
 		return false;

 	} elseif ($file['error'] !=0) {
 		
 		$this->errors[] = $this->upload_errors_array[$file['error']];
 		return false;
 	} else{

 	 $this->filename = basename($file['name']); 
 	 $this->tmp_path = $file['tmp_name'];
 	 $this->type = $file['type'];
 	 $this->size = self::formatSizeUnits($file['size']);
 	}

 	 

 }

 public function picture_path(){

 	return $this->upload_directory.DS.$this->filename;
 }

 public function save(){

 	if($this->id){

 		$this->update();
 	} else {

 		if(!empty($this->errors)){

 			return false;
 		}

 		if(empty($this->filename) || empty($this->tmp_path)){

 			$this->error[] = "the file was not available";
 			return false;
 		}

 		$target_path = SITE_ROOT . DS . 'admin' . DS .$this->upload_directory . DS . $this->filename;

 		if (file_exists($target_path)) {
 			$this->errors[] = "the file {$this->filename} already exists";
 			return false; 

 		}

 		if (move_uploaded_file($this->tmp_path, $target_path)) {
 			if ($this->create()) {
 				
 				unset($this->tmp_path);
 				return true;
 			}
 		} else{

 			$this->errors[] = "the file directory doesnot have permission ";

 			return false;


 		}

 		
 	}


 }


 public function delete_photo(){

 	if ($this->delete()) {
 		
 		$target_path = SITE_ROOT . DS . 'admin' . DS .$this->picture_path();

 		return unlink($target_path) ? true : false;

 	} else {

 		return false;
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

}

/*$photo = new Photo();*/

?> 