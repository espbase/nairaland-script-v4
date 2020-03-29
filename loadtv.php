<style type="text/css">
	@media only screen and (max-width: 768px) {
    /* For mobile phones: */

    #img-responsive{width: 330px;}
     #img-responsive1{width: 230px;}
}

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
</style>

<?php
$tvname = $_GET['name'];
if ($tvname=='ebru') {
?>
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