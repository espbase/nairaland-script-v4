
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
require 'mail.config.php';
$mail->From = REPLYEMAIL;
$mail->FromName = APPNAME;

//echo checkUser(); // authenticate logged in users
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
 




if (isset($_GET['pesapal_merchant_reference']) && ($_GET['pesapal_transaction_tracking_id'])) {
    
$pesapal_transaction_tracking_id = $_GET['pesapal_transaction_tracking_id'];
$pesapal_merchant_reference = $_GET['pesapal_merchant_reference'];
$userid = $_GET['uid'];

$swlwcQury =$db->query("SELECT * FROM adorders WHERE track_id='$pesapal_transaction_tracking_id' AND ref='$pesapal_merchant_reference' AND uid_fk='$userid' ");
$numrow=mysqli_num_rows($swlwcQury);


?>
<table>
		<tbody><tr>
				<td class="w">
				    <h4><img src="images/success.png" width="70"> Your Order Was Successful</h4>
            <p>We are truly grateful to you for placing ads with us and giving us the opportunity to grow. None of our achievements would have been possible without you and your unwavering support. 😊
				</td>
			</tr>
			<tr>
			<td>
			<p>Your ad is under review by our admisnistrators. please be patient, thank you</p></td>
			</tr>
		</tbody>
	</table> 

<?php

if($numrow==0)
{
$updateQury = $db->query("INSERT INTO adorders (uid_fk, ref, track_id, order_date) 
  VALUES ('$userid', '$pesapal_merchant_reference', '$pesapal_transaction_tracking_id', NOW()) ");



$queryUserDetails=$db->query("SELECT * FROM adorders A, users U 
WHERE 
A.ref='$pesapal_merchant_reference'
AND A.track_id='$pesapal_transaction_tracking_id' 
AND A.uid_fk=U.uid 
AND A.uid_fk='$userid' 
");

	$data=mysqli_fetch_assoc($queryUserDetails);
	$username=$data['username'];
    $email=$data['email'];



// Enable TLS encryption, `ssl` also accepted

$mail->addAddress($email);               // Name is optional;
$mail->isHTML(true);
$mail->Subject ='Payment Successful';
$mail->Body = '<img src="'.URL.'/images/logo.png"/>
    <p>Dear '.$username.',<br>
    Your ad payment was successful, it will display in few minuts
    
    </p>
    <h3>Best Regards</h3>
    <p>'.APPNAME.' Team <br> < <a href="'.URL.'" class="cta">Website</a> ></p>';
if (!$mail->send()) {
 echo '<div style="width:100%;text-align:center; color:#C5110BCC; font-weight:bold">Oops! an unknow error occured</div>';
}

}
?>

 	
<?php } ?>

  <div class="dark_box" style="border: none;">
  <p class="small">(<a href="#up"><b>Go Up</b></a>)</p>
</div>


<?php


//load footer from footer.php
require_once ('footer.php');

?>


</body>
</html>
