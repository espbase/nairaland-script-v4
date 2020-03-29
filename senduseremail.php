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
require 'mail.config.php';
$mail->From = REPLYEMAIL;
$mail->FromName = APPNAME;
/*
NOTE: Don't remove this line of code
this serve as the developer property
that exist between the app and the third party
*/

$site_title=APPNAME;
if (DEVELOPER==='Marshall')
{

############################################### site content
//$siteinfo = new site();
//echo $siteinfo->discription(APPINFO);
$page_title='Send Message';
$site_dsc='Send Message';

require_once 'incfiles/theme/head_open.php';
############################### page title #######################
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag
require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

require 'incfiles/bbparser.php'; // phpbb code parser
//load header.php -->
require_once ('header.php');
/*
developer credit
Don't temper or try to edit and modify
*/


//load board.php list of categories -->
 require_once ('inc_board.php');

//load google adsense ads template
//require_once ('incfiles/googleads.html');

//load articles from articles.php -->
//require_once ('inc_articles.php');

?>
<!--<p id="legend2">
</p>-->


<!-- item container -->
<?php
$logusername=$_SESSION['username']; //Storing user ID in SESSION variable.
$getuser=$_GET['user'];
$query_mods = $db->query("SELECT * FROM users WHERE username='$getuser' ");
	//count rows

$data=$query_mods->fetch_assoc();

	$username=$data['username'];
	$email=$data['email'];

if(isset($_POST['send']))
{
 $title=addslashes($_POST['title']);  
 $msg=addslashes($_POST['msg']);  
 
$mail->addAddress($email); // Name is optional;
$mail->isHTML(true);
$mail->Subject ='New Message From '.APPNAME;
$mail->Body = '<div class="email--background">
  
  <div class="email--container">
    <div class="email--inner-container">
    <h3>'.$title.'</h3>
    <p>Dear '.ucfirst($username).',<br> You have a new message from <a href="'.URL.'/u/'.$logusername.'">'.$logusername.'</a></p>
       <hr>
       '.$msg.'
       <hr>
    <h3>Best Regards</h3>
    <p>'.APPNAME.' Team <br> <a href="'.URL.'" class="cta">Website</a> ></p>
    </div>
  </div>
</div>';
if (!$mail->send()) {
 echo '<div style="width:100%;text-align:center; color:#C5110BCC; font-weight:bold">Oops! an unknow error occured</div>';
}
else
{
    echo "<h2>Message Sent</h2>";
}
}
	?>
<h2>Send E-mail Message to <a href='<?php echo URL; ?>/u/<?php echo $username; ?>'><?php echo $username; ?></a></h2>
<table>
<tr>
	<td>
		<form action="" id="postform" method="post" name="postform">
			<p>Subject:</p>


			<p><input name="subject" type="text"><br>
			</p>


			<p>Message:</p>


			<p>
			<textarea cols="90" id="body" name="msg" rows="8"></textarea>
			</p>


			<p><input type="submit" name="send" value="Send Email">
			</p>
		</form>
	</td>
</tr>
</table>

<?php
#########################################################################

//load system header ads template
require_once ('ads.php');

//load footer statistic from footer_stat.php
require_once ('footer_stat.php');

echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';


//load footer from footer.php
require_once ('footer.php');

?>
<!-- GOOGLE ANALYSTIC GOES HERE -->

	</div>
	
</body>
</html>
<?php
}
else
{
/*
deactivate and redirect website

*/
echo '<h2>Warning!</h2>
<table>
  <tr>
    <td class="w">========================= Instruction =========================<br>
      - You have tempered with the soruce code, please refer to the documentation or Contact developer...
    </td>
  </tr>
</table>';
/*
deactivate and redirect website

*/
}
 ?>
