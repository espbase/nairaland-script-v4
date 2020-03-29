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
include 'incfiles/uploadAdsImg.php'; 

  
  $callads1 = $db->query("SELECT * FROM ads WHERE uid_fk='$user_id' AND adsStatus='active' ");
  $countads = mysqli_num_rows($callads1); 
?>

         <h2 align="center">Campaign - <?php echo APPNAME; ?> Ads</h2>
        
         
         <p></p>(<a href="<?php echo URL; ?>/user-campaign">Banner Ad Stats (<?php echo $countads; ?>)</a>) (<a href="<?php echo URL; ?>/textad-stat">Text Ad Stats</a>)</p>

<table>
    <tbody>
        <?php
 @$queryBoard=$db->query("SELECT * FROM text_ads A, users U WHERE A.uid_fk='$user_id' AND A.uid_fk=U.uid group by A.adsId");
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
@$i = $i + 1;
			if($i%2 == 0)
			{ $w='w'; } 
			
			else
			{ $w=''; }
?>
        <tr>
            <td class="<?php echo $w; ?>">
            <ul style="list-style:none; text-align:left !important">
        <li><b>Campaign Name: </b> <a class="user" href="<?php echo WEBROOT;  ?>/callback/<?php echo $adsId;  ?>" target="_blank"><?php echo ucfirst($adsName); ?></a></li>
        <li><b> By: </b> <a class="user" href="<?php echo WEBROOT;  ?>/callback/<?php echo $adsId;  ?>" target="_blank"><?php echo ucfirst($username); ?></a></li>
        <li><b>Total Clicks: </b> <a class="user" href="<?php echo WEBROOT;  ?>/callback/<?php echo $adsId;  ?>" target="_blank"><?php echo ucfirst($adsClicks); ?></a></li>
        <li><b>Days So far</b> <span class="s"><b><?php //echo ($adStart); ?> <?php echo addays($adStart); ?> day's</b> </b></span></li>
        <li><b>Ad Cost:</b> <?php echo CURRENCY.' '.$adCost; ?>/week</li>
        <li><b>Target Category:</b> <span class="s"><?php echo $board; ?></span></li>
        <li><b>Ad Status:</b> <span class="s"><?php echo $adsStatus; ?></span></li>
        <?php
        if ($uid_fk==$ses_user_id) {
            if ($adsStatus=='rejected' OR $adsStatus=='pending' OR $adsStatus=='review') {
            
          echo '( <a href="'.WEBROOT.'/edit-textad?adid='.$adsId.'">Modify Campaign</a> )';
        }
        }
        
        ?>
    </ul>
            </td>
        </tr>
        <?php } ?>
</tbody>
</table>




  <p class="small">(<a href="#up"><b>Go Up</b></a>)</p>

<?php


//load footer from footer.php
require_once ('footer.php');

?>


</body>
</html>
