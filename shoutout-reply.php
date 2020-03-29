<?php
/*
Developer: Marshall Unduemi
Url: www.nl.codexpress.info/
Contact: hello@codexpress.info

*/
//Enable Error Reporting

//error_reporting(0);
//remove the above comment to enable error reporting


if (file_get_contents('config.php')) { // if configured

require_once ('config.php');
require_once ('functions.php');


/*
NOTE: Don't remove this line of code
this serve as the developer property
that exist between the app and the third party
*/

$site_title=APPNAME.' Forum';
if (DEVELOPER==='Marshall')
{

############################################### site content
//$siteinfo = new site();
//echo $siteinfo->discription(APPINFO);
require_once 'createxml.php';
require_once 'incfiles/theme/head_open.php';
############################### page title #######################

	$page_title=APPNAME.' shoutout';
	$site_dsc=DSC;
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
//load header.php -->


if (!file_exists('install.php')) {

require_once ('header.php');


if (file_exists('config.php')) {
?>
<style type="text/css">

/* mak images fill their container*/
img {
  max-width: 98%;
}
img:hover {
  opacity: 0.5;
  cursor: pointer;
}

/* Bigger than Phones(tablet) */
@media only screen and (min-width: 750px) {
  .img-grid {
    width: 80%;
  }
}

/* Bigger than Phones(laptop / desktop) */
@media only screen and (min-width: 970px) {
  .img-grid {
   width: 90%;
  }
}

</style>
 <!--<a href="classified"><img src='https://i.imgur.com/xXj15Jo.png' id=""> </a>-->

<table class="boards" style="font-size:10px !mportant; ">
  <tbody>
    <tr>
      <td class="l w">
        <?php
        //echo $timeout;
        $sid = $_GET['sid'];
        $qryshout = $db->query("SELECT * FROM shoutout WHERE  shout_id='$sid' AND sstatus='1'");
        $shoutoutcode = mysqli_num_rows($qryshout);
        if ($shoutoutcode) {
        $sr = mysqli_fetch_assoc($qryshout);
        $msg = $sr['msg'];
        $rtime1 = $sr['rtime'];
        $shout_id = $sr['shout_id'];
        ?>
        <p class="shoutout" style="border-bottom: solid 0.5px #fff;">
          <?php echo $msg; ?>
          <!--» <span style="float: right; padding-right: 10px"><i>Anonymous <?php echo time_passed($rtime); ?></i>
          </span>-->
<?php
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_POST['content'])) {
$msg = addslashes($_POST['content']);
$rtime = time();
$insdb = $db->query("INSERT INTO shoutout_reply (sid_fk, rtext, ruid_fk, rdated)
VALUES ('$sid', '$msg', '$user_id', '$rtime')");
if ($insdb) {
# code...
// echo "<p>Posted, pending admin approval</p>";
}
}

////////////////////////////////////////  reply on shoutout  ////////////////////////////////////////////////////////////////

///////////////////////// like on shoutout ./////////////////////

$qryslikess = $db->query("SELECT * FROM topic_likes T, users U 
  WHERE  T.topic_id_fk='$shout_id' AND T.ctype='shoutout' AND T.uid_fk='$user_id' GROUP BY T.tid ");
$countslikess = mysqli_num_rows($qryslikess);

if ($countslikess==0) {

if (isset($_GET['type'])) {
$rtime = time();
$insdb = $db->query("INSERT INTO topic_likes (topic_id_fk, uid_fk, ctype, dated)
VALUES ('$sid', '$user_id', 'shoutout', '$rtime')");
}

}

$qryslikes = $db->query("SELECT * FROM topic_likes T, users U 
  WHERE  T.topic_id_fk='$shout_id' AND T.ctype='shoutout' AND T.uid_fk='$user_id' GROUP BY T.tid ");
$countslikes = mysqli_num_rows($qryslikes);

$qrysalllikes = $db->query("SELECT * FROM topic_likes T, users U 
  WHERE  T.topic_id_fk='$shout_id' AND T.ctype='shoutout' GROUP BY T.tid ");
$countsalllikes = mysqli_num_rows($qrysalllikes);


if (isset($_GET['type'])) {
  $type = $_GET['type'];

  if ($countslikess==0) {

  if ($type=='like') {
    # code...
    $rtime = time();
    $insdb = $db->query("INSERT INTO topic_likes (topic_id_fk, uid_fk, ctype, dated)
    VALUES ('$sid', '$user_id', 'shoutout', '$rtime')");
  }
}


// delete likes
if ($type=='unlike') {
    # code...
$insdb = $db->query("DELETE FROM topic_likes WHERE topic_id_fk='$sid' AND uid_fk='$user_id' ");
  }


}


/////////////////////////shoutout comment./////////////////////
$qryreply = $db->query("SELECT * FROM shoutout_reply S, users U 
  WHERE  S.sid_fk='$shout_id' AND U.uid=S.ruid_fk ORDER BY S.sid_fk DESC ");
$shoutoutreply = mysqli_num_rows($qryreply);
?>
<br><small> <a href="javascript:void();"><i>Anonymous <?php echo time_passed($rtime1); ?></i></a> •
<a href="shoutout-reply?sid=<?php echo $shout_id; ?>">(<?php echo formatWithSuffix($shoutoutreply); ?>) comment </a> • 
<?php
if ($countslikes) {
  # code...
  $showlikes = 'You and '.formatWithSuffix($countsalllikes-1).' like this';
  $liketype = 'unlike';
}else
{
 $showlikes = '('.formatWithSuffix($countsalllikes).') like this';
 $liketype = 'like';
}
?>
<a href="?sid=<?php echo $shout_id; ?>&type=<?php echo $liketype; ?>"><?php echo ($showlikes); ?></a></small></p>
<?php
///////////////////////// reply on shoutout ./////////////////////
if ($shoutoutreply) {
while($sr1 = mysqli_fetch_assoc($qryreply))
{
$rtext = $sr1['rtext'];
$rdated = $sr1['rdated'];
$usern = $sr1['username'];
echo '<p>'.$rtext.' <br> <small><a href="javascript:void();"><i>'.$usern.'</i> '.time_passed($rdated).'</a></small></p>';
} }else{echo "<h3 align='center'>Be the first to leave a reply!</h3>";}
///////////////////////////////////////////////////////////////////////////////
}else{echo "<h1 align='center'>Oops! sorry, shoutout not found!</h1>"; } ?>
<span class="shoutout-reply"><a href="addshoutout.php">Posts a new shoutout</a> </span>
</td>
      </tr>
      <tr>
        <td>
          <h3>We love comments</h3>
          <?php
          if ($user_id!=0) {
          ?>
          <form method="POST" action="" id="postform" name="postform" enctype="multipart/form-data">  
        <textarea rows="4" cols="80" placeholder="Type your reply here, word limit 200" maxlength="200" name="content" id="body"></textarea><p>
          <p><input name="send" type="submit" value="Submit"></p>
          </form>
        <?php }else{echo "<h4><a href='login' title='login'>Please login to share comments</a></h4>";} ?>
        </td>
      </tr>
    </tbody>
  </table>
 
<?php
//echo '<div style="font-family:Lora;" >Welcome To '.$page_title.' :: Meet People and Make New Friends!</div>';

}
//echo "Value is: " . $_COOKIE['password'];


//load footer statistic from footer_stat.php
require_once ('footer_stat.php');

echo '<p class="small">(<a href="#top"><b>Go Up</b></a>)</p>';


//load footer from footer.php
require_once ('footer.php');

}

else
{
  if (isset($_GET['delete'])=='install') {
    # code...
  if(is_file('install.php'))
  {
          unlink('install.php'); //delete file
  }
  }

 if (isset($_GET['status'])=='completed') { 
	echo '<h2>Install Script!</h2>
<table>
  <tr>
    <td class="w">
      <p style="color:red">========================= Warning! =========================</p>
      - Locate <b>install.php</b> file and delete it after installation...<br> Or 
            <a href="?delete=install"><b>Delete install.php File</b></a> from here with one click
    </td>
  </tr>
</table>';
}
else
{
  echo '<h2>Install Script!</h2>
<table>
  <tr>
    <td class="w">========================= Instruction =========================<br>
      <a href="install">Start Installation...</a><br>
      Contact <a href="mailto:unduworldofliving@gmail.com">support &rsaquo;&rsaquo;</a>  if any problem occure 
      </a>
    </td>
  </tr>
</table>';
}
}

?>

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
//header('location: http://www.codexpresslabs.info');
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
}
}
else{
	header('location: install.php');
}
?>
<script type="text/javascript" src="js/nl2.js"></script>