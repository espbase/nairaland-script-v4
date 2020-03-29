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


<h2>Campaign Manager - <?php echo APPNAME; ?></h2>
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
?>
  

  
  <table>
<tbody>
<?php
 @$queryBoard=$db->query("SELECT * FROM ads A, users U WHERE A.uid_fk='$user_id' AND A.uid_fk=U.uid group by A.adsId");
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
  $uid_fk=$bdata['uid_fk'];
  $adStart=$bdata['adStart'];
  $sub_id=$bdata['sub_id'];
  $catId=$bdata['catId'];
  $adCost=$bdata['adCost'];
  $reason=$bdata['reason'];
  
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
      $board="Home Page";
  }
  else
  {
      $board='<a href="'.URL.'/forum/'.$surl.'"><b>'.ucfirst($sname).'</b></a>';
  }

?>

  	<tr>
	<td class="bold l pu">  
    <ul>
        <li><b>Campaign Name: </b> <a class="user" href="<?php echo WEBROOT;  ?>/callback/<?php echo $adsId;  ?>" target="_blank"><?php echo ucfirst($adsName); ?></a></li>
        <li><b> By: </b> <a class="user" href="<?php echo WEBROOT;  ?>/callback/<?php echo $adsId;  ?>" target="_blank"><?php echo ucfirst($username); ?></a></li><br>
        <li><b>Total Clicks: </b> <a class="user" href="<?php echo WEBROOT;  ?>/callback/<?php echo $adsId;  ?>" target="_blank"><?php echo ucfirst($adsClicks); ?></a></li>
        <li><b>Days So far</b> <span class="s"><b><?php //echo ($adStart); ?> <?php echo addays($adStart); ?> day's</b> </b></span></li>
        <li><b>Ad Cost:</b> <?php echo CURRENCY.' '.$adCost; ?>/week</li>
        <li><b>Target Category:</b> <span class="s"><?php echo $board; ?></span></li>
        <li><b>Ad Status:</b> <span class="s"><?php echo $adsStatus; ?></span></li>
    </ul>
    
  	</tr>
		<tr>
			<td class="l w pd" id="pb78674027">
				<div class="narrow">
        <?php
        echo '<div align="left"><img src="'.WEBROOT.'/images/ad/'.$imgUrl.'" width="250px"></div>';
        

        if ($uid_fk==$ses_user_id) {
            if ($adsStatus=='rejected' OR $adsStatus=='pending' OR $adsStatus=='review') {
            
          echo '( <a href="'.WEBROOT.'/edit-campaign?adid='.$adsId.'">Modify Campaign</a> )';
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
