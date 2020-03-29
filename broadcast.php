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
//echo Checkuser();

require_once 'incfiles/theme/head_open.php';
############################### page title #######################
$name=$_GET['url'];
  $page_title='Broadcasting - '.ucfirst($name) .'Radio';
  $site_dsc=APPNAME.'Broadcasting - '.ucfirst($name);
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');

echo '<a id="top" name="top"></a>'; // anchor

##################### login form ########################
function radioLive($user_ip,$db)
{
 $current_time=time(); // get current timestamp
 $timeout = $current_time - (60*5); // sec 60 by 5 is 5min- 60 secs to 5

 $guest_live = $db->query("SELECT * FROM radiolive WHERE ip='$user_ip' ");
 $live_check = mysqli_num_rows($guest_live);
 // check for user existence on database
 if($live_check)
 {
$sql = $db->query("UPDATE radiolive SET timed='$current_time' WHERE ip='$user_ip' ");
// update guest user if with visited with thesame machine
 }
 else{
  $db->query("INSERT INTO radiolive (ip, timed) VALUES ('$user_ip', '$current_time')");
  // if visited with new machine, get the machine address and create new recoard

 }

// select all guest users within the time frame
 $liveStream = $db->query("SELECT * FROM radiolive WHERE  timed>= '$timeout' ");
 $liveStream_count = mysqli_num_rows($liveStream);
 // count all guest

 return $liveStream_count." User(s) Playing ";
 // return them all

}

?>
<style type="text/css">
.main{
   position: absolute;
  top:50%;
  left:50%;
  transform: translate(-50%, -50%);
}
/*the first button*/
.a1{
    position: relative;
    background: linear-gradient(to right, #03a9f4,#f441a5,#ffeb3b,#03a9f4);
    background-size:400%;
    border-radius:30px;
    
    width: 70px;
    height: 30px;
    line-height:30px;
    text-align:center;
    box-sizing: border-box;
    text-transform: uppercase;
    color:#fff;
    font-size:15px;
    display: inline-block;
}
.a1:hover{
    animation:  a  8s linear Infinite;
}
.a1:before{
   content:"";
   background: linear-gradient(to   right,#03a9f4,#f441a5,#ffeb3b,#03a9f4);
  background-size:400%;
  position: absolute;
  top:-5px;
  right: -5px;
  left: -5px;
  bottom:-5px;
  z-index: -1;
  border-radius:40px;
  filter: blur(20px);
  opacity: 0;
  transition:0.5s;
}
.a1:hover:before{
  opacity: 1;
  filter: blur(20px);
  animation:  a  8s linear Infinite;
}
@keyframes a {
  0%{
    background-position: 0%;
  }
  100%{
    background-position: 400%;
  }
}


/* -------------- radio ------- */

    #radiofooter { 
    font-size: 12px; 
    font-family:Arial, Helvetica, sans-serif;
    valign: top;
    margin:0px;
    float:center;
    padding:5px;
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
      display:block;
      height:26px;
      //background:#102c53;
      cursor:pointer;
      text-indent: -9999px
      color:red;
      padding: 5px
    }
    
   
    #ulfooter li ul {padding:0;margin:0;position: absolute;z-index: 200;}
    #ulfooter li li {display:none;padding:0;margin:0;float:none; background-color: red}
    #ulfooter li:hover li {display:block;color:#FFFFFF;background:#FF0000;padding:1px 4px;float:none;font-weight:bold;margin-left:0;}
    #ulfooter li:first-child:hover li, #ulfooter li:hover a#xfm li {margin-left: 0;}
    #ulfooter li:last-child:hover li {margin-left: -18px;}
  div.moreStations {
    font-size: 13px;
    width: 170px;
    background: #102C53;
    border: solid 1px black;
    margin:10px 1px 1px 1px;
    height:10%;
    position:relative;
    z-index: 100;
    float: right;
    color: #FFFFFF;
    font-weight: bold;
    line-height: 18px;
    text-align: center;
    font-family: arial, serif;
}
  div.moreStations * {
    display:block;
    padding:0; margin:0;
    z-index: 999;
}
  div.moreStations em {
    padding:2px 2px 2px 4px;
    z-index: 999;
}
  div.moreStations a em {
  color: #FFFFFF;
  background: #FF0000;
  text-transform: uppercase;
  z-index: 999;
  }
  div.moreStations a {
  color: #FFFFFF;
  text-decoration: none;
  display: block;
  padding: 0;
  z-index: 999;
  }
  div.moreStations ul {
    display:none;
    z-index: 999;
    overflow-x: hidden;
    overflow-y: scroll;
    height: 300px;
    white-space:nowrap
}
  .radioimage {
    display: block;
  }
  div.moreStations:hover ul {
    display:block;
    position:absolute;
    width:100%;
    bottom:100%; /* change to TOP and it will drop down */
    left: -1px;
    border:solid 1px black;
    background: #FF0000;
    z-index: 999;
    box-shadow: -3px -3px 0px #FFFFFF;
}
  div.moreStations li {
    padding:0;
    border-bottom: 1px solid #000000;
    height: 18px;
}
  div.moreStations li a {
  color: #FFFFFF;
  text-decoration: none;
  display: block;
  padding: 0;
  height: 20px;
  line-height: 20px;
  }
  div.moreStations li a:hover {
  background: #000000;
  }
  .player-wrapper {
    background: url(play-pause2.png) repeat-x 0 0 #000000;
  }
  .player-status {
    background: url(play-pause2.png) no-repeat 10px -34px transparent;
    color: #E5E5E5;
    padding: 6px;
    font-size: 14px;
    font-weight: bold;
    text-align: center;
    font-family: Arial, Helvetica, sans-serif;
    border-right: 2px solid #000;
    border-left: 2px solid #000;
  }
  .player-status .offline {
    color: #FF0000;
  }
  .player-status .online {
    color: #33CC00;
  }
  .ad-300 {
    width: 400px;
  }
  .ad-728 {
    border:1px solid #000;
    width:728px;
    margin:0 auto;
    height: 90px;
  }
  .top-left {
    width: 270px;
  }
  .top-left a {
    display: block;
  }
  .top-right {
    width: 468px;
    text-align: right;
  }
  
@media all and (min-width: 600px) and (max-width: 660px) {
  body {
    width: 640px;
  }
  .ad-300 {
    width: 300px;
  }
  #ulfooter li a#milele,
  #ulfooter li a#citizen {
    display: none;
  }
  .top-left {
    width: 200px;
  }
  .top-right {
    width: 468px;
    text-align: left;
  }
  div.moreStations {
    float: left;
  }
} 
@media only screen and (max-width: 768px) {
    /* For mobile phones: */

    #img-responsive{width: 360px;}
     #img-responsive1{width: 230px;}
}
</style>

<div id="img-responsive">

</div>

    <table>
      <tr>
        <th>
<?php
if ($name=='homeboyz') {
?>
<div class="box-header with-border" style=" padding: 10px;">
  <div class="user-block">
    <img src="https://i.imgur.com/7jiUMUL.jpg" width="70" alt="Kameme FM">
    <br><span class="username" style="font-size: 25px;font-weight: bolder">HBR 103.5 FM</span>
    <div class="audioplayer">
    <audio id="player" src="http://shoutcast.citrus3.com:8116/;stream.mp3"></audio>
    <div>
      <a href="javascript:void();" class="a1" onclick="document.getElementById('player').play()">Play</a>
      <a href="javascript:void();" class="a1" onclick="document.getElementById('player').pause()">Paused</a>
      <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume += 0.1">Vol+</a>
      <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume -= 0.1">Vol-</a>
    </div>
    
  </div>
</div>
</div>

<?php
}

  if ($name=='kamemefm') {
?>
<div class="box-header with-border" style=" padding: 10px;">
  <div class="user-block">
<img src="https://i.imgur.com/x59bZ52.jpg" width="70" alt="Kameme FM">
<br><span class="username" style="font-size: 25px;font-weight: bolder"> KAMEME FM</span>
<div class="audioplayer">
<audio id="player" src="http://stream.zenolive.com/wxn43ghqtceuv?1561714581"></audio>
<div>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').play()">Play</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').pause()">Paused</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume += 0.1">Vol+</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume -= 0.1">Vol-</a>
</div>

</div>
</div>
</div>

<?php
}
if ($name=='kiss100') {
?>
<div class="box-header with-border" style=" padding: 10px;">
  <div class="user-block">
    <img src="https://i.imgur.com/TNObnRZ.png" alt="Kiss100">
    <br><span class="username" style="font-size: 25px;font-weight: bolder">Kiss100</span>    
    <div class="audioplayer">
    <audio id="player" src="http://streams.radioafricagroup.co.ke:88/broadwave.mp3?src=4&rate=1"></audio>
    <div>
      <a href="javascript:void();" class="a1" onclick="document.getElementById('player').play()">Play</a>
      <a href="javascript:void();" class="a1" onclick="document.getElementById('player').pause()">Paused</a>
      <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume += 0.1">Vol+</a>
      <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume -= 0.1">Vol-</a>
    </div>
    
  </div>
</div>
</div>
<?php
  }

  if ($name=='hopefm') {
?>
<div class="box-header with-border" style=" padding: 10px;">
  <div class="user-block">
<img src="https://cdn-radiotime-logos.tunein.com/s97175q.png" alt="hope fm">
<br><span class="username" style="font-size: 25px;font-weight: bolder">Hope FM 93.3</span>
<div class="audioplayer">
<audio id="player" src="http://50.7.99.155:12087/stream.mp3"></audio>
<div>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').play()">Play</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').pause()">Paused</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume += 0.1">Vol+</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume -= 0.1">Vol-</a>
</div>

</div>
</div>
</div>

<?php
}
  if ($name=='njatafm') {
?>
<div class="box-header with-border" style=" padding: 10px;">
  <div class="user-block">
<img src="http://njatatv.co.ke/wp-content/uploads/2016/08/fm.jpg" alt="njatafm FM" width="50">
<br><span class="username" style="font-size: 25px;font-weight: bolder">Njata Fm LiveStream</span>
<div class="audioplayer">
<audio id="player" src="http://njatatv.ddns.net:8000/njatafm"></audio>
<div>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').play()">Play</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').pause()">Paused</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume += 0.1">Vol+</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume -= 0.1">Vol-</a>
</div>

</div>
</div>
</div>

<?php
}
if ($name=='classic105') {
?>
<div class="box-header with-border" style=" padding: 10px;">
  <div class="user-block">
     <img src="https://i.imgur.com/MSo47tZ.png" width="70" alt="Classic FM"> 
      <br><span class="username" style="font-size: 25px;font-weight: bolder">Classic 105</span>
        <div class="audioplayer">
         <audio id="player" src="http://streams.radioafricagroup.co.ke:88/broadwave.mp3?src=5&rate=1&kbps=128"></audio>
<div>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').play()">Play</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').pause()">Paused</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume += 0.1">Vol+</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume -= 0.1">Vol-</a>
</div>

</div>
</div>
</div>

<?php
}
if ($name=='radiojambo') {
?>
<div class="box-header with-border" style=" padding: 10px;">
  <div class="user-block">
     <img src="https://i.imgur.com/oOkx5mQ.jpg" alt="radiojambo" width="70"> 
      <br><span class="username" style="font-size: 25px;font-weight: bolder">Radio Jambo </span>
        <div class="audioplayer">
         <audio id="player" src="http://streams.radioafricagroup.co.ke:88/broadwave.mp3?src=1&rate=1&kbps=128"></audio>
<div>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').play()">Play</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').pause()">Paused</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume += 0.1">Vol+</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume -= 0.1">Vol-</a>
</div>

</div>
</div>
</div>

<?php
}
if ($name=='kassfm') {
?>
<div class="box-header with-border" style=" padding: 10px;">
  <div class="user-block">
     <img src="https://cdn.webrad.io/images/logos/radio-or-ke/kass.png" alt="Kass 100 FM"> 
      <br><span class="username" style="font-size: 25px;font-weight: bolder">Kass FM 91.0</span>
        <div class="audioplayer">
         <audio id="player" src="http://media.kassfm.co.ke:8006/live"></audio>
<div>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').play()">Play</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').pause()">Paused</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume += 0.1">Vol+</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume -= 0.1">Vol-</a>
</div>

</div>
</div>
</div>

<?php
}
if ($name=='familyradio316') {
?>
<div class="box-header with-border" style=" padding: 10px;">
  <div class="user-block">
     <img src="https://i.imgur.com/edBofXd.png" width="70" alt="familyradio316"> 
      <br><span class="username" style="font-size: 25px;font-weight: bolder">Radio 316 103.9 FM</span>
      <div class="audioplayer">
         <audio id="player" src="http://tx.sharp-stream.com/http_live.php?i=familymedia.mp3&device=website"></audio>
<div>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').play()">Play</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').pause()">Paused</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume += 0.1">Vol+</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume -= 0.1">Vol-</a>
</div>

</div>
</div>
</div>

<?php
}
if ($name=='xfm') {
?>
<div class="box-header with-border" style=" padding: 10px;">
  <div class="user-block">
<img src="https://i.imgur.com/VNAy0Oy.jpg" width="70" alt="xfm FM">
<br><span class="username" style="font-size: 25px;font-weight: bolder">XFM FM 105.5</span>
<div class="audioplayer">
<audio id="player" src="http://streams.radioafricagroup.co.ke:88/broadwave.mp3?src=2"></audio>
<div>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').play()">Play</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').pause()">Paused</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume += 0.1">Vol+</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume -= 0.1">Vol-</a>
</div>

</div>
</div>
</div>

<?php
}
if ($name=='eastfm') {
?>
<div class="box-header with-border" style=" padding: 10px;">
  <div class="user-block">
<img src="https://i.imgur.com/jeifEwz.png" width="70" alt="east FM">
<br><span class="username" style="font-size: 25px;font-weight: bolder">East FM</span>
<div class="audioplayer">
<audio id="player" src="http://streams.radioafricagroup.co.ke:88/broadwave.mp3?src=3"></audio>
<div>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').play()">Play</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').pause()">Paused</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume += 0.1">Vol+</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume -= 0.1">Vol-</a>
</div>

</div>
</div>
</div>

<?php
}
if ($name=='ghettoradio') {
?>
<div class="box-header with-border" style=" padding: 10px;">
  <div class="user-block">
<img src="https://i.imgur.com/svGcn4E.jpg" width="70" alt="ghetto radio">
<br><span class="username" style="font-size: 25px;font-weight: bolder">Ghetto Radio 89.5 FM</span>
<div class="audioplayer">
<audio id="player" src="http://45.79.138.31:8090/stream/1/"></audio>
<div>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').play()">Play</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').pause()">Paused</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume += 0.1">Vol+</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume -= 0.1">Vol-</a>
</div>

</div>
</div>
</div>

<?php
}
if ($name=='capitalfm') {
?>
<div class="box-header with-border" style=" padding: 10px;">
  <div class="user-block">
<img src="https://i.imgur.com/57a7jus.jpg" alt="capital fm">
<br><span class="username" style="font-size: 25px;font-weight: bolder">Capital FM 98.4</span>
<div class="audioplayer">
   <audio id="player" autoplay="true" preload="auto" src="https://icecast2.getstreamhosting.com:8050/stream.mp3"></audio>

<div>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').play()">Play</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').pause()">Paused</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume += 0.1">Vol+</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume -= 0.1">Vol-</a>
</div>

</div>
</div>
</div>

<?php
}
if ($name=='waumini') {
?>
<div class="box-header with-border" style=" padding: 10px;">
  <div class="user-block">
<img src="https://cdn.webrad.io/images/logos/radio-or-ke/waumini.png" alt="waumini radio">
<br><span class="username" style="font-size: 25px;font-weight: bolder">Radio Waumini 88.3 FM</span>
<div class="audioplayer">
   <audio id="player" autoplay="true" preload="auto" src="http://node-27.zeno.fm/gvk894g072quv?rj-ttl=5&rj-token=AAABbC0-Xp7TlaOmUGaPopKXCuQtWSM8A05o1NDvlHMMGgy8W1Cp4A"></audio>

<div>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').play()">Play</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').pause()">Paused</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume += 0.1">Vol+</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume -= 0.1">Vol-</a>
</div>

</div>
</div>
</div>

<?php
}
if ($name=='milelefm') {
?>
<div class="box-header with-border" style=" padding: 10px;">
  <div class="user-block">
<img src="https://cdn.webrad.io/images/logos/radio-or-ke/milele.png" alt="milele radio">
<br><span class="username" style="font-size: 25px;font-weight: bolder">Milele 93.6 FM</span>
<div class="audioplayer">
   <audio id="player" autoplay="true" preload="auto" src="http://node-20.zeno.fm/dex4fk5ykxquv?rj-ttl=5&rj-token=AAABbC1BQw4xp_cQ8q0r6pjag3tNUoYh71lKrq0SIdGpqyJZkn5Ffg"></audio>
<div>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').play()">Play</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').pause()">Paused</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume += 0.1">Vol+</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume -= 0.1">Vol-</a>
</div>
</div>
</div>
</div>

<?php
}
if ($name=='nationfm') {
?>
<div class="box-header with-border" style=" padding: 10px;">
  <div class="user-block">
<img src="https://i.imgur.com/2eaRJCL.png" width="70" alt="nation radio">
<br><span class="username" style="font-size: 25px;font-weight: bolder">Nation FM</span>
<div class="audioplayer">
   <audio id="player" autoplay="true" preload="auto" src="http://ample-11.radiojar.com/3by7s8eg65quv?rj-ttl=5&rj-token=AAABbFO14YbmD2HfLk8puoHOZ3RxTP22sz3zw6TPVwFMTnvqlx2jaQ"></audio>

<div>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').play()">Play</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').pause()">Paused</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume += 0.1">Vol+</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume -= 0.1">Vol-</a>
</div>

</div>
</div>
</div>

<?php
}
if ($name=='unverifiedradio') {
?>
<div class="box-header with-border" style=" padding: 10px;">
  <div class="user-block">
<img src="https://i.imgur.com/ETeQnwl.png" width="70" alt="unverified radio">
<br><span class="username" style="font-size: 25px;font-weight: bolder">Unverified Radio</span>
<div class="audioplayer">
   <audio id="player" autoplay="true" preload="auto" src="https://audiocdn12.mixcloud.com/previews/a/4/0/9/4b13-d6fc-4744-91ea-e39c070f906f.mp3"></audio>

<div>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').play()">Play</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').pause()">Paused</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume += 0.1">Vol+</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume -= 0.1">Vol-</a>
</div>

</div>
</div>
</div>

<?php
}
if ($name=='radiomaisha') {
?>
<div class="box-header with-border" style=" padding: 10px;">
  <div class="user-block">
<img src="https://i.imgur.com/slnvTWf.png" width="70" alt="Maisha radio">
<br><span class="username" style="font-size: 25px;font-weight: bolder">Radio Maisha 102.7</span>
<div class="audioplayer">
   <audio id="player" autoplay="true" preload="auto" src="http://node-03.zeno.fm/30bs07z8m0quv?rj-ttl=5&rj-token=AAABbC1C6wEfot4Qqe6rl5TuZv9BJItz2ER3sCKQKgNgYxt4eL0WIA"></audio>

<div>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').play()">Play</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').pause()">Paused</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume += 0.1">Vol+</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume -= 0.1">Vol-</a>
</div>

</div>
</div>
</div>

<?php
}
if ($name=='bhb') {
?>
<div class="box-header with-border" style=" padding: 10px;">
  <div class="user-block">
<img src="https://cdn.webrad.io/images/logos/radio-or-ke/bhb.png" alt="bhb radio">
<br><span class="username" style="font-size: 25px;font-weight: bolder">BHB FM 102.5</span>
<div class="audioplayer">
   <audio id="player" preload="auto" src="http://uk1-vn.mixstream.net:10108/stream/1/"></audio>

<div>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').play()">Play</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').pause()">Paused</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume += 0.1">Vol+</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume -= 0.1">Vol-</a>
</div>

</div>
</div>
</div>

<?php
}
if ($name=='soundasiafm') {
?>
<div class="box-header with-border" style=" padding: 10px;">
  <div class="user-block">
<img src="https://cdn.webrad.io/images/logos/radio-or-ke/sound-asia.png" alt="sound-asia radio">
<br><span class="username" style="font-size: 25px;font-weight: bolder">Sound Asia Fm 88.0</span>
<div class="audioplayer">
   <audio id="player" preload="auto" src="http://41.72.210.222:88/stream"></audio>
<div>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').play()">Play</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').pause()">Paused</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume += 0.1">Vol+</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume -= 0.1">Vol-</a>
</div>

</div>
</div>
</div>
<?php
}
if ($name=='pili-pili-99-5-fm') {
?>
<div class="box-header with-border" style=" padding: 10px;">
  <div class="user-block">
<img src="https://i.imgur.com/H41KY0T.jpg" width="70">
<br><span class="username" style="font-size: 25px;font-weight: bolder">Pili Pili 99.5 FM</span>
<div class="audioplayer">
   <audio id="player" preload="auto" src="http://node-03.zeno.fm/w5gg57a5v2quv?rj-ttl=5&rj-token=AAABbC1IP041_-rFJghoMzo1pNCVuqid1h_wIjGD1Lvu2ml7wwOv1A"></audio>
<div>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').play()">Play</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').pause()">Paused</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume += 0.1">Vol+</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume -= 0.1">Vol-</a>
</div>

</div>
</div>
</div>
<?php
}
if ($name=='maria') {
?>
<div class="box-header with-border" style=" padding: 10px;">
  <div class="user-block">
<img src="https://cdn.webrad.io/images/logos/radio-or-ke/maria.png" alt="maria radio">
<br><span class="username" style="font-size: 25px;font-weight: bolder">Radio Maria 88.1 FM</span>
<div class="audioplayer">
   <audio id="player" autoplay="yes" preload="auto" src="http://dreamsiteradiocp.com:8108/stream/1/"></audio>
<div>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').play()">Play</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').pause()">Paused</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume += 0.1">Vol+</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume -= 0.1">Vol-</a>
</div>
</div>
</div>
</div>
<?php
}
if ($name=='e-93') {
?>
<div class="box-header with-border" style=" padding: 10px;">
  <div class="user-block">
<img src="https://i.imgur.com/an3kgSd.png" alt="e93">
<br><span class="username" style="font-size: 25px;font-weight: bolder">E 93 FM</span>
<div class="audioplayer">
   <audio id="player" autoplay="yes" preload="auto" src="https://17013.live.streamtheworld.com/WEASFM_SC"></audio>
<div>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').play()">Play</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').pause()">Paused</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume += 0.1">Vol+</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume -= 0.1">Vol-</a>
</div>
</div>
</div>
</div>
<?php
}
if ($name=='atg') {
?>
<div class="box-header with-border" style=" padding: 10px;">
  <div class="user-block">
<img src="https://cdn.webrad.io/images/logos/radio-or-ke/atg.png" alt="atg radio">
<br><span class="username" style="font-size: 25px;font-weight: bolder">ATG Radio Kenya 91.1 FM</span>
<div class="audioplayer">
   <audio id="player" autoplay="yes" preload="auto" src="http://uk4-vn.mixstream.net:8114/stream/1/"></audio>
<div>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').play()">Play</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').pause()">Paused</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume += 0.1">Vol+</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume -= 0.1">Vol-</a>
</div>
</div>
</div>
</div>
<?php
}
if ($name=='radio-africa-online') {
?>
<div class="box-header with-border" style=" padding: 10px;">
  <div class="user-block">
<img src="https://cdn.webrad.io/images/logos/radio-or-ke/radio-africa-online.png" alt="radio-africa-online radio">
<br><span class="username" style="font-size: 25px;font-weight: bolder">Radio Africa Online</span>
<div class="audioplayer">
   <audio id="player" autoplay="yes" preload="auto" src="http://136.0.17.26:8000/stream/1/"></audio>
<div>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').play()">Play</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').pause()">Paused</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume += 0.1">Vol+</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume -= 0.1">Vol-</a>
</div>
</div>
</div>
</div>
<?php
}
if ($name=='meru-fm') {
?>
<div class="box-header with-border" style=" padding: 10px;">
  <div class="user-block">
<img src="https://cdn.webrad.io/images/logos/radio-or-ke/meru-fm.png" alt="meru-fm radio">
<br><span class="username" style="font-size: 25px;font-weight: bolder">Meru FM 88.3</span>
<div class="audioplayer">
   <audio id="player" autoplay="yes" preload="auto" src="http://node-01.zeno.fm/femq5wg5v2quv?rj-ttl=5&rj-token=AAABbC1Q8tY9vp8O00LCTMJkapcTQTOvp_uLK2U2eS-JjzrGSa177g"></audio>
<div>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').play()">Play</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').pause()">Paused</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume += 0.1">Vol+</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume -= 0.1">Vol-</a>
</div>
</div>
</div>
</div>
<?php
}
if ($name=='bongo') {
?>
<div class="box-header with-border" style=" padding: 10px;">
  <div class="user-block">
<img src="https://cdn.webrad.io/images/logos/radio-or-ke/bongo.png" alt="bongo radio">
<br><span class="username" style="font-size: 25px;font-weight: bolder">Bongo Radio African Grooves</span>
<div class="audioplayer">
   <audio id="player" autoplay="yes" preload="auto" src="http://bongoradio.com:9000/stream/4/"></audio>
<div>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').play()">Play</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').pause()">Paused</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume += 0.1">Vol+</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume -= 0.1">Vol-</a>
</div>
</div>
</div>
</div>
<?php
}
if ($name=='truthfm') {
?>
<div class="box-header with-border" style=" padding: 10px;">
  <div class="user-block">
<img src="https://i.imgur.com/vX5yfyH.jpg" width="70" alt="truth radio">
<br><span class="username" style="font-size: 25px;font-weight: bolder">Truth FM 90.7</span>
<div class="audioplayer">
   <audio id="player" autoplay="yes" preload="auto" src="http://uk1-vn.mixstream.net:10104/stream/1/"></audio>
<div>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').play()">Play</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').pause()">Paused</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume += 0.1">Vol+</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume -= 0.1">Vol-</a>
</div>
</div>
</div>
</div>
<?php
}
if ($name=='hero') {
?>
<div class="box-header with-border" style=" padding: 10px;">
  <div class="user-block">
<img src="https://cdn.webrad.io/images/logos/radio-or-ke/hero.png" alt="hero radio">
<br><span class="username" style="font-size: 25px;font-weight: bolder">Hero Radio 99.0 FM</span>
<div class="audioplayer">
   <audio id="player" autoplay="yes" preload="auto" src="http://node-02.zeno.fm/77zqx50sy2quv?rj-ttl=5&rj-token=AAABbC1VhRpfwqXGMd3iyDt0sCY6wyPxMvYTeCzHGFAg4Ey_Lic3jg"></audio>
<div>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').play()">Play</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').pause()">Paused</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume += 0.1">Vol+</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume -= 0.1">Vol-</a>
</div>
</div>
</div>
</div>
<?php
}
if ($name=='voa-africa') {
?>
<div class="box-header with-border" style=" padding: 10px;">
  <div class="user-block">
<img src="https://cdn.webrad.io/images/logos/radio-or-ke/voa-africa.png" alt="voa-africa radio">
<br><span class="username" style="font-size: 25px;font-weight: bolder">VOA Africa 107.5 FM</span>
<div class="audioplayer">
   <audio id="player" autoplay="yes" preload="auto" src="http://ample-04.radiojar.com/gyac3bggq3quv?rj-ttl=5&rj-token=AAABbC1W5ajsJ3wT0uaa8-HaCoiI39hMsJYGsvd46KbDYx22Sh3d0g"></audio>
<div>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').play()">Play</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').pause()">Paused</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume += 0.1">Vol+</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume -= 0.1">Vol-</a>
</div>
</div>
</div>
</div>
<?php
}
if ($name=='afro-beat') {
?>
<div class="box-header with-border" style=" padding: 10px;">
  <div class="user-block">
<img src="https://cdn.webrad.io/images/logos/radio-or-ke/afro-beat.png" alt="afro-beat radio">
<br><span class="username" style="font-size: 25px;font-weight: bolder">Afro Beats Live</span>
<div class="audioplayer">
   <audio id="player" autoplay="yes" preload="auto" src="http://node-05.zeno.fm/28dunhsd19duv?rj-ttl=5&rj-token=AAABbC1YpGD9dvnb4TYytK35tCC-gxJialix-ArWjyJ9XjtFt909NQ"></audio>
<div>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').play()">Play</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').pause()">Paused</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume += 0.1">Vol+</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume -= 0.1">Vol-</a>
</div>
</div>
</div>
</div>
<?php
}
if ($name=='nrg') {
?>
<div class="box-header with-border" style=" padding: 10px;">
  <div class="user-block">
<img src="https://cdn.webrad.io/images/logos/radio-or-ke/nrg.png" alt="nrgradio">
<br><span class="username" style="font-size: 25px;font-weight: bolder">NRG Radio 91.3 FM</span>
<div class="audioplayer">
   <audio id="player" autoplay="yes" preload="auto" src="http://net1.citrus3.com:8552/stream/1/"></audio>
<div>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').play()">Play</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').pause()">Paused</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume += 0.1">Vol+</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume -= 0.1">Vol-</a>
</div>
</div>
</div>
</div>
<?php
}
if ($name=='westfm') {
?>
<div class="box-header with-border" style=" padding: 10px;">
  <div class="user-block">
<img src="https://westfm.co.ke/wp-content/uploads/2019/03/logotransparent.png" alt="westfm">
<br><span class="username" style="font-size: 25px;font-weight: bolder">WestFM Live FM</span>
<div class="audioplayer">
   <audio id="player" autoplay="yes" preload="auto" src="http://node-19.zeno.fm/n152yv0hu0quv?rj-ttl=5&rj-token=AAABbC-zWm9_4ahtm8ENs1_OG35-uDkWgF3RzHZM9KoeH6SkR8ynEw"></audio>
<div>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').play()">Play</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').pause()">Paused</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume += 0.1">Vol+</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume -= 0.1">Vol-</a>
</div>
</div>
</div>
</div>
<?php
}
if ($name=='radiocitizen') {
?>
<img src="https://i.imgur.com/vhIOBPl.png" width="70"> 
<video id="example-video" class="video-js vjs-default-skin" controls autoplay controls poster="<?php echo URL; ?>/images/logo.png" width="330" height="50">
  <source
     src="https://radio.citizentv.co.ke/radiocitizen/radiocitizen/chunklist_w441014684.m3u8"
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
setInterval(function(){	myVideo.controls = !myVideo.controls; },500)
</script>
<?php
}
if ($name=='inoorofm') {
?>
<img src="https://i.imgur.com/gGF7Gue.png" width="70"> 
<video id="example-video" class="video-js vjs-default-skin" controls autoplay controls poster="<?php echo URL; ?>/images/logo.png" width="330" height="50">
  <source
     src="http://radio.citizentv.co.ke/inoorofm/inoorofm/chunklist_w1231723230.m3u8"
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
setInterval(function(){	myVideo.controls = !myVideo.controls; },500)
</script>
<?php
}
if ($name=='hot96') {
?>
<img src="https://i.imgur.com/UWBzPwd.jpg" width="70"> 
<video id="example-video" class="video-js vjs-default-skin" controls autoplay controls poster="<?php echo URL; ?>/images/logo.png" width="330" height="50">
  <source
     src="http://35.154.154.231:1935/hot96fm/hot96fm/chunklist_w1944557782.m3u8"
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
setInterval(function(){	myVideo.controls = !myVideo.controls; },500)
</script>
<?php
}
if ($name=='ramogifm') {
?>
<img src="https://i.imgur.com/c8Ao8UV.png" width="110"> 
<video id="example-video" class="video-js vjs-default-skin" controls autoplay controls poster="<?php echo URL; ?>/images/logo.png" width="330" height="50">
  <source
     src="http://radio.citizentv.co.ke/ramogifm/ramogifm/chunklist_w29729201.m3u8"
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
setInterval(function(){	myVideo.controls = !myVideo.controls; },500)
</script>
<?php
}
if ($name=='egesafm') {
?>
<img src="https://i.imgur.com/lcbMdKM.png" width="70"> 
<video id="example-video" class="video-js vjs-default-skin" controls autoplay controls poster="<?php echo URL; ?>/images/logo.png" width="330" height="50">
  <source
     src="http://radio.citizentv.co.ke/egesafm/egesafm/chunklist_w2091648922.m3u8"
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
setInterval(function(){	myVideo.controls = !myVideo.controls; },500)
</script>
<?php
}
if ($name=='musyifm') {
?>
<img src="https://i.imgur.com/2bT0gBg.png" width="70"> 
<video id="example-video" class="video-js vjs-default-skin" controls autoplay controls poster="<?php echo URL; ?>/images/logo.png" width="330" height="50">
  <source
     src="http://radio.citizentv.co.ke/musyifm/musyifm/chunklist_w104164944.m3u8"
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
setInterval(function(){	myVideo.controls = !myVideo.controls; },500)
</script>
<?php
}
if ($name=='chamgeifm') {
?>
<img src="https://i.imgur.com/wSRv5JD.png" width="70"> 
<video id="example-video" class="video-js vjs-default-skin" controls autoplay controls poster="<?php echo URL; ?>/images/logo.png" width="330" height="50">
  <source
     src="http://radio.citizentv.co.ke/chamgeifm/chamgeifm/chunklist_w1028112432.m3u8"
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
setInterval(function(){	myVideo.controls = !myVideo.controls; },500)
</script>
<?php
}
if ($name=='mulembefm') {
?>
<img src="https://i.imgur.com/MKMr9vf.png" width="70"> 
<video id="example-video" class="video-js vjs-default-skin" controls autoplay controls poster="<?php echo URL; ?>/images/logo.png" width="330" height="50">
  <source
     src="http://radio.citizentv.co.ke/mulembefm/mulembefm/chunklist_w537387353.m3u8"
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
setInterval(function(){	myVideo.controls = !myVideo.controls; },500)
</script>
<?php
}
if ($name=='wimwarofm') {
?>
<img src="https://rmsradio.co.ke/wp-content/uploads/2016/05/wimwaro.png" width="110"> 
<video id="example-video" class="video-js vjs-default-skin" controls autoplay controls poster="<?php echo URL; ?>/images/logo.png" width="330" height="50">
  <source
     src="http://radio.citizentv.co.ke/wimwarofm/wimwarofm/chunklist_w1108022486.m3u8"
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
setInterval(function(){	myVideo.controls = !myVideo.controls; },500)
</script>
<?php
}
if ($name=='muugafm') {
?>
<img src="https://rmsradio.co.ke/wp-content/uploads/2016/05/muuga.png" width="110"> 
<video id="example-video" class="video-js vjs-default-skin" controls autoplay controls poster="<?php echo URL; ?>/images/logo.png" width="330" height="50">
  <source
     src="http://radio.citizentv.co.ke/muugafm/muugafm/chunklist_w1335510868.m3u8"
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
setInterval(function(){	myVideo.controls = !myVideo.controls; },500)
</script>
<?php
}
if ($name=='baharifm') {
?>
<img src="https://rmsradio.co.ke/wp-content/uploads/2016/05/bahari.png" width="110"> 
<video id="example-video" class="video-js vjs-default-skin" controls autoplay controls poster="<?php echo URL; ?>/images/logo.png" width="330" height="50">
  <source
     src="http://radio.citizentv.co.ke/baharifm/baharifm/chunklist_w1293822549.m3u8"
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
setInterval(function(){	myVideo.controls = !myVideo.controls; },500)
</script>
<?php
}
if ($name=='sautiyapwani') {
?>
<div class="box-header with-border" style=" padding: 10px;">
  <div class="user-block">
<img src="http://www.sautiyapwani.co.ke/SautiYaPwani/images/listen-live.png" width="120" alt="SAUTI YA PWANI 94.2 FM">
<br><span class="username" style="font-size: 25px;font-weight: bolder">SAUTI YA PWANI 94.2 FM</span>
<div class="audioplayer">
   <audio id="player" autoplay="yes" preload="auto" src="http://s37.myradiostream.com:11968/;?1564785304565"></audio>
<div>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').play()">Play</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').pause()">Paused</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume += 0.1">Vol+</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume -= 0.1">Vol-</a>
</div>
</div>
</div>
</div>
<?php
}
if ($name=='athiani') {
?>
<div class="box-header with-border" style=" padding: 10px;">
  <div class="user-block">
<img src="https://static-media.streema.com/media/cache/cb/0b/cb0bb2e75e285f17c25e9e5420513dbe.jpg" width="120" alt="Athiani FM">
<br><span class="username" style="font-size: 25px;font-weight: bolder">Athiani FM</span>
<div class="audioplayer">
   <audio id="player" autoplay="yes" preload="auto" src="http://78.129.232.226:8187/stream"></audio>
<div>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').play()">Play</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').pause()">Paused</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume += 0.1">Vol+</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume -= 0.1">Vol-</a>
</div>
</div>
</div>
</div>
<?php
}
if ($name=='kbc-english-service') {
?>
<div class="box-header with-border" style=" padding: 10px;">
  <div class="user-block">
<img src="https://tools.zenoradio.com/content/stations/agxzfnplbm8tc3RhdHNyMgsSCkF1dGhDbGllbnQYgICgvvefzwgMCxIOU3RhdGlvblByb2ZpbGUYgICgoZjF_QkMogEEemVubw/image/?keep=w&lu=Tue%20Aug%2006%2007:42:21%20UTC+0000%202019&resize=350x350" width="120" alt="Athiani FM">
<br><span class="username" style="font-size: 25px;font-weight: bolder">KBC English Service</span>
<div class="audioplayer">
   <audio id="player" autoplay="yes" preload="auto" src="https://node-20.zeno.fm/573rgyyst5quv.aac?rj-ttl=5&rj-token=AAABbGjBNK5y9U-E0Zf9JTD07A848SiNe3PLPVp-Cl4pCuOKWK1m6g"></audio>
<div>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').play()">Play</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').pause()">Paused</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume += 0.1">Vol+</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume -= 0.1">Vol-</a>
</div>
</div>
</div>
</div>
<?php
}
if ($name=='kbc-taifa') {
?>
<div class="box-header with-border" style=" padding: 10px;">
  <div class="user-block">
<img src="https://i.imgur.com/AZcsF08.png" width="120" alt="kbc-taifa FM">
<br><span class="username" style="font-size: 25px;font-weight: bolder">KBC Radio Taifa</span>
<div class="audioplayer">
   <audio id="player" autoplay="yes" preload="auto" src="https://node-16.zeno.fm/4fdwx9mydbruv?rj-ttl=5&rj-token=AAABbGjHSFlC5rfMLq38tMgUC6FluY7-q3Tn3vmezymK-_Z3YcyC5Q"></audio>
<div>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').play()">Play</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').pause()">Paused</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume += 0.1">Vol+</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume -= 0.1">Vol-</a>
</div>
</div>
</div>
</div>
<?php
}
if ($name=='minto') {
?>
<div class="box-header with-border" style=" padding: 10px;">
  <div class="user-block">
<img src="https://i.imgur.com/QVK7VXH.png" width="120" alt="minto FM">
<br><span class="username" style="font-size: 25px;font-weight: bolder">Minto FM</span>
<div class="audioplayer">
   <audio id="player" autoplay="yes" preload="auto" src="https://node-23.zeno.fm/an9wz2zst5quv.aac?rj-ttl=5&rj-token=AAABbGjL3sk4yWvrEqWEanIMyr1b07X7b03sZMjdudTS35jhTzarGg"></audio>
<div>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').play()">Play</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').pause()">Paused</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume += 0.1">Vol+</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume -= 0.1">Vol-</a>
</div>
</div>
</div>
</div>
<?php
}
if ($name=='reggae') {
?>
<div class="box-header with-border" style=" padding: 10px;">
  <div class="user-block">
<img src="https://tools.zenoradio.com/content/stations/agxzfnplbm8tc3RhdHNyMgsSCkF1dGhDbGllbnQYgICgkJjRtgsMCxIOU3RhdGlvblByb2ZpbGUYgICgrNOsgwsMogEEemVubw/image/?keep=w&lu=Sun%20Aug%2004%2008:13:56%20UTC+0000%202019&resize=350x350" width="120" alt="minto FM">
<br><span class="username" style="font-size: 25px;font-weight: bolder">Reggae FM</span>
<div class="audioplayer">
   <audio id="player" autoplay="yes" preload="auto" src="https://node-09.zeno.fm/ubwu57s8a0quv.aac?rj-ttl=5&rj-token=AAABbGjPzdLZppnbp6Z5q-r7d9IQ_jbH0tOnZ5mWmDsqEZ0fye08Rw"></audio>
<div>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').play()">Play</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').pause()">Paused</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume += 0.1">Vol+</a>
  <a href="javascript:void();" class="a1" onclick="document.getElementById('player').volume -= 0.1">Vol-</a>
</div>
</div>
</div>
</div>
<?php
}
?>
</th>
      </tr>
         <tr>
        <td class="w" style="text-align: center;">
          <div id="radiofooter">
<ul id="ulfooter">
<li><a href="<?php echo URL; ?>/radioplayer/homeboyz" onclick="return radioplayer('radioplayer/homeboyz')" target="_self"><img src="https://i.imgur.com/7jiUMUL.jpg" width="65"></a></li>
<li><a href="<?php echo URL; ?>/radioplayer/radiojambo" onclick="return radioplayer('radioplayer/radiojambo')" target="_self"><img src="https://i.imgur.com/oOkx5mQ.jpg" width="65"></a></li>
<li><a href="<?php echo URL; ?>/radioplayer/capitalfm" onclick="return radioplayer('radioplayer/capitalfm')" target="_self"><img src="https://i.imgur.com/57a7jus.jpg" width="65"></a></li>
<li><a href="<?php echo URL; ?>/radioplayer/classic105" onclick="return radioplayer('radioplayer/classic105')" target="_self"><img src="https://i.imgur.com/MSo47tZ.png" width="65"></a></li>
<li><a href="<?php echo URL; ?>/radioplayer/truthfm" onclick="return radioplayer('radioplayer/truthfm')" target="_self"><img src="https://i.imgur.com/vX5yfyH.jpg" width="65"></a></li>
<li><a href="<?php echo URL; ?>/radioplayer/kamemefm" onclick="return radioplayer('radioplayer/kamemefm')" target="_self"><img src="https://i.imgur.com/x59bZ52.jpg" width="65"></a></li>
<li><a href="<?php echo URL; ?>/radioplayer/hot96" onclick="return radioplayer('radioplayer/hot96')" target="_self"><img src="https://i.imgur.com/UWBzPwd.jpg" width="65"></a></li>
<li><a href="<?php echo URL; ?>/radioplayer/ghettoradio" onclick="return radioplayer('radioplayer/ghettoradio')" target="_self"><img src="https://i.imgur.com/svGcn4E.jpg" width="65"></a></li>
<li><a href="<?php echo URL; ?>/radioplayer/nationfm" onclick="return radioplayer('radioplayer/nationfm')" target="_self"><img src="https://i.imgur.com/2eaRJCL.png" width="65"></a></li>
<li><a href="<?php echo URL; ?>/radioplayer/inoorofm" onclick="return radioplayer('radioplayer/inoorofm')" target="_self"><img src="https://i.imgur.com/gGF7Gue.png" width="65"></a></li>
<li><a href="<?php echo URL; ?>/radioplayer/familyradio316" onclick="return radioplayer('radioplayer/familyradio316')" target="_self"><img src="https://i.imgur.com/edBofXd.png" width="65"></a></li>
<li><a href="<?php echo URL; ?>/radioplayer/unverifiedradio" onclick="return radioplayer('radioplayer/unverifiedradio')" target="_self"><img src="https://i.imgur.com/ETeQnwl.png" width="65"></a></li>
<li><a href="<?php echo URL; ?>/radioplayer/radiomaisha" onclick="return radioplayer('radioplayer/radiomaisha')" target="_self"><img src="https://i.imgur.com/slnvTWf.png" width="65"></a></li>
<li><a href="<?php echo URL; ?>/radioplayer/xfm" onclick="return radioplayer('radioplayer/xfm')" target="_self"><img src="https://i.imgur.com/VNAy0Oy.jpg" width="65"></a></li>
<li><a href="<?php echo URL; ?>/radioplayer/eastfm" onclick="return radioplayer('radioplayer/eastfm')" target="_self"><img src="https://i.imgur.com/jeifEwz.png" width="65"></a></li>
<li><a href="<?php echo URL; ?>/radioplayer/radiocitizen" onclick="return radioplayer('radioplayer/radiocitizen')" target="_self"><img src="https://i.imgur.com/vhIOBPl.png" width="65"></a></li>
</ul>
</div>
<div class="" style="cursor: pointer; padding:10px; background-color: #008000; color:#fff;" onclick="window.location='<?php echo URL; ?>/livestream/switch'" target="_self">
<b>Click this button to Watch Kenyan TV Stations</b>
</div>
        </td>
      </tr>
    </table>
<div class="moreStations">
&hearts; <?php echo radioLive($user_ip,$db); ?>
</div>


<div class="moreStations">
<a href="javascript:void(0);"><em>+40 more stations </em></a>
<ul>
<li><a href="<?php echo URL; ?>/radioplayer/musyifm" onclick="return radioplayer('radioplayer/musyifm')" target="_self">Musyi FM</a></li>
<li><a href="<?php echo URL; ?>/radioplayer/mulembefm" onclick="return radioplayer('radioplayer/mulembefm')" target="_self">Mulembe FM</a></li>
<li><a href="<?php echo URL; ?>/radioplayer/chamgeifm" onclick="return radioplayer('radioplayer/chamgeifm')" target="_self">Chamgei FM</a></li>
<li><a href="<?php echo URL; ?>/radioplayer/familyradio316" onclick="return radioplayer('radioplayer/familyradio316')" target="_self">Family Radio 316</a></li>
<li><a href="<?php echo URL; ?>/radioplayer/kassfm" onclick="return radioplayer('radioplayer/kassfm')" target="_self">Kass FM</a></li>
<li><a href="<?php echo URL; ?>/radioplayer/kiss100" onclick="return radioplayer('radioplayer/kiss100')" target="_self">Kiss 100</a></li>
<li><a href="<?php echo URL; ?>/radioplayer/hopefm" onclick="return radioplayer('radioplayer/hopefm')" target="_self">Hope FM</a></li>
<li><a href="<?php echo URL; ?>/radioplayer/milelefm" onclick="return radioplayer('radioplayer/milelefm')" target="_self">Milele FM</a></li>
<li><a href="<?php echo URL; ?>/radioplayer/ramogifm" onclick="return radioplayer('radioplayer/ramogifm')" target="_self">Ramogi FM</a></li>
<li><a href="<?php echo URL; ?>/radioplayer/egesafm" onclick="return radioplayer('radioplayer/egesafm')" target="_self">Egesa FM</a></li>
<li><a href="<?php echo URL; ?>/radioplayer/wimwarofm" onclick="return radioplayer('radioplayer/wimwarofm')" target="_self">Wimwaro FM</a></li>
<li><a href="<?php echo URL; ?>/radioplayer/muugafm" onclick="return radioplayer('radioplayer/muugafm')" target="_self">Muuga FM</a></li>
<li><a href="<?php echo URL; ?>/radioplayer/baharifm" onclick="return radioplayer('radioplayer/baharifm')" target="_self">Bahari FM</a></li>


<li><a href="<?php echo URL; ?>/radioplayer/capitalfm" target="_self">Capital FM</a></li>
<li><a href="<?php echo URL; ?>/radioplayer/waumini" target="_self">Waumini 88.3 FM</a></li>
<li><a href="<?php echo URL; ?>/radioplayer/radiomaisha" target="_self">Radio Maisha 102.7</a></li>
<li><a href="<?php echo URL; ?>/radioplayer/bhb" target="_self">BHB FM 102.5</a></li>
<li><a href="<?php echo URL; ?>/radioplayer/soundasiafm" target="_self">Sound Asia 88.0 FM</a></li>
<li><a href="<?php echo URL; ?>/radioplayer/pili-pili-99-5-fm" target="_self">Pili Pili 99.5 FM</a></li>
<li><a href="<?php echo URL; ?>/radioplayer/maria" target="_self">Radio Maria 88.1</a></li>
<li><a href="<?php echo URL; ?>/radioplayer/e-93" target="_self">E 93 FM</a></li>
<li><a href="<?php echo URL; ?>/radioplayer/atg" target="_self">ATG Radio Kenya 91.1</a></li>
<li><a href="<?php echo URL; ?>/radioplayer/radio-africa-online" target="_self">Radio Africa</a></li>
<li><a href="<?php echo URL; ?>/radioplayer/meru-fm" target="_self">Meru FM 88.3</a></li>
<li><a href="<?php echo URL; ?>/radioplayer/bongo" target="_self">Bongo Radio</a></li>
<li><a href="<?php echo URL; ?>/radioplayer/truthfm" target="_self">Truth FM 90.7</a></li>
<li><a href="<?php echo URL; ?>/radioplayer/hero" target="_self">Hero Radio 99.0</a></li>
<li><a href="<?php echo URL; ?>/radioplayer/voa-africa" target="_self">VOA Africa 107.5 FM</a></li>
<li><a href="<?php echo URL; ?>/radioplayer/afro-beat" target="_self">Afro Beats Live</a></li>
<li><a href="<?php echo URL; ?>/radioplayer/nrg" target="_self">NRG Radio 91.3 FM</a></li>
<li><a href="<?php echo URL; ?>/radioplayer/westfm" target="_self">Westfm Live FM</a></li>
<li><a href="<?php echo URL; ?>/radioplayer/unverifiedradio" target="_self">Unverified Radio</a></li> 
<li><a href="<?php echo URL; ?>/radioplayer/njatafm" target="_self">Njata Fm</a></li> 
<li><a href="<?php echo URL; ?>/radioplayer/sautiyapwani" target="_self">SAUTI YA PWANI 94.2</a></li> 
<li><a href="<?php echo URL; ?>/radioplayer/athiani" target="_self">Athiani FM</a></li>
<li><a href="<?php echo URL; ?>/radioplayer/kbc-english-service" onclick="return radioplayer('radioplayer/kbc-english-service')" target="_self">KBC English Service</a></li>
<li><a href="<?php echo URL; ?>/radioplayer/kbc-taifa" onclick="return radioplayer('radioplayer/kbc-taifa')" target="_self">KBC Radio Taifa</a></li>
<li><a href="<?php echo URL; ?>/radioplayer/minto" onclick="return radioplayer('radioplayer/minto')" target="_self">Minto FM</a></li>
<li><a href="<?php echo URL; ?>/radioplayer/reggae" onclick="return radioplayer('radioplayer/reggae')" target="_self">Reggae Radio</a></li>
</ul>
</div>

<?php
//echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';

//load footer from footer.php
//require_once ('footer.php');

?>
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

echo "<a href='".URL."/help/$page_type' style='text-decoration:underline'>$page_title</a> | ";
}

?>
        </p>
        </td>
			</tr>
			
			
		</tbody>
	</table>
	

</body>
</html>
