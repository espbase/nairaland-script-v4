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
//echo Checkuser();

require_once 'incfiles/theme/head_open.php';
############################### page title #######################
$movietitle = $_GET['title'];
	$page_title=$movietitle;
	$site_dsc=APPNAME." - $movietitle";
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');

##################### login form ########################
$movieurl = $_GET['url'];
//$moviecode = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)); //Get last word from URL after a slash in PHP
//$lastWord = substr($url, strrpos($url, '/') + 1);
?>
    <table>
      <tr>
        <th><h2>FOOTBALL LIVESCORE</h2></th>
      </tr>


         <tr>
        <td class="w" style="text-align: left;">
          <?php
       //   echo $movieurl;
//$url = "https://afdah.info/watch-movies/67820-into-the-ashes-2019/";
@$page = file_get_contents('http://ftr.fivefilters.org/makefulltextfeed.php?url='.$movieurl.'');
$a = array($movieurl, $movieurl, $movieurl.'/', 'Content extracted from', 'Let\'s block ads! (Why?)', 'en-US text/html' );
$page=html_entity_decode(str_replace($a, '',str_replace('','',$page)));

echo @$page;

@$doc = new DOMDocument();   
@$doc->loadHTML($page);    
@$xpath = new DOMXPath($doc);    
@$images = $xpath->evaluate("//img");

foreach ($images as $image) {
    $src = $image->getAttribute('src');
    //echo $src;
    //echo "\n";
}

$url=basename(parse_url($src, PHP_URL_PATH));

$int = (int) filter_var($url, FILTER_SANITIZE_NUMBER_INT);

//echo $int;

$url = "https://afdah.info";
$header = get_headers($url, 1);
echo $header["X-Frame-Options"];

?>

<style type="text/css">
	div div{
		padding:7px;overflow:hidden;margin:auto;border:1px solid rgb(204,204,204);background:none repeat scroll 0% 0% rgb(255,255,255);
	
	}
	
.video-container {
position: relative;

padding-top: 3px; height: 400px; 
width: 70%;
}

.video-container iframe,
.video-container object,
.video-container embed {
position: absolute;
top: 0;
left: 0;
width: 100%;
height: 100%;
}
</style>
<?php
echo '<iframe src="https://afdah.info/embed/'.$int.'" name="" align="center" height="400" width="800" class="video-container">
</iframe>';
?>
</td>
      </tr>
    </table>

<?php
echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';

//load footer from footer.php
require_once ('footer.php');

?>

	</div>
<!-- GOOGLE ANALYSTIC GOES HERE -->

</body>
</html>
