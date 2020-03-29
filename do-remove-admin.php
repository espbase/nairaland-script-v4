<?php
/*
Developer: Marshall Unduemi
Url: www.codexpresslabs.info
Contact: info@codexpresslabs.info

*/
//Enable Error Reporting

//error_reporting(0);
//remove the above comment to enable error reporting

require_once ('config.php');
require_once ('functions.php');

$uid=($_GET['uid']); // get post id
if($uid)
{
$db->query("UPDATE users SET access='0' WHERE uid='$uid' ");

header('Location: '.WEBROOT.'/create-admin');
}


##################### registration form ########################



?>
