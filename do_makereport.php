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

require_once 'incfiles/theme/head_open.php';
############################### page title #######################

	$page_title='Make Report';
	$site_dsc="Report Post and topic";
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');

echo '<a id="top" name="top"></a>'; // anchor

##################### login form ########################
$user_id=$_SESSION['user_id']; //Storing user ID in SESSION variable.
$error="";
if(isset($_POST['reported']))
{

$reason=addslashes($_POST['reason']);
$redirect=($_POST['redirect']);
$topic=($_POST['topic']);

if (empty($reason)) {
echo "<h2>This field cannot be empty</h2>";
}
else{
$qin=$db->query("INSERT INTO reporttopic (user_id_fk, topic_id_fk, txtreason, dated) 
  VALUES('$user_id','$topic', '$reason', NOW())");

echo '<script type="text/javascript">window.location = "'.$topic.'/'.$redirect.'"; </script>';

}
}
?>

    

<?php
echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';


//load footer from footer.php
require_once ('footer.php');

?>

	</div>
<!-- GOOGLE ANALYSTIC GOES HERE -->

</body>
</html>
