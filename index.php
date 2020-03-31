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

  if (isset($_GET['delete'])=='install') {
    # code...
  if(is_file('install.php'))
  {
          unlink('install.php'); //delete file
  }
  }

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
/*
END featured post settings,
*/
/*
NOTE: Don't remove this line of code
this serve as the developer property
that exist between the app and the third party
*/

$site_title=APPNAME.' Forum';

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

if (DEVELOPER==='Marshall')
{


if (filesize('config.php')!=0) {

  if (!file_exists('install.php')) {
require_once ('header.php');



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
/*.header__opener-line {

    height: 2px;
    background-image: linear-gradient(90deg,transparent,#fa1e4e,transparent);
    top: -0.4px;
    position: absolute;
    left: 0;
    right: 0;

}*/
.heade_line{height: 2px;background-image: linear-gradient(90deg,transparent,#fa1e4e,transparent);}
</style>
 <!--<a href="classified"><img src='https://i.imgur.com/xXj15Jo.png' id=""> </a> -->

<?php

//echo '<div style="font-family:Lora;" >Welcome To '.$page_title.' :: Meet People and Make New Friends!</div>';

//echo "Value is: " . $_COOKIE['password'];

if(isset($_GET['k']))
{
  $k=$_GET['k'];

      echo '<script type="text/javascript">window.location = "'.URL.'/confirm-email?k='.$k.'"; </script>';
}
 
//load board.php list of categories -->
 require_once ('inc_board.php');


 $sid='index';
//load system header ads template
require ('ads.php');


//load google adsense ads template
require_once ('incfiles/googleads.html');
//load articles from articles.php -->
require_once ('inc_articles_spon.php');
//load articles from articles.php -->
require_once ('inc_articles.php');

//load articles from articles.php -->
//require_once ('inc_articles_feed.php');


//load articles from articles.php -->
//require ('inc.radio.php');

//load articles from articles.php -->
//require ('inc.tv.php');
?>

  <?php

//load system header ads template
require ('ads.php');
?>
<div class="heade_line" style=""></div>
<?php
//load footer statistic from footer_stat.php
require_once ('footer_stat.php');

echo '<div class="heade_line" style=""></div><p class="small">(<a href="#top"><b>Go Up</b></a>)</p>';


//load footer from footer.php
require_once ('footer.php');

}
else
{
echo '<h2>Installation Successfull!</h2>
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
}
//

else
{

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
      Contact <a href="mailto:marshallunduemi@gmail.com">support &rsaquo;&rsaquo;</a>  if any problem occure 
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
 echo '<h2><a>Warning!</a></h2>
<table>
  <tr>
    <td class="">========================= Instruction =========================<br>
      - You have tempered with the soruce code, please refer to the documentation or Contact developer...
    </td>
  </tr>
</table>';
}
}
else{
	header('location: install.php');
}
