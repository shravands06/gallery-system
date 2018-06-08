<?php

  
class Comment extends Db_object{

    protected static $db_table = "comments";
    protected static $db_table_fields = array('id', 'photo_id', 'author', 'body', 'approval');
    public $id;
    public $photo_id;
    public $author;
    public $body;
    public $approval;
    public $time;

    public static function create_comment($photo_id, $author, $body) {

        if(!empty(photo_id) && !empty(author) && !empty(body)){

            $comment = new Comment();
            $comment->photo_id = (int)$photo_id;
            $comment->author = $author;
            $comment->body = $body;

            return $comment;


        } else {

            return false;
        }

    }

    public static function find_comment($photo_id){

        global $database;

        $sql ="SELECT * FROM " . self::$db_table;
        $sql .=" WHERE photo_id = " .$database->escape_string($photo_id);
        $sql .=" ORDER BY photo_id ASC";

        return self::find_by_query($sql);


    }

    public static function approve_comment($id){

        global $database;

        $sql ="UPDATE comments SET approval = 1 WHERE id = $id LIMIT 1";

        $database->query($sql);
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;

}
public static function unapprove_comment($id){

        global $database;

        $sql ="UPDATE comments SET approval = 0 WHERE id = $id LIMIT 1";

        $database->query($sql);
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;

}

        public static function find_all_approved(){

        $sql ="SELECT * FROM " .self::$db_table. " WHERE approval=1 ";    

        return static::find_by_query( $sql);

    }

    public static function find_all_unapproved(){

        $sql = "SELECT * FROM " .self::$db_table. " WHERE approval=''";
        return static::find_by_query($sql);

    }

    public static function find_approved_comment($photo_id){

        global $database;

        $sql ="SELECT * FROM " . self::$db_table;
        $sql .=" WHERE photo_id = " .$database->escape_string($photo_id);
        $sql .=" && approval = 1";
        $sql .=" ORDER BY photo_id ASC";

        return self::find_by_query($sql);


    }
}
    
/*$users = new Users();*/

/*end of user class */
?> 