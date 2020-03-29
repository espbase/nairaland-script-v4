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

	$page_title='Settings';
	$site_dsc="Settings";
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
##################### configuration ########################
if(isset($_POST['save']))
{
  
  $theme=$_POST['theme'];
  $color=$_POST['color'];
  $sitestatus=$_POST['sitestatus'];

  $create="<?php \n /*
Note: please don't edit any thing from here except you know what you are
doing, this file contain your website configuration

------------------------ SETTINGS ------------------------------------
You can modify these setting as you wish

*/\n
define('THEME', '$theme');  // define custom theme
define('HEADER_COLOR', '$color'); // set title header color
define('DISPLAY_STATUS', '$sitestatus'); // set application trade mark name

 ?>";

  file_put_contents('incfiles/applytheme.php', $create);

echo '<script type="text/javascript">window.location = "'.WEBROOT.'/theme-settings"; </script>';

}
?>
    <form action="?" method="post" style="margin-top: 0;">
    <table>
      <tr>
        <th><h2 class="m">THEME AND APPEARANCE SETTINGS</h2></th>
      </tr>
<tr>
  <td class="w">
      <p>
  This page will allow you set and activate new themes, and header title color, just play around, let me know if any error occure!  
  <p>
    <tr>
  <td class="w">
    <h2>DISPLAY SETTINGS</h2>
  <b>    <input type="radio" name="sitestatus" checked="" value="title"> Text Only 
  <input type="radio" name="sitestatus"  value="logo"> Logo Only 
    <input type="radio" name="sitestatus" value="both"> Both </b>
  </p>
  </td>
</tr>
    <tr>
  <td class="m" style="text-align: left;">
    <h2>SELECT THEME</h2>
  <b><input type="radio" name="theme" checked="" value="ken2"> Kenya Style <br>
  <input type="radio" name="theme" value="nl"> Default(Nairaland) <br>
    <input type="radio" name="theme"  value="nl_ext"> Default(Extented) <br>
    <input type="radio" name="theme" value="whatsapp"> Whatsapp Extented<br>
    <input type="radio" name="theme" value="whatsapp_ext"> Whatsapp<br>
    <input type="radio" name="theme" value="blueoccean"> Blue Occean <br>
    <input type="radio" name="theme" value="marriage"> Marriage<br>
    <input type="radio" name="theme" value="fb"> Facebook </b>
  </p>
  </td>
</tr>
  <td class="w">
      <input id="qsearch" type="color" style="height: 40px" name="color"><br>
    Select <b>HEADER TITLE</b> Color<br>
    <button type="submit" name="save" style="font-size: 15px">Save Settings</button>
  </td>
</tr>
    </table>
    </form>
<?php
echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';


//load footer from footer.php
require_once ('footer.php');

?>

	</div>
<!-- GOOGLE ANALYSTIC GOES HERE -->

</body>
</html>
