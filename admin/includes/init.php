<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

/*defined('SITE_ROOT') ? null : define('SITE_ROOT', DS . 'E:' . DS . 'xamp' . DS . 'htdocs' . DS . 'gallery');
*/

defined('SITE_ROOT') ? null : define('SITE_ROOT', DS . 'xamp' . DS . 'htdocs' . DS . 'gallery');


defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH', SITE_ROOT.DS.'admin'.DS.'includes');

require_once("database.php");
require_once("user.php");
require_once("functions.php");
require_once("sessions.php");
require_once("db_object.php");
require_once("photo.php");
require_once("comment.php");
require_once("paginate.php");
/*require_once('new_config.php');*//*its aleardy called in database.php*/
/*include("new_config.php");*/
 ?> 