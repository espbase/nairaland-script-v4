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
			if (isset($_GET['deletetopic']) && ($_GET['link'])) {
				$topic_id_del=htmlentities($_GET['deletetopic']);
				$link=htmlentities($_GET['link']);
				//echo "<script> alert('.$topic_id_del.'); </script>";
				//if is the original topic creator, chek before delete topic
			if ($user_id===$user_id_cm){
			$queryDeleteTopic=$db->query("DELETE FROM topics WHERE topic_id='{$topic_id_del}' ");
			}	
				}
				header("Location: $topic_id_del/$link");