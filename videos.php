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

	$page_title='EBRU LIVE STREAM TV';
	$site_dsc=APPNAME." EBRU LIVE STREAM TV  ";
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');

echo '<a id="top" name="top"></a>'; // anchor

##################### login form ########################

$error="";
?>
    <table>
      <tr>
        <th><h2>EBRU LIVE STREAM TV</h2></th>
        <th><h2>SWITCH LIVE STREAM TV</h2></th>
      </tr>
         <tr>
        <td class="w" style="text-align: left;">
<iframe frameborder="0" width="550" height="270"
src="https://www.dailymotion.com/embed/video/x67n3k1?autoplay=1"
allowfullscreen allow="autoplay"></iframe>

        <td class="w" style="text-align: left;">
<iframe frameborder="0" width="550" height="270"
src="https://livestream.com/accounts/27754751/events/8377002/player?enableInfoAndActivity=true&defaultDrawer=feed&autoPlay=true&mute=false"
allowfullscreen allow="autoplay"></iframe>
        </td>
      </tr>
    </table>

<?php
echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';

//load footer from footer.php
require_once ('footer.php');

?>

</body>
</html>
