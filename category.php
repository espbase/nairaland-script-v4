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

require_once ('incfiles/topicCount.php'); // count page view function

$geturl=$_GET['url']; // get toic url
$pageurl=WEBROOT."/forum/$geturl";

$query_cat1 = $db->query("SELECT * FROM sub_cat WHERE surl='$geturl' ");
$data=$query_cat1->fetch_assoc();
$sname1=$data['sname'];
$dsc1=$data['dsc'];

require_once 'incfiles/theme/head_open.php';
############################### page title #######################

	$page_title=$sname1;
	$site_dsc=$dsc1;
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
//load header.php -->
require_once ('header.php');



//load board.php list of categories -->
require_once ('incfiles/category.php');


echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';


//load footer from footer.php
require_once ('footer.php');

?>
	</div>
<!-- GOOGLE ANALYSTIC GOES HERE -->

</body>
</html>
