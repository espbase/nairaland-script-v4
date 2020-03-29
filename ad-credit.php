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

if (DEVELOPER==='Marshall')
{
$user_id=$_SESSION['user_id']; //Storing user ID in SESSION variable.
############################################### site content
//$siteinfo = new site();
//echo $siteinfo->discription(APPINFO);
$page_title='Ads Credit Management';
$site_dsc='Ads Credit Management';

echo checkUser(); // authenticate logged in users
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
/*
developer credit
Don't temper or try to edit and modify
*/
$app = new info();
//echo $app->devInfo();
/////////////////////////////////////////////////
?>
<!--<p id="legend2">
</p>
<div class="holder">
</div>-->

<h2>Ads Found Management</h2>
<!-- item container -->
 <div id="wrapper">
      <div class="contents">
	
<div class="main_box">
<div class="light_box" style=" text-align: center;">
    <form action="" method="get">
  <b>Enter Username: </b> <input name="username" size="25" type="text" id="qsearch" placeholder="Search Users">
    <button name="search" type="submit" id="reload-button" class="blue-button text-button">Search</button>
</form>
		
	</div>

  <div class="dark_box" style="border: none;">


<?php
if(isset($_GET['username']))
{
   $user = $_GET['username'];
   
   $queryCall = $db->query("SELECT * FROM users WHERE username='$user' ");
   $count = mysqli_num_rows($queryCall);
   if($count)
   {
    $data=mysqli_fetch_assoc($queryCall);
    
      $username=$data['username'];
      $email=$data['email'];
      $ad_credit=$data['ad_credit'];
      
      
if(isset($_POST['amt']))
{
    $amt= $_POST['amt'];
    $totalad_credit = $ad_credit+$amt;
    
    
  $sql = $db->query("UPDATE users SET ad_credit='$totalad_credit' WHERE username='$username' ");  
   echo "<h4>Account successfully Founded!</h4>";
   
   
$mail->addAddress($email); // Name is optional;
$mail->isHTML(true);
$mail->Subject ='Your Account Has Been Founded!';
$mail->Body = '<div class="email--background">
  
  <div class="email--container">
    <div class="email--inner-container">
      <img src="'.URL.'/images/logo.png"/>
    <p>Dear '.ucfirst($username).',<br>

Your payment has been confirmed and approved. Your account was funded ('.CURRENCY.' '.$amt.').

<p>
To buy more credits, please pay at least <b>'.CURRENCY.' 3,500.00</b> into this account <br>
Co-operative Bank of Kenya -<b>Account No- 01109496110900 Kennedy N.  Sande </b> then on the business number input <b>400200</b> and account no input this account number and send your '.APPNAME.' username and evidence of payment to <a href="mailto:'.ADEMAIL.'">'.ADEMAIL.'></a>. Foreign advertisers should pay using Orderbay & Paypal.</p>
<p>Pay Through mpesa<br>
Go to the M-pesa Menu.<br>
Select Pay Bill.<br>
Enter Business No.<b> 400200.</b><br>
Enter Account No. <b>01109496110900</b> –Bank account number.<br>
Enter the Amount.<br>
Enter your <b>M-Pesa PIN</b> then send.</p>
    
       <hr>
    <h3>Best Regards</h3>
    <p>'.APPNAME.' Team <br> < <a href="'.URL.'" class="cta">Website</a> ></p>
    </div>
  </div>
</div>';
if (!$mail->send()) {
 echo '<div style="width:100%;text-align:center; color:#C5110BCC; font-weight:bold">Oops! an unknow error occured</div>';
}
}
    ?>
    <h2>Fund <?php  echo ucfirst($username); ?> Account - Balance (<?php echo $ad_credit; ?>)</h2>
    <form action="" method="post">
  <b>Enter Credit Amount: </b> <input name="amt" size="25" type="text" id="qsearch" placeholder="Enter Credit">
    <button name="search" type="submit" id="reload-button" class="blue-button text-button">Submit</button>
</form>
    
    <?php
    }
    else
    {
        echo "<h2>Oops! no username found</h2>";
    }
                
                  
   }



?>
</div>
</div>



</div>
<!-- navigation holder -->
<div class="holder">
</div>

<!-- item container -->


<?php

//load footer statistic from footer_stat.php
//require_once ('footer_stat.php');

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
