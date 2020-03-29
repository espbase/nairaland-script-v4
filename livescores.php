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

	$page_title='kenyans 247 football matches livescores and odds';
	$site_dsc=APPNAME." kenyans 247 football matches livescores and odds";
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');

##################### login form ########################

$error="";
?>

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
#topadvert
{
    display:hide;
}
.copyright
{
 display:hide;   
}
</style>
<script>
    $("iframe").contents().find(".copyright").hide();
</script>
    <table>
      <tr>
        <th><h2>Kenyans 247 Football Matches, LiveScores and Odds</h2></th>
      </tr>


         <tr>
        <td class="w" style="text-align: left;">
           <iframe id="inscore-xdc-323386" src="https://www.livescore.in/free/323386/" class="video-container" width="600" height="500" frameborder="0" scrolling="no"></iframe>

<script type="text/javascript">/*<![CDATA[*/try{function inscore_323386_xdc(){this.elm = null;this.hash = null;var times_resized = 0;var times_not_resized = 0;this.resize = function(){times_resized == 1023 && (times_resized = 0);times_not_resized == 1023 && (times_not_resized = 0);if(this.getElm() && location.hash && location.hash != this.hash){this.hash = location.hash;var reggg = new RegExp(".*inscore_ifheight_xdc_([0-9]{2,5}).*");if(result=reggg.exec(location.hash)){this.getElm().style.height = (typeof result[1] == "undefined" ? "10000":(result[1] > 500 && result[1] <= 50000 ? parseInt(result[1]):500)) + "px";times_resized ++;}} else if(location.hash && location.hash == this.hash) times_not_resized ++;else return resize_later(75);resize_later(250);};var resize_later = function(time){setTimeout(function(){ inscore_323386_xdc_run.resize(); }, time);};this.getElm = function(){try {(typeof this.elm == "undefined" || this.elm === null || !this.elm) && (this.elm = document.getElementById("inscore-xdc-323386"));} catch(e) { this.elm = null; }return this.elm;};var show_links = function(){if((times_resized >= 1 || times_not_resized >= 2) && (obj = document.getElementById("freescore_links_323386"))){obj.style.visibility = "visible";obj.style.display = "block";} else show_links_later();};var show_links_later = function() { setTimeout(function(){ show_links(); }, 100); };if (typeof window.postMessage == "undefined"){show_links_later();resize_later();}else{var ev = function(event){try{var data = JSON.parse(event.data);}catch (e){return;}if (data instanceof Array && data[0] == 323386 && typeof data[1] != "undefined"){eval(data[1]);}};if (window.addEventListener){window.addEventListener( "message", ev);}else if ( window.attachEvent ){window.attachEvent("onmessage", ev);}setTimeout(function(){document.getElementById("inscore-xdc-323386").contentWindow.postMessage(JSON.stringify(["323386", "run"]), "*");}, 2000);show_links_later();resize_later();}};var inscore_323386_xdc_run = new inscore_323386_xdc();}catch(e){document.getElementById("inscore-xdc-323386").style.height = "10000px";}
/*]]>*/</script>
        </td>
      </tr>
    </table>
<a href="http://www.livescore.in/" title="Livescore.in" target="_blank">Livescore.in</a>
<?php
echo '<p class="small">(<a href="#up"><b>Go Up</b></a>)</p>';

//load footer from footer.php
require_once ('footer.php');

?>

</body>
</html>
