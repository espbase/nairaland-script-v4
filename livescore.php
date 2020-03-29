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

	$page_title='kenyans 247 football matches livescores and odds';
	$site_dsc=APPNAME." kenyans 247 football matches livescores and odds";
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');

##################### login form ########################

$error="";
?>

<style type="text/css">
	@media only screen and (max-width: 600px) and (max-width: 360px) {
    /* For mobile phones: */

.video-container iframe,
.video-container object,
.video-container embed {
position: absolute;
top: 0;
left: 0;
width: 90% !important;
height: 100%;
}

}
.video-container {
position: relative;

padding-top: 3px; height: 450px; 
width: 100%;
}

#topadvert
{
    display:hide;
}
.copyright
{
 display:hide;   
}
</style>
<script>
    $("iframe").contents().find(".copyright").hide();
</script>
    <table>
      <tr>
        <th><h2>Kenyans 247 Football Matches, LiveScores and Odds</h2></th>
      </tr>


         <tr>
        <td class="w video-container" style="text-align: left; width: 10% !important;">
          <script type="text/javascript" src="https://widget.enetscores.com/FWB12592FE120C3DFA"></script>
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
