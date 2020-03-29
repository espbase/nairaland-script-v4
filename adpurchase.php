
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

?>

 	<table>
		<tbody><tr>
				<td class="w"><h2 align="center"><?php echo strtoupper(APPNAME); ?> PAYMENT SYSTEM</h2></td>
			</tr>
			<tr>
				<td class="w">
				
				<?php
				if (isset($_GET['adid'])) {
                $adid = $_GET['adid'];
                $type = $_GET['type'];
                
                if($type=='banner')
                {
				$last_id=$db->query("SELECT * FROM `ads` WHERE adsId='$adid' " );
                $row=mysqli_fetch_assoc($last_id);
                $adCost=$row['adCost'];
                }
                if($type=='text')
                {
				$last_id=$db->query("SELECT * FROM `text_ads` WHERE adsId='$adid' " );
                $row=mysqli_fetch_assoc($last_id);
                $adCost=$row['adCost'];
                }
                
				
				?>
<form action="" method="post">
	<table>
	    <tr>
			<td colspan="2"><p><?php //echo $admsger; ?> <h2>Your ad is successfully published, waiting approval. Thank you</h2></p>
			<input type="hidden" name="description" value="Payment of ad on <?php echo APPNAME; ?>" />
			<input type="hidden" name="type" value="MERCHANT" readonly="readonly" />
			<input type="hidden" name="uid" value="<?php echo $user_id; ?>" />
			</td>
		</tr>
		<tr>
			<td>Amount:</td>
			<td><input type="text" name="amount" value="<?php echo ($adCost); ?>" />
			
			</td>
		</tr>
		<tr>
			<td>Reference:</td>
			<td><input type="text" name="reference" readonly value="<?php echo $adid; ?>" readonly />
			
			</td>
		</tr>
		<tr>
			<td>First Name:</td>
			<td><input type="text" name="first_name" value="<?php echo $ses_name; ?>" /></td>
		</tr>
		<tr>
			<td>Username:</td>
			<td><input type="text" name="last_name" value="<?php echo $ses_username; ?>" /></td>
		</tr>
		<tr>
			<td>Email Address:</td>
			<td><input type="text" name="email" value="<?php echo $ses_email; ?>" /></td>
		</tr>
		<!--<tr>
			<td colspan="2"><input type="submit" value="Make Payment" /></td>
		</tr>-->
	</table>
</form>

<?php } ?></td>
			</tr>
			<tr>
			<td>
			</td>
			</tr>
		</tbody>
	</table> 


  <div class="dark_box" style="border: none;">
  <p class="small">(<a href="#up"><b>Go Up</b></a>)</p>
</div>

<?php


//load footer from footer.php
require_once ('footer.php');

?>


</body>
</html>
