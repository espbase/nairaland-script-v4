
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

$user_id=$_SESSION['user_id']; //Storing user ID in SESSION variable.
//echo checkUser(); // authenticate logged in users
require_once 'incfiles/theme/head_open.php';
############################### page title #######################

	$page_title='Classified Item - '.APPNAME;
	$site_dsc="Classified Item - ".APPNAME;
	
require_once 'incfiles/theme/blog_page_title.php';

require_once 'incfiles/theme/metatag.php';
// open body tag

require_once 'incfiles/theme/body_open.php';
################################# include files ##########################

//load header.php
require_once ('header.php');
 
$checkTr=$db->query("SELECT user_id_fk FROM tranfer_request WHERE user_id_fk='$user_id' ");

$countExist=mysqli_num_rows($checkTr);
//if ($countExist) {

?>

<style>
    #slider {
	margin: 2em auto;
	width: 960px;
	overflow: hidden;
}

#slider-wrapper {
	width: 9999px;
	height: 300px;
	position: relative;
	transition: left 400ms linear;
}

.slide {
	float: left;
	width: 160px;
	height: 100px;
	position: relative;
	overflow: hidden;
}

.slide img {
	position: absolute;
	top: 0;
	left: 0;
}

.caption {
	margin: 0;
	position: absolute;
	z-index: 100;
	bottom: -2em;
	left: 0;
	width: 100%;
	height: 2em;
	line-height: 2;
	text-align: center;
	background: rgba( 0, 0, 0, 0.6 );
	color: #fff;
	transition: bottom 500ms ease-in;
}
.caption.visible {
	bottom: 0;
}

#slider-nav {
	margin: 1em 0;
	text-align: center;
}

#slider-nav a {
	width: 2em;
	height: 2em;
	border: 1px solid #ccc;
	text-align: center;
	text-decoration: none;
	color: #000;
	display: inline-block;
	line-height: 2;
	margin-right: 0.5em;
}

#slider-nav a.current {
	border-color: #000;
}

/**
 * Box model adjustments
 * `border-box`... ALL THE THINGS - http://cbrac.co/RQrDL5
 */

*,
*:before,
*:after {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}

/**
 * 1. Force a vertical scrollbar - http://cbrac.co/163MspB
 * NOTE: Use `text-rendering` with caution - http://cbrac.co/SJt8p1
 * NOTE: Avoid the webkit anti-aliasing trap - http://cbrac.co/TAdhbH
 * NOTE: IE for Windows Phone 8 ignores `-ms-text-size-adjust` if the
 *       viewport <meta> tag is used - http://cbrac.co/1cFrAvl
 */

html {
  font-size: 100%;
  overflow-y: scroll; /* 1 */
  min-height: 100%;
}

/**
 * 1. Inherits percentage declared on above <html> as base `font-size`
 * 2. Unitless `line-height`, which acts as multiple of base `font-size`
 */


/* Page wrapper */
.wrapper {
  width: 90%;
  max-width: 800px;
  margin: 4em auto;
  text-align: center;
}

/* Icons */
.icon {
  display: inline-block;
  width: 16px;
  height: 16px;
  vertical-align: middle;
  fill: currentcolor;
}

/* Headings */
h1,
h2,
h3,
h4,
h5,
h6 {
  color: #222;
  font-weight: 700;
  font-family: inherit;
  line-height: 1.333;
  text-rendering: optimizeLegibility;
}

/**
 * Modals ($modals)
 */

/* 1. Ensure this sits above everything when visible */
.modal {
    position: absolute;
    z-index: 10000; /* 1 */
    top: 0;
    left: 0;
    visibility: hidden;
    width: 100%;
    height: 100%;
}

.modal.is-visible {
    visibility: visible;
}

.modal-overlay {
  position: fixed;
  z-index: 10;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: hsla(0, 0%, 0%, 0.5);
  visibility: hidden;
  opacity: 0;
  transition: visibility 0s linear 0.3s, opacity 0.3s;
}

.modal.is-visible .modal-overlay {
  opacity: 1;
  visibility: visible;
  transition-delay: 0s;
}

.modal-wrapper {
  position: absolute;
  z-index: 9999;
  top: 6em;

  background-color: #fff;
  box-shadow: 0 0 1.5em hsla(0, 0%, 0%, 0.35);
}

.modal-transition {
  transition: all 0.3s 0.12s;
  transform: translateY(-10%);
  opacity: 0;
}

.modal.is-visible .modal-transition {
  transform: translateY(0);
  opacity: 1;
}

.modal-header,
.modal-content {
  padding: 1em;
}

.modal-header {
  position: relative;
  background-color: #fff;
  box-shadow: 0 1px 2px hsla(0, 0%, 0%, 0.06);
  border-bottom: 1px solid #e8e8e8;
}

.modal-close {
  position: absolute;
  top: 0;
  right: 0;
  padding: 1em;
  color: #aaa;
  background: none;
  border: 0;
}

.modal-close:hover {
  color: #777;
}

.modal-heading {
  font-size: 1.125em;
  margin: 0;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

.modal-content > *:first-child {
  margin-top: 0;
}

.modal-content > *:last-child {
  margin-bottom: 0;
}
</style>


	

<?php
$geturl = $_GET['url'].'.html';
//echo $geturl;




$comQuery1=$db->query("SELECT * FROM classified C, sub_cat S, users U WHERE C.class_cat=S.sid AND C.class_url='$geturl' AND C.user_fk=U.uid GROUP BY C.class_url ");
$countR=$comQuery1->num_rows;

if ($countR)
{
while($rowR1=$comQuery1->fetch_assoc())
{
  $bname =($rowR1['class_name']);
  $desc =($rowR1['class_features']);
  $location =($rowR1['class_location']);
  $buzlogo =($rowR1['class_img1']);
  $class_amt =($rowR1['class_amt']);
  $cat =($rowR1['class_date']);
  $class_info =($rowR1['class_info']);
  $class_phone =($rowR1['phone']);
  $class_email =($rowR1['email']);
  $class_id =($rowR1['class_id']);

  $clickcount=$rowR1['class_clickcount']+1; //increament clicks by one 1

$pdateClicks=$db->query("UPDATE classified SET class_clickcount='$clickcount' WHERE class_id='$class_id'");

$comQuery12=$db->query("SELECT * FROM class_img WHERE class_fk='$class_id' ");
$rowp=$comQuery12->fetch_assoc();

  $class_img1 =($rowp['class_img1']);
  $class_img2 =($rowp['class_img2']);
?>
  <table summary="search">
    <tbody>
        <tr>
        <td class="w" style="text-align: left;">
          <img src="<?php echo URL.'/images/bus/watermark.php?image='.$class_img1.'&watermark=k247.png'; ?>" width="150" class="modal-toggle" style="display:inline-block;"/>
          <img src="<?php echo URL.'/images/bus/watermark.php?image='.$class_img2.'&watermark=k247.png'; ?>" width="150" style="display:inline-block;"/>
  
  <div class="modal">
    <div class="modal-overlay modal-toggle"></div>
    <div class="modal-wrapper modal-transition">
      <div class="modal-header">
        <button class="modal-close modal-toggle"><svg class="icon-close icon" viewBox="0 0 32 32"><use xlink:href="#icon-close"></use></svg></button>
        <h2 class="modal-heading">Item Images</h2>
      </div>
      
      <div class="modal-body">
        <div class="modal-content">
          
          <img src="<?php echo URL.'/images/bus/watermark.php?image='.$class_img1.'&watermark=k247.png'; ?>" width="320" class="modal-toggle"/>
          <img src="<?php echo URL.'/images/bus/watermark.php?image='.$class_img2.'&watermark=k247.png'; ?>" width="320" />
        </div>
      </div>
    </div>
  </div>
</td>
      </tr>
      <tr>
        <td class="" style="text-align: left;">
              <h3><?php echo $bname.' | Ksh'.number_format($class_amt); ?></h3>
              <span class="span"><b>Location:</b> <?php echo $location; ?> | <?php echo $sname; ?></span> <br>
              <span class="span"><b>Features:</b> <?php echo $desc; ?></span> <hr>
              <span class="span"> <b>More Details:</b> <?php echo $class_info; ?></span><hr>
          <b class="span"> <span id="num"><?php echo substr($class_phone, 0,5); ?>*****</span> <span id="more_content" style="display:none"><?php echo $class_phone; ?></span> <a href="javascript:void();" id="see_more">Show Phone Number</a> | Email : <?php echo $class_email; ?></b>
</td>
      </tr>
    </tbody>
  </table>
<?php } }  ?>



  <p class="small">(<a href="#up"><b>Go Up</b></a>)</p>



<?php


//load footer from footer.php
require_once ('footer.php');

?>
<script type="text/javascript">
$('#see_more').click( function() 
{ $('#more_content').show(); 
    
   $('#num').hide(); 
});

// Quick & dirty toggle to demonstrate modal toggle behavior
$('.modal-toggle').on('click', function(e) {
  e.preventDefault();
  $('.modal').toggleClass('is-visible');
});
</script>

</body>
</html>
