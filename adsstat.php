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

/*
NOTE: Don't remove this line of code
this serve as the developer property
that exist between the app and the third party
*/

$site_title=APPNAME;
if (DEVELOPER==='Marshall')
{
$user_id=$_SESSION['user_id']; //Storing user ID in SESSION variable.
############################################### site content
//$siteinfo = new site();
//echo $siteinfo->discription(APPINFO);
$page_title='Ads Statistic';
$site_dsc='Ads Statistic';

echo checkUser(); // authenticate logged in users
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');

echo '<a id="top" name="top"></a>'; // anchor

##################### registration form ########################

require 'incfiles/bbparser.php'; // phpbb code parser
//load header.php -->
require_once ('header.php');
/*
developer credit
Don't temper or try to edit and modify
*/
$app = new info();
//echo $app->devInfo();
/////////////////////////////////////////////////

echo '<a id="top" name="top"></a>';

//load board.php list of categories -->
 //require_once ('inc_board.php');

//load google adsense ads template
//require_once ('incfiles/googleads.html');

//load articles from articles.php -->
//require_once ('inc_articles.php');
//load system header ads template
require('ads.php');
?>
<!--<p id="legend2">
</p>-->

<div class="holder">
</div>
<!-- item container -->
<div id="itemContainer">
	<?php
	//delete ads
	if (isset($_GET['deleteid'])) {
		$adsGetId=$_GET['deleteid'];
		$dleteAds=$db->query("DELETE FROM ads WHERE adsId='$adsGetId' ");
		# code...
	}

	

	@$queryads=$db->query("SELECT * FROM ads A, users U WHERE A.uid_fk='$user_id' group by adsId");
	//fetch rows
	/*
	Define topics, category, and sub cat details and variables
	*/
	while($bdata=$queryads->fetch_assoc()){
	$adsName=$bdata['adsName'];
	$baseUrl=$bdata['baseUrl'];
	$adsId=$bdata['adsId'];
	$imgUrl=$bdata['imgUrl'];
	$adsDate=$bdata['adsDate'];
	$adsClicks=$bdata['adsClicks'];
	$username=$bdata['username'];
	$adsStatus=$bdata['adsStatus'];
	$user_id=$bdata['uid'];

?>

<table summary="posts">
	<tr>
		<td class="bold l pu">

		<a href="<?php echo WEBROOT."/$data[topic_id]/$data[link]"; ?>">
			<?php echo ucfirst($adsName); ?></a>

		by <a class="user" href="<?php echo WEBROOT;  ?>/callback/<?php echo $adsId;  ?>" target="_blank"><?php echo ucfirst($username)." ( $adsClicks clicks)"; ?></a>: <span class="s"><b><?php echo ucfirst($adsDate); ?></b></span></td>
	</tr>
	<tr>
		<td id="402" class="w">
			<div class="narrow" style="text-align: left;">

				<?php
				echo '<div align="center"><img src="'.WEBROOT.'/'.$imgUrl.'" width="200px"></div>';
				
				echo '<a href="'.WEBROOT.'/adsstat?deleteid='.$adsId.'">Delete ads</a>';
				// create admin post url
				if ($adsStatus=='0') {
					# code...
					echo '- <span style="color:red; font-weight:bolder;">Pending...</span>';
				}
				if ($adsStatus=='1') {
					# code...
					echo '- <span style="color:green; font-weight:bolder;">Running...</span>';
				}


				
					//echo '<a href="'.WEBROOT.'/adsstat?activateid='.$adsId.'">Activate ads</a> - ';
				
					//echo '<a href="'.WEBROOT.'/adsstat?pauseid='.$adsId.'">Pause ads</a> ';

				?>
				
			</div>
		</td>
	</tr>
</table>
<?php }  ?>

</div>
<!-- navigation holder -->
<div class="holder">
</div>

<!-- item container -->


<?php

//load system header ads template
require('ads.php');

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
