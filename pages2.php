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

// perpage on functions
if(isset($_GET['link']) & !empty($_GET['link'])){
	$curpage = $_GET['link'];
}else{
	$curpage = 1;
}
//echo $_GET['link'];
$start = ($curpage * $perpage) - $perpage;
$PageSql = "SELECT * FROM `topics` WHERE post_type='sponsored' ORDER BY topic_id DESC";
$pageres = $db->query($PageSql);
$totalres = mysqli_num_rows($pageres);

$endpage = ceil($totalres/$perpage);
$startpage = 1;
$nextpage = $curpage + 1;
$previouspage = $curpage - 1;

$ReadSql = "SELECT * FROM `topics` WHERE post_type='sponsored' LIMIT $start, $perpage";
$res = $db->query($ReadSql);

require_once 'incfiles/theme/head_open.php';
############################### page title #######################
	$page_title='Featured Links';
	$site_dsc="Featured Links";
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag
require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php -->
require_once ('header.php');

echo '<a id="top" name="top"></a>';

//load board.php list of categories -->
 //require_once ('inc_board.php');

//load google adsense ads template
//require_once ('incfiles/googleads.html');
?>
<h2>SPONSORED POST</h2>
<p><a href="<?php echo WEBROOT; ?>"><?php echo APPNAME; ?></a> /
	<a href="<?php echo WEBROOT; ?>/sponsored/1">Sponsored Links</a>
</p>

<?php
//load articles from articles.php -->
require_once ('inc_pages.php');


//load system header ads template
//require_once ('ads.php');

//load footer statistic from footer_stat.php
require_once ('footer_stat.php');

echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';


//load footer from footer.php
require_once ('footer.php');

?>
	</div>
<!-- GOOGLE ANALYSTIC GOES HERE -->

</body>
</html>
