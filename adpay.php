
<?php
/*
Developer: Marshall Unduemi
Url: www.codexpresslabs.info
Contact: info@codexpresslabs.info
pesapal-php-master
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

 	<table>
		<tbody><tr>
				<td class="w"><h2 align="center">Kenyans247 Payment System </h2></td>
			</tr>
			<tr>
				<td class="w">
				    <?php require ('pesapal-php-master/pesapal-iframe.php')?>
				</td>
			</tr>
			<tr>
			<td>
			<input type="submit" name="submit" value="Upload Ad" id="upload"></td>
			</tr>
		</tbody>
	</table> 


  <div class="dark_box" style="border: none;">
  <p class="small">(<a href="#up"><b>Go Up</b></a>)</p>

<?php


//load footer from footer.php
require_once ('footer.php');

?>

	</div>
<!-- GOOGLE ANALYSTIC GOES HERE -->

</body>
</html>
