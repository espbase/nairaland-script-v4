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
echo Checkuser();

require_once 'incfiles/theme/head_open.php';
############################### page title #######################
  $user=$_GET['user'];
  $page_title=$user.'Campaign Manager';
  $site_dsc=$user.'Campaign Manager';

require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

################################# include files ##########################

//load header.php
require_once ('header.php');

require_once ('incfiles/topicCount.php'); // count page view function
require 'incfiles/bbparser.php'; // phpbb code parser
?>


<h2>Ads Management</h2>
<!-- item container -->
 <div id="wrapper">
      <div class="contents">
  <?php
  //delete ads
  if (isset($_GET['deleteid'])) {
    $adsGetId=$_GET['deleteid'];
    $dleteAds=$db->query("DELETE FROM ads WHERE adsId='$adsGetId' ");
    # code...
  }
  //Pause ads
  if (isset($_GET['pauseid'])) {
    $pauseid=$_GET['pauseid'];
    $pdateClicks=$db->query("UPDATE ads SET adsStatus='0' WHERE adsId='$pauseid'");
    # code...
  }
  //Pause ads
  if (isset($_GET['activateid'])) {
    $activateid=$_GET['activateid'];
    $pdateClicks=$db->query("UPDATE ads SET adsStatus='1', reason='' WHERE adsId='$activateid'");
    # code...
    
    $calluser = $db->query("SELECT * FROM users U, ads A WHERE A.uid_fk=U.uid AND A.adsId='$activateid' ");
    
    $data = mysqli_fetch_array($calluser);
        $username = $data['username'];
        $email = $data['email'];


$mail->addAddress($email); // Name is optional;
$mail->isHTML(true);
$mail->Subject ='Your Ad Has Been Approved!';
$mail->Body = '<div class="email--background">
  
  <div class="email--container">
    <div class="email--inner-container">
      <img src="'.URL.'/images/logo.png"/>
    <p>Dear '.ucfirst($username).',<br>

An ad you created on '.APPNAME.' has been approved! 

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
  
    //reject campaign ads
  if (isset($_GET['reason'])) {
    $reason=$_GET['reason'];
    $aid=$_GET['aid'];
    
    $pdateClicks=$db->query("UPDATE ads SET adsStatus='0', reason='$reason' WHERE adsId='$aid'");
    # code...
    
    $calluser = $db->query("SELECT * FROM users U, ads A WHERE A.uid_fk=U.uid AND A.adsId='$aid' ");
    
    $data = mysqli_fetch_array($calluser);
        $username = $data['username'];
        $email = $data['email'];
      $adsName=$bdata['adsName'];
      $baseUrl=$bdata['baseUrl'];
      $adsId=$bdata['adsId'];
      $imgUrl=$bdata['imgUrl'];
      $adsDate=$bdata['adStart'];
      $adsClicks=$bdata['adsClicks'];
      $username=$bdata['username'];
      $adsStatus=$bdata['adsStatus'];
      $user_id=$bdata['uid'];
      $adStart=$bdata['adStart'];
      $sub_id=$bdata['sub_id'];
      $catId=$bdata['catId'];
      $adCost=$bdata['adCost'];

$mail->addAddress($email); // Name is optional;
$mail->isHTML(true);
$mail->Subject ='Your Ad Has Been Rejected!';
$mail->Body = '<div class="email--background">
  
  <div class="email--container">
    <div class="email--inner-container">
    <p>Dear '.ucfirst($username).',<br>

<p>	Your ad isn\'t approved because it doesn\'t comply with our Advertising Policies. You can click the ad name below to see why it wasn\'t approved and edit the ad to have it reviewed again.</p>! 

<p><a href="'.URL.'/edit-campaign?adid='.$adsId.'">REVIEW</a></p>

<ul>
        <li><b>Boosted Ad: </b> <span class="s"><b>'.$adsName.'</b></span></li>
        <li><b>Account</b><span class="s"><b>'.$username.'</b></span></li>
    </ul>
    
<p>
To buy more credits, please pay at least <b>'.CURRENCY.' 7,000.00</b> into this account <br>
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

echo '<h4 style="color:red; font-weight:bolder;">Submitted</h4>';

if (!$mail->send()) {
 echo '<div style="width:100%;text-align:center; color:#C5110BCC; font-weight:bold">Oops! an unknow error occured</div>';
}
    
  }
?>

<table>
<tbody>

<?php
  @$queryBoard=$db->query("SELECT * FROM ads A, users U WHERE A.uid_fk=U.uid group by A.adsId ORDER BY A.adsId DESC");
  //fetch rows
  /*
  Define topics, category, and sub cat details and variables
  */
  while($bdata=$queryBoard->fetch_assoc()){
  $adsName=$bdata['adsName'];
  $baseUrl=$bdata['baseUrl'];
  $adsId=$bdata['adsId'];
  $imgUrl=$bdata['imgUrl'];
  $adsDate=$bdata['adStart'];
  $adsClicks=$bdata['adsClicks'];
  $username=$bdata['username'];
  $adsStatus=$bdata['adsStatus'];
  $user_id=$bdata['uid'];
  $adStart=$bdata['adStart'];
  $sub_id=$bdata['sub_id'];
  $catId=$bdata['catId'];
  $adCost=$bdata['adCost'];
  
    @$queryBoard1=$db->query("SELECT * FROM sub_cat  WHERE sid='$sub_id' ");
  //fetch rows
  /*
  Define topics, category, and sub cat details and variables
  */
$bdata1=$queryBoard1->fetch_assoc();
  $sname=$bdata1['sname'];
  $surl=$bdata1['surl'];
  $catcost=$bdata1['catcost'];
  
  
  if($catId=='index')
  {
      $board='<a href="'.URL.'/index"><b>Home Page</b></a>';
  }
  else
  {
      $board='<a href="'.URL.'/forum/'.$surl.'"><b>'.ucfirst($sname).'</b></a>';
  }

?>
	<tr>
	<td class="bold l pu">
<a href="<?php echo WEBROOT."/$data[topic_id]/$data[link]"; ?>">
      <?php echo ucfirst($adsName); ?></a>

    by <a class="user" href="<?php echo WEBROOT;  ?>/callback/<?php echo $adsId;  ?>" target="_blank"><?php echo ucfirst($username)." ( $adsClicks clicks)"; ?></a></span>
    
    <ul>
        <li><b>Published Date</b> <span class="s"><b><?php echo ucfirst($adStart); ?></b></span></li>
        <li><b>Ad Cost:</b> <?php echo CURRENCY.' '.$adCost; ?>/week</li>
        <li><b>Target Category:</b> <span class="s"><?php echo $board; ?></span></li>
    </ul>
    <form action="" method="get">
  <b>Reject Campaign: </b> <input name="reason" size="25" type="text" id="qsearch" placeholder="Enter Reason">
   <input name="aid" type="hidden" value="<?php echo $adsId; ?>">
    <button name="search" type="submit" id="reload-button" class="blue-button text-button">Reject</button>
</form>

		</tr>
		<tr>
			<td class="l w pd" id="pb78674027">
				<div class="narrow">

        <?php
        echo '<div align="left"><img src="'.URL.'/images/ad/'.$imgUrl.'" ></div>';
        // if it is admin show banned topic link
        $checkAccesslevel=$db->query("SELECT * FROM users WHERE uid='$user_id' ");
        $do_exist=$checkAccesslevel->num_rows;
        
        if($do_exist) // if is admin
        {
        $data1=$checkAccesslevel->fetch_assoc();
        $access=$data1['access']; // get access level
        if($access>=1 ) // get permission
        {
        echo '( <a href="'.WEBROOT.'/adcontrol?deleteid='.$adsId.'">Delete Campaign</a> )';
        // create admin post url

        if ($adsStatus=='0') {
          echo '( <a href="'.WEBROOT.'/adcontrol?activateid='.$adsId.'">Activate Campaign ads</a> )';
        }
        elseif ($adsStatus=='1') {
          echo '( <a href="'.WEBROOT.'/adcontrol?pauseid='.$adsId.'">Pause Campaign</a> )';
        }
        
        }
        else
        {
        //echo 'Ordinary user';
        //echo '<small><a href="'.WEBROOT.'/'.$adsId.'">Banned topic</a></small>';
        }
        if ($adsStatus=='0') {
          # code...
          echo '- <span style="color:red; font-weight:bolder;">waiting for activation</span>';
        }

        }
        ?>
        </div>
	</td>
		</tr>

<?php }  ?>
</tbody>
</table>

    
<?php
echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';


//load footer from footer.php
require_once ('footer.php');

?>

</body>
</html>
