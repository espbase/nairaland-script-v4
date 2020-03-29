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

//delete topic according to user logged in 
			if (isset($_GET['deletecomment']) && ($_GET['link'])  && ($_GET['topic'])) {
				$deletecomment=htmlentities($_GET['deletecomment']);
				$link=htmlentities($_GET['link']);
				$topic=htmlentities($_GET['topic']);
				//echo "<script> alert('.$topic_id_del.'); </script>";
				//if is the original topic creator, chek before delete topic
			
			$queryDeleteTopic=$db->query("DELETE FROM topic_comments WHERE comment_id='{$deletecomment}' ");
			
				}
				header("Location: ".WEBROOT."/$topic/$link");