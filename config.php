<?php 
 /* include database connection */
   /*
Note: please don't edit any thing from here except you know what you are
doing, this file contain your php configuration and the whole site settings


------------------------ SETTINGS ------------------------------------
You can modify website title, name, trademark etc


*/
//db configuraton details 
session_start();

//date_default_timezone_set('Africa/Lagos');

 require_once('incfiles/online_status.php'); 
// online users status 

 
 if (file_exists('metatags.php')) {
   require_once('metatags.php'); 
  require_once('incfiles/applytheme.php'); 
 }


define('DB_SERVER', 'localhost'); 
define('DB_USERNAME', 'root'); 
define('DB_PASSWORD', '');
define('DB_DATABASE', 'nl'); 

$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE); 

//Connect and select the database


include 'inc.config.php';
 ?>