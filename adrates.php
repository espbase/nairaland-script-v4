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

if (DEVELOPER==='Marshall')
{
$user_id=$_SESSION['user_id']; //Storing user ID in SESSION variable.
############################################### site content
//$siteinfo = new site();
//echo $siteinfo->discription(APPINFO);
$page_title='Estimated Advert Rates -'.APPNAME.' Ads';
$site_dsc='Estimated Advert Rates -'.APPNAME.' Ads';

//echo checkUser(); // authenticate logged in users
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');

##################### registration form ########################

require 'incfiles/bbparser.php'; // phpbb code parser
//load header.php -->
require_once ('header.php');

?>
<!--<p id="legend2">
</p>
<div class="holder">
</div>-->

<h2>Estimated Advert Rates - <?php echo APPNAME; ?> Ads</h2>

      <h2 align="center">Adrate - <?php echo APPNAME; ?> Ads</h2>
         <p align="center"> (<a href="<?php echo URL; ?>/campaign">Campaign</a>)

<p>Estimated cost of advertising on each section of <?php echo APPNAME; ?>.</p>

<p>How To Advertise (We accept payments of at least <?php echo CURRENCY; ?> 3,500)</p>

<p>Order: By Popularity / Alphabetically</p>
<!-- item container -->
 <div id="wrapper">
      <div class="contents">
	
<table>
		<tbody>
  
<?php
    $queryBoard=$db->query("SELECT * FROM category C, sub_cat S WHERE C.cid=S.cid_fk group by S.sname ORDER BY S.sid");
//fetch rows
/*
Define topics, category, and sub cat details and variables
*/
while($bdata=$queryBoard->fetch_assoc()){
$sname=$bdata['sname'];
$sid=$bdata['sid'];
$surl=$bdata['surl'];
$ad_dsc=$bdata['ad_dsc'];
$catcost=$bdata['catcost'];

	@$i = $i + 1;
			if($i%2 == 0)
			{ $w=''; } 
			
			else
			{ $w='w'; }
?>
<tr>
<td id="top519" class="<?php echo $w; ?>">
 
<a href="<?php echo URL; ?>/forum/<?php echo $surl; ?>"><b><?php echo $sname; ?></b></a>: <s style="color:#786">&nbsp;<b></b>&nbsp;</s> 
<b><?php echo CURRENCY.' '.$catcost; ?></b>/week (<b><?php echo CURRENCY.' '.$catcost/7; ?></b>/day, <b><?php echo CURRENCY.' '.$catcost*4; ?></b>/month).  
<span style="color:#600"><?php echo $ad_dsc; ?></span>.
</td>
  </tr>
<?php } ?>

	</tbody>
	</table>
		</div>	</div>

<?php

//load footer statistic from footer_stat.php
//require_once ('footer_stat.php');

echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';


//load footer from footer.php
require_once ('footer.php');

?>


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
