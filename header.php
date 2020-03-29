
<style type="text/css">
    .site-notice {
    display: none;
   // position: fixed;
    width: auto;
    //top: 0; #7ac9ed
    //height: 44px;
    background-color: #68a834;
    font-weight: 600;
    font-size: 12px;
    line-height: 1;
    z-index: 110;
    box-shadow: 0 2px 0 rgba(0,0,0,.05);
    color: #fff;
    padding: 4px;
    margin-bottom: 4px;
}

.site-notice .coupon {

    background-color: #ffcc00;
    display: inline-block;
    padding: 5px 10px 4px;
    color: #323232;
    font-size: 14px;
    border-radius: 3px;
    border: dashed 1px #549023;
}
.site-notice a {

    color: #ffcc00;
}
.fixed #masthead-title {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    opacity: .9;
    z-index: 3;
    padding: 10px;
}
#masthead-title {
    background: #7ac9ed;
    padding: 20px;
}
</style>
<style type="text/css">
/* Smartphones ----------- */
	@media only screen and (max-width: 760px) {
    /* For mobile phones: */
    #img-responsive{width: 330px;}
     #img-responsive1{width: 230px;}
}


/* ----------- Non-Retina Screens ----------- */
@media screen 
  and (min-device-width: 1200px) 
  and (max-device-width: 1600px) 
  and (-webkit-min-device-pixel-ratio: 1) { 
  #mobileads { display: none; }
  #desktopads { display: block; }
}

/* ----------- Retina Screens ----------- */
@media screen 
  and (min-device-width: 1200px) 
  and (max-device-width: 1600px) 
  and (-webkit-min-device-pixel-ratio: 2)
  and (min-resolution: 192dpi) { 
      #mobileads { display: none; }
  #desktopads { display: block; 
}
/* 
  ##Device = Most of the Smartphones Mobiles (Portrait)
  ##Screen = B/w 320px to 479px
*/

@media (max-width: 760px) {
    #mobileads { display: block; }
  #desktopads { display: none; 
  
}
</style
<?php
/* gets the data from a URL */
//echo get_data('http://labsolution.000webhostapp.com/upgrade.php?note');
?>
<a id="top" name="top"></a>
<a id="up" name="up"></a>

<table summary="" id="up"><tbody><tr><td class="grad">
<h1>
<?php
if (DISPLAY_STATUS=='logo')
{
echo '<a class="" href="'.WEBROOT.'" title="'.APPNAME.'">
    <div style="display:inline-block; "><img src="'.WEBROOT.'/images/logo.png" width="300px"> </div>
</a>';      # code...
}

if (DISPLAY_STATUS=='title')
{
echo '<a class="g" style="color: '.HEADER_COLOR.';" href="'.WEBROOT.'" title="'.APPNAME.'">'.APPNAME.' Forum</a>';        # code...
}

if (DISPLAY_STATUS=='both')
{
    echo '<a class="" href="'.WEBROOT.'" title="'.APPNAME.'">
    <div style="display:inline-block; "><img src="'.WEBROOT.'/images/logo.png" width="350px"> </div>
</a><br>';      # code...

echo '<a class="g" style="color: '.HEADER_COLOR.';" href="'.URL.'" title="'.APPNAME.'">'.APPNAME.' Forum</a>';        # code...
}

?>  

</h1>
        


  
<?php
// insert dump users
$user_dump = (rand(2, 2));
$seldump = $db->query("SELECT SUM(user_count) as dumptotal FROM dump_users ");
$datadump = mysqli_fetch_assoc($seldump);

$totaldump = $datadump['dumptotal'] + $user_dump;

//$insetdump = $db->query("UPDATE dump_users SET user_count='$totaldump' WHERE dump_id=1 ");



        $redirect = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
    /*
    Load user control navigation
    */
require_once ('incfiles/header_function.php');
// load control function from custom library
echo guestUser();
// Initialize guest control
echo loggedUser($db);
// Initialize logged in user control
$totalusers = users($db);//+$totaldump;
?>
<b>Stats: </b> <?php echo number_format($totalusers); ?> Members, <?php echo number_format(topics($db)); ?>
 topics and  <?php echo number_format(newsfeed($db)); ?> posts <b>Date:</b>&nbsp;<?php echo date('l d F Y'); ?> at <?php echo date("h:i A"); ?>

  <form action="<?php echo URL; ?>/search"> <input type="text" placeholder="Search articles, topics, users etc" name="q" size="32"> 
<input type="submit" name="search" value="Search"></form> </td></tr></tbody></table>

<table class="boards" style="font-size:10px !mportant;">
		<tbody>
			<tr>
				<td class="w">
					<b>
                	<a href="<?php echo URL; ?>/trending">Trending</a> •
                	<!--<a href="<?php echo URL; ?>/recent">Recent</a> •-->
                	<a href="<?php echo URL; ?>/newest">Newest</a> •
                	<a href="<?php echo URL; ?>/classified">Classified</a> •
                	<a href="<?php echo URL; ?>/directory">Directory</a> •
                	<a href="<?php echo URL; ?>/livescore">Livescores</a> •
                <!--	<a href="<?php echo URL; ?>/livestream/switch">Live Kenyan TV</a> •
                	<a href="<?php echo URL; ?>/radioplayer/homeboyz">Live Kenyan Radio</a>-->
				</a></b><br>
				<!--<small>We have launched KNU Income Project v1. Make money online in Kenya legitimately into your Kenya bank account with KNU Income</small></small>
				<p style="color:red; font-family:cursive">Our KNU Income Project v1. is suspended for now, until futher notice. making sure to bring better service. Thank you</p></small>-->
				</td>
			</tr>
		</tbody>
	</table>
  
	<style type="text/css">
	.overlay {
  position: fixed !important;
  top: 85%;
  left: 0;
 display:inline-block;
  transition: opacity 500ms;
  visibility: hidden;
  opacity: 0;
  z-index: 999;
}
.overlay:target {
  visibility: visible;
  opacity: 1;
}
.popup {
  padding:10px;
 // background: #25003e;
  border-radius: 5px;
  width: 95%;
  position: relative;
  transition: all 2s ease-in-out;
  text-align:center;
  display:inline-block;
}

.popup .close {
  position: absolute;
  transition: all 200ms;
  font-size: 30px;
  font-weight: bold;
  text-decoration: none;
}
.popup .content {
    border: 1px solid #EEE;
    background: #FFF;
    padding: 10px;
    box-shadow: 0px 0px 10px 0px #EEE;
    display:inline-block;
}
</style>


<!--<div id="guest" class="overlay"  align="center">
	<div class="popup">
		<a class="close" href="#">&times;</a>
		<div class="content">
		<p>You are browsing this site as a guest. It takes 2 minutes to <b><a href="<?php echo URL; ?>/confirm-email?k=kenyans247?redirect=$redirec">CREATE AN ACCOUNT </a></b> and less than 1 minute to <b><a href="<?php echo URL; ?>/login?redirect=$redirect">LOGIN</a>.</b> Thank you
		</p>
	</div>
	</div>
</div>-->
 <?php
 $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

 if(empty($_SESSION))
{
 // echo '<script type="text/javascript">window.location = "'.$actual_link.'#guest"; </script>'; 
}
$app = new appVerify(); echo $app->licenseKey($licenseurl);
?>
