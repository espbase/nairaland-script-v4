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
require_once ('incfiles/agoTime.php');
$perpage = PERPAGE; // how many post to display per page

/*
NOTE: featured post settings,
*/
if(isset($_GET['link']) & !empty($_GET['link']))
{
	$curpage = $_GET['link']; // get current page number
}else{
	$curpage = 1; // or setcurrent page to 1
}
$start = ($curpage * $perpage) - $perpage; // calculate number of pages
$PageSql = "SELECT * FROM `topics` WHERE post_type='post' ORDER BY topic_id ASC"; // fetch post from db
$pageres = $db->query($PageSql); // query post
$totalres = mysqli_num_rows($pageres); // count total number of post available

$endpage = ceil($totalres/$perpage); // get the last page number
$startpage = 1; // initial page set to 1
$nextpage = $curpage +1; // increament pages by 1
$previouspage = $curpage - 1; // de-creament pages by 1

$ReadSql = "SELECT * FROM `topics` WHERE post_type='post' ORDER BY topic_id DESC LIMIT $start, $perpage";
$res = $db->query($ReadSql); // query post with post limit
$rescot = mysqli_num_rows($res); // count total number of post available
/*
END featured post settings,
*/


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

	$page_title=APPNAME.' Forum';
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
/*img:hover {
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



.overlay {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.7);
  transition: opacity 500ms;
  visibility: hidden;
  opacity: 0;
}
.overlay:target {
  visibility: visible;
  opacity: 1;
}
.popup {
  margin: 70px auto;
  padding: 20px;
  background: #fff;
  border-radius: 5px;
  width: 60%;
  position: relative;
  transition: all 2s ease-in-out;
}
.popup .close {
  position: absolute;
  top: 20px;
  right: 30px;
  transition: all 200ms;
  font-size: 30px;
  font-weight: bold;
  text-decoration: none;
  color: #333;
}
.popup .content {
  max-height: 90%;
  width: 90%;
  overflow: auto;
}
</style>
 <!--<a href="classified"><img src='https://i.imgur.com/xXj15Jo.png' id=""> </a>
  <a class="button" href="#popup1">Let me Pop up</a> -->
<?php
$qrynotice = $db->query("SELECT * FROM topics WHERE notice=1 ORDER BY topic_id DESC LIMIT 1");
$countnotice = mysqli_num_rows($qrynotice);
if ($countnotice) {
$ndata = mysqli_fetch_assoc($qrynotice);
                    $link=$ndata['link'];
                    $post_id=$ndata['topic_id'];
                    $title=$ndata['title'];
                    $username=$ndata['username'];
                    $created=$ndata['created'];
                    $content_text=$ndata['content_text'];
                    $notice=$ndata['notice'];
                    $redirect="$post_id/$link"; // create friendly seo post link(url)

//echo $ses_user_id;

$qryfl = $db->query("SELECT * FROM flag_notice WHERE uid_fk='$ses_user_id' AND pid='$post_id' ");
$ctfl = mysqli_num_rows($qryfl);
//echo $ctfl;
if ($ctfl==0) {
$instfl = $db->query("INSERT INTO flag_notice (uid_fk, pid) VALUES ('$ses_user_id', '$post_id')");
  ?>
<div id="notice" class="overlay">
  <div class="popup">
    <h4>PUBLIC ANNOUCEMENT!  </h4>
    <a class="close" href="#!">&times;</a>
    <div class="content">
      <a href="<?php echo $redirect; ?>"><?php echo ucwords($title); ?></a>
      <?php //echo $bb->getHtml($content_text); ?>

    </div>
    <div  align="right"><small><i>Powered by <a class="" href="https://codexpress.info">CodeXpress</a></i></small></div>
  </div>
</div>
<script type="text/javascript">window.location = "#notice"; </script>
<?php } }?>
<?php

//echo '<div style="font-family:Lora;" >Welcome To '.$page_title.' :: Meet People and Make New Friends!</div>';

}


if(isset($_GET['k']))
{
  $k=$_GET['k'];

      echo '<script type="text/javascript">window.location = "'.URL.'/confirm-email?k='.$k.'"; </script>';
}
 
//load board.php list of categories -->
 //require_once ('inc_board.php');


 $sid='index';
//load system header ads template
require ('ads.php');


//load google adsense ads template
require_once ('incfiles/googleads.html');
//load articles from articles.php -->
//require_once ('inc_articles_spon.php');
//load articles from articles.php -->
//require_once ('inc_articles.php');

//load articles from articles.php -->
//require_once ('inc_articles_feed.php');


//load articles from articles.php -->
//require ('inc.radio.php');

//load articles from articles.php -->
//require ('inc.tv.php');


///////////////////////// like on shoutout ./////////////////////
$sid = $_GET['sid'];

$qryslikess = $db->query("SELECT * FROM topic_likes T, users U 
  WHERE  T.topic_id_fk='$sid' AND T.ctype='shoutout' AND T.uid_fk='$user_id' GROUP BY T.tid ");
$countslikess = mysqli_num_rows($qryslikess);


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


   # code...
 $current_time=time(); // get current timestamp
 $timeout = $current_time - (60*$shouttime); // sec 60 by 5 is 5min- 60 secs to 5

//echo $timeout;
$qryshout = $db->query("SELECT * FROM shoutout ORDER BY rtime DESC  ");
$shoutoutcode = mysqli_num_rows($qryshout);
 if ($shoutoutcode) {
?>
 <table class="boards" style="font-size:10px !mportant; ">
    <tbody>
      <tr>
        <td>
          <h3>Daily Shoutout!</h3>
        </td>
      </tr>
      <tr>
        <td class="l w"> <?php
          while($sr = mysqli_fetch_assoc($qryshout))
          {
            $msg = $sr['msg'];
            $rtime = $sr['rtime'];
            $shout_id = $sr['shout_id'];

            $qryreply = $db->query("SELECT * FROM shoutout_reply S, users U 
            WHERE  S.sid_fk='$shout_id' AND U.uid=S.ruid_fk ORDER BY S.sid_fk DESC ");
            $shoutoutreply = mysqli_num_rows($qryreply);


            /////////////////////////////////////////////////
            $qryslikes = $db->query("SELECT * FROM topic_likes T, users U 
            WHERE  T.topic_id_fk='$shout_id' AND T.ctype='shoutout' AND T.uid_fk='$user_id' GROUP BY T.tid ");
          $countslikesss = mysqli_num_rows($qryslikes);

          $qrysalllikes = $db->query("SELECT * FROM topic_likes T, users U 
            WHERE  T.topic_id_fk='$shout_id' AND T.ctype='shoutout' GROUP BY T.tid ");
          $countsalllikes = mysqli_num_rows($qrysalllikes);

          if ($countslikesss) {
            # code...
            if ($countsalllikes==1) {
              # code...
              $showlikes = 'You like this';
            }else
            {
             $showlikes = 'You and ('.formatWithSuffix($countsalllikes-1).') like this'; 
            }
            $liketype = 'unlike';
            
          }else
          {
           $showlikes = '('.formatWithSuffix($countsalllikes).') like this';
           $liketype = 'like';
         }
          ?>
        <p class="shoutout" style="border-bottom: solid 0.5px #fff;">
          <?php echo $msg; ?> 
          <!--» <span style="float: right; padding-right: 10px"><i>Anonymous <?php echo time_passed($rtime); ?></i>
          </span>-->
          <br><small> <a href="javascript:void();"><i>Anonymous <?php echo time_passed($rtime); ?></i></a> • <a href="shoutout-reply?sid=<?php echo $shout_id; ?>">(<?php echo formatWithSuffix($shoutoutreply); ?>) replying • <a href="?sid=<?php echo $shout_id; ?>&type=<?php echo $liketype; ?>"><?php echo ($showlikes); ?></a></small></p>
      <?php } ?>
      <span class="shoutout-reply"><a href="addshoutout.php">posts a new shoutout</a> </span>
        <!--<p style="color:red; font-family:cursive">Our KNU Income Project v1. is suspended for now, until futher notice. making sure to bring better service. Thank you</p></small>-->
</td>
      </tr>
    </tbody>
  </table>
  <?php
}

//load system header ads template
require ('ads.php');

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
