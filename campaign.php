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
echo Checkuser();

$user_id=$_SESSION['user_id']; //Storing user ID in SESSION variable.
echo checkUser(); // authenticate logged in users
require_once 'incfiles/theme/head_open.php';
############################### page title #######################


	$page_title='Campaign  - '.APPNAME;
	$site_dsc="Campaign  - ".APPNAME;
	
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');

echo '<a id="top" name="top"></a>'; // anchor

##################### registration form ########################
?>

 
                <!-------Including PHP Script here------>
<?php 
$checkTr=$db->query("SELECT user_id_fk FROM tranfer_request WHERE user_id_fk='$user_id' ");

$countExist=mysqli_num_rows($checkTr);
//if ($countExist) {
include 'incfiles/uploadAdsImg.php'; 

  
  $callads1 = $db->query("SELECT * FROM ads WHERE uid_fk='$user_id' AND adsStatus='active' ");
  $countads = mysqli_num_rows($callads1);
  
    $callads1 = $db->query("SELECT * FROM text_ads WHERE uid_fk='$user_id' AND adsStatus='active' ");
  $countadstext = mysqli_num_rows($callads1);
?>

         <h2 align="center">Campaign - <?php echo APPNAME; ?> Ads</h2>
        
         
         <p> <b>(<a href="<?php echo URL; ?>/verify-coupon?payment=coupon">Verify Coupon</a>)  (<a href="<?php echo URL; ?>/classified">Classified</a>)  (<a href="<?php echo URL; ?>/user-campaign">Banner Ad Stats (<?php echo $countads; ?>)</a>) (<a href="<?php echo URL; ?>/textad-stat">Text Ad Stats (<?php echo $countadstext; ?>)</a>)</b></p>

 <table><tbody><tr><td class="">        
<?php //require('admessage.php');

echo $admsger; 

$callads = $db->query("SELECT SUM(adCost) AS spentcost  FROM ads WHERE uid_fk='$user_id' AND adsStatus='active' ");
    $data = mysqli_fetch_array($callads);
    $spentcost = $data['spentcost'];

$callads1 = $db->query("SELECT SUM(adCost) AS spentcost  FROM text_ads WHERE uid_fk='$user_id' AND adsStatus='active' ");
    $data1 = mysqli_fetch_array($callads1);
    $spentcost1 = $data1['spentcost'];
        ?>

</td></tr></tbody></table>

<table><tbody><tr><th>Ads</th></tr><tr><td class="w">Please click <i>(Upload New Ad)</i> to upload a banner ad.</td></tr></tbody></table>



<p></p>(<a href="<?php echo URL; ?>/uploadad">Upload Banner Ad</a>) (<a href="<?php echo URL; ?>/upload-textad">Upload Text Ad</a>)	
</p>

    
<table><tbody><tr><td class=""><b>Advertising Credits</b>: <b><?php echo CURRENCY. ' '. $ses_adCredit;  ?></b></td></tr>
<tr><td class="w"><b>Amount Spent So Far</b>: <?php echo $spentcost+$spentcost1;  ?> <b><?php echo CURRENCY;  ?></b></td>
</tr><tr><td class=""><b>Advertising Cost</b>: <b><?php echo CURRENCY;  ?></b> per week (). <a href="/adrates"><b>Estimated Ad Rates</b></a>.</td></tr></tbody></table>




  <p class="small">(<a href="#up"><b>Go Up</b></a>)</p>

<?php


//load footer from footer.php
require_once ('footer.php');

?>


</body>
</html>
