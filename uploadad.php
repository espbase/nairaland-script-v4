
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

$user_id=$_SESSION['user_id']; //Storing user ID in SESSION variable.
echo checkUser(); // authenticate logged in users
require_once 'incfiles/theme/head_open.php';
############################### page title #######################

	$page_title='Upload New Ad - '.APPNAME;
	$site_dsc="Upload New Ad - ".APPNAME;
	
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');
 
$checkTr=$db->query("SELECT user_id_fk FROM tranfer_request WHERE user_id_fk='$user_id' ");

$countExist=mysqli_num_rows($checkTr);
//if ($countExist) {
?>
<h2 align="center">Create New Ads</h2>
         
<div class="main_box">
    <div class="light_box">
         
         <?php
         include 'incfiles/uploadAdsImg.php';
         ?>
</div>

  <div class="light_box" style="font-size: 13px">
    
<form enctype="multipart/form-data" action="" method="post">
 	<table>
		<tbody><tr>
				<td class="w"><b>Ad Name</b>: <input class="expansible_input" id="adsName" required='' name="adsName" type="text" value=""><br>
				(Used to identify if running more than one ads)</td>
			</tr>
			<tr>
				<td class="w"><b>Landing Page</b>:
	<select name="catId" required=""> 
    <option value=''>Select Category</option> 
    <?php
    $queryBoard=$db->query("SELECT * FROM category C, sub_cat S WHERE C.cid=S.cid_fk group by S.sname ORDER BY S.sid");
//fetch rows
/*
Define topics, category, and sub cat details and variables
*/
while($bdata=$queryBoard->fetch_assoc()){
$sname=$bdata['sname'];
$sid=$bdata['sid'];
$cid=$bdata['cid'];
$catcost=$bdata['catcost'];

if($sname=='Homepage')
{
 echo '<option value="index|0|'.$catcost.'">'.$sname.'</option>';   
}
else
{
    echo '<option value="'.$cid.'|'.$sid.'|'.$catcost.'">'.$sname.'</option>';
}


}
?>
    </select><br>
				(the website or webpage that your banner ad should lead to when anyone clicks on it)</td>
			</tr>
			<tr>
				<td><b>Ad Banner</b>: <div id="filediv"><input name="file[]" required="" type="file" id="file"/></div>Ads Name<br>
				Ads should be <b>318 pixels</b> wide, <b>106 pixels</b> tall, <b>less than 30KB</b> in size,and in the <b>JPG</b> or <b>PNG</b> format.<br>
				They should have <b>a clear message</b>, <b>legible text</b>, your <b>name</b>/<b>brand</b>/<b>logo</b>/<b>url</b>, <b>good design</b> and <b>no border</b>.</td>
			</tr>
			<tr>
				<td class="w"><b>Landing Page</b>: <input class="expansible_input" id="baseUrl" required='' name="baseUrl" type="text" value="http://www."><br>
				(the website or webpage that your banner ad should lead to when anyone clicks on it)</td>
			</tr>
			<tr>
			<td>
			<input type="submit" name="submit" value="Upload Ad" id="upload"></td>
			</tr>
		</tbody>
	</table> 
</form>

  </div>
  <div class="dark_box" style="border: none;">
  <p class="small">(<a href="#up"><b>Go Up</b></a>)</p>
</div>
</div>

<?php


//load footer from footer.php
require_once ('footer.php');

?>

	</div>
<!-- GOOGLE ANALYSTIC GOES HERE -->

</body>
</html>
