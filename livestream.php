<?php
/*
Developer: Marshall Unduemi
Url: www.codexpresslabs.info
Contact: info@codexpresslabs.info

*/
//Enable Error Reporting

//error_reporting(0);
//remove the above comment to enable error reporting
//AED6F1
require_once ('config.php');
require_once ('functions.php');
//echo Checkuser();

require_once 'incfiles/theme/head_open.php';
############################### page title #######################
$tvname = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)); //Get last word from URL after a slash in PHP
//$lastWord = substr($url, strrpos($url, '/') + 1);

if ($tvname=='ebru')
{
 $page_title=$tvname .' TV LIVE';
 $site_dsc='YOU ARE ON EBRU TV LIVE © EBRU TV KENYA.';   
}
if ($tvname=='switch')
{
 $page_title=$tvname .' TV LIVE';
 $site_dsc='YOU ARE ON SWITCH TV LIVE © SWITCH MEDIA LTD.';   
}
if ($tvname=='kass')
{
 $page_title=$tvname .' TV LIVE';
 $site_dsc='YOU ARE ON KASS TV LIVE © KASS INTERNATIONAL LTD.';   
}
if ($tvname=='inooro')
{
 $page_title=$tvname .' TV LIVE';
 $site_dsc='YOU ARE ON INOORO TV LIVE © RMS LTD.';   
}
if ($tvname=='islamchannel-tv')
{
 $page_title=$tvname .' TV LIVE';
 $site_dsc='YOU ARE ON ISLAM CHANNEL TV LIVE ©.';   
}
if ($tvname=='citizen')
{
 $page_title=$tvname .' TV LIVE';
 $site_dsc='YOU ARE ON CITIZEN TV LIVE © RMS LTD.';   
}
if ($tvname=='k24')
{
 $page_title=$tvname .' TV LIVE';
 $site_dsc='YOU ARE ON K24 TV LIVE © MEDIAMAX LTD.';   
}
if ($tvname=='ntv')
{
 $page_title=$tvname .' TV LIVE';
 $site_dsc='YOU ARE ON NTV LIVE © NATION MEDIA GROUP.';   
}
if ($tvname=='kbc')
{
 $page_title=$tvname .' TV LIVE';
 $site_dsc='YOU ARE ON KBC TV LIVE © KENYA BREADCASTING COPRATION.';   
}
if ($tvname=='kameme')
{
 $page_title=$tvname .' TV LIVE';
 $site_dsc='YOU ARE ON KAMEME TV LIVE © MEDIAMAX LTD.';   
}
if ($tvname=='aljazeera')
{
 $page_title=$tvname .' TV LIVE';
 $site_dsc='YOU ARE ON AL JAZEERA TV LIVE © AL JAZEERA MEDIA NETWORK.';   
}
if ($tvname=='ktnnews')
{
 $page_title=$tvname .' TV LIVE';
 $site_dsc='YOU ARE ON KTN NEWS LIVE © STANDARD MEDIA LTD.';   
}
if ($tvname=='ktn')
{
 $page_title=$tvname .' TV LIVE';
 $site_dsc='YOU ARE ON KTN TV LIVE © STANDARD MEDIA LTD.';   
}
if ($tvname=='russia-today')
{
 $page_title=$tvname .' TV LIVE';
 $site_dsc='YOU ARE ON RUSSIA TODAY LIVE © RIA NOVOSTI NEWS AGENCY.';   
}
if ($tvname=='sky') {
 $page_title=$tvname .' TV LIVE';
 $site_dsc='SKY TV LIVE © SKY LIMITED.';   
}
if ($tvname=='CNBCAfrica')
{
 $page_title=$tvname .' TV LIVE';
 $site_dsc='YOU ARE ON CNBC TV LIVE © AFRICA BUSINESS NEWS PTY.';   
}
if ($tvname=='emmanuel')
{
 $page_title=$tvname .' TV LIVE';
 $site_dsc='Emmanuel TV © SCOAN MINISTRY.';   
}






	
	
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');

echo '<a id="top" name="top"></a>'; // anchor

?>
    <table>
      <tr>
        <th><h2><?php echo $site_dsc; ?></h2></th>
      </tr>
         <tr>
        <td class="w" style="text-align: left;">
          <style type="text/css">
.video-container {
position: relative;

padding-top: 3px; height: 450px; 
width: 100%;
}

.video-container iframe,
.video-container object,
.video-container embed {
position: absolute;
top: 0;
left: 0;
width: 100%;
height: 100%;
}
#front {
position: absolute;
  box-shadow:0 0 10% #666;
  z-index: 999;
  padding-top: 3%;

  border-radius: 600px;

  
}
#ulfooter {
      margin: 0 auto;
      list-style: none;
      overflow:hidden;
      padding:0;
      position: relative;
    }
    #ulfooter li {
 
      margin:0;
      padding:0;
      display:inline-block;
      height:42px;
    }
    #ulfooter li a {
      display:inline-block;
      height:26px;
      //background:#102c53;
      cursor:pointer;
      text-indent: -9999px
      color:red;
      padding: 5px
    }
</style>

<?php
if ($tvname=='ebru') {
?>
<div id="front" align="right" style="margin-left:60%; "><img src="https://i.imgur.com/SW1GWTc.png" width="70"> </div>
<iframe frameborder="0" class="video-container" 
src="https://www.dailymotion.com/embed/video/x67n3k1?autoplay=1"
allowfullscreen allow="autoplay"></iframe>


<?php } ?>


<?php
if ($tvname=='switch') {
?>
<iframe frameborder="0" class="video-container" 
src="https://livestream.com/accounts/27754751/events/8377002/player?enableInfoAndActivity=true&defaultDrawer=feed&autoPlay=true&mute=false"
allowfullscreen allow="autoplay"></iframe>

<?php } ?>

<?php
if ($tvname=='kass') {
?>
<script type="text/javascript" src="http://player.wowza.com/player/latest/wowzaplayer.min.js"></script>

	<script type="text/javascript">
WowzaPlayer.create('playerElement',
    {
    "license":"PLAY2-cD8n8-b6mkb-V44BF-aNEnw-kreYy",
    "title":"",
    "description":"",
    "sourceURL":"http%3A%2F%2F197.232.56.13%3A1935%2Flive%2F_definst_%2Fkasstv%2Fplaylist.m3u8",
    "autoPlay":true,
    "volume":"75",
    "mute":false,
    "loop":false,
    "audioOnly":false,
    "uiShowQuickRewind":false,
    "uiQuickRewindSeconds":"1"
    }
);
</script>

<div id="playerElement" style="width:100%; height:0; padding:0 0 56.25% 0" ></div>

<?php } ?>

<?php
if ($tvname=='inooro') {
?>

<video id="example-video" class="video-js vjs-default-skin video-container" controls autoplay controls poster="<?php echo URL; ?>/images/logo.png">
  <source
     src="https://vidcdn.vidgyor.com/inoorotv-origin/liveabr/inoorotv-origin/live1/chunks.m3u8"
     type="application/x-mpegURL">
     Sorry! Your browser isn't compatible with the Videos on our website!
</video>
 <link href="https://unpkg.com/video.js/dist/video-js.css" rel="stylesheet">
    <script src="https://unpkg.com/video.js/dist/video.js"></script>
    <script src="https://unpkg.com/videojs-flash/dist/videojs-flash.js"></script>
    <script src="https://unpkg.com/videojs-contrib-hls/dist/videojs-contrib-hls.js"></script>
<script>
var player = videojs('example-video');
player.play();

var myVideo = document.getElementById("example-video")
setInterval(function(){ myVideo.controls = !myVideo.controls; },500)
</script>

<?php } ?>

<?php
if ($tvname=='citizen') {
?>

<video id="example-video" class="video-js vjs-default-skin video-container" controls autoplay controls poster="<?php echo URL; ?>/images/logo.png">
  <source
     src="https://vidcdn.vidgyor.com/citizentv-origin/liveabr/citizentv-origin/live1/chunks.m3u8"
     type="application/x-mpegURL">
     Sorry! Your browser isn't compatible with the Videos on our website!
</video>
 <link href="https://unpkg.com/video.js/dist/video-js.css" rel="stylesheet">
    <script src="https://unpkg.com/video.js/dist/video.js"></script>
    <script src="https://unpkg.com/videojs-flash/dist/videojs-flash.js"></script>
    <script src="https://unpkg.com/videojs-contrib-hls/dist/videojs-contrib-hls.js"></script>
<script>
var player = videojs('example-video');
player.play();

var myVideo = document.getElementById("example-video")
setInterval(function(){ myVideo.controls = !myVideo.controls; },500)
</script>

<?php } ?>

<?php
if ($tvname=='k24') {
?>
<iframe frameborder="0" class="video-container" 
src="https://www.dailymotion.com/embed/video/x6lvncs?autoPlay=1"
allowfullscreen allow="autoplay"></iframe>
<?php } ?>

<?php
if ($tvname=='ntv') {
?>
<iframe frameborder="0" class="video-container" 
src="https://www.dailymotion.com/embed/video/x6shkab?autoPlay=1"
allowfullscreen allow="autoplay"></iframe>
<?php } ?>

<?php
if ($tvname=='kbc') {
?>
<iframe frameborder="0" class="video-container" 
src="https://www.dailymotion.com/embed/video/x74211t?autoPlay=1"
allowfullscreen allow="autoplay"></iframe>
<?php } ?>

<?php
if ($tvname=='kameme') {
?>
<!-- https://stream-05.ix7.dailymotion.com/sec(nitAgzxq_qCa0CId9XzFH5z-FDGTkKlnODXSEcTepM8)/dm/3/x6ol8sj/s/live-3.m3u8 -->
<iframe class="video-container" src="https://www.dailymotion.com/embed/video/x6ol8sj?autoPlay=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
<?php } ?>

<?php
if ($tvname=='aljazeera') {
?>
<video id="example-video" class="video-js vjs-default-skin video-container" controls autoplay controls poster="<?php echo URL; ?>/images/logo.png">
  <source
     src="https://english.streaming.aljazeera.net/aljazeera/english2/index255.m3u8"
     type="application/x-mpegURL">
     Sorry! Your browser isn't compatible with the Videos on our website!
</video>
 <link href="https://unpkg.com/video.js/dist/video-js.css" rel="stylesheet">
    <script src="https://unpkg.com/video.js/dist/video.js"></script>
    <script src="https://unpkg.com/videojs-flash/dist/videojs-flash.js"></script>
    <script src="https://unpkg.com/videojs-contrib-hls/dist/videojs-contrib-hls.js"></script>
<script>
var player = videojs('example-video');
player.play();

var myVideo = document.getElementById("example-video")
setInterval(function(){ myVideo.controls = !myVideo.controls; },500)
</script>
<?php } ?>

<?php
if ($tvname=='parliament-live') {
?>
<div id="front" align="right" style="margin-left:60%; "><img src="https://i.imgur.com/SW1GWTc.png" width="70"> </div>
<iframe frameborder="0" class="video-container" 
src="https://youtu.be/kpapj4N5S94"
allowfullscreen allow="autoplay"></iframe>
<?php } ?>

<?php
if ($tvname=='islamchannel-tv') {
?>

<div id="front" align="right" style="margin-left:60%; "><img src="https://www.islamchannel.tv/wp-content/uploads/2016/08/iclogo.png" width="70"> </div>
<iframe class="video-container" src="https://tech.zecast.com/islam" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
<?php } ?>

<?php
if ($tvname=='emmanuel') {
?>
<div id="front" align="right" style="margin-left:60%; "><img src="https://i.imgur.com/SW1GWTc.png" width="70"> </div>
<iframe frameborder="0" class="video-container" 
src="https://livestream.com/accounts/23202872/events/7200883/player?width=640&height=360&enableInfoAndActivity=true&defaultDrawer=&autoPlay=true&mute=false"
allowfullscreen allow="autoplay"></iframe>
<?php } ?>

<?php
if ($tvname=='bbc') {
?>
<video id="example-video" class="video-js vjs-default-skin video-container" controls autoplay controls poster="<?php echo URL; ?>/images/logo.png">
  <source
     src="https://edge-1180-ch-gv.filmon.com/live/1952.low.stream/playlist.m3u8?id=035bca1a71b11fce016d28acd3dbea51cbc96ddfe5b9ed3f8fe3286df6a738d303a910145b3ceaea48990cbd2efbd1f7dc0d7b89fb7fe486e427fa1c2cda13dbd38fffc1085abff33ac423352fc75b2adaa4f98ce7409d3da7902bdae27953841a980c910920dbf2c9d115ea1dd0310dff3402cb98770e6ac44e30bcb18e2fa3cd695c28fed92bcfa3c43df4206af8d5fe15e411c6f1bd01"
     type="application/x-mpegURL">
     Sorry! Your browser isn't compatible with the Videos on our website!
</video>
 <link href="https://unpkg.com/video.js/dist/video-js.css" rel="stylesheet">
    <script src="https://unpkg.com/video.js/dist/video.js"></script>
    <script src="https://unpkg.com/videojs-flash/dist/videojs-flash.js"></script>
    <script src="https://unpkg.com/videojs-contrib-hls/dist/videojs-contrib-hls.js"></script>
<script>
var player = videojs('example-video');
player.play();

var myVideo = document.getElementById("example-video")
setInterval(function(){ myVideo.controls = !myVideo.controls; },500)
</script>
<?php } ?>

<?php
if ($tvname=='russia-today') {
?>
<video id="example-video" class="video-js vjs-default-skin video-container" controls autoplay controls poster="<?php echo URL; ?>/images/logo.png">
  <source
     src="https://rt-usa.secure.footprint.net/1105_2500Kb.m3u8"
     type="application/x-mpegURL">
     Sorry! Your browser isn't compatible with the Videos on our website!
</video>
 <link href="https://unpkg.com/video.js/dist/video-js.css" rel="stylesheet">
    <script src="https://unpkg.com/video.js/dist/video.js"></script>
    <script src="https://unpkg.com/videojs-flash/dist/videojs-flash.js"></script>
    <script src="https://unpkg.com/videojs-contrib-hls/dist/videojs-contrib-hls.js"></script>
<script>
var player = videojs('example-video');
player.play();

var myVideo = document.getElementById("example-video")
setInterval(function(){ myVideo.controls = !myVideo.controls; },500)
</script>
<?php } ?>

<?php
if ($tvname=='tv47') {
?>
<div id="front" align="right" style="margin-left:60%; "><img src="https://i.imgur.com/XrvUxTG.jpg" width="70"> </div>
<iframe class="video-container" src="https://www.dailymotion.com/embed/video/x70vhnr?autoplay=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
<?php } ?>

<?php
if ($tvname=='rt-en') {
?>
<div id="front" align="right" style="margin-left:60%; "><img src="https://i.imgur.com/SW1GWTc.png" width="70"> </div>
<iframe class="video-container" src="https://www.youtube.com/embed/JqY92qg_yPs" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
<?php } ?>

<?php
if ($tvname=='family-tv') {
?>
<div id="front" align="right" style="margin-left:60%; "><img src="https://i.imgur.com/LnMpolx.png" width="70"> </div>
<iframe class="video-container" src="https://ustream.tv/embed/23367184" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
<?php } ?>

<?php
if ($tvname=='cnn') {
?>
<div id="front" align="right" style="margin-left:60%; "><img src="https://i.imgur.com/SW1GWTc.png" width="70"> </div>
<iframe class="video-container" src="https://www.youtube.com/embed/XnjNKk534pY" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
<?php } ?>

<?php
if ($tvname=='ChannelsTV') {
?>
<div id="front" align="right" style="margin-left:60%; "><img src="https://i.imgur.com/SW1GWTc.png" width="70"> </div>
<iframe class="video-container" src="https://www.youtube.com/embed/20NqRnLWLEo" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
<?php } ?>
      </tr>
    </table>

<table class="boards">
    <tbody>
        <tr>
        <td><b>WATCH KENYAN TV STATIONS FREE</b></td>
      </tr>
               <tr>
        <td class="w" style="text-align: center;">
          <div id="radiofooter">
<ul id="ulfooter">
<li><a href="<?php echo URL; ?>/livestream/switch" onclick="return livestream('livestream/switch')" target="_self"><img src="https://i.imgur.com/cKeIDRT.png" width="50"></a></li>
<li><a href="<?php echo URL; ?>/livestream/ebru" onclick="return livestream('livestream/ebru')" target="_self"><img src="https://i.imgur.com/04X1yv5.png" width="50"></a></li>
<li><a href="<?php echo URL; ?>/livestream/kass" onclick="return livestream('livestream/kass')" target="_self"><img src="https://i.imgur.com/AAdWbeP.png" width="50"></a></li>
<li><a href="<?php echo URL; ?>/livestream/inooro" onclick="return livestream('livestream/inooro')" target="_self"><img src="https://i.imgur.com/uFT1XhP.png" width="50"></a></li>
<li><a href="<?php echo URL; ?>/livestream/citizen" onclick="return livestream('livestream/citizen')" target="_self"><img src="https://i.imgur.com/c4m1Ook.png" width="50"></a></li>

<li><a href="<?php echo URL; ?>/livestream/k24" onclick="return livestream('livestream/k24')" target="_self"><img src="https://i.imgur.com/5dzB2Nf.png" width="50"></a></li>
<li><a href="<?php echo URL; ?>/livestream/ntvntv" onclick="return livestream('livestream/ntv')" target="_self"><img src="https://i.imgur.com/O5XfL5L.png" width="50"></a></li>
<li><a href="<?php echo URL; ?>/livestream/kameme" onclick="return livestream('livestream/kameme')" target="_self"><img src="https://i.imgur.com/YBFqXLO.png" width="50"></a></li>

<li><a href="<?php echo URL; ?>/livestream/aljazeera" onclick="return livestream('livestream/aljazeera')" target="_self"><img src="https://www.aljazeera.com/assets/images/aj-logo-lg-124.png" width="50"></a></li>
<li><a href="<?php echo URL; ?>/livestream/parliament-live" onclick="return livestream('livestream/parliament-live')" target="_self"><img src="https://i.imgur.com/0CD1nX9.png" width="50"></a></li>
<li><a href="<?php echo URL; ?>/livestream/russia-today" onclick="return livestream('livestream/russia-today')" target="_self"><img src="https://i.imgur.com/ErFrKIS.png" width="50"></a></li>
<li><a href="<?php echo URL; ?>/livestream/tv47" onclick="return livestream('livestream/tv47')" target="_self"><img src="https://i.imgur.com/XrvUxTG.jpg" width="50"></a></li>
<li><a href="<?php echo URL; ?>/livestream/family-tv" onclick="return livestream('livestream/family-tv')" target="_self"><img src="https://i.imgur.com/LnMpolx.png" width="50"></a></li>
<li><a href="<?php echo URL; ?>/livestream/kbc" onclick="return livestream('livestream/kbc')" target="_self"><img src="https://i.imgur.com/M4ok6ZX.png" width="50"></a></li>

<li><a href="<?php echo URL; ?>/livestream/metropol-tv" onclick="return livestream('livestream/metropol-tv')" target="_self"><img src="https://i.imgur.com/05BSpnV.jpg" width="50"></a></li>
<li><a href="<?php echo URL; ?>/livestream/emmanuel" onclick="return livestream('livestream/emmanuel')" target="_self"><img src="https://i.imgur.com/FUiRwTZ.jpg" width="50"></a></li>
</ul>
</div>
<div class="moreStations" style="cursor: pointer; padding:10px; background-color: #CB2027; color:#fff;" onclick="window.location='<?php echo URL; ?>/radioplayer/homeboyz'" target="_self">
<b>Click this button to Listen to Kenyan Live Radio Stations</b>
</div>
        </td>
      </tr>
    </table>
    <table class="boards">
		<tbody>
			<tr>
				<td><b>QUICK LINKS</b>
				</td>
			</tr>
			<tr>
				<td class="featured w"><b><a href="/links/0">Featured Links</a></b> / 
        <b><a href="http://twitter.com/<?php echo TW; ?>">Twitter</a></b>  / <b><a href="http://facebook.com/<?php echo FB; ?>">Facebook</a></b>  
        / <b><a href="<?php echo URL; ?>/campaign">Campaign</a></b>
        </td>
        </tr>
            <tr>
                <td class="">
        <p>
           <?php
           
           $selsite = $db->query("SELECT * FROM site_pages");
while($data=mysqli_fetch_assoc($selsite))
{
$page_title = $data['page_title'];
$page_type = $data['page_type'];
$page_date = $data['page_date'];

echo "<a href='".URL."/help/$page_type'>$page_title</a> | ";
}

?>
        </p>
        </td>
			</tr>
			
			
		</tbody>
	</table>
<?php
//echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';

//load footer from footer.php
//require_once ('footer.php');

?>

</body>
</html>
