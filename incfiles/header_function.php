<style type="text/css">
#mobileads{display:none;}
#ipadads{display:none;}

/* Portrait */
@media only screen 
  and (min-device-width: 768px) 
  and (max-device-width: 1024px) 
  and (orientation: portrait) 
  and (-webkit-min-device-pixel-ratio: 1) {
 #mobileads{display:none;}
    #ipadads{display:block; width:auto;}
    #desktopads{display:none;}
}

/* Landscape */
@media only screen 
  and (min-device-width: 768px) 
  and (max-device-width: 1024px) 
  and (orientation: landscape) 
  and (-webkit-min-device-pixel-ratio: 1) {
 #mobileads{display:none;}
    #desktopads{display:inline-block;}
}


/* For 640 Resolution */  
@media only screen   
and (min-device-width : 320px)   
and (max-device-width : 640px)  
{ /* STYLES GO HERE */
    #ipadads{display:none;}
    #mobileads{display:block;}
    #desktopads{display:none;}


}
</style>
<?php
/*
*/
//echo $_COOKIE['username'];

function loggedUser($db)
{
    $redirect = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
if($_SESSION)  // if session is called
{

$user_id=$_SESSION['user_id']; //Storing user ID in SESSION variable.
$username=$_SESSION['username']; //Storing USERNAME in SESSION variabl
$email=$_SESSION['email']; //Storing EMAIL in SESSION variable.
//$avater=$_SESSION['avatar']; //Storing EMAIL in SESSION variable.
$queryUser=$db->query("SELECT * FROM users WHERE uid='$user_id' ");
$eval=$queryUser->num_rows; // check for existence
if($eval)
{
$data=$queryUser->fetch_assoc();
$gender=$data['gender'];
}

$QueryFT=$db->query("SELECT * FROM followed_topics WHERE  user_id_fk='$user_id' ");
$countFT=mysqli_num_rows($QueryFT);

$QueryBD=$db->query("SELECT * FROM followed_boards WHERE  user_id_fk='$user_id' ");
$countBD=mysqli_num_rows($QueryBD);

$queryads=$db->query("SELECT * FROM ads A, users U WHERE A.uid_fk='$user_id' GROUP BY adsId");
$countAds=mysqli_num_rows($queryads);
/*
*/
// switch gender
switch($gender)
{
	case '1':
	$gender='(m)';
	break;
	case '2':
	$gender='(f)';
	break;
	case '0':
	$gender='(n/a)';
	break;
}
echo '<p class="blog-nav">Welcome, <a href="'.URL.'/u/'.$username.'"><b> • '.$username.'</b></a> <span class="'.$gender.'">'.$gender.'</span>:
<a href="'.URL.'/editprofile">Edit Profile</a> /
<a href="'.URL.'/mysharedpost?user='.($username).'"><span title="Posts Shared With Me">Shared Post</span></a>/
<a href="'.URL.'/followed-topics">Followed Topics('.number_format($countFT).')</a> <br>
<a href="'.URL.'/followed-boards">Followed Boards('.number_format($countBD).')</a> /
<a href="'.URL.'/likes-share?user='.($username).'"><span title="My Likes & Shares">Likes &amp; Shares</span></a> /
<a href="'.URL.'//quote-mentions.php"><span title="mentions">Quotes Mentioned</span></a> /

<!--
<a href="'.URL.'/following"><span title="Following">FG</span></a> /
<a href="'.URL.'/followers"><span title="Followers">FS</span></a> 
<a href="'.URL.'/campaign">Ad Choices</a> /.:-->
<a href="'.URL.'/dashboard">Dashboard</a> /

<a href="'.URL.'/logout?redirect='.$redirect.'">Logout</a><br>';
// if it is admin show banned topic link
$checkAccesslevel=$db->query("SELECT * FROM users WHERE uid='$user_id' ");
$do_exist=$checkAccesslevel->num_rows;
if($do_exist) // if is admin
{
$data1=$checkAccesslevel->fetch_assoc();
$access=$data1['access']; // get access level
if($access==1) // get permission
{
echo '<p class="blog-nav" style="text-align:center; color:#fff; background-color:#097470;">
	<a href="'.URL.'/nl-admin" style="color:#fff;">Dashboard</a>
</p>
';
// create admin post url
}
elseif($access==2)
{
echo '<p class="blog-nav" style="text-align:center; color:#fff; background-color:#097470;">
	<a href="'.URL.'/list-my-board" style="color:#fff;">Moderator Board</a> .:
</p>
';
}
else
{}
}
}
/*
*/
}
/*
*/
function guestUser()
{
if(empty($_SESSION))
{
    $redirect = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
    
?>
<p class="blog-nav">
	Welcome, <b>Guest:
	<a href="<?php echo URL; ?>/confirm-email">Join <?php echo TRADEMARK; ?></a> •</b>
	<b><a href="<?php echo URL; ?>/login?redirect=<?php echo $redirect; ?>">Login!</a></b>
</p>

<?php
}
}
?>
