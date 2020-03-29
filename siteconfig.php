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
  
  $gtag=$_POST['gtag'];
  $atag=$_POST['atag'];
  $ytag=$_POST['ytag'];
  $metatags=$_POST['metatag'];

  $create="<?php \n /*
Note: please don't edit any thing from here except you know what you are
doing, this file contain your website configuration

------------------------ SETTINGS ------------------------------------
You can modify these setting as you wish

*/\n
define('GOOGLE', '$gtag');  // define custom root for web app
define('YANDEX', '$ytag'); // set application name
define('ALEXA', '$atag'); // set application name
define('METATAGS', '$metatags'); // set application trade mark name

 ?>";

  file_put_contents('metatags.php', $create);


// header("LOCATION: install.php?step=complete");
 echo "<h2>Setup Completed Successfully</h2> ";

  // Sending email
   /* Send a registration link to entered email address */
$to = EMAIL;
$subject = 'Meta Tags Installed';
$from = 'marshallunduemi@gmail.com';
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

// Create email headers
$headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
    $time=date('d,m,y');

// Compose a simple HTML email message
$message = '
<h1 style="color:#f40;">Howdy Websmaster!</h1> 
<p style="color:#080;font-size:12px;">, Your site meta tags has been installed on '.URL.'</p> 
<p>On '.$time.' </p>';
// Sending email

mail($to,$subject,$message,$headers);
}
?>
    <form action="?" method="post" style="margin-top: 0;">
    <table>
      <tr>
        <th><h2>WEBSITE CONFIGURATION</h2></th>
      </tr>
<tr>
  <td class="w">
      <input id="qsearch" type="text" size="50px" name="gtag" placeholder="google-verification content"><br>
    &lsaquo;meta name="google-verification" content=""&rsaquo;  <a href="http://google.com/webmaster" id="link">G-Console</a>
  </td>
</tr>
<tr>
  <td class="w">
      <input id="qsearch" type="text" size="50px" name="ytag" placeholder="yandex-verify content">
    <br>&lsaquo;meta name="yandex-verify" content=""&rsaquo; <a href="http://yandex.com" id="link">Yandex</a>
  </td>
</tr>
<tr>
  <td class="w">
      <input id="qsearch" type="text" size="50px" name="atag" placeholder="alexaVerifyID content">
    <br>&lsaquo;meta name="alexaVerifyID" content=""&rsaquo; <a href="http://alexa.com" id="link">Alexa</a>
  </td>
</tr>
<!--<tr>
  <td class="w">
    <textarea id="qsearch" cols="50" name="ads" placeholder="Past Google Adsense Code "></textarea>
    <br>&lsaquo;Past Google Adsense Code &rsaquo; <a href="http://alexa.com" id="link">Google Adsense</a>
  </td>
</tr>-->
<tr>
  <td class="w">
      <input id="qsearch" type="text" size="50px" name="metatag" placeholder="E.g nairaland, script, php website etc "><br>
    Enter Website keywords Seprate with Comma<br>
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
