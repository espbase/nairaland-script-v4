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

echo checkUser();

################################# Defining variables ##########################
$post_id=($_GET['id']); // get post id


##################### verify if post does in databse ########################
$post_id=($_GET['id']); // get post id
$bid=($_GET['bid']); // get post id
$url= $_GET['link']; // get title
$link=$url.'.html'; // verify if it's a real page
//echo "$post_id/$bid/$link"; // test comment link

//require_once ('incfiles/functions.php'); // 

$created=date('D M Y h:sa'); // get current timestamp
//$user_id=1; // custom user id

$user_id=$_SESSION['user_id']; //Storing user ID in SESSION variable.

$reply=$_POST['content'];
$checked=$_POST['follow'];
// insert into database
$redirect="$post_id/$link"; // REDIRECT TO BACK TO POST

$banned_topic=$db->query("UPDATE topics SET status='1' WHERE topic_id='$post_id' AND board_id_fk='$bid' ");

header('Location: '.WEBROOT.'/'.$redirect);

?>
 